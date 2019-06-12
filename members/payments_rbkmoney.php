<??>
<?
if($site_rbkmoney_account!="")
{


$hash=strtolower(md5($site_rbkmoney_account."::".str_replace(".",",",float_opt($product_total,2))."::".$currency_code1."::::".$product_name."::".$product_type."-".$product_id."::::".$site_rbkmoney_password));
?>


<form action="https://rbkmoney.ru/acceptpurchase.aspx" name="process" id="process" method="POST">
<input type="hidden" name="eshopId" value="<?=$site_rbkmoney_account?>">
<input type="hidden" name="orderId" value="<?=$product_type?>-<?=$product_id?>">
<input type="hidden" name="serviceName" value="<?=$product_name?>">
<input type="hidden" name="recipientAmount" value="<?=str_replace(".",",",float_opt($product_total,2))?>">
<input type="hidden" name="recipientCurrency" value="<?=$currency_code1?>">
<input type="hidden" name="user_email " value="">
<input type="hidden" name="successUrl" value="<?=surl.site_root."/members/payments_result.php?d=1"?>">
<input type="hidden" name="failUrl" value="<?=surl.site_root."/members/payments_result.php?d=2"?>">
<input type="hidden" name="hash" value="<?=$hash?>">
</form>

<?
}
?>
