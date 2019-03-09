<?php
include_once("common/init.php");
check_loginuser();
$id = !empty($_POST['id']) ? intval($_POST['id']) : '0';//对传递参数判断，没有为0
$sums = !empty($_POST['count']) ? intval($_POST['count']) : '1';//数量 如果没有为1
if($_REQUEST["a"]=="check_count"){
	$info = db_get_row("select * from goods where id=".$id);//查询数据库里图书信息
	if($info['amount']>$sums){//判断图书数量
		db_query("update cart set sums=".$sums."+1 where goodid=".$id." and userid=".$_SESSION["id"]);
		echo "1";
	}
}
if($_REQUEST["a"]=="ajaxBuyCount"){
	if($sums>1){//判断图书数量
		db_query("update cart set sums=".$sums."-1 where goodid=".$id." and userid=".$_SESSION["id"]);
		echo "ok";
	}
}
?>