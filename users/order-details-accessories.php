<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-sheet">
        <h2 class="user-panel-sheet-h2">جزئیات سفارش</h2>
<?php
	require ('../config.php');

	$connection = mysqli_connect($server_name, $db_username, $db_password);
		if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

	$username_value = $_SESSION['print_username'];
	parse_str($_SERVER['QUERY_STRING']);

					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");

	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user = '$username_value' AND order_id = '$orderID'");


				$sql_od = mysqli_fetch_array($sql_order_details);

					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_size = $sql_od['order_size'];
					$sql_od_quantity = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];
					$sql_od_lot_quantity = $sql_od['order_lot_quantity'];
					$sql_od_submit_date =jdate('Y/m/d h:i a',strtotime($sql_od['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_od_promise_date =jdate('Y/m/d h:i a',strtotime($sql_od['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa'); 

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
					if (!isset($sql_od_description) || $sql_od_description == '') 			{
						$sql_od_description = '-';
}
					$sql_od_file1 = $sql_od['order_file1'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\">";
					}
					else{
						$sql_od_file1_view = '';
					}
					$sql_od_file2 = $sql_od['order_file2'];
					if(isset($sql_od_file2) && $sql_od_file2 != ''){
						$sql_od_file2_view = "<img src=\"".$sql_od_file2."\">";
					}
					else{
						$sql_od_file2_view = '';
					}
					$sql_od_file3 = $sql_od['order_file3'];
					if(isset($sql_od_file3) && $sql_od_file3 != ''){
						$sql_od_file3_view = "<img src=\"".$sql_od_file3."\">";
					}
					else{
						$sql_od_file3_view = '';
					}

					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
						$sql_od_file4_view = "<img src=\"".$sql_od_file4."\">";
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
					if ($sql_od_make_format == 'true') {
						$sql_od_make_format = 'حلقه';
					}
					else{
						$sql_od_make_format = '';
					}
					$sql_od_make_binding=$sql_od['order_make_binding'];
					$sql_od_make_line = $sql_od['order_make_line'];
					if ($sql_od_make_line == 'true') {
						$sql_od_make_line = 'ایستند '.$sql_od_make_binding. 'عدد';
					}
					else{
						$sql_od_make_line = '';
					}

					$sql_od_make_format_beat = $sql_od['order_make_format_beat'];
					if ($sql_od_make_format_beat == 'w') {
						$sql_od_make_format_beat = '- داربست طول';
					}
						elseif ($sql_od_make_format_beat == 'h'){
						$sql_od_make_format_beat = '- داربست عرض';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];






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
								echo "<p>نام سفارش: <span class=\"order-detail-bg\">$sql_od_type</span></p>";
								echo "<p>ابعاد: <span class=\"order-detail-bg\">$sql_od_size</span></p>";
								echo "<p>تیراژ: <span class=\"order-detail-bg\">$sql_od_quantity</span></p>";
								echo "<p>قیمت واحد: <span class=\"order-detail-bg\">$sql_od_unit_price تومان</span></p>";
								echo "<p>تعداد لت: <span class=\"order-detail-bg\">$sql_od_lot_quantity</span></p>";
								echo "<p>قیمت کل: <span class=\"order-detail-bg\">$sql_od_total_price تومان</span></p>";
							echo "</td>";
							echo "<td>";
								echo "<p>طول سفارشی: <span class=\"order-detail-bg\">$sql_od_width</span></p>";
								echo "<p>عرض سفارشی: <span class=\"order-detail-bg\">$sql_od_height</span></p>";
								echo "<p>تاریخ ثبت: <span class=\"order-detail-bg\">$sql_od_submit_date</span></p>";
								echo "<p>مدت پروسه: <span class=\"order-detail-bg\">$sql_od_duration روز</span></p>";
								echo "<p>تاریخ تحویل: <span class=\"order-detail-bg\">$sql_od_promise_date به بعد</span></p>";
								echo "<p>شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_invoice_code</span></p>";

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
						if ($sql_od_last_status==5 ||  $sql_od_last_status==1){					if(isset($_POST['submit'])){




								for ($j=1 ; $j < 5 ; $j++) {
				$allowedExts = array("jpeg", "jpg", "tiff","png");
				$temp = explode(".", $_FILES["order-file-".$j]["name"]);
				$extension = end($temp);
				if (($_FILES["order-file-".$j]["type"] == "image/jpeg")
				|| ($_FILES["order-file-".$j]["type"] == "image/jpg")
				|| ($_FILES["order-file-".$j]["type"] == "image/pjpeg")
				|| ($_FILES["order-file-".$j]["type"] == "image/png")
				|| ($_FILES["order-file-".$j]["type"] == "image/tiff")

				&& in_array($extension, $allowedExts)){
				    if ($_FILES["order-file-".$j]["error"] > 0){
				        echo "Return Code: " . $_FILES["order-file-".$j]["error"] . "<br>";
				    }else{
				    	$file_save_name = "-".$invoice_code_value."_".$_FILES["order-file-".$j]["name"];

	  $increment = '';
	while(file_exists("images/".$increment.$file_save_name )) {

   $increment++;

}


				            move_uploaded_file($_FILES["order-file-".$j]["tmp_name"],
				            "images/" .$increment . $file_save_name);

				            $file_adress_name =  "file".$j;
				            ${$file_adress_name} = "../users/images/"  .$increment . $file_save_name;
			    	}
			    }
			}




			if (!isset($file2)) {
				$file2 = '';
			}
			if (!isset($file3)) {
				$file3 = '';
			}
			if (!isset($file4)) {
				$file4 = '';
			}


			$order_submit_date =  date('Y-m-d H:i:s');


							$sql_order = "update orders3 set

							 order_file1='$file1',
							 order_file2='$file2',
							 order_file3='$file3',
		 order_file4='$file4',order_last_status=2,
		 order_submit_date='$order_submit_date'
							 where order_id=$sql_od_id ";

							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");

							if ($connection->query($sql_order) === TRUE) {


									echo "سفارش شما با موفقیت ثبت شد. با تشکر ";


							}











			}
					?><br>
<br>

           <? if ( !empty($sql_od_file1) && $sql_od_last_status==5 ){		?>    <span class="error_box">    حالت تعلیق به معنی اشکال و ایرادی بودن فایل شما است لطفا فیلهای خود را مجددا آپلود کنید.</span><br><? }
			else{
				?>
				  <span class="upload_ok">    آپلود و تغییر فایلها</span><br>

		<?		}

			?>
<br><br>

<form method="post" action="<? $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

 فایل 1:
<input type="file" name="order-file-1" accept="image/jpg, image/jpeg, image/tiff" required/><br/>
                      <label for="order-file-2">فایل 2:</label>

                                <input type="file" name="order-file-2" accept="image/jpg, image/jpeg, image/tiff"><br/>

                                <label for="order-file-3">فایل 3: </label><input type="file" name="order-file-3" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <label for="order-file-4">فایل 4: </label><input type="file" name="order-file-4" accept="image/jpg, image/jpeg, image/tiff"><br>

                             	 <div class="order-edit-center-button"><input type="submit" class="profile-edit-submit" value="ثبت " name="submit"></div>


 </form>
						<? }

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
							echo "خدمات اضافه: <span class=\"order-detail-bg\">$sql_od_make_format    </span>";

							if (!empty($sql_od_make_format)){ echo $sql_od_make_header_glue. ' عدد';}

							echo "<br>";
							 if ($sql_od_make_format_beat!='undefined'){echo $sql_od_make_format_beat; }
						echo "$sql_od_make_line<br>
					 <br><br>

						</td></tr>";
					echo "</table>";
					echo "<span class=\"print-button\"><a href=\"javascript:window.print()\">چاپ صفحه</a></span>";
					echo "<span class=\"print-button\"><a href=\"orders-graphic.php\">بازگشت به لیست سفارشات</a></span>";



			?>

		</table>


	</section>



<?php include ("footer.php");?>
