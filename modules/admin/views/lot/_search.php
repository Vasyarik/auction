<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\LotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_auction') ?>

    <?= $form->field($model, 'lot_name') ?>

    <?= $form->field($model, 'id_category') ?>

    <?= $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'start_bet') ?>

    <?php // echo $form->field($model, 'winner') ?>

    <?php // echo $form->field($model, 'win_bet') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'pay_status') ?>

    <?php // echo $form->field($model, 'lot_img') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
