<?php
include_once("common/init.php");
check_loginuser();
db_dela("cart","userid=".$_SESSION["id"]);
goBakMsg("清空成功");
?>