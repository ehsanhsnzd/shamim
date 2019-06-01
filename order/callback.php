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
 
				
				$sql_paid_invoice = "UPDATE invoices SET is_paid = '1',deposit_date= now()  WHERE invoice_code = $invoice";		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		if ($connection->query($sql_paid_invoice) === TRUE) {
			echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه به حالت پرداخت شده تغییر یافت</span><br>
<br>
";
		}
		
		
			 		
 
		if (mysqli_query($connection , "UPDATE orders SET  order_last_status = '1'  WHERE order_invoice_code = $invoice")) {
			
			echo $update_row = mysqli_affected_rows($connection);
			echo "<span class=\"edit-done-alert\">وضعیت سفارش مربوطه به حالت بررسی تغییر یافت</span>
<br>
<br>
";

require_once('../avclass.php');
size_offer($order_submit_date,$user_id_value);
		}
		
		
		
		
		
 
		  
		  if($invoice==0){
			  
			  
		 mysqli_query($connection , "UPDATE user SET  balance = balance+$amount  WHERE username = '$user_balance'");
			  
			  }
		
				}
				echo "Verify Response is : " . $resultStr;
				
				
				
				?>
				<script type='text/javascript'>window.location.href='financial.php'</script>
                
                <?
			}// end Display the result
		}// end Check for errors
 
	
	 ?>
</body>
</html>
