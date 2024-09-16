<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Day;
use App\Models\ExercisePlanDay;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanDay;
use Illuminate\Support\Collection;

class WorkoutPlanService
{
    public function createWorkoutPlan(array $workoutPlanData, ?Customer $customer): WorkoutPlan
    {
        $workoutPlan = WorkoutPlan::create(['name' => $workoutPlanData['workoutPlanName'], 'customer_id' => $customer->id]);
        $days = Day::whereIn('number', array_column($workoutPlanData['plan'], 'day_of_week'))->get();

        foreach ($workoutPlanData['plan'] as $plan) {
            $dayPlan = WorkoutPlanDay::create(['workout_plan_id' => $workoutPlan->id, 'day_id' => $days->firstWhere('id', '=', $plan['day_of_week'])->id]);

            $exercises = array_map(function ($exercise) use ($dayPlan) {
                $exercise['workout_plan_day_id'] = $dayPlan->id;
                return $exercise;
            }, $plan['exercises']);

            ExercisePlanDay::insert($exercises);
        }

        return $workoutPlan;
    }

    public function getWorkoutPlan(): Collection {
        return WorkoutPlan::with(['workoutDays.workoutExercises'])
            ->get()
            ->map(fn($workoutPlan) => [
                'name' => $workoutPlan->name,
                'plan' => $workoutPlan->workoutDays->map(fn($workoutDay) => [
                    'day' => $workoutDay->day->name,
                    'exercises' => $workoutDay->workoutExercises->map(fn($workoutDayExercise) => [
                        'name' => $workoutDayExercise->exercise->name,
                        'sets' => $workoutDayExercise->sets,
                        'reps' => $workoutDayExercise->reps,
                        'weight' => $workoutDayExercise->weight,
                        'break' => $workoutDayExercise->break
                    ])->toArray()
                ])->toArray()
            ]);
    }
}
