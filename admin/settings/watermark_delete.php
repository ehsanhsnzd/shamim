<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_watermark");



$sql="update watermark set photo=''";
$db->execute($sql);



header("location:watermark.php");


?>