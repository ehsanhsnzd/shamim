<?


$flag_empty=false;
$search_content="";

if($flow==1)
{
	$search_cache_id="f|".$sql_cache_id."|".$lang_symbol[$lng];
}
else
{
	$search_cache_id="l|".$sql_cache_id."|".$lang_symbol[$lng];
}

if(!$smarty->is_cached('listing.tpl',$search_cache_id) or $site_cache_catalog<0 or isset($_REQUEST["lightbox"]))
{
 $sql.=" ".$com.$lm;
	$rs->open($sql);
	if(!$rs->eof)
	{
		//Items for this category
         
		if($flow==1)
		{
			$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."item_list.tpl");
		}
		else
		{
			$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."item_list_flow.tpl");
		}
		
		while(!$rs->eof)
		{
			$itembox=$boxcontent;
			

			
			//Define author
			$user_name=show_user_name($rs->row["author"]);


			

			//Define url
			$itembox=str_replace("{ITEM_URL}",item_url($rs->row["id"],$rs->row["url"]),$itembox);
			$itembox=str_replace("{ITEM_ID}",$rs->row["id"],$itembox);

			//Define preview
			$item_img="";
			$item_lightbox="";

			//Show photo
			if($rs->row["module_table"]==30)
			{
				$item_type="photo";
				$itembox=str_replace("{CLASS}","1",$itembox);				
			}
			
			//Show video
			if($rs->row["module_table"]==31)
			{
				$item_type="video";
				$itembox=str_replace("{CLASS}","2",$itembox);
			}
			
			//Show audio
			if($rs->row["module_table"]==52)
			{
				$item_type="audio";
				$itembox=str_replace("{CLASS}","3",$itembox);
			}
			
			//Show vector
			if($rs->row["module_table"]==53)
			{
				$item_type="vector";
				$itembox=str_replace("{CLASS}","4",$itembox);
			}
			
			$item_img=show_preview($rs->row["id"],$item_type,1,1,$rs->row["server1"],$rs->row["folder"]);
			
			$hoverbox_results=get_hoverbox($rs->row["id"],$item_type,$rs->row["server1"],$rs->row["atitle"],$user_name);			
			$itembox=str_replace("{ITEM_IMG2}",$hoverbox_results["flow_image"],$itembox);
			$itembox=str_replace("{ITEM_LIGHTBOX}",$hoverbox_results["hover"],$itembox);
						
			$str_width=" width='".$hoverbox_results["flow_width"]."' ";
			$str_height=" height='".$hoverbox_results["flow_height"]."' ";
			
			$str_width2="width:".$hoverbox_results["flow_width"]."px";
			$str_height2="height:".$hoverbox_results["flow_height"]."px";

			$itembox=str_replace("{WIDTH}",$str_width,$itembox);
			$itembox=str_replace("{HEIGHT}",$str_height,$itembox);

			$itembox=str_replace("{WIDTH2}",$str_width2,$itembox);
			$itembox=str_replace("{HEIGHT2}",$str_height2,$itembox);


			//$itembox=str_replace("{ADD_TO_CART}",word_lang("add to cart"),$itembox);
			$itembox=str_replace("{CART_FUNCTION}","add",$itembox);
			$itembox=str_replace("{CART_CLASS}","",$itembox);

				$subscription_item=false;
	if((isset($_SESSION["people_login"]) and user_subscription($_SESSION["people_login"],$id_parent)) or $rs->row["free"]==1 or $site_subscription_only)
	{
		if($ds->row["shipped"]!=1)
		{
			$subscription_item=true;
		}
	}
			
			if($subscription_item)
			{
				$word_cart=word_lang("download");
				if($rs->row["free"]==1)
				{
					$word_cart=word_lang("free download");
				}
	
	$sql="select id from items where id_parent=".$rs->row["id"]." order by priority";
					$dn->open($sql);
					if(!$dn->eof)
					{
	
				$add_cat_dow= "add_download('vector',".$rs->row["id"].",".$rs->row["server1"].",".$dn->row["id"].")";
				$str_cart=word_lang("download");
					}
			}
			else
			{
				$add_cat_dow="add_cart_flow(".$rs->row["id"].",'".site_root."')";
				$str_cart=word_lang("add to cart");
			}
			
			$itembox=str_replace("{ADD_CARD_DOWN}",$add_cat_dow,$itembox);
			$itembox=str_replace("{ADD_TO_CART}",$str_cart,$itembox);
			$acart = array();
			preg_match_all('|\{if cart\}(.*)\{/if\}|Uis', $itembox, $acart);
			if($rs->row["free"]!=1 and isset($acart[1][0]) and isset($acart[0][0]))
			{
				$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',$acart[1][0],$itembox);
			}
			else
			{
				if($rs->row["free"]==1)
				{
					$sql="select id from items where id_parent=".$rs->row["id"]." and shipped<>1 order by priority desc";
					$dn->open($sql);
					if(!$dn->eof)
					{
						$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"<a href='".site_root."/members/count.php?id=".$dn->row["id"]."&id_parent=".$rs->row["id"]."&type=".$item_type."&server=".$rs->row["server1"]."' class='ac'>".word_lang("free download")."</a>",$itembox);
					}
					else
					{
						$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"<span class='ac_text'>".word_lang("free download")."</span>",$itembox);
					}
				}
				else
				{
					$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"",$itembox);
				}
			}
			
			
			$acart = array();
			preg_match_all('|\{if cart\}(.*)\{/if\}|Uis', $itembox, $acart);
			if($rs->row["free"]!=1 and isset($acart[1][0]) and isset($acart[0][0]))
			{
				$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',$acart[1][0],$itembox);
			}
			else
			{
				if($rs->row["free"]==1)
				{
					$sql="select id from items where id_parent=".$rs->row["id"]." and shipped<>1 order by priority desc";
					$dn->open($sql);
					if(!$dn->eof)
					{
						$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"<a href='".site_root."/members/count.php?id=".$dn->row["id"]."&id_parent=".$rs->row["id"]."&type=".$item_type."&server=".$rs->row["server1"]."' class='ac'>".word_lang("free download")."</a>",$itembox);
					}
					else
					{
						$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"<span class='ac_text'>".word_lang("free download")."</span>",$itembox);
					}
				}
				else
				{
					$itembox=preg_replace('|\{if cart\}(.*)\{/if\}|Uis',"",$itembox);
				}
			}
			
			$acartflow = array();
			preg_match_all('|\{if cartflow\}(.*)\{/if\}|Uis', $itembox, $acartflow);
			if($rs->row["free"]!=1 and isset($acartflow[1][0]) and isset($acartflow[0][0]))
			{
				$itembox=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',$acartflow[1][0],$itembox);
			}
			else
			{
				if($rs->row["free"]==1)
				{
					$sql="select id from items where id_parent=".$rs->row["id"]." and shipped<>1 order by priority desc";
					$dn->open($sql);
					if(!$dn->eof)
					{
						$itembox=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"<li id='hb_free".$rs->row["id"]."' class='hb_free' title='{lang.Free download}' onClick=\"location.href='".site_root."/members/count.php?id=".$dn->row["id"]."&id_parent=".$rs->row["id"]."&type=".$item_type."&server=".$rs->row["server1"]."'\"></li>",$itembox);
					}
					else
					{
						$itembox=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"<li id='hb_free".$rs->row["id"]."' class='hb_free' title='{lang.Free download}'></li>",$itembox);
					}
				}
				else
				{
					$itembox=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"",$itembox);
				}
			}


			//Properties
			$itembox=str_replace("{ITEM_PUBLISHED}",date(date_short,$rs->row["adata"]),$itembox);
			$itembox=str_replace("{ITEM_VIEWED}",$rs->row["aviewed"],$itembox);
			$downloads=$rs->row["adownloaded"];
			$itembox=str_replace("{DOWNLOADS}",strval($downloads),$itembox);
			$itembox=str_replace("{ITEM_IMG}",$item_img,$itembox);
			$itembox=str_replace("{ITEM_TITLE}","#".$rs->row["id"],$itembox);
			$itembox=str_replace("{ITEM_TITLE_FULL}",$rs->row["atitle"],$itembox);
			$itembox=str_replace("{ITEM_DESCRIPTION}",$rs->row["description"],$itembox);			
			$itembox=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$itembox);
			
			

			
			$itembox=str_replace("{SITE_ROOT}",site_root,$itembox);
			
			$itembox=translate_text($itembox);
			
			
			//Save result
			$search_content.=$itembox;
			
			$n++;
			$rs->movenext();
		}
		
		$boxcontent="";
	}
	else
	{
		$search_content.="<p><b>".word_lang("not found")."</b></p>";
		$flag_empty=true;
	}
}

//Smarty cache
if($site_cache_catalog>=0)
{
	if($site_cache_catalog>0)
	{
		$smarty->cache_lifetime = $site_cache_catalog*3600;
	}
	$smarty->assign('listing',$search_content);
	if(!isset($_REQUEST["lightbox"]))
	{
		$search_content=$smarty->fetch('listing.tpl',$search_cache_id);
	}
}

?>
