<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutPlan extends Model
{
    protected $table = 'workout_plans';
    protected $guarded = ['id'];
    use HasFactory;

    public function workoutDays(): HasMany
    {
        return $this->hasMany(WorkoutPlanDay::class, 'workout_plan_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }
}
