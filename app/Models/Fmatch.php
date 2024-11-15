<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fmatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'home_team',
        'away_team',
        'home_score',
        'away_score',
        'match_date',
        'status',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
