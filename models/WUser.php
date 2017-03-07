<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;



class WUser extends \yii\db\ActiveRecord
{
    //删除和新增加的行为
    // public function behaviors()
    // {
    //     // return [
    //     //     'timestamp' => [
    //     //         'class' => 'yii\behaviors\TimestampBehavior',
    //     //         'attributes' => [
    //     //             ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
    //     //         ],
    //     //     ],
    //     // ];
    // }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickName','avatarUrl','openid'], 'required'],
            [['unionid', 'openid'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickName' => '微信名称',
            'avatarUrl' => '微信头像',
            'gender' => '性别',
            'credit' => '客户积分',
            'openid' => '用户微信标识',
            'unionid' => '微信跟小程序通用的用户ID',
            'create_at' => '创建时间',
        ];
    }


    public function getUserByOpenId($openid){
        $user = WUser::find()->where(['openid' => $openid])->asArray()->one();
        return $user;
    }


    public function addUser($userInfo){
        $model = new WUser();
        $model->nickName = $userInfo->nickname;
        $model->avatarUrl = $userInfo->headimgurl;
        $model->gender = $userInfo->sex;
        $model->openid = $userInfo->openid;
        $model->insert();
    }
}