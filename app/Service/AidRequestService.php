<?php

namespace App\Service;

use App\Contracts\AidRequestInterface;

class AidRequestService
{
    public function __construct(private AidRequestInterface $aidRequestRepository) {}

    public function count(): int {
        return $this->aidRequestRepository->count();
    }

    public function getAllAidRequests(): array
    {
        return $this->aidRequestRepository->getAllAidRequests();
    }

    public function getAidRequestsWithWhere(array $conditions): ?array
    {
        return $this->aidRequestRepository->getAidRequestsWithWhere($conditions);
    }

    public function syncAidRequests(array $data): void
    {
        $this->aidRequestRepository->syncAidRequests($data);
    }
}
