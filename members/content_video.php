<?
if(!defined("site_root")){exit();}


$boxcontent="";
$item_lightbox="";
$sql="update videos set viewed=viewed+1 where id_parent=".(int)$id_parent;
$db->execute($sql);



if (!$smarty->is_cached('item.tpl',cache_id('item')) or $site_cache_item<0)
{
$sql="select id_parent,title,data,description,folder,viewed,author,keywords,userid,usa,duration,format,ratio,rendering,holder,frames,content_type,free,downloaded,rating,model,server1,category2,category3,google_x,google_y,url from videos where published=1 and id_parent=".(int)$id_parent;
$rs->open($sql);
if(!$rs->eof)
{

$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."item_video.tpl");
$folder=$rs->row["folder"];
$kk=0;


$remote_files=array();
$remote_previews=array();
$flag_storage=false;

if($site_amazon or $site_rackspace)
{
	$sql="select filename1,filename2,url,item_id,filesize from filestorage_files where id_parent=".$rs->row["id_parent"];
	$ds->open($sql);
	while(!$ds->eof)
	{
		if($ds->row["item_id"]!=0)
		{
			$remote_files[$ds->row["filename1"]]=$ds->row["filesize"];
		}
		else
		{
			$remote_previews[$ds->row["filename1"]]=$ds->row["url"]."/".$ds->row["filename2"];
		}
		
		$flag_storage=true;
		$ds->movenext();
	}
}

//Video preview URL
$preview=show_preview($rs->row["id_parent"],"video",2,0,$rs->row["server1"],$rs->row["folder"]);
$boxcontent=str_replace("{PREVIEW}",$preview,$boxcontent);


$video=show_preview($rs->row["id_parent"],"video",2,1,$rs->row["server1"],$rs->row["folder"]);


$adownloadsample = array();
preg_match_all('|\{if downloadsample\}(.*)\{/if\}|Uis', $boxcontent, $adownloadsample);





	$flag_downloadsample=false;
	if($site_downloadsample==true and !preg_match("/icon_video/",$video))
	{
		$flag_downloadsample=true;
	}
	$boxcontent=format_layout($boxcontent,"downloadsample",$flag_downloadsample);


$boxcontent=str_replace("{DOWNLOADSAMPLE}",$video,$boxcontent);
//$boxcontent=str_replace("{DOWNLOADSAMPLE}",site_root."/members/sample.php?id=".$rs->row["id_parent"],$boxcontent);





//Show categories
$boxcontent=str_replace("{WORD_CATEGORY}",word_lang("category"),$boxcontent);
$boxcontent=str_replace("{CATEGORY}",show_category($rs->row["id_parent"],$rs->row["category2"],$rs->row["category3"]),$boxcontent);



//Texts
$boxcontent=str_replace("{TITLE}",$rs->row["title"],$boxcontent);
$boxcontent=str_replace("{URL}",surl.site_root.$rs->row["url"],$boxcontent);
$boxcontent=str_replace("{WORD_DIMENSIONS}",word_lang("files"),$boxcontent);
$boxcontent=str_replace("{WORD_ID}","ID",$boxcontent);
$boxcontent=str_replace("{WORD_PUBLISHED}",word_lang("published"),$boxcontent);
$boxcontent=str_replace("{PUBLISHED}",date(date_short,$rs->row["data"]),$boxcontent);
$boxcontent=str_replace("{WORD_RATING}",word_lang("rating"),$boxcontent);
$boxcontent=str_replace("{WORD_FILE_DETAILS}",word_lang("file details"),$boxcontent);
$boxcontent=str_replace("{WORD_TOOLS}",word_lang("tools"),$boxcontent);
$boxcontent=str_replace("{WORD_PORTFOLIO}",word_lang("member portfolio"),$boxcontent);
$boxcontent=str_replace("{WORD_MAIL}",word_lang("sitemail to user"),$boxcontent);
$boxcontent=str_replace("{WORD_DOWNLOADSAMPLE}",word_lang("download sample"),$boxcontent);
$boxcontent=str_replace("{WORD_DURATION}",word_lang("duration"),$boxcontent);
$boxcontent=str_replace("{WORD_FORMAT}",word_lang("clip format"),$boxcontent);
$boxcontent=str_replace("{WORD_RATIO}",word_lang("aspect ratio"),$boxcontent);
$boxcontent=str_replace("{WORD_RENDERING}",word_lang("field rendering"),$boxcontent);
$boxcontent=str_replace("{WORD_FRAMES}",word_lang("frames per second"),$boxcontent);
$boxcontent=str_replace("{WORD_HOLDER}",word_lang("copyright holder"),$boxcontent);
$boxcontent=str_replace("{WORD_PREVIEW}",word_lang("preview"),$boxcontent);

$boxcontent=str_replace("{DURATION}",duration_format($rs->row["duration"]),$boxcontent);
$boxcontent=str_replace("{FORMAT}",$rs->row["format"],$boxcontent);
$boxcontent=str_replace("{RATIO}",$rs->row["ratio"],$boxcontent);
$boxcontent=str_replace("{RENDERING}",$rs->row["rendering"],$boxcontent);
$boxcontent=str_replace("{FRAMES}",$rs->row["frames"],$boxcontent);
$boxcontent=str_replace("{HOLDER}",$rs->row["holder"],$boxcontent);



$boxcontent=str_replace("{WORD_LICENSE}",word_lang("license"),$boxcontent);

$boxcontent=str_replace("{LICENSE}",site_root."/members/license.php",$boxcontent);



//Show video fields
$sql="select fname,activ from video_fields";
$dr->open($sql);
while(!$dr->eof)
{
	if($dr->row["fname"]=="duration")
	{
		$flag_duration=false;
		if($dr->row["activ"]==1 and $rs->row["duration"]!=0)
		{
			$flag_duration=true;
		}
		$boxcontent=format_layout($boxcontent,"duration",$flag_duration);	
	}


	if($dr->row["fname"]=="format")
	{
		$flag_format=false;
		if($dr->row["activ"]==1 and $rs->row["format"]!="")
		{
			$flag_format=true;
		}
		$boxcontent=format_layout($boxcontent,"format",$flag_format);	
	}



	if($dr->row["fname"]=="ratio")
	{
		$flag_ratio=false;
		if($dr->row["activ"]==1 and $rs->row["ratio"]!="")
		{
			$flag_ratio=true;
		}
		$boxcontent=format_layout($boxcontent,"ratio",$flag_ratio);	
	}


	if($dr->row["fname"]=="rendering")
	{
		$flag_rendering=false;
		if($dr->row["activ"]==1 and $rs->row["rendering"]!="")
		{
			$flag_rendering=true;
		}
		$boxcontent=format_layout($boxcontent,"rendering",$flag_rendering);	
	}


	if($dr->row["fname"]=="frames")
	{
		$flag_frames=false;
		if($dr->row["activ"]==1 and $rs->row["frames"]!="")
		{
			$flag_frames=true;
		}
		$boxcontent=format_layout($boxcontent,"frames",$flag_frames);	
	}


	if($dr->row["fname"]=="holder")
	{
		$flag_holder=false;
		if($dr->row["activ"]==1 and $rs->row["holder"]!="")
		{
			$flag_holder=true;
		}
		$boxcontent=format_layout($boxcontent,"holder",$flag_holder);	
	}



$dr->movenext();
}
//End. Show fields


























$sql="select id_parent,itemid from reviews where itemid=".(int)$id_parent;
$dr->open($sql);
$boxcontent=str_replace("{WORD_REVIEWS}",word_lang("reviews")."(".strval($dr->rc).")",$boxcontent);
$boxcontent=str_replace("{ID}",strval($id_parent),$boxcontent);



$boxcontent=str_replace("{WORD_DOWNLOADS}",word_lang("downloads"),$boxcontent);
$boxcontent=str_replace("{DOWNLOADS}",strval($rs->row["downloaded"]),$boxcontent);




//Show next/previous navigation
show_navigation($id_parent,"videos");


//Show google map
show_google_map($rs->row["google_x"],$rs->row["google_y"]);




//Show rating
$boxcontent=str_replace("{ITEM_RATING}",show_rating($id_parent,$rs->row["rating"]),$boxcontent);






$boxcontent=str_replace("{WORD_VIEWED}",word_lang("viewed"),$boxcontent);
$boxcontent=str_replace("{VIEWED}",strval($rs->row["viewed"]),$boxcontent);
$boxcontent=str_replace("{WORD_DESCRIPTION}",word_lang("description"),$boxcontent);
$boxcontent=str_replace("{DESCRIPTION}",$rs->row["description"],$boxcontent);
$boxcontent=str_replace("{WORD_AUTHOR}",word_lang("author"),$boxcontent);




//Show community tools
show_community();






if(isset($_SESSION["people_id"]))
{
	$boxcontent=str_replace("{MAIL_LINK}",site_root."/members/messages_new.php?user=".$rs->row["author"],$boxcontent);
}
else
{
	$boxcontent=str_replace("{MAIL_LINK}",site_root."/members/login.php",$boxcontent);
}




//Show author
show_author($rs->row["author"]);







//Show keywords
$keywords=array();
show_keywords($id_parent,"video");



$boxcontent=str_replace("{TELL_A_FRIEND_LINK}",site_root."/members/tell_a_friend.php?id_parent=".(int)$id_parent,$boxcontent);

$boxcontent=str_replace("{WORD_TELL_A_FRIEND}",word_lang("tell a friend"),$boxcontent);




//Preview screenshots
$preview_items="";
$k=1;
if(!$flag_storage)
{
$dir = opendir ($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder);
while ($file = readdir ($dir)) 
{
	if($file <> "." && $file <> "..")
	{
		if(preg_match("/thumb[0-9]+/",$file)) 
		{
			if(preg_match("/.jpg$|.jpeg$|.png$|.gif$/i",$file) and !preg_match("/thumb100/i",$file)) 
			{
				$preview_items.="<td><img src='".site_root.server_url($rs->row["server1"])."/".$folder."/".$file."'></td>";
				if($k%5==0){$preview_items.="</tr><tr>";}
				$k++;
			}
		}
	}
}
closedir ($dir);
}
else
{
	foreach ($remote_previews as $key => $value) 
	{
		if(preg_match("/thumb[0-9]+/",$key)) 
		{
			if(preg_match("/.jpg$|.jpeg$|.png$|.gif$/i",$key)) 
			{
				$preview_items.="<td><img src='".$value."'></td>";
				if($k%5==0){$preview_items.="</tr><tr>";}
				$k++;
			}
		}
	}
}

if($preview_items!="")
{
	$preview_items="<table border='0' cellpadding='3' cellspacing='0'><tr>".$preview_items."</tr></table>";
}
$boxcontent=str_replace("{PREVIEW_ITEMS}",$preview_items,$boxcontent);


	$flag_previews=false;
	if($preview_items!="")
	{
		$flag_previews=true;
	}
	$boxcontent=format_layout($boxcontent,"video_previews",$flag_previews);


//Show favorite buttons
show_favorite($id_parent);






//Show related items
$related_items=show_related_items($id_parent,"video");



//Show prices
$sizebox="";
$sizebox_labels="";
$sizeboxes=array();
if(file_exists($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder))
{


	$subscription_item=false;
	if(($site_subscription==true and isset($_SESSION["people_login"]) and user_subscription($_SESSION["people_login"],$id_parent)) or $rs->row["free"]==1 or $site_subscription_only)
	{
		if($ds->row["shipped"]!=1)
		{
			$subscription_item=true;
		}
	}


	$sql="select id_parent,name from licenses order by priority";
	$dd->open($sql);
	$sizebox_labels_checked="checked";
	$sizebox_buy_checked="checked";
	while(!$dd->eof)
	{
		$flag_license=true;


		$sql="select id_parent,title from video_types where license=".$dd->row["id_parent"]." order by priority";
		$dr->open($sql);
		while(!$dr->eof)
		{
			$sql="select id,name,url,price,shipped from items where price_id=".$dr->row["id_parent"]." and id_parent=".$id_parent." order by priority";
			$ds->open($sql);
			while(!$ds->eof)
			{
				if($flag_license)
				{
					$sizeboxes[$dd->row["id_parent"]]="";
					$sizebox_labels.="<input type='radio' name='license' id='license".$dd->row["id_parent"]."' value='".$dd->row["id_parent"]."' style='margin-left:20px;margin-right:10px'  onClick='apanel(".$dd->row["id_parent"].");' ".$sizebox_labels_checked."><label for='license".$dd->row["id_parent"]."' >".$dd->row["name"]."</label>";
					$sizebox_labels_checked="";
					$flag_license=false;
				}


				$size="";
				if($ds->row["shipped"]==1)
				{
					$size=word_lang("shipped");
				}
				else
				{
					if(!$flag_storage and file_exists($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"]))
					{
						$size=strval(float_opt(filesize($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"])/(1024*1025),3))." Mb.";
					}
					else
					{
						if(isset($remote_files[$ds->row["url"]]))
						{
							$size=strval(float_opt($remote_files[$ds->row["url"]]/(1024*1024),3))." Mb.";
						}
					}
				}



				$bt="<input type='radio'  id='cart' name='cart' value='".$ds->row["id"]."' ".$sizebox_buy_checked.">";
				$sizebox_buy_checked="";


				if($subscription_item and $ds->row["shipped"]==1)
				{
				
				}
				else
				{
						$content_price="<td nowrap onClick='xcart(".$ds->row["id"].");'><span class='price'>".currency(1).float_opt($ds->row["price"],2,true)." ".currency(2)."</span></td>";
						
						if($rs->row["free"]==1)
						{
							$content_price="";
						}
				
				
					$sizeboxes[$dd->row["id_parent"]].="<tr class='tr_cart' id='tr_cart".$ds->row["id"]."'><td onClick='xcart(".$ds->row["id"].");'>".$ds->row["name"]."</td><td onClick='xcart(".$ds->row["id"].");'>".$size."</td>".$content_price."<td onClick='xcart(".$ds->row["id"].");'>".$bt."</td></tr>";
				}



			$ds->movenext();
			}
		$dr->movenext();
		}
	$dd->movenext();
	}

	$sizebox_display="inline";
	foreach ($sizeboxes as $key => $value)
	{
		if($value!="")
		{
			$word_buy=word_lang("buy");
			if($subscription_item)
			{
				$word_buy=word_lang("download");
			}
				
			$text_price="<th>".word_lang("price")."</th>";
			if($rs->row["free"]==1)
			{
				$text_price="";
			}
						
			$value="<table border='0' cellpadding='0' cellspacing='0' class='table_cart'><tr valign='top'><th width='40%'>".word_lang("title")."</th><th>".word_lang("size")."</th>".$text_price."<th>".$word_buy."</th></tr>".$value."</table>";
		}
		$sizebox.="<div name='p".$key."' id='p".$key."' style='display:".$sizebox_display."'>".$value."</div>";
		$sizebox_display="none";
	}

	$sizebox="<div style='margin-bottom:6px;margin-top:15px' class='price_license'><a href='".site_root."/members/license.php'>".word_lang("license").":</a></b> ".$sizebox_labels."</div>".$sizebox;
	
	
	
			if($subscription_item)
			{
				$word_cart=word_lang("download");
				if($rs->row["free"]==1)
				{
					$word_cart=word_lang("free download");
				}
				
				$sizebox.="<input id='item_button_cart' class='add_to_cart' type='button' onclick=\"add_download('video',".$rs->row["id_parent"].",".$rs->row["server1"].")\" value='".$word_cart."'>";
			}
			else
			{
				$sizebox.="<input id='item_button_cart' class='add_to_cart' type='button' onclick=\"add_cart(0)\" value='".word_lang("add to cart")."'>";
			}
		


}
$boxcontent=str_replace("{SIZES}",$sizebox,$boxcontent);
//End. Show prices


//Share this
$boxcontent=str_replace("{WORD_SHARE}",word_lang("share this"),$boxcontent);









$boxcontent=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$boxcontent);
$boxcontent=translate_text($boxcontent);

}



}






if($site_cache_item>=0)
{
	if($site_cache_item>0)
	{
		$smarty->cache_lifetime = $site_cache_item*3600;
	}
	$smarty->assign('item', $boxcontent);
	$boxcontent=$smarty->fetch('item.tpl',cache_id('item'));
}

echo($boxcontent);

?>