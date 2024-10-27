<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplementDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('supplement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplement_plan_day_id')->constrained('supplement_plan_days')->onDelete('cascade');
            $table->foreignId('supplement_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->string('unit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplement_details');
    }
}
