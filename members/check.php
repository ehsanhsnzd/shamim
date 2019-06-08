<?include("../admin/function/db.php");?>



<?

	session_start();








				/////////////////////////////////////



	$username = $_POST['l'];
	$password = $_POST['p'];

	if (!isset($username) || $username == ''){
	    echo "<span class=\"login-alert\">فیلد نام کاربری نباید خالی باشد!</span>";
	    $check_error = 1;
	}

	elseif (!isset($password) || $password == ''){
	    echo "<span class=\"login-alert\">فیلد کلمه عبور نباید خالی باشد!</span>";
	    $check_error = 1;
	}



                $pass_coded = md5($password);















$sql="select * from users where login='".result2($_POST["l"])."' and password='".md5(result2($_POST["p"]))."' and accessdenied=0 and authorization='site'";
$rs->open($sql);
	if(!$rs->eof)
	{
	$sql="delete from users_login_failed where data<".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-3600);
	$db->execute($sql);

	$sql="delete from users_access where data<".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-3600);
	$db->execute($sql);

	$sql="select ip from users_ip_blocked where ip='".result($_SERVER["REMOTE_ADDR"])."'";
	$dn->open($sql);
		if($dn->eof)
		{
			$sql="select distinct(ip) from users_access where user=".$rs->row["id_parent"]." and data<".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))." and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-300)."";
			$dr->open($sql);
			if($dr->rc<5)
			{
				$sql="insert into users_access (user,data,ip,bandwidth) values(".$rs->row["id_parent"].",".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_SERVER["REMOTE_ADDR"])."',0)";
				$db->execute($sql);

				$sql="select user,id from users_access where user=".$rs->row["id_parent"]." order by id desc";
				$ds->open($sql);
				$id=$ds->row['id'];


				$_SESSION["people_id"]=$rs->row[ "id_parent" ];
				$_SESSION["people_name"]=$rs->row[ "name" ];
				$_SESSION["people_last_name"]=$rs->row[ "last_name" ];
				$_SESSION["people_login"]=$rs->row[ "login" ];
				$_SESSION["people_email"]=$rs->row[ "email" ];
				$_SESSION["people_category"]=$rs->row[ "category" ];
				$_SESSION["people_active"]=$id;
				$_SESSION["people_type"]=$rs->row["utype"];
				$_SESSION["people_exam"]=$rs->row["examination"];
				$_SESSION['print_user'] = 'ok';
				$_SESSION['print_username'] = $rs->row[ "login" ];


				///////////////////////////////////
				setcookie("people_login",$rs->row["login"],time()+60*60*24*30,"/",str_replace("http://","",surl));
				setcookie("people_password",md5($rs->row["password"]),time()+60*60*24*30,"/",str_replace("http://","",surl));






			//	if($_SESSION["people_type"]=="buyer" or $_SESSION["people_type"]=="common")
			//	{


				//		header("location:profile_home.php");
				//		exit();

			//	}
			//	if($_SESSION["people_type"]=="seller" or $_SESSION["people_type"]=="affiliate")
			//	{
				//	header("location:profile_home.php");
				//	exit();
		//		}


		if(isset($_SERVER["HTTP_REFERER"]) and preg_match("/checkout/i",$_SERVER["HTTP_REFERER"]))
					{
						header("location:checkout.php");
						exit();
					}	else{

					    	header("Location: ../users/index.php");
							die();
					}







			}
			else
			{
				$sql="update users set accessdenied=1 where id_parent=".$rs->row["id_parent"];
				$db->execute($sql);

				Header("location: login.php?d=3");
				exit();
			}

		}
		else
		{
			Header("location: login.php?d=3");
			exit();

		}
	}
	else
	{
		$sql="insert into users_login_failed (login,password,data,ip) values('".result2($_POST["l"])."','".md5(result2($_POST["p"]))."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_SERVER["REMOTE_ADDR"])."')";
		$db->execute($sql);

		$sql="select ip,data from users_login_failed where ip='".result($_SERVER["REMOTE_ADDR"])."' and data<".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))." and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-300);
		$ds->open($sql);
			if($ds->rc>4)
				{
					$sql="insert into users_ip_blocked (data,ip) values(".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_SERVER["REMOTE_ADDR"])."')";
					$db->execute($sql);


					$sql="select login,name,email from users where login='".result2($_POST["l"])."'";
					$dn->open($sql);
					if(!$dn->eof)
					{
					$newpassword=create_password();

					send_notification('fraud_to_user',$newpassword,$dn->row["email"],$dn->row["name"]);

					$sql="update users set password='".md5($newpassword)."' where login='".result2($_POST["l"])."'";
					$db->execute($sql);

					}


					Header("location: login.php?d=2");
					exit();
				}
				else
				{
				Header("location: login.php?d=1");
				exit();
				}
	}


?>

