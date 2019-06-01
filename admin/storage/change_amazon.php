<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_storage");


$activ=0;
if(isset($_POST["activ"]))
{
	$activ=1;
}



$sql="update filestorage_amazon set activ=".$activ.",prefix='".result($_POST["prefix"])."',username='".result($_POST["username"])."',api_key='".result($_POST["api_key"])."',region='".result($_POST["region"])."'";
$db->execute($sql);

redirect("index.php?d=4");
?>