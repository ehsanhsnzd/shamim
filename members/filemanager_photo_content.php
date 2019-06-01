<?if(!defined("site_root")){exit();}?>

<table border="0" cellpadding="0" cellspacing="2" align="right">
<tr height="15">
<td width="20" class="upload_ok">&nbsp;</td>
<td class="smalltext"> - <?=word_lang("upload permitted")?></td>
</tr>
<tr height="15">
<td width="20" class="upload_error">&nbsp;</td>
<td class="smalltext"> - <?=word_lang("upload denied")?></td>
</tr>
</table>




<div name="sparent" id="sparent" class="form_field">
	<span><b><?=word_lang("category")?> 1:</b></span>
	<select name="folder" style="width:450px" class='ibox'>
	<option value=""></option>
	<?
	$itg="";
	$smarty_buildmenu5_id="buildmenu|5|".(int)$folderid;
	if (!$smarty->is_cached('buildmenu5.tpl',$smarty_buildmenu5_id))
	{
		$nlimit=0;
		buildmenu5(5,(int)$folderid,2,0);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu5', $itg);
	$itg=$smarty->fetch('buildmenu5.tpl',$smarty_buildmenu5_id);
	echo($itg);
	?>
	</select>
</div>



<div class="form_field"><span><?=word_lang("category")?> 2:</span>
	<select name="folder2" style="width:450px" class='ibox'>
	<option value="0"></option>
	<?
	echo($itg);
	?>
	</select>
</div>




<div class="form_field"><span><?=word_lang("category")?> 3:</span>
	<select name="folder3" style="width:450px" class='ibox'>
	<option value="0"></option>
	<?
	echo($itg);
	?>
	</select>
</div>










<?
if(!$global_settings["printsonly"])
{
?>
<div class="form_field">
	<span><b><?=word_lang("price")?>:</b></span>
	<?$file_form=false;?>
	<?=photo_upload_form()?>
</div>
<?
}
?>












<?
if($global_settings["prints_users"])
{
?>
<div class="form_field">
	<span><b><?=word_lang("prints and products")?>:</b></span>
<?
echo(prints_upload_form()."</div>");
}
?>












<?if($site_model){?>
<div class="form_field">
	<span><b><?=word_lang("model property release")?>:</b></span>
	<select name="model" style="width:450px" class='ibox'>
	<option value="0"></option>
	<?
	$sql="select id_parent,name from models where user='".result($_SESSION["people_login"])."' order by name";
	$ds->open($sql);
	while(!$ds->eof)
	{
		$sel="";
		if($ds->row["id_parent"]==$model){$sel="selected";}
		?>
		<option value="<?=$ds->row["id_parent"]?>" <?=$sel?>><?=$ds->row["name"]?></option>
		<?
		$ds->movenext();
	}
	?>
	</select>&nbsp;&nbsp;&nbsp;<a href="models.php"><?=word_lang("edit")?></a>
	</div>
<?}?>


<?if($site_google){?>

<div class="form_field">
	<span><b><?=word_lang("Google coordinate X")?>:</b></span>
	<input class='ibox' name="google_x" value="0" type="text" style="width:200px">
</div>

<div class="form_field">
	<span><b><?=word_lang("Google coordinate Y")?>:</b></span>
	<input class='ibox' name="google_y" value="0" type="text" style="width:200px">
</div>

<?}?>

<?
if(!$global_settings["printsonly"])
{
?>
<div class="form_field">
	<span><b><?=word_lang("free")?>:</b></span>
	<input name="free" type="checkbox" <?if($free==1){echo("checked");}?>>
</div>
<?}?>


<div class="form_field">
	<span><b><?=word_lang("editorial")?>:</b></span>
	<input name="editorial" type="checkbox" <?if($editorial==1){echo("checked");}?>>
</div>

<?if($global_settings["adult_content"]){?>
<div class="form_field">
	<span><b><?=word_lang("adult content")?>:</b></span>
	<input name="adult" type="checkbox" <?if($adult==1){echo("checked");}?>>
</div>
<?}?>
