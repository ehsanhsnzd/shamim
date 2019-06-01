<?php require ("header.php");?>
<?php include ("sidebar.php");?>
<?
$username=$_GET['username'];
?>	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست فاکتور ها<?= $username?></h2>

<?php


	require ('../db_select.php');


	parse_str($_SERVER['QUERY_STRING']);
if (isset($do) && $do != '' && $do == 'delete') {
if ( isset($invoiceID) && $invoiceID != '' && $invoiceID!="all") {



			$delete_invoice ="DELETE FROM factor WHERE id='$invoiceID'";

			if (!mysqli_query($connection,$delete_invoice))
			{
			die('Error: ' . mysqli_error());
				echo "مشکلی در روند حذف فاکتور به وجود آمد و فاکتور حذف نگردید.";
			}
			else{
                mysqli_query($connection,"UPDATE orders1 set order_last_status=0 WHERE order_invoice_code=$invoiceID");
                mysqli_query($connection,"UPDATE orders2 set order_last_status=0 WHERE order_invoice_code=$invoiceID");
                mysqli_query($connection,"UPDATE orders3 set order_last_status=0 WHERE order_invoice_code=$invoiceID");
			echo "<span class=\"done-alert\">فاکتور مورد نظر با موفقیت حذف گردید.</span>";
			}


		 del_invoice($username);
	}elseif($invoiceID=="all"){

    	$delete_invoice ="DELETE FROM factor WHERE is_paid=0";

			if (!mysqli_query($connection,$delete_invoice))
			{
			die('Error: ' . mysqli_error());
				echo "مشکلی در روند حذف فاکتور ها به وجود آمد و فاکتور حذف نگردید.";
			}
			else{

                mysqli_query($connection,"DELETE FROM orders1 WHERE order_last_status=0");
                mysqli_query($connection,"DELETE FROM orders2 WHERE order_last_status=0");
                mysqli_query($connection,"DELETE FROM orders3 WHERE order_last_status=0");


                echo "<span class=\"done-alert\">فاکتور ها با موفقیت حذف گردید.</span>";
			}



}
}
	elseif ( isset($do) && $do != '' && $do == 'paid') {
		$sql_paid_invoice = "UPDATE factor SET is_paid = $pay WHERE id = '$invoiceID'";
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه   تغییر یافت</span>";
		} else {
    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
		}
	}

if (isset($username)){

	$sql1=

	$sql_invoices = mysqli_query($connection, "SELECT * FROM factor where operator='$username' ORDER BY id DESC");
	$RecordCount = mysqli_num_rows($sql_invoices);
	$showRecord = 20;
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
	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where operator='$username' ORDER BY id DESC LIMIT $start , $end");
}else{



		$sql_invoices = mysqli_query($connection, "SELECT * FROM factor ORDER BY id  DESC");
	$RecordCount = mysqli_num_rows($sql_invoices);
	$showRecord = 20;
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
	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor   ORDER BY id DESC LIMIT $start , $end");



	}


?>


<a href="add-invoice.php" class="addinvoicelink">افزودن فاکتور</a>
<a  onclick="return  confirm('آیا مطمئن به حذف همه سفارشات در انتظار پرداخت هستید؟')" href="financial.php?do=delete&invoiceID=all" class="addinvoicelink"> حذف پرداخت نشده ها</a>
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
        <th class="th-darker">اپراتور</th>
				<th>مبلغ فاکتور</th>
				<th class="th-darker">تاریخ ایجاد فاکتور</th>
				<th>وضعیت پرداخت</th>
				<th class="th-darker">تاریخ پرداخت</th>
				<th>حذف</th>
				<th class="th-darker">تغییر وضعیت به پرداخت شده</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['id'];
					$sql_invoice_cash = $sql_invoices['cash'];
          $sql_invoice_operator = $sql_invoices['operator'];
					$sql_invoice_cash_off = $sql_invoices['cash_off'];
					$sql_invoice_create_date =jdate('Y/m/d h:i a',strtotime(  $sql_invoices['date_create'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_invoice_deposit_date = jdate('Y/m/d h:i a',strtotime( $sql_invoices['date_show'].' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_invoice_comment = $sql_invoices['comment'];
					$sql_invoice_is_paid = $sql_invoices['is_paid'];

					if (is_null($sql_invoice_deposit_date)) {
						$sql_invoice_deposit_date = '-';
					}
					if (!empty($username)){
					$userinfo="&username=$username";}
					if ($sql_invoice_is_paid == '0') {
						$sql_invoice_is_paid= '<span class="red-text">پرداخت نشده</span>';
						$sql_payment_link ="<a href=\"financial.php?do=delete&invoiceID=$sql_invoice_code\"><span class=\"adminpanel-delete-icon\"></span></a>";
						$sql_is_paid_change_link = "<a href=\"financial.php?do=paid&invoiceID=$sql_invoice_code&pay=1&username=$username\">تغییر وضعیت به پرداخت شده</a>";
					}
					elseif ($sql_invoice_is_paid == '1') {
						$sql_invoice_is_paid= '<span class="green-text">پرداخت شده</span>';
					$sql_payment_link ="<a href=\"financial.php?do=delete&invoiceID=$sql_invoice_code&username=$username\"><span class=\"adminpanel-delete-icon\"></span></a>";
						$sql_is_paid_change_link = "-";
					}

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice_code</td>";
					echo "<td><small>$sql_invoice_comment</small></td>";
          echo "<td class=\"th-darker\">$sql_invoice_operator</td>";
					echo "<td>$sql_invoice_cash تومان</td>";
					echo "<td class=\"th-darker\">$sql_invoice_create_date</td>";
					echo "<td>$sql_invoice_is_paid</td>";
					echo "<td class=\"th-darker\">$sql_invoice_deposit_date</td>";
					echo "<td>$sql_payment_link</td>";
					echo "<td class=\"th-darker\">$sql_is_paid_change_link</td>";
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

</section>

<?php include ("footer.php"); ?>
