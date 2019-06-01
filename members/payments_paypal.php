<?
if(!defined("site_root")){exit();}
require_once("../users/lib/nusoap.php");

require ('../config.php');
		 
 
 
	if(isset($_GET["mode"]) and $_GET["mode"]=="notification")
	{
		
	 
		
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
 	mysqli_query($connection, "UPDATE invoices_mellat SET is_paid = '1',deposit_date= now()  WHERE invoice_code = $invoiceID");




                    $balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_balance' group by approved");
                    $balance= mysqli_fetch_array($balance_user);
                    $quantity_total=$balance['balance'];



                    mysqli_query($connection , "insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total) values ('پرداخت درگاه ملت','".date('Y-m-d H:i:s')."','".$user_balance."',".(float)$amount.",1,0,0,0,".(float)$quantity_total.")");



                    $balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_balance' group by approved");
                    $balance= mysqli_fetch_array($balance_user);
                    $quantity_total=$balance['balance'];


                    $amount_sub=0- $amount;
	 
	 	$sql_paid_credit="insert into credits_list (title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total) values ('پرداخت اشتراک $invoice','".date('Y-m-d H:i:s')."','".$user_balance."',".(float)$amount_sub.",1,0,0,0,".(float)$quantity_total.")";
	 
		if ($connection->query($sql_paid_credit) === TRUE) {
	 
				$transaction_id=transaction_add("mellat",$_POST["SaleReferenceId"],$_GET["product_type"],$_GET["product_id"]);

				if($_GET["product_type"]=="credits")
				{
					credits_approve($_GET["product_id"],$transaction_id);
					send_notification('credits_to_user',$_GET["product_id"]);
					send_notification('credits_to_admin',$_GET["product_id"]);
				}

				if($_GET["product_type"]=="subscription")
				{
					subscription_approve($_GET["product_id"]);
					send_notification('subscription_to_user',$_GET["product_id"]);
					send_notification('subscription_to_admin',$_GET["product_id"]);
				}

				if($_GET["product_type"]=="order")
				{
					order_approve($_GET["product_id"]);
					commission_add($_GET["product_id"]);

					coupons_add(order_user($_GET["product_id"]));
					send_notification('neworder_to_user',$_GET["product_id"]);
					send_notification('neworder_to_admin',$_GET["product_id"]);
				}
				if($_GET["product_type"]=="payout_seller" or $_GET["product_type"]=="payout_affiliate")
				{
					payout_approve($_GET["product_id"],$_GET["product_type"]);
				}
		}

                ?>    <script type='text/javascript'>window.location.href='subscription.php'</script> <?
	 
				}
 
			}// end Display the result
		}// end Check for errors
		
 
	}
	else
	{
		
		 $user=result($_SESSION["people_login"]);
		 $insert_invoice_mellat = mysqli_query($connection , "insert into invoices_mellat(username,cash,invoice_create_date)values('$user','$product_total',now())");
 	
 $invoice= mysqli_insert_id($connection);

		
		
	$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';

	///////////////// PAY REQUEST


 
		$terminalId = '1765139';
		$userName = "shamim14";
		$userPassword = '77467160';
 
		//$date =  date("YYMMDD");
		//$time =  date("HHIISS");
		$localDate =  strtotime('today');
		$localTime = strtotime(date('H:i:s')) - $localDate;
		$additionalData = $data;
		$callBackUrl =  surl.site_root."/members/payments_process.php?mode=notification&product_type=".$product_type.'&processor=paypal&product_id='.$product_id;
		$payerId = 0;

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
			'orderId' =>  $invoice,
			'amount' => $product_total. 0,
			'localDate' => $localDate,
			'localTime' => $localTime,
			'additionalData' => $additionalData,
			'callBackUrl' => $callBackUrl,
			'payerId' => $payerId);

		// Call the SOAP method
		$result = $client->call('bpPayRequest', $parameters, $namespace);
		
		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {
			// Check for errors
			
			$resultStr  = $result;

			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Display the result

				$res = explode (',',$resultStr);

			 
				$ResCode = $res[0];
				
				if ($ResCode == "0") {
					// Update table, Save RefId
					echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";
				} 
				else {
				// log error in app
					// Update table, log the error
					// Show proper message to user
				}
			}// end Display the result
		}// end Check for errors
	 
}	
			?>
        
  
        
 