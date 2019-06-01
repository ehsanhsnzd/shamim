<?php
	session_start();

	parse_str($_SERVER['QUERY_STRING']);
	if(isset($logout) && $logout == 'true'){

		unset($_SESSION['print_admin']);
	}

if (isset($_POST['username']) && isset($_POST['password'])){

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

	require ('../db_select.php');

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
       $admin_pass_coded = encrypt::encode($password, 'BBmHm!@kbrPAH3641bR00');

				if ($result = $connection->query("SELECT * FROM admin WHERE username = '$username' AND password = '$admin_pass_coded'")) {
    					$row_cnt = $result->num_rows;
    					if($row_cnt ==1  ){
							$_SESSION['print_admin'] = '#$ok*%';
							$_SESSION['print_admin_name']= $username;
							header("Location: ../admin/orders-offset.php");
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
	<title>پنل مدیریت | شمیم</title>
	<link rel="stylesheet" type="text/css" href="../admin/library/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../admin/library/main.js"></script>
</head>
<body>

	<section id="admin-login-page-section">
		<span id="admin-login-page-title">ورود به پنل مدیریت</span>
		<form id="admin-login-page-form" action="login.php" method="post">
			<input type="text" name="username" placeholder="نام کاربری">
			<input type="password" name="password" placeholder="گذرواژه">
			<input type="submit" value="ورود">
		</form>
	</section>

		<p id="admin-login-copyright">کپی رایت © سامانه مدیریت چاپخانه آویتا | طراحی و توسعه: <a href="http://picapixlab.com" id="ppl-footer-style" target="_blank">پیکاپیکس لب</a></p>

</body>
</html>