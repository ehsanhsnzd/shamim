<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_taxes");



$sql="select * from tax order by title";
$rs->open($sql);
while(!$rs->eof)
{

	$enabled=0;
	if(isset($_POST["enabled".$rs->row["id"]])){$enabled=1;}
	
	$price_include=0;
	if(isset($_POST["price_include".$rs->row["id"]])){$price_include=1;}

	$sql="update tax set enabled=".$enabled.",title='".result($_POST["title".$rs->row["id"]])."',rates_depend=".(int)$_POST["rates_depend".$rs->row["id"]].",price_include=".$price_include.",rate_all=".(float)$_POST["rate_all".$rs->row["id"]].",rate_all_type=".(int)$_POST["rate_all_type".$rs->row["id"]]." where id=".$rs->row["id"];
	$db->execute($sql);
	
	$rs->movenext();
}


header("location:index.php");
?>