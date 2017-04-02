<?php
namespace app\modules\wechat\controllers;
use yii;
use yii\web\Controller;
use app\models\WUser;
use app\models\Order;

class IndexController extends Controller{
	public function actionIndex(){
		$code = Yii::$app->request->get('code');
		if($code){
			//如果传来code就做用户入库处理
			require 'wechat/wechat.php';
			$wechat = new \WeChat('wxc0813363b0684884','c99aae7d4ed073630559bf639abc11b4','weixin');
			$session = Yii::$app->session;
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
		$userInfo = isset($userInfo) ? $userInfo : null;
		$order = isset($order) ? $order : null;
		return $this->render('index',['userInfo' => $userInfo,'order' => $order]);
	}

	public function actionOrder(){
		$order_id = Yii::$app->request->get('id');
		return $this->render('order');
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
}

?>