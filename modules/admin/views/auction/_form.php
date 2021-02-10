<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Auction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_start')->input('datetime') ?>
    <?= $form->field($model, 'lot_timer')->input('time') ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
