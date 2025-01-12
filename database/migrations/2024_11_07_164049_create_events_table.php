<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // ID trenera
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            // Klucz obcy do tabeli customers
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
