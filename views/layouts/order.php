<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use common\widgets\Alert;
/* @var $this yii\web\View */
/* @var $content string 字符串 */

AppAsset :: register($this);//注册
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?//= Alert::widget() ?>
<?php
$alert = false;
if( Yii::$app->getSession()->hasFlash('success') ) {
    $alert = true;
    $msg =  Yii::$app->getSession()->getFlash('success');
?>
    <?php
    $this->beginBlock('service') ?>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "400",
    "hideDuration": "1000",
    "timeOut": "7000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    toastr.success("<?php echo $msg?>","温馨提示");
    <?php $this->endBlock() ?>
    <?php $this->registerJs($this->blocks['service'], \yii\web\View::POS_END);
    ?>
    <?php
}?>
<?php
if( Yii::$app->getSession()->hasFlash('error') ) {
    $alert = true;
    $msg =  Yii::$app->getSession()->getFlash('error');
   ?>

    <?php
    $this->beginBlock('service') ?>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "400",
    "hideDuration": "1000",
    "timeOut": "7000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    toastr.error("<?php echo $msg?>","操作失败");
    <?php $this->endBlock() ?>
    <?php $this->registerJs($this->blocks['service'], \yii\web\View::POS_END);
    ?>

    <?php
}?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span>微信点餐系统</span>&nbsp;后台管理</a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
        
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span>操作菜单</div>
        <ul class="nav menu">
            <li <?php if(Yii::$app->controller->id == 'index'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('index/index');?>"><span class="glyphicon glyphicon-home"></span> 主页</a></li>
            <li <?php if(Yii::$app->controller->id == 'menu'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('menu/index');?>"><span class="glyphicon glyphicon-dashboard"></span> 菜单管理</a></li>
            <li <?php if(Yii::$app->controller->id == 'type'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('type/index');?>"><span class="glyphicon glyphicon-edit"></span> 类型管理</a></li>
            <li <?php if(Yii::$app->controller->id == 'user'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('user/index');?>"><span class="glyphicon glyphicon-user"></span> 用户管理</a></li>
            <li <?php if(Yii::$app->controller->id == 'table'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('info/index');?>"><span class="glyphicon glyphicon-stats"></span> 餐厅基本信息</a></li>
            <li <?php if(Yii::$app->controller->id == 'data'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('data/index');?>"><span class="glyphicon glyphicon-list-alt"></span> 数据分析</a></li>
            <li <?php if(Yii::$app->controller->id == 'send'){echo 'class="active"';}?>><a href="<?=Yii::$app->urlManager->createUrl('send/index');?>"><span class="glyphicon glyphicon-pencil"></span> 微信推送</a></li>
            <li class="parent <?php if(Yii::$app->controller->id == 'order'){echo "active";}?>" >
                <a href="<?=Yii::$app->urlManager->createUrl('order/index');?>">
                    <span class="glyphicon glyphicon-list"></span> 订单管理 <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
                </a>
                <ul class="children collapse <?php if(Yii::$app->controller->id == "order"){echo "in";}?>" id="sub-item-1">
                    <li class='<?php if(Yii::$app->controller->id == "order" && Yii::$app->controller->action->id == "index"){echo "active";}?>'>
                        <a class="" href="<?=Yii::$app->urlManager->createUrl('order/index');?>">
                            <span class="glyphicon glyphicon-share-alt"></span> 等待接单列表
                        </a>
                    </li>
                    <li>
                        <a class="" href="<?=Yii::$app->urlManager->createUrl('order/success');?>">
                            <span class="glyphicon glyphicon-share-alt"></span> 已配送订单列表
                        </a>
                    </li>
                </ul>
            </li>
            <li role="presentation" class="divider"></li>
            <li><a href="login.html"><span class="glyphicon glyphicon-user"></span> Login Page</a></li>
        </ul>
        
    </div><!--/.sidebar-->
    <div class="main-wrap">
        <?=$content?>
    </div>
    <!--/main-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>