<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property int $status
 * @property string $url
 * @property string $create_time
 * @property int $id_author
 * @property int $id_post
 *
 * @property Post $post
 * @property User $author
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['id_author', 'id_post'], 'integer'],
            [['content'], 'string'],
            [['create_time'],'default','value'=> date('d-m-Y, h:i:s')],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'url' => 'Url',
            'create_time' => 'Create Time',
            'id_author' => 'Id Author',
            'id_post' => 'Id Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_author']);
    }

    public function getCount(){
        return Likes::find()->where(['id_comment'=>$this->id])->count();
    }
}
