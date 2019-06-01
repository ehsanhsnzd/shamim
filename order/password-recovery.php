<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | بازیابی گذرواژه</title>
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
					<a href=" /price-list.php"><li>تعرفه ها</li></a>
					<a href=" /guild-files.php"><li>فایل های راهنما</li></a>
					<a href=" /termofservices.php"><li>قوانین و مقررات</li></a>
					<a href=" #order-progress-div"><li>درباره ما</li></a>
					<a href=" /contact-us.php"><li>تماس با ما</li></a>
				</ul>
			</nav>
		</div>
	</header>

    
    
    <?php 
        
        if(isset($_POST['submit']) && isset($_POST['username']) && $_POST['username'] !=''){
            $pr_username = $_POST['username'];
            require('library/jdf.php');
			$pr_today =  jdate('Y-n-j');

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
            
            $pwr_hash=encrypt::encode($pr_username, 'BBepsWrGda23g6294TTe3'.$pr_today);
            
                    $setting_result = mysqli_query($connection, "SELECT * FROM user WHERE username = '$pr_username'");
                    $row = mysqli_fetch_array($setting_result);
                    $pr_email_adress = $row['email'];
            
            if(isset($pr_email_adress) && $pr_email_adress != ''){
                require('../config.php');
                $recovery_set_page_adress = $site_root_adress.'/users/new-password-set.php';
                $message = "کاربر گرامی، یک درخواست بازیابی گذرواژه از طرف شما در وب سایت شمیم داده شده است، اگر این درخواست توسط شما انجام گرفته است، برای ادامه روند تغییر گذرواژه بر روی لینک زیر کلیک کنید در غیر اینصورت، به این پیام توجهی نداشته باشید. توجه داشته باشید که اعتبار لینک زیر فقط تا پایان امروز می باشد. با تشکر، کانون تبلیغاتی و چاپخانه شمیم.<br/>".$recovery_set_page_adress.'?RecoveryCode='.$pwr_hash;
                mail($pr_email_adress, 'درخواست بازیابی گذرواژه | شمیم', $message, 'From: no-reply@shamim14.ir');
                echo "<span class=\"login-alert\">ایمیل خود را برای ادامه ی روند تغییر رمز عبور چک کنید.</span>";
            }
            else{
                echo "<span class=\"login-alert\">نام کاربری ای که وارد کردید، وجود ندارد!</span>";
            }
        }   
    
    
    ?>
    
<div id="user-register-maxwidth">
	<section id="users-register-page-section">
		<span id="users-login-page-title">بازیابی گذرواژه:</span>
		<form id="users-login-page-form" action="password-recovery.php" method="post">
			<input type="text" name="username" placeholder="نام کاربری" required>
			<input type="submit" name="submit" value="بازیابی گذرواژه">
            <br/><a href="login.php" id="users-password-recovery">رفتن به صفحه ی ورود</a>
		</form>
	</section>
</div>

<?php include ("footer.php");?>
