<?
//Check access
admin_panel_access("settings_payout");

?>
<?if(!defined("site_root")){exit();}?>











<?
$tr=1;
$sql="select * from payout";
$rs->open($sql);
if(!$rs->eof)
{
?>
<form method="post" action="change.php">
<div class="table_t"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:300px">
<tr>
<th><b><?=word_lang("payment gateways")?>:</b></th>
<th><b><?=word_lang("enabled")?>:</b></th>
</tr>
<?
while(!$rs->eof)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td class="big"><?=$rs->row["title"]?></td>
<td align="center"><input name="activ_<?=$rs->row["svalue"]?>" type="checkbox" <?if($rs->row["activ"]==1){echo("checked");}?>></td>
</tr>
<?
$tr++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>
<input type="submit" class="btn btn-primary" value="<?=word_lang("change")?>" style="margin:10px 0px 0px 6px">
</form><br>
<?
}
?>
