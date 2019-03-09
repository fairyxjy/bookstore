<?php 
	include_once("header.php");
	check_loginuser();
	$page = $_REQUEST["page"]?$_REQUEST["page"]:"1";
	$whereSql = " userid=".$_SESSION["id"];
	$page = $_REQUEST["page"]?$_REQUEST["page"]:"1";
	$list = db_get_page("select * from cart where $whereSql order by id desc", $page,12);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "", $page);
	$page_show = $Page->show();
	$cat_title = "我的购物车";
?>
<link type="text/css" rel="stylesheet" href="<?php echo __PUBLIC__;?>/css/list.css">
<div style="height:25px;"></div>
    <form action='cart2.php' method='post'>
    <div class="listmain">
        <div class="cart_table">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="tr_top">
                        <td width="48">
                            <input type="checkbox"  class="cartcheckbox" id="cartcheckbox" checked="true" />
                        </td>
                        <td width="">图书</td>
                        <td width="143">单价（元）</td>
                        <td width="143">数量</td>
                        <td width="143">小计（元）</td>
                        <td width="100">操作</td>
                    </tr>
                    <?php
					 $total=0;
					 foreach($list["data"] as $row) {
					$good = db_get_row("select * from goods where id=". $row["goodid"] ."");
						?>
                    
                    <tr class="tr_view">
                        <td>
                            <input type="hidden" name="order_no" value="">
                            <input type="checkbox" name="cart_id[]" class="cartcheckbox" checked="true" value='<?php echo $row['id'];?>'/>
                        </td>
                        <td class="cart_td1">
                            <a href="goodshow.php?id=<?php echo $good['id'];?>&categoryid=<?php echo $good['categoryid'];?>" class="cart_t">
                                <img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $good["img"];?>">
                                <span><i><?php echo $good["title"];?></i></span></a>
                        </td>
                        <td class="cart_td2">￥<span><?php echo $good["sprice"];?></span></td>
                        <td>
                            <div class="cartnum">
                                <span class="min">-</span><span id='<?php echo $good['id'];?>' class="carttext"><?php echo $row['sums'];?></span>
                                <span class="add">+</span>
                            </div>
                        </td>
                        <td class="cart_td4 cartred">￥<span></span></td>
                        <td>
                            <a href="del.php?id=<?php echo $row['id'];?>&del=cart" class="mviewmore">删除</a>
                        </td>
                    </tr>
                    <?php
					$total=$total+1;
					 }?>
                   </tbody>
            </table>
        </div>
        <p class="carttotal">
            共 <i class="cartred"><?php echo $total;?></i> 件图书，总计金额：
            <span class="cartred">¥<em></em></span>
        </p>
        <div class="cartbtn">
            <input type="submit" value="确认无误，结算"><a href="goods.php">继续购物</a> <a href="cartclear.php" style="margin-right:12px;">清空购物车</a> </div>
    </div>
    </form>
    <script type="text/javascript">
    $(function() {
        // 点击全选按钮
        $("#cartcheckbox").click(function() {
            if ($(this).prop("checked") == true) {
                $(".cartcheckbox").prop("checked", true);
            } else {
                $(".cartcheckbox").prop("checked", false);
            }

        });
        // 小计初始化
        function numInit(){
            var priceItem = new Array(); // 用来存放每行的小计;
            var sumCount = 0.00; // 用来存放总计;
            $('.tr_view').each(function(index, element){
                var num = parseInt($(element).find(".carttext").text());
                var price = parseFloat($(element).closest('tr').find('.cart_td2 span').text());
                var count = (num*price).toFixed(2);
                $(element).find(".cart_td4 span").text(count);
                if($(element).find('.cartcheckbox').prop('checked')){
                    priceItem.push(count);
                }
            });
            for (var i=0; i<priceItem.length; i++) {
                sumCount += parseFloat(priceItem[i]);
            }
            if(parseFloat(sumCount)===0.00){
                $('.cartbtn input').css({'background':'#ccc', 'color':'#999'}).attr('disabled', 'disabled');
            } else{
            	$('.cartbtn input').css({'background':'#4f4f4f', 'color':'#fff'}).removeAttr('disabled');
            }
            $(".carttotal em").text(sumCount.toFixed(2));
        }
        numInit();
        // 加减数
        // 加
        $(".add").click(function() {
            var num = parseInt($(this).siblings(".carttext").text());
            var id = parseInt($(this).siblings(".carttext").attr('id'));
            htmlobj=$.ajax({type: 'POST',url: "cartajax.php?a=check_count",data: {id:id,count:num},dataType: 'json',async:false});  
            if(htmlobj.responseText==1){
            $(this).siblings(".carttext").text(num+1);
            numInit();
            }
            else alert('库存不足')
      
        })
        // 减
        $(".min").click(function() {
            var num = parseInt($(this).siblings(".carttext").text());
             var id = parseInt($(this).siblings(".carttext").attr('id'));
            if(num == 0){
                return;
            }
            htmlobj=$.ajax({type: 'POST',url: "cartajax.php?a=ajaxBuyCount",data: {id:id,count:num},dataType: 'json',async:false}); 
            if(htmlobj.responseText=='ok'){
            $(this).siblings(".carttext").text(num-1);
            numInit();
            } 
        
        })
        // 取消选中则重新计算总价
        $(".cartcheckbox").change(function(){
            numInit();
        });
        function check_count(id,count)
        {
            var data={id:id,count:count};
            var htmlobj=$.ajax({type: 'POST',url: '{:U("Ajax/check_count")}',data: data,dataType: 'json',async:false});
    		return( htmlobj.responseText);
        }
    })
    </script>
<?php
	include_once("footer.php");
?>