<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>微信点餐系统后台登录</title>
<script src="<?=Yii::$app->params['js_url'].'jquery-1.11.1.min.js'?>"></script>
<script src="<?=Yii::$app->params['js_url'].'bootstrap.min.js'?>"></script>
<script src="<?=Yii::$app->params['js_url'].'toastr.min.js'?>"></script>

<link href="<?=Yii::$app->params['css_url'].'toastr.min.css'?>" rel="stylesheet">
<link href="<?=Yii::$app->params['css_url'].'styles.css'?>" rel="stylesheet">
<link href="<?=Yii::$app->params['css_url'].'bootstrap.min.css'?>" rel="stylesheet">

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" style="text-align:center;padding-top:3px"><h3>微信点餐系统后台</h3></div>
				<div class="panel-body">
					<form role="form" action="<?=Yii::$app->urlManager->createUrl('site/login')?>" method="post">
						<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="User-name" name="LoginForm[username]" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="LoginForm[password]" type="password" value="">
							</div>
							
							<p class="text-right"><input type="submit" value="登录" class="btn btn-primary"></p>

						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	

	<script>
		$(function(){
			var msg= '<?=json_encode($model->getErrors())?>';
			var msg = $.parseJSON(msg);
			if(msg.length != 0){
				if(msg['password']){
					toastr.error(msg['password'],"温馨提示");
				}else if(msg['username']){
					toastr.error(msg['username'],"温馨提示");
				}
			}
		});
		
	</script>	
</body>

</html>
