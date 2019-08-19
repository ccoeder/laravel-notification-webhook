<?php

namespace NotificationChannels\Webhook;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class WebhookServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(ChannelManager::class)->extend('webhook', function () {
            return $this->app->make(WebhookChannel::class);
        });
    }
}
