<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            //return Yii::$app->user->identity->id_group === 1;
                            if (Yii::$app->user->identity->id_group !== 1) {
                                return Yii::$app->getResponse()->redirect('/');;
                            } else {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }

}
