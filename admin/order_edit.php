<?php
include_once("../common/init.php");
check_login();
$id = !empty($_GET['id']) ? intval($_GET['id']) : '';
$info = db_get_row("select * from orders where id='".$id."'");?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">订单管理</div></td></tr>
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
            订单编号:<?php echo $info['onumber'];?>
            </td></tr></table>
            </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
									<th>商品名称</th>
                                    <th>数量</th>
                                    <th>市场价</th>
                                    <th>会员价</th>
                                    <th>成交价</th>
                                    <th>折扣</th>
                                    <th>小 计</th>
								</tr>
<?php 
	$total = 0;
	$ordersta = db_get_all("select * from ordersta where ordersid=".$info['id']." order by id desc");foreach($ordersta as $ordersrow) {
	$info1=db_get_row("select * from goods where id=".$ordersrow['goodid']);//调出商品信息
?>
								<tr align="center" class="d">
									<td>&nbsp;&nbsp;<?php echo $info1['title'];?></td>
                                    <td align="center"><?php echo $ordersrow['nums'];?></td>
                                    <td align="center"><?php echo $info1['mprice'];?></td>
                                    <td align="center"><?php echo $info1['sprice'];?></td>
                                    <td align="center"><?php echo $ordersrow['price'];?></td>
                                    <td align="center"><?php echo ceil(($ordersrow['price']/$info1['mprice'])*100);?>%</td>
                                    <td align="center"><?php echo $ordersrow['price']*$ordersrow['nums'];?></td>
								</tr>
                                <?php  } ?> 
							</table>
						</td>
					</tr>
					</table>
                    
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="cont">
                        <tr bgcolor="#cecece">
        <td height="35" colspan="2" align="center">收货人信息</td>
      </tr>
      <tr>
        <td width="120" height="25" align="right">收货人姓名：</td>
        <td width="627"><?php echo $info['receiver'];?></td>
      </tr>
      <tr>
        <td height="25" align="right">详细地址：</td>
        <td height="25"><?php echo $info['address'];?></td>
      </tr>
      <tr>
        <td height="25" align="right">电　　话：</td>
        <td height="25"><?php echo $info['tel'];?></td>
      </tr>
      <tr>
        <td height="25" align="right">电子邮件：</td>
        <td height="25"><?php echo $info['email'];?></td>
      </tr>
      <tr>
        <td height="25" align="right">送货方式：</td>
        <td height="25"><?php echo $info['shff'];?></td>
      </tr>
      <?php if($info['kuaidi']){?>
      <tr>
        <td height="25" align="right">快递信息：</td>
        <td height="25"><?php echo $info['kuaidi'];?>-<?php echo $info['knumber'];?></td>
      </tr>
      <?php }?>
      <tr>
        <td height="25" align="right">支付方式：</td>
        <td height="25"><?php echo $info['zfff'];?></td>
      </tr>
	  <tr>
        <td height="25" align="right">简单留言：</td>
        <td height="25"><?php echo $info['leaveword'];?></td>
      </tr>
                      </table>    <table width="100%" cellPadding="6" bgcolor="#cecece" class="table table-bordered">
  <tr>
    <td height="20" align="center">
    <script type="text/javascript">
	function printpage()
	  {
	  window.print()
	  }
	</script>
         <input type="button" class="btn" value="打印"
onclick="printpage()" /> <input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回">    </td>
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