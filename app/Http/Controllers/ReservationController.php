<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function reserve(Request $request, Room $room)
    {
        if ($room->status === 'occupied') {
            return response()->json(['message' => 'Room is already occupied.'], 400);
        }

        DB::transaction(function () use ($room) {
            // Cambiar estado de la habitación a "occupied"
            $room->update([
                'status' => 'occupied',
                'occupied_at' => now(),
            ]);

            // Registrar el estado de ocupación en la tabla de historiales
            RoomStatus::create([
                'room_id' => $room->id,
                'status' => 'occupied',
                'status_changed_at' => now(),
            ]);

            // Crear nueva reserva
            Reservation::create([
                'room_id' => $room->id,
                'start_time' => now(),
            ]);
        });

        return response()->json(['message' => 'Room reserved successfully.'], 200);
    }

    public function release(Request $request, Room $room)
    {
        if ($room->status === 'available') {
            return response()->json(['message' => 'Room is already available.'], 400);
        }

        DB::transaction(function () use ($room) {
            // Cambiar estado de la habitación a "vacant"
            $room->update([
                'status' => 'available',
                'occupied_at' => null,
            ]);

            // Registrar el estado de desocupación en la tabla de historiales
            RoomStatus::create([
                'room_id' => $room->id,
                'status' => 'vacant',
                'status_changed_at' => now(),
            ]);

            // Finalizar la reserva actual
            $reservation = Reservation::where('room_id', $room->id)
                                       ->whereNull('end_time')
                                       ->latest()
                                       ->first();

            if ($reservation) {
                $reservation->update([
                    'end_time' => now(),
                ]);
            }
        });

        return response()->json(['message' => 'Room released successfully.'], 200);
    }
}
