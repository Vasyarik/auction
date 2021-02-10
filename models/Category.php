<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    public static function tableName() {
        return 'category';
    }

    public function getLots() {
        return $this->hasMany(Lot::className(), ['id_category' => 'id']);
    }
}