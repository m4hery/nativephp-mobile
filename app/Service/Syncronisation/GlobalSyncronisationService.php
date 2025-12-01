<?php

namespace App\Service\Syncronisation;

use App\Service\FolderService;
use App\Service\VillageService;
use App\Service\StructureService;
use App\Service\AidRequestService;
use App\Service\OrentationService;
use App\Service\PrescriberService;
use Illuminate\Support\Facades\DB;
use App\Service\BeneficiaryService;
use App\Service\DistributionService;
use App\Service\DistributionSessionService;
use App\Contracts\Externe\ExterneApiInterface;
use App\Enum\ConfigurationEnum;
use App\Service\Configuration\ConfigurationService;

class GlobalSyncronisationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ExterneApiInterface $externeApiService,
        private VillageService $villageService,
        private BeneficiaryService $beneficiaryService,
        private DistributionSessionService $distributionSessionService,
        private OrentationService $orientationService,
        private StructureService $structureService,
        private PrescriberService $prescriberService,
        private FolderService $folderService,
        private AidRequestService $aidRequestService,
        private DistributionService $distributionService,
        private ConfigurationService $configurationService,
    ) {}

    public function syncVillages()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberVillage();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $villages = $this->externeApiService->fetchVillagesByPage($page);
                $this->villageService->syncVillages($villages);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_VILLAGE->value, date('Y-m-d H:i:s'));
    }

    public function syncBeneficiaires()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberBeneficiaires();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $beneficiaires = $this->externeApiService->fetchBeneficiairesByPage($page);
                $this->beneficiaryService->syncBeneficiaires($beneficiaires);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_BENEFICIARY->value, date('Y-m-d H:i:s'));
    }

    public function syncDistributionSessions()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberDistributionSessions();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $distributionSessions = $this->externeApiService->fetchDistributionSessionsByPage($page);
                $this->distributionSessionService->syncDistributionSessions($distributionSessions);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS_SESSIONS->value, date('Y-m-d H:i:s'));
    }

    public function syncOrientations()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberOrientations();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $orientations = $this->externeApiService->fetchOrientationsByPage($page);
                $this->orientationService->syncOrientations($orientations);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_ORIENTATIONS->value, date('Y-m-d H:i:s'));
    }

    public function syncStructures()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberStructures();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $structures = $this->externeApiService->fetchStructuresByPage($page);
                $this->structureService->syncStructures($structures);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_STRUCTURES->value, date('Y-m-d H:i:s'));
    }

    public function syncPrescribers()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberPrescribers();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $prescribers = $this->externeApiService->fetchPrescribersByPage($page);
                $this->prescriberService->syncPrescribers($prescribers);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_PRESCRIBERS->value, date('Y-m-d H:i:s'));
    }

    public function syncFolders()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberFolders();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $folders = $this->externeApiService->fetchFoldersByPage($page);
                $this->folderService->syncFolders($folders);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_FOLDERS->value, date('Y-m-d H:i:s'));
    }

    public function syncAidRequests()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberAidRequests();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $aidRequests = $this->externeApiService->fetchAidRequestsByPage($page);
                $this->aidRequestService->syncAidRequests($aidRequests);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_AIDS->value, date('Y-m-d H:i:s'));
    }

    public function syncDistributions()
    {
        DB::beginTransaction();
        $totalPages = $this->externeApiService->fetchNumberDistributions();
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $distributions = $this->externeApiService->fetchDistributionsByPage($page);
                $this->distributionService->syncDistributions($distributions);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS->value, date('Y-m-d H:i:s'));
    }

    public function syncAll()
    {
        $this->syncVillages();
        $this->syncBeneficiaires();
        $this->syncDistributionSessions();
        $this->syncOrientations();
        $this->syncStructures();
        $this->syncPrescribers();
        $this->syncFolders();
        $this->syncAidRequests();
        $this->syncDistributions();
    }
}
