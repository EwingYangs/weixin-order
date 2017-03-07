<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\MenuType;

class TypeController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	//查询出全部类型
    	$typeData = MenuType:: find()->where(['is_delete' => 0])->asArray()->all();
        return $this->render('index',['typeData' => $typeData]);
    }

    /**
     * [ajax增加类型]
     * @AuthorHTL
     * @DateTime  2017-01-26T18:16:27+0800
     * @return    [type]                   [description]
     */
    public function actionAjaxAdd(){
    	$model = new MenuType();
		//接收整个表单
		$model->type_name = Yii::$app->request->post('name');
		//验证表单insert的时候会验证
		if($model->insert()){
			//成功
			Yii::$app->getSession()->setFlash('success', '保存成功');
			echo 'success';
			die;
		}else{
			//失败
			$error = $model->getErrors('type_name');
			echo $error[0];
		}

    }

    /**
     * [ajax删除类型]
     * @AuthorHTL
     * @DateTime  2017-01-26T18:16:50+0800
     * @return    [type]                   [description]
     */
    public function actionAjaxDelete(){
    	$id = Yii::$app->request->get('id');
    	if(MenuType::findOne($id)->delete()){
    		Yii::$app->getSession()->setFlash('success', '删除成功');
    		echo 'success';
    		die;
    	}else{
    		echo '删除失败';
    	}
    }


    public function actionAjaxUpdate(){
    	$model = new MenuType();
    	$id = Yii::$app->request->post('id');
    	$type_name = Yii::$app->request->post('name');
    	if($type_name){
    		//更新类型
    		$type = $model::findOne($id);
    		$type->type_name = $type_name;
    		if($type->save()){
    			Yii::$app->getSession()->setFlash('success', '更新成功');
    			echo 'success';
    			die;
    		}else{
    			$error = $type->getErrors('type_name');
    			echo $error[0];
    		}
    	}
    }

}



