<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_watermark");


$ifolder=$DOCUMENT_ROOT.site_upload_directory."/";


$nf=explode(".",$_FILES['watermark']['name']);

if($_FILES['watermark']['size']>0)
{
	if(2048*1024>=$_FILES['watermark']['size'])
	{
		if($nf[count($nf)-1]=="png")
		{
			move_uploaded_file($_FILES['watermark']['tmp_name'],$ifolder."watermark.png");

			$sql="update watermark set photo='".site_root.site_upload_directory."/watermark.png'";
			$db->execute($sql);	
			
			$_SESSION["site_watermark"]=site_root.site_upload_directory."/watermark.png";
		}	
	}	
}


$sql="update watermark set position=".(int)$_POST["position"];
$db->execute($sql);

$_SESSION["watermark_position"]=(int)$_POST["position"];



header("location:watermark.php");


?>