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

    public function generateApiToken(){
        $this->api_token = Str::random(60);
        return $this->api_token;
    }


}
