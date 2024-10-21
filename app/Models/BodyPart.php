<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BodyPart extends Model
{
    protected $fillable = ['name'];

    public function rules(){
        return [
            'name' => 'required'
        ];
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(UserMeasurement::class);
    }
}

