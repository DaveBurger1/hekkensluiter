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
<<<<<<< HEAD
        'photo',
=======
<<<<<<< HEAD
        'photo',
=======
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
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