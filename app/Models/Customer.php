<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Customer extends User
{
    use HasFactory;
    protected $table = 'customers';
    protected $guarded = ['id'];
//    protected $hidden = [
//        'password',
//        'api_token',
//        'remember_token'
//    ];

    public function rules() {
        return [
            'name' => 'required|string|unique:customers,name,' . $this->id,
            'email' => 'required|email|string|unique:customers,email,' . $this->id,
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function generateApiToken(){
        $this->api_token = Str::random(60);
        return $this->api_token;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id','id');
    }

    public function weights(): HasMany
    {
        return $this->hasMany(UserWeight::class);
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(UserMeasurement::class);
    }

    public function maxLifts(): HasMany
    {
        return $this->hasMany(UserMaxLift::class, 'customer_id');
    }

    public function workoutPlans(): HasMany
    {
        return $this->hasMany(WorkoutPlan::class);
    }


}
