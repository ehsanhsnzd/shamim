<? include("../function/db.php");?>
<?include("../../members/payments_settings.php");?>
<?
//Check access
admin_panel_access("settings_payments");



$activ=0;
if(isset($_POST["enable"])){$activ=1;}

$ipn=0;
if(isset($_POST["ipn"])){$ipn=1;}

$sql="update gateway_ccbill set account='".result($_POST["account"])."',account2='".result($_POST["account2"])."',account3='".result($_POST["account3"])."',activ=".$activ.",ipn=".$ipn." where subscription=0 and credits=0";
$db->execute($sql);


header("location:payments.php");
?>