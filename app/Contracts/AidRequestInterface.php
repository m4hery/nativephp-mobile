<?php

namespace App\Contracts;

interface AidRequestInterface
{
    public function count(): int;
    public function getAllAidRequests(): array;
    public function getAidRequestsWithWhere(array $conditions): ?array;
    public function syncAidRequests(array $data): void;
}
