<?php 
	include_once("../common/init.php");
	check_login();
$action = !empty($_GET['action']) ? trim($_GET['action']) : '';
if($action == 'update')
{
	$id = !empty($_POST['id']) ? intval($_POST['id']) : '';
	$kuaidi = !empty($_POST['kuaidi']) ? trim($_POST['kuaidi']) : '';
	$knumber = !empty($_POST['knumber']) ? $_POST['knumber'] : '';
	db_query("update orders set kuaidi='$kuaidi',knumber='$knumber',zt='已发货' where id=".$id);
	db_query("update ordersta set zt='已发货' where ordersid=".$id);
	urlMsg("操作成功", "order_list.php");
}
?>
<?php include_once("base.php");?>
<script language="javascript">
	function chkinput()
	{
	  if(document.form1.kuaidi.value==""){
		alert("请输入快递名称");
		document.form1.kuaidi.focus();
		return false;}
		if(document.form1.knumber.value==""){
		alert("请输入快递编号");
		document.form1.knumber.focus();
		return false;}
		
	}
</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">发货</div></td></tr>
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
								<form name="form1" method="post"  action="?action=update" onSubmit="return check()">
									<input type="hidden" name="id" value="<?php echo $_REQUEST["id"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="2%">&nbsp;</td>
                                            <td width="120" align="right">快递名称：</td>
                                          <td width="200"><input name="kuaidi" type="text" class="text" size="30"  maxlength="20"></td>
                                            <td></td>
                                            <td width="2%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="2%">&nbsp;</td>
                                            <td align="right">快递编号：</td>
                                          <td><input name="knumber" type="text" class="text" size="30"  maxlength="50">
                                          </td>
                                            <td></td>
                                            <td width="2%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td align="right"><input class="btn" type="submit" value="提交" /></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
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