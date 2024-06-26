<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementsGroup extends Model
{
    use HasFactory;

    protected $table = 'supplements_group';
    protected $guarded = ['id'];

    public function rules(){
        return [
            'name' => 'required',
            'description' => 'required',
            'image_path' => $this->image_path ? '' : 'required',
            'status' => 'required|integer'
        ];
    }
}
