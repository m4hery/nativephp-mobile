<?php

namespace App\Providers;

use App\Contracts\AidRequestInterface;
use App\Service\LoginService;
use App\Contracts\LoginInterface;
use App\Contracts\VillageInterface;
use App\Contracts\StructureInterface;
use Illuminate\Support\Facades\Schema;
use App\Contracts\BeneficiaryInterface;
use App\Contracts\OrientationInterface;
use App\Repositories\VillageRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use App\Repositories\StructureRepository;
use App\Service\Externe\ExterneApiService;
use App\Repositories\BeneficiaryRepository;
use App\Repositories\OrientationRepository;
use App\Contracts\Externe\ExterneApiInterface;
use App\Contracts\DistributionSessionInterface;
use App\Service\Externe\ExternalUserApiService;
use App\Contracts\Externe\ExternalUserApiInterface;
use App\Repositories\DistributionSessionRepository;
use App\Contracts\Configuration\ConfigurationInterface;
use App\Contracts\DistributionInterface;
use App\Contracts\FolderInterface;
use App\Contracts\PrescriberInterface;
use App\Contracts\Syncronisation\UserSyncronisationInterface;
use App\Repositories\AidRequestRepository;
use App\Repositories\Configuration\ConfigurationRepositories;
use App\Repositories\DistributionRepository;
use App\Repositories\FolderRepository;
use App\Repositories\PrescriberRepository;
use App\Repositories\Syncronisation\UserSyncronisationRepositories;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserSyncronisationInterface::class, UserSyncronisationRepositories::class);
        $this->app->bind(ExternalUserApiInterface::class, ExternalUserApiService::class);
        $this->app->bind(ConfigurationInterface::class, ConfigurationRepositories::class);
        $this->app->bind(LoginInterface::class, LoginService::class);
        $this->app->bind(ExterneApiInterface::class, ExterneApiService::class);
        $this->app->bind(VillageInterface::class, VillageRepository::class);
        $this->app->bind(BeneficiaryInterface::class, BeneficiaryRepository::class);
        $this->app->bind(DistributionSessionInterface::class, DistributionSessionRepository::class);
        $this->app->bind(OrientationInterface::class, OrientationRepository::class);
        $this->app->bind(StructureInterface::class, StructureRepository::class);
        $this->app->bind(PrescriberInterface::class, PrescriberRepository::class);
        $this->app->bind(FolderInterface::class, FolderRepository::class);
        $this->app->bind(AidRequestInterface::class, AidRequestRepository::class);
        $this->app->bind(DistributionInterface::class, DistributionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!Schema::hasTable('migrations')) {
            Artisan::call('migrate', ['--force' => true]);
        }

        $tmp = storage_path('tmp');

        if (!file_exists($tmp)) {
            mkdir($tmp, 0775, true);
        }

        putenv("TMPDIR=$tmp");
        putenv("TMP=$tmp");
        putenv("TEMP=$tmp");
    }
}
