<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $id_group
 * @property string $nickname
 * @property string $password
 * @property string $email
 * @property string|null $user_img
 *
 * @property Lot[] $lots
 * @property UserGroup $group
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_group', 'nickname', 'password', 'email'], 'required'],
            [['id_group'], 'integer'],
            [['nickname', 'password', 'email'], 'string', 'max' => 100],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroup::className(), 'targetAttribute' => ['id_group' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'id_group' => 'Группа',
            'nickname' => 'Псевдоним',
            'password' => 'Пароль',
            'email' => 'Email',
            //'user_img' => 'Аватарка',
        ];
    }

    /**
     * Gets query for [[Lots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLots()
    {
        return $this->hasMany(Lot::className(), ['winner' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(UserGroup::className(), ['id' => 'id_group']);
    }

    public function saveImage($filename) {

        $this->user_img = $filename;
        return $this->save(false);

    }

    public function getImage() {

        return ($this->user_img) ? '/web/uploads/' . $this->user_img : '/web/img/no_image.jpg';

    }

    public function deleteImage() {

        $imageUploadModel = new ImageUploadModel;
        $imageUploadModel->deleteCurrentImage($this->user_img);

    }

    public function beforeDelete() {

        $this->deleteImage();
        return parent::beforeDelete();

    }
}
