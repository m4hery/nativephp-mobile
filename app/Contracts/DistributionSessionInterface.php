<?php

namespace App\Contracts;

interface DistributionSessionInterface
{
    public function count(): int;
    public function getAllDistributionSessions(): array;
    public function getDistributionSessionsWithWhere(array $conditions): ?array;
    public function syncDistributionSessions(array $data): void;
}
