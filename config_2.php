<?php

	$server_name = '.ir';
	$db_username = '';
	$db_password = '';
	$db_name = '';



	$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
		mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		$site_adress_sql=mysqli_query($connection, "SELECT * FROM site_settings WHERE id='1'");
		$sa_sql = mysqli_fetch_array($site_adress_sql);
	$site_root_adress = $sa_sql['site_main_adress'];


?>
