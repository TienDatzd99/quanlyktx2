<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'room_id', 'amount', 'type', 'status', 'payment_date', 'due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}