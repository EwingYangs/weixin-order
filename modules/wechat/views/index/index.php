<?php
$this->title = '点餐首页';
use app\models\Order;
?>
<style>
	
</style>
<!-- 头部信息 -->
<header data-am-widget="header" class="am-header am-header-default sq-head">
    <div class="am-tab-panel am-fade am-in am-active" >
	
    <div class="am-header-right">
        <span class="am-monospace" style="color:red"><span class="am-icon-flag"></span>&nbsp;下单可享受，每满30减3</span>
        <span class="am-monospace" style="float:right;color:gray">当前的积分：2</span>
    </div>
	</div>
</header>
	 <div class="fix-head" style="padding:0px;margin:0px">
	 	<div class="am-tabs" id="click_div">
		  <ul class="am-nav am-nav-tabs am-nav-justify" style="">
		    <li class="am-active" id="order"><a><span class="am-icon-fire"></span>&nbsp;点餐</a></li>
		    <li class="" id="user"><a><span class="am-icon-user"></span>&nbsp;个人中心</a></li>
		    <li class="" id="history"><a><span class="am-icon-bookmark-o"></span>&nbsp;历史订单</a></li>
		  </ul>
		</div>
	 </div>
	<div id="box">
	<div class="am-show tabslist" id="div_order">
		<div>
		    <div class="">
		    	<div class="list-left" id="tab"></div>
		    	<div class="list-right" id="content_div">
		    	</div>
		    	<!-- <form> -->
		    </div>
		</div>
		<!--底部-->
			<!-- <div style="height: 100px;"></div> -->
		<div class="fix-bot">
			   	  <a href="" class="list-js">合计：<i><span id="money">0<span>元</i><em>(<span id="number">0</span>份)</em></a>
			   	  <a href="javascript:void(0)" id="affirm" class="list-jsk">立即下单</a>
		</div>
	</div>
	<div class="am-hide tabslist list-tabs" id="div_user">
		    	<img style="padding:10px" class="am-circle" src="<?=isset($userInfo->headimgurl) ? $userInfo->headimgurl : 'http://img3.imgtn.bdimg.com/it/u=275622820,2944364039&fm=21&gp=0.jpg'?>" width="80" height="80"/>
		    	&nbsp;&nbsp;&nbsp;<?=isset($userInfo->nickname) ? $userInfo->nickname : '未登录'?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    	<span style="color:gray">所在城市：<?=isset($userInfo->city) ? $userInfo->city : '未知'?><span>
		    </ul>
		    <div class="juli"></div>
		    <ul class="list-detail">
		    	<li class="time">
		    		<span>订单</span>
		    		
		    		<i class="am-icon-angle-right"></i>
		    	</li>
		    	<li class="time">
		    		<span>线上积分</span><span style="float:right;color:red">34.00
		    		</span>
		    		<i class="am-icon-angle-right"></i>
		    	</li>
		    	<li class="time">
		    		<span>门店活动</span>
		    		<i class="am-icon-angle-right"></i>
		    	</li>
		    </ul>
	</div>
	<div class="am-hide tabslist list-tabs" id="div_history">
		<ul class="address-list">
			<?if($order){?>
			<?php foreach($order as $k=>$v){?>
	    	<li>
			<p>订餐人：<?=$v['wUser']['nickName']?>&nbsp;&nbsp;&nbsp;&nbsp;订单号：<?=$v['id']?></p>
			<!-- <p class="order-add1">信息：排骨X5+鱼X3</p> -->
			<p class="order-add1">订单总价：<?=$v['total_price']?>元<span style="float:right">订单状态：<?=Order::$order_status[$v['order_status']]?></span></p>
			<p class="order-add1">下单时间：<?=date('Y-m-d H:i:s',$v['order_time'])?></p>
			<p class="order-add1">支付状态：<?=Order::$pay_status[$v['pay_status']]?></p>
			<hr />
			<div class="address-cz">
				<label class="am-radio am-warning">
					<input type="radio" name="radio1" value="" data-am-ucheck checked>餐桌号:<?=$v['table_number']?>
				</label>
                 <button  order_id= "<?=$v['id']?>" id="detail" style="margin-left:60px;" type="button" class="am-btn am-btn-warning am-radius am-btn-xs">查看详情</button>
                 <button  type="button" class="am-btn am-btn-success am-radius am-btn-xs am-fr" data-am-modal="{target: '#my-alert'}">取消订单</button>
			</div>
			</li>
			<?php }}else{?>
			暂时没有订单！
			<?php }?>
	    </ul>
		
	</div>
</div>

<!--  <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
		  <div class="am-modal-dialog">
		    <div class="am-modal-bd" style="height: 80px; line-height: 80px;">  您确定要取消该订单吗？取消后支付的金额原路返回</div>
		    <div class="am-modal-footer">
		      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
		      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
		    </div>
		  </div>
		</div> -->
<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">取消订单</div>
    <div class="am-modal-bd">
      您确定要取消该订单吗？取消后支付的金额原路返回
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
	  <span class="am-modal-btn" data-am-modal-confirm>确定</span>
    </div>
  </div>
</div>
<!-- 模态框 -->
<!-- <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-bd" style="height: 80px; line-height: 80px;">  您确定要清空饮品吗？</div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
    </div>
  </div>
</div> -->

<script>

</script>


<?php
    $this->beginBlock('service') ?>
	
	$('#detail').click(function(){
		order_id = $(this).attr('order_id');
		location.href = "<?=Yii::$app->urlManager->createUrl('wechat/index/order/').'?id='?>"+order_id;
	});

    $('#div_history').find('li').click(function(){
		$('#div_history').find('li').removeClass();
		$(this).addClass('curr');
	});
    $('#click_div').find('li').click(function(){
    		$('#click_div').find('li').removeClass('am-active');
			$(this).addClass('am-active');
			var name = '#div_'+$(this).attr('id');
			$('#box').children('.tabslist').addClass('am-hide');
			$(name).removeClass('am-hide');
			$(name).addClass('am-show');
	});
    $(function() {
    	$('#doc-my-tabs').tabs();
  	})
    	var serverName = "http://www.gdqcyl.pub/";
    	var orderUrl = "<?=Yii::$app->urlManager->createUrl('wechat/index/order')?>";
$(function(){
	//ajax获取类型
	url = "<?=Yii::$app->urlManager->createUrl('api/get-type')?>";
	$.ajax({
		type : 'get',
		dataType : 'json',
		url : url,
		success : function(data){
			var html = '';
			$(data).each(function(v,k){
				if(v == 0){
					html = '<li onclick="show(this)" id='+k.id+' class="current"><a>'+k.type_name+'</a></li>';
				}else{
					html += '<li onclick="show(this)" id='+k.id+'><a>'+k.type_name+'</a></li>';
				}
			});
			$('#tab').html(html);
			var first_li = $('.current');
			show(first_li);
		}
	});

})


var type_list = [];
/**
 * [根据类型显示对应的菜单]
 * @AuthorHTL @Ewing
 * @DateTime  2017-02-12T23:41:22+0800
 * @return    {[type]}                 [description]
 */
function show(li){

	var type_id = $(li).attr('id');
	$('li').removeClass('current');
	$(li).addClass('current');
	//ajax获取菜单
	url = "<?=Yii::$app->urlManager->createUrl('api/get-menu')?>?type_id="+type_id;
	$.ajax({
		type : 'get',
		dataType : 'json',
		url : url,
		success : function(data){
			$('#content_div').find('ul').hide();
			if($.inArray(type_id,type_list) != -1){
				$('ul[type='+type_id+']').show();
			}else{
				type_list.push(type_id);
				var html = '<ul class="list-pro" type="'+type_id+'">';
				$(data).each(function(k,v){
					html += '<li><a href=""><img src="'+serverName+v.menu_logo+'" class="list-pic"/></a><div class="shop-list-mid"><div class="tit">'+v.menu_name+'</div><div class="am-gallery-desc">￥'+v.price+'</div></div><div class="list-cart"><div class="d-stock "><a class="decrease" onclick="delete_menu(this)">-</a><input id="num" readonly="" class="text_box" name="num" type="text" value="0"><a class="increase" onclick="add(this)">+</a></div></div></li>';
				});
				html += '</ul>';
				$('#content_div').append(html);
			}
		}
	});
}

var number = parseInt($('#number').html());//获取数量
var money = parseInt($('#money').html());//获取总价格
//购物数量加减
function add(object){
	var self = $(object);
	var current_num = parseInt(self.siblings('input').val());
	current_num += 1;
	if(current_num > 0){
		self.siblings(".decrease").fadeIn();
		self.siblings(".text_box").fadeIn();
	}
	self.siblings('input').val(current_num);
	number += 1;
	$('#number').html(number);
	// update_item(self.siblings('input').data('item-id'));
	
	var li_money = self.parent().parent().parent().find('.am-gallery-desc').html()//获取对应的价格
	li_money = parseInt(li_money.substr(1));
	money = money + li_money;
	$('#money').html(money+'元');	
}

function delete_menu(object){
	var self = $(object);
	var current_num = parseInt(self.siblings('input').val());
	if(current_num > 0){
		current_num -= 1;
        if(current_num < 1){
            self.fadeOut();
			self.siblings(".text_box").fadeOut();
        }
		self.siblings('input').val(current_num);
		// update_item(self.siblings('input').data('item-id'));
	}
	number -= 1;
	number = number < 0 ? 0 : number;
	$('#number').html(number);

	var li_money = self.parent().parent().parent().find('.am-gallery-desc').html()//获取对应的价格
	li_money = parseInt(li_money.substr(1));
	money = money - li_money;
	money = money < 0 ? 0 :money;
	$('#money').html(money+'元');
}


    
//删除提示信息   
    $(function() {
  $('#doc-modal-list').find('.am-icon-close').add('#doc-confirm-toggle').
    on('click', function() {
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          var $link = $(this.relatedTarget).prev('a');
          var msg = $link.length ? '你要删除的饮品 为 ' + $link.data('id') :
            '确定了';
//        alert(msg);
        },
        onCancel: function() {
          alert('不删除');
        }
      });
    });
});

//tab切换
        $(function(){
                window.onload = function()
                {
                        var $li = $('#tab li');
                        var $ul = $('#content ul');
                        $li.click(function(){
                                var $this = $(this);
                                var $t = $this.index();
                                $li.removeClass();
                                $this.addClass('current');
                                $ul.css('display','none');
                                $ul.eq($t).css('display','block');
                        })
                }
        });

 $('#affirm').click(function(){
 	//判断是否可以提交
 	

 	if(money <= 0){
 		//禁止跳转
 		return false;
 	}else{
 		//把信息都保存在浏览器的cookie里面(key value)
 		var lis = $('#content_div').find('li');
 		var value = [];
 		lis.each(function(k,v){
 			var name = $(v).find('.tit').html();
 			var price = $(v).find('.am-gallery-desc').html().substr(1);
 			var num = parseInt($(v).find('#num').val());
 			if(num > 0){
 				value.push([name,price,num]);
 			}
 		});
 		// var value = value.toJSONString();
 		setCookie('menu_data',value);
 		location.href = orderUrl;
 		// $('#theForm').submit();
 		
 	}
 });


 //*******************设置和读取浏览器的cookie****************
		function setCookie(name,value)
		{
			var Days = 30;//设置过期的天数
			var exp = new Date();
			exp.setTime(exp.getTime() + Days*24*60*60*1000);
			document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
		}
		function getCookie(name)
		{
			var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
			if(arr=document.cookie.match(reg)){
				return unescape(arr[2]);
			}else{
				return null;
			}
		}
    <?php $this->endBlock() ?>
    <?php $this->registerJs($this->blocks['service'], \yii\web\View::POS_END);
    ?>
