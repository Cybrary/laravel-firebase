<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class RemoteConfigServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\RemoteConfig::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->remoteConfig();
        });
        $this->app->alias(Firebase\RemoteConfig::class, 'firebase.remote_config');

    }

    public function provides()
    {
        return [Firebase\RemoteConfig::class, 'firebase.remote_config'];
    }

}
