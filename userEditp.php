<?php 
	include_once("header.php");
	check_loginuser();
	if ($_POST){
		$row = db_get_row("select * from user where id=".$_SESSION["id"]);
		if($_POST["password"] != $_POST["repassword"]) {
			goBakMsg("两次密码输入不一致");
		} else if ($_POST["oldpassword"]!=$row["password"]) {
			goBakMsg("原密码错误");
		} else {
			$data = array();
			$data["password"] = "'".$_POST["password"]."'";
			db_mdf("user",$data,$_SESSION["id"]);
			goBakMsg("密码修改成功");
		}
	}
?>
<script type="text/javascript"> 
function check(){
		if(document.form1.oldpassword.value==""){
		alert("请输入原密码");
		document.form1.oldpassword.focus();
		return false;
	}
	if(document.form1.password.value==""){
		alert("请输入密码");
		document.form1.password.focus();
		return false;
	}
	if(document.form1.repassword.value==""){
		alert("请输入确认密码");
		document.form1.repassword.focus();
		return false;
	}
	if(document.form1.password.value!=document.form1.repassword.value){
		alert("两次输入密码不一致");
		document.form1.repassword.focus();
		return false;
	}
}
</script>
<div class="member_fra">
    <div class="clear"></div>
    <div class="member_information">
		<?php include_once("userleft.php"); ?>
        <div class="member_info_fr">
         <form name="form1"  action="?" method="post" onSubmit="return check();" enctype="multipart/form-data" class="register">   
        	<h2>修改密码</h2>
            <div class="member_info_frcon">
            	<div class="member_info_line">
                	<span class="member_info_name">原密码：</span> <input name="oldpassword" type="password" class="mem_inp1"></div>

				<div class="member_info_line">
                    <span class="member_info_name">新密码：</span><input name="password" type="password" class="mem_inp1"></div>
				<div class="member_info_line">
                    <span class="member_info_name">确认密码：</span><input name="repassword" type="password" class="mem_inp1"></div>
                
                <div class="member_info_line">
                <input class="member_info_sub" value="保  存" type="submit">
                </div>
            </div></form>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php
	include_once("footer.php");
?>