<?php

namespace App\Service;

use App\Contracts\VillageInterface;

class VillageService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private VillageInterface $villageRepository) {}

    public function count(): int
    {
        return $this->villageRepository->count();
    }

    public function getAllVillages(): array
    {
        return $this->villageRepository->getAllVillages();
    }

    public function getVillageWithWhere(array $conditions): ?array
    {
        return $this->villageRepository->getVillageWithWhere($conditions);
    }

    public function syncVillages(array $data): void
    {
        $this->villageRepository->syncVillages($data);
    }
}
