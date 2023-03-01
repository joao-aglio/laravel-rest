<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_type_id')->constrained('user_types');
            $table->string('firstName', 150);
            $table->string('lastName', 150);
            $table->string('email', 100);
            $table->string('phoneNumber', 50);
            $table->boolean('active')->default(1);
            $table->string('login', 100)->unique();
            $table->string('password', 150)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
