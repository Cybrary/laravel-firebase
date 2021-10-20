<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Laravel\Lumen\Application as Lumen;
use Illuminate\Contracts\Support\DeferrableProvider;

final class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    public function boot()
    {
        // @codeCoverageIgnoreStart
        if (!$this->app->runningInConsole()) {
            return;
        }

        if ($this->app instanceof Lumen) {
            return;
        }
        // @codeCoverageIgnoreEnd

        $this->publishes([
            __DIR__.'/../config/firebase.php' => $this->app->configPath('firebase.php'),
        ], 'config');
    }

    public function register()
    {
        // @codeCoverageIgnoreStart
        if ($this->app instanceof Lumen) {
            $this->app->configure('firebase');
        }
        // @codeCoverageIgnoreEnd

        $this->mergeConfigFrom(__DIR__.'/../config/firebase.php', 'firebase');

        $this->registerManager();

    }

    private function registerManager(): void
    {
        $this->app->singleton(FirebaseProjectManager::class, static function (Container $app) {
            return new FirebaseProjectManager($app);
        });
        $this->app->alias(FirebaseProjectManager::class, 'firebase.manager');
    }

    public function provides()
    {
        return [FirebaseProjectManager::class, 'firebase.manager'];
    }
}
