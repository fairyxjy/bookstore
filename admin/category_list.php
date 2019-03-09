<?php 
	include_once("../common/init.php");
	check_login();
	$tb_name="category";
	$list = db_get_all("select * from $tb_name where pid=".$_REQUEST['pid']);
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="<?php echo $tb_name;?>_edit.php?pid=<?php echo $_REQUEST["pid"];?>">添加</a></div></td></tr>
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
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
									<th width="20"></th>
								  <th>分类名称</th>
									<th width="120">操作</th>
							  </tr>
                                <?php
									foreach($list as $row){
								?>
								<tr align="center" class="d">
								  <td align="center"></td>
									<td><?php echo $row['title'];?></td>
									<td align="center"><a href="<?php echo $tb_name;?>_edit.php?id=<?php echo $row['id'];?>&pid=<?php echo $row['pid'];?>">编辑</a>　<a href="del.php?id=<?php echo $row['id'];?>&pid=<?php echo $row['pid'];?>&category_flag=category_flag" onClick="return confirm('真的要删除?不可恢复!\n\n将删除该类别下的所有信息!');">删除</a></td>
								</tr>
                                <?php } ?>
							</table>
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