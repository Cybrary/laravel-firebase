<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class AuthServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\Contract\Auth::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->auth();
        });
        $this->app->alias(Firebase\Contract\Auth::class, Firebase\Auth::class);
        $this->app->alias(Firebase\Contract\Auth::class, 'firebase.auth');
    }

    public function provides()
    {
        return [Firebase\Contract\Auth::class, Firebase\Auth::class, 'firebase.auth'];
    }

}
