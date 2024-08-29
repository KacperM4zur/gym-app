<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends User
{
    use HasFactory;
    protected $table = 'customers';
    protected $guarded = ['id'];
//    protected $hidden = [
//        'password',
//        'api_token',
//        'remember_token'
//    ];

    public function rules() {
        return [
            'name' => 'required|string|unique:customers,name,' . $this->id,
            'email' => 'required|email|string|unique:customers,email,' . $this->id,
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function generateApiToken(){
        $this->api_token = Str::random(60);
        return $this->api_token;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id','id');
    }

}
