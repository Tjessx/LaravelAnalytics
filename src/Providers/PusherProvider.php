<?php

namespace BertBijnens\LaravelAnalytics\Providers;

use Illuminate\Support\Facades\Config;

class PusherProvider {

    protected static $hasBeenSetup = false;

    public static function setup() {
        return self::$hasBeenSetup || self::configure();
    }

    protected static function configure() {

        $config = Config::get('broadcasting.connections.pusher');

        $config['key'] = env('ANALYTICS_PUSHER_KEY');
        $config['secret'] = env('ANALYTICS_PUSHER_SECRET');
        $config['app_id'] = env('ANALYTICS_PUSHER_APP_ID');
        $config['options']['cluster'] = env('ANALYTICS_PUSHER_CLUSTER');

        Config::set('broadcasting.connections.analytics', $config);

        self::$hasBeenSetup = true;

        return self::$hasBeenSetup;
    }

    public function broadcast($callback) {

        self::$hasBeenSetup || self::configure();

        $cachedDefault = Config::get('broadcasting.default');
        Config::set('broadcasting.default', 'analytics');

        $callback();

        Config::set('broadcasting.default', $cachedDefault);
    }

}