<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DbConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('profiler_emails', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_academics', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_skills', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_exps', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_ips', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_langs', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_contracts', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_projects', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_medicals', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_residents', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('profiler_telephones', static function ($table) {
            $table->foreign('profiler_info_id')->references('id')->on('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
}
