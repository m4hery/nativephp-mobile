<?php

namespace App\Repositories;

use App\Contracts\DistributionSessionInterface;
use App\Models\DistributionSession;

class DistributionSessionRepository implements DistributionSessionInterface
{

    public function count(): int
    {
        return DistributionSession::count();
    }

    public function getAllDistributionSessions(): array
    {
        return DistributionSession::all()->toArray();
    }

    public function getDistributionSessionsWithWhere(array $conditions): ?array
    {
        $query = DistributionSession::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncDistributionSessions(array $data): void
    {
        foreach ($data as $session) {
            DistributionSession::updateOrCreate(
                ['server_id' => $session['id']],
                $session
            );
        }
    }
}
