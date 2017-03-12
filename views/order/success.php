<?php
$this->title = '订单管理';
$this->context->layout = 'order';
$this->registerJsFile(Yii::$app->params['js_url'].'bootstrap-table.js');
use app\models\Order;
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">订单管理</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">已配送订单列表
                    
                    </div>

                    <div class="panel-body">
                        <table data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name,type" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">用户编号</th>
                                <th data-field="userid" data-sortable="true">用户Id</th>
                                <!-- <th data-field="avatarUrl">用户头像</th> -->
                                <th data-field="order_time" data-sortable="true">订单生成时间</th>
                                <th data-field="pay_status">支付状态</th>
                                <th data-field="pay_time" data-sortable="true">支付时间</th>
                                 <th data-field="detail">订单详情</th>
                                <th data-field="total_price" data-sortable="true">订单的总价</th>
                                <th data-field="table_number" data-sortable="true">桌子编号</th>
                                <th data-field="remark" data-sortable="true">订单备注</th>
                                <th data-field="people" data-sortable="true">就餐人数</th>
                            </tr>
                            
                            </thead>
                            <?php foreach($order as $k=>$v){?>
                                <tr>
                                    <td data-field="state" data-checkbox="true" >Item ID</td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['user_id']?></td>
                                    
                                    <td><?=date('Y-m-d H:i',$v['order_time'])?></td>
                                    <td><?=Order::$pay_status[$v['pay_status']]?></td>
                                    <td><?=date('Y-m-d H:i',$v['pay_time'])?></td>
                                    <td><?=$v['detail']?></td>
                                    <td><?='￥'.$v['total_price']?></td>
                                    <td><?=$v['table_number']?></td>
                                    <td><?=$v['remark']?></td>
                                    <td><?=$v['people']?></td>
                                    
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row--> 
</div>
        
   
  
    
    

<script>
    

    

    
</script>

 
