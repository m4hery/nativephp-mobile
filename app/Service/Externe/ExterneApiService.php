<?php

namespace App\Service\Externe;

use GuzzleHttp\Client;
use App\Enum\ConfigurationEnum;
use App\Contracts\Externe\ExterneApiInterface;
use App\Service\Configuration\ConfigurationService;

class ExterneApiService implements ExterneApiInterface
{
    protected Client $clientHttp;
    protected string $baseUrl;
    protected ConfigurationService $configurationService;

    public function __construct(Client $clientHttp, ConfigurationService $configurationService)
    {
        $this->clientHttp = $clientHttp;
        $this->baseUrl = rtrim(env('APP_WEB_URL'), '/');
        $this->configurationService = $configurationService;
    }

    public function fetchNumberVillage(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_VILLAGE->value, null);
        $url = $this->baseUrl . '/village/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchVillagesByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_VILLAGE->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/village/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['villages'] ?? [];
    }

    public function fetchNumberBeneficiaires(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_BENEFICIARY->value, null);
        $url = $this->baseUrl . '/beneficiaire/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchBeneficiairesByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_BENEFICIARY->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/beneficiaire/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['beneficiaires'] ?? [];
    }

    public function fetchNumberDistributionSessions(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS_SESSIONS->value, null);
        $url = $this->baseUrl . '/distribution-session/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchDistributionSessionsByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS_SESSIONS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/distribution-session/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['distribution_sessions'] ?? [];
    }

    public function fetchNumberOrientations(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_ORIENTATIONS->value, null);
        $url = $this->baseUrl . '/orientation/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchOrientationsByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_ORIENTATIONS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/orientation/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['orientations'] ?? [];
    }

    public function fetchNumberStructures(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_STRUCTURES->value, null);
        $url = $this->baseUrl . '/structure/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchStructuresByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_STRUCTURES->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/structure/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['structures'] ?? [];
    }

    public function fetchNumberPrescribers(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_PRESCRIBERS->value, null);
        $url = $this->baseUrl . '/prescriber/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchPrescribersByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_PRESCRIBERS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/prescriber/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['prescribers'] ?? [];
    }

    public function fetchNumberFolders(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_FOLDERS->value, null);
        $url = $this->baseUrl . '/folder/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchFoldersByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_FOLDERS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/folder/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['folders'] ?? [];
    }

    public function fetchNumberAidRequests(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_AIDS->value, null);
        $url = $this->baseUrl . '/aid-request/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }
    public function fetchAidRequestsByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_AIDS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/aid-request/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['aid_requests'] ?? [];
    }

    public function fetchNumberDistributions(): int {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS->value, null);
        $url = $this->baseUrl . '/distribution/totalpage';
        if ($lastSync) {
            $url .= '?last_sync=' . $lastSync;
        }
        $response = $this->clientHttp->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }

    public function fetchDistributionsByPage(int $page): array {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_DISTRIBUTIONS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/distribution/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['distributions'] ?? [];
    }

}
