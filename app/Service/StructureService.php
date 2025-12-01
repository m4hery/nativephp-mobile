<?php

namespace App\Service;

use App\Contracts\StructureInterface;

class StructureService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private StructureInterface $structureRepository) {}

    public function count(): int
    {
        return $this->structureRepository->count();
    }

    public function getAllStructures(): array
    {
        return $this->structureRepository->getAllStructures();
    }

    public function getStructuresWithWhere(array $conditions): ?array
    {
        return $this->structureRepository->getStructuresWithWhere($conditions);
    }

    public function syncStructures(array $data): void
    {
        $this->structureRepository->syncStructures($data);
    }
}
