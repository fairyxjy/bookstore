<?php 
	include_once("../common/init.php");
	check_login();
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = " 1=1 ";
	if ($_REQUEST["account"]) {
		$where_sql .= " and account= '". $_REQUEST["account"]."'";
	} 

	$list = db_get_page("select * from user where $where_sql order by id desc", $page,12);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&account=".$_REQUEST["account"], $page);
	$page_show = $Page->show(); 

?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">用户列表</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
            <tr><td width="1%">&nbsp;</td><td width="96%">
            <table width="100%" class="cont">
			<tr>
            <td width="1%"></td>
            <td>
            <form id="pagerForm" action="?" method="post">
            <input type="text" name="account" class="text" value="<?php echo $_REQUEST["account"]; ?>"/>
				<button type="submit"  id="chaxun" class="btn">查询</button>
			</form></td></tr></table>
            </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
									<th width="20"></th>
								  <th>用户名</th>
									<th width="160">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
								  <td align="center"></td>
									<td><?php echo $row['account'];?></td>
									<td align="center"><?php if($row['status']==0){?><a href="?act=no&id=<?php echo $row['id'];?>">停用</a><?php } else {?><a href="?act=yes&id=<?php echo $row['id'];?>">恢复</a><?php }?>&nbsp;&nbsp;<a href="user_edit.php?id=<?php echo $row['id'];?>">修改资料</a>&nbsp;&nbsp;<a href="del.php?id=<?php echo $row['id'];?>&del=user" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
								</tr>
                                <?php } ?>
							</table>
						</td>
					</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                        <tr>
                          <td align="center"><?php echo $page_show;?></td>
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
<?php
$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
	if($act == 'yes')
	{
		db_query("update user set status=0 where id=".$_REQUEST["id"]);
		goBakMsg("恢复成功");
	}
	if($act == 'no')
	{
		db_query("update user set status=1 where id=".$_REQUEST["id"]);
		goBakMsg("停用成功");
	}
?>
</body>
</html>