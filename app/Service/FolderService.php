<?php

namespace App\Service;

use App\Contracts\FolderInterface;

class FolderService
{
    public function __construct(private FolderInterface $folderRepository) {}

    public function count(): int
    {
        return $this->folderRepository->count();
    }

    public function getAllFolders(): array
    {
        return $this->folderRepository->getAllFolders();
    }

    public function getFoldersWithWhere(array $conditions): ?array
    {
        return $this->folderRepository->getFoldersWithWhere($conditions);
    }

    public function syncFolders(array $data): void
    {
        $this->folderRepository->syncFolders($data);
    }
}
