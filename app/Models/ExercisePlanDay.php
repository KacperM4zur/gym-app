<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisePlanDay extends Model
{
    protected $table = 'exercises_plan_days';
    protected $guarded = ['id'];
    use HasFactory;

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }
}
