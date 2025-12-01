<?php

namespace App\Repositories;

use App\Contracts\BeneficiaryInterface;
use App\Models\Beneficary;

class BeneficiaryRepository implements BeneficiaryInterface
{
    public function count(): int
    {
        return Beneficary::count();
    }

    public function getAllBeneficiaires(): array
    {
        return Beneficary::all()->toArray();
    }

    public function getBeneficiairesWithWhere(array $conditions): ?array
    {
        $query = Beneficary::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncBeneficiaires(array $data): void
    {
        foreach ($data as $beneficiary) {
            Beneficary::updateOrCreate(
                ['server_id' => $beneficiary['id']],
                $beneficiary
            );
        }
    }
}
