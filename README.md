# Webhook notifications channel for Laravel 5.3 ~ 5.8

[![Latest Version on Packagist](https://img.shields.io/packagist/v/miladnouri/laravel-notification-webhook.svg?style=flat-square)](https://packagist.org/packages/miladnouri/laravel-notification-webhook)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/miladnouri/laravel-notification-webhook/master.svg?style=flat-square)](https://travis-ci.org/miladnouri/laravel-notification-webhook)
[![StyleCI](https://styleci.io/repos/65685866/shield)](https://styleci.io/repos/65685866)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9015691f-130d-4fca-8710-72a010abc684.svg?style=flat-square)](https://insight.sensiolabs.com/projects/9015691f-130d-4fca-8710-72a010abc684)
[![Quality Score](https://img.shields.io/scrutinizer/g/miladnouri/laravel-notification-webhook.svg?style=flat-square)](https://scrutinizer-ci.com/g/miladnouri/laravel-notification-webhook)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/miladnouri/laravel-notification-webhook/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/miladnouri/laravel-notification-webhook/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/miladnouri/laravel-notification-webhook.svg?style=flat-square)](https://packagist.org/packages/miladnouri/laravel-notification-webhook)

This package makes it easy to send webhooks using the Laravel notification system.

This is an another fork from miladnouri/webhook because I need to use with on-demand notifications so I added support for that.

## Contents

-   [Installation](#installation)
-   [Usage](#usage) - [Available Message methods](#available-message-methods)
-   [Changelog](#changelog)
-   [Testing](#testing)
-   [License](#license)

## Installation

You can install the package via composer:

```bash
composer require miladnouri/laravel-notification-webhook
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use NotificationChannels\Webhook\WebhookChannel;
use NotificationChannels\Webhook\WebhookMessage;
use Illuminate\Notifications\Notification;

class ProjectCreated extends Notification
{
    public function via($notifiable)
    {
        return [WebhookChannel::class];
    }

    public function toWebhook($notifiable)
    {
        return WebhookMessage::create()
            ->data([
               'payload' => [
                   'webhook' => 'data'
               ]
            ])
            ->userAgent("Custom-User-Agent")
            ->header('X-Custom', 'Custom-Header');
    }
}
```

In order to let your Notification know which URL should receive the Webhook data, add the `routeNotificationForWebhook` method to your Notifiable model.

This method needs to return the URL where the notification Webhook will receive a POST request.

```php
public function routeNotificationForWebhook()
{
    return 'http://myrequest.com/abcd';
}
```

### Available methods

-   `data('')`: Accepts a JSON-encodable value for the Webhook body.
-   `userAgent('')`: Accepts a string value for the Webhook user agent.
-   `header($name, $value)`: Sets additional headers to send with the POST Webhook.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
