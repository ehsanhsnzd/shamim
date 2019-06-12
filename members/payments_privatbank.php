<??>
<?
if($site_privatbank_account!="")
{
	?>
	<form action="https://api.privatbank.ua/p24api/ishop" method="POST" name="process" id="process">
		<input type="hidden" name="amt" value="<?=$product_total?>"/>
		<input type="hidden" name="ccy" value="<?=$currency_code1?>" />
		<input type="hidden" name="merchant" value="<?=$site_privatbank_account?>" />
		<input type="hidden" name="order" value="<?=$product_type."-".$product_id?>" />
		<input type="hidden" name="details" value="<?=$product_name?>" />
		<input type="hidden" name="pay_way" value="privat24" />
		<input type="hidden" name="return_url" value="<?=surl.site_root."/members/payments_privatbank_go.php"?>" />
		<input type="hidden" name="server_url" value="<?=surl.site_root."/members/payments_privatbank_go.php"?>" />
	</form>
	<?
}
?>
