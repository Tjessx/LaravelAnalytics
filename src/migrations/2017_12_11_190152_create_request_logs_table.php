<?php

use BertBijnens\LaravelAnalytics\Providers\DatabaseMigrationProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestLogsTable extends DatabaseMigrationProvider
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('analytics')->create('request_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_file_id')->unsigned()->nullable();
            $table->integer('site_id')->unsigned()->nullable();


            $table->string('ip')->nullable();
            $table->enum('ip_version', ['ipv4', 'ipv6', 'OTHER'])->default('OTHER');

            $table->integer('user_agent_id')->unsigned()->nullable();

            $table->string('none')->nullable();
            $table->string('none2')->nullable();

            $table->integer('response_code');
            $table->integer('response_bytes')->default(0);
            $table->double('response_time')->nullable();

            $table->string('request_referer')->nullable();
            $table->enum('request_type', ['GET', 'POST', 'DELETE', 'PUT', 'OPTIONS', 'PATCH', 'CONNECT', 'HEAD', 'TRACE', 'OTHER'])->default('OTHER');
            $table->string('request_url')->nullable();
            $table->string('request_protocol', 10)->nullable();

            $table->boolean('is_file')->default(false);
            $table->boolean('is_api')->default(false);

            $table->dateTime('request_date')->nullable();
            $table->timestamps();

            $table->text('request_url_complete')->nullable();
        });

        Schema::connection('analytics')->table('request_logs', function(Blueprint $table) {
            $table->foreign('log_file_id')
                ->references('id')->on('log_files')
                ->onDelete('set null');

            $table->foreign('site_id')
                ->references('id')->on('sites')
                ->onDelete('set null');

            $table->foreign('user_agent_id')
                ->references('id')->on('user_agents')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('analytics')->dropIfExists('request_logs');
    }
}
