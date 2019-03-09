<?php
	include_once("../common/init.php");
	check_login();
	if ($_REQUEST["category_flag"]=="category_flag"&&$_REQUEST["pid"]==1){
		db_del("category",$_REQUEST["id"]);
		db_dela("goods","categoryid=".$_REQUEST["id"]);
		db_dela("cart","goodid=".$_REQUEST["id"]);
		urlMsg("删除成功", __BASE__."/admin/category_list.php?pid=".$_REQUEST["pid"]);
	}
	if ($_REQUEST["category_flag"]=="category_flag"&&$_REQUEST["pid"]==2){
		db_del("category",$_REQUEST["id"]);
		db_dela("content1","categoryid=".$_REQUEST["id"]);
		urlMsg("删除成功", __BASE__."/admin/category_list.php?pid=".$_REQUEST["pid"]);
	}
	if ($_REQUEST["category_flag"]=="goods"){
		db_del("goods",$_REQUEST["id"]);
		db_dela("cart","goodid=".$_REQUEST["id"]);
		goBakMsg("删除成功");
	}
	if ($_REQUEST["category_flag"]=="orders"){
		db_del("orders",$_REQUEST["id"]);
		db_dela("ordersta","ordersid=".$_REQUEST["id"]);
		goBakMsg("删除成功");
	}
	if ($_REQUEST["del"]) {
		db_del($_REQUEST["del"],$_REQUEST["id"]);
		goBakMsg("删除成功");
	} else {
		die;
	}

?>