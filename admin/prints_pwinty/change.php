<? 
include("../function/db.php");

//Check access
admin_panel_access("settings_pwinty");

$testmode=0;
if(isset($_POST["testmode"]))
{
	$testmode=1;
}

$sql="update pwinty set account='".result($_POST["account"])."',password='".result($_POST["password"])."',order_number=".(int)$_POST["order_number"].",testmode=".$testmode;
$db->execute($sql);

header("location:index.php?d=1");
?>