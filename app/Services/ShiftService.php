<?php

namespace App\Services;

use App\Models\Shift;
use App\Repositories\ShiftRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ShiftService
{
    public function __construct(
        protected ShiftRepository $shiftRepository
    ) {}

    public function index(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->shiftRepository->all($filters, $perPage);
    }

    public function show(int $id): Shift
    {
        $shift = $this->shiftRepository->find($id);
        if (!$shift) {
            abort(404, 'Shift not found');
        }
        return $shift;
    }

    public function store(array $data): Shift
    {
        return $this->shiftRepository->create($data);
    }

    public function update(Shift $shift, array $data): Shift
    {
        return $this->shiftRepository->update($shift, $data);
    }

    public function destroy(Shift $shift): bool
    {
        return $this->shiftRepository->delete($shift);
    }

    public function codeExists(string $code, ?int $excludeId = null): bool
    {
        return $this->shiftRepository->codeExists($code, $excludeId);
    }
}
