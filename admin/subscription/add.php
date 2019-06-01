<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_subscription");



$content_type="";
$sql="select * from content_type order by priority";
$rs->open($sql);
while(!$rs->eof)
{
if($content_type!="" and isset($_POST["type".$rs->row["id_parent"]])){$content_type.="|";}
if(isset($_POST["type".$rs->row["id_parent"]])){$content_type.=$rs->row["name"];}
$rs->movenext();
}


$sql="insert into subscription (title,price,days,content_type,bandwidth,priority,download_limit) values ('".result($_POST["title"])."',".result($_POST["price"]).",".(int)$_POST["days"].",'".$content_type."',".(int)$_POST["bandwidth"].",0, ".(int)$_POST["bandwidth"].")";
$db->execute($sql);



header("location:index.php");
?>