<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelingLuckyResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'random_number',
        'prize',
        'is_winner',
    ];

    protected $casts = [
        'is_winner' => 'boolean',
    ];

    public function scopeForUser(Builder $query, User $user): void
    {
        $query->where('user_id', $user->id);
    }
}
