<?php

namespace App\Contracts;

interface OrientationInterface
{
    public function count(): int;
    public function getAllOrientations(): array;
    public function getOrientationsWithWhere(array $conditions): ?array;
    public function syncOrientations(array $data): void;
}
