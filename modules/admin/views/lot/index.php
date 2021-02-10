<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\LotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Админка | Лоты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать лот', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'description:ntext',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
