<?php require ("header.php");?>
<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">
	<?php 

if(isset($_POST['name']) && $_POST['name'] != '' && 
	isset($_POST['size']) && $_POST['size'] != '' && 
	isset($_POST['quantity1']) && $_POST['quantity1'] != '' && 
	isset($_POST['price1']) && $_POST['price1'] != '' && 
	isset($_POST['worktime']) && $_POST['worktime'] != ''){
	$service_name = $_POST['name'];
	$service_size = $_POST['size'];
	$service_size_h = $_POST['size_h'];
	$type=	 $_POST['type'];
	$service_quantity1 = $_POST['quantity1'];
	$service_price1 = $_POST['price1'];
				$service_hide=$_POST['hide'];
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
	if ($_POST['quantity2'] == '') {
		$service_quantity2 = '0';
	}
	if ($_POST['price2'] == '') {
		$service_price2 = '0';
	}
	if(isset($_POST['quantity3']) && isset($_POST['price3'])){
		$service_quantity3 = $_POST['quantity3'];
		$service_price3 = $_POST['price3'];
	}
	if ($_POST['quantity3'] == '') {
		$service_quantity3 = '0';
	}
	if ($_POST['price3'] == '') {
		$service_price3 = '0';
	}
	if(isset($_POST['quantity4']) && isset($_POST['price4'])){
		$service_quantity4 = $_POST['quantity4'];
		$service_price4 = $_POST['price4'];
	}
	if ($_POST['quantity4'] == '') {
		$service_quantity4 = '0';
	}
	if ($_POST['price4'] == '') {
		$service_price4 = '0';
	}

	require ('../db_select.php');

	if (!isset($service_name) || $service_name == '' || !isset($service_size) || $service_size == '' || !isset($service_quantity1) || $service_quantity1 == '' || !isset($service_price1) || $service_price1 == ''){
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند پر نمایید.</span>";
	}
	else{
		$sql = "INSERT INTO services (name, size,size_h, quantity1, price1, quantity2, price2, quantity3, price3, quantity4, price4, work_time,hide)
		VALUES ('$service_name', '$service_size','$service_size_h', '$service_quantity1', '$service_price1', '$service_quantity2', '$service_price2', '$service_quantity3', '$service_price3', '$service_quantity4', '$service_price4', '$service_worktime','$service_hide')";
		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		
		if ($connection->query($sql) === TRUE) {
			echo "خدمت جدید با موفقیت به لیست خدمات افزوده شد.";
		} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	mysqli_close($connection);
}


?>
	<h2>افزودن خدمات</h2><br/>
		<form action="add-service.php" method="post" id="service-add-form">
			<input type="text" name="name" id="add_service_name" placeholder="نام خدمت*" required><br/><br>
       	  <input type="text" name="hide" id="add_service_name" placeholder="سرویس مناسبتی*" required><br/>
			<input type="text" name="size" placeholder="طول ابعاد*" required>
            <input type="text" name="size_h" placeholder="عرض ابعاد*" required><br>

		<input type="number" name="worktime" placeholder="تعداد روز کاری برای تحویل*" required>	<br/>
			<input type="number" name="quantity1" placeholder="تیراژ 1*" required>
			<input type="number" name="price1" placeholder="قیمت تیراژ 1*" required><br/>
			<input type="number" name="quantity2" placeholder="تیراژ 2">
			<input type="number" name="price2" placeholder="قیمت تیراژ 2"><br/>
			<input type="number" name="quantity3" placeholder="تیراژ 3">
			<input type="number" name="price3" placeholder="قیمت تیراژ 3"><br/>
			<input type="number" name="quantity4" placeholder="تیراژ 4">
			<input type="number" name="price4" placeholder="قیمت تیراژ 4"><br/>
			<input type="submit" value="ثبت خدمت جدید">
		</form>
		<article class="guild-section">
			<span class="alert-title">نکات مهم (راهنما):</span>
				<p>- در فیلد های تیراژ فقط عدد وارد شود مثلا: 1000
				<br/>- در قسمت مربوط به قیمت نیز فقط قیمت به صورت رقم و بدون ذکر واحد پولی درج شود.
				<br/>- قیمت ها بر اساس واحد پولی "تومان" درج گردد.
				<br/>- قیمت هر تعداد تیراژ زیر پایینی آن است و با شماره مشخص گردیده است.
				<br/>- می توانید تا 4 نوع تیراژ و قیمت تعیین کنید که اولی الزامی بوده و بقیه اختیاری است.
				<br/>- حتی در صورتی که قیمت چند نوع تیراژ برابر باشد، فیلد مربوط به هر یک را پر کنید؛ برای مثال در صورتی که هم تیراژ 1000 تا 10000 تومان و هم تیراژ 2000 تا 10000 تومان باشد، باید فیلد قیمت 2000 تا نیز تکمیل گردد.
				<br/>- برای فیلد تعداد روز مورد نیاز برای تحویل کار نیز فقط تعداد روز را وارد نمایید و از نوشتن واژه "روز" در کنار عدد خود داری نمایید.
		</article>
	</section>

<?php include ("footer.php"); ?>