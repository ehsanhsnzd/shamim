<? include("../function/db.php");?>
<?include("../../members/payments_settings.php");?>
<?
//Check access
admin_panel_access("settings_payments");



$activ=0;
if(isset($_POST["enable"])){$activ=1;}


$ipn=0;
if(isset($_POST["ipn"])){$ipn=1;}

$sql="update gateway_egold set account='".result($_POST["account"])."',name='".result($_POST["name"])."',password='".result($_POST["password"])."',activ=".$activ.",ipn=".$ipn;
$db->execute($sql);


header("location:payments.php");
?>