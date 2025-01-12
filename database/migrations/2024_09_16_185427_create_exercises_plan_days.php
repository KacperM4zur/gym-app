<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises_plan_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_plan_day_id');
            $table->unsignedBigInteger('exercise_id');
            $table->integer('sets');
            $table->integer('reps');
            $table->integer('break');
            $table->float('weight');

            $table->timestamps();

            $table->foreign('workout_plan_day_id')->references('id')->on('workout_plans_days')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises_plan_days');
    }
};
