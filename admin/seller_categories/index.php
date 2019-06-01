<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_sellercategories");
?>
<? include("../inc/begin.php");?>







<a class="btn btn-success toright" href="content.php"><i class="icon-user icon-white"></i> <?=word_lang("add")?></a>



<h1><?=word_lang("customer categories")?>:</h1>




<?
$sql="select id_parent,priority,name,upload,upload2,upload3,upload4,percentage from user_category order by priority";
$rs->open($sql);
if(!$rs->eof)
{
	$tr=1;
	?>
	<form method="post" action="change.php">
	<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
	<table border="0" cellpadding="0" cellspacing="1" class="table_admin" style="width:100%">
	<tr>
	<th><b><?=word_lang("priority")?>:</b></th>
	<th><b><?=word_lang("title")?>:</b></th>
	<th><b><?=word_lang("Commission")?> (to admin):</b></th>
	<?if($global_settings["allow_photo"]==1){?>
		<th><b><?=word_lang("upload photo")?>:</b></th>
	<?}?>
	<?if($global_settings["allow_video"]==1){?>
		<th><b><?=word_lang("upload video")?>:</b></th>
	<?}?>
	<?if($global_settings["allow_audio"]==1){?>
		<th><b><?=word_lang("upload audio")?>:</b></th>
	<?}?>
	<?if($global_settings["allow_vector"]==1){?>
		<th><b><?=word_lang("upload vector")?>:</b></th>
	<?}?>
	<th></th>
	<th></th>
	</tr>
	<?
	while(!$rs->eof)
	{
		?>
		<tr <?if($tr%2==0){echo("class='snd'");}?> valign="top">
		<td align="center"><input name="priority<?=$rs->row["id_parent"]?>" type="text" style="width:40px" value="<?=$rs->row["priority"]?>"></td>
		<td><input name="title<?=$rs->row["id_parent"]?>" type="text" style="width:100px" value="<?=$rs->row["name"]?>"></td>
		<td><input name="percentage<?=$rs->row["id_parent"]?>" type="text" style="width:100px" value="<?=$rs->row["percentage"]?>"></td>
		<?if($global_settings["allow_photo"]==1){?>
			<td align="center"><input type="checkbox" name="upload_<?=$rs->row["id_parent"]?>" <?if($rs->row["upload"]==1){echo("checked");}?>></td>
		<?}?>
		<?if($global_settings["allow_video"]==1){?>
			<td align="center"><input type="checkbox" name="upload2_<?=$rs->row["id_parent"]?>" <?if($rs->row["upload2"]==1){echo("checked");}?>></td>
		<?}?>
		<?if($global_settings["allow_audio"]==1){?>
			<td align="center"><input type="checkbox" name="upload3_<?=$rs->row["id_parent"]?>" <?if($rs->row["upload3"]==1){echo("checked");}?>></td>
		<?}?>
		<?if($global_settings["allow_vector"]==1){?>
			<td align="center"><input type="checkbox" name="upload4_<?=$rs->row["id_parent"]?>" <?if($rs->row["upload4"]==1){echo("checked");}?>></td>
		<?}?>
		<td><div class="link_edit"><a href='content.php?id=<?=$rs->row["id_parent"]?>'><?=word_lang("edit")?></a></td>
		<td>
		<div class="link_delete"><a href='delete.php?id=<?=$rs->row["id_parent"]?>'><?=word_lang("delete")?></a></div>
		</td>
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





<? include("../inc/end.php");?>