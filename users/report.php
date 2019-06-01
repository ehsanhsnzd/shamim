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



$sql_invoices = mysqli_query($connection, "select * from credits_list  where  user='$username_value' ");
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
$sql_invoices_of_user = mysqli_query($connection, "select * from credits_list  where  user='$username_value' ORDER BY id_parent  DESC LIMIT $start , $end  ");



?>

<h3>گزارش مالی</h3>

        <?php

        if(!isset($page) || $page == ''){
            $page = 1;
        }
        echo "<br/> صفحه ی ".$page ." از ".$pages;

        ?><br>
 

	<table id="financial-invoices-table" width="95%">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره </th>
				<th>عنوان</th>
				<th class="th-darker">مبلغ</th>
                <th class="th-darker">بدهکار</th>
                <th class="th-darker">بستانکار</th>
                <th class="th-darker">مانده</th>
                <th>تاریخ ایجاد</th>
				<th class="th-darker">وضعیت تایید</th>
	 
			 
		 
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['id_parent'];
					$sql_invoice_cash = number_format($sql_invoices['quantity']);
                    $sql_invoice_cash_int = $sql_invoices['quantity'];
                    $sql_invoice_cash_total=number_format($sql_invoices['quantity_total']);
                    $sql_invoice_id=$sql_invoices['invoice_id'];
			 if($sql_invoice_cash<0){
				 $sql_invoice_cash='<span class="red-text">'. $sql_invoice_cash.' تومان</span>';
			 }else{ $sql_invoice_cash='<span class="green-text">'. $sql_invoice_cash.' تومان</span>';}
			 if($sql_invoice_cash_int>0){
                 $sql_invoice_cash_out='';
			     $sql_invoice_cash_in=$sql_invoice_cash;}else{
                 $sql_invoice_cash_in='';
                 $sql_invoice_cash_out=$sql_invoice_cash;
             }
					$sql_invoice_comment = $sql_invoices['title'];
					$sql_invoice_is_paid = $sql_invoices['approved'];
					$sql_invoice_create_date=   jdate('Y/m/d h:i a',strtotime( $sql_invoices['data'].' +210 minutes'),'none','Iran/Tehran','fa');

					if (is_null($sql_invoice_deposit_date)) {
						$sql_invoice_deposit_date = '-';
					}
					if ($sql_invoice_is_paid == '0') {
						$sql_invoice_is_paid= '<span class="red-text">تایید نشده</span>';
						 
						 
					}
					elseif ($sql_invoice_is_paid == '1') {
						$sql_invoice_is_paid= '<span class="green-text">تایید شده</span>';
						
						$sql_is_paid_change_link = '-';
					}
					
					$id_user=$_GET['id'];
					$sql_payment_link ="<a href=\"?id=$id_user&do=delete&id_parent=$sql_invoice_code\"><span class=\"adminpanel-delete-icon\"></span></a>";

				echo "<tr>";
					echo "<td>$c</td>";
					$c++;
					echo "<td class=\"th-darker\">$sql_invoice_code</td>";
					echo "<td>$sql_invoice_comment";



if(!empty($sql_invoice_id)){

					$sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$sql_invoice_id");
					while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){
                        $sql_order_last_status = $sql_banner['order_last_status'];
                        if($sql_order_last_status!=6) {
                            $sql_banner_total_price += $sql_banner['order_total_price'];
                            $sql_banner_price = $sql_banner['order_total_price'];
                        }
						$sql_order_submit_date = $sql_banner['order_submit_date'];						 					$sql_od_lot_quantity = $sql_banner['order_lot_quantity'];

						$sql_order_promise_date ='بنر'. $sql_banner['order_width']."X".$sql_banner['order_height'];


						

					echo "$sql_od_lot_quantity ";
					echo "$sql_order_promise_date ";
					 
						 
					}}




	$order_of_offset=  "SELECT * FROM orders2 where factor=$sql_invoice_id " ;


	if(!empty($sql_invoice_id)) {
        $sql_orders_of_offset = mysqli_query($connection, $order_of_offset);
        while ($sql_offset = mysqli_fetch_array($sql_orders_of_offset)) {
            $sql_order_last_status = $sql_offset['order_last_status'];
            $sql_order_type = $sql_offset['order_type'];
             

           
            echo "$sql_od_lot_quantity ";
            echo "$sql_order_type ";

            
            
        }
    }



	$order_of_offset=  "SELECT * FROM orders3 where factor=$sql_invoice_id " ;


	if(!empty($sql_invoice_id)){
			$sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
						while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){

						    $sql_order_last_status = $sql_offset['order_last_status'];
 
				        	$sql_order_type = $sql_offset['order_type'];
				        	 
 
				 
					echo "$sql_od_lot_quantity ";
					echo "$sql_order_type ";

					 
					 



						}

	}












echo"</td>";
					echo "<td class=\"th-darker\">$sql_invoice_cash</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_cash_out</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_cash_in</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_cash_total</td>";

                    echo "<td>$sql_invoice_create_date</td>";
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
                    echo "<a href=\"?page=$backpage&id=$id\"><li>صفحه قبل</li></a>";
                }
                for($i = 1; $i <= $pages; $i++){
                    if($i == $page){
                        $active_page_button = "class=\"active_page_button\"";
                    }
                    else{
                        $active_page_button = '';
                    }
                    echo "<a href=\"?page=$i&id=$id\"><li $active_page_button>$i</li></a>";
                }
                if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
                    echo "<a href=\"?page=$nextpage&id=$id\"><li>صفحه بعد</li></a>";
                }
                ?></ul>
        </div>


        </ul>
		</div> 

	
	</section>

<?php include ("footer.php");?>
