<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetWechat extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/wechat/css/amazeui.min.css',
        'static/wechat/css/style.css',
    ];

    public $js = [
//        'Chart.min.js'
        //"static/panel/js/jquery-2.1.1.min.js",
        "static/wechat/js/jquery.min.js",
        "static/wechat/js/amazeui.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
