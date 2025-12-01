<?php

namespace App\Repositories;

use App\Contracts\OrientationInterface;
use App\Models\Orientation;

class OrientationRepository implements OrientationInterface
{
    public function count(): int
    {
        return Orientation::count();
    }

    public function getAllOrientations(): array
    {
        return Orientation::all()->toArray();
    }

    public function getOrientationsWithWhere(array $conditions): ?array
    {
        $query = Orientation::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncOrientations(array $data): void
    {
        foreach ($data as $orientation) {
            Orientation::updateOrCreate(
                ['server_id' => $orientation['id']],
                $orientation
            );
        }
    }
}
