<?
$nolang=true;
if(isset($_GET["f"]))
{
	$nosession=true;
}
include("../admin/function/db.php");
$flag=false;





//Order photo download
if(isset($_GET["f"]))
{
	$sql="select id_parent,link,data,tlimit,ulimit from downloads where link='".result3($_GET["f"])."' and data>".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))." and tlimit<ulimit+1";
	$ds->open($sql);
	if(!$ds->eof)
	{
		$sql="update downloads set tlimit=tlimit+1 where link='".result3($_GET["f"])."'";
		$db->execute($sql);

		$_GET["u"]=link_download($ds->row["id_parent"],1);
		$server1=link_download($ds->row["id_parent"],2);

		if(preg_match("/.jpg$|.jpeg$/i",$_GET["u"]))
		{

		$sql="select id,name,url,price_id,id_parent from items where 	id=".$ds->row["id_parent"];
		$dn->open($sql);
		if(!$dn->eof)
		{
			//Define remote storage
			$remote_width=0;
			$remote_height=0;
			$flag_storage=false;
			$remote_file="";
			$remote_filename="";
			$remote_extention="";
		
			if($site_amazon or $site_rackspace)
			{
				$sql="select url,filename1,filename2,width,height,item_id from filestorage_files where id_parent=".$dn->row["id_parent"]." and item_id<>0";
				$dr->open($sql);
				if(!$dr->eof)
				{
					$remote_file=$dr->row["url"]."/".$dr->row["filename2"];
					$remote_filename=$dr->row["filename1"];
					$remote_width=$dr->row["width"];
					$remote_height=$dr->row["height"];
					$flag_storage=true;
				}
			}
		
			if($flag_storage)
			{
				$remote_ext=explode(".",$remote_file);
				$remote_extention=strtolower($remote_ext[count($remote_ext)-1]);
			}
	
	
			$sql="select * from sizes where id_parent='".$dn->row["price_id"]."'";
			$rs->open($sql);
			if(!$rs->eof)
			{
				$width=$rs->row["size"];

				$fld=explode("/",$_GET["u"]);

				if(!$flag_storage)
				{
					$size = getimagesize($DOCUMENT_ROOT.$server1."/".$_GET["u"]);
				
					if($size[1]>$size[0])
					{
						$width=$size[0]*$width/$size[1];
					}
				
					if($width!=0 and $width!=$size[0] and !file_exists($DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg"))
					{
						@easyResize($DOCUMENT_ROOT.$server1."/".$_GET["u"],$DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg",100,$width);
					}
					
					if($width==0 or $width==$size[0])
					{
						$photo_file=$DOCUMENT_ROOT.$server1."/".$_GET["u"];
					}
					else
					{
						$photo_file=$DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg";
					}
				}
				else
				{
					if($remote_height>$remote_width and $remote_height!=0)
					{
						$width=$remote_width*$remote_width/$remote_height;
					}
				
					if($width!=0 and $width!=$remote_width and !file_exists($DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg"))
					{
						@easyResize($remote_file,$DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg",100,$width);
					}
				
					if($width==0 or $width==$remote_width)
					{
						$photo_file=$remote_file;
					}
					else
					{
						$photo_file=$DOCUMENT_ROOT.$server1."/".$fld[0]."/photo_".$rs->row["size"].".jpg";
					}	
				}

				if(!$flag_storage)
				{
					set_dpi($photo_file);
				}

				ob_clean();
				header("Content-Type:image/jpeg");
				header("Content-Disposition: attachment; filename=".str_replace(" ","%20",$dn->row["url"]));
				ob_end_flush();
				@readfile($photo_file);
				exit();
			}
		}
	}
	$flag=true;
}
else{echo(word_lang("expired"));exit();}
}
//End. Order photo download



//define folder and filename
$uu=explode("/",$_GET["u"]);


//define if the publication is remote storage
$flag_storage=false;
$remote_file="";
$remote_filename="";
$remote_extention="";
		
if($site_amazon or $site_rackspace)
{
	$sql="select url,filename1,filename2,width,height,item_id from filestorage_files where id_parent=".(int)$uu[count($uu)-2]." and filename1='".result($uu[count($uu)-1])."'";
	$dr->open($sql);
	if(!$dr->eof)
	{
		$remote_file=$dr->row["url"]."/".$dr->row["filename2"];
		$remote_filename=$dr->row["filename1"];
		$flag_storage=true;
	}
		
	if($flag_storage)
	{
		$remote_ext=explode(".",$remote_file);
		$remote_extention=strtolower($remote_ext[count($remote_ext)-1]);
	}
}



//Define content folder
$server1=1;
$sql="select server1 from photos where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof)
{
	$server1=$rs->row["server1"];
}

$sql="select server1 from videos where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof)
{
	$server1=$rs->row["server1"];
}

$sql="select server1 from audio where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof)
{
	$server1=$rs->row["server1"];
}

$sql="select server1 from vector where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof)
{
	$server1=$rs->row["server1"];
}




//Show thumbs
if(preg_match("/thumb|thumbnail|model|avatar|users|blog|categories|xml/",$_GET["u"])){$flag=true;}


//Show free publications
$sql="select free from photos where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof and $rs->row["free"]==1)
{
	$flag=true;
}

$sql="select free from videos where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof and $rs->row["free"]==1)
{
	$flag=true;
}

$sql="select free from audio where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof and $rs->row["free"]==1)
{
	$flag=true;
}

$sql="select free from vector where id_parent=".(int)$uu[count($uu)-2];
$rs->open($sql);
if(!$rs->eof and $rs->row["free"]==1)
{
	$flag=true;
}
//End. Show free publications


//Show photos of approved orders
$sql="select a.id,a.id_parent,a.url,b.id_parent,b.folder,b.free from items a, photos b where a.id_parent=b.id_parent and folder='".result($uu[count($uu)-2])."' and a.url='".result($uu[count($uu)-1])."'";
$rs->open($sql);
if(!$rs->eof)
{
	$id_parent=$rs->row["id_parent"];

	if(isset($_SESSION["people_id"]))
	{
		$sql="select a.id,a.user,a.status,b.id_parent,b.item from orders a,orders_content b where a.id=b.id_parent and a.user=".(int)$_SESSION["people_id"]." and a.status=1 and b.item=".$rs->row["id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$flag=true;
		}
	}
}


//Show videos of approved orders
$sql="select a.id,a.id_parent,a.url,b.id_parent,b.folder,b.free from items a, videos b where a.id_parent=b.id_parent and folder='".result($uu[count($uu)-2])."' and a.url='".result($uu[count($uu)-1])."'";
$rs->open($sql);
if(!$rs->eof)
{
	$id_parent=$rs->row["id_parent"];
	if(isset($_SESSION["people_id"]))
	{
		$sql="select a.id,a.user,a.status,b.id_parent,b.item from orders a,orders_content b where a.id=b.id_parent and a.user=".(int)$_SESSION["people_id"]." and a.status=1 and b.item=".$rs->row["id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$flag=true;
		}
	}
}


//Show audio of approved orders
$sql="select a.id,a.id_parent,a.url,b.id_parent,b.folder,b.free from items a, audio b where a.id_parent=b.id_parent and folder='".result($uu[count($uu)-2])."' and a.url='".result($uu[count($uu)-1])."'";
$rs->open($sql);
if(!$rs->eof)
{
	$id_parent=$rs->row["id_parent"];
	if(isset($_SESSION["people_id"]))
	{
		$sql="select a.id,a.user,a.status,b.id_parent,b.item from orders a,orders_content b where a.id=b.id_parent and a.user=".(int)$_SESSION["people_id"]." and a.status=1 and b.item=".$rs->row["id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$flag=true;
		}
	}
}



//Show vector of approved orders
$sql="select a.id,a.id_parent,a.url,b.id_parent,b.folder,b.free from items a, vector b where a.id_parent=b.id_parent and folder='".result($uu[count($uu)-2])."' and a.url='".result($uu[count($uu)-1])."'";
$rs->open($sql);
if(!$rs->eof)
{
	$id_parent=$rs->row["id_parent"];
	if(isset($_SESSION["people_id"]))
	{
		$sql="select a.id,a.user,a.status,b.id_parent,b.item from orders a,orders_content b where a.id=b.id_parent and a.user=".(int)$_SESSION["people_id"]." and a.status=1 and b.item=".$rs->row["id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$flag=true;
		}
	}
}




if(isset($_SESSION["people_id"]))
{


//Show freedowload file
	$sql="select * from coupons where url='".site_root.server_url($server1)."/".$_GET["u"]."' and used=0 and user='".result($_SESSION["people_login"])."'";
	$ds->open($sql);
	if(!$ds->eof)
	{
	$flag=true;
	}



if($site_subscription==true and  isset($_SESSION["people_login"]) and user_subscription($_SESSION["people_login"],(int)$uu[count($uu)-2]))
{
	if(bandwidth_user($_SESSION["people_login"],0)<=bandwidth_user($_SESSION["people_login"],1))
	{
		$flag=true;
	}
}



}

//Show files in admin panel
if(isset($_SESSION["entry_admin"]))
{
$flag=true;
}

//Show own files of a photographer
if(isset($_SESSION["people_id"]) and isset($_SESSION["people_login"]))
{
	$sql="select id_parent from photos where id_parent=".(int)$uu[count($uu)-2]." and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$flag=true;
	}
	
	$sql="select id_parent from videos where id_parent=".(int)$uu[count($uu)-2]." and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$flag=true;
	}
	
	$sql="select id_parent from audio where id_parent=".(int)$uu[count($uu)-2]." and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$flag=true;
	}
	
	$sql="select id_parent from vector where id_parent=".(int)$uu[count($uu)-2]." and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$flag=true;
	}
}




if($flag==true)
{
	include("download_mimes.php");

	if(!$flag_storage)
	{
		$nf=explode(".",$uu[count($uu)-1]);
		if(isset($mmtype[strtolower($nf[count($nf)-1])]))
		{
			ob_clean();
			header("Content-Type:".$mmtype[strtolower($nf[count($nf)-1])]);
			header("Content-Disposition: attachment; filename=".str_replace(" ","%20",$nf[count($nf)-2]).".".$nf[count($nf)-1]);
			ob_end_flush();
			//@readfile($DOCUMENT_ROOT.server_url($server1)."/".$_GET["u"]);
			readfile_chunked ($DOCUMENT_ROOT.server_url($server1)."/".$_GET["u"]);
		}
	}
	else
	{
		if(isset($mmtype[$remote_extention]))
		{
			ob_clean();
			header("Content-Type:".$mmtype[$remote_extention]);
			header("Content-Disposition: attachment; filename=".$remote_filename);
			ob_end_flush();
			@readfile($remote_file);
			exit();
		}
	}


exit();
}
else
{
	header("Content-Type: image/gif");
	readfile($DOCUMENT_ROOT."/content/access_denied.gif");
	exit();
}
?>