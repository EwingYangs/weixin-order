<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use app\models\Menu;



class OrderDetail extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id','menu_id','menu_number','menu_price'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单ID',
            'menu_id' => '菜式ID',
            'menu_number' => '菜式数量',
            'menu_price' => '菜式单价',
        ];
    }

    public function getMenu()
    {
    /**
    * 第一个参数为要关联的字表模型类名称，
    *第二个参数指定 通过子表的 customer_id 去关联主表的 id 字段
    */
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }
   
}