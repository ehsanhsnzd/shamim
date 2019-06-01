<?php require ("header.php");?>
<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">

	<h2>افزودن خدمات</h2>

		<?php

	if(isset($_POST['name']) && $_POST['name'] != '' && 
	isset($_POST['size']) && $_POST['size'] != '' && 
	 
	isset($_POST['price1']) && $_POST['price1'] != '' && 
	isset($_POST['worktime']) && $_POST['worktime'] != ''){
	
	parse_str($_SERVER['QUERY_STRING']);

$photo_id=$_POST['photo_id'];
	$service_name = $_POST['name'];
		$service_name1 = $_POST['name1'];
			$service_name2 = $_POST['name2'];
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

	if (!isset($service_name) || $service_name == '' || !isset($service_size) || $service_size == '' ||   !isset($service_price1) || $service_price1 == ''){
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند را پر نمایید.</span>";
	}
	else{
		$sql = "UPDATE services3 SET name = '$service_name' ,name1 = '$service_name1' ,name2 = '$service_name2' , size = '$service_size' ,size_h = '$service_size_h' , quantity1 = '$service_quantity1' , price1 = '$service_price1' , quantity2 = '$service_quantity2' , price2 = '$service_price2' , quantity3 = '$service_quantity3' , price3 = '$service_price3' , quantity4 = '$service_quantity4' , price4 = '$service_price4' , work_time = '$service_worktime',hide='$service_hide',type='$type',photo_id='$photo_id'  WHERE id = $id";		
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

		$dbresult=mysqli_query($connection, "SELECT * FROM services3 WHERE id = $id");
		
		echo "<form id=\"service-add-form\" action=\"edit-service-accessories.php?id=$id&do=$do\" method=\"post\">"; 

		$row = mysqli_fetch_array($dbresult);
		$photo_id=$row['photo_id'];
				$service_edit_name= $row['name'];
				$service_edit_name1= $row['name1'];
				$service_edit_name2= $row['name2'];
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
?>
انتخاب عکس :
<select name="photo_id">
<option></option>
    <?   $dbresult=mysqli_query($connection, "SELECT * FROM service_photo"); 
		 
		while(	$service_type_row= mysqli_fetch_array($dbresult)){
		$photoid=$service_type_row['id'] ;
		$photoname=$service_type_row['name'] ;?>
         
        <option value="<?=$photoid?>" <? if($photoid=="$photo_id"){ echo "selected";};?>  ><?=$photoname?></option>
         <? }?>
       
        </select> <br>

<?

echo "<label for=\"add_service_name1\">نام خدمت:</label><input type=\"text\" name=\"name1\" id=\"add_service_name\" class=\"service_edit_name1\" placeholder=\"نام خدمت*\" value=\"$service_edit_name1\" required><br/>";

echo "<label for=\"add_service_name2\">نام خدمت:</label><input type=\"text\" name=\"name2\" id=\"add_service_name\" class=\"service_edit_name2\" placeholder=\"نام خدمت*\" value=\"$service_edit_name2\" required><br/>";

			echo "<label for=\"add_service_name\">نام خدمت:</label><input type=\"text\" name=\"name\" id=\"add_service_name\" class=\"service_edit_name\" placeholder=\"نام خدمت*\" value=\"$service_edit_name\" required><br/>";
			
 
 
			
			echo "<label for=\"add_service_size\">ابعاد طول:</label><input type=\"text\" name=\"size\" id=\"add_service_size\" placeholder=\"ابعاد طول*\" value=\"$service_edit_size\" required>";
			
			echo "<label for=\"add_service_size\">ابعاد عرض:</label><input type=\"text\" name=\"size_h\" id=\"add_service_size\" placeholder=\"ابعاد*\" value=\"$service_edit_size_h\" required>";

			echo "<br> <label for=\"add_service_worktime\">مدت کار:</label><input type=\"number\" name=\"worktime\"id=\" add_service_worktime\" placeholder=\"تعداد روز کاری برای تحویل*\" value=\"$service_edit_work_time\" required><br/>";
		
			echo "<label for=\"add_service_price1\">قیمت :</label><input type=\"number\" name=\"price1\" id=\"add_service_price1\" placeholder=\"قیمت \" value=\"$service_edit_price1\" required><br/>";
		
echo "<input type=\"submit\" value=\"ثبت ویرایش خدمت\">";
			echo "</form>";
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