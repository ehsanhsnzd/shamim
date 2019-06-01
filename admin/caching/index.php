<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("templates_caching");
?>
<? include("../inc/begin.php");?>


<h1><?=word_lang("caching")?>:</h1>

<p>
We use a Smarty caching system which allows the script to decrease server's loading. The templates are generated one time, saved and later used without the repeat requests to the database and server.</p>
<p>
You can set time of automatic cache file's refresh or prohibit caching at all (it is useful if you work on the templates and don't want to click "Refresh" every time after you change a template's file).</p>



<p>
<a class="btn btn-danger" href="refresh.php?id=0"><i class="icon-refresh icon-white"></i> <?=word_lang("refresh all files")?></a>
</p>

<?
$sql="select * from caching";
$rs->open($sql);
if(!$rs->eof)
{
?>
	<form method="post" action="change.php" style="margin-top:25px">
	<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
	<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:100%">
	<tr>
	<th><b><?=word_lang("enabled")?></b></th>
	<th><b><?=word_lang("title")?></b></th>
	<th><b><?=word_lang("refresh every X hours")?></b></th>
	<th><b><?=word_lang("refresh")?></b></th>
	</tr>
	<?
	$tr=1;
	while(!$rs->eof)
	{
		?>
		<tr <?if($tr%2==0){echo("class='snd'");}?>>
		<td align="center"><input name="ch<?=$rs->row["id"]?>" type="checkbox" <?if($rs->row["time_refresh"]>=0){echo("checked");}?>></td>
		<td><?=$rs->row["title"]?></td>
		<td><input name="time_refresh<?=$rs->row["id"]?>" type="text" value="<?if($rs->row["time_refresh"]>=0){echo($rs->row["time_refresh"]);}else{echo(0);}?>" style="width:80"></td>
		<td><div class="link_delete"><a href="refresh.php?id=<?=$rs->row["id"]?>"><?=word_lang("refresh now")?></a></div></td>
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

<p>You should set <b>0</b> if you want to disable an automatic refresh.</p>






<? include("../inc/end.php");?>