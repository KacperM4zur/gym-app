<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWeight extends Model
{
    protected $fillable = ['customer_id', 'date', 'weight'];

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'weight' => 'required|numeric|min:0',
            'date' => 'required|date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


}

