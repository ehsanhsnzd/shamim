<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){exit;}?>
<? include("../admin/function/upload.php");?>
<?if(userupload==0){exit;}?>
<?


delete_category((int)$_GET["id"],(int)$_SESSION["people_id"]);

$smarty->clear_cache(null,"buildmenu");

header("location:publications.php?d=1");
?>