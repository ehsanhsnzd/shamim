<? include("../function/db.php");?>
<?
//Check captcha
require_once('../function/recaptchalib.php');
$flag_captcha=check_captcha();

if($flag_captcha)
{
	$sql="select * from people where login='".result($_POST["login"])."' and password='".md5(result($_POST["password"]))."'";
	$rs->open( $sql );
	if(!$rs->eof)
	{
		$_SESSION["user_id"]=$rs->row[ "id" ];
		$_SESSION["user_name"]=$rs->row[ "name" ];
		$_SESSION["user_login"]=$rs->row[ "login" ];
		$_SESSION["entry_admin"]=1;

		$sql="insert into people_access (user,accessdate,ip) values (".$rs->row[ "id" ].",".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_SERVER["REMOTE_ADDR"])."')";
		$db->execute($sql);
		
		//Rights
		$sql="select user_rights from people_rights where user=".$rs->row["id"];
		$ds->open($sql);
		while(!$ds->eof)
		{
			$_SESSION["rights"][$ds->row["user_rights"]]=1;
			$ds->movenext();
		}

		redirect("../content/");
	}
	else
	{
		redirect("fullaccess.php?d=1");
	}
}
else
{
	redirect("fullaccess.php?d=2");
}
?>