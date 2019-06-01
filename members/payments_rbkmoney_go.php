<?
include("../admin/function/db.php");
include("payments_settings.php");

if ($_POST) 
{
	header("HTTP/1.0 200 OK");
	
	$eshopId        = trim(stripslashes($_POST['eshopId']));            //1.Номер сайта продавца (eshopId);
    $orderId        = trim(stripslashes($_POST['orderId']));            //2.Номер счета продавца (orderId);
    $serviceName    = trim(stripslashes($_POST['serviceName']));        //3.Описание покупки (serviceName);
    $eshopAccount   = trim(stripslashes($_POST['eshopAccount']));       //4.Номер счета в системе RBKMoney (eshopAccount);
    $recipientAmount= trim(stripslashes($_POST['recipientAmount']));    //5.Сумма платежа (recipientAmount);
    $recipientCurrency=trim(stripslashes($_POST['recipientCurrency'])); //6.Валюта платежа (recipientCurrency);
    $paymentStatus  = trim(stripslashes($_POST['paymentStatus']));      //7.Статус платежа (paymentStatus);
    $userName       = trim(stripslashes($_POST['userName']));           //8.Имя покупателя (userName);
    $userEmail      = trim(stripslashes($_POST['userEmail']));          //9.Email покупателя (userEmail);
    $paymentData    = trim(stripslashes($_POST['paymentData']));        //10.Дата и время выполнения платежа(paymentData);
    $secretKey      = trim(stripslashes($_POST['secretKey']));          //11.Секретный ключ (secretKey);
    $hash           = trim(stripslashes($_POST['hash']));               // Контрольная подпись
    
    
    $control_hash=strtolower(md5($eshopId."::".$orderId."::".$serviceName."::".$eshopAccount."::".$recipientAmount."::".$recipientCurrency."::".$paymentStatus."::".$userName."::".$userEmail."::".$paymentData."::".$secretKey));
    
    if($hash == $control_hash)
    {
    	if($paymentStatus==5)
    	{
    		$rbk=explode("-",$orderId);
    		$product_type=$rbk[0];
    		$id=(int)$rbk[1];
    		$transaction_id=transaction_add("rbkmoney",(int)$_POST["paymentId"],result($product_type),$id);
    		
    		
				
				

				if($product_type=="credits")
				{
					credits_approve($id,$transaction_id);
					send_notification('credits_to_user',$id);
					send_notification('credits_to_admin',$id);
				}

				if($product_type=="subscription")
				{
					subscription_approve($id);
					send_notification('subscription_to_user',$id);
					send_notification('subscription_to_admin',$id);
				}

				if($product_type=="order")
				{
					order_approve($id);
					commission_add($id);

					coupons_add(order_user($id));
					send_notification('neworder_to_user',$id);
					send_notification('neworder_to_admin',$id);
				}
    	}
    }
}

	
				


?>