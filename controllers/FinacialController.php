<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Order;
use app\models\OrderDetail;
use yii\filters\AccessControl;
use yii;

class FinacialController extends Controller{
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
    	//获取订单信息
    	$order = Order::find()->where(['w_order.order_status' => '1'])->joinWith('orderDetail as o')->joinWith('wUser as u')->asArray()->all();
        $str = '';
        foreach ($order as $key => &$value) {
            foreach($value['orderDetail'] as $k=>$v){
                $str .= "(".$v['menu']['menu_name'].' <font color="red">￥'.$v['menu']['price'].' </font> )X '.$v['menu_number'].'</br>';
            }
            $value['detail'] = $str;
            $str = '';//清空str
        }
        return $this->render('index',['order'=>$order]);
    }
}



