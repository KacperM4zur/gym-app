<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMeasurement extends Model
{
    protected $fillable = ['customer_id', 'body_part_id', 'date', 'measurement'];

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'body_part_id' => 'required|exists:body_parts,id',
            'measurement' => 'required|numeric|min:0',
            'date' => 'required|date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function bodyPart(): BelongsTo
    {
        return $this->belongsTo(BodyPart::class);
    }
}

