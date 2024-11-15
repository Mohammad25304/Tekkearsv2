<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'team_name',
        'position',
        'played_games',
        'won',
        'draw',
        'lost',
        'points',
        'goals_for',
        'goals_against',
        'goal_difference',
    ];
}
