<?php require ("header.php");?>
<?php include ("sidebar.php"); header("Refresh:30");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست سفارشات</h2><br>
<br>
<form action="ordersearch.php" method="post">
    شماره فاکتور :    <input name="search_num" type="text" id="search_num">
        </form>
<?php
	
	require ('../db_select.php');
$page=$_GET['page'];
	$sql_orders_number = mysqli_query($connection, "SELECT * FROM orders ORDER BY order_id DESC");
	$RecordCount = mysqli_num_rows($sql_orders_number);
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





	$sql_orders_of_user = mysqli_query($connection, "SELECT * FROM orders ORDER BY order_id DESC LIMIT $start , $end");



if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
			<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
				<th>نام کاربری</th>
				<th class="th-darker">نام و نام خانوادگی کاربر</th>
				<th>عنوان</th>
				<th class="th-darker">قیمت کل</th>
				<th>تاریخ ثبت</th>
				<th class="th-darker">اندازه</th>
				<th>اجازه چاپ</th>
				<th class="th-darker">اجازه تحویل</th>
				<th>آخرین وضعیت</th>
				<th class="th-darker">مشاهده</th>
				<th class=>ویرایش</th>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){

				
	 	
$sql_invoice = $sql_orders['order_invoice_code'];

					$sql_order_id = $sql_orders['order_id'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = $sql_orders['order_submit_date'];
					$sql_order_promise_date = $sql_orders['order_width'].X.$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_user = $sql_orders['order_user'];
				
				$sql_order_username_name = mysqli_query($connection, "SELECT display_name FROM user WHERE username='$sql_order_user'");
				$sql_username_name_result = mysqli_fetch_array($sql_order_username_name);
				$sql_order_user_realname = $sql_username_name_result['display_name'];
				
	$sql_od_file1 = $sql_orders['order_file4'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){
						$sql_od_file1_view = "<img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>";
					}
					else{
						$sql_od_file1_view = '';
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

$read_m=$sql_orders['read_m'];
			
			if($read_m!=1){
$read_m="class='th-darker_r'";

if($sql_order_type=='استیکر'){
	$read_m="class='th-darker_s'";
	
	}elseif($sql_order_type=='فلکس'){
	$read_m="class='th-darker_f'";

	
	}elseif($sql_order_type=='مش'){
	$read_m="class='th-darker_m'";
	
	}
				}else $read_m='';

				echo "<tr>";
					echo "<td $read_m>$c</td>";
					$c++;
					echo "<td  $read_m>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_order_total_price تومان</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_promise_date</td>";
					echo "<td $read_m>$sql_order_pp</td>";
					echo "<td  $read_m>$sql_order_dp</td>";
					echo "<td $read_m>$sql_order_ls</td>";
					echo "<td $read_m><a href=\"order-details.php?orderID=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\" >
					
					$sql_od_file1_view
					</a></td>";
					echo "<td $read_m><a href=\"order-edit.php?id=$sql_order_id\" target=\"_blank\"><span class=\"orders-table-edit-icon\"></span></a></td>";
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