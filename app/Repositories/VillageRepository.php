<?php

namespace App\Repositories;

use App\Contracts\VillageInterface;
use App\Models\Village;

class VillageRepository implements VillageInterface
{
    public function count(): int
    {
        return Village::count();
    }

    public function getAllVillages(): array
    {
        return Village::all()->toArray();
    }

    public function getVillageWithWhere(array $conditions): ?array
    {
        $query = Village::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncVillages(array $data): void
    {
        foreach ($data as $village) {
            Village::updateOrCreate(
                ['server_id' => $village['id']],
                $village
            );
        }
    }
}
