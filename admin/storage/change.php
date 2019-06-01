<? include("../function/db.php");?><?//Check accessadmin_panel_access("settings_storage");
$sql="update filestorage set activ=0";$db->execute($sql);$sql="update filestorage set activ=1 where id=".(int)$_POST["activ"];$db->execute($sql);unset($_SESSION["site_server_activ"]);unset($_SESSION["site_server"]);header("location:index.php?d=2");
?>