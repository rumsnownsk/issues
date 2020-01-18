<?php

namespace app\models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

//    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $hidden = [
        'password',
        'password_cookie_token',
    ];


//    public function isLogi
}