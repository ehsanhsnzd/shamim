<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-index">

		<div id="admin-panel-index-big-block">

			<p>مدیر گرامی، خوش آمدید.</p>
			<?php
				 
				$date_now = jdate('l, j F Y');
				echo "<span class=\"small-text\">امروز ".$date_now;
				$time_now = jdate('H:i');
				echo " - ساعت ".$time_now."</span>";

				require ('../db_select.php');

				$sql_user_q = mysqli_query($connection, "SELECT * FROM user");
				$sql_user_q_result = mysqli_num_rows($sql_user_q);


            
            	$sql_delivery_r_p = mysqli_query($connection, "SELECT * FROM delivery WHERE status = '0'");
				$sql_delivery_r_p_result = mysqli_num_rows($sql_delivery_r_p);

				echo "<br/><span class=\"adminpanel-index-block-span\">تعداد کاربران: ".$sql_user_q_result."</span>";
				echo "</span><span class=\"adminpanel-index-block-span\">تعداد درخواست های ارسال مرسوله منتظر بررسی: ".$sql_delivery_r_p_result."</span>";
			?>
		</div>

		<div id="admin-panel-index-orders-block">
			<h2>سفارشات:</h2><a href="orders.php" class="index-block-link-view">(مشاهده)</a>
			<?php
				$sql_orders_q = mysqli_query($connection, "SELECT * FROM orders1");
				$sql_orders_q_result = mysqli_num_rows($sql_orders_q);
				echo "<p>تعداد کل سفارشات تا به حال: ".$sql_orders_q_result;

				$sql_orders_wfp_q = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_last_status = '0'");
				$sql_orders_wfp_q_result = mysqli_num_rows($sql_orders_wfp_q);
				echo "<br/>در انتظار پرداخت: ".$sql_orders_wfp_q_result;
				
				$sql_orders_wfr_q = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_last_status = '1'");
				$sql_orders_wfr_q_result = mysqli_num_rows($sql_orders_wfr_q);
				echo "<br/>در انتظار بررسی: ".$sql_orders_wfr_q_result;
				
				$sql_orders_pp_q = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_last_status = '2'");
				$sql_orders_pp_q_result = mysqli_num_rows($sql_orders_pp_q);
				echo "<br/>در پروسه چاپ: ".$sql_orders_pp_q_result;
				
				$sql_orders_rd_q = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_last_status = '3'");
				$sql_orders_rd_q_result = mysqli_num_rows($sql_orders_rd_q);
				echo "<br/>آماده تحویل: ".$sql_orders_rd_q_result;

				$sql_orders_d_q = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_last_status = '4'");
				$sql_orders_d_q_result = mysqli_num_rows($sql_orders_d_q);
				echo "<br/>تحویل داده شده: ".$sql_orders_d_q_result."</p>";
			?>
		</div>

		<div id="admin-panel-index-invoices-block">
			<h2>فاکتور ها:</h2><a href="financial.php" class="index-block-link-view">(مشاهده)</a>
			<?php
				$sql_invoice_q = mysqli_query($connection, "SELECT * FROM invoices");
				$sql_invoice_q_result = mysqli_num_rows($sql_invoice_q);
				echo "<p>تعداد کل فاکتور ها تا به حال: ".$sql_invoice_q_result;

				$sql_invoice_p_q = mysqli_query($connection, "SELECT * FROM invoices WHERE is_paid = '1'");
				$sql_invoice_p_q_result = mysqli_num_rows($sql_invoice_p_q);
				echo "<br/>پرداخت شده: ".$sql_invoice_p_q_result;
				
				$sql_invoice_wp_q = mysqli_query($connection, "SELECT * FROM invoices WHERE is_paid = '0'");
				$sql_invoice_wp_q_result = mysqli_num_rows($sql_invoice_wp_q);
				echo "<br/>در انتظار پرداخت: ".$sql_invoice_wp_q_result."</p>";
			?>
		</div>

		<div id="admin-panel-index-invoices-block">
			<h2>درخواست های ارسال:</h2><a href="delivery-requests.php" class="index-block-link-view">(مشاهده)</a>
			<?php
            	$sql_delivery_r = mysqli_query($connection, "SELECT * FROM delivery");
				$sql_delivery_r_result = mysqli_num_rows($sql_delivery_r);
				echo "<p>تعداد کل درخواست های ارسال: ".$sql_delivery_r_result;

				echo "<br/>منتظر ارسال: ".$sql_delivery_r_p_result;

				$sql_delivery_r_d = mysqli_query($connection, "SELECT * FROM delivery WHERE status = '1'");
				$sql_delivery_r_d_result = mysqli_num_rows($sql_delivery_r_d);
				echo "<br/>ارسال شده: ".$sql_delivery_r_d_result;
				
				$sql_delivery_r_c = mysqli_query($connection, "SELECT * FROM delivery WHERE status = '2'");
				$sql_delivery_r_c_result = mysqli_num_rows($sql_delivery_r_c);
				echo "<br/>کنسل شده: ".$sql_delivery_r_c_result."</p>";
			?>
		</div>
        
        
        <div id="admin-panel-index-invoices-block">
			<h2>متراژ چاپ:</h2>
			<a href="report.php" class="index-block-link-view">(مشاهده)</a><br>

  <?  	  
		$meter=0;
		$meter_not_delivery_query = mysqli_query($connection, "SELECT * ,sum(order_width * order_height * order_lot_quantity) as m  FROM orders1  where order_delivery_permission!=1  ");
		while($meter_not_delivery=mysqli_fetch_assoc($meter_not_delivery_query)){
		
	 		$meter= $meter_not_delivery['m']/10000;
		 
  
 
		}	echo $meter ;
        ?>
	متر در دست چاپ (کلا)<br>
         
         
         
        <?  	$shdate= jdate("Y-m-d") ; 
		$meter=0;
		$meter_not_delivery_query = mysqli_query($connection, "SELECT * ,sum(order_width * order_height * order_lot_quantity) as m  FROM orders1  where order_delivery_permission!=1 and  DATE( order_submit_date)= '$shdate'");
		while($meter_not_delivery=mysqli_fetch_assoc($meter_not_delivery_query)){
		
	 		$meter= $meter_not_delivery['m']/10000;
		 
  
 
		}	echo $meter ;
        ?>
	متر در دست چاپ (امروز)<br>

   <?	  $meter=0;
		 
		$meter_not_delivery_query = mysqli_query($connection, "SELECT * ,sum(order_width * order_height * order_lot_quantity) as m  FROM orders1  where order_delivery_permission=1   and DATE(order_submit_date)= '$shdate'");
		while($meter_not_delivery=mysqli_fetch_assoc($meter_not_delivery_query)){
		
	 		$meter= $meter_not_delivery['m']/10000;
		 
  
 
		}	echo $meter ;
        ?>
 متر امروز چاپ شده است

		</div>

	</section>


<?php include ("footer.php");?>