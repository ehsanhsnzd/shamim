<?php

 


function checkoffer($level,$percent,$user_id_value,$date){
  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 mysqli_select_db($connection,$db_name) ;
		
		 

 if(!$query_invoice_offer=mysqli_query($connection,"select  sum(cash) as cash,offer from invoices where username='$user_id_value'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and offer=$level and is_paid=1 ")){echo mysqli_error();}

$select_offer= mysqli_fetch_assoc($query_invoice_offer);
 
$offer_cash=$select_offer['cash'];
 $offer_offer=$select_offer['offer'];

if($percent>$offer_offer){
	
  $newoffer=$percent-$offer_offer;
 
    $offer_cash_percent=$offer_cash*$newoffer;
  
}
   
 return    $offer_cash_percent;
 
 

}


function del_invoice($user_id_value){
	
	 $date = jdate('Y-n-j');	
	
	  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 
 
  mysqli_select_db($connection, $db_name) ;
		
		
	
     if(!$query_month_size=mysqli_query($connection,"select  sum(cash) as price from invoices where username='$user_id_value'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and is_paid=1  ")){echo mysqli_error();}
 
	 
	 
 $select_size= mysqli_fetch_assoc($query_month_size);
 
 $price=$select_size['price'];
 
  
 
 
 

 
 
  if(! $query_info=mysqli_query($connection,"select  * from info")){echo mysqli_error();};
  $select_info=mysqli_fetch_assoc($query_info);
  
 	$fee_1= $select_info['fee_1'];
    $fee_2= $select_info['fee_2'];
    $fee_3= $select_info['fee_3'];
	$fee_4= $select_info['fee_4'];
	$fee_5= $select_info['fee_5'];
	
 	$percent_1= $select_info['percent_1'];
    $percent_2= $select_info['percent_2'];
    $percent_3= $select_info['percent_3'];
	$percent_4= $select_info['percent_4'];
    $percent_5= $select_info['percent_5'];
	
   if($price<$fee_1  ){
 	$percent=0.00;
 
	}
if($price>=$fee_1 && $price<$fee_2){
 	$percent =$percent_1;
}
 if($price>=$fee_2 && $price<$fee_3){
 $percent=$percent_2;
	 
	}
	
	 if($price>=$fee_3 && $price<$fee_4){
 $percent=$percent_3;
	 
	}
	
	 if($price>=$fee_4 && $price<$fee_5){
 $percent=$percent_4;
	 
	}
 if($price>=$fee_5  ){
 	$percent=$percent_5;
 
	}
	
 
	
	
		updateoffer(0,$percent,$user_id_value,$date); 
	updateoffer($percent_1,$percent,$user_id_value,$date); 
	updateoffer($percent_2,$percent,$user_id_value,$date); 
	updateoffer($percent_3,$percent,$user_id_value,$date); 
	updateoffer($percent_4,$percent,$user_id_value,$date); 

 
	
	
	
	}


function size_offer($user_id_value,$invoice_code_value,$do,$order){

  
 $date = jdate('Y-n-j');	
$date2=jdate('Y-n-j H:i:s');
	
	  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 
 
  mysqli_select_db($connection, $db_name) ;
		

mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");

		
	
     if(!$query_month_size=mysqli_query($connection,"select  sum(cash) as price from invoices where username='$user_id_value'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and is_paid=1  ")){echo mysqli_error();}
 
	 
	 
 $select_size= mysqli_fetch_assoc($query_month_size);
 
 $price=$select_size['price'];
 
 
 if(! $query_offer=mysqli_query($connection,"select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved")){echo mysqli_error();};
  $select_offer=mysqli_fetch_assoc($query_offer);
 $size_type= $select_offer['offer'];
  $balance= $select_offer['balance'];
   $offbalance= $select_offer['offbalance'];
   
   
  if(! $invoice_q=mysqli_query($connection,"select  * from invoices where invoice_code='$invoice_code_value'")){echo mysqli_error();}
  $invoice_s=mysqli_fetch_assoc($invoice_q);
 $invoice_cash=$invoice_s['cash'];
 
 
 $price+=$invoice_cash;
 
 
 

 
 
  if(! $query_info=mysqli_query($connection,"select  * from info")){echo mysqli_error();};
  $select_info=mysqli_fetch_assoc($query_info);
  
 	$fee_1= $select_info['fee_1'];
    $fee_2= $select_info['fee_2'];
    $fee_3= $select_info['fee_3'];
	$fee_4= $select_info['fee_4'];
	$fee_5= $select_info['fee_5'];
	
 	$percent_1= $select_info['percent_1'];
    $percent_2= $select_info['percent_2'];
    $percent_3= $select_info['percent_3'];
	$percent_4= $select_info['percent_4'];
    $percent_5= $select_info['percent_5'];
	
   if($price<$fee_1  ){
 	$percent=0.00;
 
	}
if($price>=$fee_1 && $price<$fee_2){
 	$percent =$percent_1;
}
 if($price>=$fee_2 && $price<$fee_3){
 $percent=$percent_2;
	 
	}
	
	 if($price>=$fee_3 && $price<$fee_4){
 $percent=$percent_3;
	 
	}
	
	 if($price>=$fee_4 && $price<$fee_5){
 $percent=$percent_4;
	 
	}
 if($price>=$fee_5  ){
 	$percent=$percent_5;
 
	}
	
	$invoice_new_cash=$invoice_cash*$percent;
	
	
	
	///////////////////////////////////////

 
 


  $totaldiscount= 
 
checkoffer(0.00,$percent,$user_id_value,$date)+
checkoffer($percent_1,$percent,$user_id_value,$date)+
checkoffer($percent_2,$percent,$user_id_value,$date)+
checkoffer($percent_3,$percent,$user_id_value,$date)+
checkoffer($percent_4,$percent,$user_id_value,$date);

 


   $totaldis=$totaldiscount+$invoice_new_cash;
 

if ($do == 'paid') { 
 

 	$new_total_balance=$totaldis;
	
if(!	mysqli_query($connection, "update invoices set is_paid=1 where invoice_code='$invoice_code_value'")){ echo mysqli_error($connection);}

if($new_total_balance>0){


if(!	mysqli_query($connection, "insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date) values ('تخفیف فاکتور $invoice_code_value','".$date2."','".$user_id_value."',".(float)$new_total_balance.",1,0,0,0)")){ echo mysqli_error($connection);}
}
	updateoffer(0,$percent,$user_id_value,$date); 
	updateoffer($percent_1,$percent,$user_id_value,$date); 
	updateoffer($percent_2,$percent,$user_id_value,$date); 
	updateoffer($percent_3,$percent,$user_id_value,$date); 
	updateoffer($percent_4,$percent,$user_id_value,$date); 

 
	
	
	
	
	
	
	
	
	
	
	
	
		
	$balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved");
	$balance= mysqli_fetch_array($balance_user);
	
	
			 
				 		
		$fetch_invoice = mysqli_query($connection, "SELECT * FROM invoices WHERE   invoice_code = '$invoice_code_value'  ");
		
		$fetch_amount=mysqli_fetch_assoc( $fetch_invoice);
		$amount=$fetch_amount['cash'];
		$is_paid=$fetch_amount['is_paid'];
	
if ($balance['balance']>=$amount  ){
	
 $amount= 0 -$amount;
	
	
if(!	mysqli_query($connection, "insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date) values ('پرداخت فاکتور $invoice_code_value','".$date2."','".$user_id_value."',".(float)$amount.",1,0,0,0)")){ echo mysqli_error($connection);}
	
		$sql_paid_invoice = "UPDATE invoices SET is_paid = '1' WHERE invoice_code = $invoice_code_value";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه به حالت پرداخت شده تغییر یافت</span>";
			
			
			
				
		
	if (mysqli_query($connection , "UPDATE $order SET  order_last_status = '2'  WHERE order_invoice_code = '$invoice_code_value'")) {
			
		echo $update_row = mysqli_affected_rows($connection);
		echo "<span class=\"edit-done-alert\">وضعیت سفارش مربوطه به حالت بررسی تغییر یافت</span>";}
			
			
			
		} else {
    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
		}}else{ echo "<br><br><span style='color:red'> هزینه فاکتور از حساب شما بیشتر است!</span>";
		
		
		
	?>	<script type='text/javascript'>window.location.href='payment.php?invoice='+'<?=$invoice_code_value ?>'</script>
		<?

	
		}
	
	
	
	
	
	
	
	
	
	}
		return $totaldis;
		
		
		
			}

 
			
 function  updateoffer($level,$newpercent,$user_id_value,$date){
	  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 mysqli_select_db($connection, $db_name) ;
		
	if($newpercent>$level){	
	
	if(!mysqli_query($connection,"update invoices set offer=$newpercent where username='$user_id_value'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and offer=$level and is_paid=1")){echo mysqli_error();}
	}
	}


 ?>