<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementPlanDay extends Model
{
    use HasFactory;

    protected $fillable = ['supplement_plan_id', 'day_id'];

    // Relacja z modelem SupplementPlan
    public function supplementPlan()
    {
        return $this->belongsTo(SupplementPlan::class);
    }

    // Relacja z modelem Day
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    // Relacja z modelem SupplementDetail
    public function supplementDetails()
    {
        return $this->hasMany(SupplementDetail::class);
    }
}
