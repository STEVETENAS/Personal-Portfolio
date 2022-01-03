<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_residents', static function (Blueprint $table) {
            $table->id();
            $table->mediumText('place_of_residence');
            $table->mediumText('city_of_residence');
            $table->tinyText('country_of_residence');
            $table->double('residence_longitude');
            $table->double('residence_latitude');
            $table->foreignId('profiler_info_id');
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
        Schema::dropIfExists('profiler_residents');
    }
}
