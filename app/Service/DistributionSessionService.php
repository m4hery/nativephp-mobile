<?php

namespace App\Service;

use App\Contracts\DistributionSessionInterface;

class DistributionSessionService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private DistributionSessionInterface $distributionSessionRepository) {}

    public function count(): int
    {
        return $this->distributionSessionRepository->count();
    }

    public function getAllDistributionSessions(): array
    {
        return $this->distributionSessionRepository->getAllDistributionSessions();
    }

    public function getDistributionSessionsWithWhere(array $conditions): ?array
    {
        return $this->distributionSessionRepository->getDistributionSessionsWithWhere($conditions);
    }

    public function syncDistributionSessions(array $data): void
    {
        $this->distributionSessionRepository->syncDistributionSessions($data);
    }
}
