<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_signup");


$sql="update users_signup set param=".(int)$_POST["param"];
$db->execute($sql);




header("location:index.php");
?>