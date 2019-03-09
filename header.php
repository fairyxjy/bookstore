<?php
	include_once("common/init.php");
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $CONFIG["webname"];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__;?>/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__;?>/css/pub.css" />
<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__;?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__;?>/css/member.css" />
<script type="text/javascript" src="<?php echo __PUBLIC__;?>/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>/js/base.js"></script>
</head>
<body>
<header>
	<div class="header">
        <div class="wl">
          <a href="index.php" class="a_home">网站首页</a>
          <div class="weixin">
            <div class="img_b"><img src="<?php echo __PUBLIC__;?>/images/pub_icon01.png" alt=""></div>
          </div>
          <div class="links"><?php if ($_SESSION["account"]) {?>你好，<?php echo $_SESSION["account"];?><span>丨</span><a href="order.php">我的订单</a><span>丨</span><a href="userEdit.php">个人中心</a><?php }else {?>你好，游客<span>丨</span><a href="login.php">登录</a><span>丨</span><a href="register.php">注册</a><?php }?></div>
        </div>
  </div>
  <div class="clear"></div>
  <div class="top_info">
    <div class="wl">
      <!-- logo -->
      <div class="logo"><a href="index.php"><img src="<?php echo __PUBLIC__;?>/images/logo.png"></a></div>
      <!-- 购物车 -->
      <div class="shop" id="end"><a id="gwc" href="cart.php">我的购物车</a></div>
      <!-- 搜索 -->
      <form action="goods.php" method="get">
        <div class="search">
          <input type="text" name="keywords" placeholder="输入图书名称" class="in" value=''/>
          <input type="submit" class="btn_submit" value="" />
        </div>
      </form>
    </div>
  </div>
  <!-- 头部导航 -->
  <div class="nav_b">
    <div class="wl">
      <ul class="nav_list">
        <li class="now" ><a href="index.php">网站首页</a></li>
        <li><a href="goods.php">图书中心</a></li>
        <li><a href="activity.php">最新活动</a></li>
        <?php if ($_SESSION["account"]) {?><li><a href="order.php">我的订单</a></li><li><a href="userEdit.php">个人中心</a></li><?php }else{?><li><a href="login.php">登录</a></li><li><a href="register.php">注册</a></li><?php }?>
      </ul>
    </div>
  </div>
</header>