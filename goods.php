<?php 
	include_once("header.php");
	$whereSql = "1=1";
	$tb_name = "goods";
	if ($_REQUEST["categoryid"]){
		$whereSql .= " and categoryid=" . $_REQUEST["categoryid"];
	}
	if ($_REQUEST["keywords"]) {
		$whereSql .= " and title like '%". $_REQUEST["keywords"] ."%' ";
	}
	$page = $_REQUEST["page"]?$_REQUEST["page"]:"1";
	$list = db_get_page("select * from $tb_name where $whereSql and status=0 order by addtime desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&categoryid=".$_REQUEST["categoryid"]."&keywords=".$_REQUEST["keywords"]."&essayid=".$_REQUEST["essayid"]."", $page);
	$page_show = $Page->show(); 
	if(!$_REQUEST["categoryid"]){$cat_title = "图书中心";}else{
	$catA = db_get_row("select * from category where id=".$_REQUEST["categoryid"]);
	$cat_title = $catA["title"];}
?>
<div class="pro_sear">
	<div class="box">
		<div class="pro_wz"><a href="index.php">首页</a><em>&gt;</em><span><?php echo $cat_title;?></span></div>
		<div class="pro_sear01">
			<div class="list">
			<span>分类：</span><a <?php if(!$_REQUEST["categoryid"]){?>class="list_on"<?php }?> href="goods.php?essayid=<?php echo $_REQUEST["essayid"];?>">全部</a>
			<?php $cateart = db_get_all("select * from category where pid=1 order by id desc limit 10");foreach($cateart as $caterow) {?><a <?php if($caterow["id"]==$_REQUEST["categoryid"]){?>class="list_on"<?php }?> href="goods.php?categoryid=<?php echo $caterow["id"];?>&essayid=<?php echo $_REQUEST["essayid"];?>"><?php echo $caterow['title'];?></a><?php }?></div>
			<div class="c_b"></div>
		</div>
	</div>
	<div class="prolist">
		<div class="prolist01">
			<div class="box">
				<?php foreach($list["data"] as $row) {?>
				<dl><a href="goodshow.php?id=<?php echo $row['id'];?>&categoryid=<?php echo $row['categoryid'];?>">
				<dt><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" width="230" height="230"></dt>
				<dd><span>￥<?php echo $row['sprice'];?></span><em><?php echo $row['title'];?></em></dd>
				</a>
				</dl>
				<?php }?>
			</div>
			<?php echo $page_show;?>
		</div>
	</div>
</div>
<?php 
	include_once("footer.php");
?>