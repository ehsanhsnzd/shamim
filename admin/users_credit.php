<?php require ("header.php");?>
<?php include ("sidebar.php");?>
<?
$username=$_GET['username'];
?>	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">گزارش پرداخت<?= $username?></h2>

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
 
	
	
	
		$sql_invoices = mysqli_query($connection, "SELECT  user , sum(quantity) as total_cash   FROM credits_list  GROUP BY user");
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
	$sql_invoices_of_user = mysqli_query($connection, "SELECT user , sum(quantity) as total_cash   FROM credits_list GROUP BY user DESC LIMIT  $start , $end");


	
 

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
				<th class="th-darker">کاربر</th>
				<th>اعتبار</th>
				 
				 
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_cash = $sql_invoices['total_cash'];	
					$sql_invoice_user = $sql_invoices['user'];	
					 $sql_credit_total='<span class="green-text">'.$sql_invoices['total_cash'].' تومان</span>';
					  $sql_user = mysqli_query($connection,"SELECT * FROM users WHERE    login = '$sql_invoice_user' ");
					  $sql_user_result = mysqli_fetch_array($sql_user);
					  $user_id= $sql_user_result['id_parent'];
					 
					$sql_payment_link ="<a href=\"edit-user.php?id=$user_id\">جزییات</a>";
					
				if($sql_invoice_cash>0){ 
				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					
					echo "<td class=\"th-darker\">$sql_invoice_user</td>";
					
					echo "<td  >$sql_credit_total</td>";
					
					 echo "<td  class=\"th-darker\"> 	$sql_payment_link</td>";
					 
				echo "</tr>";
				}


			}

                echo "<tr>";
                echo "<td colspan='3'>";
                    $sql_credit = mysqli_query($connection, "select  sum(quantity) as credit from credits_list       ");
                    $sql_credit_result = mysqli_fetch_assoc($sql_credit);
                  echo  $sql_credit_total='<span class="green-text"> اعتبار کل :'.$sql_credit_result['credit'].' تومان</span>';
				  
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