<?php
 session_start();
if(!isset($_POST['amount']) &&  !isset($_GET['amount']) && 	!isset($_POST['invoice']) && !isset($_GET['invoice'])) {	
	if(!isset($_SESSION["people_id"])){header("location:login.php");}
}
	parse_str($_SERVER['QUERY_STRING']);
 

 
 

		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}

	mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

 
?>

<? if(isset($_GET['invoice'])){
	$invoice=$_GET['invoice'];}
	
	
elseif(isset($_POST['invoice'])){
	$invoice=$_POST['invoice'];}
	
	

		
 
 
	 
if(isset($invoice)){
				 		
		$fetch_invoice = mysqli_query($connection , "SELECT * FROM factor WHERE   id = $invoice");
		
		$fetch_amount=mysqli_fetch_assoc( $fetch_invoice);
		$amount=(int)$fetch_amount['cash'];
		$data=$fetch_amount['operator'];


		$insert_invoice_mellat = mysqli_query($connection , "insert into invoices_mellat(invoice,username,cash,invoice_create_date )values($invoice,'$data',$amount,now())");
$invoice= mysqli_insert_id($connection);
 
 

}
		
		
	?>	

<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | پنل کاربران</title>
	<link rel="stylesheet" type="text/css" href="../users/library/style.css">
    <link rel="stylesheet" type="text/css" href="../library/css/style.css">
 
<meta charset=utf-8 />
 
<link rel="stylesheet" href="library/nav.css" type="text/css"  />


   
    
    <!-- js -->
<script src="../users/library/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
        $( '.dropdown' ).hover(
            function(){
                $(this).children('.sub-menu').slideDown(200);
            },
            function(){
                $(this).children('.sub-menu').slideUp(200);
            }
        );
    }); // end ready
</script>
 
 
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->    

	<script type="text/javascript" src="/library/jquery-2.2.0.min.js"></script>
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../users/library/jquery.js" type="text/javascript"></script>
   
<script src="../users/library/main-photo.js" type="text/javascript"></script>
    

	<script type="text/javascript" src="../users/library/main.js"></script>
	<script src="../users/library/dropzone.js"></script>
 
	<link rel="stylesheet" href="../users/library/dropzone.css">
    
     <link rel="stylesheet" type="text/css" href="../library/assets/animate.css" />





   <link type="text/css" href="../admin/styles/jquery-ui-1.8.14.css" rel="stylesheet" />
      <script type="text/javascript" src="../admin/scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../admin/scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="../admin/scripts/calendar.js"></script>

    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc-fa.js"></script>



    <script language="javascript" type="text/javascript">
        function postRefId (refIdValue) {
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "https://bpm.shaparak.ir/pgwchannel/startpay.mellat");
            form.setAttribute("target", "_self");
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("name", "RefId");
            hiddenField.setAttribute("value", refIdValue);
            form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }

        function initData()
        {
            document.getElementById("PayDate").value = "20091005";
            document.getElementById("PayTime").value = "140351";
            document.getElementById("PayAmount").value = "100";
            document.getElementById("PayOrderId").value = "1";
            document.getElementById("PayAdditionalData").value = "Customer No: 15220";
            document.getElementById("PayCallBackUrl").value = "http://www.yoursite.com/BPPHPSample/callback.php";
            document.getElementById("PayPayerId").value = "0";
        }
    </script>
     
  
</head>
<body>
 
 <?
//	if ($_SESSION['print_user'] == 'ok'){  
	
//	require ("user_menu.php"); 
 
//	}else{
 
 require ("user_menu.php"); 
 

 
//	}

 

	require_once("./lib/nusoap.php");
		
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	//$page = curl_exec ($ch);

	$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';

	///////////////// PAY REQUEST



	if (isset($_POST['PayRequestButton']) || !empty($invoice) )
	{
		$terminalId = '1765139';
		$userName = "shamim14";
		$userPassword = '77467160';
 
		$date =  date("Ymd");
		$time =  date("His");
		$localDate =  $date;
        $localTime = $time;
		$additionalData = $data;
		$callBackUrl =  'http://shamimgraphic.ir/users/callback.php';
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
			'amount' => $amount . 0,
			'localDate' => $localDate,
			'localTime' => $localTime,
			'additionalData' => $additionalData,
			'callBackUrl' => $callBackUrl,
			'payerId' => $payerId);

        // Call the SOAP method
        $result = $client->call('bpPayRequest', $parameters, $namespace);

        // Check for a fault
        if ($client->fault) {
        	echo "<div align='center'>";
            // echo '<h2>Fault</h2><pre>';
            // print_r($result);
            // echo '</pre>';
            echo "<img src='../images/mellat_card.jpg' width='600'/>";
            echo "</div>";
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

//                echo "<script>alert('Pay Response is : " . $resultStr . "');</script>";
//                echo "Pay Response is : " . $resultStr;

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
//    else
//    {
//        echo "<script>initData();</script>";
//    }











if(isset($_GET['amount'])){ $amount_balance=$_GET['amount'];}
if(isset($_POST['amount'])){ $amount_balance=$_POST['amount'];}







	if (isset($_POST['Pay']) || !empty($amount_balance) ) 
	{ 
	
	
		$user=$_SESSION['print_username'];		
 
			
 		$insert_invoice_mellat = mysqli_query($connection , "insert into invoices_mellat(username,cash,invoice_create_date)values('$user',$amount_balance,now())");
 	
 		$invoice= mysqli_insert_id($connection);
 
		$terminalId = '1765139';
		$userName = "shamim14";
		$userPassword = '77467160';

        $date =  date("Ymd");
        $time =  date("His");
        $localDate =  $date;
        $localTime = $time;
		$additionalData = $user;
		$callBackUrl =  'http://shamimgraphic.ir/users/callback.php';
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
			'amount' => $amount_balance. 0,
			'localDate' => $localDate,
			'localTime' => $localTime,
			'additionalData' => $additionalData,
			'callBackUrl' => $callBackUrl,
			'payerId' => $payerId);

		// Call the SOAP method
		$result = $client->call('bpPayRequest', $parameters, $namespace);
		
		// Check for a fault
		if ($client->fault) {
            echo "<div align='center'>";
            // echo '<h2>Fault</h2><pre>';
            // print_r($result);
            // echo '</pre>';
            echo "<img src='../images/mellat_card.jpg' width='600'/>";
            echo "</div>";
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
	else
	{	
		echo "<script>initData();</script>";
	}

?>



<br><br>
<br>
<br>
<br>
<br>
<br>
<center>
<? if(!isset($amount_balance)){?>

 <form name="form1" method="post" preservedata="true" action="<?= $_SERVER['PHP_SELF']?>">
<table  style="border:1px solid #999; padding:30px 30px 30px 30px;"><tr><td align="center">
<img src="library/images/mellat.jpg" width="85" height="85" />

<br>
<br>
پرداخت از طریق بانک ملت  <br /><br>
</td>
</tr>
<tr>
<td align="right" valign="bottom">
<input type="number" name="amount" value="<?= $amount?>" <? if(isset($_POST['amount'])){echo " disabled";}?> /> تومان<br>
<br>

</td>
 
</tr>
  <tr>
    <td colspan="3" align="center"><br />    
        <input type="submit" class="sbmtclass" name="Pay" value="پرداخت"/><br />
</td>
 
  </tr>
</table>


</form><? }?>
</center>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



<? include('footer.php'); ?>

