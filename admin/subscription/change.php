<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_subscription");


$sql="select * from subscription";
$rs->open($sql);
while(!$rs->eof)
{


$content_type="";
$sql="select * from content_type order by priority";
$ds->open($sql);
while(!$ds->eof)
{
if($content_type!="" and isset($_POST["type".$rs->row["id_parent"]."_".$ds->row["id_parent"]])){$content_type.="|";}
if(isset($_POST["type".$rs->row["id_parent"]."_".$ds->row["id_parent"]])){$content_type.=$ds->row["name"];}
$ds->movenext();
}

$sql="update subscription set download_limit=".result($_POST["price".$rs->row["id_parent"]]).", title='".result($_POST["title".$rs->row["id_parent"]])."',price=".result($_POST["price".$rs->row["id_parent"]]).",days=".(int)$_POST["days".$rs->row["id_parent"]].",priority=".(int)$_POST["priority".$rs->row["id_parent"]].",bandwidth=".(int)$_POST["bandwidth".$rs->row["id_parent"]].",content_type='".$content_type."' where id_parent=".$rs->row["id_parent"];
$db->execute($sql);

$sql="update structure set title='".result($_POST["title".$rs->row["id_parent"]])."' where id=".$rs->row["id_parent"];
$db->execute($sql);


$rs->movenext();
}




header("location:index.php");
?>