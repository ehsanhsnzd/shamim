<??>
<?
if($id_parent!=5)
{
	$sql="select name from structure where id=".(int)$id_parent." and module_table<>34";
	$rs->open($sql);
	if(!$rs->eof)
	{
		?>
			<h1 style="margin-bottom:7px;margin-top:0"><?=$rs->row["name"]?></h1>
		<?
	}
}
?>
