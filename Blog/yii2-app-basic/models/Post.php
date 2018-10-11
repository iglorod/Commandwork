<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $text
 * @property int $id_tag
 * @property int $status
 * @property string $create_time
 * @property string $update_time
 * @property int $id_user
 *
 * @property Comment[] $comments
 * @property User $user
 * @property Tag $tag
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','text','id_tag','image'],'required'],
            [['title','text','image'],'string'],
            [['create_time'],'default','value'=> date('d-m-Y, h:i:s')],
            [['title'],'string','max'=>100]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'text' => 'Text',
            'id_tag' => 'Id Tag',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id_post' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'id_tag']);
    }

    public function saveImage($filename){
        $this->image=$filename;
        $this->update_time=date('d-m-Y, h:i:s');
        return $this->save(fasle);
    }

    public function getImage(){
        if($this->image!=''){
            return 'D:/Programm/OpenServer/OSPanel/domains/Commandwork' . Yii::getAlias('@web') . '/uploads/' . $this->image;
        }
        return 'D:/Programm/OpenServer/OSPanel/domains/Commandwork' . Yii::getAlias('@web') . '/uploads/no_image.jpg';
    }

    public function saveTag($tag)
    {
        $this->id_tag=$tag;
        $this->update_time=date('d-m-Y');
        return $this->save(fasle);
    }

    public function setViews($count){
        $this->status=$count;
        return $this->save(false);
    }

}
