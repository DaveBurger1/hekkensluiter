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

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}