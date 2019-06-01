<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("id")?></b></th>
<th><b><?=word_lang("date")?></b></th>
<th><b><?=word_lang("user")?></b></th>
<th><b><?=word_lang("title")?></b></th>
<th><b><?=word_lang("status")?></b></th>
</tr>
<?
$tr=1;
$sql="select id_parent,user,data1,title,approved from subscription_list order by data1 desc limit 5";
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
<td nowrap><a href="../subscription_list/edit.php?id=<?=$rs->row["id_parent"]?>"><b>#<?=$rs->row["id_parent"]?></b></a></td>
<td nowrap><?=date(date_format,$rs->row["data1"])?></td>
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
<td><?=$rs->row["title"]?></td>
<td>


<div class="link_status" id="sstatus<?=$rs->row["id_parent"]?>" name="sstatus<?=$rs->row["id_parent"]?>"><a href="javascript:doLoad3(<?=$rs->row["id_parent"]?>);" <?=$cl?>><?if($rs->row["approved"]==1){echo(word_lang("approved"));}else{echo(word_lang("pending"));}?></a></div>



<form id="sf<?=$rs->row["id_parent"]?>" enctype="multipart/form-data" style="margin:0">

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