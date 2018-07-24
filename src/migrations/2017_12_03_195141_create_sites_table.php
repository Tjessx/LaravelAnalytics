<?php

use BertBijnens\LaravelAnalytics\Providers\DatabaseMigrationProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateSitesTable extends DatabaseMigrationProvider
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('analytics')->create('sites', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('logs_dir');

            $table->boolean('setup')->default(false);

            $table->dateTime('synced_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('analytics')->dropIfExists('sites');
    }
}
