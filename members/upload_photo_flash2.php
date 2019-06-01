<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?if(userupload==0){header("location:profile.php");}?>
<?
$sql="select * from user_category where name='".result($_SESSION["people_category"])."'";
$dn->open($sql);
if(!$dn->eof and $dn->row["upload"]==1)
{
$lphoto=$dn->row["photolimit"];



$swait=false;


//Upload function
include("../admin/function/upload.php");


$tmp_folder="user_".(int)$_SESSION["people_id"];





$afiles=array();

  $dir = opendir ($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder);
  while ($file = readdir ($dir)) 
  {

    if($file <> "." && $file <> "..")
    {
	if (preg_match("/.jpg$|.jpeg$/i",$file) and !preg_match("/thumb/i",$file)) 
	{ 
	$file=result_file($file);
	$afiles[count($afiles)]=$file;
	}
    }
  }
  closedir ($dir);
sort ($afiles);
reset ($afiles);



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






//Upload set of photos
if(isset($afiles))
{
for($n=0;$n<count($afiles);$n++)
{
$photo="";


$fileName=preg_replace("/\.jpg$/i","",$afiles[$n]);
$title=str_replace("_","",$fileName);



$pub_vars=array();
$pub_vars["category"]=(int)$_POST["folder"];
$pub_vars["title"]=$title;
$pub_vars["description"]="";
$pub_vars["keywords"]="";
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

//Add a new photo to the database
$id=publication_photo_add();

//Folder
$folder=$id;


//upload file for sale
if(filesize($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$afiles[$n])>0)
{
	$photo=site_root.$site_servers[$site_server_activ]."/".$folder."/".$afiles[$n];
	$photo_thumb1=site_root."/content/".$folder."/".$fileName."_thumb1.jpg";
	$photo_thumb2=site_root."/content/".$folder."/".$fileName."_thumb1.jpg";
	$size = getimagesize ($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$afiles[$n]);

	//Copy original photo
	@copy($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$afiles[$n],$_SERVER["DOCUMENT_ROOT"].$photo);

	//Copy thumb1
	if(file_exists($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$fileName."_thumb1.jpg"))
	{
		@copy($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$fileName."_thumb1.jpg",$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb1.jpg");
	}

	//Copy thumb2
	if(file_exists($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$fileName."_thumb2.jpg"))
	{
		@copy($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$fileName."_thumb2.jpg",$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg");


		publication_watermark_add($id,$DOCUMENT_ROOT.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg");

	}


$swait=true;
}










if($photo!="")
{
	//IPTC support
	publication_iptc_add($id,$DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$afiles[$n]);

	//Create photo sizes
	publication_photo_sizes_add($id,$afiles[$n],false);

}











//prints
if($site_prints_users==true)
{
publication_prints_add($id,false);
}












//End upload files
}
}







//Remove temp files
  $dir = opendir ($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder);
  while ($file = readdir ($dir)) 
  {
    if($file <> "." && $file <> "..")
    {
@unlink($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$file);
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

redirect_file($rurl,$swait);



}
?>