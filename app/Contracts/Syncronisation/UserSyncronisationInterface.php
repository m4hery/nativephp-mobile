<?php

namespace App\Contracts\Syncronisation;

interface UserSyncronisationInterface
{
    public function syncUsers(array $data);
}
