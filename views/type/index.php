<?php
$this->title = '类型管理';
$this->context->layout = 'order';
$this->registerJsFile(Yii::$app->params['js_url'].'bootstrap-table.js');
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">类型管理</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">类型列表
                    <button style="float:right;margin-top:10px" class="btn btn-primary" data-target="#myModal" id="btn-todo" data-toggle="modal">添加类型</button>
                    </div>

                    <div class="panel-body">
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="state" data-checkbox="true" >Item ID</th>
						        <th data-field="id" data-sortable="true">类型编号</th>
						        <th data-field="name"  data-sortable="true">类型名称</th>
                                <th data-field="delete">操作</th>
						    </tr>
                            
						    </thead>
                            <?php foreach($typeData as $k=>$v){?>
                                <tr>
                                    <td data-field="state" data-checkbox="true" >Item ID</td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['type_name']?></td>
                                    <td><a style="cursor: pointer;" data-target="#myModal1" data-toggle="modal" onclick="$('#deleteType').attr('typeid',<?=$v['id']?>)">删除</a> | <a style="cursor: pointer;" data-target="#myModal2" data-toggle="modal" onclick="$('#menu_name_edit').val('<?=$v['type_name']?>');$('#editType').attr('typeid',<?=$v['id']?>)">编辑</a></td>
                                </tr>
                            <?php }?>
						</table>
					</div>
                </div>
            </div>
        </div><!--/.row--> 
</div>

        <!-- 弹出的模态框（新增） --> 
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">新增类型</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="commentForm" novalidate="novalidate">
                    	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型名称：</label>
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



    <!-- 编辑的模态框 -->
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">编辑类型</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="commentForm_edit" novalidate="novalidate">
                        <input name="_csrf" type="hidden" id="_csrf_edit" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型名称：</label>
                            <div class="col-sm-8">
                                <input id="menu_name_edit" name="menu_name" minlength="1" type="text" class="form-control" required="" aria-required="true" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button typeid="" type="button" class="btn btn-primary" id="editType">保存</button>
                </div>
            </div>
        </div>
    </div>

<script>
	//点击保存按钮实现类型的增加，并且关闭模态框
	$('#addType').click(function(){
        var addurl = "<?=Yii::$app->urlManager->createUrl('type/ajax-add');?>";
		//ajax增加类型
		$.ajax({
			type : 'post',
			url : addurl,
			data : {name : $('#menu_name').val(),_csrf : $('#_csrf').val()},
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
        var deleteurl = "<?=Yii::$app->urlManager->createUrl('type/ajax-delete');?>"+"?id="+id;
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
        var updateurl = "<?=Yii::$app->urlManager->createUrl('type/ajax-update');?>";
        //ajax编辑类型
        $.ajax({
            type : 'post',
            url : updateurl,
            data : {name : $('#menu_name_edit').val(),_csrf : $('#_csrf_edit').val(),id : $('#editType').attr('typeid')},
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

