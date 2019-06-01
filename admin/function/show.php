<?
if(!defined("site_root")){exit();}




//The function shows a publication's category
function show_category($id,$category2,$category3)
{
global $db;
global $ds;
global $dr;
$category_list="";

	$sql="select id_parent from structure where id=".(int)$id;
	$ds->open($sql);
	if(!$ds->eof)
	{
		$sql="select title from category where id_parent=".$ds->row["id_parent"];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$category_list.="<a href='".category_url($ds->row["id_parent"])."'>".$dr->row["title"]."</a>";
		}

		if($ds->row["id_parent"]!=$category2 and (int)$category2!=0)
		{
			$sql="select title from category where id_parent=".(int)$category2;
			$dr->open($sql);
			if(!$dr->eof)
			{
				$category_list.=" <a href='".category_url($category2)."'>".$dr->row["title"]."</a>";
			}
		}


		if($ds->row["id_parent"]!=$category3 and $category2!=$category3 and (int)$category3!=0)
		{
			$sql="select title from category where id_parent=".(int)$category3;
			$dr->open($sql);
			if(!$dr->eof)
			{
				$category_list.=" <a href='".category_url($category3)."'>".$dr->row["title"]."</a>";
			}
		}
	}


return $category_list;
}
//End. The function shows a publication's category




//The function shows a publication's rating
function show_rating($id,$rating)
{
global $db;
global $ds;
global $site_template_url;

$item_rating=(float)$rating;


	$sql="select ip,id from voteitems where ip='".result($_SERVER["REMOTE_ADDR"])."' and id=".(int)$id;
	$ds->open($sql);
	if(!$ds->eof)
	{
		$rating_link="<a href='#'>";
	}
	else
	{
		$rating_link="<a href=\"javascript:doVote('{vote}');\">";
	}



	$rating_text="<div id='votebox' name='votebox'>";

	for($j=1;$j<6;$j++)
	{
		$tt="2";
		
		if($j<=$item_rating or $j-$item_rating<=0.25){$tt="1";}
		
		if($j>$item_rating and $j-$item_rating>0.25 and $j-$item_rating<0.75){$tt="3";}
		
		$rating_text.="".str_replace("{vote}",strval($j),$rating_link)."<img src='{TEMPLATE_ROOT}images/rating".$tt.".gif' width='11' id='rating".$j."' onMouseover='mrating(".$j.");' onMouseout='mrating2(".$item_rating.");'  height='11' class='rating' border='0'></a>";
	}



	$rating_text.="</div>";
	
return $rating_text;
}
//End. The function shows a publication's rating





//The function shows a publication's related items
function show_related_items($id,$type)
{
global $db;
global $ds;
global $site_related_items_quantity;
global $keywords;
global $boxcontent;
global $site_related_items;

$related_table["photo"]="photos";
$related_table["video"]="videos";
$related_table["audio"]="audio";
$related_table["vector"]="vector";

$related_items="";
$sqlkey="";

	for($k=0;$k<count($keywords);$k++)
	{
		if($sqlkey!=""){$sqlkey.=" or ";}
		$sqlkey.=" b.title like '%".$keywords[$k]."%' or b.description like '%".$keywords[$k]."%' or b.keywords like '%".$keywords[$k]."%' ";
	}
	
	if($sqlkey!="")
	{
		$tt=0;
		
		$sql="select a.id,a.id_parent, b.id_parent,b.title,b.folder,b.server1,b.url,b.author from structure a, ".$related_table[$type]." b where a.id=b.id_parent and  b.published=1 and b.id_parent<>".(int)$id." and (".$sqlkey.") ".get_password_protected()." order by rand() limit ".$site_related_items_quantity;
		
		$ds->open($sql);
		
		if(!$ds->eof)
		{
			$related_items.="<div class=\"sc_menu\"><ul class=\"sc_menu\">";
			
			while(!$ds->eof)
			{

					if($tt<$site_related_items_quantity)
					{
						$preview_type=1;
						if($type=="video" or $type=="audio")
						{
							$preview_type=3;
						}
						
						$hoverbox_results=get_hoverbox($ds->row["id_parent"],$type,$ds->row["server1"],$ds->row["title"],show_user_name($ds->row["author"]));
						
						$related_items.="<li><div class='sc_menu_div' style='background:url(".show_preview($ds->row["id_parent"],$type,$preview_type,1).");background-size:cover'><a href='".item_url($ds->row["id_parent"],$ds->row["url"])."'><img src='".site_root."/images/e.gif' alt='".$ds->row["title"]."' border='0' ".$hoverbox_results["hover"]."></a></div></li>";
					}
					$tt++;
				
			$ds->movenext();
			}

			$related_items.="</ul></div>";
		}
	}


	$boxcontent=str_replace("{WORD_RELATED_ITEMS}",word_lang("related items"),$boxcontent);

	$boxcontent=str_replace("{RELATED_ITEMS}",$related_items,$boxcontent);
	$arelated_items = array();
	
	$flag_related=false;
	if($site_related_items==true and $related_items!="")
	{
		$flag_related=true;
	}
	$boxcontent=format_layout($boxcontent,"related_items",$flag_related);
}
//End. The function shows a publication's related items




//The function shows a publication's add to favorite button
function show_favorite($id)
{
global $db;
global $dr;
global $boxcontent;
global $_SESSION;



$boxcontent=str_replace("{ADD_TO_FAVORITE}",word_lang("add to favorite list"),$boxcontent);
$boxcontent=str_replace("{ADD_TO_FAVORITE_LINK}","javascript:show_lightbox(".(int)$id.",'".site_root."')",$boxcontent);


}
//End. The function shows a publication's add to favority button




//The function shows a publication's author
function show_author($author)
{
global $db;
global $dr;
global $boxcontent;

	$boxauthor=show_user_avatar($author,"login");
	$boxcontent=str_replace("{PORTFOLIO_LINK}",site_root."/index.php?user=".user_url($author)."&portfolio=1",$boxcontent);

	$boxcontent=str_replace("{AUTHOR}",$boxauthor,$boxcontent);
}
//End. The function shows a publication's author



//The function shows a publication's keywords
function show_keywords($id,$type)
{
global $db;
global $rs;
global $dr;
global $boxcontent;
global $keywords;
global $site_watermarkinfo;
global $site_template_url;
global $watermark_position;

	$kw="";
	$kw_lite="";
	if($rs->row["keywords"]!="")
	{
		$keywords=explode(",",str_replace(";",",",$rs->row["keywords"]));
		for($i=0;$i<count($keywords);$i++)
		{
			$keywords[$i]=trim($keywords[$i]);
			if($keywords[$i]!="")
			{
				$kw.="<div style='margin-bottom:3px'><input type='checkbox' name='s_".str_replace(" ","_",$keywords[$i])."'>&nbsp;<a href='".site_root."/?search=".$keywords[$i]."'>".$keywords[$i]."</a></div>";
				$kw_lite.="<a href='".site_root."/?search=".$keywords[$i]."'>".$keywords[$i]."</a> ";
			}
		}
		
		if($site_watermarkinfo==true and $type=="photo")
		{
		
			$wposit="<table border='0' cellpadding='0' cellspacing='1'><tr>";
			for($i=1;$i<10;$i++)
			{
				$wsel="b";
				if($watermark_position==$i){$wsel="o";}

				if(site_root==""){$wpath="/";}
				else{$wpath=site_root."/";}

				$wposit.="<td><img src='".$wpath.$site_template_url."images/".$wsel.".gif' width='5' height='5'></td>";

				if($i%3==0){$wposit.="</tr><tr>";}
			}
			$wposit.="</tr></table>";

		
			$kw.="<div style='margin-bottom:3px'><table border='0' cellpadding='0' cellspacing='0'><tr><td><input type='checkbox' name='swatermark' value='".$rs->row["watermark"]."'></td><td>&nbsp;</td><td>".word_lang("watermark")."</td><td>&nbsp;</td><td>".$wposit."</td></tr></table></div>";
		}
	}
	
	if($kw!="")
	{
		$boxcontent=str_replace("{WORD_KEYWORDS}",word_lang("keywords").":",$boxcontent);
		$boxcontent=str_replace("{KEYWORDS}","<form method='get' action='".site_root."/' style='margin:0px'>".$kw."<input type='submit' value='".word_lang("search")."'></form>",$boxcontent);
		$boxcontent=str_replace("{KEYWORDS_LITE}",$kw_lite,$boxcontent);
	}
	else
	{
		$boxcontent=str_replace("{WORD_KEYWORDS}","",$boxcontent);
		$boxcontent=str_replace("{KEYWORDS}","",$boxcontent);
		$boxcontent=str_replace("{KEYWORDS_LITE}","",$boxcontent);
	}



}
//End. The function shows a publication's keywords




//The function shows a publication's community tools
function show_community()
{
global $boxcontent;
global $site_reviews;
global $site_messages;
global $site_model;
global $site_show_model;
global $db;
global $rs;

	$boxcontent=format_layout($boxcontent,"reviews",$site_reviews);
	$boxcontent=format_layout($boxcontent,"messages",$site_messages);




	$boxcontent=str_replace("{MODEL}","<a href='".model_url($rs->row["model"])."'>".word_lang("model property release")."</a>",$boxcontent);
	
	$flag_model=false;
	if($site_model==true and $site_show_model==true and (int)$rs->row["model"]!=0)
	{
		$flag_model=true;
	}
	$boxcontent=format_layout($boxcontent,"model",$flag_model);


	
	$boxcontent=str_replace("{WORD_BACK}",word_lang("back to results"),$boxcontent);	

	if(isset($_SERVER["HTTP_REFERER"]) and $_SERVER["HTTP_REFERER"]!="")
	{	
		$boxcontent=str_replace("{LINK_BACK}",$_SERVER["HTTP_REFERER"],$boxcontent);
	}
	
	$flag_back=false;
	if(isset($_SERVER["HTTP_REFERER"]) and $_SERVER["HTTP_REFERER"]!="")
	{
		$flag_back=true;
	}
	$boxcontent=format_layout($boxcontent,"back",$flag_back);
	
}
//End. The function shows a publication's community tools







//The function shows Google map
function show_google_map($x,$y)
{
global $boxcontent;
global $site_google;

	$boxcontent=str_replace("{WORD_GOOGLE}",word_lang("Show on Google map"),$boxcontent);
	$boxcontent=str_replace("{GOOGLE_X}",$x,$boxcontent);
	$boxcontent=str_replace("{GOOGLE_Y}",$y,$boxcontent);

	$flag_google=false;
	if($site_google==true and (float)$x!=0 and (float)$y!=0)
	{
		$flag_google=true;
	}
	$boxcontent=format_layout($boxcontent,"google",$flag_google);	
}
//End. The function shows Google map





//The function shows EXIF info
function show_exif($id)
{
global $boxcontent;
global $site_exif;
global $flag_storage;

	$boxcontent=str_replace("{WORD_EXIF}",word_lang("Show EXIF info"),$boxcontent);

	$flag_exif=false;
	if($site_exif==true and !$flag_storage)
	{
		$flag_exif=true;
	}
	$boxcontent=format_layout($boxcontent,"exif",$flag_exif);	
}
//End. The function shows EXIF info






//The function shows next/previous navigation
function show_navigation($id,$type)
{
global $db;
global $dr;
global $boxcontent;
$navigation="";

	$idp=0;
	$sql="select id_parent from structure where id=".(int)$id;
	$dr->open($sql);
	if(!$dr->eof)
	{
		$idp=$dr->row["id_parent"];
	}
	
	$sql="select a.id,a.id_parent,b.id_parent from structure a,".$type." b where a.id=b.id_parent and a.id_parent=".$idp." and a.id<".(int)$id." order by a.id desc";
	$dr->open($sql);
	if(!$dr->eof)
	{
		$navigation.="<a href='".item_url($dr->row["id_parent"])."'>&#171; ".word_lang("Previous")."</a>";
	}
	
	$sql="select a.id,a.id_parent,b.id_parent from structure a,".$type." b where a.id=b.id_parent and a.id_parent=".$idp." and a.id>".(int)$id." order by a.id";
	$dr->open($sql);
	if(!$dr->eof)
	{
		$navigation.=" <a href='".item_url($dr->row["id_parent"])."'>".word_lang("Next")."&#187; </a>";
	}

$boxcontent=str_replace("{NAVIGATION}",$navigation,$boxcontent);
}
//End. The function shows next/previous navigation
?>