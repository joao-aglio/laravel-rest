<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserveBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves_books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('reserve_id')->constrained('reserves');
            $table->date('reserve_until')->nullable();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_book');
    }
}
