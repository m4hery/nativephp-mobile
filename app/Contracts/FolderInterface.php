<?php

namespace App\Contracts;

interface FolderInterface
{
    public function count(): int;
    public function getAllFolders(): array;
    public function getFoldersWithWhere(array $conditions): ?array;
    public function syncFolders(array $data): void;
}
