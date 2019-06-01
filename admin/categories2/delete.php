<? include("../function/db.php");?>
<? include("../function/upload.php");?>
<?
//Check access
admin_panel_access("catalog_categories");


delete_category((int)$_GET["id"],0);

$smarty->clear_cache(null,"buildmenu");

header("location:index.php");
?>