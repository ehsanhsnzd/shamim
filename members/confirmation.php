<?$site="signup";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>

<h1><?=word_lang("تایید حساب")?></h1>

<?
if (isset($_POST['confirm_sbmt'])){
 $sql2="select confirmation from users where login='".result($_SESSION["login"])."'";
    $dr->open($sql2);
    if(!$dr->eof)
    {
        $confirmation=$dr->row["confirmation"];
    }

	if ($_POST['confirm_code']== $confirmation){

	$sql="update users set accept=1 where login='".result($_SESSION["login"])."'";
	$db->execute($sql);



		$_SESSION['print_user'] = 'ok';
		$_SESSION['print_username'] = $_SESSION["login"];

$sql="select * from users where login='".result2($_SESSION["login"])."'  and accessdenied=0 and authorization='site'";
$rs->open($sql);
	if(!$rs->eof)
	{
				$_SESSION["people_id"]=$rs->row[ "id_parent" ];
				$_SESSION["people_name"]=$rs->row[ "name" ];
				$_SESSION["people_login"]=$rs->row[ "login" ];
				$_SESSION["people_email"]=$rs->row[ "email" ];
				$_SESSION["people_category"]=$rs->row[ "category" ];
				$_SESSION["people_active"]=$id;
				$_SESSION["people_type"]=$rs->row["utype"];
				$_SESSION["people_exam"]=$rs->row["examination"];



				///////////////////////////////////
				setcookie("people_login",$rs->row["login"],time()+60*60*24*30,"/",str_replace("http://","",surl));
				setcookie("people_password",md5($rs->row["password"]),time()+60*60*24*30,"/",str_replace("http://","",surl));

	}



  if(isset($_SESSION["REFERER_URL"]) and preg_match("/checkout/i",$_SESSION["REFERER_URL"]))
        {
          header("location:checkout.php");
          exit();
        }	else{

              header("Location: ../users/");
            die();
        }


		}

		else {


		echo("<p class='error'>".word_lang("serror4")."</p>");


			}
}


 ?>
<div align="center">
کد ارسالی به شماره ( <?=$_SESSION["telephone"]?> ) را برای تایید وارد کنید.
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" name="confirmform">
<input name="confirm_code" type="text" class="ibox" style="width:400px;" required/><br>

<input type="submit" value="ادامه" name="confirm_sbmt" class="isubmit"/>
</form>
</div>







<?include("../inc/footer.php");?>
