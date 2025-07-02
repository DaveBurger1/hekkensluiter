<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action_id',
        'prisoner_id',
        'change',
        'created_at'
    ];

    public $timestamps = false;

    public function prisoner(): BelongsTo
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}