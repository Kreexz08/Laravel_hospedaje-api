<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomService
{
    public function createRoom(array $data): Room
    {
        return Room::create($data);
    }

    public function updateRoom(Room $room, array $data): Room
    {
        $room->update($data);
        return $room;
    }

    public function deleteRoom(Room $room): void
    {
        $room->delete();
    }

    public function getStatuses(Room $room)
    {
        return $room->statuses()->orderBy('status_changed_at', 'desc')->get();
    }
}
