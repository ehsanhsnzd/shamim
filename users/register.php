<?php
	session_start();
	if (isset($_SESSION['print_users'])){
		if($_SESSION['print_user'] == 'ok'){
			header("location: ../users/index.php");
		}
	}

if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
			$user_mobile = $_POST['mobile'];	
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];


		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
		
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
		mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");


	$query = mysqli_query($connection, "SELECT username FROM user WHERE username = '".$username."'");
	if (!$query){
		echo("Error description: " . mysqli_error($connection));
	}
	$result_exist_username = mysqli_num_rows($query);


	$query = mysqli_query($connection, "SELECT email FROM user WHERE email = '".$email."'");
	if (!$query){
		echo("Error description: " . mysqli_error($connection));
	}
	$result_exist_email = mysqli_num_rows($query);



	if (($result_exist_username != 0) && ($result_exist_email != 0)){
		echo "<span class=\"login-alert\">خطا: نام کاربری یا ایمیل تکراری است.</span>";
		echo "<span class=\"login-alert\">در صورتی که قبلا ثبت نام کرده اید و رمز عبور خود را فراموش کرده اید به <a href=\"#\">صفحه بازیابی رمز عبور</a>مراجعه کنید.</span>";
	}
	elseif (!isset($username) || $username == ''){
	    echo "<span class=\"login-alert\">فیلد نام کاربری نباید خالی باشد!</span>";
	}
	elseif (!isset($email) || $email == ''){
	    echo "<span class=\"login-alert\">فیلد آدرس ایمیل نباید خالی باشد!</span>";
	}
	elseif (!isset($password) || $password == ''){
	    echo "<span class=\"login-alert\">فیلد کلمه عبور نباید خالی باشد!</span>";
	}
	elseif (!isset($confirm_password) || $confirm_password == '' || $confirm_password !== $password){
	    echo "<span class=\"login-alert\">فیلد تکرار گذرواژه خالی مانده و یا اشتباه است!</span>";
	}
	else{
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

		$sql = "INSERT INTO user (username, email, password,mobile,accept)
		VALUES ('$username', '$email', '$pass_coded','$user_mobile',1)";

		if ($connection->query($sql) === TRUE) {
			
			
			$_SESSION['print_user'] = 'ok';
		$_SESSION['print_username'] = $username;
		$invoice=$_SESSION['invoice']  ;
		mysqli_query($connection,"update invoices set username='$username' where invoice_code=$invoice");
		mysqli_query($connection,"update orders set order_user='$username' where order_id=$invoice");

                                    
                                  mail ( $email , "ثبت نام شما در شمیم تکمیل شد" , "با سلام، کاربر گرامی، ثبت نام شما در وب سایت شمیم تکمیل شد. از هم اکنون می توانید با استفاده از نام کاربری و گذرواژه خود وارد حساب کاربری خود شده و سفارشات خود را ارسال فرمایید. با احترام، کانون تبلیغات و چاپخانه شمیم | info@shamim14.ir" , "from:no-reply@shamimbanner.ir" );
                                
			header("Location: ../users/");
			die();
		} else {
		    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}


 
	
	
 
			
			$_SESSION['print_user'] = 'ok';
		$_SESSION['print_username'] = $username; 

	mysqli_close($connection); 

}

?>


<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | ثبت نام کاربر جدید</title>
	<link rel="stylesheet" type="text/css" href="../library/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

	<header>
		<div class="header-maxwidth"> <?php require('../config.php'); ?>
			<a href=" "><img src="../library/images/logo.png"></a>
			<nav>
				<ul>
					<a href=" "><li>صفحه نخست</li></a>
					<a href=" #order-progress-div"><li>درباره ما</li></a>
					<a href=" /contactus.php"><li>تماس با ما</li></a>
				</ul>
			</nav>
		</div>
	</header>

    
    
<div id="user-register-maxwidth">
	<section id="users-register-page-section">
		<span id="users-login-page-title">ایجاد حساب کاربری:</span>
		<form id="users-login-page-form" action="../members/signup.php" method="post">
			<input type="text" name="username" placeholder="نام کاربری" required>
			<input type="email" name="email" placeholder="آدرس ایمیل" required>
            
    <input type="text" placeholder="موبایل"  name="mobile"   required> 
			<input type="password" name="password" placeholder="گذرواژه 6 واژه" required>
			<input type="password" name="confirm_password" placeholder="تکرار گذرواژه" required>
			<input type="submit" name="submit" value="ثبت نام">
            <br/><a href="login.php" id="users-password-recovery">رفتن به صفحه ی ورود</a>
		</form>
	</section>
</div>
    


		<footer>
		<div id="footer-top-section">
			<div id="footer-max-width">
				<aside id="footer-quick-access">
					<h3>دسترسی سریع</h3>
					<ul>                        <?php require('../config.php'); ?>

                        <li><a href=" ">صفحه نخست</a></li>
                        <li><a href=" /price-list.php">تعرفه خدمات</a></li>
                        <li><a href=" /guild-files.php">فایل های راهنما</a></li>
                        <li><a href=" /faq.php">سوالات متداول</a></li>
                        <li><a href=" /termofservices.php">قوانین و مقررات</a></li>
                        <li><a href=" /contact-us.php">تماس با ما</a></li>
					</ul>
				</aside>

				<aside id="footer-panel-links">
					<h3>پنل کاربران</h3>
					<ul>
						<li><a href=" /users">صفحه نخست پنل کاربری</a></li>
						<li><a href=" /users/login.php">ورود به پنل کاربری</a></li>
						<li><a href="members/signup.php">ثبت نام در پنل کاربران</a></li>
						<li><a href=" /users/password-recovery.php">بازیابی گذرواژه فراموش شده</a></li>
						<li><a href=" /guild-files.php">راهنمای استفاده از پنل کاربری</a></li>
					</ul>
				</aside>

				<aside id="footer-contact-form">
					<h3>تماس با ما</h3>
					<form id="footer-contact-form" action="users/contact-form-confirm.php?url=<?php $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";echo($fullurl); ?>" method="post">
						<input type="text" name="name" placeholder="نام و نام خانوادگی*" required>
						<input type="email" name="email" placeholder="آدرس ایمیل*" required>
						<input type="text" name="subject" placeholder="موضوع پیام*" requird>
						<textarea name="message" id="message" placeholder="متن پیام...*" required></textarea>
						<input type="submit" name="submit" value="ارسال پیام">
					</form>
				</aside>

				<aside id="footer-contact-info">
					<h3>مشخصات تماس</h3>
					<p>
   					آدرس: تبریز - میدان ساعت، روبروی پاساژ بهارستان، کوچه شهید ختایی           
						<hr/>
						تلفن: 335577927-041<br/>
						ایمیل: info@shamim14.ir
					</p>
				</aside>
			</div>
		</div>
		<div id="footer-bottom-section">
			<div id="footer-bottom-max-width">
                <div id="footer-bottom-right">		
                    <div>کپی رایت 1395| تمامی حقوق متعلق به کانون تبلیغاتی و چاپخانه شمیم<br/><a href="http://picapixlab.com/" title="طراحی سایت">طراحی و توسعه</a>: <a href="http://picapixlab.com/" title="طراحی وب سایت">پیکاپیکس لب</a></div>
                </div>
                <div id="footer-bottom-left">
                    <a href=" "><img src="library/images/logo.png"></a>
                </div>
            </div>
		</div>
	</footer>


</html>