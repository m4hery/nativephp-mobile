<?php

namespace App\Contracts\Configuration;

interface ConfigurationInterface
{
    public function get(string $key, $default = null);
    public function upsert(string $key, $value): void;
}
