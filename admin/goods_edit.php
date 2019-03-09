<?php 
	include_once("../common/init.php");
	check_login();
	$tb_name="goods";
	$categoryA = db_get_all("select * from category where pid=". $_REQUEST["pid"]);
	$rs = array();
	if ($_REQUEST["id"]) {
		$rs = db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		if ($_REQUEST["id"]) {
			if($_POST["pnumber"]!=$_POST["pnumber1"]){
				$row1 = db_get_row("select * from $tb_name where pnumber='". $_POST["pnumber"] ."'");
				if ($row1["id"]) {
					goBakMsg("图书号已存在，请重新填写");
					die;
			}
			}
		} else {
			$row1 = db_get_row("select * from $tb_name where pnumber='". $_POST["pnumber"] ."'");
				if ($row1["id"]) {
					goBakMsg("图书号已存在，请重新填写");
					die;
			}
		}
		$data["title"] = "'".$_POST["title"]."'";
		$data["pid"] = "'".$_POST["pid"]."'";
		$data["categoryid"] = "'".$_POST["categoryid"]."'";
		$data["pnumber"] = "'".$_POST["pnumber"]."'";
		$data["amount"] = "'".$_POST["amount"]."'";
		$data["mprice"] = "'".$_POST["mprice"]."'";
		$data["sprice"] = "'".$_POST["sprice"]."'";
		$data["content"] = "'".$_POST["content"]."'";
		if(!empty($_FILES['img']['name'])){
			$file = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name = $file['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
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
		if ($_REQUEST["id"]) {
			db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			db_add($tb_name,$data);
		}
		urlMsg("提交成功", $tb_name."_list.php?pid=".$_REQUEST["pid"]);
		die;
	}
	
?>
<?php include_once("base.php");?>
	<script>
	function checkadd()
	{
	if (document.add.title.value=='')
	{
	alert('标题不能为空');
	document.add.title.focus;
	return false
	}
	if (document.add.pnumber.value=='')
	{
	alert('图书号不能为空');
	document.add.pnumber.focus;
	return false
	}
	if (document.add.mprice.value=='')
	{
	alert('市场价不能为空');
	document.add.mprice.focus;
	return false
	}
	if (document.add.sprice.value=='')
	{
	alert('会员价不能为空');
	document.add.sprice.focus;
	return false
	}
	if (document.add.amount.value=='')
	{
	alert('图书数量不能为空');
	document.add.amount.focus;
	return false
	}
	var data = document.add.content.value;
	str = trim(data);//去除空格的
		if(data.length==0){
		alert("内容不能为空!");
		return false;
		}
	function trim(str){       
	str = str.replace(/^(\s|\u00A0)+/,'');      
	for(var i=str.length-1; i>=0; i--){           
		 if(/\S/.test(str.charAt(i))){              
			 str = str.substring(0, i+1);              
			 break;           
			 }      
		  }      
	  return str;  
	  }
	}
	</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改图书</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<tr>
						  <td colspan="2">
								<form name="add" method="post" action="?" onSubmit="return checkadd()"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
									<input type="hidden" name="pid" value="<?php echo $_REQUEST["pid"];?>" />
                                    <input type="hidden" name="pnumber1" value="<?php echo $rs["pnumber"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="2%">&nbsp;</td>
                                            <td width="120" align="right"><span class="red">*</span> 图书名称：</td>
                                          <td><input name="title" type="text" class="text" style="width:350px;"  value="<?php echo $rs["title"];?>"></td>
                                            <td width="2%" colspan="2"></td>
                                        </tr>
                                        <?php 
											if(!empty($categoryA[0])){
										?>
                                        <tr>
                                          <td>&nbsp;</td>
                                            <td align="right"><span class="red">*</span> 图书分类：</td>
                                          <td>
                                          <select name="categoryid">
											  <?php foreach($categoryA as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select>
                                          </td>
                                          <td></td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                          <td>&nbsp;</td>
                                            <td align="right"><span class="red">*</span> 图书号：</td>
                                          <td><input name="pnumber" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["pnumber"];?>"></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                            <td align="right"><span class="red">*</span> 市场价：</td>
                                          <td><input name="mprice" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["mprice"];?>" onKeyUp="value=value.replace(/[^\d\.]/g,'')" onBlur="value=value.replace(/[^\d\.]/g,'')"/></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td width="26">&nbsp;</td>
                                            <td align="right"><span class="red">*</span> 会员价：</td>
                                          <td><input name="sprice" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["sprice"];?>" onKeyUp="value=value.replace(/[^\d\.]/g,'')" onBlur="value=value.replace(/[^\d\.]/g,'')"/></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                            <td align="right"><span class="red">*</span> 图书数量：</td>
                                          <td><input name="amount" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["amount"];?>" onKeyUp="this.value=this.value.replace(/\D/g,'')" onBlur="this.value=this.value.replace(/\D/g,'')"/></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td align="right">图书图片：</td>
                                          <td><input type="file" name="img" class="text" id="img"><?php if(!empty($rs['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $rs["img"];?>" height="50" width="50"/><?php }?></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td align="right">图书介绍：</td>
                                          <td>
                                          <script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
											<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.min.js"> </script>
                                            <script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script>
                                            <script type="text/javascript">
                                            $(function(){
                                                $("#submitBtn").click(function(){
                                                    $("#content").val(UE.getEditor('editor').getContent());
                                                    $("#form1").submit();
                                                });
                                            
                                                var ue = UE.getEditor('editor');
                                            });
                                            </script>
											<script id="editor" type="text/plain" style="width:100%;height:200px;"><?php echo $rs['content'];?></script>
											<textarea name="content" id="content" style="display:none;"><?php echo $rs['content'];?></textarea>
                                          </td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td align="right"><input type="submit" class="btn" id="submitBtn" value="提交" ></td>
                                            <td>&nbsp;</td>
                                            <td></td>
                                        </tr>
                                    </table>
							</form>
						  </td>
							</tr>
						</table>
					</td>
					<td width="1%">&nbsp;</td>
				</tr>
				<tr><td height="20"></td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>