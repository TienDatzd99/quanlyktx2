<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number', 'floor', 'capacity', 'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'room_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'room_id');
    }
    public function reports()
{
    return $this->hasMany(Report::class);
}
}