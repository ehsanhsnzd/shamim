<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("users_administrators");

$sql="delete from people where id=".(int)$_GET["id"];
$db->execute($sql);

$sql="delete from people_rights where user=".(int)$_GET["id"];
$db->execute($sql);

header("location:index.php");
?>
