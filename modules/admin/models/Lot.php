<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "lot".
 *
 * @property int $id
 * @property int $id_auction
 * @property string $lot_name
 * @property int $id_category
 * @property int $quantity
 * @property int $start_bet
 * @property string $timer
 * @property int|null $winner
 * @property int|null $win_bet
 * @property string $description
 * @property int $pay_status
 * @property string|null $lot_img
 * @property int $current
 *
 * @property Auction $auction
 * @property Category $category
 * @property User $winner0
 * @property Pay $payStatus
 */
class Lot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_auction', 'lot_name', 'id_category', 'start_bet', 'description'], 'required'],
            [['id_auction', 'id_category', 'quantity', 'start_bet', 'win_bet', 'pay_status'], 'integer'],
            [['description'], 'string'],
            [['lot_name'], 'string', 'max' => 100],
            [['id_auction'], 'exist', 'skipOnError' => true, 'targetClass' => Auction::className(), 'targetAttribute' => ['id_auction' => 'id']],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
            //[['winner'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['winner' => 'id']],
            [['pay_status'], 'exist', 'skipOnError' => true, 'targetClass' => Pay::className(), 'targetAttribute' => ['pay_status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_auction' => 'Номер аукциона',
            'lot_name' => 'Название лота',
            'id_category' => 'Категория',
            'quantity' => 'Количество',
            'start_bet' => 'Начальная ставка',
            'winner' => 'Победитель',
            'win_bet' => 'Выиграшная ставка',
            'description' => 'Описание',
            'pay_status' => 'Оплата',
            //'lot_img' => 'Изображение лота',
        ];
    }

    /**
     * Gets query for [[Auction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuction()
    {
        return $this->hasOne(Auction::className(), ['id' => 'id_auction']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Winner0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'winner']);
    }

    /**
     * Gets query for [[PayStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPay()
    {
        return $this->hasOne(Pay::className(), ['id' => 'pay_status']);
    }

    public function saveImage($filename) {

        $this->lot_img = $filename;
        return $this->save(false);

    }

    public function getImage() {

        return ($this->lot_img) ? '/web/uploads/' . $this->lot_img : '/web/img/no_image.jpg';

    }

    public function deleteImage() {

        $imageUploadModel = new ImageUploadModel;
        $imageUploadModel->deleteCurrentImage($this->lot_img);

    }

    public function beforeDelete() {

        $this->deleteImage();
        return parent::beforeDelete();

    }

}
