<?$site="member";
include("../admin/function/db.php");?>
 
<?include("../inc/header.php");?>

<h1><?=word_lang("member area")?></h1>


<?
if(isset($_GET["d"]))
{
	if($_GET["d"]==1)
	{
		echo("<p class='error'> خطا. نام کاربری اشتباه است. </p>");
	}
	if($_GET["d"]==2)
	{
		echo("<p class='error'> خطا. شما دفعات زیادی اطلاعات را وارد کردید. لطفا ایمیل خود را چک کنید.</p>");
	}
	if($_GET["d"]==3)
	{
		echo("<p class='error'>  خطا. آی پی شما بلاک شده. با پشتیبانی تماس بگیرید </p>");
	}
}
?>

<?include("login_content.php");?>


<?include("../inc/footer.php");?>