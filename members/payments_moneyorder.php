<?$site="moneyorder";$site2="";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<?include("profile_top.php");?>



<?
include("payments_statement.php");
?>







<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>
