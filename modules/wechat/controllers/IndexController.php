<?php
namespace app\modules\wechat\controllers;
use yii;
use yii\web\Controller;
use app\models\WUser;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Menu;

class IndexController extends Controller{
	public $enableCsrfValidation = false;
	public function actionIndex(){
		$code = Yii::$app->request->get('code');
		$session = Yii::$app->session;
		require 'wechat/wechat.php';
		$wechat = new \WeChat('wxc0813363b0684884','c99aae7d4ed073630559bf639abc11b4','weixin');
		if($code){
			//如果传来code就做用户入库处理
			$openid = $wechat->getOpenIdByCode($code);//获取openId;
			$session->set('openid', $openid);
			$userInfo = $wechat->getUserInfoByOpenId($openid);
			$user_model = new WUser();
			$user = $user_model->getUserByOpenId($openid);
			if(!$user){
				$user_model->addUser($userInfo);
			}
			//订单信息
			$userid = $user['id'];
			$order = Order::find()->where(['user_id' => $userid])->asArray()->joinWith('wUser as u')->all();
		}
		$openid = $session->get('openid');
		$user_model = new WUser();
		$user = $user_model->getUserByOpenId($openid);
		$userInfo = $wechat->getUserInfoByOpenId($openid);
		//订单信息
		$userid = $user['id'];
		$order = Order::find()->where(['user_id' => $userid])->asArray()->joinWith('wUser as u')->all();
		$userInfo = isset($userInfo) ? $userInfo : null;
		$order = isset($order) ? $order : null;
		return $this->render('index',['userInfo' => $userInfo,'order' => $order,'user'=>$user]);
	}

	public function actionOrder(){
		$order_id = Yii::$app->request->get('id');
		return $this->render('order');
	}


	public function actionDetail(){
		$order_id = Yii::$app->request->get('id');
		$detail = Order::find()->where(['w_order.id' => $order_id])->joinWith('orderDetail as o')->asArray()->one();
		return $this->render('order_detail',['detail'=> $detail]);
	}


	public function actionWx(){
		$session = Yii::$app->session;
		$openid = $session->get('openid');
		// $openid = 'oP4OrvwxfELTrc-F__Sie7L8rsV0';
		return $this->render('wx',['openid' => $openid]);
	}

	public function actionTest(){

		return $this->render('test',['openid' => $openid]);
	}

	public function actionPay(){
		$session = Yii::$app->session;
		$openid = $session->get('openid');
		$user_model = new WUser();
		$user = $user_model->getUserByOpenId($openid);
		$order = new Order();
		$order->user_id = $user['id'];
		$order_id = substr(md5(time().$user['id']), 8, 11);
		$order->id = $order_id;
		$order->transaction_id = substr(md5(time().$order->id), 8, 11);
		$order->table_number = substr(Yii::$app->request->post('table'),0,1);
		$order->people = substr(Yii::$app->request->post('people'),0,1);
		$order->remark = Yii::$app->request->post('remark');
		$order->total_price = Yii::$app->request->post('money');
		$order->order_time = time();
		$order->pay_time = time();
		$order->pay_status = 1;
		$order->order_status = 0;
		if($id = $order->insert()){
			$order_detail = new OrderDetail();
			$_order_detail = clone $order_detail;
			$detail = Yii::$app->request->post('value');
			foreach ($detail as $key => $value) {
				$_order_detail->order_id = $order_id;
				$_order_detail->menu_price = $value[1];
				$_order_detail->menu_number = $value[2];
				$info = Menu::find('id')->where(['menu_name' => $value[0]])->one();
				$_order_detail->menu_id = $info['id'];
				$_order_detail->insert();
			}
			//增加用户积分
			$user = WUser::findOne($order->user_id);
			$user->credit = $user->credit+$order->total_price*0.1;
			$user->save();
			echo 'success';
		}
	}
}

?>