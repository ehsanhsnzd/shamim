<?
$nolang=true;
include("../admin/function/db.php");



header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: image/jpg");


//Define photo
if($_GET["width"]<=$site_thumb_width2+300 and $_GET["height"]<=$site_thumb_height2+300)
{
	//Define types
	$module_table=30;
	$sql="select module_table from structure where id=".(int)$_GET["id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		$module_table=$rs->row["module_table"];
	}
	
	if($module_table==30)
	{
		$sql="select folder,server1,id_parent from photos where id_parent=".(int)$_GET["id"];
	}else
	{
		$sql="select folder,server1,id_parent from vector where id_parent=".(int)$_GET["id"];
	}
	
	$rs->open($sql);
	if(!$rs->eof)
	{
		$flag_storage=false;
		$file_url="";
		$file_width=0;
		$file_height=0;
		$file_url_vector="";
		$file_width_vector=0;
		$file_height_vector=0;
		$file_url_thumb="";

		if($site_amazon or $site_rackspace)
		{
			$sql="select url,filename2,filename1,width,height,item_id from filestorage_files where id_parent=".$rs->row["id_parent"];
			$ds->open($sql);
			while(!$ds->eof)
			{
				if($ds->row["item_id"]!=0)
				{
					$file_url=$ds->row["url"]."/".$ds->row["filename2"];
					$file_width=$ds->row["width"];
					$file_height=$ds->row["height"];
				}
			
				if($ds->row["item_id"]==0 and preg_match("/thumb2/",$ds->row["filename1"]))
				{
					$file_url_thumb=$ds->row["url"]."/".$ds->row["filename2"];
				}
						
				if($ds->row["filename1"]=="thumb_original.jpg")
				{
					$file_url_vector=$ds->row["url"]."/".$ds->row["filename2"];
					$file_width_vector=$ds->row["width"];
					$file_height_vector=$ds->row["height"];
				}
			
				$flag_storage=true;
				$ds->movenext();
			}
		}



		$afile="";
		if($module_table==30)
		{
			$sql="select url from items where id_parent=".(int)$_GET["id"];
			$ds->open($sql);
			if(!$ds->eof)
			{
				$afile=$ds->row["url"];
			}
			else
			{
				$dir = opendir ($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$rs->row["folder"]);
  				while ($file = readdir ($dir)) 
 				{
    				if($file <> "." && $file <> "..")
    				{
						if(preg_match("/.jpg$|.jpeg$/i",$file) and !preg_match("/thumb/",$file) and !preg_match("/photo_[0-9]+/",$file)) 
						{
							$afile=$file;
						}
    				}
  				}
 				closedir ($dir);
			}
		}
		else
		{
			$afile="thumb_original.jpg";
		}


		if($afile!="" or $flag_storage)
		{
			if($flag_storage)
			{
				if($module_table==30)
				{
					$img_sourse=$file_url;
					$size[0]=$file_width;
					$size[1]=$file_height;
				}
				else
				{
					$img_sourse=$file_url_vector;
					$size[0]=$file_width_vector;
					$size[1]=$file_height_vector;
				}
			}
			else
			{
				$img_sourse=$_SERVER["DOCUMENT_ROOT"].site_root.server_url($rs->row["server1"])."/".$rs->row["folder"]."/".$afile;
				$size = getimagesize($img_sourse); 
			}
			$png_file=$_SERVER["DOCUMENT_ROOT"].$site_watermark;

			if($_GET["z"]<16)
			{
				$im_in = ImageCreateFromJPEG($img_sourse); 
				$im_out = imagecreatetruecolor($_GET["width"],$_GET["height"]); 

				$w1=round($size[0]/$_GET["z"]);
				$h1=round($size[1]/$_GET["z"]);

				$k1=$size[0]/$_GET["width"];
				$k2=$size[1]/$_GET["height"];

				$xn=round($k1*($_GET["x1"]+$_GET["x0"]));
				$yn=round($k2*($_GET["y1"]+$_GET["y0"]));

				if($xn+$w1>$size[0]){$xn=$size[0]-$w1;}
				if($yn+$h1>$size[1]){$yn=$size[1]-$h1;}

				fastimagecopyresampled($im_out, $im_in, 0, 0,$xn,$yn,$_GET["width"],$_GET["height"],$w1,$h1); 

				if(file_exists($png_file) and preg_match("/png$/i",$png_file))
				{
					$im1 = imagecreatefrompng($png_file); 
					$sz = array($_GET["width"],$_GET["height"]);
					$wz = getimagesize($png_file);

					$px=0;
					$py=0;
					if($wz[0]<$sz[0] and $wz[1]<$sz[1])
					{
						if($watermark_position==1)
						{
							$px=0;
							$py=0;
						}
						elseif($watermark_position==2)
						{
							$px=($sz[0]-$wz[0])/2;
							$py=0;
						}
						elseif($watermark_position==3)
						{
							$px=$sz[0]-$wz[0];
							$py=0;
						}
						elseif($watermark_position==4)
						{
							$px=0;
							$py=($sz[1]-$wz[1])/2;
						}
						elseif($watermark_position==5)
						{
							$px=($sz[0]-$wz[0])/2;
							$py=($sz[1]-$wz[1])/2;
						}
						elseif($watermark_position==6)
						{
							$px=$sz[0]-$wz[0];
							$py=($sz[1]-$wz[1])/2;
						}
						elseif($watermark_position==7)
						{
							$px=0;
							$py=$sz[1]-$wz[1];
						}
						elseif($watermark_position==8)
						{
							$px=($sz[0]-$wz[0])/2;
							$py=$sz[1]-$wz[1];
						}
						else
						{
							$px=$sz[0]-$wz[0];
							$py=$sz[1]-$wz[1];
						}
					}
					imagecopy($im_out,$im1, $px, $py, 0, 0,$wz[0],$wz[1]);
				}

				ImageJPEG($im_out); 
			}
			else
			{
				if($flag_storage)
				{
					readfile($file_url_thumb);
				}
				else
				{
					readfile($_SERVER["DOCUMENT_ROOT"].site_root.server_url($rs->row["server1"])."/".$rs->row["folder"]."/thumb2.jpg");
				}
			}
		}
	}
}
?>