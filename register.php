<?php 
	include_once("header.php");
	if ($_POST){
		$row = db_get_row("select * from user where account='". $_POST["account"] ."'");//查询用户名是否重复
		if ($row["id"]) {
			goBakMsg("用户名已存在");
			die;
		}
		//提交的数据放入数组,调用db_add添加到数据库
		$data = array();
		$data["account"] = "'". $_POST["account"] ."'";
		$data["nickname"] = "'". $_POST["nickname"] ."'";
		$data["email"] = "'". $_POST["email"] ."'";
		$data["sex"] = "'". $_POST["sex"] ."'";
		$data["tel"] = "'". $_POST["tel"] ."'";
		$data["password"] = "'". $_POST["password"] ."'";
		$data["address"] = "'".$_POST["address"]."'";
		db_add("user", $data);
		urlMsg("注册成功", __BASE__."/login.php");
		die;
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
	if(document.form1.password1.value==""){
		alert("请输入确认密码");
		document.form1.password1.focus();
		return false;
	}
	if(document.form1.password.value!=document.form1.password1.value){
		alert("两次输入密码不一致");
		document.form1.password1.focus();
		return false;
	}
	var email = document.form1.email.value;
	var emailreg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	if(!emailreg.test(email)){
		document.form1.email.focus();
		alert("邮箱不符合规则");
		return false;
	}
	if(document.form1.nickname.value==""){
		alert("姓名为必填");
		document.form1.nickname.focus();
		return false;}
	var mobile=document.form1.tel.value;
		if(mobile.length==0) 
       { 
          alert('请输入手机号码！'); 
          document.form1.tel.focus(); 
          return false; 
       }     
       if(mobile.length!=11) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.tel.focus(); 
           return false; 
       } 
       var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
       if(!myreg.test(mobile)) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.tel.focus(); 
           return false; 
       }
	if(document.form1.address.value==""){
		alert("地址为必填");
		document.form1.address.focus();
		return false;}
	
}
</script>
<div class="member_fra">
	<div class="clear"></div>
	<div class="member_login member_reg">
		<h2><span>免费注册</span></h2>
		<div class="clear"></div>
		<form name="form1" action="?" method="post" class="register" onSubmit="return check();">
		<div class="member_reg_form">                           
			<div class="member_reg_line1">         
				<span class="member_reg_name">账户名：</span>
				<div class="inpf mbg1"><input class="inputxt" type="text" name="account"  placeholder="输入用户名"> </div>
			</div>
            <div class="member_reg_line1">
            	<span class="member_reg_name">设置密码：</span>
                <div class="inpf mbg2" >
                    <input class="inputxt" type="password" name="password">
                </div>
            </div>
            <div class="member_reg_line1">
            	<span class="member_reg_name">确认密码：</span>
                <div class="inpf mbg2" ><input name="password1" class="inputxt" type="password"></div>
            </div>
            <div class="member_reg_line1">
            	<span class="member_reg_name">姓名：</span>
                <div  class="inpf mbg1"><input class="inputxt" name="nickname" type="text" ></div>
            </div>
            <div class="member_reg_line1">
              <span class="member_reg_name">Email：</span>
              <div class="inpf mbg3" ><input class="inputxt" name="email" type="text"/></div>
            </div>
            
            <div class="member_reg_line1">
            	<span class="member_reg_name">手机号：</span>
                <div  class="inpf mbg1"><input class="inputxt" name="tel" type="text" ></div>
            </div>
            <div class="member_reg_line1">
            	<span class="member_reg_name">地址：</span>
                <div  class="inpf mbg9"><input class="inputxt" name="address" type="text" ></div>
            </div>
            <div class="member_reg_line3">
                <input type="submit" id="btn_sub" value="注   册">
            </div>
        </div>
        <div class="member_login_des">
            <p>我已有<?php echo $CONFIG["webname"];?>的账户,现在就</p>
            <a href="login.php">立即登录</a>
        </div>
        </form>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php
include_once("footer.php");
?>