<?$site="checkout";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>

<h1><?=word_lang("checkout")?></h1>


<?
if(!isset($_SESSION["people_id"]))
{
	include("login_content.php");
}
else
{
	include("checkout_content.php");
}
?>



<?include("../inc/footer.php");?>