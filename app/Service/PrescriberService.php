<?php

namespace App\Service;

use App\Contracts\PrescriberInterface;

class PrescriberService
{
    public function __construct(private PrescriberInterface $prescriberRepository) {}

    public function count(): int
    {
        return $this->prescriberRepository->count();
    }

    public function getAllPrescribers(): array
    {
        return $this->prescriberRepository->getAllPrescribers();
    }

    public function getPrescribersWithWhere(array $conditions): ?array
    {
        return $this->prescriberRepository->getPrescribersWithWhere($conditions);
    }

    public function syncPrescribers(array $data): void
    {
        $this->prescriberRepository->syncPrescribers($data);
    }
}
