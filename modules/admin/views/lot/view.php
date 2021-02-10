<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Lot */

$this->title = 'Админка | Лот: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lot-view">

    <h1><?= Html::encode('Лот: ' . $model->id) ?></h1>

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
            'id_auction',
            'lot_name',
            //'id_category',
            [
                'attribute' => 'id_category',
                'value' => function ($data) {
                    return $data->category->category_name;
                }
            ],
            'quantity',
            'start_bet',
            //'winner',
            [
                'attribute' => 'winner',
                'value' => function ($data) {
                    return $data->user->nickname;
                }
            ],
            'win_bet',
            'description:ntext',
            //'pay_status',
            [
                'attribute' => 'pay_status',
                'value' => function ($data) {

                    if ($data->pay_status == 1) {
                        $res = '<span class="text-danger">'. $data->pay->status .'</span>';
                    } elseif ($data->pay_status == 2) {
                        $res = '<span class="text-warning">'. $data->pay->status .'</span>';
                    } else {
                        $res = '<span class="text-success">'. $data->pay->status .'</span>';
                    }

                    return $res;
                },
                'format' => 'html',
            ],
            //'lot_img',
            [
                'attribute' => 'lot_img',
                'value' => function ($data) {
                    return \yii\helpers\Html::img($data->getImage(), 
                    ['alt' => $data->lot_name, 'height' => 100]);
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
