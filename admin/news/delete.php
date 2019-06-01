<? include("../function/db.php");?>
<? include("../function/upload.php");?>
<?
//Check access
admin_panel_access("pages_news");

$sql="delete from news where id_parent=".(int)$_GET["id"];
$db->execute($sql);



header("location:index.php");
?>