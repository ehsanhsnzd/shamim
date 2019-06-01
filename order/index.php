<?php require ("header.php");?>

	<div id="user-panel-main-page-header">
		<section>
			<?php
	require ('../config.php');

	$connection = mysqli_connect($server_name, $db_username, $db_password);
		if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");


				$username_value = $_SESSION['print_username'];
				$sql_username_name = mysqli_query($connection, "SELECT display_name FROM user WHERE username='$username_value'");
				$sql_username_name_result = mysqli_fetch_array($sql_username_name);
				$sql_user_realname = $sql_username_name_result['display_name'];
				if(isset($sql_user_realname) && $sql_user_realname != ''){
					echo $sql_user_realname." گرامی، خوش آمدید.<br/>";
				}
				else{
				echo $username_value." گرامی، خوش آمدید.<br/>";
				}
 
				$date_now = jdate('l, j F Y');
				echo "<span class=\"small-text\">امروز ".$date_now;
				$time_now = jdate('H:i');
				echo " - ساعت ".$time_now."</span>";



			?>
		</section>
	</div>

<?php include ("sidebar.php");?>

<section id="main-page-center">
	<a href="new-order.php?service=32&quantity=1th&lot=1"><div id="main-page-new-order" class="main-page-block">
		<div id="main-page-new-order-img"></div>
		<h2>ثبت سفارش جدید</h2>
	</div></a>
	<a href="orders.php"><div id="main-page-order-list" class="main-page-block">
		<div id="main-page-order-list-img"></div>
		<h2>لیست سفارشات</h2>
	</div></a>
	<a href="financial.php"><div id="main-page-invoice" class="main-page-block">
		<div id="main-page-invoice-img"></div>
		<h2>لیست فاکتور ها</h2>
	</div></a>
	<a href="profile.php"><div id="main-page-profile" class="main-page-block">
		<div id="main-page-profile-img"></div>
		<h2>مشاهده و ویرایش پروفایل</h2>
	</div></a>
</section>

<?php include ("footer.php");?>