<?php

namespace App\Service;

use App\Contracts\OrientationInterface;

class OrentationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private OrientationInterface $orientationRepository) {}

    public function count(): int
    {
        return $this->orientationRepository->count();
    }

    public function getAllOrientations(): array
    {
        return $this->orientationRepository->getAllOrientations();
    }

    public function getOrientationsWithWhere(array $conditions): ?array
    {
        return $this->orientationRepository->getOrientationsWithWhere($conditions);
    }

    public function syncOrientations(array $data): void
    {
        $this->orientationRepository->syncOrientations($data);
    }
}
