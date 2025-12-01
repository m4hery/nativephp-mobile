<?php

namespace App\Contracts;

interface DistributionInterface
{
    public function count(): int;
    public function getAllDistributions(): array;
    public function getDistributionsWithWhere(array $conditions): ?array;
    public function syncDistributions(array $data): void;
}
