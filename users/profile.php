<?php require ("header.php");?>

	<section id="user-panel-sheet">

	<h2 class="user-panel-sheet-h2">پروفایل</h2>

		<?php

	$username_value = $_SESSION['print_username'];


if (isset($_POST['submit'])) {
	$user_display_name = $_POST['display_name'];
	$user_mobile = $_POST['mobile'];	
	$user_adress = $_POST['adress'];
	if (isset($_POST['is_from_tabriz']) && $_POST['is_from_tabriz'] = '1') {
		$user_isfromtabriz = '1';
	}
	elseif (!isset($_POST['is_from_tabriz']) || $_POST['is_from_tabriz'] = '' || $_POST['is_from_tabriz'] = '0' ) {
		$user_isfromtabriz = '0';
	}
	

		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"admin-panel-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
		mysqli_select_db($connection, $db_name) or die("<span class=\"admin-panel-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");


		$sql = "UPDATE user SET display_name = '$user_display_name' , mobile = '$user_mobile' , adress = '$user_adress' , is_from_tabriz = '$user_isfromtabriz' WHERE username = '$username_value'";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql) === TRUE) {
			echo "<span class=\"edit-done-alert\">تغییرات مورد نظر با موفقیت اعمال گردید.</span>";
		} else {
		    echo "مشکلی در ثبت ویرایش های انجام شده در پایگاه داده به وجود آمد.";
		}
}



			require ('../config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
		mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");

		$dbresult=mysqli_query($connection, "SELECT * FROM user WHERE username = '$username_value'");
		
		echo "<form id=\"profile-edit-form\" action=\"profile.php\" method=\"post\">"; 

				$row = mysqli_fetch_array($dbresult);
				$users_table_username= $row['username'];
				$users_table_email= $row['email'];
				$users_table_displayname= $row['display_name'];
				$users_table_mobile= $row['mobile'];
				$users_table_adress= $row['adress'];
				if ($row['is_from_tabriz'] == '1') {
					$users_table_isfromtabriz= 'checked';
				} 
				 else {
					$users_table_isfromtabriz= '';
				}
				$users_table_user_id= $row['user_id'];

			echo "<label>نام کاربری:</label> <span class=\"profile-edit-span\">$users_table_username</span>";
			echo "<label>ایمیل:</label> <span class=\"profile-edit-span\">$users_table_email</span><br/>";			
			echo "<label for=\"edit_user_displayname\">نام:</label><input type=\"text\" name=\"display_name\" id=\"edit_user_displayname\" class=\"profile-edit-input\" placeholder=\"نام و نام خانوادگی\" value=\"$users_table_displayname\">";
			echo "<label for=\"edit_user_mobile\">موبایل:</label><input type=\"number\" name=\"mobile\" id=\"edit_user_mobile\" class=\"profile-edit-input\" placeholder=\"موبایل\" value=\"$users_table_mobile\"><br/>";
			
			echo "<label for=\"edit_user_adress\">آدرس:</label><textarea name=\"adress\" id=\"edit_user_adress\" class=\"profile-edit-textarea\" placeholder=\"آدرس\">$users_table_adress</textarea><br/>";
			echo "<label for=\"edit_user_isfromtabriz\">ساکن تبریز:</label><input type=\"checkbox\" name=\"is_from_tabriz\" id=\"edit_user_isfromtabriz\" $users_table_isfromtabriz><br/>";

			echo "<input type=\"submit\" name=\"submit\" class=\"profile-edit-submit\" value=\"بروز رسانی پروفایل\">";

			echo "</form>";

	mysqli_close($connection);

		?>

		<br/>
		<a href="password-recovery.php" class="profile-editpage-passwordreset">تغییر رمز عبور</a>

	</section>

<?php include ("footer.php");?>
