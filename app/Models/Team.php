<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function competitionsAsTeam1()
    {
        return $this->hasMany(Competition::class, 'team1_id');
    }

    public function competitionsAsTeam2()
    {
        return $this->hasMany(Competition::class, 'team2_id');
    }
}
