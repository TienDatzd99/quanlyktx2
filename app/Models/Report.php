<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['room_id', 'description', 'status', 'date'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}