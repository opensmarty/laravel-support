<?php

namespace ElfSundae\Laravel\Support\Providers;

use Illuminate\Support\ServiceProvider;
use ElfSundae\Laravel\Api\ApiServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        array_map([$this->app, 'register'], $this->getServiceProviders());
    }

    /**
     * Get service providers to be registered.
     *
     * @return array
     */
    protected function getServiceProviders()
    {
        $providers = [
            ApiServiceProvider::class,
            AppConfigServiceProvider::class,
            CaptchaServiceProvider::class,
            ClientServiceProvider::class,
            OptimusServiceProvider::class,
            RoutingServiceProvider::class,
            XgPusherServiceProvider::class,
        ];

        if ($this->app->runningInConsole()) {
            array_push(
                $providers,
                ConsoleServiceProvider::class,
                \Laravel\Tinker\TinkerServiceProvider::class,
                \Spatie\Backup\BackupServiceProvider::class
            );
        }

        if ($this->app->isLocal()) {
            array_push(
                $providers,
                \Barryvdh\Debugbar\ServiceProvider::class,
                \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class
            );
        }

        return $providers;
    }
}