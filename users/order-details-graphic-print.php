<?php
	session_start();
	if ($_SESSION['print_user'] !== 'ok'){
		header("location: login.php");
	}
?>

<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | پنل کاربران</title>
	<link rel="stylesheet" type="text/css" href="../users/library/style.css">
    <link rel="stylesheet" type="text/css" href="../library/css/style.css">
 
<meta charset=utf-8 />
 
<link rel="stylesheet" href="library/nav.css" type="text/css"  />


   
    
    <!-- js -->
<script src="../users/library/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
        $( '.dropdown' ).hover(
            function(){
                $(this).children('.sub-menu').slideDown(200);
            },
            function(){
                $(this).children('.sub-menu').slideUp(200);
            }
        );
    }); // end ready
</script>
 
 
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->    

	<script type="text/javascript" src="/library/jquery-2.2.0.min.js"></script>
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../users/library/jquery.js" type="text/javascript"></script>
   
<script src="../users/library/main-photo.js" type="text/javascript"></script>
    

	<script type="text/javascript" src="../users/library/main.js"></script>
	<script src="../users/library/dropzone.js"></script>
 
	<link rel="stylesheet" href="../users/library/dropzone.css">
    
     <link rel="stylesheet" type="text/css" href="../library/assets/animate.css" />





   <link type="text/css" href="../admin/styles/jquery-ui-1.8.14.css" rel="stylesheet" />
      <script type="text/javascript" src="../admin/scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../admin/scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="../admin/scripts/calendar.js"></script>

    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc-fa.js"></script>

    <script type="text/javascript">
	    $(function() {
	     
 

	 
	 $('#datepicker').datepicker({
    onSelect: function(dateText, inst) { 
        window.location = '?service=<?=$_GET['service']?>&quantity=1th&type=<?=$_GET['type']?>&date=' + dateText;
    }
});
	 
	 
	        //-----------------------------------
 
	    });
    </script>  
    
      <script>
						
						$(function() {

$("img").click(function() {

    $("img").not(this).removeClass("hover");

    $(this).toggleClass("hover");

  });
 

});
	 function changeText(value,el) {
     document.getElementById('bannerc').value = value;   
 
 
}



 

 
</script>	
  
 
  
 
 
<link rel="stylesheet" type="text/css" href="../templates/template20/style.css">
 
 
 
  
  
</head>
<body>
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

	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_user = '$username_value' AND order_id = '$orderID'");


				$sql_od = mysqli_fetch_array($sql_order_details);

					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_f_start = $sql_od['factor_start'];
					$sql_od_size = $sql_od['order_size'];
					$sql_od_quantity = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];	
					$sql_od_lot_quantity = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = $sql_od['order_submit_date'];
					$sql_od_promise_date = $sql_od['order_promise_date'];

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
					if (!isset($sql_od_description) || $sql_od_description == '') 			{
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
						elseif ($sql_order_last_status == '8') {
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
								
						if(!empty($sql_od_f_start)){		
									echo "<p>شروع شماره فاکتور: <span class=\"order-detail-bg\">$sql_od_f_start</span></p>";
						}
									
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

 