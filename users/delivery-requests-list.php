<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-sheet">
	
        <h2 class="user-panel-sheet-h2">لیست درخواست های ارسال مرسوله</h2>
	
        
        
        <?php

	require ('../db_select.php');
        
	parse_str($_SERVER['QUERY_STRING']);

	$username_value = $_SESSION['print_username'];


	$sql_delivery_count = mysqli_query($connection, "SELECT * FROM delivery WHERE username = '$username_value' ORDER BY delivery_id DESC");
	$RecordCount = mysqli_num_rows($sql_delivery_count);
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

	$sql_delivery_request = mysqli_query($connection, "SELECT * FROM delivery WHERE username = '$username_value' ORDER BY delivery_id DESC LIMIT $start , $end");


if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
		<table id="delivery-reqests-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره درخواست</th>
				<th>نام کاربری</th>
				<th class="th-darker">شماره سفارش ها</th>
				<th>آدرس گیرنده</th>
				<th class="th-darker">نام گیرنده</th>
				<th>تاریخ درخواست</th>
				<th class="th-darker">وضعیت</th>
				<th>تاریخ ارسال</th>
				<th class="th-darker">توضیحات</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_delivery = mysqli_fetch_array($sql_delivery_request)){

					$sql_delivery_id = $sql_delivery['delivery_id'];
					$sql_delivery_username = $sql_delivery['username'];
					$sql_delivery_orders_num = $sql_delivery['orders_number'];
					$sql_delivery_adress = $sql_delivery['delivery_adress'];
					$sql_delivery_reciver_name = $sql_delivery['receiver_name'];
					$sql_delivery_req_date = $sql_delivery['request_date'];
					$sql_delivery_status = $sql_delivery['status'];
					$sql_delivery_date = $sql_delivery['delivery_date'];
					$sql_delivery_details = $sql_delivery['details'];

					if (!isset($sql_delivery_date) || $sql_delivery_date == ''){
						$sql_delivery_date = '-';
					}

					if ($sql_delivery_status == '0') {
						$sql_delivery_status = 'در انتظار بررسی';
					}
					elseif ($sql_delivery_status == '1') {
						$sql_delivery_status = 'مرسوله فرستاده شده است';
					}
					elseif ($sql_delivery_status == '2') {
						$sql_delivery_status = 'ارسال مرسوله کنسل شده است';
					}

					if (!isset($sql_delivery_details) || $sql_delivery_details == '') {
						$sql_delivery_details = '-';
					}

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_delivery_id</td>";
					echo "<td>$sql_delivery_username</td>";
					echo "<td class=\"th-darker\">$sql_delivery_orders_num</td>";
					echo "<td>$sql_delivery_adress</td>";
					echo "<td class=\"th-darker\">$sql_delivery_reciver_name</td>";
					echo "<td>$sql_delivery_req_date</td>";
					echo "<td class=\"th-darker\">$sql_delivery_status</td>";
					echo "<td>$sql_delivery_date</td>";
					echo "<td class=\"th-darker\">$sql_delivery_details</td>";
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

<?php include ("footer.php");?>
