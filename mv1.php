<?php 
	include_once("header.php");
	$row = db_get_row("select * from content1 where id=".$_REQUEST["id"]);
	db_query("update content1 set apv=apv+1 where id=".$_REQUEST["id"]);
	if(!$_REQUEST["categoryid"]){$cat_title = "资讯中心";}else{
	$catA = db_get_row("select * from category where id=".$_REQUEST["categoryid"]);
	$cat_title = $catA["title"];}
?>
<div class="about_fra">
	<div class="ab_now"><a href="index.php">网站首页</a>&gt;<span><?php echo $cat_title;?></span></div>
    <div class="ab_of">
      <?php include_once("userleft.php"); ?>
        <div class="ab_fr">
            <div class="ab_frname"><?php echo $row["title"];?> </div>
            <div class="ab_frsou">时间：<?php echo $row["addtime"];?>   点击：<?php echo $row["apv"];?>次   发布者：<?php if($row["userid"]==0){echo "管理员";}else{?><?php echo db_get_val("user",$row["userid"],"account")?><?php }?></div>
            <div class="ab_frcon1">
            <p><?php echo $row["content"];?></p>
            
            
            </div>
            
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php 
	include_once("footer.php");
?>