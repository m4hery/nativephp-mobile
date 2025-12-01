<?php

namespace App\Repositories;

use App\Contracts\FolderInterface;
use App\Models\Folder;

class FolderRepository implements FolderInterface
{
    public function count(): int
    {
        return Folder::count();
    }

    public function getAllFolders(): array
    {
        return Folder::all()->toArray();
    }

    public function getFoldersWithWhere(array $conditions): ?array
    {
        $query = Folder::query();
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        return $query->get()?->toArray() ?? null;
    }

    public function syncFolders(array $data): void
    {
        foreach ($data as $folder) {
            Folder::updateOrCreate(
                ['server_id' => $folder['id']],
                $folder
            );
        }
    }
}
