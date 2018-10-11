<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;

    public function rules(){
        return [
            [['email','password'],'required'],
            ['email','email'],
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params){
        $user=$this->getUser();

        if(!user || $user->password!=$this->password){
            $this->addError($attribute,'Пароль або email вказано невірно..');
        }
    }

    public function getUser(){
        return User::findOne(['email'=>$this->email]);
    }
}