<?php

namespace Oxygencms\Phrases;

use Illuminate\Translation\TranslationServiceProvider as ServiceProvider;
use Oxygencms\Phrases\Services\PhraseLoader;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new PhraseLoader($app['files'], $app['path.lang']);
        });
    }
}
