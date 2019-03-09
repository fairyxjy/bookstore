<?php 
	include_once("../common/init.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head id="Head1"><title><?php echo $CONFIG["webname"];?>-登录</title>
<style type="text/css"> 
body {
	background:#3c7fb5 url(skin/login/images/bg_login.jpg) repeat-x left top;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,table,td,div {
	font-size: 12px;
	line-height: 24px;
	  
}
.textfile {background:url(skin/login/images/bg_login_textfile.gif) no-repeat left top; padding: 0px 2px; height: 29px; width: 143px; border: 0; }
 
</style> 
</head>
<body>
<table width="95" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="skin/login/images/top_login.jpg" width="596" height="331" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="99"><img src="skin/login/images/login_06.jpg" width="99" height="139" /></td>
        <td background="skin/login/images/bg_form.jpg"><table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
          <form name="form1" method="post" action="logincheck.php" id="form1"><tr>
            <td height="35" align="right">用户名：</td>
            <td>
              <label>
                <input id="account" name="account" type="text" class="textfile"  required="required"/>
                </label>            </td>
          </tr>
          <tr>
            <td height="35" align="right">密&nbsp;&nbsp;码：</td>
            <td><label>
              <input name="password" id="password" type= "password"  class="textfile"  required="required"/>
            </label></td>
          </tr>
          <tr>
            <td height="35">&nbsp;</td>
            <td><label>
              <input   type="Submit" name="Submit" value="登录" />
              <input type="reset" name="Submit2" value="重置" />
            </label></td>
          </tr>
        
          
          </form>
        </table></td>
        <td width="98" align="right"><img src="skin/login/images/login_08.jpg" width="98" height="139" /></td>
      </tr>
    </table></td>
  </tr>
  <tr> 
    <td><img src="skin/login/images/bottom_login.jpg" width="596" height="39" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">版权所有：<?php echo $CONFIG["webname"];?></td>
  </tr>
</table>
</body>
</html>
