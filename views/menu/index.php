<?php
// use Yii; 
/* @var $this yii\web\View */
$this->title = '菜单管理';
$this->context->layout = 'order';
$this->registerJsFile(Yii::$app->params['js_url'].'bootstrap-table.js');
$this->registerJsFile(Yii::$app->params['js_url'].'fileinput.js');
$this->registerCssFile(Yii::$app->params['css_url'].'fileinput.css');
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">菜单管理</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">菜单列表
                    <button style="float:right;margin-top:10px" class="btn btn-primary" data-target="#myModal" id="btn-todo" data-toggle="modal">添加菜单</button>
                    </div>

                    <div class="panel-body">
                        <table data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name,type" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">菜单编号</th>
                                <th data-field="name" data-sortable="true">菜单名称</th>
                                <th data-field="type">菜单类型</th>
                                <th data-field="price" data-sortable="true">价格</th>
                                <th data-field="number"  data-sortable="true">数量</th>
                                <th data-field="logo">图片</th>
                                <th data-field="create_at" data-sortable="true">创建时间</th>
                                <th data-field="delete">操作</th>
                            </tr>
                            
                            </thead>
                            <?php foreach($menu as $k=>$v){?>
                                <tr>
                                    <td data-field="state" data-checkbox="true" >Item ID</td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['menu_name']?></td>
                                    <td><?=$v['type_name']?></td>
                                    <td><?=$v['price']?></td>
                                    <td><?=$v['menu_number']?></td>
                                    <td><img src="<?=Yii::$app->params['web_url'].$v['menu_logo']?>" width="80"></td>
                                    <td><?=date('Y-m-d H:i',$v['create_at'])?></td>
                                    <td><a style="cursor: pointer;" data-target="#myModal1" data-toggle="modal" onclick="$('#deleteType').attr('typeid',<?=$v['id']?>)">删除</a> | <a style="cursor: pointer;" data-target="#myModal2" data-toggle="modal" onclick="$('#menu_name_edit').val('<?=$v['menu_name']?>');$('#editType').attr('typeid',<?=$v['id']?>);$('#menu_price').val('<?=$v['price']?>');$('#number').val('<?=$v['menu_number']?>');$('#menu_type option').removeAttr('selected');$('#menu_type option[value=<?=$v['menu_type']?>]').attr('selected',true);$('#image').attr('src','<?=Yii::$app->params['web_url'].$v['menu_logo']?>');$('#edit_id').val('<?=$v['id']?>')">编辑</a></td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row--> 
</div>
        <!-- 弹出的模态框 --> 
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight" style="width:700px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">新增菜单</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="commentForm" novalidate="novalidate" enctype="multipart/form-data">
                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">菜单名称：</label>
                            <div class="col-sm-8">
                                <input id="" name="menu_name" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">数量：</label>
                            <div class="col-sm-8">
                                <input id="cname" name="menu_number" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="menu_type">
                                        <?php foreach($type as $k=>$v){?>
                                            <option value="<?=$v['id']?>"><?=$v['type_name']?></option>
                                        <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">菜单logo: </label>
                            <div class="col-sm-8">
                                <input id="file-3" type="file" name="imageFile">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">价格：</label>
                            <div class="col-sm-8">
                                <input id="price" name="price" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="addMenu">保存</button>
                </div>
            </div>
        </div>
    </div>
   
   <!-- 删除模态框 -->
    <div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">

            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">你确定要删除吗？</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" typeid="" class="btn btn-primary" id="deleteType">确定</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 编辑模态框 -->
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight" style="width:700px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">修改菜单</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="commentForm1" novalidate="novalidate" enctype="multipart/form-data">
                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="hidden" name="id" id="edit_id" value="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">菜单名称：</label>
                            <div class="col-sm-8">
                                <input id="menu_name_edit" name="menu_name" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">数量：</label>
                            <div class="col-sm-8">
                                <input id="number" name="menu_number" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="menu_type" id="menu_type">
                                        <?php foreach($type as $k=>$v){?>
                                            <option value="<?=$v['id']?>"><?=$v['type_name']?></option>
                                        <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">菜单logo: </label>
                            <div class="col-sm-8">
                                <img src="" id="image" width="100" style="margin:10px">
                                <input id="file-4" type="file" name="imageFile">
                                <span class="info">(如果你已经上传图片，再次上传将会覆盖)</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">价格：</label>
                            <div class="col-sm-8">
                                <input id="menu_price" name="price" minlength="1" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="editType">保存</button>
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

    $('#deleteType').click(function(){
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

 
