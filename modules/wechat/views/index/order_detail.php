<?php
use app\models\Order;
?>
		<header data-am-widget="header" class="am-header am-header-default sq-head ">
			<div class="am-header-left am-header-nav">
				<a href="javascript:history.back()" class="" style="border: 0;">
					<i class="am-icon-chevron-left"></i>
				</a>
			</div>
			<h1 class="am-header-title">
  	            <a href="" class="" style="color: #333;">订单详请</a>
            </h1>

	    </header>
	    <div style="height: 49px;"></div>
	  	
		 <ul class="list-detail">
		 	<li class="time">
	    		<span>订单编号</span><span style="float:right;">NO.<?=$detail['id']?>
	    		</span>

	    	</li>
	    	<li class="time">
	    		<span>下单时间</span><span style="float:right;"><?=date('Y-m-d H:i:s',$detail['order_time'])?>
	    		</span>

	    	</li>
		 	<li class="time">
				<table class="am-table">
				    <thead>
				        <tr>
				            <th>名称</th>
				            <th>数量</th>
				            <th style="text-align:center">金额</th>
				        </tr>
				    </thead>
				    <tbody>
						<?php foreach($detail['orderDetail'] as $k=>$v){?>
				        <tr>
				            <td><?=$v['menu']['menu_name']?></td>
				            <td><?=$v['menu_number']?></td>
				            <td style="text-align:center">￥<?=$v['menu_price']?></td>
				        </tr>
						<?php }?>
				    </tbody>
				</table>
		 	<li>

	    	<li class="time">
	    		<span>支付状态</span><span style="float:right;color:red"><?=Order::$pay_status[$detail['pay_status']]?>
	    		</span>
	    		<i class="am-icon-angle-right"></i>
	    	</li>
	    	<li class="time">
	    		<span>订单状态</span><span style="float:right;color:red"><?=Order::$order_status[$detail['order_status']]?>
	    		</span>
	    		<i class="am-icon-angle-right"></i>
	    	</li>
	    </ul>
	</body>
</html>


