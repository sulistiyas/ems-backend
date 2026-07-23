<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'gender' => $this->gender,
            'address' => $this->address,
            'hire_date' => $this->hire_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'salary' => $this->salary,
            'status' => $this->status,
            'photo' => $this->photo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'position' => new PositionResource($this->whenLoaded('position')),
            'schedules' => ScheduleResource::collection($this->whenLoaded('schedules')),
            'attendance' => AttendanceResource::collection($this->whenLoaded('attendance')),
            'leave_requests' => LeaveRequestResource::collection($this->whenLoaded('leaveRequests')),
            'overtimes' => OvertimeResource::collection($this->whenLoaded('overtimes')),
            'payrolls' => PayrollResource::collection($this->whenLoaded('payrolls')),
        ];
    }
}
