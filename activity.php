<?php 
	include_once("header.php");
	$whereSql = "categoryid=7";
	$tb_name = "content1";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:"1";
	$list = db_get_page("select * from $tb_name where $whereSql order by addtime desc", $page,8);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "", $page);
	$page_show = $Page->show(); 
	$catA = db_get_row("select * from category where id=7");
	$cat_title = $catA["title"];
?>
<div class="about_fra">
	<div class="ab_now"><a href="index.php">网站首页</a>&gt;<span><?php echo $cat_title;?></span></div>
    <div class="ab_of">
      <?php include_once("userleft.php"); ?>
        <div class="ab_fr">
            <h2><span><?php echo $cat_title;?></span></h2>
            <ul class="comp_info"> 
            	<?php foreach($list["data"] as $row) {?>
                 <li><a href="mv1.php?id=<?php echo $row['id'];?>&categoryid=<?php echo $row['categoryid'];?>"><?php echo $row['title'];?></a><span><?php echo $row['addtime'];?></span></li>
                 <?php } ?>
                 <div class="clear"></div>
        </ul>
        <?php echo $page_show;?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php 
	include_once("footer.php");
?>