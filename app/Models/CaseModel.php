<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class CaseModel extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'name',
        'desciption',
    ];

    public function prisoners(): BelongsToMany
    {
        return $this->belongsToMany(Prisoner::class, CasePrisoner::class, 'case_id')
            ->as('link')->withPivot('reason', 'id')->withTimestamps();
    }

    public function cell_occupations(): HasManyThrough
    {
        return $this->hasManyThrough(CellOccupation::class, CasePrisoner::class, 'case_id', 'case_prisoner_id');
    }

    public function evidence(): HasMany
    {
        return $this->hasMany(Evidence::class, 'case_id');
    }
}