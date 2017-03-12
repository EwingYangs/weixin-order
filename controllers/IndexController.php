<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\WUser;
use app\models\Order;
use app\models\Menu;


class IndexController extends Controller{
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
	 /**
     * Displays homepage.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    // 	$users = WUser:: find()->count();
    // 	$orders = Order::find()->where(['order_status' => '0'])->count();
    // 	$money = Order::find()->select('sum(total_price) as money')->where(['order_status' => '1'])->asArray()->one();
    // 	$money = $money['money'];
    // 	$menus = Menu:: find()->count();
    // 	$data = array(
    // 			'users' => $users,
    // 			'orders' => $orders,
    // 			'menus' => $menus,
    // 			'money' => $money,
    // 		);
    //     return $this->render('index',['data' => $data]);
    // }
}

