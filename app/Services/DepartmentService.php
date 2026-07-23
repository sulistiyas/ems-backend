<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $departmentRepository
    ) {}

    public function index(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->departmentRepository->all($filters, $perPage);
    }

    public function show(int $id): Department
    {
        $department = $this->departmentRepository->find($id);
        if (!$department) {
            abort(404, 'Department not found');
        }
        return $department;
    }

    public function store(array $data): Department
    {
        return $this->departmentRepository->create($data);
    }

    public function update(Department $department, array $data): Department
    {
        return $this->departmentRepository->update($department, $data);
    }

    public function destroy(Department $department): bool
    {
        return $this->departmentRepository->delete($department);
    }

    public function codeExists(string $code, ?int $excludeId = null): bool
    {
        return $this->departmentRepository->codeExists($code, $excludeId);
    }
}
