# Statamic Zapier Alerts

A Statamic addon that displays warning alerts on form blueprint edit pages when Zapier webhooks are configured for that form.

## Features

-   Automatically detects forms with configured Zapier webhooks
-   Shows a prominent warning alert on the blueprint edit page
-   Reminds users to update their Zaps when making field changes

## Requirements

-   PHP ^8.1
-   Statamic ^5.0
-   [gerttimmerman/statamic-zapier](https://github.com/gerttimmerman/statamic-zapier) package

## Installation

1. Install via Composer:

```bash
composer require visual1au/statamic-zapier-alerts
```

2. Publish the views (this will override Statamic's default form blueprint edit view):

```bash
php artisan vendor:publish --provider="Visual1au\StatamicZapierAlerts\ServiceProvider" --tag="views"
```

## How it works

The addon:

1. Uses a view composer to check if forms have Zapier webhooks configured
2. Overrides Statamic's default form blueprint edit view
3. Displays a warning alert when webhooks are detected

## Usage

Once installed, the alerts will automatically appear on any form blueprint edit page where Zapier webhooks are configured in your `content/zapier-webhooks.yaml` file.

## Configuration

No additional configuration required. The addon automatically detects webhooks from the gerttimmerman/statamic-zapier package.
