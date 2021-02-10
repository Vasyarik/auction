<?php

namespace app\models;

use yii\db\ActiveRecord;

class Lot extends ActiveRecord {

    public static function tableName() {
        return 'lot';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    public function getImage() {

        return ($this->lot_img) ? '/web/uploads/' . $this->lot_img : '/web/img/no_image.jpg';

    }
}