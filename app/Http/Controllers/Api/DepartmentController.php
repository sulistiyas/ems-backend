<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $departmentService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search']);
        $perPage = $request->input('per_page', 15);

        $departments = $this->departmentService->index($filters, $perPage);

        return response()->json([
            'success' => true,
            'message' => 'Departments retrieved',
            'data' => DepartmentResource::collection($departments),
        ]);
    }

    public function show(Department $department): JsonResponse
    {
        $department = $this->departmentService->show($department->id);

        return response()->json([
            'success' => true,
            'message' => 'Department retrieved',
            'data' => new DepartmentResource($department),
        ]);
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $department = $this->departmentService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Department created',
            'data' => new DepartmentResource($department),
        ], 201);
    }

    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $department = $this->departmentService->update($department, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Department updated',
            'data' => new DepartmentResource($department),
        ]);
    }

    public function destroy(Department $department): JsonResponse
    {
        $this->departmentService->destroy($department);

        return response()->json([
            'success' => true,
            'message' => 'Department deleted',
        ]);
    }
}
