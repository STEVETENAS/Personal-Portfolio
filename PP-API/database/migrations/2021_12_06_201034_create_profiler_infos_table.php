<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_infos', static function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('profession');
            $table->string('place_of_origin')->default('west');
            $table->tinyInteger('number_of_children')->nullable();
            $table->boolean('married')->default(false);
            $table->string('profiler_image')->nullable()->unique();
            $table->string('background_image')->nullable()->unique();
            $table->softDeletes();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('profiler_infos');
    }
}
