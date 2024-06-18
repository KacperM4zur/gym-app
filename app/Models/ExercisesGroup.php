<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesGroup extends Model
{
    protected $table = 'exercises_group';
    protected $guarded = ['id'];
    use HasFactory;
}
