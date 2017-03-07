<?php
namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "w_menu".
 *
 * @property integer $room_id
 * @property string $room_name
 * @property integer $room_addr
 * @property intege  $table_number
 * @property integer $admin_id
 * @property integer $update_at
 * @property integer $create_at
 */
class Info extends \yii\db\ActiveRecord
{
    //删除和新增加的行为
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_a_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_name', 'table_number'], 'required'],
            [['table_number', 'update_at', 'create_at'], 'integer'],
            [['room_addr'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'ID',
            'room_name' => '餐厅名称',
            'room_addr' => '餐厅地址',
            'table_number' => '餐桌数量',
            'admin_id' => '商家ID',
            'update_at' => '更新时间',
            'create_at' => '创建时间',
        ];
    }

    public function getInfoData($admin_id){
        $info = Info::findOne(['admin_id' => $admin_id]);
        return $info;
    }   
}