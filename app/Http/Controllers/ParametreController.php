<?php

namespace App\Http\Controllers;

use App\Service\AidRequestService;
use App\Service\BeneficiaryService;
use App\Service\DistributionService;
use App\Service\DistributionSessionService;
use App\Service\FolderService;
use App\Service\OrentationService;
use App\Service\PrescriberService;
use App\Service\StructureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Service\Syncronisation\GlobalSyncronisationService;
use App\Service\VillageService;

class ParametreController extends Controller
{

    public function __construct(
        private GlobalSyncronisationService $syncronisationService,
        private VillageService $villageService,
        private StructureService $structureService,
        private PrescriberService $prescriberService,
        private OrentationService $orientationService,
        private FolderService $folderService,
        private DistributionSessionService $distributionSessionService,
        private DistributionService $distributionService,
        private BeneficiaryService $beneficiaryService,
        private AidRequestService $aidRequestService,
    ) {}

    public function index()
    {
        return view('parametre.index', [
            'totalVillages' => $this->villageService->count(),
            'totalStructures' => $this->structureService->count(),
            'totalPrescribers' => $this->prescriberService->count(),
            'totalOrientations' => $this->orientationService->count(),
            'totalFolders' => $this->folderService->count(),
            'totalDistributionSessions' => $this->distributionSessionService->count(),
            'totalDistributions' => $this->distributionService->count(),
            'totalBeneficiaries' => $this->beneficiaryService->count(),
            'totalAidRequests' => $this->aidRequestService->count(),
        ]);
    }

    public function syncAll(Request $request)
    {
        try {
            $result = $this->syncronisationService->syncAll();

            return redirect()
                ->route('parametre.index')
                ->with('success', 'Synchronisation globale terminée.');
        } catch (\Exception $e) {

            // Log::error('Erreur lors de la synchronisation globale', [
            //     'message' => $e->getMessage(),
            //     'trace'   => $e->getTraceAsString(),
            // ]);

            $message = config('app.debug')
                ? 'Erreur lors de la synchronisation globale : ' . $e->getMessage()
                : 'Erreur lors de la synchronisation globale. Veuillez réessayer plus tard.';

            return redirect()
                ->back()
                ->with('error', $message);
        }
    }
}
