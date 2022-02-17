<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class FirestoreServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\Firestore::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->firestore();
        });
        $this->app->alias(Firebase\Firestore::class, 'firebase.firestore');

    }

    public function provides()
    {
        return [Firebase\Firestore::class, 'firebase.firestore'];
    }

}
