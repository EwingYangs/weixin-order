<?php
$this->title = '餐桌管理';
$this->context->layout = 'order';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">餐厅基本信息</li>
            </ol>
        </div><!--/.row-->
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">基本信息设置</div>
        <div class="panel-body">
            <div class="col-md-6">
                <form role="form" method="post" action="" >
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <div class="form-group">
                        <label>餐厅名称：</label>
                        <input class="form-control" name="room_name" placeholder="请输入您餐厅的名称" value="<?php echo isset($info['room_name']) ? $info['room_name'] : ''?>">
                    </div>

                    <div class="form-group">
                        <label>餐厅地址：</label>
                        <input class="form-control" name="room_addr" placeholder="请输入您餐厅的地址" value="<?php echo isset($info['room_addr']) ? $info['room_addr'] : ''?>">
                    </div>

                    <div class="form-group">
                        <label>餐桌数量：</label>
                        <input class="form-control" name="table_number" placeholder="请输入餐桌的数量" value="<?php echo isset($info['table_number']) ? $info['table_number'] : ''?>">
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
    </div><!-- /.col-->
</div><!-- /.row -->

</div><!--/.main-->
</div>

        <!-- 弹出的模态框（新增） --> 
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">设置餐桌数量</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="commentForm" novalidate="novalidate">
                    	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">餐桌数量：</label>
                            <div class="col-sm-8">
                                <input id="menu_name" name="menu_name" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="addType">保存</button>
                </div>
            </div>
        </div>
    </div>


    