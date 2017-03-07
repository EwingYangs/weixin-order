<?php
namespace app\controllers;
use yii\web\Controller;

class OrderController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}



