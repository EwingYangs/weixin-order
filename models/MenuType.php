<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "w_menu_type".
 *
 * @property integer $id
 * @property string $type_name
 * @property integer $is_delete
 */
class MenuType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_menu_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'unique'],
            [['is_delete'], 'integer'],
            [['type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => '类型名称',
            'is_delete' => '是否删除',
        ];
    }
}
