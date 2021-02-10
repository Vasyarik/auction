<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Админка | Аукционы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auction-index">

    <h1><?= Html::encode('Аукционы') ?></h1>

    <p>
        <?= Html::a('Добавить аукцион', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_start',
            'lot_timer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
