<?php

namespace App\Repositories;

use App\Contracts\AidRequestInterface;
use App\Models\AidRequest;

class AidRequestRepository implements AidRequestInterface
{

    public function count(): int
    {
        return AidRequest::count();
    }

    public function getAllAidRequests(): array
    {
        return AidRequest::all()->toArray();
    }

    public function getAidRequestsWithWhere(array $conditions): ?array
    {
        $query = AidRequest::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncAidRequests(array $data): void
    {
        foreach ($data as $aidRequest) {
            AidRequest::updateOrCreate(
                ['server_id' => $aidRequest['id']],
                $aidRequest
            );
        }
    }
}
