<?php

use BertBijnens\LaravelAnalytics\Providers\DatabaseMigrationProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateLogFilesTable extends DatabaseMigrationProvider
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('analytics')->create('log_files', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('site_id')->unsigned()->nullable();

            $table->string('filename');
            $table->string('location');
            $table->string('hash', 32)->nullable();

            $table->integer('size')->default(0);
            $table->integer('log_count')->default(0);

            $table->enum('type', ['unknown', 'access', 'error'])->default('unknown');

            $table->dateTime('modified_at')->nullable();
            $table->dateTime('synced_at')->nullable();

            $table->timestamps();
        });

        Schema::connection('analytics')->table('log_files', function(Blueprint $table) {
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('analytics')->dropIfExists('log_files');
    }
}
