<?php

namespace App\Http\Controllers;

use App\Service\Syncronisation\UserSyncronisationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyncronisationController extends Controller
{
    public function __construct(protected UserSyncronisationService $userService){}

    public function syncUsers(Request $request)
    {
        try {
            $synced = $this->userService->syncUsers();
            return response()->json([
                'success' => true,
                'message' => 'Synchronisation des utilisateurs terminée. Total utilisateurs synchronisés : ' . $synced,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la synchronisation des utilisateurs: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => config('app.debug') ? $e->getMessage() : 'Une erreur interne est survenue.'
            ], 500);
        }
    }
}
