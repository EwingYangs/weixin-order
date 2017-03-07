<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\MenuType;
use app\models\Menu;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

class MenuController extends Controller{
	 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	//查询出所有的类型
    	$types = MenuType::find()->asArray()->all();
    	//查询出所有的菜单
    	$menus = Menu::find()->select('w_menu.*,m.type_name')->joinWith('menuType as m')->where(['w_menu.is_delete' => 0])->asArray()->all();
        return $this->render('index',['type' => $types , 'menu' => $menus]);
    }

    public function actionAjaxAdd(){
			$model = new Menu;
			//接收整个表单
			$model->attributes = YII::$app->request->post();
			//处理图片
			if($_FILES['imageFile']['error'] != 4){
				$upload = new UploadForm();
				$upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
				$file_path = $upload->upload();
	            if ($file_path) {
	                // 文件上传成功
	                $model->menu_logo = $file_path;
	            }else{
	            	echo '文件上传失败，原因是'.$upload->getErrors('imageFile')[0];
	            	die;
	           	}
			}
			//验证表单insert的时候会验证
			if($model->insert()){
				Yii::$app->getSession()->setFlash('success', '保存成功');
				echo 'success';
			}else{
				//输出错误的信息
				$str = '';
                foreach($model->getErrors() as $k=>$v){
                    $str .= $v[0].'</br>';
                }
                echo $str;
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
        $file_path = Menu::find()->select('menu_logo')->where(['id' => $id])->asArray()->one();
    	if(Menu::findOne($id)->delete()){
    		Yii::$app->getSession()->setFlash('success', '删除成功');
    		//删除图片
    		unlink($file_path['menu_logo']);
    		echo 'success';
    		die;
    	}else{
    		echo '删除失败';
    	}
    }

    public function actionAjaxUpdate(){
        $model = new Menu();
        $id = Yii::$app->request->post('id');
        $model = $model->findOne($id);
        $model->attributes = YII::$app->request->post();
        //处理图片
        if($_FILES['imageFile']['error'] != 4){
            $upload = new UploadForm();
            $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
            $file_path = $upload->upload();
            if ($file_path) {
                // 文件上传成功
                $model->menu_logo = $file_path;
                //删除旧文件
                $file_path = Menu::find()->select('menu_logo')->where(['id' => $id])->asArray()->one();
                unlink($file_path['menu_logo']);
            }else{
                echo '文件上传失败，原因是'.$upload->getErrors('imageFile')[0];
                die;
            }
        }
        //验证表单save的时候会验证
        if($model->save()){
            Yii::$app->getSession()->setFlash('success', '更新成功');
            echo 'success';
            die;
        }else{
            //输出错误的信息
            $str = '';
            foreach($model->getErrors() as $k=>$v){
                $str .= $v[0].'</br>';
            }
            echo $str;
        }
    }
}



