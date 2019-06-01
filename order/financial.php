<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-sheet">
	
<?php
	

	require ('../config.php');

	$connection = mysqli_connect($server_name, $db_username, $db_password);
		if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

	parse_str($_SERVER['QUERY_STRING']);

	$username_value = $_SESSION['print_username'];
							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");




	
if ($do == 'paid') {
	
	$balance_user = mysqli_query($connection, "SELECT * FROM user WHERE username='$username_value'  ");
	$balance= mysqli_fetch_array($balance_user);
	
	
			 
				 		
		$fetch_invoice = mysqli_query($connection, "SELECT * FROM invoices WHERE   invoice_code = '$invoiceID'  ");
		
		$fetch_amount=mysqli_fetch_assoc( $fetch_invoice);
		$amount=$fetch_amount['cash'];
		$is_paid=$fetch_amount['is_paid'];
	
if ($balance['balance']>=$amount  ){
	
if($is_paid==1){ 
echo "	<script type='text/javascript'>window.location.href='financial.php'</script>";
die();
}
	
	
if(!	mysqli_query($connection, "update user set balance=balance-$amount  WHERE username='$username_value'")){ echo mysqli_error($connection);}
	
		$sql_paid_invoice = "UPDATE invoices SET is_paid = '1' WHERE invoice_code = '$invoiceID'";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه به حالت پرداخت شده تغییر یافت</span>";
		} else {
    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
		}}else{ echo "<br><br><span style='color:red'> هزینه فاکتور از حساب شما بیشتر است!</span>";
		

	?>	<script type='text/javascript'>window.location.href='payment.php?invoice='+'<?=$invoiceID ?>'</script>
		<?
		}
}	 
		 
		 
	

	$sql_invoices_count = mysqli_query($connection, "SELECT * FROM invoices WHERE username='$username_value' ORDER BY invoice_code DESC");
	$RecordCount = mysqli_num_rows($sql_invoices_count);
	$showRecord = 10;
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

	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM invoices WHERE username='$username_value' ORDER BY invoice_code DESC LIMIT $start , $end");

							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");


?>
	
	<h2 class="user-panel-sheet-h2">لیست فاکتور ها</h2>

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
				<th>عنوان</th>
				<th class="th-darker">مبلغ فاکتور</th>
				<th>تاریخ ایجاد فاکتور</th>
				<th class="th-darker">وضعیت پرداخت</th>
				<th>تاریخ پرداخت</th>
				<th class="th-darker">پرداخت</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['invoice_code'];
				    $sql_invoice_cash = $sql_invoices['cash'];
					$sql_invoice_create_date = $sql_invoices['invoice_create_date'];
					$sql_invoice_deposit_date = $sql_invoices['deposit_date'];
					$sql_invoice_comment = $sql_invoices['comment'];
					$sql_invoice_is_paid = $sql_invoices['is_paid'];

					if (is_null($sql_invoice_deposit_date)) {
						$sql_invoice_deposit_date = '-';
					}
					if ($sql_invoice_is_paid == '0') {
						$sql_invoice_is_paid= '<span class="red-text">پرداخت نشده</span>';
						$sql_payment_link ='<a href=?do=paid&invoiceID='.$sql_invoice_code.'> پرداخت </a>';
					}
					elseif ($sql_invoice_is_paid == '1') {
						$sql_invoice_is_paid= '<span class="green-text">پرداخت شده</span>';
						$sql_payment_link ='';
					}

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice_code</td>";
					echo "<td>$sql_invoice_comment</td>";
					echo "<td class=\"th-darker\">$sql_invoice_cash تومان</td>";
					echo "<td>$sql_invoice_create_date</td>";
					echo "<td class=\"th-darker\">$sql_invoice_is_paid</td>";
					echo "<td>$sql_invoice_deposit_date</td>";
					echo "<td class=\"th-darker\">$sql_payment_link</td>";
				echo "</tr>";
			}
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
					echo "<a href=\"?page=$backpage\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage\"><li>صفحه بعد</li></a>";
				}
		 
		 
		?> 
		 
</ul>	
		</div> 

	
	</section>

<?php include ("footer.php");?>
