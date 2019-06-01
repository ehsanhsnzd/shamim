<?php require ("header.php");?>
<?php include ("sidebar.php");?>

<script type="text/javascript">
	$(function() {


				$('#datepicker4').datepicker({
					 changeMonth: true,
					 changeYear: true
			 });

					$('#datepicker5').datepicker({
							changeMonth: true,
							changeYear: true
					});


	});
</script>




<form id="user-panel-index-financial"  action="financial_list.php" method="post">       <h2 class="user-panel-sheet-h2">جزییات فاکتورها<?= $username?>
        از تاریخ :            <input type="text" id="datepicker4" class="inpts" name="datepicker1"  />
        تا تاریخ :            <input type="text" id="datepicker5" class="inpts" name="datepicker2"  />


  <input name="search" value="ثبت" type="submit"  class="profile-edit-submit" />
  <br />

</h2>
</form>

	<section id="user-panel-sheet">

<?php


	require ('../config.php');



if($_GET['err']=="nopayment"){
	echo "<span class=\"login-alert\"> پرداخت ناموفق</span><br><br><br><br><br>";
}



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

$order=	$_GET['order'];
$invoiceID = $_GET['invoiceID'];
 	require_once('../avclass.php');

// $total_discount= size_offer($username_value,$invoiceID,$do,$order);




	$balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$username_value' group by approved");
	$balance= mysqli_fetch_array($balance_user);
    $quantity_total=$balance['balance'];



		$fetch_invoice = mysqli_query($connection, "SELECT * FROM factor WHERE   id = $invoiceID  ");

		$fetch_amount=mysqli_fetch_assoc( $fetch_invoice);
		$amount=0-$fetch_amount['cash'];
		$amount_price=$fetch_amount['cash'];
		$is_paid=$fetch_amount['is_paid'];

if ($balance['balance']>=$amount_price  ){

		if($is_paid==1){

				echo "	<script type='text/javascript'>window.location.href='financial.php'</script>";
					die();
		}elseif($is_paid==0 && $amount_price>0){




	$date_now = date('Y-n-j H:i:s');

	$sql_paid_credit="insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total,invoice_id) values ('پرداخت فاکتور $invoiceID','".$date_now."','".$username_value."',".(float)$amount.",1,0,0,0,".(float)$quantity_total.",'$invoiceID')";

		if ($connection->query($sql_paid_credit) === TRUE && $invoiceID>0) {

 mysqli_query($connection , "UPDATE orders1 SET  order_last_status = '2' , order_submit_date= now()  WHERE order_invoice_code = '$invoiceID'");

	mysqli_query($connection , "UPDATE orders2 SET  order_last_status = '2' , order_submit_date= now()  WHERE order_invoice_code = '$invoiceID'");

            mysqli_query($connection , "UPDATE orders3 SET  order_last_status = '2' , order_submit_date= now()  WHERE order_invoice_code = '$invoiceID'");



		$sql_paid_invoice = "UPDATE factor SET is_paid = '1' ,	date_show= now(), order_last_status=6,order_description='پرداخت از حساب کاربری' WHERE id = $invoiceID";
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");

            mysqli_query($connection, "update users set last_date=now() WHERE login = '$username_value'");

		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه به حالت پرداخت شده تغییر یافت</span>";


		} else {
    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد لطفا مجددا امتحان کنید: " . $sql . "<br>" . $connection->error;
		}





		} else {
echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
		}



}



		}else{



	?>	<script type='text/javascript'>window.location.href='http://shamimgraphic.ir/users/payment.php?invoice='+'<?=$invoiceID ?>'</script>
		<?
		}
}




	$sql_invoices_count = mysqli_query($connection, "SELECT * FROM factor WHERE operator='$username_value' ORDER BY id DESC");
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

	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor WHERE operator='$username_value' ORDER BY id DESC LIMIT $start , $end");

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
				<th>چاپ</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['id'];
				    $sql_invoice_cash = $sql_invoices['cash'];
					$sql_invoice_create_date =  jdate('Y/m/d h:i a',strtotime($sql_invoices['date_create'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_invoice_deposit_date =  jdate('Y/m/d h:i a',strtotime($sql_invoices['date_show'].' +210 minutes'),'none','Iran/Tehran','fa');
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
					elseif ($sql_invoice_is_paid == '6') {
						$sql_invoice_is_paid= '<span class="red-text">کنسل شد</span>';
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
					echo "<td><a href=\"factor_print.php?invoiceID=$sql_invoice_code\"><span class=\"green-text\">پرینت</span></a></td>";
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
