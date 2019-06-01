<?include("../admin/function/db.php");?>
<?
$_SESSION["slang"]=preg_replace('/[^a-z ]/i',"",$_GET["lang"]);

unset($_SESSION["box_shopping_cart"]);
unset($_SESSION["box_shopping_cart_lite"]);

if(isset($_SERVER["HTTP_REFERER"]))
{
	header("location:".$_SERVER["HTTP_REFERER"]);
}
else
{
	header("location:".site_root."/");
}
?>