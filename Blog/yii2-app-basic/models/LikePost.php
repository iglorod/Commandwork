<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

class LikePost extends ActiveRecord
{

    public static function tableName()
    {
        return 'likePost';
    }

    public function rules()
    {
        return [
            [['id_user','id_post'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_post' => 'Id Post',
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'id_post']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public function getCount($id){
        return LikePost::find()->where(['id_post'=>$id])->count();
    }

    public function deleteLike()
    {
        $this->delete();
    }
}
?>


