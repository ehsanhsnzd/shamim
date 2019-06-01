<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("users_administrators");

$id=0;

if(isset($_GET["id"]))
{
		$password="";
		if($_POST["p"]!="********")
		{
			$password=",password='".md5(result($_POST["p"]))."'";
		}
		
		$sql="update people set login='".result($_POST["l"])."'".$password.",name='".result($_POST["name"])."' where id=".(int)$_GET["id"];
		$db->execute($sql);
		
		$id=(int)$_GET["id"];
}
else
{
	if($_POST["p"]==$_POST["p2"])
	{
		$sql="insert into people (login,password,name) values ('".result($_POST["l"])."','".md5(result($_POST["p"]))."','".result($_POST["name"])."')";
		$db->execute($sql);
		
		$sql="select id from people where login='".result($_POST["l"])."' order by id desc";
		$rs->open($sql);
		$id=$rs->row["id"];
	}
}

		
	//Add rights
	if($id!=0)
	{
		$sql="delete from people_rights where user=".$id;
		$db->execute($sql);
		
		foreach ($submenu_admin as $key => $value) 
		{
			if(isset($_POST[$key]))
			{
				$sql="insert into people_rights (user,user_rights) values (".$id.",'".$key."')";
				$db->execute($sql);	
			}
		}
	}

	
header("location:index.php");
?>
