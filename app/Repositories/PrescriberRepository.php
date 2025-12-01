<?php

namespace App\Repositories;

use App\Contracts\PrescriberInterface;
use App\Models\Prescriber;

class PrescriberRepository implements PrescriberInterface
{
    public function count(): int
    {
        return Prescriber::count();
    }
    public function getAllPrescribers(): array
    {
        return Prescriber::all()->toArray();
    }

    public function getPrescribersWithWhere(array $conditions): ?array
    {
        $query = Prescriber::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncPrescribers(array $data): void
    {
        foreach ($data as $prescriber) {
            Prescriber::updateOrCreate(
                ['server_id' => $prescriber['id']],
                $prescriber
            );
        }
    }
}
