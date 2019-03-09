<?php
include_once("common/init.php");
check_loginuser();
$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
//删除
if($act == 'del')
{
	$ordersid = !empty($_GET['ordersid']) ? intval($_GET['ordersid']) : '';
	db_query("delete from orders where id=".$ordersid);
	db_query("delete from ordersta where ordersid=".$ordersid);
	urlMsg("删除成功","order.php");
}
//收货
if($act == 'shouhuo')
{
	$ordersid = !empty($_GET['ordersid']) ? intval($_GET['ordersid']) : '';
	db_query("update orders set zt='已收货' where id=".$ordersid."");
	db_query("update ordersta set zt='已收货' where ordersid=".$ordersid);
	urlMsg("收货成功","order.php");
}
//支付
if($act == 'zhifu')
{
	$ordersid = !empty($_GET['ordersid']) ? intval($_GET['ordersid']) : '';
	 $ordersta = db_get_all("select * from ordersta where ordersid=".$ordersid." order by id desc");foreach($ordersta as $ordersrow) {//调出订单信息
	//循环订单商品,判断库存是否充足
	$gooda=db_get_row("select * from goods where id=".$ordersrow['goodid']."");
	if($gooda['amount']<$ordersta['nums']){urlMsg($gooda['title']."购买大于库存，请取消订单再重新下单","order.php");die;};
	}
	
	foreach($ordersta as $ordersrow1) {//循环减库存
		db_query("update goods set cishu=cishu+".$ordersrow1['nums']." ,amount=amount-".$ordersrow1['nums']." where id=".$ordersrow1["goodid"]."");//减少库存
		db_query("update ordersta set zt='已下单' where id=".$ordersrow1['id']."");//更改订单状态
	}

	db_query("update orders set zt='已下单' where id=".$ordersid."");;//更改订单状态
	urlMsg("支付成功","order.php");
}

?>