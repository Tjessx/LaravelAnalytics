<?php

use BertBijnens\LaravelAnalytics\Providers\DatabaseMigrationProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends DatabaseMigrationProvider
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('analytics')->create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();

            $table->string('token');

            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('analytics')->dropIfExists('password_resets');
    }
}
