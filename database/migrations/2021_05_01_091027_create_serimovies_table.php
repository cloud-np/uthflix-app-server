<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerimoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serimovies', function (Blueprint $table) {
            // This is equals to a UNSIGNED BIGINT with AUTO INCREMENT
            $table->id();
            $table->string('name');
            $table->integer('n_seasons');
            $table->integer('n_episodes');
            $table->date('release_date');
            $table->text('summary');
            $table->boolean('is_movie');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('image');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serimovies');
    }
}
