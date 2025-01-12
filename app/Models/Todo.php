<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'completed',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
