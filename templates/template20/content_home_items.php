<?
if(!defined("site_root")){exit();}

function build_variables($var_default,$var_default2,$show_phpfile=true,$var_default3='',$ajax=false)
{
	global $_REQUEST;
	global $scripts_variables;
	$result_vars="";
	$ajax_vars="";
	for($i=0;$i<count($scripts_variables);$i++) 
	{
		if($scripts_variables[$i]!=$var_default and $scripts_variables[$i]!=$var_default2 and $scripts_variables[$i]!=$var_default3 and isset($_REQUEST[$scripts_variables[$i]]))
		{
			if($result_vars!="")
			{
				$result_vars.="&";
			}
			
			if($ajax_vars!="")
			{
				$ajax_vars.=",";
			}
			
			$result_vars.=$scripts_variables[$i]."=".result($_REQUEST[$scripts_variables[$i]]);
			$ajax_vars.=$scripts_variables[$i].":'".result($_REQUEST[$scripts_variables[$i]])."'";
		}
	}
	if($result_vars=="")
	{
		$result_vars="search=";
	}
	if($ajax==false)
	{
		if($show_phpfile)
		{
			return site_root."/index.php?".$result_vars;
		}
		else
		{
			return "&".$result_vars;
		}
	}
	else
	{
		return $ajax_vars;
	}
}
//End. The function builds all current variables list

//The function builds listing id cache
function build_listing_id()
{
	global $_REQUEST;
	global $scripts_variables;
	$result_vars="";

	for($i=0;$i<count($scripts_variables);$i++) 
	{
		$value="";
		if(isset($_REQUEST[$scripts_variables[$i]]))
		{
			$value=result($_REQUEST[$scripts_variables[$i]]);
		}
			$result_vars.=$i."-".$value;

	}

	return $result_vars;
}
//The function builds listing id cache





function home_slide($id_parent){

//Connection to the database
$db = new TMySQLConnection;
$rs = new TMySQLQuery;
$ds = new TMySQLQuery;
$dr = new TMySQLQuery;
$dn = new TMySQLQuery;
$dd = new TMySQLQuery;
$dq = new TMySQLQuery;

$db->connect();
$rs->connection = $db;
$ds->connection = $db;
$dr->connection = $db;
$dn->connection = $db;
$dd->connection = $db;
$dq->connection = $db;

include("content_home_vars.php");

//Smarty
 



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

 	$count_c=0;
 	$search_content='<div class="container">
    <div class="row">
		<div class="col-md-12">
                <div id="Carousel" class="carousel slide">
                <div class="carousel-inner">
				
				';
				
 $sql.=" ".$com.$lm;
	$rs->open($sql);

	
	if(!$rs->eof)
	{ 
		//Items for this category
		$flow=1;
		if($flow==1)
		{
			$boxcontent=file_get_contents($DOCUMENT_ROOT."".$site_template_url."templates/template20/item_home_flow.tpl");
		}
		else
		{ 
			$boxcontent=file_get_contents($DOCUMENT_ROOT."".$site_template_url."templates/template20/item_home.tpl");
		}
		
		while(!$rs->eof)
		{
		 	 $count_c++;
			 
			if($count_c == 1){$active= " active"; }
			
			if($count_c % 6==0 || $count_c ==1){
			$search_content.=' <div class="item'.$active .'">'.
                	'
					<div class="row">';
					$count_c ==7;
			}	
	
 
	$itembox='
	<div class="col-md-2">'.$boxcontent;
			

			
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


			$itembox=str_replace("{ADD_TO_CART}",word_lang("add to cart"),$itembox);
			$itembox=str_replace("{CART_FUNCTION}","add",$itembox);
			$itembox=str_replace("{CART_CLASS}","",$itembox);

			
			
			
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
			
						
			$itembox.='</div>';
			
			//Save result
			$search_content.=$itembox;
			
			$n++;
			$rs->movenext();
		
		if($count_c % 6==0){
			$search_content.='</div>
                </div>';
			}
		
		}
		if((int)($count_c / 6)!=($count_c / 6)){
			$search_content.='</div>
                </div>';
			}
		
		$search_content.='       </div><!--.carousel-inner-->
                  <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                </div><!--.Carousel-->         
		</div>
	</div>
</div>';
		
		$boxcontent="";
	}
	else
	{
		$search_content.="<p><b>".word_lang("not found")."</b></p>";
		$flag_empty=true;
	}
	return $search_content;
}
 
?>