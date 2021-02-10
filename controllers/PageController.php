<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Auction;
use app\models\Lot;
use app\models\Category;
use app\models\LoginForm;
use app\models\RegistryForm;
use app\models\User;
use app\models\UpdateProfile;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use Yii;

class PageController extends Controller {

    public function beforeAction($action) {
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $auctions_all = Auction::find()->asArray()->all();

        $now = time();

        $auctions = [];

        foreach ($auctions_all as $auction) {

            $timer = explode(':', $auction['lot_timer']);
            $lots = Lot::find()->where(['id_auction' => $auction['id']])->asArray()->all();

            $h = $timer[0] * 60 * 60 * 1000;
            $m = $timer[1] * 60 * 1000;
            $s = $timer[2] * 1000;

            $date_end[$auction['id']]['date_end'] = strtotime($auction['date_start']) * 1000 + ($h + $m + $s) * count($lots);

            if ($now * 1000 <= $date_end[$auction['id']]['date_end']) {
                $auctions[] = $auction;
            }

        }

        return $this->render('index', compact('auctions', 'date_end'));

    }


    public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';
        
        return $this->render('login', compact('model'));

    }


    public function actionRegistry() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //$this->setMeta('Регистрация');
        $model = new RegistryForm;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->nickname = $model->nickname;

            if ($user->save()) {
                \Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('registry', compact('model'));

    }


    public function actionProfile() {

        $user = User::findOne(['id' => Yii::$app->user->identity->id]);

        $lots = Lot::find()->where(['winner' => Yii::$app->user->identity->id])->all();

        $model = new UpdateProfile;
        //$img_model = new ImageUpload;
        if($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                
                $file = UploadedFile::getInstance($model, 'image');
                if ($file) {
                    $user->saveImage($model->uploadFile($file, $user->user_img));
                }
                if (trim($model->nickname)) {
                    $user->nickname = $model->nickname;
                    $user->save();
                    header("Refresh: 0");
                }
            } else {
                $active_modal = true;
            }
        }

        return $this->render('profile', compact('user', 'lots', 'model', 'active_modal'));

    }

}