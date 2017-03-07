<?php
namespace app\models;
use Yii;
//公共的方法类
Class Common{
	//输出模型验证的错误信息
	public static function pushRuleError($error){
		$str = '';
        foreach($error as $k=>$v){
            $str .= $v[0].'</br>';
        }
        Yii::$app->getSession()->setFlash('error', '保存失败，原因是'.$str);
	}
}
?>