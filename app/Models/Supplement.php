<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    use HasFactory;

    protected $table = 'supplements';
    protected $guarded = ['id'];

    public function rules(){
        return [
            'supplements_group_id' => 'required|exists:supplements_group,id',
            'name' => 'required',
            'description' => 'required',
            'image_path' => $this->image_path ? '' : 'required',
            'status' => 'required|integer'
        ];
    }

    public function supplementsGroup()
    {
        return $this->belongsTo(SupplementsGroup::class);
    }
}
