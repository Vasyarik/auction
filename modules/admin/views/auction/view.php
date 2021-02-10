<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Auction */

$this->title = 'Админка | Аукцион: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auction-view">

    <h1><?= Html::encode('Аукцион: ' . $model->id) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'date_start',
            'lot_timer',
        ],
    ]) ?>

<?php $items = $model->lots;?>

<div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Начальная ставка</th>
                    <th>Выиграшная ставка</th>
                    <th>Победитель</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><?= \yii\helpers\Html::img($item->getImage(), 
                        ['alt' => $item['lot_name'], 'height' => 50]) ?></td>
                        <td><a href="<?= Url::to(['lot/view', 'id' => $item['id']]) ?>"><?= '#' . $item['id'] . ' ' . $item['lot_name'] ?></a></td>
                        <td><?= $item['start_bet'] ?></td>
                        <!-- Если аукцион не начался, то не выводятся поля ниже -->
                        <td><?= $item['win_bet'] ?></td>
                        <td><?= $item->user->nickname ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
