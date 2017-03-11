<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Order;
use yii;

class OrderController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	//获取订单信息
    	$order = Order:: find()->where(['order_status' => '0'])->asArray()->all();
        return $this->render('index',['order'=>$order]);
    }

    public function actionSuccess()
    {
    	//获取订单信息
    	$order = Order:: find()->where(['order_status' => '1'])->asArray()->all();
        return $this->render('success',['order'=>$order]);
    }


    public function actionAjaxConfirm(){
        $model = new Order();
        $id = Yii::$app->request->get('id');
        if($id){
            //更新订单
            $order = $model::findOne($id);
            $order->order_status = '1';
            if($order->save()){
                Yii::$app->getSession()->setFlash('success', '确认配送成功');
                echo 'success';
                die;
            }else{
                $error = $type->getErrors('type_name');
                echo $error[0];
            }
        }
    }
}



