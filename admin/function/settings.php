<?
if(!defined("site_root")){exit();}


$global_settings=array();

//Define a template
$site_template_home=0;
$site_template_id=0;
$site_home_separated=false;
$template_flag=false;
if(isset($_GET["template"]))
{
	$sql="select id from templates where id=".(int)$_GET["template"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		setcookie("template",(int)$_GET["template"],time()+60*60*2,"/");
		$template_flag=true;
	}
}


if(isset($_COOKIE["template"]))
{
	$crm=" id=".(int)$_COOKIE["template"];
}
elseif(isset($_GET["template"]) and $template_flag==true)
{
	$crm=" id=".(int)$_GET["template"];
}
else
{
	$crm="activ=1";
}

$sql="select id,url,shome,home from templates where ".$crm;
$rs->open($sql);
if(!$rs->eof)
{
	$site_template_id=$rs->row["id"];
	$site_template_url=$rs->row["url"];
	if($rs->row["shome"]==1)
	{
		$site_home_separated=true;
	}
	$site_template_home=$rs->row["home"];
}
else
{
	$site_template_url="";
}



//Define server
$site_server_activ=1;
$site_servers=array();
if(!isset($_SESSION["site_server_activ"]) or !isset($_SESSION["site_server"]))
{
	$sql="select id,url,activ from filestorage order by id";
	$rs->open($sql);
	while(!$rs->eof)
	{
		if($rs->row["activ"]==1)
		{
			$site_server_activ=$rs->row["id"];
			$_SESSION["site_server_activ"]=$site_server_activ;
		}
		$site_servers[$rs->row["id"]]=$rs->row["url"];
		$_SESSION["site_server"][$rs->row["id"]]=$rs->row["url"];
		$rs->movenext();
	}
}
else
{
	$site_server_activ=$_SESSION["site_server_activ"];
	foreach ($_SESSION["site_server"] as $key => $value) 
	{
		$site_servers[$key]=$value;
	}
}




$site_name="";
$site_admin_email="";
$site_lightbox_photo=false;
$site_lightbox_video=false;
$site_photo=false;
$site_video=false;
$site_audio=false;
$site_vector=false;
$site_blog=false;
$site_messages=false;
$site_testimonials=false;
$site_reviews=false;
$site_friends=false;
$site_prints=false;
$site_prints_users=false;
$site_video_remote=false;
$site_audio_remote=false;
$site_vector_remote=false;
$site_printsonly=false;
$site_watermarkinfo=false;
$site_downloadsample=false;
$site_moneyorder=false;
$site_credits=false;
$site_subscription=false;
$site_subscription_only=false;
$site_related_items=false;
$site_zoomer=false;
$site_ffmpeg=false;
$site_model=false;
$site_show_model=false;
$site_flash=false;
$site_flash_width=0;
$site_flash_height=0;
$site_examination=false;
$site_google=false;
$site_exif=false;
$site_affiliate=false;
$site_common_account=false;
$site_bulk_upload=10;
$site_captcha=false;
$site_captcha_public="";
$site_captcha_private="";
$site_guest=false;
$site_content_type="";
$site_related_items_quantity=0;
$site_moderation=1;
$site_signup=1;


//Affiliates
$affiliate_buyer_commission=0;
$affiliate_seller_commission=0;
if(!isset($_SESSION["affiliate_buyer_commission"]) or !isset($_SESSION["affiliate_seller_commission"]))
{
	$sql="select meaning,id from affiliates_settings";
	$rs->open($sql);
	while(!$rs->eof)
	{
		if($rs->row["id"]==1)
		{
			$affiliate_buyer_commission=$rs->row["meaning"];
			$_SESSION["affiliate_buyer_commission"]=$affiliate_buyer_commission;
		}
		else
		{
			$affiliate_seller_commission=$rs->row["meaning"];
			$_SESSION["affiliate_seller_commission"]=$affiliate_seller_commission;
		}
		$rs->movenext();
	}
}
else
{
	$affiliate_buyer_commission=result($_SESSION["affiliate_buyer_commission"]);
	$affiliate_seller_commission=result($_SESSION["affiliate_seller_commission"]);
}


//Subscription limit
$subscription_limit="Credits";
if(!isset($_SESSION["subscription_limit"]))
{
	$sql="select name from subscription_limit where activ=1";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$subscription_limit=$rs->row["name"];
		$_SESSION["subscription_limit"]=$subscription_limit;
	}
}
else
{
	$subscription_limit=result($_SESSION["subscription_limit"]);
}





//FFMPEG
if(!isset($_SESSION["site_ffmpeg"]) or !isset($_SESSION["site_ffmpeg_width"])  or !isset($_SESSION["site_ffmpeg_height"]))
{
	$sql="select ffmpeg,video_width,video_height from ffmpeg";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$site_ffmpeg=$rs->row["ffmpeg"];
		$_SESSION["site_ffmpeg"]=$site_ffmpeg;
		
		$site_ffmpeg_width=$rs->row["video_width"];
		$_SESSION["site_ffmpeg_width"]=$site_ffmpeg_width;
		
		$site_ffmpeg_height=$rs->row["video_height"];
		$_SESSION["site_ffmpeg_height"]=$site_ffmpeg_height;
	}
}
else
{
	$site_ffmpeg=result($_SESSION["site_ffmpeg"]);
	$site_ffmpeg_width=result($_SESSION["site_ffmpeg_width"]);
	$site_ffmpeg_height=result($_SESSION["site_ffmpeg_height"]);
}


//Setings



$sql="select setting_key,svalue,activ from settings";
$rs->open($sql);
while(!$rs->eof)
{
	if($rs->row["setting_key"]=='lightbox_photo' or $rs->row["setting_key"]=='lightbox_video' or $rs->row["setting_key"]=='userupload' or $rs->row["setting_key"]=='usa_2257' or $rs->row["setting_key"]=='allow_photo' or $rs->row["setting_key"]=='allow_video' or $rs->row["setting_key"]=='allow_audio' or $rs->row["setting_key"]=='blog' or $rs->row["setting_key"]=='messages' or $rs->row["setting_key"]=='testimonials' or $rs->row["setting_key"]=='reviews' or $rs->row["setting_key"]=='friends' or $rs->row["setting_key"]=='prints' or $rs->row["setting_key"]=='photo_remote' or $rs->row["setting_key"]=='video_remote' or $rs->row["setting_key"]=='audio_remote' or $rs->row["setting_key"]=='printsonly' or $rs->row["setting_key"]=='watermarkinfo' or $rs->row["setting_key"]=='allow_vector' or $rs->row["setting_key"]=='vector_remote' or $rs->row["setting_key"]=='credits' or $rs->row["setting_key"]=='download_sample' or $rs->row["setting_key"]=='moneyorder' or $rs->row["setting_key"]=='subscription' or $rs->row["setting_key"]=='subscription_only' or $rs->row["setting_key"]=='common_account' or $rs->row["setting_key"]=='related_items' or $rs->row["setting_key"]=='zoomer' or $rs->row["setting_key"]=='moderation' or $rs->row["setting_key"]=='prints_users' or $rs->row["setting_key"]=='model' or $rs->row["setting_key"]=='show_model' or $rs->row["setting_key"]=='flash' or $rs->row["setting_key"]=='examination' or $rs->row["setting_key"]=='google_coordinates' or $rs->row["setting_key"]=='exif' or $rs->row["setting_key"]=='affiliates' or $rs->row["setting_key"]=='google_captcha' or $rs->row["setting_key"]=='site_guest' or $rs->row["setting_key"]=='java_uploader' or $rs->row["setting_key"]=='flash_uploader' or $rs->row["setting_key"]=='jquery_uploader' or $rs->row["setting_key"]=='seller_prices' or $rs->row["setting_key"]=='language_detection' or $rs->row["setting_key"]=='adult_content' or $rs->row["setting_key"]=='prints_photos' or $rs->row["setting_key"]=='prints_vectors' or $rs->row["setting_key"]=='flow' or $rs->row["setting_key"]=='flow_default' or $rs->row["setting_key"]=='auto_paging' or $rs->row["setting_key"]=='auto_paging_default')
	{
		$global_settings[$rs->row["setting_key"]]=(int)$rs->row["activ"];
	}
	else
	{
		$global_settings[$rs->row["setting_key"]]=$rs->row["svalue"];
	}
	
	
	if($rs->row["setting_key"]=='site_name'){$site_name=$rs->row["svalue"];}


	if($rs->row["setting_key"]=='admin_email')
	{
		$site_admin_email=$rs->row["svalue"];
		define( "admin_email", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='from_email')
	{
		define( "from_email", $rs->row["svalue"] );
	}



	if($rs->row["setting_key"]=='thumb_width'){$site_thumb_width=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='thumb_width2'){$site_thumb_width2=$rs->row["svalue"];}

	if($rs->row["setting_key"]=='thumb_height'){$site_thumb_height=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='thumb_height2'){$site_thumb_height2=$rs->row["svalue"];}


	if($rs->row["setting_key"]=='lightbox_photo' and $rs->row["activ"]==1){$site_lightbox_photo=true;}
	if($rs->row["setting_key"]=='lightbox_video' and $rs->row["activ"]==1){$site_lightbox_video=true;}
	if($rs->row["setting_key"]=='allow_photo' and $rs->row["activ"]==1){$site_photo=true;}
	if($rs->row["setting_key"]=='allow_video' and $rs->row["activ"]==1){$site_video=true;}
	if($rs->row["setting_key"]=='allow_audio' and $rs->row["activ"]==1){$site_audio=true;}
	if($rs->row["setting_key"]=='allow_vector' and $rs->row["activ"]==1){$site_vector=true;}
	if($rs->row["setting_key"]=='blog' and $rs->row["activ"]==1){$site_blog=true;}
	if($rs->row["setting_key"]=='messages' and $rs->row["activ"]==1){$site_messages=true;}
	if($rs->row["setting_key"]=='testimonials' and $rs->row["activ"]==1){$site_testimonials=true;}
	if($rs->row["setting_key"]=='reviews' and $rs->row["activ"]==1){$site_reviews=true;}
	if($rs->row["setting_key"]=='friends' and $rs->row["activ"]==1){$site_friends=true;}
	if($rs->row["setting_key"]=='prints' and $rs->row["activ"]==1){$site_prints=true;}
	if($rs->row["setting_key"]=='prints_users' and $rs->row["activ"]==1){$site_prints_users=true;}
	if($rs->row["setting_key"]=='model' and $rs->row["activ"]==1){$site_model=true;}
	if($rs->row["setting_key"]=='show_model' and $rs->row["activ"]==1){$site_show_model=true;}
	if($rs->row["setting_key"]=='flash' and $rs->row["activ"]==1){$site_flash=true;}
	if($rs->row["setting_key"]=='flash_width'){$site_flash_width=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='flash_height'){$site_flash_height=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='bulk_upload'){$site_bulk_upload=$rs->row["svalue"];}

	if($rs->row["setting_key"]=='video_remote' and $rs->row["activ"]==1){$site_video_remote=true;}
	if($rs->row["setting_key"]=='audio_remote' and $rs->row["activ"]==1){$site_audio_remote=true;}
	if($rs->row["setting_key"]=='vector_remote' and $rs->row["activ"]==1){$site_vector_remote=true;}
	if($rs->row["setting_key"]=='printsonly' and $rs->row["activ"]==1){$site_printsonly=true;}
	if($rs->row["setting_key"]=='watermarkinfo' and $rs->row["activ"]==1){$site_watermarkinfo=true;}
	if($rs->row["setting_key"]=='download_sample' and $rs->row["activ"]==1){$site_downloadsample=true;}
	if($rs->row["setting_key"]=='moneyorder' and $rs->row["activ"]==1){$site_moneyorder=true;}
	if($rs->row["setting_key"]=='credits' and $rs->row["activ"]==1){$site_credits=true;}
	if($rs->row["setting_key"]=='subscription' and $rs->row["activ"]==1){$site_subscription=true;}
	if($rs->row["setting_key"]=='subscription_only' and $rs->row["activ"]==1){$site_subscription_only=true;}
	if($rs->row["setting_key"]=='common_account' and $rs->row["activ"]==1){$site_common_account=true;}
	if($rs->row["setting_key"]=='related_items' and $rs->row["activ"]==1){$site_related_items=true;}
	if($rs->row["setting_key"]=='zoomer' and $rs->row["activ"]==1){$site_zoomer=true;}
	if($rs->row["setting_key"]=='examination' and $rs->row["activ"]==1){$site_examination=true;}
	if($rs->row["setting_key"]=='google_coordinates' and $rs->row["activ"]==1){$site_google=true;}
	if($rs->row["setting_key"]=='google_api'){$site_google_api=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='exif' and $rs->row["activ"]==1){$site_exif=true;}
	
	
	if($rs->row["setting_key"]=='google_captcha' and $rs->row["activ"]==1){$site_captcha=true;}
	
	if($rs->row["setting_key"]=='google_captcha_public'){$site_captcha_public=$rs->row["svalue"];}
	
	if($rs->row["setting_key"]=='google_captcha_private'){$site_captcha_private=$rs->row["svalue"];}
	
	
	if($rs->row["setting_key"]=='affiliates' and $rs->row["activ"]==1 and file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/members/affiliate.php")){$site_affiliate=true;}
	if($rs->row["setting_key"]=='related_items_quantity'){$site_related_items_quantity=$rs->row["svalue"];}
	if($rs->row["setting_key"]=='moderation' and $rs->row["activ"]==1){$site_moderation=0;}
	if($rs->row["setting_key"]=='site_guest' and $rs->row["activ"]==1){$site_guest=1;}


	//News quantity on the page
	if($rs->row["setting_key"]=='k_str')
	{
		define( "k_str", $rs->row["svalue"] );
	}



	//Date const
	if($rs->row["setting_key"]=='date_format')
	{
		define( "date_format", $rs->row["svalue"] );
		define( "date_format2", $rs->row["svalue"] );
		define( "date_short", $rs->row["svalue"] );
		define( "time_format", "H:i:s" );
		define( "datetime_format", date_format . " " . time_format );
	}





	if($rs->row["setting_key"]=='k_row')
	{
		define( "k_row", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='video_width')
	{
		define( "video_width", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='video_height')
	{
		define( "video_height", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='left_width')
	{
		define( "left_width", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='right_width')
	{
		define( "right_width", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='qnews')
	{
		define( "qnews", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='qbest')
	{
		define( "qbest", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='userupload')
	{
		
		if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/members/upload.php"))
		{
			$site_userupload=0;
		}
		else
		{
			$site_userupload=$rs->row["activ"];
		}
		
		define( "userupload",$site_userupload);
	}

	if($rs->row["setting_key"]=='uploadphoto')
	{
		define( "uploadphoto", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='uploadvideo')
	{
		define( "uploadvideo", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='uploadaudio')
	{
		define( "uploadaudio", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='uploadvector')
	{
		define( "uploadvector", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='userstatus')
	{
		define( "userstatus", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='content_type')
	{
		$site_content_type= $rs->row["svalue"];
	}


	if($rs->row["setting_key"]=='videolimit')
	{
		define( "videolimit", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='previewvideolimit')
	{
		define( "previewvideolimit", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='audiolimit')
	{
		define( "audiolimit", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='vectorlimit')
	{
		define( "vectorlimit", $rs->row["svalue"] );
	}



	if($rs->row["setting_key"]=='previewaudiolimit')
	{
		define( "previewaudiolimit", $rs->row["svalue"] );
	}



	if($rs->row["setting_key"]=='photolimit')
	{
		define( "photolimit", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='avatarwidth')
	{
		define( "avatarwidth", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='userphotowidth')
	{
		define( "userphotowidth", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='photopreupload')
	{
		define( "photopreupload", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='videopreupload')
	{
		define( "videopreupload", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='audiopreupload')
	{
		define( "audiopreupload", $rs->row["svalue"] );
	}

	if($rs->row["setting_key"]=='vectorpreupload')
	{
		define( "vectorpreupload", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='download_limit')
	{
		define( "download_limit", $rs->row["svalue"] );
	}


	if($rs->row["setting_key"]=='download_expiration')
	{
		define( "download_expiration", $rs->row["svalue"] );
	}


$rs->movenext();
}
//End settings


//Watermark
$site_watermark="";
$watermark_position=5;
if(!isset($_SESSION["watermark_position"]) or !isset($_SESSION["site_watermark"]))
{
	$sql="select photo,position from watermark";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$site_watermark=$rs->row["photo"];
		$_SESSION["site_watermark"]=$site_watermark;
		$watermark_position=$rs->row["position"];
		$_SESSION["watermark_position"]=$watermark_position;
	}
}
else
{
	$watermark_position=(int)$_SESSION["watermark_position"];
	$site_watermark=result($_SESSION["site_watermark"]);
}


$currency_code1="";
$currency_code2="";
$currency_egold=0;
if(!isset($_SESSION["currency_code1"]) or !isset($_SESSION["currency_code2"]))
{
	$sql="select code1,code2 from currency where activ=1";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$currency_code1=$rs->row["code1"];
		$_SESSION["currency_code1"]=$currency_code1;
		$currency_code2=$rs->row["code2"];
		$_SESSION["currency_code2"]=$currency_code2;
	}
}
else
{
	$currency_code1=result($_SESSION["currency_code1"]);
	$currency_code2=result($_SESSION["currency_code2"]);
}


//Aspect ratio
$aspect_ratio=array();
if($site_video)
{
	if(!isset($_SESSION["aspect_ratio"]))
	{
		$sql="select name,width,height from video_ratio";
		$rs->open($sql);
		while(!$rs->eof)
		{
			$aspect_ratio[$rs->row["name"]]=$rs->row["height"]/$rs->row["width"];
			$_SESSION["aspect_ratio"][$rs->row["name"]]=$rs->row["height"]/$rs->row["width"];
			$rs->movenext();
		}
	}
	else
	{
		foreach ($_SESSION["aspect_ratio"] as $key => $value) 
		{
			$aspect_ratio[$key]=$value;
		}
	}
}





//Languages
$lang_name["Russian"]="Русский";
$lang_name["English"]="English";
$lang_name["German"]="Deutsch";
$lang_name["French"]="Français";
$lang_name["Arabic"]="العربية";
$lang_name["Afrikaans formal"]="Afrikaans formal";
$lang_name["Afrikaans informal"]="Afrikaans informal";
$lang_name["Brazilian"]="Português brasileiro";
$lang_name["Bulgarian"]="Български";
$lang_name["Chinese traditional"]="漢語";
$lang_name["Chinese simplified"]="汉语";
$lang_name["Catalan"]="Сatalà";
$lang_name["Czech"]="Česky";
$lang_name["Danish"]="Dansk";
$lang_name["Dutch"]="Nederlands";
$lang_name["Estonian"]="Eesti";
$lang_name["Finnish"]="Suomi";
$lang_name["Georgian"]="ქართული";
$lang_name["Greek"]="Ελληνικά";
$lang_name["Hebrew"]="עברית";
$lang_name["Hungarian"]="Magyar";
$lang_name["Indonesian"]="Indonesia";
$lang_name["Italian"]="Italiano";
$lang_name["Japanese"]="日本語";
$lang_name["Latvian"]="Latviešu";
$lang_name["Lithuanian"]="Lietuvių";
$lang_name["Malaysian"]="Melayu";
$lang_name["Norwegian"]="Norsk";
$lang_name["Persian"]="فارسی";
$lang_name["Polish"]="Polski";
$lang_name["Portuguese"]="Português";
$lang_name["Romanian"]="Română";
$lang_name["Serbian"]="Српски";
$lang_name["Slovakian"]="Slovenčina";
$lang_name["Slovenian"]="Slovenski";
$lang_name["Spanish"]="Español";
$lang_name["Swedish"]="Svenska";
$lang_name["Thai"]="ภาษาไทย";
$lang_name["Turkish"]="Türkçe";
$lang_name["Ukrainian"]="Українська";
$lang_name["Croatian"]="Hrvatski";
$lang_name["Icelandic"]="Íslenska";



$lang_symbol["English"]="en";
$lang_symbol["Russian"]="ru";
$lang_symbol["German"]="de";
$lang_symbol["French"]="fr";
$lang_symbol["Arabic"]="ar";
$lang_symbol["Afrikaans formal"]="af";
$lang_symbol["Afrikaans informal"]="af";
$lang_symbol["Brazilian"]="br";
$lang_symbol["Bulgarian"]="bg";
$lang_symbol["Chinese traditional"]="zh";
$lang_symbol["Chinese simplified"]="zh";
$lang_symbol["Catalan"]="ca";
$lang_symbol["Czech"]="cs";
$lang_symbol["Danish"]="da";
$lang_symbol["Dutch"]="nl";
$lang_symbol["Estonian"]="et";
$lang_symbol["Finnish"]="fi";
$lang_symbol["Georgian"]="ka";
$lang_symbol["Greek"]="el";
$lang_symbol["Hebrew"]="he";
$lang_symbol["Hungarian"]="hu";
$lang_symbol["Indonesian"]="id";
$lang_symbol["Italian"]="it";
$lang_symbol["Japanese"]="ja";
$lang_symbol["Latvian"]="lv";
$lang_symbol["Lithuanian"]="lt";
$lang_symbol["Malaysian"]="ms";
$lang_symbol["Norwegian"]="no";
$lang_symbol["Persian"]="fa";
$lang_symbol["Polish"]="pl";
$lang_symbol["Portuguese"]="pt";
$lang_symbol["Romanian"]="ro";
$lang_symbol["Serbian"]="sr";
$lang_symbol["Slovakian"]="sk";
$lang_symbol["Slovenian"]="sl";
$lang_symbol["Spanish"]="es";
$lang_symbol["Swedish"]="sv";
$lang_symbol["Thai"]="th";
$lang_symbol["Turkish"]="tr";
$lang_symbol["Ukrainian"]="uk";
$lang_symbol["Croatian"]="hr";
$lang_symbol["Icelandic"]="is";


$lng="Persian";
$mtg="utf-8";





if(!isset($_SESSION["site_lng"]) or !isset($_SESSION["site_lng_activ"]) or !isset($_SESSION["site_mtg_activ"]))
{
	$sql="select name,metatags,activ from languages where display=1 order by name";
	$rs->open($sql);
	while(!$rs->eof)
	{
		if($rs->row["activ"]==1)
		{
			$lng=$rs->row["name"];
			$_SESSION["site_lng_activ"]=$lng;
			$mtg=$rs->row["metatags"];
			$_SESSION["site_mtg_activ"]=$mtg;
		}
		$_SESSION["site_lng"][$rs->row["name"]]=$rs->row["metatags"];
		$rs->movenext();
	}
}
else
{
	$lng="Persian";
	$mtg=$_SESSION["site_mtg_activ"];
}


if(!isset($_SESSION["slang"]) and isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) and @$global_settings["language_detection"])
{
	foreach ($lang_symbol as $key => $value) 
	{
		if(preg_match("/".$value."/",$_SERVER["HTTP_ACCEPT_LANGUAGE"]))
		{
			$lng="Persian";
			$_SESSION["site_lng_activ"]="Persian";
		}
	}
}

 

if(isset($_SESSION["slang"]) and $_SESSION["slang"]!="")
{
	$lng=$_SESSION["slang"];
	$_SESSION["site_lng_activ"]=$lng;
	$mtg=$_SESSION["site_lng"][$lng];
}

$lng2=$lng;
if($lng=="Chinese traditional"){$lng2="chineset";}
if($lng=="Chinese simplified"){$lng2="chineses";}
if($lng=="Afrikaans formal"){$lng2="afrikaansf";}
if($lng=="Afrikaans informal"){$lng2="afrikaansi";}



if(!isset($nolang))
{
	header("Content-Type: text/html; charset=utf-8");
	include( $DOCUMENT_ROOT."/admin/languages/".strtolower($lng2).".php" );
}


//End languages





//Rackspace settings
$site_rackspace=0;
$site_rackspace_prefix="";
$site_rackspace_username="";
$site_rackspace_api_key="";
if(!isset($_SESSION["site_rackspace"]) or !isset($_SESSION["site_rackspace_prefix"]) or !isset($_SESSION["site_rackspace_username"]) or !isset($_SESSION["site_rackspace_api_key"]))
{
	$sql="select * from filestorage_rackspace";
	$ds->open($sql);
	if(!$ds->eof)
	{
		$site_rackspace=$ds->row["activ"];
		$_SESSION["site_rackspace"]=$site_rackspace;
		
		$site_rackspace_prefix=$ds->row["prefix"];
		$_SESSION["site_rackspace_prefix"]=$site_rackspace_prefix;
		
		$site_rackspace_username=$ds->row["username"];
		$_SESSION["site_rackspace_username"]=$site_rackspace_username;
		
		$site_rackspace_api_key=$ds->row["api_key"];
		$_SESSION["site_rackspace_api_key"]=$site_rackspace_api_key;
	}
}
else
{
	$site_rackspace=result($_SESSION["site_rackspace"]);	
	$site_rackspace_prefix=result($_SESSION["site_rackspace_prefix"]);	
	$site_rackspace_username=result($_SESSION["site_rackspace_username"]);	
	$site_rackspace_api_key=result($_SESSION["site_rackspace_api_key"]);
}


//Amazon settings
$site_amazon=0;
$site_amazon_prefix="";
$site_amazon_username="";
$site_amazon_api_key="";
$site_amazon_region="";

$amazon_region["REGION_US_E1"]="US Standart";
$amazon_region["REGION_US_W1"]="Northern California";
$amazon_region["REGION_EU_W1"]="Ireland";
$amazon_region["REGION_APAC_SE1"]="Singapore";
$amazon_region["REGION_APAC_NE1"]="Tokyo";



if(!isset($_SESSION["site_amazon"]) or !isset($_SESSION["site_amazon_prefix"]) or !isset($_SESSION["site_amazon_username"]) or !isset($_SESSION["site_amazon_api_key"]) or !isset($_SESSION["site_amazon_region"]))
{
	$sql="select * from filestorage_amazon";
	$ds->open($sql);
	if(!$ds->eof)
	{
		$site_amazon=$ds->row["activ"];
		$_SESSION["site_amazon"]=$site_amazon;
	
		$site_amazon_prefix=$ds->row["prefix"];
		$_SESSION["site_amazon_prefix"]=$site_amazon_prefix;
	
		$site_amazon_username=$ds->row["username"];
		$_SESSION["site_amazon_username"]=$site_amazon_username;
	
		$site_amazon_api_key=$ds->row["api_key"];
		$_SESSION["site_amazon_api_key"]=$site_amazon_api_key;
	
		$site_amazon_region=$ds->row["region"];
		$_SESSION["site_amazon_region"]=$site_amazon_region;
	}
}
else
{
	$site_amazon=$_SESSION["site_amazon"];
	$site_amazon_prefix=$_SESSION["site_amazon_prefix"];
	$site_amazon_username=$_SESSION["site_amazon_username"];
	$site_amazon_api_key=$_SESSION["site_amazon_api_key"];
	$site_amazon_region=$_SESSION["site_amazon_region"];
}




//Auto login
if(!isset($_SESSION["people_login"]) and isset($_COOKIE["people_login"]) and isset($_COOKIE["people_password"]))
{
	$login=result($_COOKIE["people_login"]);
	$password=result($_COOKIE["people_password"]);

	user_authorization($login,$password,"site");
}




//caching
$site_cache_header=-1;
$site_cache_footer=-1;
$site_cache_home=-1;
$site_cache_item=-1;
$site_cache_catalog=-1;
$site_cache_components=-1;
$site_cache_stats=-1;
if(!isset($_SESSION["site_cache_header"]) or !isset($_SESSION["site_cache_footer"]) or !isset($_SESSION["site_cache_home"]) or !isset($_SESSION["site_cache_item"]) or !isset($_SESSION["site_cache_catalog"]) or !isset($_SESSION["site_cache_components"]) or !isset($_SESSION["site_cache_stats"]))
{
	$sql="select id,time_refresh from caching";
	$rs->open($sql);
	while(!$rs->eof)
	{
		if($rs->row["id"]==1)
		{
			$site_cache_header=$rs->row["time_refresh"];
			$_SESSION["site_cache_header"]=$site_cache_header;
		}
		if($rs->row["id"]==2)
		{
			$site_cache_footer=$rs->row["time_refresh"];
			$_SESSION["site_cache_footer"]=$site_cache_footer;
		}
		if($rs->row["id"]==3)
		{
			$site_cache_home=$rs->row["time_refresh"];
			$_SESSION["site_cache_home"]=$site_cache_home;
		}
		if($rs->row["id"]==4)
		{
			$site_cache_item=$rs->row["time_refresh"];
			$_SESSION["site_cache_item"]=$site_cache_item;
		}
		if($rs->row["id"]==5)
		{
			$site_cache_catalog=$rs->row["time_refresh"];
			$_SESSION["site_cache_catalog"]=$site_cache_catalog;
		}
		if($rs->row["id"]==6)
		{
			$site_cache_components=$rs->row["time_refresh"];
			$_SESSION["site_cache_components"]=$site_cache_components;
		}
		if($rs->row["id"]==7)
		{
			$site_cache_stats=$rs->row["time_refresh"];
			$_SESSION["site_cache_stats"]=$site_cache_stats;
		}
		$rs->movenext();
	}
}
else
{
	$site_cache_header=$_SESSION["site_cache_header"];
	$site_cache_footer=$_SESSION["site_cache_footer"];
	$site_cache_home=$_SESSION["site_cache_home"];
	$site_cache_item=$_SESSION["site_cache_item"];
	$site_cache_catalog=$_SESSION["site_cache_catalog"];
	$site_cache_components=$_SESSION["site_cache_components"];
	$site_cache_stats=$_SESSION["site_cache_stats"];
}


if(!isset($_SESSION["site_signup"]))
{
	$sql="select param from users_signup";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$site_signup=(int)$rs->row["param"];
		$_SESSION["site_signup"]=$site_signup;
		$rs->movenext();
	}
}
else
{
	$site_signup=$_SESSION["site_signup"];
}




//Countries
$mcountry=Array("Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antarctica","Antigua","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia/Hercegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burma","Burundi","Cambodia Dem.","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Cocos Islands","Colombia","Comoros","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, Democratic Peoples Repbulic","Korea, Rep. Of","Kuwait","Laos Peoples Democratic Republic","Latvia","Lebanon","Lesotho","Liberia","Libyan Arab Jamahiriya","Liechtenstein","Lithuania","Luxembourg","Macau","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Neth. Antilles Nevis","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Northern Mariana","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Romania","Russia","Rwanda","Samoa (American)","Samoa (Western)","San Marino","Sao Tome & Principe","Saudi Arabia","Senegal","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","St. Kitts & Nevis","St. Lucia","St. Pierre & Miquelon","St. Vincent & Grenadines","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syrian Arab Republic","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (Br.)","Virgin Islands (U.S.)","Wallis & Futuna","Yemen Republic","Yugoslavia","Zaire","Zambia","Zimbabwe");




//States of Russia
$mstates["Russia"]=array("Москва", "Санкт-Петербург", "Республика Адыгея (Адыгея)", "Республика Алтай", "Республика Башкортостан", "Республика Бурятия", "Республика Дагестан", "Республика Ингушетия", "Кабардино-Балкарская Республика", "Республика Калмыкия", "Карачаево-Черкесская Республика", "Республика Карелия", "Республика Коми", "Республика Марий Эл", "Республика Мордовия", "Республика Саха (Якутия)", "Республика Северная Осетия - Алания", "Республика Татарстан (Татарстан)", "Республика Тыва", "Удмуртская Республика", "Республика Хакасия", "Чеченская Республика", "Чувашская Республика - Чувашия", "Алтайский край", "Забайкальский край", "Камчатский край", "Краснодарский край", "Красноярский край", "Пермский край", "Приморский край", "Ставропольский край", "Хабаровский край", "Амурская область", "Архангельская область", "Астраханская область", "Белгородская область", "Брянская область", "Владимирская область", "Волгоградская область", "Вологодская область", "Воронежская область", "Ивановская область", "Иркутская область", "Калининградская область", "Калужская область", "Кемеровская область", "Кировская область", "Костромская область", "Курганская область", "Курская область", "Ленинградская область", "Липецкая область", "Магаданская область", "Московская область", "Мурманская область", "Нижегородская область", "Новгородская область", "Новосибирская область", "Омская область", "Оренбургская область", "Орловская область", "Пензенская область", "Псковская область", "Ростовская область", "Рязанская область", "Самарская область", "Саратовская область", "Сахалинская область", "Свердловская область", "Смоленская область", "Тамбовская область", "Тверская область", "Томская область", "Тульская область", "Тюменская область", "Ульяновская область", "Челябинская область", "Ярославская область", "Еврейская автономная область", "Ненецкий автономный округ", "Ханты-Мансийский автономный округ - Югра", "Чукотский автономный округ", "Ямало-Ненецкий автономный округ");

//States of USA
$mstates["United States"]=array('Alabama', 'Alaska','Arizona','Arkansas','California','Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');

//States of Canada
$mstates["Canada"]=array("British Columbia","Ontario","Newfoundland","Nova Scotia","Prince Edward Island","New Brunswick","Quebec","Manitoba","Saskatchewan","Alberta","Northwest Territories","Yukon Territory");

//States of UK
$mstates["United Kingdom"]=array('Bedfordshire','Berkshire','Buckinghamshire','Cambridgeshire','Cheshire','Cornwall','Cumberland','Derbyshire','Devon','Dorset','Durham','East Yorkshire','Essex','Gloucestershire','Hampshire','Herefordshire','Hertfordshire','Huntingdonshire','Kent','Lancashire','Leicestershire','Lincolnshire','Middlesex','Norfolk','North Yorkshire','Northamptonshire','Northumberland','Nottinghamshire','Oxfordshire','Rutland','Shropshire','Somerset','Staffordshire','Suffolk','Surrey','Sussex','Warwickshire','West Yorkshire','Westmorland','Wiltshire','Worcestershire','Aberdeenshire','Angus/Forfarshire','Argyllshire','Ayrshire','Banffshire','Berwickshire','Buteshire','Cromartyshire','Caithness','Clackmannanshire','Dumfriesshire','Dunbartonshire/Dumbartonshire','East Lothian/Haddingtonshire','Fife','Inverness-shire','Kincardineshire','Kinross-shire','Kirkcudbrightshire','Lanarkshire','Midlothian/Edinburghshire','Morayshire','Nairnshire','Orkney','Peeblesshire','Perthshire','Renfrewshire','Ross-shire','Roxburghshire','Selkirkshire','Shetland','Stirlingshire','Sutherland','West Lothian/Linlithgowshire','Wigtownshire','Anglesey/Sir Fon','Brecknockshire/Sir Frycheiniog','Caernarfonshire/Sir Gaernarfon','Carmarthenshire/Sir Gaerfyrddin','Cardiganshire/Ceredigion','Denbighshire/Sir Ddinbych','Flintshire/Sir Fflint','Glamorgan/Morgannwg','Merioneth/Meirionnydd','Monmouthshire/Sir Fynwy','Montgomeryshire/Sir Drefaldwyn','Pembrokeshire/Sir Benfro','Radnorshire/Sir Faesyfed','County Antrim','County Armagh','County Down','County Fermanagh','County Tyrone','County Londonderry/Derry');

//Regions de la France
$mstates["France"]=array("Île-de-France", "Rhône-Alpes", "Provence-Alpes-Côte d'Azur", "Nord-Pas-de-Calais", "Pays-de-la-Loire", "Aquitaine", "Brittany", "Midi-Pyrénées", "Centre", "Lorraine", "Languedoc-Roussillon", "Picardy", "Upper Normandy", "Alsace", "Poitou-Charentes", "Burgundy", "Lower Normandy", "Champagne-Ardenne", "Auvergne", "Franche-Comté", "Limousin", "Réunion", "Guadeloupe", "Martinique", "Corsica", "Guiana");

//States of Germany
$mstates["Germany"]=array("Baden-Württemberg","Bavaria","Berlin","Brandenburg","Bremen","Hamburg","Hesse","Mecklenburg-Vorpommern","Lower Saxony","North Rhine-Westphalia","Rhineland-Palatinate","Saarland","Saxony","Saxony-Anhalt","Schleswig-Holstein","Thuringia");


//Months
$m_month[0]="January";
$m_month[1]="February";
$m_month[2]="March";
$m_month[3]="April";
$m_month[4]="May";
$m_month[5]="June";
$m_month[6]="July";
$m_month[7]="August";
$m_month[8]="September";
$m_month[9]="October";
$m_month[10]="November";
$m_month[11]="December";

?>