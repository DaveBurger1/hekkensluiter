<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prisoner extends Model
{
    use HasFactory;

    protected $fillable = [
        "profile_id",
    ];

    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(CaseModel::class, CasePrisoner::class, 'prisoner_id', 'case_id')
            ->as('link')->withPivot('reason', 'id')->withTimestamps();
    }

    public function cell_occupations(): HasMany
    {
        return $this->hasMany(CellOccupation::class);
    }

    public function currentCell()
    {
        return $this->cell_occupations()
            ->whereNull('end_time')
            ->latest('start_time');
    }

    public function getCurrentCellAttribute(): ?CellOccupation
    {
        return $this->currentCell()->first();
    }

    public function assignCell(string $wing, string $cellNumber): CellOccupation
    {
        try {
            logger()->info('Starting cell assignment', [
                'prisoner_id' => $this->id,
                'wing' => $wing,
                'cell_number' => $cellNumber
            ]);

            // Validate wing and cell number
            if (!in_array($wing, ['A', 'B', 'C']) || empty($cellNumber)) {
                throw new \InvalidArgumentException('Invalid wing or cell number');
            }

<<<<<<< HEAD
            // Validate cell number range per wing
            $cellNumInt = (int) ltrim($cellNumber, '0'); // Convert to int, remove leading zeros
            $wingRanges = [
                'A' => ['start' => 100, 'end' => 110],
                'B' => ['start' => 200, 'end' => 205],
                'C' => ['start' => 363, 'end' => 373]
            ];

            logger()->info('Cell assignment validation', [
                'wing' => $wing,
                'cell_number' => $cellNumber,
                'cellNumInt' => $cellNumInt,
                'range_start' => $wingRanges[$wing]['start'],
                'range_end' => $wingRanges[$wing]['end']
            ]);

            if (!isset($wingRanges[$wing])) {
                throw new \InvalidArgumentException('Invalid wing specified');
            }

            $range = $wingRanges[$wing];
            if ($cellNumInt < $range['start'] || $cellNumInt > $range['end']) {
                throw new \InvalidArgumentException("Cell number {$cellNumber} is out of allowed range for wing {$wing}");
            }

=======
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
            // Release any current cell assignment
            if ($current = $this->current_cell) {
                logger()->info('Ending current cell assignment', $current->toArray());
                $current->update(['end_time' => now()]);
            }

            $cell = CellOccupation::create([
                'prisoner_id' => $this->id,
                'wing' => $wing,
                'cell_number' => $cellNumber,
                'start_time' => now()
            ]);

            if (!$cell) {
                throw new \RuntimeException('Failed to create cell occupation record');
            }

            logger()->info('Cell created successfully', $cell->toArray());
            return $cell;
            
        } catch (\Exception $e) {
            logger()->error('Cell assignment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}