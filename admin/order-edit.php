<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">ویرایش سفارش</h2>

        <?php

	require ('../db_select.php');

	$username_value = $_SESSION['print_admin_name'];
	parse_str($_SERVER['QUERY_STRING']);


					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");


	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_id = '$id'");


				$sql_od = mysqli_fetch_array($sql_order_details);

	 				$sql_od_type = $sql_od['order_type'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_user = $sql_od['order_user'];
					$sql_od_last_status = $sql_od['order_last_status'];


						if( $sql_od['order_make_number_perforating']!=0){

		$sql_od_invoice_code = $sql_od['order_make_number_perforating'];}
		else{
		$sql_od_invoice_code=	$sql_od['order_invoice_code'];

			}







        if(isset($_POST['submit'])){



			$order_submit_date =  jdate('Y-n-j H:i:s');



        	$edited_order_width = $_POST['order-width-edit-input'];
        	if (!isset($edited_order_width) || $edited_order_width == '') {
        		$edited_order_width = '-';
        	}
        	$edited_order_format_beat = $_POST['order_make_format_beat'];
        	$edited_order_make_format = $_POST['order_make_format'];
            $edited_order_make_cut = $_POST['order_make_cut'];
            if($edited_order_make_cut!='true'){$edited_order_make_cut='false';}
            if($edited_order_make_cut!='true'){$edited_order_make_cut='false';}
        	$edited_order_header_glue = $_POST['halghe'];
        	$edited_order_make_line = $_POST['order_make_line'];
			if($edited_order_make_line!='true'){$edited_order_make_line='false';}
 			$edited_order_description=$_POST['order-description'];

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
			$text_type="فاکتور: " .$sql_od_invoice_code." ". $sql_od_type." ".$_POST['order-sms'];

			if (!isset($edited_order_pp) || $edited_order_pp == '' || !isset($edited_order_dp) || $edited_order_dp == '' || !isset($edited_order_status) || $edited_order_status == ''){
			    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش به وجود آمد. لطفا با تکمیل فیلد های مربوطه مجددا ثبت نمایید.</span>";
			}
			else{
				  if ($_SESSION['print_admin_name']!='mousavi'){
				$sql = "UPDATE orders1 SET order_width = '$edited_order_width' , order_height = '$edited_order_height' , order_bijak_code = '$edited_order_bijak' , order_print_permission = '$edited_order_pp' , order_delivery_permission = '$edited_order_dp' , order_last_status = '$edited_order_status' , order_make_format_beat='$edited_order_format_beat',
order_make_format='$edited_order_make_format',order_make_cut='$edited_order_make_cut', order_make_header_glue='$edited_order_header_glue', order_make_line='$edited_order_make_line',order_description='$edited_order_description' WHERE order_id = '$id'";
				  }else{
$sql = "UPDATE orders1 SET order_width = '$edited_order_width' , order_height = '$edited_order_height' , order_bijak_code = '$edited_order_bijak' , order_print_permission = '$edited_order_pp' , order_delivery_permission = '$edited_order_dp' , order_last_status = '$edited_order_status'  WHERE order_id = '$id'";		}

				mysqli_query($connection, "SET NAMES 'utf8'");
				mysqli_query($connection, "SET CHARACTER SET 'utf8'");
				mysqli_query($connection, "SET character_set_connection = 'utf8'");

					echo "<span class=\"edit-done-alert\">ویرایش سفارش با موفقیت ثبت گردید.</span>";
				if ($connection->query($sql) == TRUE  &&  !in_array($sql_od_user,$site_users)) {


						if ($edited_order_status == '0') {
						$sql_od_ls = 'در انتظار پرداخت فاکتور';
					}
					elseif ($edited_order_status == '1') {
						$sql_od_ls = 'در انتظار بررسی';
					}
					elseif ($edited_order_status == '2') {
						$sql_od_ls = 'پروسه چاپ';
					}
					elseif ($edited_order_status == '3') {
						$sql_od_ls = 'آماده تحویل';
					}
					elseif ($edited_order_status == '4') {
						$sql_od_ls = 'تحویل داده شده';
					}
					elseif ($edited_order_status == '5') {
						$sql_od_ls = 'تعلیق کار';
					}
						elseif ($edited_order_status == '6') {
						$sql_od_ls = 'کنسل شد';
					}
					elseif ($edited_order_status == '7') {
						$sql_od_ls = 'تحویل شرکت';
					}
					elseif ($edited_order_status == '8') {
						$sql_od_ls = 'تحویل مشتری';
					}
					elseif ($edited_order_status == '9') {
						$sql_od_ls = 'تعلیق کارگاه';
					}
						elseif ($edited_order_status == '10') {
						$sql_od_ls = 'کارگاه';
						$od_ls_10 = 'selected';
					}
						elseif ($edited_order_status == '11') {
						$sql_od_ls = 'ویرایش';
						$od_ls_11 = 'selected';
					}

					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}






                    if ($edited_order_status == '5' || $edited_order_status == '9') {
                    //    if ($_SESSION['print_admin_name']!='mousavi'){

                        $order_of_tel_sql = "SELECT tell,name,family FROM factor where  id =  (select order_make_number_perforating  from orders1 where order_id=$id)";
                        $order_of_tel = mysqli_query($connection, $order_of_tel_sql);
                        $sql_order_tel = mysqli_fetch_assoc($order_of_tel);

                        require_once('../sms/sms.class.php');

                        $name = $sql_order_tel['name'] . ' ';
                        $family = $sql_order_tel['family'] . ' ';
                        $Receptors = array($sql_order_tel['tell']);

                        $resp = $gate->SendSMS('جناب ' . $name . $family . 'سفارش شما ' . $sql_od_ls . ' شد' . $text_type . '	'.$result_main_page_name, $smsnum, $Receptors);
                    //    }

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
$sql_order_details = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_id = '$id'");


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


// require_once('../avclass.php');
//size_offer($order_submit_date,$sql_od_user);



				$sql_od_username_name = mysqli_query($connection, "SELECT display_name FROM user WHERE username='$sql_od_user'");
				$sql_od_username_name_result = mysqli_fetch_array($sql_od_username_name);
				$sql_od_user_realname = $sql_od_username_name_result['display_name'];



if ($_SESSION['print_admin_name']=='mousavi'){

mysqli_query($connection, "UPDATE orders1 set read_m=1 WHERE order_id = $id");}


					$sql_od_width = $sql_od['order_width'];
					if ($sql_od_width == '') {
						$sql_od_width = '-';
					}
					$sql_od_height = $sql_od['order_height'];
					if ($sql_od_height == '') {
						$sql_od_height = '-';
					}

					$sql_od_duration = $sql_od['order_duration'];


						if( $sql_od['order_make_number_perforating']!=0){

		$sql_od_invoice_code = $sql_od['order_make_number_perforating'];}
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

					 $sql_dw_file1=basename($sql_od_file1);




					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
		 		$sql_od_file4_view = "
 <div style=\"background-image:url('..$sql_od_file4');\" class=\"imgback\" >

  <a href=\"download.php?download_file=$sql_dw_file1\" class=\"downloadbutton\" ></a>

  </div> ";
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
					elseif ($sql_od_last_status == '9') {
						$sql_od_ls = 'تعلیق کارگاه';
						$od_ls_9 = 'selected';
					}

						elseif ($sql_od_last_status == '10') {
						$sql_od_ls = 'ویرایش کارگاه';
						$od_ls_10 = 'selected';
					}

						elseif ($sql_od_last_status == '11') {
						$sql_od_ls = 'ویرایش طراح';
						$od_ls_11 = 'selected';
					}

					else{
						$sql_od_ls = 'وضعیت تعلیق';
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

					$sql_od_make_cut = $sql_od['order_make_cut'];
					if ($sql_od_make_cut == 'true') {
                        $sql_od_make_cut = 'برش';
					}
					else{
                        $sql_od_make_cut = '';
					}

					$sql_od_make_line = $sql_od['order_make_line'];
					if ($sql_od_make_line == 'true') {
						$sql_od_make_line = '- ایستند';
					}
					else{
						$sql_od_make_line = '';
					}

					$sql_od_make_format_beat = $sql_od['order_make_format_beat'];
					if ($sql_od_make_format_beat == 'w') {
						$sql_od_make_format_beat = '- جای داربست (طول)';
						$sql_od_make_format_beat_value = 'w';
					}
						elseif ($sql_od_make_format_beat == 'h'){
						$sql_od_make_format_beat = '- جای داربست (عرض)';
						$sql_od_make_format_beat_value = 'h';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];
        $sql_od_make_banner_cut = $sql_od['order_make_banner_cut'];






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








				echo "<form id=\"order-edit-form\" action=\"order-edit.php?id=$id\" enctype=\"multipart/form-data\" method=\"post\">";

					echo "<table class=\"order-details-details-div\">";
						echo "<tr><th colspan=\"3\">مشخصات سفارش</th></tr>";
						echo "<tr>";
							echo "<td valign='top'>";
								echo "<p>شماره سفارش: <span class=\"order-detail-bg\">$sql_od_id</span></p>";
								echo "<p>نام کاربری: <span class=\"order-detail-bg\">$sql_od_user</span></p>";
								echo "<p>نام و نام خانوادگی کاربر: <span class=\"order-detail-bg\">$sql_od_user_realname</span></p>";
								echo "<p>نام سفارش: <span class=\"order-detail-bg\">$sql_od_type</span></p>";
								echo "<p>ابعاد: <span class=\"order-detail-bg\">$sql_od_size</span></p>";
							echo "<p>تعداد لت: <span class=\"order-detail-bg\">$sql_od_lot_quantity</span></p>";
								echo "<p>قیمت واحد: <span class=\"order-detail-bg\">$sql_od_unit_price تومان</span></p>";

								echo "<p>قیمت کل: <span class=\"order-detail-bg\">$sql_od_total_price تومان</span></p>";
							echo "</td>";
							echo "<td>";

								echo "<p>تاریخ ثبت: <span class=\"order-detail-bg\">$sql_od_submit_date</span></p>";
								echo "<p>مدت پروسه: <span class=\"order-detail-bg\">$sql_od_duration روز</span></p>";
								echo "<p>تاریخ تحویل: <span class=\"order-detail-bg\">$sql_od_promise_date به بعد</span></p>";
								echo "<p>شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_invoice_code</span></p>";
								echo "<p>طول سفارشی: <input type=\"text\" name=\"order-width-edit-input\" class=\"order-edit-input\" value=\"$sql_od_width\"></p>";
								echo "<p>عرض سفارشی: <input type=\"text\" name=\"order-height-edit-input\" class=\"order-edit-input\"value=\"$sql_od_height\"></p>";		 if ($_SESSION['print_admin_name']!='mousavi'){  	?>

                               <p>
                                  <input type="checkbox" name="order_make_format" id="order_make_format" <? if (!empty($sql_od_make_format)){echo "checked";}?> value="true">
                                حلقه

                              تعداد حلقه :   <input name="halghe" value="<? if (!empty($sql_od_make_format)){ echo $sql_od_make_header_glue ;}?>"  id="halghe" style="width:50px" <? if (empty($sql_od_make_format)){echo "disabled";}?> ></p>
                                <p><input type="checkbox" name="order_make_line" id="order_make_line" <? if (!empty($sql_od_make_line)){echo "checked";}?> value="true">
                                ایستند
                                <input name="stand" value="1"  id="stand" style="width:50px; display:none" disabled ></p>
                                <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat" value="w" <?  if ($sql_od_make_format_beat_value=='w'){echo "checked"; } ?>>
                                       طول جای داربست
                              </p>  <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat2" value="h" <?  if ($sql_od_make_format_beat_value=='h'){echo "checked"; } ?>>
عرض  جای داربست (1500 تومان)
                          </p>

                          <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat2" <?  if ($sql_od_make_format_beat=='undefined'){echo "checked"; } ?> value="undefined">
بدون  جای داربست
                          </p>


        <input type="checkbox" name="order_make_cut" id="order_make_cut" <? if (!empty($sql_od_make_cut)){echo "checked";}?>>
        برش
        (<?=$d['banner_cut']?> تومان)
        تعداد برش :   <input name="banner_cut" value="<? if (!empty($sql_od_make_cut)){ echo $sql_od_make_banner_cut ;}?>"  id="banner_cut" style="width:50px" <? if (empty($sql_od_make_cut)){echo "disabled";}?> ></p>



        <br/><br>

        <script>

            document.getElementById('order_make_format').onchange = function() {
                document.getElementById('halghe').disabled = !this.checked;
            };
            document.getElementById('order_make_line').onchange = function() {
                document.getElementById('stand').disabled = !this.checked;
            };
            document.getElementById('order_make_cut').onchange = function() {
                document.getElementById('banner_cut').disabled = !this.checked;
            };
        </script>

                                </p>

                            <? }
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
								echo "<p>آخرین وضعیت:  <select name=\"order-status-edit-select\" class=\"order-edit-select\">";
								  if ($_SESSION['print_admin_name']!='mousavi'){

										echo "<option value=\"0\" $od_ls_0>در انتظار پرداخت فاکتور</option>
									<option value=\"1\" $od_ls_1>در انتظار بررسی</option>
									<option value=\"2\" $od_ls_2>پروسه چاپ</option>
									<option value=\"3\" $od_ls_3>آماده تحویل</option>
									<option value=\"4\" $od_ls_4>تحویل داده شده</option>
									<option value=\"5\" $od_ls_5>تعلیق کار</option>
									<option value=\"6\" $od_ls_6>کنسل شد</option>
 									<option value=\"7\" $od_ls_7>تحویل شرکت</option>
									<option value=\"8\" $od_ls_8>تحویل مشتری</option>
									<option value=\"9\" $od_ls_9>تعلیق کارگاه</option>
									<option value=\"10\" $od_ls_10>کارگاه</option>
									<option value=\"11\" $od_ls_11>ویرایش طراح</option>";
								  }else{

								 echo "<option value=\"10\" $od_ls_10>کارگاه</option>";
							 echo "<option value=\"7\" $od_ls_7>تحویل شرکت</option>";
									echo "<option value=\"9\" $od_ls_9>تعلیق کارگاه</option>";
								  }
								echo "</select></p>";

        echo "<p>دلیل تعلیق : <select name=\"order-sms\" class=\"order-edit-select\">
<option >  </option>
<option value='سایز فایل مطابقت ندارد'> سایز فایل مطابقت ندارد </option>
<option value='ایراد جای داربست'> ایراد جای داربست </option>
<option value='ایراد حلقه'> ایراد حلقه </option>
<option value='ایراد استند'> ایراد استند </option>
<option value='ایراد توضیحات'> ایراد توضیحات </option>

";

        echo "</select></p>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";


					echo "<table class=\"order-details-files-div\">";
						echo "<tr><th>فایل های سفارش</th></tr>";
						echo "<tr><td>";

							echo $sql_od_file4_view;
							echo $sql_od_file2_view;
							echo $sql_od_file3_view;

						echo "</td></tr>";
					echo "</table>";

	if(isset($_POST['submit'])){

		echo	$file_save_name = $_FILES["file1"]["name"];

							    $info = pathinfo($file_save_name);
							    $file_save_name = $info['filename'] . '1' . '.' . $info['extension'];

      if( move_uploaded_file($_FILES["file1"]["tmp_name"],
				            "../users/images/" . $file_save_name)){

				            $file_adress_name =  "file1";
				            ${$file_adress_name} = "/users/images/" . $file_save_name;



    echo "$fileName آپلود با موفقیت انجام شد. <br>";


	mysqli_query($connection,"update orders1 set order_file1='$file1' where  order_id = '$id' ");
}

					}
					?>



<label for="order-file-1">فایل
  <input type="file"  name="file1" id="fileToUpload" class="inpts" style="width:200px" value="<? echo $_POST['file1'] ?>"/>
 </label><br/>

                <?
					echo "<table class=\"order-details-last-div\">";
						echo "<tr><th colspan=\"2\">توضیحات و خدمات اضافه سفارش</th></tr>";
						echo "<tr><td>";
							echo "<span>توضیحات:</span> <textarea id=\"order-form-description\" name=\"order-description\" class=\"order-edit-input\"  rows=\"4\" style=\"width:500px\">".$sql_od_description."</textarea>";


						echo "</td></tr>";
						echo "<tr><td>";
								echo "خدمات اضافه: <span class=\"order-detail-bg\">$sql_od_make_format   </span>";

							if (!empty($sql_od_make_format)){ echo $sql_od_make_header_glue. ' عدد';}

                if (!empty($sql_od_make_cut)){ echo "برش". $sql_od_make_banner_cut. ' عدد';}

                echo "<br>";
							 if ($sql_od_make_format_beat!='undefined'){echo $sql_od_make_format_beat; }
						echo "<br>

						$sql_od_make_line<br><br>


	 <p>تعداد : <span class=\"order-detail-bg\">$sql_od_lot_quantity</span></p>
</td></tr>";
					echo "</table>";

						echo "<div class=\"order-edit-center-button\"><input type=\"submit\" class=\"order-edit-submit\" value=\"ثبت ویرایش\" name=\"submit\"></div>";
				echo "</form>";


			?>

		</table>

	</section>

<?php include ("footer.php"); ?>
