<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>茶部落</title>
		 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="css/amazeui.min.css" type="text/css" rel="stylesheet" />
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/amazeui.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/date.js" ></script>
		<script type="text/javascript" src="js/iscroll.js" ></script>
		<script type="text/javascript">
		$(function(){
			$('#beginTime').date();
			$('#endTime').date({theme:"datetime"});
		});
		</script>
	</head>
	<body>
		<header data-am-widget="header" class="am-header am-header-default sq-head ">
		   <div class="am-header-left am-header-nav">
	          <a href="/" class="">继续点餐</a>
           </div>
		   <div class="am-header-right am-header-nav">
	          <button type="button" class="am-btn am-btn-warning" id="doc-confirm-toggle" style="background: none; border: 0; font-size: 24px;">
                 <i class="am-header-icon am-icon-trash"></i>
	          </button>
            </div>
	   </header>
	   <div style="height: 49px;"></div>
	    <ul class="eat-list" id="menu_ul">
	    	
	    	<!-- <li>
	    		<span class="name">绿茶</span>
	    		<em class="price">￥2.0</em>
	    		<div class="d-stock ">
	                <a class="decrease">-</a>
	                <input id="num" readonly="" class="text_box" name="" type="text" value="1">
	                <a class="increase">+</a>
			    </div>
	    	</li> -->
	    </ul>
	    <div class="juli"></div>
	    <ul class="list-detail">
	    	<li class="time">
	    		<span>就餐人数：</span>
	    		<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}" id="people">请选择就餐人数</button>
	    		<i class="am-icon-angle-right"></i>
	    	</li>
	    	<li class="time">
	    		<span>我的桌号：</span>
	    		<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-2', closeViaDimmer: 0}" id="select_table">请选择桌台</button>
	    		<i class="am-icon-angle-right"></i>
	    	</li>
	    </ul>
	    <div class="juli"></div>
	    <!--就餐人数-->
	    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  <div class="am-modal-dialog">
		  	<div class="am-modal-hd" style="height: 35px;">
		      <a href="javascript: void(0)" class="am-close am-close-spin" style="float: left;" data-am-modal-close>&times;</a>
		    </div>
		    <div class="am-modal-bd">
		       <ul class="numren">
		       	<li class="cur">1人</li>
		       	<li>2人</li>
		       	<li>3人</li>
		       	<li>4人</li>
		       	<li>5人</li>
		       	<li>6人</li>
		       	<li>7人</li>
		       	<li>8人</li>
		       	<li>9人</li>
		       	<li>10人</li>
		       </ul>
		    </div>
		  </div>
		</div>
		<!--桌台-->
	    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-2">
		  <div class="am-modal-dialog">
		  	<div class="am-modal-hd" style="height: 35px;">
		      <a href="javascript: void(0)" class="am-close am-close-spin" style="float: left;" data-am-modal-close>&times;</a>
		    </div>
		    <div class="am-modal-bd">
		       <ul class="num-left">
		       	 <li>桌台</li>
		       </ul>
		       <ul class="num-right" id="table">
		       	 <li>2号台位</li>
		       	 <li>2号台位</li>
		       	 <li>2号台位</li>
		       	 <li>2号台位</li>
		       	 <li>2号台位</li>
		       	 <li>2号台位</li>
		       </ul>
		    </div>
		  </div>
		</div>
		
        <div class="juli"></div>
	    <textarea placeholder="备注说明" class="bz-infor"></textarea>
	    <div class="juli"></div>
	    <div class="pricebox">
	    	<p>总价：<i><span id="momey">12<span>.00</i>元（<em><span id="count">1<span></em>份）</p>
	    	<p>请选择支付方式并确认下单：</p>
	    	<a href="jsapi.php"><button class="paybtn" type="button" > 微信支付></button></a>
	    </div>
	    
		 <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
		  <div class="am-modal-dialog">
		    <div class="am-modal-bd" style="height: 80px; line-height: 80px;">  您确定要清空饮品吗？</div>
		    <div class="am-modal-footer">
		      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
		      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
		    </div>
		  </div>
		</div>
		
		<script>
		
		//购物数量加减
		$(function(){
				//ajax获取类型
				url = "http://www.weixin.com/index.php?r=api/get-table-number&room_id=1";
				$.ajax({
					type : 'get',
					dataType : 'jsonp',
					jsonp : "jsoncallback",
					url : url,
					success : function(data){
						var html = '';
						var number = parseInt(data);
						for(var i=1;i<number+1;i++){
							html += '<li onclick="selectTable(this)">'+i+'号台位</li>';
						}
						$('#table').html(html);
					}
				});
				//****************获取cookie中的菜单信息******************
				var menu_data = getCookie('menu_data');
				var menu_data = array_split(menu_data);
				var html = '';
				$(menu_data).each(function(k,v){
					html += '<li><span class="name" style="width:30%">'+v[0]+'</span><em class="price">￥'+v[1]+'</em><div class="d-stock "><a class="decrease">-</a><input id="num" readonly="" class="text_box" name="" type="text" value="'+v[2]+'"><a class="increase">+</a></div></li>';
				});	
				$('#menu_ul').html(html);
				
				show_money();

				$('.increase').click(function(){
					var self = $(this);
					var current_num = parseInt(self.siblings('input').val());
					current_num += 1;
					if(current_num > 0){
						self.siblings(".decrease").fadeIn();
						self.siblings(".text_box").fadeIn();
					}
					self.siblings('input').val(current_num);
					// update_item(self.siblings('input').data('item-id'));
					show_money();
				})		
				$('.decrease').click(function(){
					var self = $(this);
					var current_num = parseInt(self.siblings('input').val());
					if(current_num > 0){
						current_num -= 1;
		                if(current_num < 1){
			                self.fadeOut();
							self.siblings(".text_box").fadeOut();
		                }
						self.siblings('input').val(current_num);
						// update_item(self.siblings('input').data('item-id'));
						show_money();
					}
				})
			})
		function show_money(){
			var money = 0;
			var count = 0;
			$('.price').each(function(k,v){
				var num = $(v).parent().find('#num').val();
				count += parseInt(num);
				money += parseInt($(v).html().substr(1))*num;
			});
			$('#momey').html(money);
			$('#count').html(count);
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
		
		//*******************点击选择人数*******************
		$('.numren').find('li').click(function(){
			// console.log($(this).html());
			$('#people').html($(this).html());
			//关闭模态框
			$('#doc-modal-1').modal('close');
		});

		//*******************点击选择餐桌*******************
		function selectTable(table){
			console.log('1');
			$('#select_table').html($(table).html());
			//关闭模态框
			$('#doc-modal-2').modal('close');
		}

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

		//**************数组平均分*****************
		function array_split(menu_data){
			var a = menu_data.split(',');
			var b = [];
			var result = [];
			var k = 0;

			for(var i = 0; i<a.length; ++i){
			    if(i%3 == 0){
			        b = [];
			        for(var j = 0; j<3; ++j){
			            if(a[i+j] == undefined){
			                continue;
			            } else{
			                b[j] = a[i+j];
			            }
			        }
			        result[k] = b;
			        k++;
			    }
			    
			}
			return result;
		}		
		
		</script>
	</body>
</html>
