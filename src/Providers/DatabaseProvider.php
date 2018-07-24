<?php

namespace BertBijnens\LaravelAnalytics\Providers;

use Illuminate\Support\Facades\Config;

class DatabaseProvider {

    protected static $hasBeenSetup = false;

    public static function setup() {
        return self::$hasBeenSetup || self::configure();
    }

    protected static function configure() {

        $config = Config::get('database.connections.sqlite');

        $config['database'] = dirname($config['database']) . '/analytics.sqlite';

        Config::set('database.connections.analytics', $config);

        if(!file_exists($config['database'])) {
            touch($config['database']);
        }

        self::$hasBeenSetup = true;

        return self::$hasBeenSetup;
    }

}