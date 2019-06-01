<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("catalog_bulkupload");

include("../function/upload.php");

$swait=false;



$afiles=array();

  $dir = opendir ($_SERVER["DOCUMENT_ROOT"].site_root.photopreupload);
  while ($file = readdir ($dir)) 
  {
    if($file <> "." && $file <> "..")
    {
		if(preg_match("/.jpg$|.jpeg$/i",$file)) 
		{ 
			$afiles[count($afiles)]=$file;
		}
    }
  }
closedir ($dir);
sort ($afiles);
reset ($afiles);





for($j=0;$j<count($afiles);$j++)
{
	if(isset($_POST["f".$j]))
	{
		$photo="";

		if($_POST["file".$j]!="")
		{
			$title=result($_POST["title".$j]);
			if($title=="")
			{
				$ttl=explode(".",$_POST["file".$j]);
				$title=str_replace("_","",$ttl[0]);
			}

			$pub_vars=array();
			$pub_vars["category"]=(int)$_POST["category"];
			$pub_vars["title"]=$title;
			$pub_vars["description"]=result($_POST["description".$j]);
			$pub_vars["keywords"]=result($_POST["keywords".$j]);
			//$pub_vars["userid"]=user_url($_POST["author"]);
			$pub_vars["userid"]=0;
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

			$folder=$id;

			$photo=site_root.photopreupload.$_POST["file".$j];

			//create thumbs and watermark
			if($photo!="" and preg_match("/.jpg$|.jpeg$/i",$photo) and !file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb1.jpg")) 
			{ 
				photo_resize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb1.jpg",1);

				photo_resize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg",2);
				
				publication_watermark_add($id,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg");
			}

			//create different dimensions
			if($photo!="")
			{
				copy($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$_POST["file".$j]);
				$file=$_POST["file".$j];
				publication_photo_sizes_add($id,$file,false);
	
				//Google coordinates
				$exif_info=@exif_read_data($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$_POST["file".$j],0,true);
				if(isset($exif_info["GPS"]["GPSLongitude"]) and isset($exif_info["GPS"]['GPSLongitudeRef']) and isset($exif_info["GPS"]["GPSLatitude"]) and isset($exif_info["GPS"]['GPSLatitudeRef']))
				{
					$lon = getGps($exif_info["GPS"]["GPSLongitude"], $exif_info["GPS"]['GPSLongitudeRef']);
					$lat = getGps($exif_info["GPS"]["GPSLatitude"], $exif_info["GPS"]['GPSLatitudeRef']);
		
					$sql="update photos set google_x=".$lat.",google_y=".$lon." where id_parent=".$id;
					$db->execute($sql);
				}
			}

			//Prints
			if($site_prints)
			{
				publication_prints_add($id,false);
			}
		}
		
		if(isset($_POST["remove"]))
		{
			@unlink($_SERVER["DOCUMENT_ROOT"].$photo);
		}
	}
}



//go back
redirect_file("../catalog/index.php?category_id=".(int)$_POST["category"],true);
?>