<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Auction */

$this->title = 'Админка | Создать аукцион';
$this->params['breadcrumbs'][] = ['label' => 'Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auction-create">

    <h1><?= Html::encode('Создать аукцион') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
