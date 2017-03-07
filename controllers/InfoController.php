<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Info;

class InfoController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$model = new Info();
    	$admin_id = '41';//获取管理员的ID
    	if(Yii::$app->request->post()){
    		$model->attributes = Yii::$app->request->post();
            $model->admin_id = $admin_id;
    		$data = $model->getInfoData($admin_id);
    		if(!$data){
    			//插入新的数据
    			if($model->insert()){
                    Yii::$app->getSession()->setFlash('success', '保存成功');
                }else{
                    //输出错误的信息
                    Common::pushRuleErro($model->getErrors());
                }
    		}else{
    			//更新数据
                $data->attributes = Yii::$app->request->post();
    			$data->save();
                 Yii::$app->getSession()->setFlash('success', '保存成功');
    		}
    	}
    	$info_data = $model->getInfoData($admin_id);
        return $this->render('index',['info' => $info_data]);
    }

}



