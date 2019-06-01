<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("id")?></b></th>
<th><b><?=word_lang("date")?></b></th>
<th><b><?=word_lang("user")?></b></th>
<th><b><?=word_lang("quantity")?></b></th>
<th><b><?=word_lang("status")?></b></th>
</tr>
<?
$tr=1;
$sql="select id_parent,user,data,quantity,approved from credits_list order by data desc limit 6";
$rs->open($sql);
while(!$rs->eof)
{

$cl="";
if($rs->row["approved"]!=1)
{
$cl="class='red'";
}
?>
<tr <?if($tr%2==0){echo("class='snd'");}?> valign="top">
<td>
<?if($rs->row["quantity"]>0){?>
<a href="../orders/payments.php?product_id=<?=$rs->row["id_parent"]?>&product_type=credits&print=1">
<?}?>

<b>#<?=$rs->row["id_parent"]?></b></a></td>
<td><?=date(date_format,$rs->row["data"])?></td>
<td>
<?
$sql="select id_parent,login from users where login='".$rs->row["user"]."'";
$ds->open($sql);
if(!$ds->eof)
{
?><div class="link_user"><a href="../customers/content.php?id=<?=$ds->row["id_parent"]?>"><?=$ds->row["login"]?></a></div><?
}
?>
</td>
<td><?=$rs->row["quantity"]?></td>
<td>


<div class="link_status" id="cstatus<?=$rs->row["id_parent"]?>" name="cstatus<?=$rs->row["id_parent"]?>"><a href="javascript:doLoad2(<?=$rs->row["id_parent"]?>);" <?=$cl?>><?if($rs->row["approved"]==1){echo(word_lang("approved"));}else{echo(word_lang("pending"));}?></a></div>



<form id="cf<?=$rs->row["id_parent"]?>" enctype="multipart/form-data" style="margin:0">

<input type="hidden" name="id" value="<?=$rs->row["id_parent"]?>">

</form>



</td>
</tr>
<?
$tr++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>