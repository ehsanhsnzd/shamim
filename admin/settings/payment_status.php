<? include("../function/db.php");?>
<?include("../../members/payments_settings.php");?>
<?
//Check access
admin_panel_access("settings_payments");

?>

<?include("../../members/JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);




$id=(int)@$_REQUEST['id'];


	$i=1;
	foreach ($payments as $key => $value) 
	{
		if($i==$id)
		{
			$gateway=$key;
		}
		$i++;
	}

$sql="select * from gateway_".$gateway;
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$sql="update gateway_".$gateway." set activ=0";
	$db->execute($sql);
	?>
	<a href="javascript:payment(<?=$id?>);" class='red'><b><?=word_lang("disabled")?></b></a>
	<?
}
else
{
	$sql="update gateway_".$gateway." set activ=1";
	$db->execute($sql);
	?>
	<a href="javascript:payment(<?=$id?>);" class='green'><b><?=word_lang("enabled")?></b></a>
	<?
}
?>
