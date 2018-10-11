<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\BaseYii;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $image;

    public function rules(){
        return [
            [['image'],'required'],
            [['image'],'file','extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage){
        $this->image = $file;

        if($this->validate()) {
            if (file_exists(Yii::getAlias('@app') . '/web/uploads/' . $currentImage) && $currentImage!='') {
                unlink(Yii::getAlias('@app') . '/web/uploads/' . $currentImage);
            }

            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);

            $file->saveAs(Yii::getAlias('@app') . '/web/uploads/' . $filename);
            return $filename;
        }
    }

}