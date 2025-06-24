<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'room_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

 public function hasNotPaid()
    {
        return !$this->payments()->exists(); // Trả về true nếu không có bản ghi thanh toán
    }
}