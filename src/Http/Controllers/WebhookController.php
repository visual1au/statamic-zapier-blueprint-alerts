<?php

namespace ZapierBlueprintAlerts\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function check(Request $request, $form)
    {
        $hasZapierWebhooks = false;
        
        // Check if the Zapier addon is installed and form has webhooks
        if (class_exists(\GertTimmerman\StatamicZapier\Webhooks::class)) {
            try {
                $webhooks = \GertTimmerman\StatamicZapier\Webhooks::byForm($form);
                $hasZapierWebhooks = !empty($webhooks);
            } catch (\Exception $e) {
                // Silently handle any errors - addon might not be properly configured
                $hasZapierWebhooks = false;
            }
        }

        return response()->json([
            'hasWebhooks' => $hasZapierWebhooks
        ]);
    }
}