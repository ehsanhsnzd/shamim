<?php require ("header.php");?>
<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">

	<h2>افزودن فاکتور</h2>

		<?php

if (isset($_POST['submit'])) {

	if(isset($_POST['username']) && $_POST['username'] != '' && 
	isset($_POST['comment']) && $_POST['comment'] != '' && 
	isset($_POST['price']) && $_POST['price'] != ''){

		$invoice_user = $_POST['username'];
		$invoice_comment = $_POST['comment'];
		$invoice_price = $_POST['price'];

		$invoice_c_date =  date('Y-n-j H:i:s');

        require ('../config.php');

		if (!isset($invoice_user) || $invoice_user == '' || !isset($invoice_comment) || $invoice_comment == '' || !isset($invoice_c_date) || $invoice_c_date == '' || !isset($invoice_price) || $invoice_price == ''){
		    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد ها را پر نمایید.</span>";
		}
		else{

            $connection_sql = mysql_connect($server_name, $db_username, $db_password);

            mysql_select_db($db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

            $sql_username_name = mysql_query("SELECT name,lastname,telephone FROM users WHERE login='$user_id_value'");
            $sql_username_name_result = mysql_fetch_array($sql_username_name);
            $invoice_name = $sql_username_name_result['name'];
            $invoice_lastname = $sql_username_name_result['lastname'];
            $invoice_tell = $sql_username_name_result['telephone'];




			$sql_invoice = "INSERT INTO factor (operator, cash ,date_create, comment,name,family,tell)
			VALUES ('$invoice_user', '$invoice_price', '$invoice_c_date', '$invoice_comment','$invoice_name','$invoice_lastname','$invoice_tell')";

			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");
			if ($connection->query($sql_invoice) === TRUE) {
				echo "<span class=\"edit-done-alert\">فاکتور جدید با موفقیت افزوده شد.</span>";
			} else {
	    echo "ارور: " . $sql_invoice . "<br>" . $connection->error;
			}

           $last_id= mysqli_insert_id($connection);


            $sql_order = "INSERT INTO orders3 (
							 order_user,
							 order_type,
							 order_size, 
							 order_width, 
							 order_height, 
							 order_quantity, 
							 order_duration, 
							 order_unit_price, 
							 order_lot_quantity, 
							 order_total_price, 
							 order_file1, 
							 order_file2, 
							 order_file3, 
							 order_file4, 
							 order_make_format, 
							 order_make_line, 
							 order_make_format_beat, 
							 order_make_header_glue, 
							 order_make_number_perforating, 
							 order_make_binding, 
							 order_make_design, 
							 order_submit_date, 
							 order_promise_date, 
							 order_description, 
							 order_invoice_code,factor) VALUES (
							 '$invoice_user', 
							 '$invoice_comment', 
							 '$order_size', 
							 '$order_custom_width', 
							 '$order_custom_height', 
							 '1', 
							 '$order_custom_duration', 
							 '$invoice_price', 
							 '$order_lot_quantity', 
							 '$invoice_price', 
							 '$file1', 
							 '$file2', 
							 '$file3', 
							 '$file4', 
							 '$order_make_format', 
							 '$order_make_line', 
							 '$order_make_format_beat', 
							 '$order_make_header_glue', 
							 '$order_make_number_perforating', 
							 '$order_make_binding', 
							 '$order_make_design', 
							 '$invoice_c_date', 
							 '$order_promise_date', 
							 '$invoice_comment', 
							 '$last_id','$last_id')";

            $connection->query($sql_order) ;


		}
	}
}

?>




		<form action="add-invoice.php" id="service-add-form" method="post" >
			<input type="text" name="comment" placeholder="عنوان فاکتور" required><br/>
			<input type="text" name="username" placeholder="نام کاربری کاربر مورد نظر" value="<?=$_GET['user']?>" required><br/>
			<input type="number" name="price" placeholder="مبلغ فاکتور به تومان" required><br/>
			<input type="submit" name="submit" value="ثبت فاکتور">
		</form>


		<article class="guild-section">
			<span class="alert-title">نکات مهم (راهنما):</span>
				<p>- حتما در قسمت عنوان فاکتور بنویسید که فاکتور مربوط به کدام خدمات ضافه و نیز مربوط به کدام شماره سفارش است.
				<br/>- در قسمت نام کاربری کاربر مورد نظر، یوزر نیم کاربری را بنویسید که می خواهید مبلغ را برای وی فاکتور کنید.
				<br/>- مبلغ فاکتور را به تومان وارد کنید و از درج حروف اضافی خود داری نمایید و فقط به صورت عددی وارد نمایید.</p>
		</article>

	</section>

<?php include ("footer.php"); ?>