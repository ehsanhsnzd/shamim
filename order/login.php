<?php

	session_start();
	parse_str($_SERVER['QUERY_STRING']);
	if(isset($logout) && $logout == 'true'){
		unset($_SESSION['print_user']);
		unset($_SESSION['print_username']);
	}

if (isset($_POST['username']) && isset($_POST['password'])){

	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!isset($username) || $username == ''){
	    echo "<span class=\"login-alert\">فیلد نام کاربری نباید خالی باشد!</span>";
	    $check_error = 1;
	}

	elseif (!isset($password) || $password == ''){
	    echo "<span class=\"login-alert\">فیلد کلمه عبور نباید خالی باشد!</span>";
	    $check_error = 1;
	}

		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}

	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

                class encrypt {
                    /********* Encode *********/
                    public static function encode($pure_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))), utf8_encode(trim($pure_string)), MCRYPT_MODE_ECB, $iv);
                        return base64_encode($encrypted_string);
                    }

                    /********** Decode ************ */
                    public static function decode($encrypted_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))),base64_decode(trim($encrypted_string)), MCRYPT_MODE_ECB, $iv);
                        return $decrypted_string;
                    }
                }

                $pass_coded = encrypt::encode($password, 'GZvazK@(0D!_hoho12%32');

				if ($result = $connection->query("SELECT * FROM user WHERE username = '$username' AND password = '$pass_coded'")) {
    					$row_cnt = $result->num_rows;
    					if($row_cnt == 1){
				    		$_SESSION['print_user'] = 'ok';
					     	$_SESSION['print_username'] = $username;
							
							
							
		$invoice=$_SESSION['invoice']  ;
		mysqli_query($connection,"update invoices set username='$username' where invoice_code=$invoice");
		mysqli_query($connection,"update orders set order_user='$username' where invoice_code=$invoice");
							
					    	header("Location: ../users/index.php");
					    	die();
    					}
			     	else {
				    	echo "<span class=\"login-alert\">رمز عبور اشتباه است</span>";
			     	}
			     }

	mysqli_close($connection);
}
?>


<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | ورود به پنل کاربری</title>
	<link rel="stylesheet" type="text/css" href="../library/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

	<header>
		<div class="header-maxwidth"><img src="../library/images/logo2.jpg" >
		  <nav>
		  <ul>
					<a href="/"><li>صفحه نخست</li></a>
					<a href="/about-us.php"><li>درباره ما</li></a>
					<a href="/contact-us.php"><li>تماس با ما</li></a> 
                      


             
          <a href="/termofservices.php"><li>قوانین و مقررات</li></a>  
          <a href="/report.php"><li>  ثبت شکایات</li></a>
       
			<li style="width:100px"></li>
				</ul>
			  <div class="header-buttons"><a href=" /users/login.php"><button class="login-button">ورود</button></a><a href="members/signup.php"><button class="register-button">ثبت نام</button></a></div>
			</nav>
		</div>
	</header>

    
    
<div id="user-login-maxwidth">
	<section id="users-login-page-section">
		<span id="users-login-page-title">ورود به پنل کاربری:</span>
		<form id="users-login-page-form" action="login.php" method="post">
			<input type="text" name="username" placeholder="نام کاربری">
			<input type="password" name="password" placeholder="گذرواژه">
			<input type="submit" value="ورود">
		</form>
		<a href="password-recovery.php" id="users-password-recovery">بازیابی رمز عبور</a>
	</section>
    
    
	<section id="users-login-page-section">
		<span id="users-login-page-title">ثبت نام در شمیم:</span><p>
		اگر تا کنون عضو وب سایت شمیم نشده اید، همین الان ثبت نام کنید تا از خدمات سایت استفاده کنید. پروسه ثبت نام حدود یک دقیقه طول می کشد. </p><a href="../members/signup.php" id="users-password-recovery">ثبت نام در شمیم</a>
	</section>
</div>


<?php include ("footer.php");?>