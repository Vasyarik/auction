<?php

namespace app\models;

use yii\base\Model;

class RegistryForm extends Model {
    public $email;
    public $password;
    public $nickname;

    public function rules() {
        return [
            [['email', 'password', 'nickname'], 'required', 'message' => 'Заполните поле',],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Эта почта уже занята'],
            ['nickname', 'unique', 'targetClass' => User::className(), 'message' => 'Этот псевдоним уже занят'],
        ];
    }

    public function attributeLabels() {
        return [
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'nickname' => 'Псевдоним',
        ];
    }
}