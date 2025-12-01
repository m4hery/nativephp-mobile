<?php

namespace App\Contracts;

interface StructureInterface
{
    public function count(): int;
    public function getAllStructures(): array;
    public function getStructuresWithWhere(array $conditions): ?array;
    public function syncStructures(array $data): void;
}
