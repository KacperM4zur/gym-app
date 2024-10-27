<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'customer_id'];

    // Relacja z modelami SupplementPlanDay i Customer
    public function supplementPlanDays()
    {
        return $this->hasMany(SupplementPlanDay::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
