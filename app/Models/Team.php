<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'tla',
        'area',
        'founded',
        'venue',
        'logo_url',
    ];
    public function standings()
    {
        return $this->hasMany(Stand::class, 'team_name', 'name'); // Adjust to 'team_id' if applicable
    }

    
    public function players()
    {
        return $this->hasMany(Player::class, 'team_id', 'id');
    }

   
    public function scorers()
    {
        return $this->hasMany(Scorer::class, 'team_id', 'id');
    }

    
    public function homeMatches()
    {
        return $this->hasMany(Fmatch::class, 'home_team_id', 'id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Fmatch::class, 'away_team_id', 'id');
    }
}
