<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;


final class StoragePlatformProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\Storage::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->storage();
        });
        $this->app->alias(Firebase\Storage::class, 'firebase.storage');
    }

    public function provides()
    {
        return [Firebase\Storage::class, 'firebase.storage'];
    }

}
