<?php

namespace App\Models;

use App\Models\Games;
use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'year_of_foundation',
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(Games::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Games::class, 'away_team_id');
    }
}
