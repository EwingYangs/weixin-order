<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\WUser;
use yii\filters\AccessControl;

class UserController extends Controller{
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
    	//获取用户信息
        $num = WUser:: find()->count();
    	$users = WUser:: find()->asArray()->all();
        return $this->render('index',['users' => $users,'num' => $num]);
    }

     /**
     * [ajax删除类型]
     * @AuthorHTL
     * @DateTime  2017-01-26T18:16:50+0800
     * @return    [type]                   [description]
     */
    public function actionAjaxDelete(){
    	$id = Yii::$app->request->get('id');
    	if(WUser::findOne($id)->delete()){
    		Yii::$app->getSession()->setFlash('success', '删除成功');
    		echo 'success';
    		die;
    	}else{
    		echo '删除失败';
    	}
    }
}



