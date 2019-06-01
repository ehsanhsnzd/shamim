<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("affiliates_settings");
?>
<? include("../inc/begin.php");?>






<h1><?=word_lang("settings")?>:</h1>

<form method="post" action="change.php">
<?
$sql="select * from affiliates_settings";
$rs->open($sql);
while(!$rs->eof)
{
if($rs->row["id"]==1)
{
?>
<div class="admin_field">
<b>Buyer signup commission:</b><br>
<small>If a buyer signs up then an affiliate gets % commission from all orders of the buyer.</small><br>
<input type="text" name="buyer" style="width:100px;margin-top:3px;" value="<?=$rs->row["meaning"]?>">
</div>
<?}else{?>

<div class="admin_field">
<b>Seller signup commission:</b><br>
<small>If a seller signs up then an affiliate gets % commission from all sells of the seller.</small><br>
<input type="text" name="seller" style="width:100px;margin-top:3px;" value="<?=$rs->row["meaning"]?>">
</div>

<div class="admin_field">
<b>Change the commission rates for the existed affiliates?</b><br>
<select name="addto" style="width:70px">
	<option value="0">No</option>
	<option value="1">Yes</option>
</select>
</div>
<?
}
$rs->movenext();
}
?>
<div class="admin_field">
<input type="submit" class="btn btn-primary" value="<?=word_lang("change")?>">
</div>
</form>

<? include("../inc/end.php");?>