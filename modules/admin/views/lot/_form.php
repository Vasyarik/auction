<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Lot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_auction')->dropDownList(ArrayHelper::map(\app\models\Auction::find()->all(), 'id', 'date_start')) ?>

    <?= $form->field($model, 'lot_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_category')->dropDownList(ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'category_name')) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'start_bet')->textInput() ?>

    <?= $form->field($model, 'winner')->dropDownList([0 => null, ArrayHelper::map(\app\models\User::find()->all(), 'id', 'nickname')]) ?>

    <?= $form->field($model, 'win_bet')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pay_status')->DropDownList(ArrayHelper::map(app\modules\admin\models\Pay::find()->all(), 'id', 'status')) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
