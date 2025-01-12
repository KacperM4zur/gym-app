<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMaxLift extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'exercise_id', 'weight', 'date'];

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'exercise_id' => 'required|exists:exercises,id',
            'weight' => 'required|numeric|min:1',
            'date' => 'required|date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
