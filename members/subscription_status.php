<?if(!defined("site_root")){exit();}?>

<?
$sql="select title,user,data1,data2,bandwidth,bandwidth_limit,subscription,approved,id_parent from subscription_list where user='".result($_SESSION["people_login"])."' order by data2 desc";
$ds->open($sql);
if(!$ds->eof)
{
?>

<table border="0" cellpadding="0" cellspacing="0"   class="profile_table" width="100%">
<tr>
<th><b><?=word_lang("subscription")?>:</b></th>
<th class='hidden-phone hidden-tablet'><b><?=$subscription_limit?>:</b></th>
<th class='hidden-phone hidden-tablet'><b><?=word_lang("content type")?>:</b></th>
<th class='hidden-phone hidden-tablet'><b><?=word_lang("setup date")?>:</b></th>
<th><b><?=word_lang("expiration date")?>:</b></th>
<th><b><?=word_lang("status")?>:</b></th>
</tr>

<?
$tr=1;
while(!$ds->eof)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td><div class="link_subscription"><a href="payments.php?product_id=<?=$ds->row["id_parent"]?>&product_type=subscription&print=1"><?=$ds->row["title"]?></a></div></td>
<td class='hidden-phone hidden-tablet'><?

$bandwidth=$ds->row["bandwidth"];
$bandwidth_text="";
if($subscription_limit=="Bandwidth")
{
	$bandwidth=float_opt($ds->row["bandwidth"],3);
	$bandwidth_text="Mb.";
}
if($subscription_limit=="Credits")
{
	$bandwidth=float_opt($ds->row["bandwidth"],2);
}
echo($bandwidth);

?>(<?=$ds->row["bandwidth_limit"]?>) <?=$bandwidth_text?></td>
<td class='hidden-phone hidden-tablet'><?
$sql="select * from subscription where id_parent=".$ds->row["subscription"];
$rs->open($sql);
if(!$rs->eof)
{
echo(str_replace("|","&nbsp;+&nbsp;",$rs->row["content_type"]));
}
?></td>
<td class='hidden-phone hidden-tablet'><div class="link_date"><?=date(datetime_format,$ds->row["data1"])?></div></td>
<td><div class="link_date"><?=date(datetime_format,$ds->row["data2"])?></div></td>
<td><?if($ds->row["approved"]==1){echo("<div class='link_approved'>".word_lang("approved")."</div>");}else{echo("<div class='link_pending'>".word_lang("pending")."</div>");}?></td>
</tr>
<?
$tr++;
$ds->movenext();
}
?>
</table>

<?}?>
