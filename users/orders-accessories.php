<?php require ("header.php");?>

	<section id="user-panel-sheet">
        <h2 class="user-panel-sheet-h2">لیست سفارشات</h2>
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

	$sql_orders_count = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user = '$username_value' ORDER BY order_id DESC");
	$RecordCount = mysqli_num_rows($sql_orders_count);
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



$search_num=$_POST['search_num'];
if (isset($search_num)){

	$sql_orders_of_user = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user='$username_value' and factor LIKE '%$search_num%' ORDER BY order_id DESC LIMIT $start , $end");



	}else{

	$sql_orders_of_user = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user = '$username_value' ORDER BY order_id DESC LIMIT $start , $end");
	}
							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");

?>

		<span class="print-button"><a href="javascript:window.print()">چاپ صفحه</a></span>
		<span class="print-button"><a href="new-order-accessories.php">ثبت سفارش جدید</a></span>
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages;

?> <br>
<br>
 <form action="orders-accessories.php" method="post">
    شماره فاکتور :    <input name="search_num" type="text" id="search_num">
        </form>
<br>
<br>
		<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
				<th>عنوان</th>
				<th class="th-darker">قیمت کل</th>
				<th>تاریخ ثبت</th>
				<th class="th-darker">قول تحویل</th>
				<th>اجازه چاپ</th>
				<th class="th-darker">اجازه تحویل</th>
				<th>آخرین وضعیت</th>
				<th class="th-darker">جزئیات</th>
                <th class="th-darker">پرداخت</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){



					if( $sql_orders['factor']!=0){

		$sql_invoice = $sql_orders['factor'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];

			}

					$sql_order_id = $sql_orders['order_id'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = jdate('Y/m/d h:i a',strtotime($sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_order_promise_date = jdate('Y/m/d h:i a',strtotime($sql_orders['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];

                    if ($sql_order_last_status == '0') {
                        $sql_invoice_is_paid= '<a href=financial.php?do=paid&invoiceID='.$sql_invoice.'><span class="red-text">پرداخت نشده</span></a>';

                    }
                    elseif ($sql_order_last_status > '0') {
                        $sql_invoice_is_paid= '<span class="green-text">پرداخت شده</span>';

                    }

					if ($sql_order_print_permission == '0') {
						$sql_order_pp = 'خیر';
					}
					elseif ($sql_order_print_permission == '1') {
						$sql_order_pp = 'بله';
					}
					else{
						$sql_order_pp = '';
					}

					if ($sql_order_delivery_permission == '0') {
						$sql_order_dp = 'خیر';
					}
					elseif ($sql_order_delivery_permission == '1') {
						$sql_order_dp = 'بله';
					}
					else{
						$sql_order_dp = '';
					}

					if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
					}
					else{
						$sql_order_ls = 'وضعیت نامشخص';
					}

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice</td>";
					echo "<td>$sql_order_type</td>";
					echo "<td class=\"th-darker\">$sql_order_total_price تومان</td>";
					echo "<td>$sql_order_submit_date</td>";
					echo "<td class=\"th-darker\">$sql_order_promise_date</td>";
					echo "<td>$sql_order_pp</td>";
					echo "<td class=\"th-darker\">$sql_order_dp</td>";
					echo "<td>$sql_order_ls</td>";
					echo "<td class=\"th-darker\"><a href=\"order-details-accessories.php?orderID=$sql_order_id\" target=\"_blank\">جزئیات</a></td>";
                    echo "<td class=\"th-darker\">$sql_invoice_is_paid</td>";
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
		  ?></ul>
		</div>
<br/>
<br/>

		<span class="print-button"><a href="javascript:window.print()">چاپ صفحه</a></span>
		<span class="print-button"><a href="new-order-accessories.php">ثبت سفارش جدید</a></span>




	</section>



<?php include ("footer.php");?>
