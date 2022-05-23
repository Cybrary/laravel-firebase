<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class MessagingServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\Messaging::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->messaging();
        });
        $this->app->alias(Firebase\Messaging::class, 'firebase.messaging');
    }

    public function provides()
    {
        return [Firebase\Messaging::class, 'firebase.messaging'];
    }

}
