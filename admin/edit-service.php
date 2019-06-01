<?php require ("header.php");?>
<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">

	<h2>افزودن خدمات</h2>

		<?php

	if(isset($_POST['name']) && $_POST['name'] != '' && 
	isset($_POST['size']) && $_POST['size'] != '' && 
	isset($_POST['quantity1']) && $_POST['quantity1'] != '' && 
	isset($_POST['price1']) && $_POST['price1'] != '' && 
	isset($_POST['worktime']) && $_POST['worktime'] != ''){
	
	parse_str($_SERVER['QUERY_STRING']);

	$service_name = $_POST['name'];
	$service_size = $_POST['size'];
		$service_size_h = $_POST['size_h'];
	$service_quantity1 = $_POST['quantity1'];
	$service_price1 = $_POST['price1'];
	$service_worktime = $_POST['worktime'];	
			$service_hide=$_POST['hide'];
				$type=	 $_POST['type'];
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
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند را پر نمایید.</span>";
	}
	else{
		$sql = "UPDATE services SET name = '$service_name' , size = '$service_size' ,size_h = '$service_size_h' , quantity1 = '$service_quantity1' , price1 = '$service_price1' , quantity2 = '$service_quantity2' , price2 = '$service_price2' , quantity3 = '$service_quantity3' , price3 = '$service_price3' , quantity4 = '$service_quantity4' , price4 = '$service_price4' , work_time = '$service_worktime',hide='$service_hide',type='$type'  WHERE id = $id";		
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
		
			echo "<form id=\"service-add-form\" action=\"edit-service.php?id=$id&do=$do\" method=\"post\"   >"; 
			echo "<label for=\"meter\">اندازه:</label><input type=\"number\" name=\"meter\" id=\"meter\" placeholder=\"اندازه به سانتیمتر\" value=\"$meter\">";
			
			echo "<input type=\"submit\" name=\"submit_add\" value=\"ثبت\">";
				echo "</form>";
		

		$dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id = $id");
		
		echo "<form id=\"service-add-form\" action=\"edit-service.php?id=$id&do=$do\" method=\"post\">"; 

		$row = mysqli_fetch_array($dbresult);
				$service_edit_name= $row['name'];
				$service_edit_size= $row['size'];
					$service_edit_size_h= $row['size_h'];
				$service_edit_work_time= $row['work_time'];
				$service_edit_quantity1= $row['quantity1'];
				$service_edit_price1= $row['price1'];
				$service_edit_quantity2= $row['quantity2'];
				$service_hide=$row['hide'];
				if ($service_edit_quantity2 == 0) {
					$service_edit_quantity2 = '';
				}
				$service_edit_price2= $row['price2'];
				if ($service_edit_price2 == 0) {
					$service_edit_price2= '';
				}				
				$service_edit_quantity3= $row['quantity3'];
				if ($service_edit_quantity3 == 0) {
					$service_edit_quantity3 = '';
				}			
				$service_edit_price3= $row['price3'];
				if ($service_edit_price3 == 0) {
					$service_edit_price3= '';
				}	
				$service_edit_quantity4= $row['quantity4'];
				if ($service_edit_quantity4 == 0) {
					$service_edit_quantity4 = '';
				}
				$service_edit_price4= $row['price4'];
				if ($service_edit_price4 == 0) {
					$service_edit_price4= '';
				}

			echo "<label for=\"add_service_name\">نام خدمت:</label><input type=\"text\" name=\"name\" id=\"add_service_name\" class=\"service_edit_name\" placeholder=\"نام خدمت*\" value=\"$service_edit_name\" required><br/>";
			
			echo "<label for=\"hide\">سرویس مناسبتی:</label><input type=\"text\" name=\"hide\" id=\"add_service_name\" class=\"service_edit_name\" placeholder=\"سرویس مناسبتی*\" value=\"$service_hide\" required><br/>";
			
						echo '<label for=\"hide\">نوع سرویس :</label><select id="dropdown" name="type">

 

    <option value="big" selected="selected">بزرگ 3X1</option>
       <option value="normal" selected="selected">متوسط 3X0.80</option>
    <option value="small" selected="selected">کوچک 2X1</option>
	    <option value="stand" selected="selected">استند 2X0.90</option>

    }
    ?>
  </select><br>
';
			
			echo "<label for=\"add_service_size\">ابعاد طول:</label><input type=\"text\" name=\"size\" id=\"add_service_size\" placeholder=\"ابعاد طول*\" value=\"$service_edit_size\" required>";
			
			echo "<label for=\"add_service_size\">ابعاد عرض:</label><input type=\"text\" name=\"size_h\" id=\"add_service_size\" placeholder=\"ابعاد*\" value=\"$service_edit_size_h\" required>";

			echo "<br> <label for=\"add_service_worktime\">مدت کار:</label><input type=\"number\" name=\"worktime\"id=\" add_service_worktime\" placeholder=\"تعداد روز کاری برای تحویل*\" value=\"$service_edit_work_time\" required><br/>";
			echo "<label for=\"add_service_quantity1\">تیراژ اول:</label><input type=\"number\" name=\"quantity1\" id=\"add_service_quantity1\" placeholder=\"تیراژ 1*\" value=\"$service_edit_quantity1\" required>";
			echo "<label for=\"add_service_price1\">قیمت اول:</label><input type=\"number\" name=\"price1\" id=\"add_service_price1\" placeholder=\"قیمت تیراژ 1*\" value=\"$service_edit_price1\" required><br/>";
			echo "<label for=\"add_service_quantity2\">تیراژ دوم:</label><input type=\"number\" name=\"quantity2\" id=\"add_service_quantity2\" placeholder=\"تیراژ 2\" value=\"$service_edit_quantity2\">";
			echo "<label for=\"add_service_price2\">قیمت دوم:</label><input type=\"number\" name=\"price2\" id=\"add_service_price2\" placeholder=\"قیمت تیراژ 2\" value=\"$service_edit_price2\"><br/>";
			echo "<label for=\"add_service_quantity3\">تیراژ سوم:</label><input type=\"number\" name=\"quantity3\" id=\"add_service_quantity3\" placeholder=\"تیراژ 3\" value=\"$service_edit_quantity3\">";
			echo "<label for=\"add_service_price3\">قیمت سوم:</label><input type=\"number\" name=\"price3\" id=\"add_service_price3\" placeholder=\"قیمت تیراژ 3\" value=\"$service_edit_price3\"><br/>";
			echo "<label for=\"add_service_quantity4\">تیراژ چهارم:</label><input type=\"number\" name=\"quantity4\" id=\"add_service_quantity4\" placeholder=\"تیراژ 4\" value=\"$service_edit_quantity4\">";
			echo "<label for=\"add_service_price4\">قیمت چهارم:</label><input type=\"number\" name=\"price4\" id=\"add_service_price4\" placeholder=\"قیمت تیراژ 4\" value=\"$service_edit_price4\"><br/>";
			echo "<input type=\"submit\" value=\"ثبت ویرایش خدمت\">";

			echo "</form>";
			
			
				
				if(isset($_POST['submit_add'])){
					mysqli_query($connection, "insert into meters(service,meter)values(".$id.",".$_POST['meter'].")");
					
					}
					if($_GET['do']='delete'){
					mysqli_query($connection, "delete from meters where meter_id=".$_GET['meter_id']);
					
					}
				
				$dbresult=mysqli_query($connection, "SELECT * FROM meters WHERE service = $id");
		while($row = mysqli_fetch_array($dbresult)){
			echo "<a href='?do=delete&meter_id=".$row['meter_id']."&id=".$id."'>حذف ".$row['meter']."</a><br>"; 		
		}
	mysqli_close($connection);
		?>
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