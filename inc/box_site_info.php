<?
if(!defined("site_root")){exit();}
$box_site_info="";

$smarty_info_id="info|".$lng."|".$site_template_id.$site_photo.$site_video.$site_audio.$site_vector.$site_credits.$site_subscription;
if (!$smarty->is_cached('info.tpl',$smarty_info_id))
{
	$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."box_site_info.tpl");

	if($site_photo)
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/index.php?sphoto=1",str_replace("{SITE_INFO_TITLE}",word_lang("photos"),$boxcontent));
	}
	if($site_video)
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/index.php?svideo=1",str_replace("{SITE_INFO_TITLE}",word_lang("videos"),$boxcontent));
	}
	if($site_audio)
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/index.php?saudio=1",str_replace("{SITE_INFO_TITLE}",word_lang("audio"),$boxcontent));
	}
	if($site_vector)
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/index.php?svector=1",str_replace("{SITE_INFO_TITLE}",word_lang("vector"),$boxcontent));
	}
	$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/members/categories.php",str_replace("{SITE_INFO_TITLE}",word_lang("Categories"),$boxcontent));

	$box_site_info.="<div>&nbsp;</div>";

	if($site_credits and (!isset($_SESSION["people_type"]) or (isset($_SESSION["people_type"]) and $_SESSION["people_type"]=="buyer")))
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/members/credits.php",str_replace("{SITE_INFO_TITLE}",word_lang("buy credits"),$boxcontent));
	}

	if($site_subscription and $site_credits and  (!isset($_SESSION["people_type"]) or (isset($_SESSION["people_type"]) and $_SESSION["people_type"]=="buyer")))
	{
		$box_site_info.=str_replace("{SITE_INFO_URL}",site_root."/members/subscription.php",str_replace("{SITE_INFO_TITLE}",word_lang("subscription"),$boxcontent));
	}

	$box_site_info.="<div>&nbsp;</div>";


	$sql="select a.id,a.id_parent,b.id_parent,b.title,b.content,b.priority,b.link,b.url from structure a,pages b where a.id=b.id_parent and a.id_parent=4034 order by b.priority";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$url=page_url($rs->row["id"],$rs->row["url"]);

		if($rs->row["link"]!=""){$url=$rs->row["link"];}


		$box_site_info.=str_replace("{SITE_INFO_URL}",$url,str_replace("{SITE_INFO_TITLE}",$rs->row["title"],$boxcontent));
		$rs->movenext();
	}
	
}

$smarty->cache_lifetime = -1;
$smarty->assign("info",$box_site_info);
$box_site_info=$smarty->fetch('info.tpl',$smarty_info_id);
	
	
	

$file_template=str_replace("{BOX_SITE_INFO}",$box_site_info,$file_template);
?>