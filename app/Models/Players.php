<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $fillable = [
        'name','password','id_role'
    ];

    public function player()
    {
        return $this->hasMany(Player::class, 'id_player');
    }
}
