<?php

namespace BertBijnens\LaravelAnalytics\Providers;

use Illuminate\Database\Migrations\Migration;

class DatabaseMigrationProvider extends Migration {

    public function __construct() {
        DatabaseProvider::setup();
    }
}