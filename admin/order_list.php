<?php 
	include_once("../common/init.php");
	check_login();
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
	if ($_REQUEST["keywords"]) {
		$where_sql .= " and onumber like '%". $_REQUEST["keywords"] ."%' ";
	}
	$list = db_get_page("select * from orders where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&keywords=".$_REQUEST["keywords"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">订单列表</div></td></tr>
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
				<input type="text" name="keywords" class="text" value="<?php echo $_REQUEST["keywords"]; ?>"/>
				<button type="submit"  id="chaxun" class="btn">查询</button>
			</form>  <script type="text/javascript">
	function printpage()
	  {
	  window.print()
	  }
	</script></td><td><input type="button" class="btn" value="打印"
onclick="printpage()" /></td></tr></table>
            </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
									<th>订单编号</th>
                                    <th>下单人</th>
                                    <th>订货人</th>
                                    <th>金额总计</th>
                                    <th>付款方式</th>
                                    <th>订单状态</th>
                                    <th>发货</th>
                                    <th width="150">时间</th>
									<th width="120">操作</th>
								</tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
									<td><?php echo $row['onumber'];?></td>
                                    <td><?php echo $row['xname'];?></td>
                                    <td><?php echo $row['receiver'];?></td>
                                    <td>
                                     <?php 
									  $total = 0;
									  $ordersta = db_get_all("select * from ordersta where ordersid=".$row['id']." order by id desc");foreach($ordersta as $ordersrow) {
									?>
                                    <?php
			  							$total = $total+$ordersrow['price']*$ordersrow['nums'];}
										echo $total;
										?>
                                    </td>
                                    <td><?php echo $row['zfff'];?></td>
                                    <td><?php echo $row['zt'];?></td>
                                    <td><?php if($row['zt']=="已下单"){?><a href="fahuo.php?id=<?php echo $row['id'];?>"><input type="button" value="发货" /></a><?php }?></td>
                                    <td><?php echo $row['addtime'];?></td>
									<td><a href="order_edit.php?id=<?php echo $row['id'];?>">查看</a> <a href="del.php?id=<?php echo $row['id'];?>&del=orders" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
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
</body>
</html>