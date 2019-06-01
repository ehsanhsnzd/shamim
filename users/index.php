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
				
				
				
             $connection = mysql_connect($server_name, $db_username, $db_password);
             if(!$connection){
                 die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
             }
             mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



             $sql_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$username_value'");
             $sql_username_name_result = mysql_fetch_array($sql_username_name);
             $sql_user_realname = $sql_username_name_result['name']." ".$sql_username_name_result['lastname'];

             $connection = mysqli_connect($server_name, $db_username, $db_password);
             if(!$connection){
                 die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
             }
             mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
             mysqli_query($connection, "SET NAMES 'utf8'");
             mysqli_query($connection, "SET CHARACTER SET 'utf8'");
             mysqli_query($connection, "SET character_set_connection = 'utf8'");

				
				
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
<div><a href="../members/profile_downloads.php" style="color: #fff;">تاریخچه دانلودها</a> </div>
	</div>

<?php include ("sidebar.php");?>


    <section id="main-page-center" class="center">
        <a href="/users/new-order.php?service=32&quantity=1th&lot=1"><div id="main-page-new-order" class="main-page-block">
                <div id="main-page-new-order-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>

        <a href="/users/new-order-graphic.php?quantity=1th&lot=1"><div id="main-page-order-list" class="main-page-block">
                <div id="main-page-order-list-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>


        <a href="../category/12514.html"><div id="main-page-accessories" class="main-page-block">
                <div id="main-page-accessories-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>



    </section>

<?php include ("footer.php");?>