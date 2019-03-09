<?php 
include_once("header.php");
	if($_REQUEST["type"]=="logout"){//退出登录,清空session
		session_destroy();
		session_start();
		urlMsg("退出成功", __BASE__."/login.php");
		die;
	}
	if ($_POST) {
			$rsRow = db_get_row("select * from user where status=0 and account='". $_POST["account"] ."'");//判断是否有这个用户名
			if ($rsRow['password'] == $_POST["password"]){//判断密码是否正确
				$_SESSION["id"]=$rsRow['id'];//赋值session
				$_SESSION['account']=$rsRow['account'];
				$_SESSION['nickname']=$rsRow['nickname'];
				urlMsg("登录成功", __BASE__."/userEdit.php");
				die;
			} else {
				goBakMsg("账号不存在或密码错误");
			}
	}
?>
<script type="text/javascript"> 
function check(){   
    if(document.form1.account.value==""){
		alert("请输入用户名");
		document.form1.account.focus();
		return false;}
	if(document.form1.password.value==""){
		alert("请输入密码");
		document.form1.password.focus();
		return false;
	}
	
}
</script>
<div class="member_fra">
	<div class="clear"></div>
	<div class="member_login member_reg">
		<h2><span>用户登录</span></h2>
		<div class="clear"></div>
		<form name="form1" action="?" method="post" class="register" onSubmit="return check();">
		<div class="member_reg_form">                           
			<div class="member_reg_line1">         
				<span class="member_reg_name">用户名：</span>
				<div class="inpf mbg1"><input class="inputxt" type="text" name="account"  placeholder="输入用户名"> </div>
			</div>
            <div class="member_reg_line1">
            	<span class="member_reg_name">密码：</span>
                <div class="inpf mbg2" >
                    <input class="inputxt" type="password" name="password">
                </div>
            </div>
            <div class="member_reg_line3">
                <input type="submit" id="btn_sub" value="登   录">
            </div>
        </div>
        <div class="member_login_des">
            <p>没有<?php echo $CONFIG["webname"];?>的账户,现在就</p>
            <a href="register.php">立即注册</a>
        </div>
        </form>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php
include_once("footer.php");
?>