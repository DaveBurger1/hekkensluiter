<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The groups that belong to the user.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Get the user's profile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
     * Check if the user has the given permission.
     */
    public function hasPermission(string $permission): bool
    {
        foreach ($this->groups as $group) {
            if ($group->actions->contains('key', $permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user belongs to a group by name.
     */
    public function hasGroup(string $groupName): bool
    {
        return $this->groups->contains('name', $groupName);
    }

    /**
<<<<<<< HEAD
=======
=======
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
