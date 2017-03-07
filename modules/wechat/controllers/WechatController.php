<?php
namespace app\modules\wechat\controllers;
use yii;
use yii\web\Controller;
use app\modules\wechat\models\wechatCallbackapiTest;

class WechatController extends Controller{
	const TOKEN = 'weixin';

	public function init(){
		$wechatObj = new wechatCallbackapiTest();
		$wechatObj->valid();//验证消息的正确性
	}

	public function actionIndex(){

	}


}

?>