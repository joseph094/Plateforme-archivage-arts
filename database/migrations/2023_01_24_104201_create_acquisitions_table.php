<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artwork_id');
            $table->string('current_owner');
            $table->date('acquisition_date');
            $table->string('acquisition_location');
            $table->float('price')->nullable();
            $table->enum('acquisition_method', ['purchase', 'donation', 'bequest']);
            $table->string('proof_of_purchase')->nullable();
            $table->string('authenticity_certificate')->nullable();
            $table->timestamps();
            $table->foreign('artwork_id')->references('id')->on('artworks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquisitions');
    }
};