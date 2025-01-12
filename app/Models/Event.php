<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'date',
        'time',
    ];

    public function trainer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
