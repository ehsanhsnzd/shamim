<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_storage");


$activ=0;
if(isset($_POST["activ"]))
{
	$activ=1;
}



$sql="update filestorage_rackspace set activ=".$activ.",prefix='".result($_POST["prefix"])."',username='".result($_POST["username"])."',api_key='".result($_POST["api_key"])."'";
$db->execute($sql);

$_SESSION["site_rackspace"]=$activ;		
$_SESSION["site_rackspace_prefix"]=result($_POST["prefix"]);
$_SESSION["site_rackspace_username"]=result($_POST["username"]);
$_SESSION["site_rackspace_api_key"]=result($_POST["api_key"]);

redirect("index.php?d=3");
?>