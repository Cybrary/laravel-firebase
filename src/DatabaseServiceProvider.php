<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class DatabaseServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\Database::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->database();
        });
        $this->app->alias(Firebase\Database::class, 'firebase.database');

    }

    public function provides()
    {
        return [Firebase\Database::class, 'firebase.database'];
    }

}
