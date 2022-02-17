<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class IdentityPlatformProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\IdentityPlatform::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->identityPlatform();
        });
        $this->app->alias(Firebase\IdentityPlatform::class, 'firebase.identity_platform');
    }

    public function provides()
    {
        return [Firebase\IdentityPlatform::class, 'firebase.identity_platform'];
    }

}
