<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Day;
use App\Models\ExercisePlanDay;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanDay;

class WorkoutPlanService
{
    public function createWorkoutPlan(array $workoutPlan, ?Customer $customer): WorkoutPlan
    {
        $workoutPlan = WorkoutPlan::create(['name' => $workoutPlan['workoutPlanName'], 'customer_id' => $customer->id]);
        $days = Day::whereIn('number', array_column($workoutPlan['plan'], 'day_of_week'))->get();

        foreach ($workoutPlan['plan'] as $plan) {
            $dayPlan = WorkoutPlanDay::create(['workout_plan_id' => $workoutPlan->id, 'day_id' => $days->firstWhere('id', '=', $plan['day_of_week'])->id]);

            $exercises = array_map(function ($exercise) use ($dayPlan) {
                $exercise['workout_plan_day_id'] = $dayPlan->id;
                return $exercise;
            }, $plan['exercises']);

            ExercisePlanDay::insert($exercises);
        }

        return $workoutPlan;
    }

    public function getWorkoutPlan() {
        return 0;
    }
}
