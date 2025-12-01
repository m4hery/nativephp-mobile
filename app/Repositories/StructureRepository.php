<?php

namespace App\Repositories;

use App\Contracts\StructureInterface;
use App\Models\Structure;

class StructureRepository implements StructureInterface
{
    public function count(): int
    {
        return Structure::count();
    }

    public function getAllStructures(): array
    {
        return Structure::all()->toArray();
    }

    public function getStructuresWithWhere(array $conditions): ?array
    {
        $query = Structure::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncStructures(array $data): void
    {
        foreach ($data as $structure) {
            Structure::updateOrCreate(
                ['server_id' => $structure['id']],
                $structure
            );
        }
    }
}
