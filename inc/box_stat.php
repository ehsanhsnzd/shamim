<?
if(!defined("site_root")){exit();}
$box_stat="";

$stat_id="stat|".$lng."|".$site_template_id.$global_settings["allow_photo"].$global_settings["allow_video"].$global_settings["allow_audio"].$global_settings["allow_vector"];

if (!$smarty->is_cached('stat.tpl',$stat_id))
{

	$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."box_stat.tpl");


	$sql="select count(login) as count_login from users where accessdenied=0 and (utype='seller' or utype='common')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$boxcontent=str_replace("{USERS}",$rs->row["count_login"],$boxcontent);
	}

	$vt=0;

	if($global_settings["allow_photo"]==1)
	{
		$sql="select count(id_parent) as count_photos,sum(viewed) as count_viewed from photos where published=1";
		$rs->open($sql);
		if(!$rs->eof)
		{
			$boxcontent=str_replace("{PHOTOS}",$rs->row["count_photos"],$boxcontent);
			$vt+=$rs->row["count_viewed"];
		}
		else
		{
			$boxcontent=str_replace("{PHOTOS}","0",$boxcontent);
		}
	}

	if($global_settings["allow_video"]==1)
	{
		$sql="select count(id_parent) as count_videos,sum(viewed) as count_viewed from videos where published=1";
		$rs->open($sql);
		if(!$rs->eof)
		{
			$boxcontent=str_replace("{VIDEOS}",$rs->row["count_videos"],$boxcontent);
			$vt+=$rs->row["count_viewed"];
		}
		else
		{
			$boxcontent=str_replace("{VIDEOS}","0",$boxcontent);
		}
	}

	if($global_settings["allow_audio"]==1)
	{
		$sql="select count(id_parent) as count_videos,sum(viewed) as count_viewed from audio where published=1";
		$rs->open($sql);
		if(!$rs->eof)
		{
			$boxcontent=str_replace("{AUDIO}",$rs->row["count_videos"],$boxcontent);
			$vt+=$rs->row["count_viewed"];
		}
		else
		{
			$boxcontent=str_replace("{AUDIO}","0",$boxcontent);
		}
	}

	if($global_settings["allow_vector"]==1)
	{
		$sql="select count(id_parent) as count_videos,sum(viewed) as count_viewed from vector where published=1";
		$rs->open($sql);
		if(!$rs->eof)
		{
			$boxcontent=str_replace("{VECTOR}",$rs->row["count_videos"],$boxcontent);
			$vt+=$rs->row["count_viewed"];
		}
		else
		{
			$boxcontent=str_replace("{VECTOR}","0",$boxcontent);
		}
	}



	$boxcontent=str_replace("{VD}",strval($vt),$boxcontent);


	
	$boxcontent=format_layout($boxcontent,"sitephoto",$global_settings["allow_photo"]);
	$boxcontent=format_layout($boxcontent,"sitevideo",$global_settings["allow_video"]);
	$boxcontent=format_layout($boxcontent,"siteaudio",$global_settings["allow_audio"]);
	$boxcontent=format_layout($boxcontent,"sitevector",$global_settings["allow_vector"]);




	$boxcontent=str_replace("{WORD_USERS}",word_lang("photographers"),$boxcontent);
	$boxcontent=str_replace("{WORD_PHOTOS}",word_lang("photos"),$boxcontent);
	$boxcontent=str_replace("{WORD_VIDEOS}",word_lang("videos"),$boxcontent);
	$boxcontent=str_replace("{WORD_AUDIO}",word_lang("audio"),$boxcontent);
	$boxcontent=str_replace("{WORD_VECTOR}",word_lang("vector"),$boxcontent);
	$boxcontent=str_replace("{WORD_VIEWED}",word_lang("viewed"),$boxcontent);
	$box_stat=$boxcontent;
	$box_stat=translate_text($box_stat);
	
}

$smarty->cache_lifetime = 3600*$site_cache_stats;
$smarty->assign("stat",$box_stat);
$box_stat=$smarty->fetch('stat.tpl',$stat_id);


$file_template=str_replace("{BOX_STAT}",$box_stat,$file_template);
?>