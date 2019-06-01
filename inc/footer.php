<?
if(!defined("site_root")){exit();}
//Footer template
if (!$smarty->is_cached('footer.tpl',cache_id('footer')) or $site_cache_footer<0)
{
	$file_template=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."footer.tpl");





	//Box stat
	include("box_stat.php");

	$host = $_SERVER['HTTP_HOST'];
  if($host == "www.shamimgraphic.ir" or $host == "shamimgraphic.ir") {
		$site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="rYa7KD1Bt1AQbc19">';
	}else{
		$site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="SiyELsfX6ozHQRDI">';
	}

	//Site name
	$file_template=str_replace("{SITE_ENAMAD}",$site_enamad,$file_template);

	//Site name
	$file_template=str_replace("{SITE_NAME}",$site_name,$file_template);

	//Site root
	$file_template=str_replace("{SITE_ROOT}",site_root."/",$file_template);


	$file_template=str_replace("{TELEPHONE}",$global_settings["telephone"],$file_template);

	//Template root
	$file_template=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$file_template);

	$file_template=format_layout($file_template,"sitephoto",$site_photo);
	$file_template=format_layout($file_template,"sitevideo",$site_video);
	$file_template=format_layout($file_template,"siteaudio",$site_audio);
	$file_template=format_layout($file_template,"sitevector",$site_vector);
	$file_template=format_layout($file_template,"sitecredits",$site_credits);
	$file_template=format_layout($file_template,"sitesubscription",$site_subscription);
	$file_template=translate_text($file_template);




//End Footer template
}


if($site_cache_footer>=0)
{
	if($site_cache_footer>0)
	{
		$smarty->cache_lifetime = $site_cache_footer*3600;
	}
	$smarty->assign('footer', $file_template);
	$file_template=$smarty->fetch('footer.tpl',cache_id('footer'));
}

echo($file_template);
?>
