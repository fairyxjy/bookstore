<?php 
	include_once("../common/init.php");
	check_login();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部</title>
<link rel="stylesheet" type="text/css" href="skin/index/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="skin/index/css/common.css"/>
</head>

<body>
<div class="head clearfix">
	<div class="logo"><?php echo $CONFIG["webname"];?></div><div class="topright"><a href="../index.php" target='_blank'>网站首页</a><a href="logincheck.php?type=logout" target="_top">退出登录</a></div>
</div>
</body>
</html>