<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $fillable = [
        'rfid','id_player','id_plant'
    ];

    public function plants()
    {
        return $this->belongsTo(Plants::class, 'id_plant');
    }
    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }
}
