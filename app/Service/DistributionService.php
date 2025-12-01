<?php

namespace App\Service;

use App\Contracts\DistributionInterface;

class DistributionService
{
    public function __construct(private DistributionInterface $distributionRepository) {}

    public function count(): int
    {
        return $this->distributionRepository->count();
    }

    public function getAllDistributions(): array
    {
        return $this->distributionRepository->getAllDistributions();
    }

    public function getDistributionsWithWhere(array $conditions): ?array
    {
        return $this->distributionRepository->getDistributionsWithWhere($conditions);
    }

    public function syncDistributions(array $data): void
    {
        $this->distributionRepository->syncDistributions($data);
    }
}
