<?php 
	session_start();
	if ($_SESSION['print_admin'] !== '#$ok*%'){
		header("location: ../admin/login.php");
	}
?>
<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>پنل مدیریت | شمیم</title>
    	
	<link rel="stylesheet" type="text/css" href="../admin/library/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../admin/library/main.js"></script>
    <link type="text/css" href="styles/jquery-ui-1.8.14.css" rel="stylesheet" />
      <script type="text/javascript" src="scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="scripts/calendar.js"></script>

    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc-fa.js"></script>

    <script type="text/javascript">
	    $(function() {
	     
	        // استفاده از dropdown
	        $('#datepicker1').datepicker({
	            changeMonth: true,
	            changeYear: true
	        });
			
			       $('#datepicker2').datepicker({
	            changeMonth: true,
	            changeYear: true
	        });
			      $('#datepicker3').datepicker({
	            changeMonth: true,
	            changeYear: true
	        });
			
				      $('#datepicker4').datepicker({
	            changeMonth: true,
	            changeYear: true
	        });
	        //-----------------------------------
 
	    });
    </script>
    
    <script>
 
     function refresh() {
		 
		 
 setTimeout(function(){
window.location.reload();
  },1000)
     }

 
</script>

    <style type="text/css">
        *
      
		p.ui-state-hover
		{
			font-weight: normal;
		}
        p.ui-widget-header
        {
            text-align: center;
            font-weight: normal;
        }
        strong.ui-state-error
        {
            display: block;
            padding: 3px;
            text-align: center;
        }
    </style>
</head>
<body>


<?
$username=$_GET['username'];
?>	

        <h2 class="user-panel-sheet-h2">لیست فاکتور های شرکت<?= $username?></h2>

<?php
	

	require ('../db_select.php');


	parse_str($_SERVER['QUERY_STRING']);

if (isset($do) && $do != '' && isset($invoiceID) && $invoiceID != '') {
	if ($do == 'delete') {
		 
	 
			$delete_invoice ="DELETE FROM invoices WHERE invoice_code='$invoiceID'";

			if (!mysqli_query($connection,$delete_invoice))
			{
			die('Error: ' . mysqli_error());
				echo "مشکلی در روند حذف فاکتور به وجود آمد و فاکتور حذف نگردید.";
			}
			else{
			echo "<span class=\"done-alert\">فاکتور مورد نظر با موفقیت حذف گردید.</span>";
			}
		 include('../avclass.php');
		 
		 del_invoice($username);
	}
	elseif ($do == 'paid') {
		$sql_paid_invoice = "UPDATE invoices SET is_paid = $pay WHERE invoice_code = '$invoiceID'";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه   تغییر یافت</span>";
		} else {
    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
		}
	}
}
if (isset($username)){
	
	$username_text="&username=$username";
	
	$sql1=
	
	$sql_invoices = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 where order_user='$username'
GROUP BY fc
");
	$RecordCount = mysqli_num_rows($sql_invoices);
	$showRecord = 40;
	$pages = ceil($RecordCount / $showRecord);


	if(isset($page) && $page != '' && $page >=  1){
		$pageuse = $page - 1;
		$start = ($pageuse * $showRecord);
		$end = $showRecord;
	}
	else{
		$start = 0;
		$end = $showRecord;
	}
	$sql_invoices_of_user = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 where order_user='$username'
GROUP BY fc

	 DESC LIMIT $start , $end");
}else{
	
	
	
		$sql_invoices = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 where factor =$factor
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1 where order_make_number_perforating=$factor
  GROUP 
    BY order_make_number_perforating 
) as t3 
GROUP BY fc
DESC ");
	$RecordCount = mysqli_num_rows($sql_invoices);
	$showRecord = 40;
	$pages = ceil($RecordCount / $showRecord);


	if(isset($page) && $page != '' && $page >=  1){
		$pageuse = $page - 1;
		$start = ($pageuse * $showRecord);
		$end = $showRecord;
	}
	else{
		$start = 0;
		$end = $showRecord;
	}
	$sql_invoices_of_user = mysqli_query($connection, "
	
	SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3
GROUP BY fc

	 DESC LIMIT $start , $end");

	}


?>


 
	
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>

		<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
                <th >کاربر</th>
				<th  class="th-darker">بنر</th>
				<th >افست</th>
                <th class="th-darker">مبلغ کل</th>
			
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['fc'];
					$sql_invoice_cash = $sql_invoices['cash'];
					$sql_invoice_cash_off = $sql_invoices['cash_off'];
					$sql_invoice_create_date = $sql_invoices['invoice_create_date'];
					$sql_invoice_deposit_date = $sql_invoices['deposit_date'];
					$sql_invoice_comment = $sql_invoices['comment'];
					$sql_invoice_is_paid = $sql_invoices['is_paid'];
						$sql_user= $sql_invoices['order_user'];
					if (is_null($sql_invoice_deposit_date)) {
						$sql_invoice_deposit_date = '-';
					}
					if ($sql_invoice_is_paid == '0') {
						$sql_invoice_is_paid= '<span class="red-text">پرداخت نشده</span>';
						$sql_payment_link ="<a href=\"financial.php?do=delete&invoiceID=$sql_invoice_code&username=$username\"><span class=\"adminpanel-delete-icon\"></span></a>";
						$sql_is_paid_change_link = "<a href=\"financial.php?do=paid&invoiceID=$sql_invoice_code&pay=1&username=$username\">تغییر وضعیت به پرداخت شده</a>";
					}
					elseif ($sql_invoice_is_paid == '1') {
						$sql_invoice_is_paid= '<span class="green-text">پرداخت شده</span>';
					$sql_payment_link ="<a href=\"financial.php?do=delete&invoiceID=$sql_invoice_code&username=$username\"><span class=\"adminpanel-delete-icon\"></span></a>";
						$sql_is_paid_change_link = "<a href=\"financial.php?do=paid&invoiceID=$sql_invoice_code&pay=0&username=$username\">تغییر وضعیت به پرداخت نشده</a>";
					}

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice_code</td>";
					echo "<td class=\"th-darker\">$sql_user</td>";
					echo "<td  valign=\"top\">";
					
						
	if(!empty($sql_invoice_code)){
					
					$sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$sql_invoice_code");
					while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){
						
							$sql_banner_total_price = $sql_banner['order_total_price'];
					  $sql_order_submit_date=jdate('Y/m/d h:i a',strtotime(   $sql_banner['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');					 			
					  		$sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
					
					
						$sql_order_promise_date = $sql_banner['order_width']."X".$sql_banner['order_height'];
							$sql_order_last_status = $sql_banner['order_last_status'];
						
						if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_order_last_status == '5') {
						$sql_order_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_order_last_status == '6') {
						$sql_order_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}
					elseif ($sql_order_last_status == '7') {
						$sql_order_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_order_last_status == '8') {
						$sql_order_ls = 'تحویل مشتری';
						$od_ls_7 = 'selected';
					}
					
					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
						
						echo "<table>";
						
					
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td  $read_m>$sql_order_promise_date</td>";
					echo "<td $read_m>$sql_order_ls</td>";
						echo "</table>";
					}}
					
					echo "</td>";
					echo "<td class=\"th-darker\" valign=\"top\">";
					
						
	$order_of_offset=  "SELECT * FROM orders2 where factor=$sql_invoice_code " ;
	
	
	if(!empty($sql_invoice_code)){
			$sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
						while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
					$sql_offset_total_price = $sql_offset['order_total_price'];
					$sql_order_type = $sql_offset['order_type'];
					$sql_order_total_price = $sql_offset['order_total_price'];
					$sql_order_submit_date = jdate('Y/m/d h:i a',strtotime(   $sql_offset['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
			 					 					$sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
					$sql_order_print_permission = $sql_offset['order_print_permission'];
					$sql_order_delivery_permission = $sql_offset['order_delivery_permission'];
					
					$permission = $sql_offset['order_delivery_permission'];
					$sql_order_last_status = $sql_offset['order_last_status'];
					
					
						if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_order_last_status == '5') {
						$sql_order_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_order_last_status == '6') {
						$sql_order_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}
					elseif ($sql_order_last_status == '7') {
						$sql_order_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_order_last_status == '8') {
						$sql_order_ls = 'تحویل مشتری';
						$od_ls_7 = 'selected';
					}
					
					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
					
					echo"<table>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_type</td>";
			 
					echo "<td $read_m>$sql_order_ls</td>";
					echo "</table>";
						}
					echo "</td>";
					
					$total_price=$sql_offset_total_price +$sql_banner_total_price;
					echo "<td class=\"th-darker\" valign=\"top\">$total_price تومان</td>";
					
				echo "</tr>";
$total_price=0;
 

			}}
			?>
			
		</table>

		<div id="paging">
			<ul><?php
				if(isset($page) && $page != '' && $page >=  1){
					$backpage = $page - 1;
					$nextpage = $page + 1; 
				}
				elseif(isset($page) && $page != '' && $page == $pages) {
					$backpage = $page - 1;
					$nextpage = '';
				}
				else{
					$nextpage = 2; 
				}
				if(isset($backpage) && $backpage != '' && $backpage >= 1){
					echo "<a href=\"?page=$backpage$username_text\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i$username_text\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage$username_text\"><li>صفحه بعد</li></a>";
				}
		  ?></ul>	
		</div>


