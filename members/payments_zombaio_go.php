<?
include("../admin/function/db.php");
include("payments_settings.php");
$site="zombaio";

//Check access
if (@$_GET["ZombaioGWPass"] != $site_zombaio_password) {     
header("HTTP/1.0 401 Unauthorized");
echo "<h1>Zombaio Gateway 1.1</h1><h3>Authentication failed.</h3>";
exit;  
}

if($site_zombaio_account!="")
{
	if(@$_GET["Action"] == "user.addcredits")
	{ 
		credits_approve((int)$_GET["Identifier"],result($_GET["TransactionID"]));
		send_notification('credits_to_user',(int)$_GET["Identifier"]);
		send_notification('credits_to_admin',(int)$_GET["Identifier"]);
	}
}

echo("OK");
?>