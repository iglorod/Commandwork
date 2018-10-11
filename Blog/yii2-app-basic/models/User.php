<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
    }


    public function validateAuthKey($authKey)
    {
    }

    public static function tableName()
    {
        return 'user';
    }


    public function rules()
    {
        return [
            [['login', 'password', 'email'], 'required'],
            [['admin'], 'integer'],
            [['login', 'password'], 'string', 'max' => 512],
            ['email','email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'admin' => 'Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id_author' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id_user' => 'id']);
    }
}
