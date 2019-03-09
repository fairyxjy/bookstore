<?php 
	include_once("../common/init.php");
	check_login();
	$tb_name="content1";
	$rs = array();
	if ($_REQUEST["id"]) {
		$rs = db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		$data["title"] = "'".$_POST["title"]."'";
		$data["categoryid"] = "'".$_POST["categoryid"]."'";
		if($_POST["desc1"]){
		$data["desc1"] = "'".$_POST["desc1"]."'";}
		$data["content"] = "'".$_POST["content"]."'";
		if(!empty($_FILES['img']['name'])){
			$file1 = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name1 = $file1['name'];
			$type1 = strtolower(substr($name1,strrpos($name1,'.')+1)); //得到文件类型，并且都转化成小写
			//判断是否是通过HTTP POST上传的
			$upload_path1 = ROOT_PATH.'/Public/Upload/'; //上传文件的存放路径
			
			//开始移动文件到相应的文件夹
			$mu1=mt_rand(1,10000000);
			if(move_uploaded_file($file1['tmp_name'],$upload_path1.$mu1.".".$type1)){
			  $fileName1 =$mu1.".".$type1;
			}else{
			  //echo "Failed!";
			}
			$data["img"] = "'".$fileName1."'";
		}
		if ($_REQUEST["id"]) {
			db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			db_add($tb_name,$data);
		}
		urlMsg("提交成功", $tb_name."_list.php?categoryid=".$_POST["categoryid"]);
		die;
	}
	
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改信息</div></td></tr>
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
									<input type="hidden" name="categoryid" value="<?php echo $_REQUEST["categoryid"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="2%">&nbsp;</td>
                                            <td width="120" align="right"><span class="red">*</span> 名称：</td>
                                          <td><input name="title" type="text" class="text" style="width:350px;"  value="<?php echo $rs["title"];?>" required></td>
                                            <td width="2%" colspan="2"></td>
                                        </tr>
                                        <?php if($_REQUEST["categoryid"]==5){?>
                                        <tr>
                                          <td width="2%">&nbsp;</td>
                                            <td width="120" align="right"><span class="red">*</span> 材料：</td>
                                          <td><input name="desc1" type="text" class="text" style="width:350px;"  value="<?php echo $rs["desc1"];?>" required></td>
                                            <td width="2%" colspan="2"></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td align="right">图片上传：</td>
                                          <td><input type="file" name="img" class="text" id="img"><?php if($rs["img"]){?><?php echo __BASE__;?>/Public/Upload/<?php echo $rs["img"];?><?php }?></td>
                                          <td></td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td align="right">详细介绍：</td>
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