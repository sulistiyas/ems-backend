<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Http\Resources\ShiftResource;
use App\Models\Shift;
use App\Services\ShiftService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function __construct(
        protected ShiftService $shiftService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search', 'is_active']);
        $perPage = $request->input('per_page', 15);

        $shifts = $this->shiftService->index($filters, $perPage);

        return response()->json([
            'success' => true,
            'message' => 'Shifts retrieved',
            'data' => ShiftResource::collection($shifts),
        ]);
    }

    public function show(Shift $shift): JsonResponse
    {
        $shift = $this->shiftService->show($shift->id);

        return response()->json([
            'success' => true,
            'message' => 'Shift retrieved',
            'data' => new ShiftResource($shift),
        ]);
    }

    public function store(StoreShiftRequest $request): JsonResponse
    {
        $shift = $this->shiftService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Shift created',
            'data' => new ShiftResource($shift),
        ], 201);
    }

    public function update(UpdateShiftRequest $request, Shift $shift): JsonResponse
    {
        $shift = $this->shiftService->update($shift, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Shift updated',
            'data' => new ShiftResource($shift),
        ]);
    }

    public function destroy(Shift $shift): JsonResponse
    {
        $this->shiftService->destroy($shift);

        return response()->json([
            'success' => true,
            'message' => 'Shift deleted',
        ]);
    }
}
