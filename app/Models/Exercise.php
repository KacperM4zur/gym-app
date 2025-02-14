<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    protected $table = 'exercises';
    protected $guarded = ['id'];
    use HasFactory;

    public function rules(){
        return [
            'name' => 'required',
            'description' => 'required',
            'image_path' => $this->image_path ? '' : 'required',
            'status' => 'required|integer',
            'exercises_group_id' => 'required|exists:exercises_group,id'
        ];
    }

    public function exercisesGroup(): BelongsTo
    {
        return $this->belongsTo(ExercisesGroup::class, 'exercises_group_id', 'id');
    }
    public function maxLifts()
    {
        return $this->hasMany(UserMaxLift::class, 'exercise_id');
    }
}
