<? include("../function/db.php");?>
<? include("../function/upload.php");?>
<?
//Check access
admin_panel_access("settings_models");

model_delete((int)$_GET["id"],"");



header("location:index.php");
?>