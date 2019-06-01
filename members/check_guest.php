<?include("../admin/function/db.php");?>
<?
$_SESSION["guest_email"]=result($_POST["guest_email"]);

//Check captcha
require_once('../admin/function/recaptchalib.php');
$flag_captcha=check_captcha();
		
if($flag_captcha)
{
	//Check email
	$sql="select id_parent from users where email='".result($_POST["guest_email"])."'";
	$rs->open($sql);
	if(!$rs->eof)
	{
		header("location:checkout.php?error=email");
		exit();
	}
	else
	{
		$aff=0;
		if(isset($_COOKIE["aff"]))
		{
			$aff=(int)$_COOKIE["aff"];
		}
	
		$password=create_password();
	
		$sql="insert into users (login,password,name,country,telephone,address,email,data1,ip,accessdenied,lastname,city,state,zipcode,category,website,utype,company,newsletter,examination,authorization,aff_commission_buyer,aff_commission_seller,aff_visits,aff_signups,aff_referal) values ('guest_temp','".md5($password)."','Guest','United States','','','".result($_POST["guest_email"])."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_SERVER["REMOTE_ADDR"])."',0,'Guest','','','','".userstatus."','','buyer','',0,1,'site',".$affiliate_buyer_commission.",".$affiliate_seller_commission.",0,0,".$aff.")";
		$db->execute($sql);
		
		$sql="select id_parent from users where email='".$_POST["guest_email"]."'";
		$ds->open($sql);
		if(!$ds->eof)
		{
			$sql="update users set login='guest".$ds->row["id_parent"]."' where id_parent=".$ds->row["id_parent"];
			$db->execute($sql);
			
			if(isset($_COOKIE["aff"]))
			{
				affiliate_add($aff,$ds->row["id_parent"],"buyer");
			}
			
			send_notification('signup_guest',"guest".$ds->row["id_parent"],$password);
			send_notification('signup_to_admin',$ds->row["id_parent"]);
			
			//insert the coupon for new user
			coupons_add("guest".$ds->row["id_parent"],"New Signup");
			
			//Auto login
			$_SESSION["people_id"]=$ds->row["id_parent"];
			$_SESSION["people_name"]="Guest";
			$_SESSION["people_login"]="guest".$ds->row["id_parent"];
			$_SESSION["people_email"]=result($_POST["guest_email"]);
			$_SESSION["people_category"]=userstatus;
			$_SESSION["people_active"]=$ds->row["id_parent"];
			$_SESSION["people_type"]="buyer";
			$_SESSION["people_exam"]=1;
			
			//setcookie("people_login","guest".$ds->row["id_parent"],time()+60*60*24*30,"/",str_replace("http://","",surl));
			//setcookie("people_password",md5($password),time()+60*60*24*30,"/",str_replace("http://","",surl));
		}
		
		header("location:checkout.php");
		exit();
	}
}
else
{
	header("location:checkout.php?error=captcha");
	exit();
}

?>