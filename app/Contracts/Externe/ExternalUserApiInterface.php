<?php

namespace App\Contracts\Externe;

interface ExternalUserApiInterface
{
    public function fetchNumberPageUsers(): int;

    public function fetchUsersByPage(int $page): array;
}
