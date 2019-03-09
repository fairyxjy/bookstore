<?php
include_once("common/init.php");
check_loginuser();
if($_POST['id']){$id = !empty($_POST['id']) ? intval($_POST['id']) : '0';}else{$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : '0';}//对传递参数判断，没有为0
$sums = !empty($_POST['sums']) ? intval($_POST['sums']) : '1';//数量 如果没有为1
$info = db_get_row("select * from goods where id=".$_REQUEST["id"]);//查询数据库里图书信息
if($info['amount']<$sums){//判断图书数量
	goBakMsg("该图书数量不够，请重新选择!");
	exit;
}
$row = db_get_row("select * from cart where goodid=". $id." and userid=".$_SESSION["id"]);//查询是否重复
if ($row["id"]) {
	goBakMsg("此图书已在购物车里");
	die;
}
//提交的数据放入数组,调用db_add添加到数据库
$data = array();
$data["goodid"] = "'". $id ."'";
$data["userid"] = "'". $_SESSION["id"] ."'";
$data["sums"] = "'". $sums ."'";
db_add("cart", $data);
header("location:cart.php");
?>