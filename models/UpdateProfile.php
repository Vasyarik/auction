<?php 

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UpdateProfile extends Model {

    public $nickname;
    public $image;

    public function rules() {      
        return [
            ['nickname', 'unique', 'targetClass' => User::className(), 'message' => 'Этот псевдоним уже занят'],
            [['image'], 'file', 'extensions' => 'jpg, png']
        ];
    }

    public function attributeLabels() {
        return [
            'nickname' => 'Псевдоним',
            //'image' => 'Картинка',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage) {

        $this->image = $file;

        if ($this->validate()) {
            
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();

        }

    }

    private function getFolder() {

        return Yii::getAlias('@web') . 'uploads/';

    }

    private function generateFilename() {

        return strtolower(md5(uniqid($this->image->basename)) . '.' . $this->image->extension);

    }

    public function deleteCurrentImage($currentImage) {

        if ($this->fileExists($currentImage)) {

            unlink($this->getFolder() . $currentImage);

        }
        
    }

    public function fileExists($currentImage) {

        if (!empty($currentImage) && $currentImage != null) {

            return file_exists($this->getFolder() . $currentImage);

        }

    }

    public function saveImage() {

        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}