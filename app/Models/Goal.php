<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public function competitions()
    {
        return $this->BelongsTo(Competition::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}
