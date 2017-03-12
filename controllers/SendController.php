<?php
namespace app\controllers;
use yii\web\Controller;
use yii\filters\AccessControl;

class SendController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}



