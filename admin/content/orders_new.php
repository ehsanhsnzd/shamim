<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("id")?></b></th>
<th><b><?=word_lang("date")?></b></th>
<th><b><?=word_lang("user")?></b></th>
<th><b><?=word_lang("total")?></b></th>
<th><b><?=word_lang("status")?></b></th>
<th><b><?=word_lang("shipped")?></b></th>
</tr>
<?
$tr=1;
$sql="select id,user,data,total,status,shipped,shipping from orders order by data desc limit 5";
$rs->open($sql);
while(!$rs->eof)
{

$cl="";
if($rs->row["status"]!=1)
{
$cl="class='red'";
}

$cl2="";
if($rs->row["shipped"]!=1)
{
$cl2="class='red'";
}
?>
<tr <?if($tr%2==0){echo("class='snd'");}?> valign="top">
<td><a href="../orders/order_content.php?id=<?=$rs->row["id"]?>"><b>#<?=$rs->row["id"]?></b></a></td>
<td><?=date(date_format,$rs->row["data"])?></td>
<td>
<?
$sql="select id_parent,login from users where id_parent=".$rs->row["user"];
$ds->open($sql);
if(!$ds->eof)
{
?><div class="link_user"><a href="../customers/content.php?id=<?=$ds->row["id_parent"]?>"><?=$ds->row["login"]?></a></div><?
}
?>
</td>
<td><?=float_opt($rs->row["total"],2)?></td>
<td>


<div class="link_status" id="status<?=$rs->row["id"]?>" name="status<?=$rs->row["id"]?>"><a href="javascript:doLoad(<?=$rs->row["id"]?>);" <?=$cl?>><?if($rs->row["status"]==1){echo(word_lang("approved"));}else{echo(word_lang("pending"));}?></a></div>



<form id="f<?=$rs->row["id"]?>" enctype="multipart/form-data" style="margin:0">

<input type="hidden" name="id" value="<?=$rs->row["id"]?>">

</form>



</td>
<td>
<?
if($rs->row["shipping"]*1!=0)
{
?>

<div class="link_status" id="shipping<?=$rs->row["id"]?>" name="shipping<?=$rs->row["id"]?>"><a href="javascript:doLoad4(<?=$rs->row["id"]?>);" <?=$cl2?>><?if($rs->row["shipped"]==1){echo(word_lang("shipped"));}else{echo(word_lang("not shipped"));}?></a></div>



<?
}
else
{
echo(word_lang("digital"));
}
?>


</td>
</tr>
<?
$tr++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>