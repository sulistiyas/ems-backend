<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search', 'department_id', 'position_id', 'status']);
        $perPage = $request->input('per_page', 15);

        $employees = $this->employeeService->index($filters, $perPage);

        return response()->json([
            'success' => true,
            'message' => 'Employees retrieved',
            'data' => EmployeeResource::collection($employees),
        ]);
    }

    public function show(Employee $employee): JsonResponse
    {
        $employee = $this->employeeService->show($employee->id);

        return response()->json([
            'success' => true,
            'message' => 'Employee retrieved',
            'data' => new EmployeeResource($employee),
        ]);
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = $this->employeeService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee created',
            'data' => new EmployeeResource($employee),
        ], 201);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): JsonResponse
    {
        $employee = $this->employeeService->update($employee, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee updated',
            'data' => new EmployeeResource($employee),
        ]);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $this->employeeService->destroy($employee);

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted',
        ]);
    }
}
