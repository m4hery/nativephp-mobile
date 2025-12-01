<?php

namespace App\Repositories;

use App\Contracts\DistributionInterface;
use App\Models\Distribution;

class DistributionRepository implements DistributionInterface
{

    public function count(): int
    {
        return Distribution::count();
    }

    public function getAllDistributions(): array
    {
        return Distribution::all()->toArray();
    }

    public function getDistributionsWithWhere(array $conditions): ?array
    {
        $query = Distribution::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncDistributions(array $data): void
    {
        foreach ($data as $distribution) {
            Distribution::updateOrCreate(
                ['server_id' => $distribution['id']],
                $distribution
            );
        }
    }
}
