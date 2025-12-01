<?php

namespace App\Repositories\Configuration;

use App\Contracts\Configuration\ConfigurationInterface;
use App\Models\Configuration;

class ConfigurationRepositories implements ConfigurationInterface
{
    public function get(string $key, $default = null){
        $config = Configuration::where('key', $key)->first();
        return $config ? $config->value : $default;
    }

    public function upsert(string $key, $value): void
    {
        Configuration::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
