<?php require ("header.php");?>
<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">

	<h2>ویرایش درخواست ارسال</h2>

		<?php

if(isset($_POST['submit'])){
	
	parse_str($_SERVER['QUERY_STRING']);

	$service_name = $_POST['name'];
	$service_size = $_POST['size'];
	$service_quantity1 = $_POST['quantity1'];
	$service_price1 = $_POST['price1'];
	$service_worktime = $_POST['worktime'];	
	$service_quantity2 = '0';
	$service_price2 = '0';
	$service_quantity3 = '0';
	$service_price3 = '0';
	$service_quantity4 = '0';
	$service_price4 = '0';

	if(isset($_POST['quantity2']) && isset($_POST['price2'])){
		$service_quantity2 = $_POST['quantity2'];
		$service_price2 = $_POST['price2'];
	}

	require ('../db_select.php');

	if (!isset($service_name) || $service_name == '' || !isset($service_size) || $service_size == '' || !isset($service_quantity1) || $service_quantity1 == '' || !isset($service_price1) || $service_price1 == ''){
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند را پر نمایید.</span>";
	}
	else{
		$sql = "UPDATE services SET name = '$service_name' , size = '$service_size' , quantity1 = '$service_quantity1' , price1 = '$service_price1' , quantity2 = '$service_quantity2' , price2 = '$service_price2' , quantity3 = '$service_quantity3' , price3 = '$service_price3' , quantity4 = '$service_quantity4' , price4 = '$service_price4' , work_time = '$service_worktime'  WHERE id = $id";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql) === TRUE) {
			echo "<span class=\"edit-done-alert\">تغییرات مورد نظر با موفقیت اعمال گردید.</span>";
		} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
}

		parse_str($_SERVER['QUERY_STRING']);

		require ('../db_select.php');

		$dbresult=mysqli_query($connection, "SELECT * FROM delivery WHERE delivery_id = '$requestID'");
		
		echo "<form id=\"delivery_request-edit-form\" action=\"DeliveryRequestEdit.php?requestID=$requestID\" method=\"post\">"; 

		$row = mysqli_fetch_array($dbresult);
				$delivery_request_num = $row['delivery_id'];
				$delivery_request_username = $row['username'];
				$delivery_request_orders_number = $row['orders_number'];
				$delivery_request_delivery_adress = $row['delivery_adress'];
				$delivery_request_receiver_name = $row['receiver_name'];
				$delivery_request_request_date = $row['request_date'];
				$delivery_request_status = $row['status'];
				$delivery_request_details = $row['details'];
				$delivery_status_0 = '';
				$delivery_status_1 = '';
				$delivery_status_2 = '';
				if ($delivery_request_status == '0') {
					$delivery_request_status = 'در انتظار بررسی';
					$delivery_status_0 = 'selected';
				}
				elseif ($delivery_request_status == '1') {
					$delivery_request_status = 'مرسوله فرستاده شده است';
					$delivery_status_1 = 'selected';
				}
				elseif ($delivery_request_status == '2') {
					$delivery_request_status = 'ارسال مرسوله کنسل شده است';
					$delivery_status_2 = 'selected';
				}




			echo "<label>شماره درخواست: $delivery_request_num</label><br/>";
			echo "<label>نام کاربری: $delivery_request_username</label><br/>";
			echo "<label>شماره سفارش ها: $delivery_request_orders_number</label><br/>";
			echo "<label>آدرس ارسال سفارش ها: $delivery_request_delivery_adress</label><br/>";
			echo "<label>نام گیرنده: $delivery_request_receiver_name</label><br/>";
			echo "<label>تاریخ درخواست: $delivery_request_request_date</label><br/>";
			echo "<label for=\"delivery_status_change\">وضعیت:</label><br/>
			<select name=\"delivery_status_change\" id=\"delivery_status_change\" required>
				<option value=\"0\" $delivery_status_0>در انتظار بررسی</option>
				<option value=\"1\" $delivery_status_1>مرسوله فرستاده شده است</option>
				<option value=\"2\" $delivery_status_2>ارسال مرسوله کنسل شده است</option>
			</select><br/>";
			echo "<label for=\"delivery_add_details\">توضیحات:</label><textarea name=\"delivery_add_details\" id=\"delivery_add_details\" placeholder=\"توضیحات مانند روش ارسال و...\" value=\"$delivery_request_details\"></textarea><br/>";
			echo "<input type=\"submit\" value=\"ثبت ویرایش درخواست ارسال\"><br/>";

			echo "</form>";

	mysqli_close($connection);
		
	?>
		<article class="guild-section">
			<span class="alert-title">نکات مهم (راهنما):</span>
				<p>- لطفا در اولین فرصت بعد از ارسال مرسوله وضعیت را به حالت "ارسال شده" بگذارید زیرا در فیلد تاریخ ارسال زمان تغییر وضعیت به "ارسال شده" و ذخیره توسط شما را نشان می دهد.
				<br/>- در صورتی که مرسوله را ارسال کرده اید حتما در بخش توضیحات روش ارسال "پیک، باربری و یا تیپاکس" و جزئیات آن را بنویسید تا مشتری برای دریافت مرسوله با مشکل مواجه نشود.
				<br/>- در سایر وضعیت ها (بجز "ارسال شده") پر کردن فیلد توضیحات اختیاری است.
		</article>

	</section>

<?php include ("footer.php"); ?>