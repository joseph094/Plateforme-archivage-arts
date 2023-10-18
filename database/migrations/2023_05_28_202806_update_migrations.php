<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('bibliographies', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
        Schema::table('restorations', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
        Schema::table('exhibitions', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
        Schema::table('acquistions', function (Blueprint $table) {
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
