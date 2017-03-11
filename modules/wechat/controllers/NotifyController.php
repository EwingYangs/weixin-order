<?php
namespace app\modules\wechat\controllers;
use yii;
use yii\web\Controller;
require_once(Yii::getAlias('@wxPay') . '/lib/WxPay.Api.php');
require_once(Yii::getAlias('@wxPay') . '/lib/WxPay.Notify.php');
require_once(Yii::getAlias('@wxPay') . '/log.php');

class NotifyController extends Controller{
	public $enableCsrfValidation = false;
    
    public function actionNotify()
    {
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
    }
}
class PayNotifyCallBack extends \WxPayNotify{
	    //查询订单
	    public function Queryorder($transaction_id)
	    {
	        $input = new \WxPayOrderQuery();
	        $input->SetTransaction_id($transaction_id);
	        $result = \WxPayApi::orderQuery($input);
	        if (array_key_exists("return_code", $result)
	            && array_key_exists("result_code", $result)
	            && $result["return_code"] == "SUCCESS"
	            && $result["result_code"] == "SUCCESS"
	        ) {
	            return true;
	        }
	        return false;
	    }

	    //重写回调处理函数
	    public function NotifyProcess($data, &$msg)
	    {
	        if (!array_key_exists("transaction_id", $data)) {
	            $msg = "输入参数不正确";
	            return false;
	        }

	        //查询订单，判断订单真实性
	        if (!$this->Queryorder($data["transaction_id"])) {
	            $msg = "订单查询失败";
	            return false;
	        }

	        $result = $data;

	        //支付成功添加订单数据

	        // $out_trade_no = trim($result["out_trade_no"]);
	        // $trade_no = trim($result['transaction_id']);
	        // $total_fee = trim($result['total_fee'] * 0.01);
	        // $own = $result['attach'];
	        // $username = UserAdmin::findone($own)->username;

	        // $orderModel = new Order();
	        // $orderModel->own = $own;
	        // $orderModel->number = $out_trade_no;
	        // $orderModel->amount = $total_fee;
	        // $orderModel->username = $username;
	        // $orderModel->type = Yii::$app->params['PayType']['weixin'];
	        // $orderModel->status = Yii::$app->params['PayStatus']['success'];
	        // $save = $orderModel->save();        
	        // if($save){
	        //     UserAdmin::updateAllCounters(['amount'=>+$total_fee],'id='.$own);
	        // }
	        return true;
	    }
}

?>