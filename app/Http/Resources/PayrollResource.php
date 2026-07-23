<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'period' => $this->period,
            'basic_salary' => $this->basic_salary,
            'overtime_pay' => $this->overtime_pay,
            'allowances' => $this->allowances,
            'deductions' => $this->deductions,
            'tax' => $this->tax,
            'net_salary' => $this->net_salary,
            'status' => $this->status,
            'paid_at' => $this->paid_at?->format('Y-m-d'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
