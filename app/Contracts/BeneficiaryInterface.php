<?php

namespace App\Contracts;

interface BeneficiaryInterface
{
    public function count(): int;
    public function getAllBeneficiaires(): array;
    public function getBeneficiairesWithWhere(array $conditions): ?array;
    public function syncBeneficiaires(array $data): void;
}
