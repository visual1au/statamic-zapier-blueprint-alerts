<?php

namespace ZapierBlueprintAlerts;

use Illuminate\Support\Facades\View;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom($this->getAddonPath('resources/views'), 'zapier-blueprint-alerts');
        
        // Add view composer to inject Zapier webhook data into form blueprint edit pages
        View::composer('statamic::forms.blueprints.edit', function ($view) {
            $form = $view->getData()['form'] ?? null;
            
            if (!$form) {
                return;
            }

            $hasZapierWebhooks = false;
            
            // Check if the Zapier addon is installed and form has webhooks
            if (class_exists(\GertTimmerman\StatamicZapier\Webhooks::class)) {
                try {
                    $webhooks = \GertTimmerman\StatamicZapier\Webhooks::byForm($form->handle());
                    $hasZapierWebhooks = !empty($webhooks);
                } catch (\Exception $e) {
                    // Silently handle any errors - addon might not be properly configured
                    $hasZapierWebhooks = false;
                }
            }

            $view->with('hasZapierWebhooks', $hasZapierWebhooks);
        });
    }

    protected function getAddonPath($path = '')
    {
        return __DIR__ . '/../' . ltrim($path, '/');
    }
}