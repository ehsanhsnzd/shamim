<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("affiliates_settings");


$sql="update affiliates_settings set meaning=".(float)$_POST["buyer"]." where id=1";
$db->execute($sql);

$sql="update affiliates_settings set meaning=".(float)$_POST["seller"]." where id=2";
$db->execute($sql);

$_SESSION["affiliate_buyer_commission"]=(float)$_POST["buyer"];
$_SESSION["affiliate_seller_commission"]=(float)$_POST["seller"];


if($_POST["addto"]==1)
{
	$sql="update users set aff_commission_buyer=".(float)$_POST["buyer"].",aff_commission_seller=".(float)$_POST["seller"]." where utype='affiliate' or utype='common'";
	$db->execute($sql);
}

header("location:settings.php");
?>