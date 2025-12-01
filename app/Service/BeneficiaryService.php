<?php

namespace App\Service;

use App\Contracts\BeneficiaryInterface;

class BeneficiaryService
{
    public function __construct(private BeneficiaryInterface $beneficiaryRepository) {}

    public function count(): int
    {
        return $this->beneficiaryRepository->count();
    }

    public function getAllBeneficiaires(): array
    {
        return $this->beneficiaryRepository->getAllBeneficiaires();
    }

    public function getBeneficiairesWithWhere(array $conditions): ?array
    {
        return $this->beneficiaryRepository->getBeneficiairesWithWhere($conditions);
    }

    public function syncBeneficiaires(array $data): void
    {
        $this->beneficiaryRepository->syncBeneficiaires($data);
    }
}
