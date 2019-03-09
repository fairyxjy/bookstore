<?php
include_once("common/init.php");
check_loginuser();
	$info = db_get_row("select * from user where id=".$_SESSION["id"]);//调用用户信息
	$dingdanhao=date("YmjHis").$info['id'];//订单号生成
	$shouhuoren=$_POST['receiver'];//收货人
	$address=$_POST['address'];//地址
	$tel=$_POST['tel'];//电话
	$email=$_POST['email'];//email
	$shff=$_POST['shff'];//收货方式
	$zfff=$_POST['zfff'];//支付方式
	$xiadanren=$_SESSION['account'];//下单人姓名
	$zt="未付款";
	
	$leaveword=$_POST['ly'];
	//判断是库存大于或等于购买
	$cart_id = $_POST['cart_id'];
	for($i=0;$i<count($cart_id);$i++){
		$cart=db_get_row("select * from cart where id=".$cart_id[$i]."");//调出订单信息
		$gooda=db_get_row("select * from goods where id=".$cart["goodid"]."");
		if($gooda['amount']<$cart["sums"]){urlMsg($gooda['title']."购买大于库存","cart.php");die;};
	}
	//写入订单表
	$data = array();
	$data["onumber"] = "'". $dingdanhao ."'";
	$data["userid"] = "'". $info['id'] ."'";
	$data["tel"] = "'". $tel ."'";
	$data["receiver"] = "'". $shouhuoren ."'";
	$data["address"] = "'". $address ."'";
	$data["sex"] = "'". $_POST["sex"] ."'";
	$data["email"] = "'". $email ."'";
	$data["shff"] = "'". $shff ."'";
	$data["zfff"] = "'". $zfff ."'";
	$data["leaveword"] = "'". $leaveword ."'";
	$data["xname"] = "'". $xiadanren ."'";
	$data["zt"] = "'". $zt ."'";
	db_add("orders", $data);
	//取出订单信息
	$info2=db_get_row("select * from orders where userid=".$info['id']." order by id desc");//调出订单信息
	
	
	
	
	for($i=0;$i<count($cart_id);$i++){//循环购物车商品数组
		if($cart_id[$i]!=""){//不为空时
		//echo "select * from goods where id=".$cart_id[$i]."";
		//die;
		$cart1=db_get_row("select * from cart where id=".$cart_id[$i]."");//调出购物车信息
		$info1=db_get_row("select * from goods where id=".$cart1["goodid"]."");
		
		//添加订单商品及数量到订单副表
		$data = array();
		$data["goodid"] = "'".$info1["id"]."'";//商品id
		$data["nums"] = "'".$cart1["sums"]."'";//数量
		$data["price"] = "'".$info1["sprice"]."'";//商品价格
		$data["userid"] = "'".$info["id"]."'";//用户id
		$data["ordersid"] = "'".$info2["id"]."'";//订单id
		$data["categoryid"] = "'".$info1["categoryid"]."'";//商品分类
		$data["addtime"] = "'".date("Y-m-d")."'";//时间
		$data["zt"] = "'未付款'";//状态
		db_add("ordersta",$data);//添加进数据库
		}
		
	}
	urlMsg("订购成功","ordershow.php?id=".$info2['id']);
?>
