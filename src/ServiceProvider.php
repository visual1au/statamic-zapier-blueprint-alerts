<?php

namespace ZapierBlueprintAlerts;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../resources/js/addon.js'
    ];

    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom($this->getAddonPath('resources/views'), 'zapier-blueprint-alerts');
        
        // Register API route to check for Zapier webhooks
        Statamic::booted(function () {
            \Route::get('/cp/zapier-blueprint-alerts/check/{form}', [
                'uses' => '\ZapierBlueprintAlerts\Http\Controllers\WebhookController@check',
                'middleware' => ['statamic.cp.authenticated']
            ]);
        });
    }

    protected function getAddonPath($path = '')
    {
        return __DIR__ . '/../' . ltrim($path, '/');
    }
}