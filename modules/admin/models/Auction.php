<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "auction".
 *
 * @property int $id
 * @property string $date_start
 *
 * @property Lot[] $lots
 */
class Auction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_start'], 'required'],
            [['date_start', 'lot_timer'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер аукциона',
            'date_start' => 'Дата старта',
            'lot_timer' => 'Время на 1 лот',
        ];
    }

    /**
     * Gets query for [[Lots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLots()
    {
        return $this->hasMany(Lot::className(), ['id_auction' => 'id']);
    }
}
