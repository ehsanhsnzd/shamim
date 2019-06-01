<?include("../admin/function/db.php");?>
<?

//Check captcha
require_once('../admin/function/recaptchalib.php');
$flag=check_captcha();

if($flag)
{
	$sql="insert into support (name,email,telephone,method,question,data) values ('".result2($_POST["name"])."','".result2($_POST["email"])."','".result2($_POST["telephone"])."','".result2($_POST["method"])."','".result2($_POST["question"])."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).")";
	$db->execute($sql);

	send_notification('contacts_to_admin');
	send_notification('contacts_to_user');

	Header("location:thanks.php");
}
else
{
	Header("location:index.php?d=1");
}















?>