<?php 
	include_once("../common/init.php");
	check_login();
	$tb_name="goods";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
	if ($_REQUEST["pid"]) {
		$where_sql .= " and pid =". $_REQUEST["pid"] ." ";
	}
	
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	if ($_REQUEST["pnumber"]) {
		$where_sql .= " and pnumber like '%". $_REQUEST["pnumber"] ."%' ";
	}
	
	if ($_REQUEST["categoryid"]) {
		$where_sql .= " and categoryid =". $_REQUEST["categoryid"] ." ";
	}
	
	$list = db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&categoryid=".$_REQUEST["categoryid"]."&pid=".$_REQUEST["pid"]."&pnumber=".$_REQUEST["pnumber"], $page);
	$page_show = $Page->show(); 

	$categoryA = db_get_all("select * from category where pid=".$_REQUEST["pid"]);
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
            <tr><td width="1%">&nbsp;</td><td width="96%">
            <table width="100%" class="cont">
			<tr>
            <td width="1%"></td>
            <td>
            <form id="pagerForm" action="?" method="post">
				<input type="hidden" name="pageNum" value="<?php echo $page; ?>"/>
				<input type="hidden" name="pid" value="<?php echo $_REQUEST["pid"]; ?>"/>
				<input type="hidden" name="title" value="<?php echo $_REQUEST["title"]; ?>"/>
				<input type="hidden" name="categoryid" value="<?php echo $_REQUEST["categoryid"]; ?>"/>
				<select name="categoryid">
					<option value="">-- 请选择 --</option>
					<?php
                    foreach($categoryA as $row) {
                    ?>
					<option value="<?php echo $row["id"];?>" <?php if($_REQUEST["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
					<?php } ?>
				</select> <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>" placeholder="输入图书名称"/> <input type="text" name="pnumber" class="text" value="<?php echo $_REQUEST["pnumber"]; ?>" placeholder="输入图书编号"/>
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
									<th>图书名称</th>
                                    <th>图书图片</th>
                                    <th>图书编号</th>
                                    <th>会员价</th>
                                    <th>数量</th><th>已卖出</th>
                                    <th>上下架</th>
                                    <th>时间</th>
									<th width="120">操作</th>
								</tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
									<td>&nbsp;&nbsp;<?php echo $row['title'];?></td>
                                    <td align="center"><?php if(!empty($row['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="100" width="100"/><?php }?></td>
                                    <td align="center"><?php echo $row['pnumber'];?></td>
                                    <td align="center"><?php echo $row['sprice'];?></td>
                                    <td align="center"><?php echo $row['amount'];?></td>
                                    <td align="center"><?php echo $row['cishu'];?></td>
                                    <td align="center"><?php if($row["status"]==0){?>
                                      <a href="?act=yes&pid=<?php echo $_REQUEST["pid"]; ?>&id=<?php echo $row["id"];?>" onclick='return confirm("确认下架吗？");'>点击下架</a>
                                  <?php
      } else{?><a href="?act=no&pid=<?php echo $_REQUEST["pid"]; ?>&id=<?php echo $row["id"];?>" onclick='return confirm("确认上架吗？");'><font color="#FF0000">点击上架</font></a><?php }?></td>
                                    <td align="center"><?php echo $row['addtime'];?></td>
									<td align="center"><a href="<?php echo $tb_name;?>_edit.php?pid=<?php echo $row['pid'];?>&id=<?php echo $row['id'];?>">编辑</a> <a href="del.php?id=<?php echo $row['id'];?>&category_flag=<?php echo $tb_name;?>" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
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
		$data = array();
		$data["status"] = 1;
		db_mdf($tb_name,$data,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php?pid=".$_REQUEST["pid"]);
	}
	if($act == 'no')
	{
		$data = array();
		$data["status"] = 0;
		db_mdf($tb_name,$data,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php?pid=".$_REQUEST["pid"]);
	}
?>
</body>
</html>