<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_currency");






$sql="update currency set activ=0";
$db->execute($sql);

$sql="update currency set activ=1 where code1='".result($_POST["currency"])."'";
$db->execute($sql);

$sql="select code1,code2 from currency where activ=1";
$rs->open($sql);
if(!$rs->eof)
{
	$_SESSION["currency_code1"]=$currency_code1;
	$_SESSION["currency_code2"]=$currency_code2;
}

$smarty->clear_all_cache();

header("location:currency.php");
?>