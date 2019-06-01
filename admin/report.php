<?php require ("header.php");?>
<?php include ("sidebar.php");  ?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">گزارش روزانه چاپ</h2><br>
<br>
<?php
	
	require ('../db_select.php');
$page=$_GET['page'];
	$sql_orders_number = mysqli_query($connection, "SELECT * FROM orders1 group BY order_submit_date DESC");
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















$order_of_user_query="SELECT * ,sum(order_width * order_height * order_lot_quantity) as m ,sum(order_lot_quantity) as num FROM orders1 group BY DATE(order_submit_date) DESC LIMIT $start , $end ";
	
		$sql_orders_of_user= mysqli_query($connection, $order_of_user_query);


if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
			<table id="financial-invoices-table" width="70%">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">تاریخ</th>
				<th> تعداد</th>
				<th class="th-darker">متراژ</th>
				
			</tr>
			<tr><?php
				$c = '1';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){

				
	 	
$sql_invoice = $sql_orders['order_invoice_code'];

					$sql_order_id = $sql_orders['order_id'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
				$sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');					 					$sql_od_lot_quantity = $sql_orders['num'];
					$multiply = $sql_orders['m']/10000;
					
					
						$sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
					
					$permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_user = $sql_orders['order_user'];

                $connection = mysql_connect($server_name, $db_username, $db_password);
                if(!$connection){
                    die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                }
                mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



                $sql_order_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$sql_order_user'");
                $sql_order_username_name_result = mysql_fetch_array($sql_order_username_name);
                $sql_order_user_realname = $sql_order_username_name_result['name']." ".$sql_order_username_name_result['lastname'];

                $connection = mysqli_connect($server_name, $db_username, $db_password);
                if(!$connection){
                    die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                }
                mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                mysqli_query($connection, "SET NAMES 'utf8'");
                mysqli_query($connection, "SET CHARACTER SET 'utf8'");
                mysqli_query($connection, "SET character_set_connection = 'utf8'");
				
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
  
?>
				 <tr>
                <?
					echo "<td $read_m>$c</td>";
					
					echo "<td  $read_m >$sql_order_submit_date</td>";
					echo "<td $read_m>	$sql_od_lot_quantity </td>";
					echo "<td  $read_m>$multiply متر</td>";
		 
					 
					
					
					
					
					
					 
					
		$c++;			
				echo "</td></tr> ";
			}
			?>
			
		</table>



		<div id="paging">
			<ul><?php 
			
			
			if(isset($_GET['unprint'])){$unprint_link= "&unprint=".$_GET['unprint'];}
			
			
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
					echo "<a href=\"?page=$backpage$unprint_link\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i$unprint_link\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage$unprint_link\"><li>صفحه بعد</li></a>";
				}
		  ?></ul>	
		</div>


	</section>

<?php include ("footer.php"); ?>