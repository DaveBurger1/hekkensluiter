<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CasePrisoner extends Pivot
{
    protected $fillable = [
        'reason',
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function prisoner(): BelongsTo
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function cell_occupations(): HasMany
    {
        return $this->hasMany(CellOccupation::class);
    }
}