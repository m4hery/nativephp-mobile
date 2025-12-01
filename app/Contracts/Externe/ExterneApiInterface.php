<?php

namespace App\Contracts\Externe;

interface ExterneApiInterface
{
    public function fetchNumberVillage(): int;
    public function fetchVillagesByPage(int $page): array;

    public function fetchNumberBeneficiaires(): int;
    public function fetchBeneficiairesByPage(int $page): array;

    public function fetchNumberDistributionSessions(): int;
    public function fetchDistributionSessionsByPage(int $page): array;

    public function fetchNumberOrientations(): int;
    public function fetchOrientationsByPage(int $page): array;

    public function fetchNumberStructures(): int;
    public function fetchStructuresByPage(int $page): array;

    public function fetchNumberPrescribers(): int;
    public function fetchPrescribersByPage(int $page): array;

    public function fetchNumberFolders(): int;
    public function fetchFoldersByPage(int $page): array;

    public function fetchNumberAidRequests(): int;
    public function fetchAidRequestsByPage(int $page): array;

    public function fetchNumberDistributions(): int;
    public function fetchDistributionsByPage(int $page): array;
}
