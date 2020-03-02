<?php

namespace Oxygencms\Phrases;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * todo: load model and policy from config instead
     *
     * @var array
     */
    protected $policies = [
        \Oxygencms\Phrases\Models\Phrase::class => \Oxygencms\Phrases\Policies\PhrasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
