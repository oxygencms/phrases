<?php

namespace Oxygencms\Phrases;

use Illuminate\Support\ServiceProvider;
use Oxygencms\Phrases\Services\PhraseLoader;

class PhraseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/translatable.php' => config_path('translatable.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/Views', 'oxygencms');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/oxygencms'),
        ], 'views');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(TranslationServiceProvider::class);

        $this->mergeConfigFrom(
            __DIR__.'/../config/translatable.php', 'translatable'
        );

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}
