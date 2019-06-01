<?$site="orders";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<?include("profile_top.php");?>
<h1><?=word_lang("orders")?></h1>




<?
//Текущая страница
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}

//Количество новостей на странице
$kolvo=k_str;


//Количество страниц на странице
$kolvo2=k_str2;



$sql="select * from orders where user=".(int)$_SESSION["people_id"]." order by data desc,id desc";
$rs->open($sql);
if(!$rs->eof)
{
?>
<table border='0' cellpadding='0' cellspacing='0' style="margin-bottom:20px" class="profile_table" width="100%">
<tr>
<th>ID</th>
<th class='hidden-phone hidden-tablet'><?=word_lang("date")?></th>

<th class='hidden-phone hidden-tablet'><?=word_lang("subtotal")?></th>
<?if(!$site_credits){?>
<th class='hidden-phone hidden-tablet'><?=word_lang("discount")?></th>
<?}?>
<th class='hidden-phone hidden-tablet'><?=word_lang("shipping")?></th>
<?if(!$site_credits){?>
<th class='hidden-phone hidden-tablet'><?=word_lang("taxes")?></th>
<?}?>
<th class='hidden-phone hidden-tablet'><?=word_lang("total")?></th>
<th><?=word_lang("status")?></th>
<th><?=word_lang("shipping")?></th>
<?if(!$site_credits){?>
<th></th>
<?}?>
</tr>
<?
$tr=1;
$n=0;
while(!$rs->eof)
{
if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td><div class="link_order"><a href="orders_content.php?id=<?=$rs->row["id"]?>"><?=word_lang("order")?> #<?=$rs->row["id"]?></a></div></td>
<td class='hidden-phone hidden-tablet'><div class="link_date"><?=date(date_format,$rs->row["data"])?></div></td>

<td class='hidden-phone hidden-tablet'><?=currency(1);?><?=float_opt($rs->row["subtotal"],2)?> <?=currency(2);?></td>
<?if(!$site_credits){?>
<td class='hidden-phone hidden-tablet'><?=currency(1);?><?=float_opt($rs->row["discount"],2)?> <?=currency(2);?></td>
<?}?>
<td class='hidden-phone hidden-tablet'><?=currency(1);?><?=float_opt($rs->row["shipping"],2)?> <?=currency(2);?></td>
<?if(!$site_credits){?>
<td class='hidden-phone hidden-tablet'><?=currency(1);?><?=float_opt($rs->row["tax"],2)?> <?=currency(2);?></td>
<?}?>
<td class='hidden-phone hidden-tablet'><b><?=currency(1);?><?=float_opt($rs->row["total"],2)?> <?=currency(2);?></b></td>
<td><?
if($rs->row["status"]==1){echo("<div class='link_approved'>".word_lang("approved")."</div>");}
else{echo("<div class='link_pending'>".word_lang("pending")."</div>");
}
?></td>

<td>
<?
if($rs->row["shipped"]==0 and $rs->row["shipping"]*1!=0){echo("<div class='link_pending'>".word_lang("not shipped")."</div>");}
if($rs->row["shipped"]==1 and $rs->row["shipping"]*1!=0){echo("<div class='link_approved'>".word_lang("shipped")."</div>");}
if($rs->row["shipped"]==0 and $rs->row["shipping"]*1==0){echo("&mdash;");}
?>
</td>

<?if(!$site_credits){?>
<td><div class="link_payment"><a href="payments.php?product_id=<?=$rs->row["id"]?>&product_type=order&print=1"><?=word_lang("purchase statement")?></a></div></td>
<?}?>


</tr>
<?
}
$n++;
$tr++;
$rs->movenext();
}
?>
</table>
<?
echo(paging2($n,$str,$kolvo,$kolvo2,"orders.php",""));
}
else
{
?>
<p><?=word_lang("not found")?>.</p>
<?
}
?>




<?include("profile_bottom.php");?>







<?include("../inc/footer.php");?>