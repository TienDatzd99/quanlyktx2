<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['room_id', 'name', 'status'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}