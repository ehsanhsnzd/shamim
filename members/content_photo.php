<?



$sql="update photos set viewed=viewed+1 where id_parent=".(int)$id_parent;
$db->execute($sql);


if (!$smarty->is_cached('item.tpl',cache_id('item')) or $site_cache_item<0)
{



$sql="select id_parent,title,data,published,description,folder,featured,keywords,author,viewed,userid,watermark,free,downloaded,rating,model,server1,category2,category3,google_x,google_y,url,editorial from photos where published=1 and id_parent=".(int)$id_parent;
$rs->open($sql);
if(!$rs->eof)
{


$remote_width=0;
$remote_height=0;
$remote_thumb_width=0;
$remote_thumb_height=0;
$remote_filesize=0;
$image_width=0;
$image_height=0;
$image_filesize=0;
$flag_storage=false;
$folder=$rs->row["folder"];

if($site_amazon or $site_rackspace)
{
	$sql="select url,filename1,filename2,width,height,item_id,filesize from filestorage_files where id_parent=".$rs->row["id_parent"];
	$ds->open($sql);
	while(!$ds->eof)
	{
		if($ds->row["item_id"]!=0)
		{
			$remote_width=$ds->row["width"];
			$remote_height=$ds->row["height"];
			$remote_filesize=$ds->row["filesize"];
		}
		if(preg_match("/thumb2/",$ds->row["filename1"]))
		{
			$remote_thumb_width=$ds->row["width"];
			$remote_thumb_height=$ds->row["height"];
		}
		$flag_storage=true;
		$ds->movenext();
	}
}

	if(!$flag_storage)
	{
		$sql="select url from items where id_parent=".$id_parent;
		$ds->open($sql);
		if(!$ds->eof)
		{
			if(file_exists($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"]))
			{
				$size = @getimagesize($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"]);
				$image_width=$size[0];
				$image_height=$size[1];
				$image_filesize=filesize($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"]);
				//$image_dpi=get_dpi($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder."/".$ds->row["url"]);
			}
		}
	}




$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."item_photo.tpl");

$kk=0;
$fl=false;


//Photo previews
$preview=show_preview($rs->row["id_parent"],"photo",2,0,$rs->row["server1"],$rs->row["folder"]);

$preview_url=show_preview($rs->row["id_parent"],"photo",2,1,$rs->row["server1"],$rs->row["folder"]);

$preview_url2=show_preview($rs->row["id_parent"],"photo",2,1,$rs->row["server1"],$rs->row["folder"],false);


if(!$site_zoomer or preg_match("/icon_photo/",$preview_url))
{
	if(!preg_match("/icon_photo/",$preview_url))
	{
		$boxcontent=str_replace("{IMAGE}",$preview,$boxcontent);
	}
	else
	{
		$boxcontent=str_replace("{IMAGE}","",$boxcontent);
	}
}
else
{

	if(!$flag_storage)
	{
		$sz = getimagesize($_SERVER["DOCUMENT_ROOT"].$preview_url2);
		$iframe_width=$sz[0];
		$iframe_height=$sz[1];
	}
	else
	{
		$iframe_width=$remote_thumb_width;
		$iframe_height=$remote_thumb_height;
	}

	if(($image_height!=0 and $image_width/$image_height>3) or ($remote_height!=0 and $remote_width/$remote_height>3))
	{
		$boxcontent=str_replace("{IMAGE}",$preview,$boxcontent);
	}
	else
	{
		$boxcontent=str_replace("{IMAGE}","<iframe width=".$iframe_width." height=".$iframe_height." src='".site_root."/members/content_photo_preview.php?id=".$id_parent."&width=".$iframe_width."&height=".$iframe_height."' frameborder=no scrolling=no></iframe>",$boxcontent);
	}
}






//Show download sample
$boxcontent=str_replace("{DOWNLOADSAMPLE}",$preview_url,$boxcontent);
//$boxcontent=str_replace("{DOWNLOADSAMPLE}",site_root."/members/sample.php?id=".$rs->row["id_parent"],$boxcontent);


	$flag_downloadsample=false;
	if($site_downloadsample==true and !preg_match("/icon_photo/",$preview_url))
	{
		$flag_downloadsample=true;
	}
	$boxcontent=format_layout($boxcontent,"downloadsample",$flag_downloadsample);







//Texts
$boxcontent=str_replace("{TITLE}",$rs->row["title"],$boxcontent);
$boxcontent=str_replace("{URL}",surl.site_root.$rs->row["url"],$boxcontent);
$boxcontent=str_replace("{WORD_DIMENSIONS}",word_lang("files"),$boxcontent);
$boxcontent=str_replace("{WORD_ID}","ID",$boxcontent);
$boxcontent=str_replace("{WORD_PUBLISHED}",word_lang("published"),$boxcontent);
$boxcontent=str_replace("{PUBLISHED}",date(date_short,$rs->row["data"]),$boxcontent);
$boxcontent=str_replace("{WORD_RATING}",word_lang("rating"),$boxcontent);
$boxcontent=str_replace("{WORD_LICENSE}",word_lang("license"),$boxcontent);
$boxcontent=str_replace("{LICENSE}",site_root."/members/license.php",$boxcontent);



//Show category
$boxcontent=str_replace("{WORD_CATEGORY}",word_lang("category"),$boxcontent);
$boxcontent=str_replace("{CATEGORY}",show_category($rs->row["id_parent"],$rs->row["category2"],$rs->row["category3"]),$boxcontent);


$boxcontent=str_replace("{EDITORIAL}",word_lang("files for editorial use only"),$boxcontent);
$boxcontent=format_layout($boxcontent,"editorial",$rs->row["editorial"]);






//Show rating
$boxcontent=str_replace("{ITEM_RATING}",show_rating($id_parent,$rs->row["rating"]),$boxcontent);








$boxcontent=str_replace("{WORD_DOWNLOADS}",word_lang("downloads"),$boxcontent);
$boxcontent=str_replace("{DOWNLOADS}",strval($rs->row["downloaded"]),$boxcontent);



$boxcontent=str_replace("{WORD_FILE_DETAILS}",word_lang("file details"),$boxcontent);
$boxcontent=str_replace("{WORD_VIEWED}",word_lang("viewed"),$boxcontent);
$boxcontent=str_replace("{VIEWED}",strval($rs->row["viewed"]),$boxcontent);
$boxcontent=str_replace("{WORD_DESCRIPTION}",word_lang("description"),$boxcontent);
$boxcontent=str_replace("{DESCRIPTION}",$rs->row["description"],$boxcontent);
$boxcontent=str_replace("{WORD_AUTHOR}",word_lang("author"),$boxcontent);
$boxcontent=str_replace("{WORD_TOOLS}",word_lang("tools"),$boxcontent);
$boxcontent=str_replace("{WORD_PORTFOLIO}",word_lang("member portfolio"),$boxcontent);
$boxcontent=str_replace("{WORD_MAIL}",word_lang("sitemail to user"),$boxcontent);
$boxcontent=str_replace("{WORD_DOWNLOADSAMPLE}",word_lang("download sample"),$boxcontent);









//Show next/previous navigation
show_navigation($id_parent,"photos");


//Show author
show_author($rs->row["author"]);


//Show community tools
show_community();

//Show google map
show_google_map($rs->row["google_x"],$rs->row["google_y"]);

//Show EXIF info
show_exif($id_parent);


//Show keywords
$keywords=array();
show_keywords($id_parent,"photo");



//Show tell a friend
$boxcontent=str_replace("{TELL_A_FRIEND_LINK}",site_root."/members/tell_a_friend.php?id_parent=".(int)$id_parent,$boxcontent);
$boxcontent=str_replace("{WORD_TELL_A_FRIEND}",word_lang("tell a friend"),$boxcontent);



//Show favorite buttons
show_favorite($id_parent);








if(isset($_SESSION["people_id"]))
{
	$boxcontent=str_replace("{MAIL_LINK}",site_root."/members/messages_new.php?user=".$rs->row["author"],$boxcontent);
}
else
{
	$boxcontent=str_replace("{MAIL_LINK}",site_root."/members/login.php",$boxcontent);
}


//Share this
$boxcontent=str_replace("{WORD_SHARE}",word_lang("share this"),$boxcontent);




//Show related items
$related_items=show_related_items($id_parent,"photo");








$boxcontent=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$boxcontent);


$sql="select id_parent,itemid from reviews where itemid=".(int)$id_parent;
$dr->open($sql);
$boxcontent=str_replace("{WORD_REVIEWS}",word_lang("reviews")."(".strval($dr->rc).")",$boxcontent);
$boxcontent=str_replace("{ID}",strval($id_parent),$boxcontent);























//Show prices and prints
$sizebox="";
$photo_dpi=(int)$global_settings["resolution_dpi"];
if($photo_dpi<=0){$photo_dpi=72;}
$size_photo="px";


if(($site_subscription==true and isset($_SESSION["people_login"]) and user_subscription($_SESSION["people_login"],$id_parent)) or $rs->row["free"]==1 or $site_subscription_only)
{
	$subscription_item=true;
}
else
{
	$subscription_item=false;
}



	$sizebox_labels="";
	$sizeboxes=array();
	if(file_exists($DOCUMENT_ROOT.server_url($rs->row["server1"])."/".$folder))
	{
		$sql="select id_parent,name from licenses order by priority";
		$dd->open($sql);
		//$sizebox_labels_checked="checked";
		$sizebox_buy_checked="";
		while(!$dd->eof)
		{
			$flag_license=true;

			$sql="select id_parent,title,size from sizes where license=".$dd->row["id_parent"]." order by priority";
			$dr->open($sql);
			$ncount=0;
			while(!$dr->eof)
			{
				$sql="select id,name,url,price from items where price_id=".$dr->row["id_parent"]." and id_parent=".$id_parent." order by priority";
				$ds->open($sql);
				while(!$ds->eof)
				{
					if($flag_license)
					{
						$sizeboxes[$dd->row["id_parent"]]="";
						//$sizebox_labels.="<input type='radio' name='license' id='license".$dd->row["id_parent"]."' value='".$dd->row["id_parent"]."' style='margin-left:20px;margin-right:10px'  onClick='apanel(".$dd->row["id_parent"].");' ".$sizebox_labels_checked."><label for='license".$dd->row["id_parent"]."' >".$dd->row["name"]."</label>";
						$sizebox_labels_checked="";
						$flag_license=false;
					}

					$photo_width=0;
					$photo_height=0;
					$photo_filesize=0;

					if(!$flag_storage)
					{
						$photo_width=$image_width;
						$photo_height=$image_height;
						$photo_filesize=$image_filesize;
					}
					else
					{
						$photo_width=$remote_width;
						$photo_height=$remote_height;
						$photo_filesize=$remote_filesize;
					}


					if($photo_width!=0 and $photo_height!=0)
					{
						$rw=$photo_width;
						$rh=$photo_height;
						$boxcontent=str_replace("{PHOTO_WIDTH}",$rw,$boxcontent);
						$boxcontent=str_replace("{PHOTO_HEIGHT}",$rh,$boxcontent);

						$photo_size=strval(float_opt($photo_filesize/(1024*1024),3))." Mb.";

						$boxcontent=str_replace("{PHOTO_SIZE}",$photo_size,$boxcontent);



						if($dr->row["size"]!=0)
						{
							if($rw>$rh)
							{
								$rw=$dr->row["size"];
								if($rw!=0)
								{
									$rh=round($photo_height*$rw/$photo_width);
								}
							}
							else
							{
								$rh=$dr->row["size"];
								if($rh!=0)
								{
									$rw=round($photo_width*$rh/$photo_height);
								}
							}
							$dpi=$photo_dpi;
						}
						else
						{
							$dpi=$photo_dpi;
						}
					}

					if($size_photo=="cm")
					{
						$rw=float_opt($rw*2.54/$dpi,1);
						$rh=float_opt($rh*2.54/$dpi,1);
					}



					$subscription_link="";

					if($ncount==0)
					{
						$sizebox_buy_checked="checked";
					}
					else
					{
						$sizebox_buy_checked="";
					}

					$bt="<input type='radio'  id='cart' name='cart' value='".$ds->row["id"]."' ".$sizebox_buy_checked.">";

					if(($photo_width>=$photo_height and $dr->row["size"]<=$photo_width) or ($photo_width<$photo_height and $dr->row["size"]<=$photo_height))
					{

						$content_price="<td nowrap onClick='xcart(".$ds->row["id"].");'><span class='price'>".currency(1).float_opt($ds->row["price"],2,true)." ".currency(2)."</span></td>";

						if($rs->row["free"]==1)
						{
							$content_price="";
						}

						$inches_string=float_opt($rw/$dpi,1)."&quot;&nbsp;x&nbsp;".float_opt($rh/$dpi,1)."&quot;&nbsp;@&nbsp;".$dpi."&nbsp;dpi";

						//$inches_string=float_opt($rw*2.54/$dpi,1)."cm&nbsp;x&nbsp;".float_opt($rh*2.54/$dpi,1)."cm&nbsp;@&nbsp;".$dpi."&nbsp;dpi";

						$sizeboxes[$dd->row["id_parent"]].="<tr   class='tr_cart' id='tr_cart".$ds->row["id"]."'><td onClick='xcart(".$ds->row["id"].");'>".$ds->row["name"].$subscription_link."</td><td onClick='xcart(".$ds->row["id"].");'><div class='item_pixels'>".$rw."&nbsp;x&nbsp;".$rh."&nbsp;".$size_photo."</div><div class='item_inches' style='display:none'>".$inches_string."</div></td>".$content_price."<td onClick='xcart(".$ds->row["id"].");'>".$bt."</td></tr>";
					}


				$ds->movenext();
				}
			$ncount++;
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


				$value="<table style='display:none'   border='0' cellpadding='0' cellspacing='0' class='table_cart'><tr valign='top'><th width='30%'>".word_lang("title")."</th><th><a href=\"javascript:show_size('".$key."');\" id='link_size1_".$key."' class='link_pixels'>".word_lang("pixels")."</a>&nbsp;<a href=\"javascript:show_size('".$key."');\" id='link_size2_".$key."' class='link_inches'>".word_lang("inches")."</a></th>".$text_price."<th>".$word_buy."</th></tr>".$value."</table>";
			}
			$sizebox.="<div name='p".$key."' id='p".$key."' style='display:".$sizebox_display."'>".$value."</div>";
			$sizebox_display="none";
		}


	$prints_label="";
	$prints_content="";

	if($global_settings["prints"])
	{

		$print_buy_checked="checked";
		$prints_display="block";
		if($site_printsonly==true)
		{
			$prints_display="block";
		}

		$sql="select id_parent,title,price,printsid from prints_items where itemid=".(int)$id_parent." order by priority";
		$dr->open($sql);
		if(!$dr->eof)
		{

			$prints_label="<input type='radio' name='license' id='prints_label' style='margin-left:20px;margin-right:10px'  onClick='apanel(0);'><label for='prints_label' >".word_lang("prints and products")."</label>";

			$prints_content.="<div name='p0' id='p0' style='display:".$prints_display."'><table border='0' cellpadding='0' cellspacing='0' class='table_cart'><tr valign='top'><th>".word_lang("title")."</th><th>".word_lang("price")."</th><th>".word_lang("buy")."</th></tr>";
			while(!$dr->eof)
			{
				$prints_preview="";
				if(file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/content/prints/product".$dr->row["printsid"]."_1_big.jpg") or file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/content/prints/product".$dr->row["printsid"]."_2_big.jpg") or file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/content/prints/product".$dr->row["printsid"]."_3_big.jpg"))
				{
					$prints_preview="<a href='javascript:show_prints_preview(".$dr->row["printsid"].");'>";
				}

				$prints_content.="<tr class='tr_cart' id='tr_cart".$dr->row["id_parent"]."'><td width='60%' onClick='xprint(".$dr->row["id_parent"].");'>".$prints_preview.$dr->row["title"]."</td><td onClick='xprint(".$dr->row["id_parent"].");' ><span class='price'>".currency(1).float_opt($dr->row["price"],2,true)." ".currency(2)."</span></td><td onClick='xprint(".$dr->row["id_parent"].");'><input type='radio'  id='cartprint' name='cartprint' value='-".$dr->row["id_parent"]."' ".$print_buy_checked."></td></tr>";

				$print_buy_checked="";

				$dr->movenext();
			}
			$prints_content.="</table><input class='add_to_cart' type='button' onclick=\"add_cart(1)\" value='".word_lang("add to cart")."'></div>";
		}

	}


		if($global_settings["printsonly"])
		{
			$sizebox=$prints_content;
		}
		else
		{

			$sizebox="<div style='margin-bottom:6px;margin-top:15px' class='price_license'><a href='".site_root."/members/license.php'>".word_lang("license").":</a></b> ".$sizebox_labels.$prints_label."</div>".$sizebox.$prints_content;

			if($subscription_item)
			{
				$word_cart=word_lang("download");
				if($rs->row["free"]==1)
				{
					$word_cart=word_lang("free download");
				}

				$sizebox.="<input id='item_button_cart' class='add_to_cart' type='button' onclick=\"add_download('photo',".$rs->row["id_parent"].",".$rs->row["server1"].")\" value='".$word_cart."'>";
			}
			else
			{
			//	$sizebox.="<input id='item_button_cart' class='add_to_cart' type='button' onclick=\"add_cart(0)\" value='".word_lang("add to cart")."'>";
			}

		}



	}
//End show prices and prints




























$boxcontent=str_replace("{SIZES}",$sizebox,$boxcontent);
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




