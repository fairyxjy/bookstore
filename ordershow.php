<?php
include_once("header.php");
check_loginuser();
?>
<?php
$info2=db_get_row("select * from orders where id=".$_GET['id']);//调出订单信息
?>
<div class="case_view">
		<div class="head_b">订单详情</div>
		<div class="col_b">
			<div class="title">收货姓名：</div>
			<div class="msg"><?php echo $info2['receiver'];?></div>
		</div>
		<div class="col_b">
			<div class="title">收货地址：</div>
			<div class="msg"><?php echo $info2['address'];?></div>
		</div>
		<div class="col_b">
			<div class="title">收货电话：</div>
			<div class="msg"><?php echo $info2['tel'];?></div>
		</div>
		<div class="col_b">
			<div class="title">支付方式：</div>
			<div class="msg"><?php echo $info2['zfff'];?></div>
		</div>
		<div class="col_b">
			<div class="title">送货方式：</div>
			<div class="msg"><?php echo $info2['shff'];?> <?php if($info2['kuaidi']){?>-<?php echo $info2['kuaidi'];?>-<?php echo $info2['knumber'];?><?php }?></div>
		</div>
		<div class="col_b">
			<div class="title">订单信息：</div>
			<div class="msg"><span><?php echo $info2['onumber'];?></span><span>创建时间：<?php echo $info2['addtime'];?></span><span>状态:<?php echo $info2['zt'];?>
			</span></div>
		</div>
		<div class="pro_infob">
			<ul>
				<li class="head">
					<div class="name">商品信息</div>
					<div class="price">单价</div>
					<div class="num">数量</div>
					<div class="count">小计（元）</div>
				</li>
                <?php 
			  $total = 0;
			  $ordersta = db_get_all("select * from ordersta where ordersid=".$info2['id']." order by id desc");foreach($ordersta as $ordersrow) {
				  $info1=db_get_row("select * from goods where id=".$ordersrow['goodid']);//调出商品信息
				  ?>
				<li class="item">
					<div class="name">
						<div class="img">
						<img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $info1['img'];?>" height="78px" width="78px"></div>
						<div class="pro_name"><a href="goodshow.php?id=<?php echo $info1['id'];?>&categoryid=<?php echo $info1['categoryid'];?>" target="_blank"><?php echo $info1['title'];?></a></div>
					</div>
					<div class="price">￥<span><?php echo $ordersrow['price'];?></span></div>
					<div class="num"><?php echo $ordersrow['nums'];?></div>
					<div class="count">￥<span><?php echo $ordersrow['price']*$ordersrow['nums'];?></span></div>
				</li>  <?php
			  $total = $total+$ordersrow['price']*$ordersrow['nums'];
	   }
	 ?></ul>
			<div class="all_count">本张订单， 总计金额： <span>¥ <span><?php echo $total;?></span></span></div>
			<div class="all_count"><?php if($info2['zt']=="已发货" ){?><a href="ordersave.php?act=shouhuo&ordersid=<?php echo $info2['id']?>" class="details"><button type="button" id="btn">确认收货</button></a><?php }?>  &nbsp;&nbsp;<?php if($info2['zt']=="未付款"){?><a href="ordersave.php?act=zhifu&ordersid=<?php echo $info2['id']?>&price=<?php echo $total;?>" class="details"><button type="button" id="btn">点击支付</button></a><?php } ?><?php
					   ?>
            
            </div>
		</div>
	</div>
<?php
	include_once("footer.php");
?>

