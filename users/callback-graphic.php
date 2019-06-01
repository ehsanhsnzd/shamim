<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>BP PGW Test</title>
    <link href="Css/Style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form id="form1" runat="server">
    <table width="100%" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td>
                <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                    <tr class="HeaderTr">
                        <td colspan="2" align="center" height="25">
                            <span class="HeaderText">CallBack Params</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>RefId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['RefId']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>ResCode</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['ResCode']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>SaleOrderId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['SaleOrderId']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>SaleReferenceId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['SaleReferenceId']; ?></span>
                        </td> 
                    </tr>
                        <tr>
                        <td class="LabelTd">
                            <span>additionalData</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['additionalData']; ?></span>
                        </td> 
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
    
<?
  
  
 

		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}

	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

    
  

	require_once("./lib/nusoap.php");
		
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	//$page = curl_exec ($ch);

	$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';

	///////////////// PAY REQUEST

			$terminalId = '1765139';
		$userName = "shamim14";
		$userPassword = '77467160';
		$orderId = $_POST['SaleOrderId']; 
		$verifySaleOrderId =  $_POST['SaleOrderId']; 
		$verifySaleReferenceId = $_POST['SaleReferenceId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $verifySaleOrderId,
			'saleReferenceId' => $verifySaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpVerifyRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {

			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {

			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Display the result
				// Update Table, Save Verify Status 
				// Note: Successful Verify means complete successful sale was done. 
			
				if($resultStr==0){
				$invoiceID=	$_POST['SaleOrderId']		; 		
		$fetch_invoice = mysqli_query($connection , "SELECT * FROM invoices_mellat WHERE   invoice_code = $invoiceID");
		
		$fetch_amount=mysqli_fetch_assoc( $fetch_invoice);
		$amount=$fetch_amount['cash'];
		$invoice=$fetch_amount['invoice'];
		$user_balance=$fetch_amount['username'];
 	mysqli_query($connection, "UPDATE invoices_mellat SET is_paid = '1',deposit_date= now()  WHERE invoice_code = $invoice");
				
				$sql_paid_invoice = "UPDATE invoices SET is_paid = '1',deposit_date= now()  WHERE invoice_code = $invoice";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه به حالت پرداخت شده تغییر یافت</span><br>
<br>
";
		}
		
		
			 		
 
		if (mysqli_query($connection , "UPDATE orders2 SET  order_last_status = '1'  WHERE order_invoice_code = $invoice")) {
			
			echo $update_row = mysqli_affected_rows($connection);
			echo "<span class=\"edit-done-alert\">وضعیت سفارش مربوطه به حالت بررسی تغییر یافت</span>
<br>
<br>
";

 
		}
		
		
		
		
		
 
		  
		  if($invoice==0){
			  
			  
		 mysqli_query($connection , "insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date) values ('".$_POST["title"]."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".$user_balance."',".(float)$amount.",1,0,0,0)");
			  }
		
				}
				echo "Verify Response is : " . $resultStr;
				
				
				
					$result2 = $client->call('bpSettleRequest', $parameters, $namespace);
				
				
			}// end Display the result
		}// end Check for errors
		
		
		
		
		
		
		
		
		
		 
 $date = jdate('Y-n-j');
		
		
 
 
 
  mysqli_select_db($connection, $db_name) ;
		
		
	
     if(!$query_month_size=mysqli_query($connection,"select  sum(cash) as price,offer from invoices where username='$user_balance'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and is_paid=1  ")){echo mysqli_error();}
 
	 
	 
 $select_size= mysqli_fetch_assoc($query_month_size);
 
 $price=$select_size['price'];
 $offer_offer=$select_size['offer'];
 $price+=$price2;
	 
	 
	 
	 
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
	


		
		
	updateoffer(0,$percent,$user_balance,$date); 
	updateoffer($percent_1,$percent,$user_balance,$date); 
	updateoffer($percent_2,$percent,$user_balance,$date); 
	updateoffer($percent_3,$percent,$user_balance,$date); 
	updateoffer($percent_4,$percent,$user_balance,$date); 
		
 	
 
 
 
 function  updateoffer($level,$newpercent,$user_id_value,$date){
	  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 mysqli_select_db($connection, $db_name) ;
		
	if($newpercent>$level){	
	
	if(!mysqli_query($connection,"update invoices set offer=$newpercent where username='$user_id_value'  and DATE(invoice_create_date) >= DATE_SUB('$date', INTERVAL 1 MONTH)  and  DATE(invoice_create_date) <= '$date' and offer=$level and is_paid=1")){echo mysqli_error();}
	}
	}
		
 
	?>
				<script type='text/javascript'>window.location.href='financial.php'</script>
                
      
</body>
</html>
