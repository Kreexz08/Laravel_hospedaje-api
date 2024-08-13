<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Room;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;


class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function reserve(Room $room): JsonResponse
    {
        if ($room->status === 'occupied') {
            return response()->json(['message' => 'Room is already occupied.'], 400);
        }

        $this->reservationService->reserveRoom($room);

        return response()->json(['message' => 'Room reserved successfully.'], 200);
    }

    public function release(Room $room): JsonResponse
    {
        if ($room->status === 'available') {
            return response()->json(['message' => 'Room is already available.'], 400);
        }

        $this->reservationService->releaseRoom($room);

        return response()->json(['message' => 'Room released successfully.'], 200);
    }
}
