<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">ویرایش سفارش</h2>

        <?php

	require ('../db_select.php');

	$username_value = $_SESSION['print_username'];
	parse_str($_SERVER['QUERY_STRING']);

        if(isset($_POST['submit'])){
			
			
			require('library/jdf.php');
			$order_submit_date =  jdate('Y-n-j H:i:s');
			


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

			if (!isset($edited_order_pp) || $edited_order_pp == '' || !isset($edited_order_dp) || $edited_order_dp == '' || !isset($edited_order_status) || $edited_order_status == ''){
			    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش به وجود آمد. لطفا با تکمیل فیلد های مربوطه مجددا ثبت نمایید.</span>";
			}
			else{
				$sql = "UPDATE orders SET order_width = '$edited_order_width' , order_height = '$edited_order_height' , order_bijak_code = '$edited_order_bijak' , order_print_permission = '$edited_order_pp' , order_delivery_permission = '$edited_order_dp' , order_last_status = '$edited_order_status' WHERE order_id = '$id'";		
				mysqli_query($connection, "SET NAMES 'utf8'");
				mysqli_query($connection, "SET CHARACTER SET 'utf8'");
				mysqli_query($connection, "SET character_set_connection = 'utf8'");
				if ($connection->query($sql) == TRUE) {
					echo "<span class=\"edit-done-alert\">ویرایش سفارش با موفقیت ثبت گردید.</span>";
				} else {
		    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش در پایگاه داده به وجود آمد.</span>";
				}
			}
        }


					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");


	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders WHERE order_id = '$id'");


				$sql_od = mysqli_fetch_array($sql_order_details);

					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_size = $sql_od['order_size'];
					$sql_od_quantity = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];	
					$sql_od_lot_quantity = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = $sql_od['order_submit_date'];
					$sql_od_promise_date = $sql_od['order_promise_date'];
					$sql_od_user = $sql_od['order_user'];
					
					
 require_once('../avclass.php');
size_offer($order_submit_date,$sql_od_user);
					
					
				
				$sql_od_username_name = mysqli_query($connection, "SELECT display_name FROM user WHERE username='$sql_od_user'");
				$sql_od_username_name_result = mysqli_fetch_array($sql_od_username_name);
				$sql_od_user_realname = $sql_od_username_name_result['display_name'];


mysqli_query($connection, "UPDATE orders set read_m=1 WHERE order_id = $id");

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
						$sql_od_file1_view = "<img src=\""."..".$sql_od_file1."\">";
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
					}
						elseif ($sql_od_make_format_beat == 'h'){
						$sql_od_make_format_beat = '- جای داربست (عرض)';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];
					 
					  
					  

				 

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
							echo "<td>";
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
							//echo $sql_od_file4_view;
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
	
	
	mysqli_query($connection,"update orders set order_file1='$file1' where  order_id = '$id' ");
} else {
    echo "آپلود ناموفق <br>";
}

					}
					?>
                    
 

<label for="order-file-1">فایل 1:</label>
  <input type="file"  name="file1" id="fileToUpload" class="inpts" style="width:200px" value="<? echo $_POST['file1'] ?>"/><br/>
 
                <? 
					echo "<table class=\"order-details-last-div\">";
						echo "<tr><th colspan=\"2\">توضیحات و خدمات اضافه سفارش</th></tr>";
						echo "<tr><td>";
							echo "توضیحات: <span class=\"order-details-description\"><span class=\"order-detail-bg\">$sql_od_description</span></span>";
						echo "</td></tr>";
						echo "<tr><td>";
								echo "خدمات اضافه: <span class=\"order-detail-bg\">$sql_od_make_format   </span>";
							 
							if (!empty($sql_od_make_format)){ echo $sql_od_make_header_glue. ' عدد';} 	
							
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