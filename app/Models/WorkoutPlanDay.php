<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutPlanDay extends Model
{
    protected $table = 'workout_plans_days';
    protected $guarded = ['id'];
    use HasFactory;

    public function workoutExercises(): HasMany
    {
        return $this->hasMany(ExercisePlanDay::class, 'workout_plan_day_id', 'id');
    }
}
