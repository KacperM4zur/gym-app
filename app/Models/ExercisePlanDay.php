<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisePlanDay extends Model
{
    protected $table = 'exercises_plan_days';
    protected $guarded = ['id'];
    use HasFactory;
}
