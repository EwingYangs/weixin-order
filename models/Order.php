<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;



class Order extends \yii\db\ActiveRecord
{

    public static $pay_status = ['未支付','支付完成'];
    public static $order_status = ['等待接单','已接单'];
    //删除和新增加的行为
    // public function behaviors()
    // {
    //     return [
    //         'timestamp' => [
    //             'class' => 'yii\behaviors\TimestampBehavior',
    //             'attributes' => [
    //                 ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
    //             ],
    //         ],
    //     ];
    // }

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
            [['user_id','order_status','pay_status','total_price','table_number','transaction_id'], 'required'],
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
            'transaction_id' => '支付交易号',
        ];
    }


   public function getOrderDetail()
    {
    /**
    * 第一个参数为要关联的字表模型类名称，
    *第二个参数指定 通过子表的 customer_id 去关联主表的 id 字段
    */
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id'])->joinWith('menu as w');
    }

    public function getWUser(){
        return $this->hasOne(WUser::className(), ['id' => 'user_id']);
    }

    /**
     * [获取每天的收入总金额以及对应的日期数]
     * @AuthorHTL @嘉颖
     * @DateTime  2017-02-16T16:25:47+0800
     * @return    [type]                   [description]
     */
    public function getDaysIncome($count){
        //************获取每天的收入金额***************
        $days_income = array();
        for($i=1; $i <= $count ; $i++){
            if($i == 1){
                $day = strtotime(date('Y-m-d'));
                $income = Order::find()->where(['order_status' => '1'])->andWhere(['>','order_time',$day])->sum('total_price');
                $days_income[] = $income ? $income : '0';
            }else{
                $the_day = strtotime(date('Y-m-d',strtotime(-($i-2)." day")));
                $last_day = strtotime(date('Y-m-d',strtotime(-($i-1)." day")));
                $income =  Order::find()->where(['order_status' => '1'])->andWhere(['>','order_time',$last_day])->andWhere(['<','order_time',$the_day])->sum('total_price');
                $days_income[] = $income ? $income : '0';
            }
        }
        $days_income = json_encode(array_reverse($days_income));

        //***********获取日期数*****************
        $days = array();
        for($i=1; $i <= $count ; $i++){
            if($i == 1){
                $days[] = date('Y-m-d');
            }else{
                $days[] = date('Y-m-d',strtotime(-($i-1)." day"));
            }
        }
        $days = json_encode(array_reverse($days));

        //**********返回数据********************
        return array(
                'days' => $days,
                'days_income' => $days_income,
            );
    }

    /**
     * [获取每天的收入总金额以及对应的日期数]
     * @AuthorHTL @嘉颖
     * @DateTime  2017-02-16T16:25:47+0800
     * @return    [type]                   [description]
     */
    public function getDaysOrder($count){
        //************获取每天的收入金额***************
        $days_order = array();
        for($i=1; $i <= $count ; $i++){
            if($i == 1){
                $day = strtotime(date('Y-m-d'));
                $income = Order::find()->where(['order_status' => '1'])->andWhere(['>','order_time',$day])->count();
                $days_order[] = $income ? $income : '0';
            }else{
                $the_day = strtotime(date('Y-m-d',strtotime(-($i-2)." day")));
                $last_day = strtotime(date('Y-m-d',strtotime(-($i-1)." day")));
                $income =  Order::find()->where(['order_status' => '1'])->andWhere(['>','order_time',$last_day])->andWhere(['<','order_time',$the_day])->count();
                $days_order[] = $income ? $income : '0';
            }
        }
        $days_order = json_encode(array_reverse($days_order));

        //***********获取日期数*****************
        $days = array();
        for($i=1; $i <= $count ; $i++){
            if($i == 1){
                $days[] = date('Y-m-d');
            }else{
                $days[] = date('Y-m-d',strtotime(-($i-1)." day"));
            }
        }
        $days = json_encode(array_reverse($days));

        //**********返回数据********************
        return array(
                'days' => $days,
                'days_order' => $days_order,
            );
    }
}