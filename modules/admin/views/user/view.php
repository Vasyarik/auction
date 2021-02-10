<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = '#' . $model->id . ' ' . $model->nickname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить картинку', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'id_group',
            [
                'attribute' => 'id_group',
                'value' => function ($data) {
                    return $data->group->group_name;
                }
            ],
            'nickname',
            //'password',
            'email:email',
            //'user_img',
            [
                'attribute' => 'user_img',
                'value' => function ($data) {
                    return \yii\helpers\Html::img($data->getImage(), 
                    ['alt' => $data->nickname, 'height' => 100]);
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
