<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;


class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $employees = Employee::count();
        $departments = Department::count();
        $positions = Position::count();
        $shifts = Shift::count();

        $recentEmployees = Employee::with('position')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(fn ($emp) => [
                'description' => "{$emp->first_name} {$emp->last_name} joined as " . ($emp->position?->name ?? 'Employee'),
                'time' => Carbon::parse($emp->created_at)->diffForHumans(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Dashboard data retrieved successfully',
            'data' => [
                'employees' => $employees,
                'departments' => $departments,
                'positions' => $positions,
                'shifts' => $shifts,
                'recent_activity' => $recentEmployees,
            ],
        ]);
    }
}
