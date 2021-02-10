<?php

namespace app\models;

use yii\db\ActiveRecord;

class Auction extends ActiveRecord {

    public static function tableName() {
        return 'auction';
    }

}