<?php

declare(strict_types=1);

namespace Kreait\Laravel\Firebase;

use Illuminate\Contracts\Container\Container;
use Kreait\Firebase;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class DynamicLinksServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(Firebase\DynamicLinks::class, static function (Container $app) {
            return $app->make(FirebaseProjectManager::class)->project()->dynamicLinks();
        });
        $this->app->alias(Firebase\DynamicLinks::class, 'firebase.dynamic_links');
    }

    public function provides()
    {
        return [Firebase\DynamicLinks::class, 'firebase.dynamic_links'];
    }

}
