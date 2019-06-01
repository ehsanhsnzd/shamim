<?if(!defined("site_root")){exit();}?>
<?include("payments_settings.php");?>
<form method="post" action="billing.php?type=subscription">
<table border="0" cellpadding="0" cellspacing="0"   class="profile_table" width="100%">
<tr>
<th colspan="2"><b><?=word_lang("subscription")?>:</b></th>
<th><b><?=word_lang("price")?>:</b></th>
<th><b><?=$subscription_limit?><?if($subscription_limit=="Bandwidth"){echo(" Mb.");}?>:</b></th>
<th><b><?=word_lang("content type")?>:</b></th>
</tr>
<?
$i=0;
$tr=0;
if(isset($subscription_upgrade))
{
$sql="select * from subscription ".$subscription_upgrade." order by priority";
}
else
{
$sql="select * from subscription order by priority";
}
$rs->open($sql);
while(!$rs->eof)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td align="center"><input name="subscription" type="radio" value="<?=$rs->row["id_parent"]?>" <?if($i==0){echo("checked");}?>></td>
<td><?=$rs->row["title"]?></td>
<td><b><?=currency(1,false)?><?=float_opt($rs->row["price"],2)?> <?=currency(2,false)?></b></td>
<td><?=$rs->row["bandwidth"]?></td>
<td><?=str_replace("|","&nbsp;+&nbsp;",$rs->row["content_type"])?></td>
</tr>
<?
$i++;
$tr++;
$rs->movenext();
}
?>





</table>
<input type="hidden" name="tip" value="subscription">
<input class='isubmit' type="submit" value="<?=word_lang("buy")?>" style="margin-top:3px">

</form>