<?php

namespace App\Contracts;

interface PrescriberInterface
{
    public function count(): int;
    public function getAllPrescribers(): array;
    public function getPrescribersWithWhere(array $conditions): ?array;
    public function syncPrescribers(array $data): void;
}
