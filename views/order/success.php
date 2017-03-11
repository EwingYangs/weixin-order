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
        
   
   <!-- 删除模态框 -->
    <div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">

            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">你确定要配送吗？</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" userid="" class="btn btn-primary" id="deleteUser">确定</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php
    $this->beginBlock('service') ?>
        $("#file-3").fileinput({
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
        });
        $("#file-4").fileinput({
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
        });
    <?php $this->endBlock() ?>
    <?php $this->registerJs($this->blocks['service'], \yii\web\View::POS_END);
?>
<script>
    $('#addMenu').click(function(){
        var addurl = "<?=Yii::$app->urlManager->createUrl('menu/ajax-add');?>";
        //console.log(data);
        //ajax增加类型
        $.ajax({
            type : 'post',
            processData: false,
            contentType: false,
            url : addurl,
            data : new FormData($('#commentForm')[0]),
            success : function(data){
                if(data =='success'){
                    //关闭模态框
                    $('#myModal').modal('hide');
                    //刷新页面
                    window.location.reload();
                }else{
                    toastr.error(data);
                }
            },

        });
    });

    $('#deleteUser').click(function(){
        var id = $(this).attr('typeid');
        var deleteurl = "<?=Yii::$app->urlManager->createUrl('menu/ajax-delete');?>"+"?id="+id;
        //ajax删除类型
        $.ajax({
            type : 'get',
            url : deleteurl,
            success : function(data){
                if(data =='success'){
                    //关闭模态框
                    $('#myModal').modal('hide');
                    //刷新页面
                    window.location.reload();
                }else{
                    toastr.error(data);
                }
            },

        });
    });

    $('#editType').click(function(){
        var updateurl = "<?=Yii::$app->urlManager->createUrl('menu/ajax-update');?>";
        //ajax编辑类型
        // alert($('#number').val());
        $.ajax({
            type : 'post',
            url  : updateurl,
            processData: false,
            contentType: false,
            data : new FormData($('#commentForm1')[0]),
            success : function(data){
                if(data =='success'){
                    //关闭模态框
                    $('#myModal').modal('hide');
                    //刷新页面
                    window.location.reload();
                }else{
                    toastr.error(data);
                }
            },

        });
    });
</script>

 
