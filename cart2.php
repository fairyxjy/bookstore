<?php
include_once("header.php");
check_loginuser();
?>
<script language="javascript">
function chkinput(form){
	if(form.receiver.value==""){
		alert("请输入收货人姓名!");
		form.receiver.select();
		return(false);
	}
	if(form.address.value==""){
		alert("请输入收货人地址!");
		form.address.select();
		return(false);
	}
	if(form.tel.value==""){
		alert("请输入收货人联系电话!");
		form.tel.select();
		return(false);
	}
	if(form.email.value==""){
		alert("请输入收货人E-mail地址!");
		form.email.select();
		return(false);
	}
	if(form.email.value.indexOf("@")<0){
		alert("收货人E-mail地址格式输入错误!");
		form.email.select();
		return(false);
	}
	return(true);
}
</script>
<div class="member_fra">
    <div class="clear"></div>
    <div class="member_information">
		<?php include_once("userleft.php"); ?>
        <div class="member_info_fr">
        <?php
$row = db_get_row("select * from user where id=".$_SESSION["id"]);
 ?>
         <form name="form1" method="post" action="savedd.php" onSubmit="return chkinput(this)" class="register">  
         <?php $cart_id = $_POST['cart_id']; for($i=0;$i<count($cart_id);$i++){?>
            <input type="hidden" value="<?php echo $cart_id[$i];?>" name="cart_id[]" />
            <?php }?> 
        	<h2>收货人信息</h2>
            <div class="member_info_frcon">
            	<div class="member_info_line">
                	<span class="member_info_name">收货人姓名：</span> <input type="text" name="receiver" size="25" class="mem_inp1" value="<?php echo $row['nickname'];?>"></div>

                <div class="member_info_line">
                	<span class="member_info_name">性别：</span>
                    <select name="sex" class="member_info_select1">
						<option value="未知" <?php if($row["sex"]=="未知"){echo "selected";}?>>未知</option>
						<option value="男" <?php if($row["sex"]=="男"){echo "selected";}?>>男</option>
						<option value="女" <?php if($row["sex"]=="女"){echo "selected";}?>>女</option>
						</select>
                </div>
				<div class="member_info_line">
                    <span class="member_info_name">手机：</span><input name="tel" class="mem_inp1" value="<?php echo $row["tel"];?>" type="text">
                </div>
                <div class="member_info_line">
                    <span class="member_info_name">电子邮箱：</span><input name="email" class="mem_inp1" value="<?php echo $row["email"];?>" type="text">
                </div>
                <div class="member_info_line">
                    <span class="member_info_name">详细地址：</span><input name="address" class="mem_inp1" value="<?php echo $row["address"];?>" type="text">
                </div>
                <div class="member_info_line">
                	<span class="member_info_name">送货方式：</span>
                  <select name="shff"  class="member_info_select1">
                      <option selected value="货到付款">货到付款</option>
                      <option selected value="快递">快递</option>
                    </select>
                </div>
                <div class="member_info_line">
                	<span class="member_info_name">送货方式：</span>
                  <select name="zfff" class="member_info_select1">
                      <option selected value="网银支付">网银支付</option>
                      <option value="支付宝支付">支付宝支付</option>
                      <option value="微信支付">微信支付</option>
                    </select>
                </div>
                 
                <div class="member_info_line">
                    <span class="member_info_name">留言：</span>
                    <textarea name="ly" cols="70" rows="5" class="mem_inp1"></textarea>
                </div>
              <div class="member_info_line">
                <input class="member_info_sub" value="提交订单" type="submit">
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