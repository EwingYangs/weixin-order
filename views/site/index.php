<?php

/* @var $this yii\web\View */

$this->title = '管理后台首页';
$this->context->layout = 'order';
$this->registerJsFile('/js/bootstrap-table.js');
$this->registerJsFile('/js/chart-data.js');
$this->registerJsFile('/js/chart.min.js');
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->
        
        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >网页模板</a></div>
        
        <div class="row">
            <a href="<?=Yii::$app->urlManager->createUrl('order/index')?>">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-blue panel-widget ">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                            <em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large"><?=$data['orders'] ? $data['orders']: '0'?></div>
                            <div class="text-muted">New Orders</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
            <a href="<?=Yii::$app->urlManager->createUrl('menu/index')?>">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-orange panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                            <em class="glyphicon glyphicon-cutlery glyphicon-l"></em>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large"><?=$data['menus'] ? $data['menus']: '0'?></div>
                            <div class="text-muted">Menus</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
            <a href="<?=Yii::$app->urlManager->createUrl('user/index')?>">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-teal panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                            <em class="glyphicon glyphicon-user glyphicon-l"></em>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large"><?=$data['users'] ? $data['users']: '0'?></div>
                            <div class="text-muted">Total Users</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-red panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                            <em class="glyphicon glyphicon-usd glyphicon-l"></em>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">￥<?=$data['money'] ? $data['money']: '0'?></div>
                            <div class="text-muted">Total Money</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">每天收入金额统计</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>New Orders</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Comments</h4>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>New Users</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Visitors</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
                                
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">每天订单数量统计</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart-order" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>  <!--/.main-->
<script>
var days_income = <?=$days_income["days_income"]?>;
var days_order = <?=$days_order["days_order"]?>;
var days = <?=$days_income["days"]?>;</script>