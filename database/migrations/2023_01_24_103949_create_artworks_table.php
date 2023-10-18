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
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_number');
            $table->enum('type', ['painting', 'sculpture', 'graphics', 'photography', 'video', 'textile', 'installation', 'other']);
            $table->string('title');
            $table->unsignedBigInteger('artist_id')->constrained()->onDelete('cascade');
            $table->text('materials');
            $table->text('support');
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('depth')->nullable();
            $table->float('weight')->nullable();
            $table->integer('elements_number')->nullable();
            $table->integer('print_number')->nullable();
            $table->string('print_type')->nullable();
            $table->text('description');
            $table->text('signature');
            $table->text('signature_location');
            $table->text('conservation_location');
            $table->string('storage_place');
            $table->string('storage_method');
            $table->foreign('artist_id')->references('id')->on('artists');
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
        Schema::dropIfExists('artworks');
    }
};