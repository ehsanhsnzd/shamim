<?
include("../admin/function/db.php");
include("payments_settings.php");

if($_POST) 
{
 	parse_str($_POST['payment'], $output);
 	
 	$signature = sha1(md5($_POST['payment'].$site_privatbank_password));
 	
 	
    if($_POST["signature"] == $signature)
    {
    	if($output['state']=="ok" or $output['state']=="test" )
    	{	
    		$mass=explode("-",$output['order']);
    		$product_type=$mass[0];
    		$id=(int)$mass[1];
    		$transaction_id=transaction_add("privatbank","",result($product_type),$id);	

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
			
			header("location:".site_root."/members/payments_result.php?d=1");
    		exit();
    	}
    	else
    	{
    		header("location:".site_root."/members/payments_result.php?d=2");
    		exit();
    	}
    }
}
?>