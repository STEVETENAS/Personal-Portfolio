<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_langs', static function (Blueprint $table) {
            $table->id();
            $table->tinyText('language');
            $table->unsignedTinyInteger('language_level');
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
        Schema::dropIfExists('profiler_langs');
    }
}
