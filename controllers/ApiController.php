<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\MenuType;
use app\models\Menu;
use app\models\Info;

class ApiController extends Controller{

    /**
     * [获取类型的接口]
     * @AuthorHTL @Ewing
     * @DateTime  2017-02-12T09:59:35+0800
     * @return    [type]   jsonp                [description]
     */
	 public function actionGetType(){
        $typeData = MenuType:: find()->where(['is_delete' => 0])->asArray()->all();
        echo json_encode($typeData);
     }

     /**
      * [根据类型Id获取菜单的接口]
      * @AuthorHTL @Ewing
      * @DateTime  2017-02-12T10:00:14+0800
      * @return    [type]  jsonp              [description]
      */
     public function actionGetMenu(){
        $type_id = Yii::$app->request->get('type_id');
        $menuData = Menu::find()->where(['menu_type' => $type_id])->asArray()->all();
        echo json_encode($menuData);
     }

     /**
      * [获取用户积分的接口]
      * @AuthorHTL @Ewing
      * @DateTime  2017-02-12T10:05:55+0800
      * @return    [type]    jsonp               [description]
      */
     public function actionGetUserScore(){

     }

     /**
      * [获取餐桌数量的接口]
      * @AuthorHTL
      * @DateTime  2017-02-26T00:39:13+0800
      * @return    [type]                   [description]
      */
     public function actionGetTableNumber(){
        //设置缓存
        $room_id = Yii::$app->request->get('room_id');
        $table_number = Info::find()->select('table_number')->where(['room_id' => $room_id])->asArray()->one();
        echo json_encode($table_number['table_number']);
     }
}



