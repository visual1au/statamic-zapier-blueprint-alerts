# Statamic Zapier Blueprint Alerts

A Statamic addon that displays warning alerts on form blueprint edit pages when Zapier webhooks are configured for the form.

## Features

- 🚨 Automatically detects forms with Zapier webhooks configured
- ⚠️ Shows warning alerts on blueprint edit pages
- 🎨 Clean, consistent styling with Statamic's design system
- 🔧 Zero configuration required
- 🛡️ Safe fallback when Zapier addon is not installed

## Requirements

- PHP ^8.1
- Statamic ^4.0 or ^5.0
- [gerttimmerman/statamic-zapier](https://github.com/gerttimmerman/statamic-zapier) (optional but recommended)

## Installation

### Via Composer (Recommended)

```bash
composer require visual1au/statamic-zapier-blueprint-alerts
```

That's it! The addon will be automatically registered with Laravel's package discovery.

### Manual Installation

1. Clone this repository into your `addons` directory:

```bash
git clone https://github.com/visual1au/statamic-zapier-blueprint-alerts.git addons/zapier-blueprint-alerts
```

2. Add the PSR-4 autoload to your `composer.json`:

```json
"autoload": {
    "psr-4": {
        "ZapierBlueprintAlerts\\": "addons/zapier-blueprint-alerts/src/"
    }
}
```

3. Register the service provider in your `AppServiceProvider`:

```php
public function register(): void
{
    $this->app->register(\ZapierBlueprintAlerts\ServiceProvider::class);
}
```

4. Run `composer dump-autoload`

## Usage

Once installed, the addon works automatically:

1. Navigate to any form's blueprint edit page (`/cp/forms/{form}/blueprint`)
2. If the form has Zapier webhooks configured, you'll see a yellow warning alert
3. The alert reminds users to update their Zaps when changing form fields

## How It Works

The addon uses a view composer to:

1. Check if the [Statamic Zapier addon](https://github.com/gerttimmerman/statamic-zapier) is installed
2. Query for webhooks associated with the current form
3. Inject a `hasZapierWebhooks` variable into the blueprint edit view
4. Display the alert component when webhooks are found

## Customization

### Alert Message

To customize the alert message, publish the views:

```bash
php artisan vendor:publish --tag=zapier-blueprint-alerts-views
```

Then edit `resources/views/vendor/zapier-blueprint-alerts/alert.blade.php`.

### Alert Styling

The alert uses Tailwind CSS classes. You can customize the styling by modifying the alert component or overriding the CSS.

## License

MIT License. See [LICENSE](LICENSE) for details.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.