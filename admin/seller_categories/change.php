<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_sellercategories");

$sql="select id_parent,priority,name,upload,upload2,upload3,upload4 from user_category order by priority";
$rs->open($sql);
while(!$rs->eof)
{
	if(result($_POST["title".$rs->row["id_parent"]])!=$rs->row["name"])
	{
		$sql="update users set category='".result($_POST["title".$rs->row["id_parent"]])."' where category='".$rs->row["name"]."'";
		$db->execute($sql);
	}
	
	$upload1=0;
	$upload2=0;
	$upload3=0;
	$upload4=0;
	
	if(isset($_POST["upload_".$rs->row["id_parent"]]))
	{
		$upload1=1;
	}
	
	if(isset($_POST["upload2_".$rs->row["id_parent"]]))
	{
		$upload2=1;
	}
	
	if(isset($_POST["upload3_".$rs->row["id_parent"]]))
	{
		$upload3=1;
	}
	
	if(isset($_POST["upload4_".$rs->row["id_parent"]]))
	{
		$upload4=1;
	}
		
	
	$sql="update user_category set name='".result($_POST["title".$rs->row["id_parent"]])."',percentage=".(int)$_POST["percentage".$rs->row["id_parent"]].",priority=".(int)$_POST["priority".$rs->row["id_parent"]].",upload=".$upload1.",upload2=".$upload2.",upload3=".$upload3.",upload4=".$upload4." where id_parent=".$rs->row["id_parent"];
	$db->execute($sql);
	$rs->movenext();
}

header("location:index.php");
?>
