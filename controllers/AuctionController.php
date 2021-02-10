<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Auction;
use app\models\Lot;
use app\models\Category;
use app\models\LoginForm;
use app\models\RegistryForm;
use app\models\User;
use Yii;

class AuctionController extends Controller {


    public function actionIndex($id) {
        $auction = Auction::find()->where(['id' => $id])->asArray()->limit(1)->one();
        $lots = Lot::find()->where(['id_auction' => $id])->all();
        $cats = Category::find()->asArray()->all();

        $auction_start = strtotime($auction['date_start']) * 1000;

        return $this->render('index', compact('id', 'lots', 'cats', 'auction_start'));
    }

    public function actionLot($id_auction, $lot_num, $active) {
        $this->layout = 'new';
        if (Yii::$app->request->isAjax) {
            $lots = Lot::find()->where(['id_auction' => $id_auction])->asArray()->all();
            $f_lot = $lots[$lot_num];
            $f_lot = Lot::find()->where(['id' => $f_lot['id']])->limit(1)->one();
            //var_dump($f_lot);die;
            $lots_num = count($lots);
            $cats = Category::find()->asArray()->all();
            $auction = Auction::find()->where(['id' => $id_auction])->asArray()->limit(1)->one();

            if ($lot_num == 0 || $lot_num !== $i) {

                $timer = explode(':', $auction['lot_timer']);

                $h = $timer[0] * 60 * 60 * 1000;
                $m = $timer[1] * 60 * 1000;
                $s = $timer[2] * 1000;

                $date_end = strtotime($auction['date_start']) * 1000 + ($h + $m + $s) * ($lot_num + 1);

                $i = $lot_num;
            }

            $auction_start = strtotime($auction['date_start']) * 1000;
            $auction_end = $auction_start + ($h + $m + $s) * ($lots_num);
            
            //echo $auction_end;die;

            if ($f_lot->win_bet < $f_lot->start_bet) {
                $f_lot->win_bet = $f_lot->start_bet;
                $f_lot->save();
            }

            return $this->render('lot', compact('id_auction', 
                'f_lot', 
                'cats', 
                'date_end',
                'lots_num',
                'active',
                'auction_end')
            ); 
        }
    }

    public function actionBet($lot_id, $lot_num, $bet, $user) {
        $this->layout = 'new';
        if (Yii::$app->request->isAjax) {

        $lot = Lot::find()->where(['id' => $lot_id])->limit(1)->one();

        if (!$lot->win_bet) {
            $lot->win_bet = $f_lot->start_bet;
            $lot->save();
        }

        if ($bet > $lot->win_bet) {
            $lot->win_bet = $bet;
            $lot->winner = $user;
            $lot->save();
        }

        return $this->render('bet', compact('lot'));

        }
    }
}