<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | ایجاد گذرواژه جدید</title>
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
        
        parse_str($_SERVER['QUERY_STRING']);
        
        if(!isset($RecoveryCode) || $RecoveryCode ==''){
            echo "به نظر می رسد اشتباهی وارد این صفحه شده اید!";
        }
        if(isset($RecoveryCode) && $RecoveryCode !=''){
            if(isset($_POST['submit']) && isset($_POST['password']) && $_POST['password'] !='' && isset($_POST['repeatpassword']) && $_POST['repeatpassword'] !='' && $_POST['password'] == $_POST['repeatpassword']){
            
                $user_new_pass = $_POST['password'];
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

                 
                $pr_today =  jdate('Y-n-j');
                $en_code_user = encrypt::decode($RecoveryCode, 'BBepsWrGda23g6294TTe3'.$pr_today);

                $user_new_pass_coded = encrypt::encode($user_new_pass, 'GZvazK@(0D!_hoho12%32');
                
                require ('../config.php');
                $connection = mysqli_connect($server_name, $db_username, $db_password);
                    if(!$connection){
                        die("<span class=\"admin-panel-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                    }
                mysqli_select_db($connection, $db_name) or die("<span class=\"admin-panel-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

                $npwd_sql = "UPDATE user SET password = '$user_new_pass_coded' WHERE username = '$en_code_user'";		
                mysqli_query($connection, "SET NAMES 'utf8'");
                mysqli_query($connection, "SET CHARACTER SET 'utf8'");
                mysqli_query($connection, "SET character_set_connection = 'utf8'");
                if ($connection->query($npwd_sql) === TRUE) {
                    echo "<span class=\"edit-done-alert\">گذرواژه جدید ذخیره شد، هم اکنون می توانید از لینک زیر وارد حساب کاربری خود شوید: <a href=\"login.php\">ورود به حساب کاربری</a></span>";
echo $en_code_user;
echo $user_new_pass_coded;
                } else {
                    echo "مشکلی در ثبت گذواژه جدید به وجود آمد، لطفا مجددا تلاش کنید و در صورت بروز مشکل مجدد، با پشتیبانی تماس بگیرید.";
                }


            }
            else{ ?>
    
<div id="user-register-maxwidth">
	<section id="users-register-page-section">
		<span id="users-login-page-title">بازیابی گذرواژه:</span>
		<form id="users-login-page-form" action="new-password-set.php?RecoveryCode=<?php echo $RecoveryCode; ?>" method="post">
			<input type="password" name="password" placeholder="گذرواژه جدید" required>
			<br/><input type="password" name="repeatpassword" placeholder="تکرار گذرواژه جدید" required>
			<br/><input type="submit" name="submit" value="ذخیره">
            <br/>
		</form>
	</section>
</div>
    
            <?php }
        }     
    
    
    ?>
    


<?php include ("footer.php");?>
