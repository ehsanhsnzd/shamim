<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_site");



$sql="select * from settings";
$rs->open($sql);
while(!$rs->eof)
{
	if(isset($_POST["a".$rs->row["id"]]))
	{
		$sql="update settings set svalue='".result($_POST["p".$rs->row["id"]])."',activ=".result($_POST["a".$rs->row["id"]])." where id=".$rs->row["id"];
		$db->execute($sql);
	}
	else
	{	
		if(isset($_POST["p".$rs->row["id"]]))
		{
			$sql="update settings set svalue='".result($_POST["p".$rs->row["id"]])."',activ=0 where id=".$rs->row["id"];
			$db->execute($sql);
		}
	}
	$rs->movenext();
}


header("location:site.php");
?>