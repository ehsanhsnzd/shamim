<?
//Check access
admin_panel_access("settings_video");


?>
<form method="post" action="rendering_add.php" style="margin-bottom:20px">
<input name="new" type="text" value="" style="width:200px">&nbsp;<input type="submit" class="btn" value="<?=word_lang("add")?>">
</form>



<?
//������� ��������
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}

//���������� �������� �� ��������
$kolvo=k_str;


//���������� ������� �� ��������
$kolvo2=k_str2;
?>










<?
$tr=1;
$n=0;
$sql="select * from video_rendering order by name";
$rs->open($sql);
if(!$rs->eof)
{
?>
<form method="post" action="rendering_delete.php">
<div class="table_t"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin">
<tr>
<th><b><?=word_lang("name")?>:</b></th>
<th><b><?=word_lang("delete")?>:</b></th>

</tr>
<?
while(!$rs->eof)
{
if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>


<td><input type="text" name="title<?=$rs->row["id"]?>" value="<?=$rs->row["name"]?>" style="width:250px"></td>


<td><input type="checkbox" id="m<?=$rs->row["id"]?>" name="m<?=$rs->row["id"]?>" value="1"></td>
</tr>

<?
}
$tr++;
$n++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>

<input type="submit" class="btn btn-primary" value="<?=word_lang("save")?>" style="margin:10px 0px 0px 6px"></form>

<?
echo(paging2($n,$str,$kolvo,$kolvo2,"index.php","&d=3"));
}
else
{
echo("<b>".word_lang("not found")."</b>");
}
?>
