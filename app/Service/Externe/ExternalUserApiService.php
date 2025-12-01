<?php

namespace App\Service\Externe;

use App\Enum\ConfigurationEnum;
use GuzzleHttp\Client;
use App\Contracts\Externe\ExternalUserApiInterface;
use App\Service\Configuration\ConfigurationService;

class ExternalUserApiService implements ExternalUserApiInterface
{
    protected Client $clientHttp;
    protected string $baseUrl;
    protected ConfigurationService $configurationService;

    public function __construct(Client $clientHttp, ConfigurationService $configurationService)
    {
        $this->clientHttp = $clientHttp;
        $this->baseUrl = rtrim(env('APP_WEB_URL'), '/').'/user';
        $this->configurationService = $configurationService;
    }

    public function fetchNumberPageUsers(): int
    {
        $response = $this->clientHttp->get($this->baseUrl . '/totalpage');
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['total_pages'] ?? 0;
    }

    public function fetchUsersByPage(int $page): array
    {
        $lastSync = $this->configurationService->get(ConfigurationEnum::LAST_SYNCED_USERS->value, null);
        $params = [];
        if ($lastSync) {
            $params['last_sync'] = $lastSync;
        }
        $params['page'] = $page;
        $response = $this->clientHttp->get($this->baseUrl . '/list', [
            'query' => $params,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['users'] ?? [];
    }
}
