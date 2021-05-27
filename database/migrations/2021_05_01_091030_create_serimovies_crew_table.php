<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerimoviesCrewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serimovies_crew', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serimovies_id')->nullable()->constrained()->onDelete('set null');
            $table->string('fname');
            $table->string('name');
            $table->string('job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serimovies_crew');
    }
}
