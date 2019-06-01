<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_prints");
?>
<? include("../inc/begin.php");?>





<a class="btn btn-success toright" href="content.php"><i class="icon-print icon-white"></i> <?=word_lang("add")?></a>


<h1><?=word_lang("Prints and products")?>:</h1>





<br>

<?
$sql="select id_parent,title,description,price,weight,priority from prints order by priority";
$rs->open($sql);
if(!$rs->eof)
{
	$tr=1;
	?>
	<form method="post" action="change.php">
	<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
	<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:100%">
	<tr>
	<th><b><?=word_lang("priority")?>:</b></th>
	<th><b><?=word_lang("title")?>:</b></th>
	<th><b><?=word_lang("price")?>:</b></th>
	<th><b><?=word_lang("weight")?> (<?=$global_settings["weight"]?>):</b></th>
	<th></th>
	<th></th>
	</tr>
	<?
	while(!$rs->eof)
	{
		?>
		<tr <?if($tr%2==0){echo("class='snd'");}?>>
		<td align="center"><input name="priority<?=$rs->row["id_parent"]?>" type="text" style="width:40px" value="<?=$rs->row["priority"]?>"></td>
		<td><input name="title<?=$rs->row["id_parent"]?>" type="text" style="width:150px" value="<?=$rs->row["title"]?>"></td>
		<td><input name="price<?=$rs->row["id_parent"]?>" type="text" style="width:50px" value="<?=float_opt($rs->row["price"],2)?>"></td>
		<td><input name="weight<?=$rs->row["id_parent"]?>" type="text" style="width:50px" value="<?=$rs->row["weight"]?>"></td>
		<td><div class="link_edit"><a href='content.php?id=<?=$rs->row["id_parent"]?>'><?=word_lang("edit")?></a></td>
		<td><div class="link_delete"><a href='delete.php?id=<?=$rs->row["id_parent"]?>'><?=word_lang("delete")?></a></div></td>
		</tr>
		<?
		$tr++;
		$rs->movenext();
	}
	?>
	<tr  <?if($tr%2==0){echo("class='snd'");}?>>
		<td colspan="6">
			<select name="addto" style="width:300px">
				<option value="0">Not to change OLD prints prices</option>
				<option value="1">Change ALL prints prices</option>
				<option value="2">Synchronize prints</option>
			</select>
		</td>
	</tr>
	</table>
	</div></div></div></div></div></div></div></div>

	
		<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">
			<input type="submit" value="<?=word_lang("change")?>" class="btn btn-primary" style="margin-top:20px">
		</div>
	</div>
	
		</form>
<?
}
?>





<? include("../inc/end.php");?>