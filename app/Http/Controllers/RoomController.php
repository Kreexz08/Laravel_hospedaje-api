<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|integer|unique:rooms',
        ]);

        return Room::create($validated);
    }

    public function show(Room $room)
    {
        return $room;
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'number' => 'required|integer|unique:rooms,number,' . $room->id,
            'status' => 'required|in:available,occupied',
        ]);

        $room->update($validated);

        return $room;
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->noContent();
    }

    public function statuses(Room $room)
    {
        return $room->statuses()->orderBy('status_changed_at', 'desc')->get();
    }
}
