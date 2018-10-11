<?php

namespace app\models;

use yii\base\Model;

class Signup extends Model
{
    public $login;
    public $password;
    public $email;

    public function rules()
    {
        return[
        [['login','email','password'],'required'],
        ['login','unique','targetClass'=>'app\models\User'],
        ['email','email'],
        ['email','unique','targetClass'=>'app\models\User'],
        ['password','string','min'=>8,'max'=>32]
        ];
    }

    public function signup(){
        $user = new User();

        $user->login=$this->login;
        $user->email=$this->email;
        $user->password=$this->password;
        return $user->save();
    }

    public function getUser(){
        return User::findOne(['email'=>$this->email]);
    }
}