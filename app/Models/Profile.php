<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'tussenvoegsel',
        'last_name',
        'bsn',
        'address',
        'city',
        'date_of_birth',
        'place_of_birth',
        'delict',
    ];
    
    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function prisoner(): HasOne
    {
        return $this->hasOne(Prisoner::class);
    }
}