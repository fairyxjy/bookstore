<?php 
	include_once("header.php");
	$row = db_get_row("select * from goods where id=".$_REQUEST["id"]);
	db_query("update goods set apv=apv+1 where id=".$_REQUEST["id"]);
	if(!$_REQUEST["categoryid"]){$cat_title = "图书中心";}else{
	$catA = db_get_row("select * from category where id=".$_REQUEST["categoryid"]);
	$cat_title = $catA["title"];}
	//发送评论
	if ($_POST) {
		if (!$_SESSION["id"]) {
			goBakMsg("登录后才可提交！");
			die;
		}
		$data = array();
		$data["userid"] = $_SESSION["id"];
		$data["goodid"] = $_POST['goodid'];
		$data["content"] = "'".$_POST["content"]."'";
		db_add("comment",$data);
		goBakMsg("提交成功！");
		die;
	}
?>
    <div class="pro_view">
        <!--图片效果-->
        <div class="picgroup">
            <div id="preview">
                <div class="jqzoom" id="spec-n1">
				<img  src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="300" width="300" />
                </div>
                <div id="spec-n5">
                <div id="spec-list">
                    <ul class="list-h">
                                            </ul>
                </div>
                </div>
            </div>
        </div>
        <div class="picinfor">
            <h2><?php echo $row["title"];?></h2>
            <h3>图书编号：<?php echo $row["pnumber"];?></h3>
            <h3>图书剩余：<?php echo $row["amount"];?></h3>
            <h3>图书销量：<?php echo $row["cishu"];?></h3>
            <h4>市场价：<span id="price"><s>¥ <?php echo $row["mprice"];?></s></span></h4>
            <h4>会员价：<span id="price">¥ <?php echo $row["sprice"];?></span></h4>
            <form action="addcart.php" method="post">
			<input type="hidden" value="<?php echo $row["id"];?>" name="id" />
            <div class="num1">
                <div class="num01">数&nbsp;&nbsp;&nbsp;量：</div>
                <div class="gw_num" style="border: 1px solid #dbdbdb;width: 110px;line-height: 26px;overflow: hidden;">
                            <em class="jian">-</em>
                            <input type="text" name="sums" id="buy_count" value="1" class="num" readonly="readonly"/>
                            <em class="add">+</em>
                        </div>
            </div>
            <div class="btn02 addcar"><input type="image" src="<?php echo __PUBLIC__;?>/images/gwc.jpg" /></div>
            </form>
        </div>

        <div class="c_b"></div>
        <div class="pro_view_left">
            <!--热销产品-->
            <div class="pro_view_left01">
                <div class="title">热门图书</div>
                <div class="list">
                <?php $goodt = db_get_all("select * from goods order by cishu desc limit 5");foreach($goodt as $goodtrow) {?>
                <dl>
					<dt><a href="goodshow.php?categoryid=<?php echo $goodtrow["categoryid"];?>&id=<?php echo $goodtrow["id"];?>"><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $goodtrow["img"];?>" width="65" height="65"/></a></dt>
                    <dd><a href="goodshow.php?categoryid=<?php echo $goodtrow["categoryid"];?>&id=<?php echo $goodtrow["id"];?>"><?php echo $goodtrow['title'];?></a><span>￥<?php echo $goodtrow["sprice"];?></span></dd>
                 </dl>
                 <?php }?>
                </div>
            </div>
        </div>
        <!--图书详情-->
        <div class="pro_view_right">
            <div class="title"><span>图书详情</span></div>
            <div class="view"><?php echo $row["content"];?></div>
        </div>
        <div class="c_b"></div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
	//加的效果
	$(".add").click(function(){
	var n=$(this).prev().val();
	var num=parseInt(n)+1;
	if(num==0){ return;}
	$(this).prev().val(num);
	});
	//减的效果
	$(".jian").click(function(){
	var n=$(this).next().val();
	var num=parseInt(n)-1;
	if(num==0){ return}
	$(this).next().val(num);
	});
	})
</script>
<?php
	include_once("footer.php");
?>