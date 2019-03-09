<?php 
	include_once("../common/init.php");
	check_login();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<title>左边导航</title>
<link rel="stylesheet" type="text/css" href="skin/index/css/styles.css"/>
</head>
<body>
<div id="wrapper">

	<ul class="menu">
		<li class="item1" id="one"><a href="#one">系统设置</a>
			<ul>
				<li class="subitem1"><a href="password.php" target="main">修改密码</a></li>
				<?php if($_SESSION['type2']=="超级管理员"){?>
				<li class="subitem1"><a href='admin_list.php' target='main'>账号管理</a></li>
				<li class="subitem1"><a href='admin_edit.php' target='main'>添加账号</a></li>
                <?php }?>
			</ul>
		</li>
		<li class="item2" id="two"><a href="#two">活动管理</a>
			<ul>
				<li class="subitem1"><a href='content1_list.php?pid=2&categoryid=7' target='main'>活动管理</a></li>
			</ul>
		</li>
		
		<li class="item2" id="item5"><a href="#item5">图书管理</a>
			<ul>
				<li class="subitem1"><a href='goods_list.php?pid=1' target='main'>图书管理</a></li>
                <li class="subitem1"><a href='category_list.php?pid=1' target='main'>图书分类管理</a></li>
			</ul>
		</li>
        <li class="item2" id="item6"><a href="#item6">订单管理</a>
			<ul>
				<li class="subitem1"><a href='order_list.php' target='main'>订单管理</a></li>
			</ul>
		</li>
		<li class="item2" id="item7"><a href="#item7">用户管理</a>
			<ul>
				<li class="subitem1"><a href='user_list.php' target='main'>用户管理</a></li>
			</ul>
		</li>
		<li class="item2" id="item8"><a href="#item8">新书推荐</a>
			<ul>
				<li class="subitem1"><a href='goods_listt.php' target='main'>图书管理</a></li>
			</ul>
		</li>
	</ul>

</div>
</body>
</html>