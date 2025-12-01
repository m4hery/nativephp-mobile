<?php

namespace App\Contracts;

interface VillageInterface
{
    public function count(): int;
    public function getAllVillages(): array;
    public function getVillageWithWhere(array $conditions): ?array;
    public function syncVillages(array $data): void;
}
