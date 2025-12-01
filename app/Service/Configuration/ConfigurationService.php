<?php

namespace App\Service\Configuration;

use App\Contracts\Configuration\ConfigurationInterface;

class ConfigurationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ConfigurationInterface $configuationRepository)
    {
        //
    }

    public function get(string $key, $default = null)
    {
        return $this->configuationRepository->get($key, $default);
    }

    public function upsert(string $key, $value): void
    {
        $this->configuationRepository->upsert($key, $value);
    }
}
