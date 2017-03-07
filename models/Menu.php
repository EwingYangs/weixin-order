<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "w_menu".
 *
 * @property integer $id
 * @property string $menu_name
 * @property integer $price
 * @property integer $menu_type
 * @property integer $menu_number
 * @property string $menu_logo
 * @property integer $update_at
 * @property integer $create_at
 * @property integer $is_delete
 */
class Menu extends \yii\db\ActiveRecord
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
        return 'w_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_name','price', 'menu_type', 'menu_number'], 'required'],
            [['price', 'menu_type', 'menu_number', 'update_at', 'create_at', 'is_delete'], 'integer'],
            [['menu_name', 'menu_logo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_name' => '菜单名称',
            'price' => '价格',
            'menu_type' => '菜单类型',
            'menu_number' => '数量',
            'menu_logo' => '菜单图片',
            'update_at' => '更新时间',
            'create_at' => '创建时间',
            'is_delete' => '是否删除',
        ];
    }

    public function getMenuType()
    {
    /**
    * 第一个参数为要关联的字表模型类名称，
    *第二个参数指定 通过子表的 customer_id 去关联主表的 id 字段
    */
        return $this->hasMany(MenuType::className(), ['id' => 'menu_type']);
    }
}
