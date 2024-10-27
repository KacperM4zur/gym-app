<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplementPlanDaysTable extends Migration
{
    public function up()
    {
        Schema::create('supplement_plan_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplement_plan_id')->constrained('supplement_plans')->onDelete('cascade');
            $table->foreignId('day_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplement_plan_days');
    }
}
