<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index(): JsonResponse
    {
        return response()->json(Room::all());
    }

    public function store(RoomRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $room = $this->roomService->createRoom($validated);
        return response()->json($room, 201);
    }

    public function show(Room $room): JsonResponse
    {
        return response()->json($room);
    }

    public function update(RoomRequest $request, Room $room): JsonResponse
    {
        $validated = $request->validated();
        $updatedRoom = $this->roomService->updateRoom($room, $validated);
        return response()->json($updatedRoom);
    }

    public function destroy(Room $room): JsonResponse
    {
        $this->roomService->deleteRoom($room);
        return response()->noContent();
    }

    public function statuses(Room $room): JsonResponse
    {
        $statuses = $this->roomService->getStatuses($room);
        return response()->json($statuses);
    }
}
