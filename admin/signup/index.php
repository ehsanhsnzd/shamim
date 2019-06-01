<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_signup");
?>
<? include("../inc/begin.php");?>






<h1><?=word_lang("sign up")?> &mdash; <?=word_lang("settings")?></h1>






<table border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
<td>



<form method="post" action="change2.php">
<div class="table_t"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:300px">
<tr>
<th></th>
<th><b><?=word_lang("type")?>:</b></th>
</tr>

<tr>
<td align="center"><input name="param" value="1" type="radio" <?if($site_signup==1){echo("checked");}?>></td>
<td class="big">Simple Sign up</td>
</tr>

<tr class="snd">
<td align="center"><input name="param" value="2" type="radio" <?if($site_signup==2){echo("checked");}?>></td>
<td class="big">Several steps Sign up</td>
</tr>

</table>
</div></div></div></div></div></div></div></div>
<input type="submit"  class="btn btn-primary" value="<?=word_lang("change")?>" style="margin:10px 0px 0px 6px">
</form>

</td>
<td style="padding-left:50px">




<?
$tr=1;
$sql="select * from users_settings";
$rs->open($sql);
if(!$rs->eof)
{
?>
<form method="post" action="change.php">
<div class="table_t"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:300px">
<tr>
<th></th>
<th><b><?=word_lang("sign up")?>:</b></th>
</tr>
<?
while(!$rs->eof)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td align="center"><input name="activ" value="<?=$rs->row["svalue"]?>" type="radio" <?if($rs->row["activ"]==1){echo("checked");}?>></td>
<td class="big"><?=word_lang($rs->row["title"])?></td>
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



</td>
</tr>
</table>










<? include("../inc/end.php");?>