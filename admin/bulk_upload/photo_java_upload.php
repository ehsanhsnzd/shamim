<?include("../function/db.php");?>
<?
//Check access
admin_panel_access("catalog_bulkupload");

if(!isset($_POST["author"])){exit();}

//Zip library
include( $_SERVER["DOCUMENT_ROOT"].site_root."/admin/function/pclzip.lib.php" );







$swait=false;


//Upload function
include("../function/upload.php");


$tmp_folder="user_".user_url($_POST["author"]);





$afiles=array();

  $dir = opendir ($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder);
  while ($file = readdir ($dir)) 
  {
    if($file <> "." && $file <> "..")
    {
		if (preg_match("/.zip$/i",$file)) 
		{ 
			$file=result_file($file);
			$afiles[count($afiles)]=$file;
		}
    }
  }
  closedir ($dir);
sort ($afiles);
reset ($afiles);








//Upload set of photos
if(isset($afiles))
{
for($n=0;$n<count($afiles);$n++)
{
$photo="";


$fileName=preg_replace("/\.zip$/i","",$afiles[$n]);
$title=preg_replace("/\.jpg$|\.jpeg$/i","",str_replace("_","",$fileName));


$pub_vars=array();
$pub_vars["category"]=(int)$_POST["category"];
$pub_vars["title"]=$title;
$pub_vars["description"]="";
$pub_vars["keywords"]="";
$pub_vars["userid"]=user_url($_POST["author"]);
$pub_vars["published"]=1;
$pub_vars["viewed"]=0;
$pub_vars["data"]=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
$pub_vars["author"]=result($_POST["author"]);
$pub_vars["content_type"]=$site_content_type;
$pub_vars["downloaded"]=0;
$pub_vars["model"]=0;
$pub_vars["examination"]=0;
$pub_vars["server1"]=$site_server_activ;
$pub_vars["free"]=0;
$pub_vars["category2"]=(int)$_POST["category2"];
$pub_vars["category3"]=(int)$_POST["category3"];

$pub_vars["google_x"]=0;
$pub_vars["google_y"]=0;
$pub_vars["editorial"]=0;
$pub_vars["adult"]=0;


//Add a new photo to the database
$id=publication_photo_add();

//Folder
$folder=$id;


//upload file for sale
$archive = new PclZip($DOCUMENT_ROOT.site_upload_directory."/".$tmp_folder."/".$afiles[$n]);
if ($archive->extract(PCLZIP_OPT_PATH,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder) == true) 
{

	$ext=explode(".",$fileName);
	$filename_old="original.".strtolower($ext[count($ext)-1]);
	

	rename($DOCUMENT_ROOT.$site_servers[$site_server_activ]."/".$folder."/".$filename_old,$DOCUMENT_ROOT.$site_servers[$site_server_activ]."/".$folder."/".$fileName);
		
	//IPTC support
	publication_iptc_add($id,$DOCUMENT_ROOT.$site_servers[$site_server_activ]."/".$folder."/".$fileName);

	//Create photo sizes
	publication_photo_sizes_add($id,$fileName,false);

	
	publication_watermark_add($id,$DOCUMENT_ROOT.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg");

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












redirect_file("../catalog/index.php?category_id=".(int)$_POST["category"],true);
?>