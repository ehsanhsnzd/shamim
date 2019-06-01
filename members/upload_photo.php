<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?if(userupload==0){header("location:profile.php");}?>
<?
$sql="select * from user_category where name='".result($_SESSION["people_category"])."'";
$dn->open($sql);
if(!$dn->eof and $dn->row["upload"]==1)
{
$lphoto=$dn->row["photolimit"];


//Upload function
include("../admin/function/upload.php");

$photo="";
$swait=false;



//model
$model=0;
if(isset($_POST["model"]))
{
	$model=(int)$_POST["model"];
}

//free
$free=0;
if(isset($_POST["free"]))
{
	$free=1;
}


//Examination
if($site_examination and $_SESSION["people_exam"]!=1)
{
	$exam=1;
}
else
{
	$exam=0;
}





$pub_vars=array();
$pub_vars["category"]=(int)$_POST["folder"];
$pub_vars["title"]=result($_POST["title"]);
$pub_vars["description"]=result($_POST["description"]);
$pub_vars["keywords"]=result($_POST["keywords"]);
$pub_vars["userid"]=(int)$_SESSION["people_id"];
$pub_vars["published"]=$site_moderation;
$pub_vars["viewed"]=0;
$pub_vars["data"]=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
$pub_vars["author"]=result($_SESSION["people_login"]);
$pub_vars["content_type"]=$site_content_type;
$pub_vars["downloaded"]=0;
$pub_vars["model"]=$model;
$pub_vars["examination"]=$exam;
$pub_vars["server1"]=$site_server_activ;
$pub_vars["free"]=$free;
$pub_vars["category2"]=(int)$_POST["folder2"];
$pub_vars["category3"]=(int)$_POST["folder3"];

if($site_google)
{
	$pub_vars["google_x"]=(float)$_POST["google_x"];
	$pub_vars["google_y"]=(float)$_POST["google_y"];
}
else
{
	$pub_vars["google_x"]=0;
	$pub_vars["google_y"]=0;
}

if(isset($_POST["editorial"]))
{
	$pub_vars["editorial"]=1;
}
else
{
	$pub_vars["editorial"]=0;
}

if(isset($_POST["adult"]))
{
	$pub_vars["adult"]=1;
}
else
{
	$pub_vars["adult"]=0;
}



if(isset($_GET["id"]))
{
	$id=(int)$_GET["id"];
	$sql="select downloaded,viewed,data,content_type from photos where id_parent=".$id;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$pub_vars["downloaded"]=$rs->row["downloaded"];
		$pub_vars["viewed"]=$rs->row["viewed"];
		$pub_vars["data"]=$rs->row["data"];
		$pub_vars["content_type"]=$rs->row["content_type"];
	}
	//Update a photo into the database
	publication_photo_update($id,(int)$_SESSION["people_id"]);
	
	$smarty->clear_cache(null,"item|".$id);
	$smarty->clear_cache(null,"share|".$id);
	item_url($id);
}


//Folder
$folder=$id;




//upload file for sale
if(isset($_GET["id"]))
{
	price_update((int)$_GET["id"],"photo");
}




//Prints
if($site_prints_users==true)
{
	if(isset($_GET["id"]))
	{
		prints_update((int)$_GET["id"]);
	}
}





if($site_examination and $_SESSION["people_exam"]!=1)
{
	$rurl="upload.php";
}
else
{
	$rurl="publications.php?d=2&t=1";
}



//go to back
header("location:".$rurl);

}
?>