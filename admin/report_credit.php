<?php require ("header.php");?>
<?php include ("sidebar.php");?>
<?
$username=$_GET['username'];
?>	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">گزارش پرداخت<?= $username?></h2>
    <a href="report_credit_all.php"> لیست کامل مالی</a>

<?php
	

	require ('../db_select.php');


	parse_str($_SERVER['QUERY_STRING']);

if (isset($do) && $do != '' && isset($invoiceID) && $invoiceID != '') {
	if ($do == 'delete') {
		 
	 
			$delete_invoice ="DELETE FROM invoices_mellat WHERE invoice_code='$invoiceID'";

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
		$sql_paid_invoice = "UPDATE invoices_mellat SET is_paid = $pay WHERE invoice_code = '$invoiceID'";		
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
 
	
	
	
		$sql_invoices = mysqli_query($connection, "SELECT CAST(invoice_create_date AS DATE) AS DATE_PURCHASED , sum(cash) as total_cash   FROM invoices_mellat where is_paid=1   group BY DATE_PURCHASED DESC");
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
	$sql_invoices_of_user = mysqli_query($connection, "SELECT CAST(invoice_create_date AS DATE) AS DATE_PURCHASED , sum(cash) as total_cash   FROM invoices_mellat where is_paid=1   group BY DATE_PURCHASED DESC LIMIT $start , $end");


	
 

?>

 
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>

		<table id="financial-invoices-table" width="70%">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">پرداخت اینترنتی</th>
				<th>اعتبار</th>
				<th class="th-darker">کل</th>
                
				<th>تاریخ</th>
				 
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_cash = $sql_invoices['total_cash'];	
					$sql_invoice_create_date = $sql_invoices['DATE_PURCHASED'];
					$persian_sql_invoice_create_date=jdate('Y/m/d h:i a',strtotime(	$sql_invoice_create_date .' +210 minutes'),'none','Iran/Tehran','fa');
 	$sql_credit = mysqli_query($connection, "select CAST(data AS DATE) AS DATE_PURCHASED  ,sum(quantity) as credit from credits_list  where data LIKE '$sql_invoice_create_date%'  and quantity>0     ");
$sql_credit_result = mysqli_fetch_assoc($sql_credit);
 					$sql_credit_total='<span class="green-text">'.$sql_credit_result['credit'].' تومان</span>';
					$sql_credit=max(0,$sql_credit_result['credit']-$sql_invoices['total_cash']);
						$sql_invoice_is_paid= '<span class="green-text">پرداخت شده</span>';
					$sql_payment_link ="<a href=\"financial_mellat.php?do=delete&invoiceID=$sql_invoice_code&username=$username\"><span class=\"adminpanel-delete-icon\"></span></a>";
				 
				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice_cash  تومان</td>";
					echo "<td>$sql_credit تومان</td>";
					echo "<td class=\"th-darker\">$sql_credit_total</td>";
					
					echo "<td>$persian_sql_invoice_create_date</td>";
					 
				echo "</tr>";



			}

                echo "<tr>";
                echo "<td colspan='3'>";
                    $sql_credit = mysqli_query($connection, "select  sum(quantity) as credit from credits_list       ");
                    $sql_credit_result = mysqli_fetch_assoc($sql_credit);
                  echo  $sql_credit_total='<span class="green-text"> اعتبار باقیمانده :'.$sql_credit_result['credit'].' تومان</span>';
				  echo"<a href=\"users_credit.php\">جزییات</a>";
                    echo "</td>";
                echo "</tr>";
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