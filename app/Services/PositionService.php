<?php

namespace App\Services;

use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PositionService
{
    public function __construct(
        protected PositionRepository $positionRepository
    ) {}

    public function index(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->positionRepository->all($filters, $perPage);
    }

    public function show(int $id): Position
    {
        $position = $this->positionRepository->find($id);
        if (!$position) {
            abort(404, 'Position not found');
        }
        return $position;
    }

    public function store(array $data): Position
    {
        return $this->positionRepository->create($data);
    }

    public function update(Position $position, array $data): Position
    {
        return $this->positionRepository->update($position, $data);
    }

    public function destroy(Position $position): bool
    {
        return $this->positionRepository->delete($position);
    }

    public function codeExists(string $code, ?int $excludeId = null): bool
    {
        return $this->positionRepository->codeExists($code, $excludeId);
    }
}
