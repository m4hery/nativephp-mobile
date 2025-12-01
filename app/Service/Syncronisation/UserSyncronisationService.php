<?php

namespace App\Service\Syncronisation;

use App\Enum\ConfigurationEnum;
use Illuminate\Support\Facades\DB;
use App\Contracts\Externe\ExternalUserApiInterface;
use App\Service\Configuration\ConfigurationService;
use App\Contracts\Syncronisation\UserSyncronisationInterface;

class UserSyncronisationService
{
    protected UserSyncronisationInterface $userSyncronisationRepository;
    protected ExternalUserApiInterface $externalUserApiClient;
    protected ConfigurationService $configurationService;

    public function __construct(
        UserSyncronisationInterface $userSyncronisationRepository,
        ExternalUserApiInterface $externalUserApiClient,
        ConfigurationService $configurationService
    ) {
        $this->userSyncronisationRepository = $userSyncronisationRepository;
        $this->externalUserApiClient = $externalUserApiClient;
        $this->configurationService = $configurationService;
    }

    public function syncUsers()
    {
        $totalPages = $this->externalUserApiClient->fetchNumberPageUsers();
        DB::beginTransaction();
        $userAdd = 0;
        try {
            for ($page = 1; $page <= $totalPages; $page++) {
                $users = $this->externalUserApiClient->fetchUsersByPage($page);
                $this->userSyncronisationRepository->syncUsers($users);
                $userAdd += count($users);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        $this->configurationService->upsert(ConfigurationEnum::LAST_SYNCED_USERS->value, date('Y-m-d H:i:s'));
        return $userAdd;
    }
}
