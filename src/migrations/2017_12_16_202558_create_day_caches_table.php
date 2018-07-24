<?php

use BertBijnens\LaravelAnalytics\Providers\DatabaseMigrationProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateDayCachesTable extends DatabaseMigrationProvider
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('analytics')->create('day_caches', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('site_id')->unsigend()->nullable();

            $table->integer('log_count')->default(0);
            $table->integer('log_count_api')->default(0);
            $table->integer('log_count_web')->default(0);

            $table->integer('error_count')->default(0);
            $table->integer('error_count_web')->default(0);
            $table->integer('error_count_api')->default(0);

            $table->integer('avg_response_time')->default(0);
            $table->integer('avg_response_time_api')->default(0);
            $table->integer('avg_response_time_web')->default(0);

            $table->integer('avg_response_size')->default(0);
            $table->integer('avg_response_size_api')->default(0);
            $table->integer('avg_response_size_web')->default(0);

            $table->integer('log_count_get')->default(0);
            $table->integer('log_count_post')->default(0);

            $table->integer('log_count_web_get')->default(0);
            $table->integer('log_count_web_post')->default(0);

            $table->integer('log_count_api_get')->default(0);
            $table->integer('log_count_api_post')->default(0);

            $table->integer('log_count_is_file')->default(0);

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
        Schema::connection('analytics')->dropIfExists('day_caches');
    }
}
