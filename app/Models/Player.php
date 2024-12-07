<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team',
        'position',
        'jersey_number',
        'birthdate',
        'nationality',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
