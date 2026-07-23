<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct(
        protected PositionService $positionService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search']);
        $perPage = $request->input('per_page', 15);

        $positions = $this->positionService->index($filters, $perPage);

        return response()->json([
            'success' => true,
            'message' => 'Positions retrieved',
            'data' => PositionResource::collection($positions),
        ]);
    }

    public function show(Position $position): JsonResponse
    {
        $position = $this->positionService->show($position->id);

        return response()->json([
            'success' => true,
            'message' => 'Position retrieved',
            'data' => new PositionResource($position),
        ]);
    }

    public function store(StorePositionRequest $request): JsonResponse
    {
        $position = $this->positionService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Position created',
            'data' => new PositionResource($position),
        ], 201);
    }

    public function update(UpdatePositionRequest $request, Position $position): JsonResponse
    {
        $position = $this->positionService->update($position, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Position updated',
            'data' => new PositionResource($position),
        ]);
    }

    public function destroy(Position $position): JsonResponse
    {
        $this->positionService->destroy($position);

        return response()->json([
            'success' => true,
            'message' => 'Position deleted',
        ]);
    }
}
