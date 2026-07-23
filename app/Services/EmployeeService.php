<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository
    ) {}

    public function index(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->employeeRepository->all($filters, $perPage);
    }

    public function show(int $id): Employee
    {
        $employee = $this->employeeRepository->find($id);
        if (!$employee) {
            abort(404, 'Employee not found');
        }
        return $employee;
    }

    public function store(array $data): Employee
    {
        return $this->employeeRepository->create($data);
    }

    public function update(Employee $employee, array $data): Employee
    {
        return $this->employeeRepository->update($employee, $data);
    }

    public function destroy(Employee $employee): bool
    {
        return $this->employeeRepository->delete($employee);
    }

    public function employeeIdExists(string $employeeId, ?int $excludeId = null): bool
    {
        return $this->employeeRepository->employeeIdExists($employeeId, $excludeId);
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        return $this->employeeRepository->emailExists($email, $excludeId);
    }
}
