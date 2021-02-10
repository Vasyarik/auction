<?php
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav>
        <div class="logo"><a href="<?= Url::to(['/page/index']) ?>">Auction</a></div>
        <div class="admin_navigation" color="#fff">
            <a href="<?= Url::to(['/admin/']) ?>">Аукционы</a>
            <a href="<?= Url::to(['/admin/category']) ?>">Категории</a> 
            <a href="<?= Url::to(['/admin/lot']) ?>">Лоты</a>
            <a href="<?= Url::to(['/admin/user']) ?>">Пользователи</a>
        </div>
        <div class="user"><a href="#">Админ</a></div>
    </nav>

    <div class="container" id="content">
        <?=$content?>
    </div>

    <footer>
        <div class="social_box">
            <div class="social"></div>
            <div class="social"></div>
            <div class="social"></div>
            <div class="social"></div>
        </div>
        <span id="copyright">Copyright © интернет-аукцион 
        “Auction” 2020 Все права защищены</span>
    </footer>
    <script src="js/static.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>