<?include("../admin/function/db.php");?>
<?
session_destroy();
header("location:".site_root."/index.php");
?>