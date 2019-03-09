<?php 
	include_once("header.php");
?>

<script type="text/javascript" src="<?php echo __PUBLIC__;?>/js/base1.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>/js/SuperSlide.js"></script>
<div class="banner">
	<div id="slideBox" class="slideBox">
		<div class="hd"><ul><li>1</li><li>2</li></ul></div>
		<div class="bd">
			<ul>
			  <li style="background-image:url(<?php echo __PUBLIC__;?>/images/banner1.jpg)"><a href_=""></a></li>
			  <li style="background-image:url(<?php echo __PUBLIC__;?>/images/banner2.jpg)"><a href_=""></a></li>
			</ul>
		</div>
		<a class="prev" href="javascript:void(0)"></a><a class="next" href="javascript:void(0)"></a>
	</div>
<script type="text/javascript">jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true,effect:"fold"});</script>
</div>
<div class="announce">
	<span>最新活动：</span>
	<?php $new_art1 = db_get_all("select * from content1 where categoryid=7 order by id desc limit 6");foreach($new_art1 as $row1) {?><a href="mv1.php?id=<?php echo $row1['id'];?>&categoryid=<?php echo $row1['categoryid'];?>"><?php echo $row1['title'];?></a><em>|</em><?php }?>
</div>
<div class="clear"></div>

<div class="all_pro">
	<div class="all_pro01">
        <div id="float01" class="float01">
			<div class="title"><span>推荐图书</span><div class="more"><a href="goods.php">更多</a></div></div>
            <div class="prolist">
                <div class="prolist01">
                    <div class="box">
                        <?php $new_art1 = db_get_all("select * from goods where status=0 and isnice=1 order by id desc limit 8");foreach($new_art1 as $row) {?>
                        <dl>
                        <a href="goodshow.php?id=<?php echo $row['id'];?>&categoryid=<?php echo $row['categoryid'];?>">
                        <dt><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" width="230" height="230"></dt>
                        <dd><span>￥<?php echo $row['sprice'];?></span><em><?php echo $row['title'];?></em></dd></a>
                        </dl> 
                        <?php }?>  
                    </div>
                </div>
			</div>
			<div class="c_b"></div>
		</div>
	</div>
</div>
<?php include("footer.php");?>