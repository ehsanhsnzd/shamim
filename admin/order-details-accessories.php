<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">جزئیات سفارش</h2>


        <?php

	require ('../db_select.php');

	$username_value = $_SESSION['print_admin_name'];
	parse_str($_SERVER['QUERY_STRING']);

	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id = '$orderID'");


				$sql_od = mysqli_fetch_array($sql_order_details);

					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_size = $sql_od['order_size'];
					$sql_od_quantity = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];
					$sql_od_lot_quantity = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = jdate('Y/m/d h:i a',strtotime($sql_od['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_od_promise_date = jdate('Y/m/d h:i a',strtotime($sql_od['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_od_user = $sql_od['order_user'];

        $connection = mysql_connect($server_name, $db_username, $db_password);
        if(!$connection){
            die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        }
        mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



        $sql_od_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$sql_od_user'");
        $sql_od_username_name_result = mysql_fetch_array($sql_od_username_name);
        $sql_od_user_realname = $sql_od_username_name_result['name']." ".$sql_od_username_name_result['lastname'];

        $connection = mysqli_connect($server_name, $db_username, $db_password);
        if(!$connection){
            die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        }
        mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        mysqli_query($connection, "SET NAMES 'utf8'");
        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
        mysqli_query($connection, "SET character_set_connection = 'utf8'");


if ($_SESSION['print_admin_name']=='support'){

mysqli_query($connection, "UPDATE orders3 set read_m=1 WHERE order_id = $orderID");}

					$sql_od_width = $sql_od['order_width'];
					if ($sql_od_width == '') {
						$sql_od_width = '-';
					}
					$sql_od_height = $sql_od['order_height'];
					if ($sql_od_height == '') {
						$sql_od_height = '-';
					}

					$sql_od_duration = $sql_od['order_duration'];
					$sql_od_invoice_code = $sql_od['order_invoice_code'];
					$sql_od_bijak_code = $sql_od['order_bijak_code'];
					$sql_od_print_permission = $sql_od['order_print_permission'];
					$sql_od_delivery_permission = $sql_od['order_delivery_permission'];
					$sql_od_last_status = $sql_od['order_last_status'];
					$sql_od_description = $sql_od['order_description'];
					if (!isset($sql_od_description) || $sql_od_description == '') {
						$sql_od_description = '-';
					}
					$sql_od_file1 = $sql_od['order_file1'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){
						$sql_od_file1_view = "<img src=\"".$site_root_adress.$sql_od_file1."\">";
					}
					else{
						$sql_od_file1_view = '';
					}
					$sql_od_file2 = $sql_od['order_file2'];
					if(isset($sql_od_file2) && $sql_od_file2 != ''){
						$sql_od_file2_view = "<img src=\"".$site_root_adress.$sql_od_file2."\">";
					}
					else{
						$sql_od_file2_view = '';
					}
					$sql_od_file3 = $sql_od['order_file3'];
					if(isset($sql_od_file3) && $sql_od_file3 != ''){
						$sql_od_file3_view = "<img src=\"".$site_root_adress.$sql_od_file3."\">";
					}
					else{
						$sql_od_file3_view = '';
					}
					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
						$sql_od_file4_view = "<img src=\"".$site_root_adress.$sql_od_file4."\">";
					}
					else{
						$sql_od_file4_view = '';
					}


					if ($sql_od_print_permission == '0') {
						$sql_od_pp = 'خیر';
					}
					elseif ($sql_od_print_permission == '1') {
						$sql_od_pp = 'بله';
					}
					else{
						$sql_od_pp = '';
					}

					if ($sql_od_delivery_permission == '0') {
						$sql_od_dp = 'خیر';
					}
					elseif ($sql_od_delivery_permission == '1') {
						$sql_od_dp = 'بله';
					}
					else{
						$sql_od_dp = '';
					}

					if ($sql_od_last_status == '0') {
						$sql_od_ls = 'در انتظار پرداخت فاکتور';
					}
					elseif ($sql_od_last_status == '1') {
						$sql_od_ls = 'در انتظار بررسی';
					}
					elseif ($sql_od_last_status == '2') {
						$sql_od_ls = 'پروسه چاپ';
					}
					elseif ($sql_od_last_status == '3') {
						$sql_od_ls = 'آماده تحویل';
					}
					elseif ($sql_od_last_status == '4') {
						$sql_od_ls = 'تحویل داده شده';
					}
					else{
						$sql_od_ls = 'وضعیت نامشخص';
					}
					if (!isset($sql_od_bijak_code)) {
						$sql_od_bijak_code= '-';
					}

					$sql_od_make_format = $sql_od['order_make_format'];
					if ($sql_od_make_format == '1') {
						$sql_od_make_format = '-قالب سازی';
					}
					else{
						$sql_od_make_format = '';
					}

					$sql_od_make_line = $sql_od['order_make_line'];
					if ($sql_od_make_line == '1') {
						$sql_od_make_line = '-خط تا';
					}
					else{
						$sql_od_make_line = '';
					}

					$sql_od_make_format_beat = $sql_od['order_make_format_beat'];
					if ($sql_od_make_format_beat == '1') {
						$sql_od_make_format_beat = '-ضرب قالب';
					}
					else{
						$sql_od_make_format_beat = '';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];
					if ($sql_od_make_header_glue == '1') {
						$sql_od_make_header_glue = '-سرچسب';
					}
					else{
						$sql_od_make_header_glue = '';
					}

					$sql_od_make_np	 = $sql_od['order_make_number_perforating'];
					if ($sql_od_make_np == '1') {
						$sql_od_make_np = '-شماره و پرفراژ';
					}
					else{
						$sql_od_make_np = '';
					}

					$sql_od_make_binding = $sql_od['order_make_binding'];
					if ($sql_od_make_binding == '1') {
						$sql_od_make_binding = '-صحافب';
					}
					else{
						$sql_od_make_binding = '';
					}

					$sql_od_make_design	 = $sql_od['order_make_design'];
					if ($sql_od_make_design == '1') {
						$sql_od_make_design = '-طراحی';
					}
					else{
						$sql_od_make_design = '';
					}
					if ($sql_od_make_format == '' && $sql_od_make_line == '' && $sql_od_make_format_beat == '' && $sql_od_make_header_glue == '' && $sql_od_make_np == '' && $sql_od_make_binding == '' && $sql_od_make_design == '') {
						$order_addition_services = '-';
					}
					else{
						$order_addition_services = '';
					}


					echo "<table class=\"order-details-details-div\">";
						echo "<tr><th colspan=\"3\">مشخصات سفارش</th></tr>";
						echo "<tr>";
							echo "<td>";
								echo "<p>شماره سفارش: <span class=\"order-detail-bg\">$sql_od_id</span></p>";
								echo "<p>نام کاربری: <span class=\"order-detail-bg\">$sql_od_user</span></p>";
								echo "<p>نام و نام خانوادگی کاربر: <span class=\"order-detail-bg\">$sql_od_user_realname</span></p>";
								echo "<p>نام سفارش: <span class=\"order-detail-bg\">$sql_od_type</span></p>";
								echo "<p>ابعاد: <span class=\"order-detail-bg\">$sql_od_size</span></p>";
								echo "<p>تیراژ: <span class=\"order-detail-bg\">$sql_od_quantity</span></p>";
								echo "<p>قیمت واحد: <span class=\"order-detail-bg\">$sql_od_unit_price تومان</span></p>";
								echo "<p>تعداد : <span class=\"order-detail-bg\"  style='background-color:#F36; color:#FFF'>$sql_od_lot_quantity</span></p>";
								echo "<p>قیمت کل: <span class=\"order-detail-bg\">$sql_od_total_price تومان</span></p>";
							echo "</td>";
							echo "<td>";
								echo "<p>طول سفارشی: <span class=\"order-detail-bg\">$sql_od_width</span></p>";
								echo "<p>عرض سفارشی: <span class=\"order-detail-bg\">$sql_od_height</span></p>";
								echo "<p>تاریخ ثبت: <span class=\"order-detail-bg\">$sql_od_submit_date</span></p>";
								echo "<p>مدت پروسه: <span class=\"order-detail-bg\">$sql_od_duration روز</span></p>";
								echo "<p>تاریخ تحویل: <span class=\"order-detail-bg\">$sql_od_promise_date به بعد</span></p>";
								echo "<p>شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_invoice_code</span></p>";
								echo "<p>کد بیجک: <span class=\"order-detail-bg\">$sql_od_bijak_code</span></p>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";


					echo "<table class=\"order-details-status-div\">";
						echo "<tr><th colspan=\"3\">وضعیت سفارش</th></tr>";
						echo "<tr>";
							echo "<td>";
								echo "<p>اجازه چاپ: <span class=\"order-detail-bg\">$sql_od_pp</span></p>";
								echo "<p>اجازه تحویل: <span class=\"order-detail-bg\">$sql_od_dp</span></p>";
							echo "</td>";
							echo "<td>";
								echo "<p>آخرین وضعیت: <span class=\"order-detail-bg\">$sql_od_ls</span></p>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";


					echo "<table class=\"order-details-files-div\">";
						echo "<tr><th>فایل های سفارش</th></tr>";
						echo "<tr><td>";
							echo $sql_od_file1_view;
							echo $sql_od_file2_view;
							echo $sql_od_file3_view;
							echo $sql_od_file4_view;
						echo "</td></tr>";
					echo "</table>";


					echo "<table class=\"order-details-last-div\">";
						echo "<tr><th colspan=\"2\">توضیحات و خدمات اضافه سفارش</th></tr>";
						echo "<tr><td>";
							echo "توضیحات: <span class=\"order-details-description\"><span class=\"order-detail-bg\">$sql_od_description</span></span>";
						echo "</td></tr>";
						echo "<tr><td>";
							echo "خدمات اضافه: <span class=\"order-detail-bg\">$sql_od_make_format $sql_od_make_line $sql_od_make_format_beat $sql_od_make_header_glue $sql_od_make_np $sql_od_make_binding $sql_od_make_design $order_addition_services </span>";
						echo "</td></tr>";
					echo "</table>";
					echo "<span class=\"print-button\"><a href=\"javascript:window.print()\">چاپ صفحه</a></span>";
					echo "<span class=\"print-button\"><a href=\"order-edit.php?orderID=".$orderID."\">ویرایش سفارش</a></span>";
					echo "<span class=\"print-button\"><a href=\"orders-graphic.php\">بازگشت به لیست سفارشات</a></span>";



			?>

		</table>

	</section>

<?php include ("footer.php"); ?>
