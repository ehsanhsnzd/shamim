<?php include("../admin/function/db.php");?>
<?php

	// Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
	error_reporting(-1);

	// Set plain text headers
	header("Content-type: text/plain; charset=utf-8");

	// Include the SDK
	require_once '../admin/amazon/sdk.class.php';



if($site_amazon==0){exit();}




//amazon server
$amazon_server=0;

//Delete files massive
$delete_mass=array();


//Define all publications from the local server
$sql_local="";
$sql="select id from filestorage where types=2";
$rs->open($sql);
if(!$rs->eof)
{
		$amazon_server=$rs->row["id"];
}




if($amazon_server==0)
{
	exit();
}






$application_key_id = "df408b051acb"; // Obtained from your B2 account page
$application_key = "002bd1e99256337577dde8f7345aecb0e7716bd3ad"; // Obtained from your B2 account page
$credentials = base64_encode($application_key_id . ":" . $application_key);
$url = "https://api.backblazeb2.com/b2api/v2/b2_authorize_account";

$session = curl_init($url);

// Add headers
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Basic " . $credentials;
curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers

curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response
$server_output = curl_exec($session);
curl_close ($session);
$jsonArray = json_decode($server_output,true);
//echo ($jsonArray['authorizationToken']);


$api_url = $jsonArray['apiUrl']; // From b2_authorize_account call
$auth_token = $jsonArray['authorizationToken']; // From b2_authorize_account call
$bucket_id = "0d7f74e0881bc06561aa0c1b";  // The ID of the bucket you want to upload to

$session = curl_init($api_url .  "/b2api/v2/b2_get_upload_url");

// Add post fields
$data = array("bucketId" => $bucket_id);
$post_fields = json_encode($data);
curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields);

// Add headers
$headers = array();
$headers[] = "Authorization: " . $auth_token;
curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

curl_setopt($session, CURLOPT_POST, true); // HTTP POST
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
$server_output = curl_exec($session); // Let's do this!
curl_close ($session); // Clean up
$jsonArray = json_decode($server_output,true);
echo ($server_output); // Tell me about the rabbits, George!





































//
//// Create our new bucket in the US-West region.
//	if ($site_amazon_region == "REGION_US_E1") {$region = AmazonS3::REGION_US_E1;}
//	if ($site_amazon_region == "REGION_US_W1") {$region = AmazonS3::REGION_US_W1;}
//    if ($site_amazon_region == "REGION_EU_W1") {$region = AmazonS3::REGION_EU_W1;}
//    if ($site_amazon_region == "REGION_APAC_SE1") {$region = AmazonS3::REGION_APAC_SE1;}
//    if ($site_amazon_region == "REGION_APAC_NE1") {$region = AmazonS3::REGION_APAC_NE1;}
//
//
	$bucket_files = $site_amazon_prefix. "-files";
	//$container_files = $s3->create_bucket($bucket_files,$region);
	
	$bucket_previews = $site_amazon_prefix. "-previews";
	//$container_previews = $s3->create_bucket($bucket_previews,$region);

	/*
	if (!$container_files->isOK())
	{
	 	echo("Error. It is impossible to create the bucket '".$bucket_files."'");
	 	exit();
	}
	
	if (!$container_previews->isOK())
	{
	 	echo("Error. It is impossible to create the bucket '".$bucket_previews."'");
	 	exit();
	}
	*/


//Select all publications
$sql="(select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.folder,b.server1,b.server2 from structure a,photos b where b.published=1 and a.id=b.id_parent  and b.server2=0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.folder,b.server1,b.server2 from structure a,videos b where b.published=1 and a.id=b.id_parent and b.server2=0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.folder,b.server1,b.server2 from structure a,audio b where b.published=1 and a.id=b.id_parent and b.server2=0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.folder,b.server1,b.server2 from structure a,vector b where b.published=1 and a.id=b.id_parent and b.server2=0) order by adata desc limit 0,5";
//echo($sql);
$rs->open($sql);
while(!$rs->eof)
{
	$storage_flag=true;
	
	$message_log="";
	
	$publication_path=$_SERVER["DOCUMENT_ROOT"].site_root.server_url($rs->row["server1"])."/".$rs->row["folder"];
	//echo($publication_path."<br>");
	
	//Define items for every publication
	$items_mass=array();
	$sql="select id,url from items where id_parent=".$rs->row["id"]." and shipped<>1";
	$ds->open($sql);
	while(!$ds->eof)
	{
		if($ds->row["url"]!="")
		{
			$items_mass[$ds->row["url"]]=$ds->row["id"];
		}
		$ds->movenext();
	}
	
	//View publication's folders
	$dir = opendir ($publication_path);
  			while ($file = readdir ($dir)) 
  			{
				if($file <> "." && $file <> ".." && $file <> '.DS_Store')
    			{
					//echo($publication_path."/".$file."<br>");
					
					$width=0;
					$height=0;
					if(preg_match("/\.jpg$/i",$file) or preg_match("/\.jpeg$/i",$file))
					{
						$size = getimagesize($publication_path."/".$file);
						$width=$size[0];
						$height=$size[1];
					}
					
					if(preg_match("/thumb/i",$file)) 
					{ 
						$new_filename=$rs->row["id"]."_".$file;
//						$s3->batch()->create_object($bucket_previews,$new_filename , array(
//                'fileUpload' => $publication_path."/".$file,
//                'acl' => AmazonS3::ACL_PUBLIC,
//            ));



















                        $file_name = $publication_path."/".$file;
                        $my_file = "" . $file_name;
                        $handle = fopen($my_file, 'r');
                        $read_file = fread($handle, filesize($my_file));


                        $upload_url = $jsonArray['uploadUrl']; // Provided by b2_get_upload_url
                        $upload_auth_token = $jsonArray['authorizationToken']; // Provided by b2_get_upload_url
                        $bucket_id =  $jsonArray['bucketId'];  // The ID of the bucket
                        $content_type = "text/plain";
                        $sha1_of_file_data = sha1_file($my_file);

                        $session = curl_init($upload_url);




// Add read file as post field
                        curl_setopt($session, CURLOPT_POSTFIELDS, $read_file);

// Add headers
                        $headers = array();
                        $headers[] = "Authorization: " .$jsonArray['authorizationToken'];
                        $headers[] = "X-Bz-File-Name: " . $new_filename;
                        $headers[] = "Content-Type: " . $content_type;
                        $headers[] = "X-Bz-Content-Sha1: " . $sha1_of_file_data;
                        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

                        curl_setopt($session, CURLOPT_POST, true); // HTTP POST
                        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
                        $server_output = curl_exec($session); // Let's do this!
                        curl_close($session); // Clean up
                        $jsonArray = json_decode($server_output,true);
                        echo($server_output); // Tell me about the rabbits, George!
















//                        $file_upload_response = $s3->batch()->send();
						
						$message_log.="The file ".$file." has been moved to BackBlaze<br>";

                        if ($jsonArray['uploadTimestamp'])
                        {
//							$uri=$s3->get_object_url($bucket_files,$new_filename);
                            $uri="https://f002.backblazeb2.com/file/shamimgraphic/".$new_filename;
							$url=explode("/".$new_filename,$uri);
						
							$sql="select id_parent from filestorage_files where id_parent=".$rs->row["id"]." and item_id=0 and filename1='".$file."'";
							$ds->open($sql);
							if($ds->eof)
							{
								$sql="insert into filestorage_files (id_parent,item_id,url,filename1,filename2,filesize,server1,pdelete,width,height) values (".$rs->row["id"].",0,'".$url[0]."','".$file."','".$new_filename."',".filesize($publication_path."/".$file).",".$amazon_server.",0,".$width.",".$height.")";
								$db->execute($sql);
							}
						}
						else
						{
							$storage_flag=false;
						}
					}
					else
					{
						//Define extention
						$file_mass=explode(".",$file);
						$file_extention=$file_mass[count($file_mass)-1];
						
						$new_filename=$rs->row["id"]."_".md5(create_password().$rs->row["id"].create_password()).".".$file_extention;
						
//						$s3->batch()->create_object($bucket_files,$new_filename , array(
//                'fileUpload' => $publication_path."/".$file,
//                'acl' => AmazonS3::ACL_PUBLIC,
//            ));




















                        $file_name = $publication_path."/".$file;
                        $my_file = "" . $file_name;
                        $handle = fopen($my_file, 'r');
                        $read_file = fread($handle, filesize($my_file));


                        $upload_url = $jsonArray['uploadUrl']; // Provided by b2_get_upload_url
                        $upload_auth_token = $jsonArray['authorizationToken']; // Provided by b2_get_upload_url
                        $bucket_id =  $jsonArray['bucketId'];  // The ID of the bucket
                        $content_type = "text/plain";
                        $sha1_of_file_data = sha1_file($my_file);

                        $session = curl_init($upload_url);




// Add read file as post field
                        curl_setopt($session, CURLOPT_POSTFIELDS, $read_file);

// Add headers
                        $headers = array();
                        $headers[] = "Authorization: " .$jsonArray['authorizationToken'];
                        $headers[] = "X-Bz-File-Name: " . $new_filename;
                        $headers[] = "Content-Type: " . $content_type;
                        $headers[] = "X-Bz-Content-Sha1: " . $sha1_of_file_data;
                        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

                        curl_setopt($session, CURLOPT_POST, true); // HTTP POST
                        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
                        $server_output = curl_exec($session); // Let's do this!
                        curl_close($session); // Clean up
                        $jsonArray = json_decode($server_output,true);
                        echo($server_output); // Tell me about the rabbits, George!



















//						$file_upload_response = $s3->batch()->send();
						
						if ($jsonArray['uploadTimestamp'])
        				{
//							$uri=$s3->get_object_url($bucket_files,$new_filename);
							$uri="https://f002.backblazeb2.com/file/shamimgraphic/".$new_filename;
							$url=explode("/".$new_filename,$uri);
							
							$message_log.="The file ".$file." has been moved to Amazon S3<br>";
						
						
							if(isset($items_mass[$file]))
							{
								$sql="select id_parent from filestorage_files where id_parent=".$rs->row["id"]." and item_id=".$items_mass[$file];
								$ds->open($sql);
								if($ds->eof)
								{
									$sql="insert into filestorage_files (id_parent,item_id,url,filename1,filename2,filesize,server1,pdelete,width,height) values (".$rs->row["id"].",".$items_mass[$file].",'".$url[0]."','".$file."','".$new_filename."',".filesize($publication_path."/".$file).",".$amazon_server.",0,".$width.",".$height.")";
									$db->execute($sql);
								}
								else
								{
									$sql="update filestorage_files set filename1='".$file."',filename2='".$new_filename."',url='".$url[0]."',filesize=".filesize($publication_path."/".$file).",width=".$width.",height=".$height." where id_parent=".$rs->row["id"]." and item_id=".$items_mass[$file];
									$db->execute($sql);
								}
							}
						}
						else
						{
							$storage_flag=false;
						}
					}
    			}
 			 }
  			closedir ($dir);
	
	unset($items_mass);
	
	$delete_mass[]=$rs->row["id"];
	
	if($storage_flag==true)
	{
		if($rs->row["module_table"]==30)
		{
			$sql="update photos set server2=".$amazon_server." where id_parent=".$rs->row["id"];
			$db->execute($sql);
		}
		if($rs->row["module_table"]==31)
		{
			$sql="update videos set server2=".$amazon_server." where id_parent=".$rs->row["id"];
			$db->execute($sql);
		}
		if($rs->row["module_table"]==52)
		{
			$sql="update audio set server2=".$amazon_server." where id_parent=".$rs->row["id"];
			$db->execute($sql);
		}
		if($rs->row["module_table"]==53)
		{
			$sql="update vector set server2=".$amazon_server." where id_parent=".$rs->row["id"];
			$db->execute($sql);
		}
		
		$message_log.="The publication ID = ".$rs->row["id"]." has been moved to the amazon server.<br>";
	}
	else
	{
		$message_log.="Error. The publication ID = ".$rs->row["id"]." wasn't moved to the amazon server.<br>";
	}
	
	//Logs
	$sql="insert into filestorage_logs (publication_id,logs,data) values (".$rs->row["id"].",'".$message_log."',".date_default_timezone_set('America/Los_Angeles').")";
	$db->execute($sql);
	//echo($message_log);
	
	
	$rs->movenext();
}


//delete files from the local server
for($i=0;$i<count($delete_mass);$i++)
{
	delete_files((int)$delete_mass[$i],false);
}


//Delete removed files from the clouds server
//
//$sql="select filename2,item_id,filename1,id_parent,pdelete from filestorage_files where pdelete=1";
//$rs->open($sql);
//while(!$rs->eof)
//{
//	$delete_flag=true;
//
//	if($rs->row["item_id"]==0)
//	{
//		$s3->batch()->delete_object($bucket_previews,$rs->row["filename2"]);
//		$file_upload_response = $s3->batch()->send();
//		if (!$file_upload_response->areOK())
//        {
//        	$delete_flag=false;
//        }
//	}
//	else
//	{
//		$s3->batch()->delete_object($bucket_files,$rs->row["filename2"]);
//		$file_upload_response = $s3->batch()->send();
//		if (!$file_upload_response->areOK())
//        {
//        	$delete_flag=false;
//        }
//	}
//
//	if($delete_flag)
//	{
//		$sql="delete from filestorage_files where id_parent=".$rs->row["id_parent"]." and filename2='".$rs->row["filename2"]."'";
//		$db->execute($sql);
//	}
//
//
//
//	$rs->movenext();
//}
//


?>