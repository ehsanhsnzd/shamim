<?  include("../function/db.php");?>
<? include("../function/upload.php");

if(isset($_POST['submitcat']))
{
	if(isset($_GET['id'])) { $id_url="&id=".$_GET['id']; }
    $type_url=$_GET['type'];
	$first_cat=$_POST['select_category'];
	redirect_file("content.php?type=$type_url&first_cat=$first_cat".$id_url,$swait);

}else{


?>
<?


//Check access
admin_panel_access("catalog_catalog");

//Zip library
include( $_SERVER["DOCUMENT_ROOT"].site_root."/admin/function/pclzip.lib.php");

$swait=false;

//If the category is new
$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}

//Get type
$type="photo";
if(isset($_GET["type"]))
{
	$type=result($_GET["type"]);
}

//Limits
$lvideo=2048*1024*1000;
$lpreview=2048*1024*1000;
$laudio=2048*1024*1000;
$lvector=2048*1024*1000;



$pub_vars=array();
$pub_vars["category"]=(int)$_POST["category"];
$pub_vars["title"]=result($_POST["title"]);
$pub_vars["description"]=result($_POST["description"]);
$pub_vars["keywords"]=result($_POST["keywords"]);
//$pub_vars["userid"]=user_url($_POST["author"]);
$pub_vars["userid"]=0;
if(isset($_POST["published"]))
{
	$pub_vars["published"]=1;
}
else
{
	$pub_vars["published"]=0;
}
$pub_vars["viewed"]=(int)$_POST["viewed"];
$pub_vars["data"]=mktime((int)$_POST["data_hour"],(int)$_POST["data_minute"],(int)$_POST["data_second"],(int)$_POST["data_month"],(int)$_POST["data_day"],(int)$_POST["data_year"]);
$pub_vars["author"]=result($_POST["author"]);
$pub_vars["content_type"]=result($_POST["content_type"]);
$pub_vars["downloaded"]=(int)$_POST["downloaded"];
$pub_vars["model"]=(int)$_POST["model"];
$pub_vars["examination"]=0;
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
$pub_vars["examination"]=0;
$pub_vars["server1"]=$site_server_activ;
if(isset($_POST["free"]))
{
	$pub_vars["free"]=1;
}
else
{
	$pub_vars["free"]=0;
}
if(isset($_POST["featured"]))
{
	$pub_vars["featured"]=1;
}
else
{
	$pub_vars["featured"]=0;
}
$pub_vars["category2"]=(int)$_POST["category2"];
$pub_vars["category3"]=(int)$_POST["category3"];

if(isset($_POST["adult"]))
{
	$pub_vars["adult"]=1;
}
else
{
	$pub_vars["adult"]=0;
}

if($type=="photo")
{
	$pub_vars["color"]=result($_POST["color"]);

	if(isset($_POST["editorial"]))
	{
		$pub_vars["editorial"]=1;
	}
	else
	{
		$pub_vars["editorial"]=0;
	}
}


if($type=="video")
{
	$pub_vars["duration"]=3600*$_POST["duration_hour"]+60*$_POST["duration_minute"]+(int)$_POST["duration_second"];
	$pub_vars["format"]=result($_POST["format"]);
	$pub_vars["ratio"]=result($_POST["ratio"]);
	$pub_vars["rendering"]=result($_POST["rendering"]);
	$pub_vars["frames"]=result($_POST["frames"]);
	$pub_vars["holder"]=result($_POST["holder"]);
	$pub_vars["usa"]=result($_POST["usa"]);
}


if($type=="audio")
{
	$pub_vars["duration"]=3600*$_POST["duration_hour"]+60*$_POST["duration_minute"]+(int)$_POST["duration_second"];
	$pub_vars["format"]=result($_POST["format"]);
	$pub_vars["source"]=result($_POST["source"]);
	$pub_vars["holder"]=result($_POST["holder"]);
}



if($type=="vector")
{
	$pub_vars["flash_version"]=result($_POST["flash_version"]);
	$pub_vars["script_version"]=result($_POST["script_version"]);
	$pub_vars["flash_width"]=(int)$_POST["flash_width"];
	$pub_vars["flash_height"]=(int)$_POST["flash_height"];
}





if($type=="photo")
{
	if($id==0)
	{
		$id=publication_photo_add();
		$folder=$id;
		publication_photo_upload($id);
		$swait=true;

		if($global_settings["prints"])
		{
			publication_prints_add($id,false);
		}
	}
	else
	{
		publication_photo_update($id,0);
		price_update($id,"photo");
		$folder=$id;
		publication_photo_upload($id);

		if($global_settings["prints"])
		{
			prints_update($id);
		}
	}
}



if($type=="video")
{
	if($id==0)
	{
		$id=publication_video_add();
		$folder=$id;
		publication_video_upload($id);
		$swait=true;
	}
	else
	{
		publication_video_update($id,0);
		price_update($id,"video");
		$folder=$id;
		publication_video_upload($id);
	}
}


if($type=="audio")
{
	if($id==0)
	{
		$id=publication_audio_add();
		$folder=$id;
		publication_audio_upload($id);
		$swait=true;
	}
	else
	{
		publication_audio_update($id,0);
		price_update($id,"audio");
		$folder=$id;
		publication_audio_upload($id);

	}
}





if($type=="vector")
{
	if($id==0)
	{
		$pub_title = explode(' ', $pub_vars["title"]);
$sql="select id from structure where name = 'کد ".$pub_title[1]."' order by id desc";
$rs->open($sql);
if(!$rs->eof)
	{

		$error_d=1;

	}else{$id=publication_vector_add();
		$folder=$id;
		publication_vector_upload($id);
		$swait=true;}

	}
	else
	{
		publication_vector_update($id,0);
		price_update($id,"vector");
		$folder=$id;
		publication_vector_upload($id);
	}
}


if($id!=0)
{
$smarty->clear_cache(null,"item|".$id);
$smarty->clear_cache(null,"share|".$id);
item_url($id);
}


if(isset($_POST["return_url"]) and $_POST["return_url"]!="")
{
	redirect_file($_POST["return_url"].'&error_d='.$error_d,$swait);
}
else
{
	redirect_file("content.php?type=vector&error_d=".$error_d,$swait);
}
}
?>
