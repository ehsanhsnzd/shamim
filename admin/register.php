<?php
	session_start();
 


  require ("header.php");

include_once('library/jdf.php'); ?>

<?php include ("sidebar.php"); 




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


	



	if (($result_exist_username != 0) ){
		echo "<span class=\"login-alert\">خطا: نام کاربری یا گذرواژه تکراری است.</span>";
		echo "<span class=\"login-alert\">در صورتی که قبلا ثبت نام کرده اید و رمز عبور خود را فراموش کرده اید به <a href=\"#\">صفحه بازیابی رمز عبور</a>مراجعه کنید.</span>";
	}
	elseif (!isset($username) || $username == ''){
	    echo "<span class=\"login-alert\">فیلد نام کاربری نباید خالی باشد!</span>";
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

		$sql = "INSERT INTO user (username, email, password,mobile)
		VALUES ('$username', '$email', '$pass_coded','$user_mobile')";

		if ($connection->query($sql) === TRUE) {
			
			
			$_SESSION['print_user'] = '#$ok*%';
		$_SESSION['print_admin_name'] = $username;
	
                                    
                                  mail ( $email , "ثبت نام شما در شمیم تکمیل شد" , "با سلام، کاربر گرامی، ثبت نام شما در وب سایت شمیم تکمیل شد. از هم اکنون می توانید با استفاده از نام کاربری و گذرواژه خود وارد حساب کاربری خود شده و سفارشات خود را ارسال فرمایید. با احترام، کانون تبلیغات و چاپخانه شمیم | info@shamim14.ir" , "from:no-reply@shamim14.ir" );
                                
			header("Location: /");
			
			?>
			 <script> location.replace("../users/"); </script><?
	//		die();
		} else {
		    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}

 
//header("Location: ../users/");	
	mysqli_close($connection); 

}

?>
 

    
    
<div id="user-register-maxwidth">
	<section id="users-register-page-section">
		<span id="users-login-page-title">ایجاد حساب کاربری:</span>
		<form id="users-login-page-form" action="register.php" method="post">
			<input type="text" name="username" placeholder="نام کاربری" required>
			<input type="email" name="email" placeholder="آدرس ایمیل" >
            
    <input type="text" placeholder="موبایل"  name="mobile"   required> 
			<input type="password" name="password" placeholder="گذرواژه 6 واژه" required>
			<input type="password" name="confirm_password" placeholder="تکرار گذرواژه" required>
			<input type="submit" name="submit" value="ثبت نام">
            <br/> 
		</form>
	</section>
</div>
    


	<?  include ("footer.php"); ?>