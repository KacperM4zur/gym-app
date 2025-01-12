<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplementPlansTable extends Migration
{
    public function up()
    {
        Schema::create('supplement_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplement_plans');
    }
}
