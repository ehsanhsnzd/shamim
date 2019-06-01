<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_payout");



$sql="update payout_price set price=".(float)$_POST["price"];
$db->execute($sql);


header("location:index.php?d=2");
?>