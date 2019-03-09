<?php 
	include_once("header.php");
	check_loginuser();
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$list = db_get_page("select * from orders where userid='".$_SESSION["id"]."' order by id desc", $page,5);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "", $page);
	$page_show = $Page->show(); 
?>
<div class="member_fra">
    <div class="clear"></div>
    <div class="member_information">
		<?php include_once("userleft.php"); ?>
        <div class="member_info_fr">  
        	<h2>个人信息</h2>
            <div class="member_center_table">
                <table class="mtable" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr class="tr_top">
                        <td width="327" align="center">订单信息</td>
                        <td width="131" align="center">订单金额</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
				<?php foreach($list["data"] as $info) {?>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr class="tr_name">
                        <td>订单编号: <a href="ordershow.php?id=<?php echo $info['id'];?>"><?php echo $info['onumber'];?></a></td>
                        <td colspan="2" align="right"><?php if($info['th']==0){ echo $info['zt'];?> <?php if($info['zt']=="未付款"){?><a href="ordersave.php?act=del&ordersid=<?php echo $info['id'];?> ">取消</a> <a href="ordersave.php?act=zhifu&ordersid=<?php echo $info['id'];?>"><font color="#FF0000">付款</font></a><?php }}elseif($info['th']==-1){echo "退货审核中";}else{echo "已退货";}?></td>
                    </tr>
				<?php $ordersta = db_get_all("select * from ordersta where ordersid=".$info['id']." order by id desc");foreach($ordersta as $ordersrow) {
	  $info1=db_get_row("select * from goods where id=".$ordersrow['goodid']);//调出商品信息
?>
                    <tr class="tr_view">

                         <td width="327" align="center" class="mem_td1" style="width:327px;">
                            <a href="goodshow.php?id=<?php echo $info1['id'];?>&categoryid=<?php echo $info1['categoryid'];?>" target="_blank"><span class="mem_img"><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $info1["img"];?>" height="69px" width="69px"></span></a>
                            <span class="mem_wor"><a href="goodshow.php?id=<?php echo $info1['id'];?>&categoryid=<?php echo $info1['categoryid'];?>" target="_blank"><?php echo $info1['title'];?></a></span>
                        </td>
                                                 <td width="131" align="center" class="mem_td2">￥<?php echo $ordersrow['price']*$ordersrow['nums'];?></td>
                                                            
                         <td> </td>
                        
                  </tr><?php }?>       </table>  <?php }?>
    <div class="black"></div>
              <?php echo $page_show;?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php
	include_once("footer.php");
?>