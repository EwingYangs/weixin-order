<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;



class Order extends \yii\db\ActiveRecord
{

    public static $pay_status = ['未支付','支付完成'];
    //删除和新增加的行为
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','order_status','pay_status','total_price','table_number'], 'required'],
            [['remark'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '客户ID',
            'order_status' => '订单状态',
            'order_time' => '订单生成时间',
            'pay_status' => '支付状态',
            'pay_time' => '支付时间',
            'total_price' => '订单的总价',
            'table_number' => '订单所在的桌子编号',
            'remark' => '订单备注',
            'people' => '就餐人数',
        ];
    }


   
}