<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advice extends Model
{
    protected $table = 'advices';
    protected $fillable = ['customer_id', 'content'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'content' => 'required|string|max:500',
        ];
    }
}
