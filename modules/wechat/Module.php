<?php

namespace app\modules\wechat;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * panel module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\wechat\controllers';

    public $layout="main.php";
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


}
