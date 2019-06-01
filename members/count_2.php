<?include("../admin/function/db.php");?>
<?include("download_mimes.php");?>
<?
//Define if the publication is remote
$remote_width=0;
$remote_height=0;
$flag_storage=false;
$remote_file="";
$remote_filename="";
$remote_extention="";

if($site_amazon or $site_rackspace)
{
	$sql="select url,filename1,filename2,width,height,item_id from filestorage_files where id_parent=".(int)$_GET["id_parent"]." and item_id<>0";
	$ds->open($sql);
	while(!$ds->eof)
	{
		if($_GET["type"]=="photo")
		{
			$remote_file=$ds->row["url"]."/".$ds->row["filename2"];
			$remote_filename=$ds->row["filename1"];
			$remote_width=$ds->row["width"];
			$remote_height=$ds->row["height"];
		}
		else
		{
			if($ds->row["item_id"]==(int)$_GET["id"])
			{
				$remote_file=$ds->row["url"]."/".$ds->row["filename2"];
				$remote_filename=$ds->row["filename1"];
			}
		}
		$flag_storage=true;
		$ds->movenext();
	}
}

if($flag_storage)
{
	$remote_ext=explode(".",$remote_file);
	$remote_extention=strtolower($remote_ext[count($remote_ext)-1]);
}



$sql="select id,id_parent,url,price,price_id from items where id=".(int)$_GET["id"];
$dr->open($sql);

$flag_free=false;

	if(!$dr->eof)
	{
		if($_GET["type"]=="photo")
		{
			$sql="select free from photos where id_parent=".(int)$_GET["id_parent"];
			$rs->open($sql);
			if(!$rs->eof and $rs->row["free"]==1)
			{
				$flag_free=true;
				
				$sql="update photos set downloaded=downloaded+1 where id_parent=".(int)$_GET["id_parent"];
				$db->execute($sql);
			}
		}
		
		if($_GET["type"]=="video")
		{
			$sql="select free from videos where id_parent=".(int)$_GET["id_parent"];
			$rs->open($sql);
			if(!$rs->eof and $rs->row["free"]==1)
			{
				$flag_free=true;
				
				$sql="update videos set downloaded=downloaded+1 where id_parent=".(int)$_GET["id_parent"];
				$db->execute($sql);
			}
		}
		
		if($_GET["type"]=="audio")
		{
			$sql="select free from audio where id_parent=".(int)$_GET["id_parent"];
			$rs->open($sql);
			if(!$rs->eof and $rs->row["free"]==1)
			{
				$flag_free=true;
				
				$sql="update audio set downloaded=downloaded+1 where id_parent=".(int)$_GET["id_parent"];
				$db->execute($sql);
			}
		}
		
		if($_GET["type"]=="vector")
		{
			$sql="select free from vector where id_parent=".(int)$_GET["id_parent"];
			$rs->open($sql);
			if(!$rs->eof and $rs->row["free"]==1)
			{
				$flag_free=true;
				
				$sql="update vector set downloaded=downloaded+1 where id_parent=".(int)$_GET["id_parent"];
				$db->execute($sql);
			}
		}

		if(!$flag_storage)
		{
			$file_redirect=site_root.server_url((int)$_GET["server"])."/".(int)$_GET["id_parent"]."/".$dr->row["url"];
		}
		

		//Subscription
		
		$subscription_plus=0;
		if($subscription_limit=="Credits")
		{
			$subscription_plus=$dr->row["price"];
		}
		if($subscription_limit=="Downloads")
		{
			$subscription_plus=1;
		}
		if($subscription_limit=="Bandwidth")
		{
			$subscription_plus=filesize($_SERVER["DOCUMENT_ROOT"].$file_redirect)/(1024*1024);
		}
		
		if(($site_subscription==true and isset($_SESSION["people_login"]) and user_subscription($_SESSION["people_login"],(int)$_GET["id_parent"]) and bandwidth_user($_SESSION["people_login"],0)+$subscription_plus<=bandwidth_user($_SESSION["people_login"],1)) or $flag_free)
		{

		    if(date_limit_user($_SESSION["people_login"])< time()+(24*60*60) ){

                if(download_limit_user($_SESSION["people_login"],1) <= download_limit_user($_SESSION["people_login"],0)){


              



		        	if(!$flag_free)
		        	{
			        	$flag_bandwidth_add=downloads_create_subscription((int)$_GET["id"],(int)$_GET["id_parent"]);
		        		if($flag_bandwidth_add)
		        		{
		        			bandwidth_add($_SESSION["people_login"],$subscription_plus);
		        			commission_subscription_add(result($_SESSION["people_login"]),(int)$_GET["id_parent"],(int)$_GET["id"]);
		        		}
		        	}





                }else{



                    }
             }
		}

		else
		{
		 	header("location:".site_root."/members/subscription.php");
			exit();
		}
		//End Subscription
	
	if(!$flag_storage)
	{
		if($_GET["type"]=="photo")
		{
			set_dpi($_SERVER["DOCUMENT_ROOT"].$file_redirect);
		}
		header("location:".$file_redirect);
		exit();
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
	
	}

header("location:".site_root."/index.php");
exit();
?>