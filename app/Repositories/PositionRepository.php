<?php

namespace App\Repositories;

use App\Models\Position;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PositionRepository
{
    public function all(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Position::query();

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'ilike', "%{$filters['search']}%")
                  ->orWhere('code', 'ilike', "%{$filters['search']}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function find(int $id): ?Position
    {
        return Position::find($id);
    }

    public function create(array $data): Position
    {
        return Position::create($data);
    }

    public function update(Position $position, array $data): Position
    {
        $position->update($data);
        return $position->fresh();
    }

    public function delete(Position $position): bool
    {
        return $position->delete();
    }

    public function codeExists(string $code, ?int $excludeId = null): bool
    {
        $query = Position::where('code', $code);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
