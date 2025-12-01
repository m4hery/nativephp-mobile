<?php

namespace App\Repositories\Syncronisation;

use App\Contracts\Syncronisation\UserSyncronisationInterface;
use App\Models\User;

class UserSyncronisationRepositories implements UserSyncronisationInterface
{
    public function syncUsers(array $data)
    {
        foreach ($data as $userData) {
            User::updateOrCreate(
                ['server_id' => $userData['id']],
                $userData
            );
        }
    }
}
