<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'name_past'
    ];

    public $timestamps = false;

    public function action_logs(): HasMany
    {
        return $this->hasMany(ActionLog::class);
    }
}