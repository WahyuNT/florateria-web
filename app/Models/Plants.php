<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    use HasFactory;
    protected $table = 'plants';
    protected $fillable = [
        'name'
    ];

    public function plants()
    {
        return $this->hasMany(Plants::class, 'id_plant');
    }
}
