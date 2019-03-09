<?php 
	include_once("common/init.php");
	check_loginuser();
	//echo $_SESSION["id"];
	//die;
	$row = db_get_row("select * from user where id=".$_SESSION["id"]);
	if ($_POST){
		$data = array();
		$data["nickname"] = "'".$_POST["nickname"]."'";
		$data["sex"] = "'".$_POST["sex"]."'";	
		$data["email"] = "'".$_POST["email"]."'";	
		$data["address"] = "'".$_POST["address"]."'";	
		$data["tel"] = "'".$_POST["tel"]."'";	
		if(!empty($_FILES['img']['name'])){
			$file = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name = $file['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			}
			//判断是否是通过HTTP POST上传的
			$upload_path = ROOT_PATH.'/Public/Upload/'; //上传文件的存放路径
			
			//开始移动文件到相应的文件夹
			$mu=mt_rand(1,10000000);
			if(move_uploaded_file($file['tmp_name'],$upload_path.$mu.".".$type)){
			  $fileName =$mu.".".$type;
			}else{
			  //echo "Failed!";
			}
			$data["img"] = "'".$fileName."'";	
		}	

		db_mdf("user",$data,$_SESSION["id"]);
		urlMsg("修改成功", __BASE__."/userEdit.php");
	}
	include_once("header.php");
?>
<script type="text/javascript"> 
function check(){
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
    <div class="member_information">
		<?php include_once("userleft.php"); ?>
        <div class="member_info_fr">
         <form name="form1"  action="?" method="post" onSubmit="return check();" enctype="multipart/form-data" class="register">   
        	<h2>个人信息</h2>
            <div class="member_info_frcon">
				<div class="member_info_line">
                	<span class="member_info_name">头像上传：</span> <input type="file" name="img" class="mem_inp1" id="img"><?php if(!empty($row['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="50" width="50"/><?php }?></div>

            	<div class="member_info_line">
                	<span class="member_info_name">用户名：</span> <?php echo $row["account"];?></div>

                <div class="member_info_line">
                	<span class="member_info_name">性别：</span>
                    <select name="sex" class="member_info_select1">
						<option value="未知" <?php if($row["sex"]=="未知"){echo "selected";}?>>未知</option>
						<option value="男" <?php if($row["sex"]=="男"){echo "selected";}?>>男</option>
						<option value="女" <?php if($row["sex"]=="女"){echo "selected";}?>>女</option>
						</select>
                </div>
				<div class="member_info_line">
                    <span class="member_info_name">姓名：</span><input name="nickname" class="mem_inp1" value="<?php echo $row["nickname"];?>" type="text">
                </div>
				<div class="member_info_line">
                    <span class="member_info_name">手机：</span><input name="tel" class="mem_inp1" value="<?php echo $row["tel"];?>" type="text">
                </div>
                <div class="member_info_line">
                    <span class="member_info_name">详细地址：</span><input name="address" class="mem_inp1" value="<?php echo $row["address"];?>" type="text">
                </div>
                <div class="member_info_line">
                    <span class="member_info_name">Email：</span>
                    <span><input class="mem_inp1" name="email" datatype="email_check" id="email" value="<?php echo $row["email"];?>" type="text">  
                    </span>
                </div>
                
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