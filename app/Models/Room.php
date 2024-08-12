<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'status', 'occupied_at'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function statuses()
    {
        return $this->hasMany(RoomStatus::class);
    }
}
