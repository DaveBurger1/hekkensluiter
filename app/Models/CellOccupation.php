<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class CellOccupation extends Model
{
    use HasFactory;

    protected $fillable = [
        'wing',
        'cell_number', 
        'prisoner_id',
        'start_time',
        'end_time',
    ];

    public $timestamps = false;


    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function case(): HasOneThrough
    {
        return $this->hasOneThrough(CaseModel::class, CasePrisoner::class, 'case_id');
    }

    public function prisoner(): BelongsTo
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function case_prisoner(): BelongsTo
    {
        return $this->belongsTo(CasePrisoner::class);
    }
}