<?php

namespace app\models;

use yii\base\Model;

class MyLoginForm extends Model {
    public $email;
    public $password;

    public function rules() {
        return [
            [['email', 'password'], 'required', 'message' => 'Заполните поле',]
        ];
    }

    public function attributeLabels() {
        return [
            'email' => 'Эл. почта',
            'password' => 'Пароль',
        ];
    }
}