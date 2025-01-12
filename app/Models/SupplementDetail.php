<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementDetail extends Model
{
    use HasFactory;

    protected $fillable = ['supplement_plan_day_id', 'supplement_id', 'amount', 'unit'];

    // Relacja z modelem SupplementPlanDay
    public function supplementPlanDay()
    {
        return $this->belongsTo(SupplementPlanDay::class);
    }

    // Relacja z modelem Supplement
    public function supplement()
    {
        return $this->belongsTo(Supplement::class);
    }
}
