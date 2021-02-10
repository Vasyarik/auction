<?php

use yii\helpers\Html;

$css = <<< CSS

form {
    margin: 50px 0;
}

h1 {
    margin: 50px 0 0
}

.lot-update {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-control {
    width: 300px;
    border: 1px solid #7d5fff;
    border-radius: 20px;
    position: relative;
    right: 25px;
    padding: 5px 0 5px 55px
}

CSS;

$this->registerCss($css, ['type' => 'text/css'], 'myStyles');

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Lot */

$this->title = 'Админка | Обновить лот ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
