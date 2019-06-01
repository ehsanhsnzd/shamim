<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">ویرایش سفارش</h2>

        <?php

	require ('../db_select.php');

	$username_value = $_SESSION['print_admin_name'];
	parse_str($_SERVER['QUERY_STRING']);

mysqli_query($connection, "UPDATE orders3 set read_m=1 WHERE order_id = $id");






$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id = '$id'");


				$sql_od = mysqli_fetch_array($sql_order_details);
					$sql_od_type = $sql_od['order_type'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_user = $sql_od['order_user'];
					$sql_od_last_status = $sql_od['order_last_status'];

		if( $sql_od['factor']!=0){

		$sql_od_invoice_code = $sql_od['factor'];}
		else{
		$sql_od_invoice_code=	$sql_od['order_invoice_code'];

			}


        if(isset($_POST['submit'])){

        	$edited_order_width = $_POST['order-width-edit-input'];
        	if (!isset($edited_order_width) || $edited_order_width == '') {
        		$edited_order_width = '-';
        	}

        	$edited_order_height = $_POST['order-height-edit-input'];
        	if (!isset($edited_order_height) || $edited_order_height == '') {
        		$edited_order_height = '-';
        	}
        	$edited_order_bijak = $_POST['order-bijak-edit-input'];
        	if (!isset($edited_order_bijak) || $edited_order_bijak == '') {
        		$edited_order_bijak = '-';
        	}

        	$edited_order_pp = $_POST['order-pp-edit-select'];
        	$edited_order_dp = $_POST['order-dp-edit-select'];
        	$edited_order_status = $_POST['order-status-edit-select'];
			$text_type="فاکتور: $sql_od_invoice_code $sql_od_type";

			if (!isset($edited_order_pp) || $edited_order_pp == '' || !isset($edited_order_dp) || $edited_order_dp == '' || !isset($edited_order_status) || $edited_order_status == ''){
			    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش به وجود آمد. لطفا با تکمیل فیلد های مربوطه مجددا ثبت نمایید.</span>";
			}
			else{
				$sql = "UPDATE orders3 SET order_width = '$edited_order_width' , order_height = '$edited_order_height' , order_bijak_code = '$edited_order_bijak' , order_print_permission = '$edited_order_pp' , order_delivery_permission = '$edited_order_dp' , order_last_status = '$edited_order_status' WHERE order_id = '$id'";
				mysqli_query($connection, "SET NAMES 'utf8'");
				mysqli_query($connection, "SET CHARACTER SET 'utf8'");
				mysqli_query($connection, "SET character_set_connection = 'utf8'");
				  echo "<span class=\"edit-done-alert\">ویرایش سفارش با موفقیت ثبت گردید.</span>";

				if ($connection->query($sql) == TRUE &&  !in_array($sql_od_user,$site_users)) {


                    if ($edited_order_status == '0') {
                        $sql_od_ls = 'در انتظار پرداخت فاکتور';
                    } elseif ($edited_order_status == '1') {
                        $sql_od_ls = 'در انتظار بررسی';
                    } elseif ($edited_order_status == '2') {
                        $sql_od_ls = 'پروسه چاپ';
                    } elseif ($edited_order_status == '3') {
                        $sql_od_ls = 'آماده تحویل';
                    } elseif ($edited_order_status == '4') {
                        $sql_od_ls = 'تحویل داده شده';
                    } elseif ($edited_order_status == '5') {
                        $sql_od_ls = 'تعلیق کار';
                    } elseif ($edited_order_status == '6') {
                        $sql_od_ls = 'کنسل شد';
                    } elseif ($edited_order_status == '7') {
                        $sql_od_ls = 'تحویل شرکت';
                    } elseif ($edited_order_status == '8') {
                        $sql_od_ls = 'تحویل مشتری';
                    } else {
                        $sql_od_ls = 'تعلیق';
                    }

                    if ($edited_order_status == '5') {


                    $order_of_tel_sql = "SELECT tell,name,family FROM factor where  id =  (select order_make_number_perforating  from orders1 where order_id=$id)";
                    $order_of_tel = mysqli_query($connection, $order_of_tel_sql);
                    $sql_order_tel = mysqli_fetch_assoc($order_of_tel);

                    require_once('../sms/sms.class.php');

                    $name = $sql_order_tel['name'] . ' ';
                    $family = $sql_order_tel['family'] . ' ';
                    $Receptors = array($sql_order_tel['tell']);

                    $resp = $gate->SendSMS('جناب ' . $name . $family . 'سفارش شما به وضعیت ' . $sql_od_ls . ' تغییر یافت
	' . $text_type . '
'.$result_main_page_name, $smsnum, $Receptors);

                }


                    if ($edited_order_status == '6' && $sql_od_last_status!='6') {

                        $order_user=$sql_od_user;
                        $invoice_id=$sql_od_invoice_code;
                        $amount=$sql_od_total_price;
                        $balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$order_user' group by approved");
                        $balance= mysqli_fetch_array($balance_user);
                            $quantity_total=$balance['balance'];
                            $date_now = date('Y-n-j H:i:s');

                  if(!	mysqli_query($connection,"insert into credits_list (type,title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total,invoice_id) values ('6','کنسل فاکتور $invoice_id','".$date_now."','".$order_user."',".(float)$amount.",1,0,0,0,".(float)$quantity_total.",'$invoice_id')")){ echo mysqli_error($connection);}
if(!mysqli_query($connection,"update factor set is_paid=6 where id =$invoice_id")){ echo mysqli_error($connection);}

                    }

					 if ($edited_order_status != '6' && $sql_od_last_status=='6') {

                        $order_user=$sql_od_user;
                        $invoice_id=$sql_od_invoice_code;
                        $amount=0-$sql_od_total_price;
                        $balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$order_user' group by approved");
                        $balance= mysqli_fetch_array($balance_user);
                            $quantity_total=$balance['balance'];
                            $date_now = date('Y-n-j H:i:s');

                  if(!	mysqli_query($connection,"insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total,invoice_id) values ('پرداخت فاکتور $invoice_id','".$date_now."','".$order_user."',".(float)$amount.",1,0,0,0,".(float)$quantity_total.",'$invoice_id')")){ echo mysqli_error($connection);}
									if(!mysqli_query($connection,"update factor set is_paid=1 where id =$invoice_id")){ echo mysqli_error($connection);}

                    }





				} else {
		    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش در پایگاه داده به وجود آمد.</span>";
				}
			}
        }


					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");


	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id = '$id'");


				$sql_od = mysqli_fetch_array($sql_order_details);
$sql_od_fast_deliver= $sql_od['fast_deliver'];
$sql_od_lot_last= $sql_od['last_lot'];
					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_f_start = $sql_od['factor_start'];
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




					$sql_od_width = $sql_od['order_width'];
					if ($sql_od_width == '') {
						$sql_od_width = '-';
					}
					$sql_od_height = $sql_od['order_height'];
					if ($sql_od_height == '') {
						$sql_od_height = '-';
					}

					$sql_od_duration = $sql_od['order_duration'];


										if( $sql_od['factor']!=0){

		$sql_od_invoice_code = $sql_od['factor'];}
		else{
		$sql_od_invoice_code=	$sql_od['order_invoice_code'];

			}



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
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\">
<a href=\"".$sql_od_file1."\" >دانلود</a>";
					}
					else{
						$sql_od_file1_view = '';
					}
					$sql_od_file2 = $sql_od['order_file2'];
					if(isset($sql_od_file2) && $sql_od_file2 != ''){
						$sql_od_file2_view = "<img src=\"".$sql_od_file2."\">
<a href=\"".$sql_od_file2."\" >دانلود</a>";
					}
					else{
						$sql_od_file2_view = '';
					}
					$sql_od_file3 = $sql_od['order_file3'];
					if(isset($sql_od_file3) && $sql_od_file3 != ''){
						$sql_od_file3_view = "<img src=\"".$sql_od_file3."\">
<a href=\"".$sql_od_file3."\" >دانلود</a>";
					}
					else{
						$sql_od_file3_view = '';
					}
					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
						$sql_od_file4_view = "<img src=\"".$sql_od_file4."\">
<a href=\"".$sql_od_file4."\" >دانلود</a>";
					}
					else{
						$sql_od_file4_view = '';
					}

					$od_pp_no_selected='';
					$od_pp_yes_selected='';
					if ($sql_od_print_permission == '0') {
						$sql_od_pp = 'خیر';
						$od_pp_no_selected='selected';
					}
					elseif ($sql_od_print_permission == '1') {
						$sql_od_pp = 'بله';
						$od_pp_yes_selected='selected';
					}
					else{
						$sql_od_pp = '';
					}

					$od_dp_no_selected='';
					$od_dp_yes_selected='';
					if ($sql_od_delivery_permission == '0') {
						$sql_od_dp = 'خیر';
						$od_dp_no_selected='selected';
					}
					elseif ($sql_od_delivery_permission == '1') {
						$sql_od_dp = 'بله';
						$od_dp_yes_selected='selected';
					}
					else{
						$sql_od_dp = '';
					}

					$od_ls_0 = '';
					$od_ls_1 = '';
					$od_ls_2 = '';
					$od_ls_3 = '';
					$od_ls_4 = '';
					$od_ls_5 = '';
					$od_ls_6 = '';
					$od_ls_7 = '';
					if ($sql_od_last_status == '0') {
						$sql_od_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_od_last_status == '1') {
						$sql_od_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_od_last_status == '2') {
						$sql_od_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_od_last_status == '3') {
						$sql_od_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_od_last_status == '4') {
						$sql_od_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_od_last_status == '5') {
						$sql_od_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_od_last_status == '6') {
						$sql_od_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}

					elseif ($sql_od_last_status == '7') {
						$sql_od_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_od_last_status == '8') {
						$sql_od_ls = 'تحویل مشتری';
						$od_ls_8 = 'selected';
					}

					else{
						$sql_od_ls = 'وضعیت تعلیق';
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

				echo "<form id=\"order-edit-form\" action=\"order-edit-graphic.php?id=$id\" method=\"post\">"; 				echo "<table class=\"order-details-details-div\">";
						echo "<tr><th colspan=\"3\">مشخصات سفارش</th></tr>";
						echo "<tr>";
							echo "<td>";
								echo "<p>شماره سفارش: <span class=\"order-detail-bg\">$sql_od_id</span></p>";
								echo "<p>نام کاربری: <span class=\"order-detail-bg\">$sql_od_user</span></p>";
								echo "<p>نام و نام خانوادگی کاربر: <span class=\"order-detail-bg\">$sql_od_user_realname</span></p>";
								echo "<p>نام سفارش: <span class=\"order-detail-bg\">$sql_od_type</span></p>";

									if(!empty($sql_od_f_start)){
									echo "<p>شروع شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_f_start</span></p>";
						}
								echo "<p>ابعاد: <span class=\"order-detail-bg\">$sql_od_size</span></p>";
								echo "<p>تیراژ: <span class=\"order-detail-bg\">$sql_od_quantity</span></p>";
								echo "<p>قیمت واحد: <span class=\"order-detail-bg\">$sql_od_unit_price تومان</span></p>";
								echo "<p>تعداد : <span class=\"order-detail-bg\"   style='background-color:#F36; color:#FFF'>$sql_od_lot_quantity</span></p>";

								echo "<p>تعداد لت : <span class=\"order-detail-bg\"   style='background-color:#F36; color:#FFF'>$sql_od_lot_last</span></p>";

											if(!empty($sql_od_fast_deliver)){
									echo "<p>  <span class=\"order-detail-bg\"   style='background-color:#F36; color:#FFF'>فوری</span></p>";
						}

								echo "<p>قیمت کل: <span class=\"order-detail-bg\">$sql_od_total_price تومان</span></p>";
							echo "</td>";
							echo "<td>";
								echo "<p>طول سفارشی: <input type=\"text\" name=\"order-width-edit-input\" class=\"order-edit-input\" value=\"$sql_od_width\"></p>";
								echo "<p>عرض سفارشی: <input type=\"text\" name=\"order-height-edit-input\" class=\"order-edit-input\"value=\"$sql_od_height\"></p>";
								echo "<p>تاریخ ثبت: <span class=\"order-detail-bg\">$sql_od_submit_date</span></p>";
								echo "<p>مدت پروسه: <span class=\"order-detail-bg\">$sql_od_duration روز</span></p>";
								echo "<p>تاریخ تحویل: <span class=\"order-detail-bg\">$sql_od_promise_date به بعد</span></p>";
								echo "<p>شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_invoice_code</span></p>";
								echo "<p>کد بیجک: <input type=\"text\" name=\"order-bijak-edit-input\" class=\"order-edit-input\" value=\"$sql_od_bijak_code\"></p>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";


					echo "<table class=\"order-details-status-div\">";
						echo "<tr><th colspan=\"3\">وضعیت سفارش</th></tr>";
						echo "<tr>";
							echo "<td>";
								echo "<p>اجازه چاپ: <select name=\"order-pp-edit-select\" class=\"order-edit-select\">
									<option value=\"1\" $od_pp_yes_selected>بله</option>
									<option value=\"0\" $od_pp_no_selected>خیر</option>
								</select></p>";
								echo "<p>اجازه تحویل: <select name=\"order-dp-edit-select\" class=\"order-edit-select\">
									<option value=\"1\" $od_dp_yes_selected>بله</option>
									<option value=\"0\" $od_dp_no_selected>خیر</option>
								</select></p>";
							echo "</td>";
							echo "<td>";
								echo "<p>آخرین وضعیت: <select name=\"order-status-edit-select\" class=\"order-edit-select\">
									<option value=\"0\" $od_ls_0>در انتظار پرداخت فاکتور</option>
									<option value=\"1\" $od_ls_1>در انتظار بررسی</option>
									<option value=\"2\" $od_ls_2>پروسه چاپ</option>
									<option value=\"3\" $od_ls_3>آماده تحویل</option>
									<option value=\"4\" $od_ls_4>تحویل داده شده</option>
									<option value=\"5\" $od_ls_5>تعلیق کار</option>
									<option value=\"6\" $od_ls_6>کنسل شد</option>
 									<option value=\"7\" $od_ls_7>تحویل شرکت</option>
										<option value=\"8\" $od_ls_8>تحویل مشتری</option>
								</select></p>";
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

						echo "<div class=\"order-edit-center-button\"><input type=\"submit\" class=\"order-edit-submit\" value=\"ثبت ویرایش\" name=\"submit\"></div>";
				echo "</form>";


			?>

		</table>

	</section>

<?php include ("footer.php"); ?>
