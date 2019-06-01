<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);




$component_id=(int)@$_REQUEST['id'];
$component_body="";

if(isset($_REQUEST['str']))
{
	$str=(int)$_REQUEST['str'];
}
else
{
	$str=1;
}

if(isset($component_id))
{
	$smarty_component_id="component|".$component_id."|".$str."|".$lng;
	if(!$smarty->is_cached('component.tpl',$smarty_component_id))
	{
		$stitle=array();
		$sdescription=array();
		$sauthor=array();
		$slink=array();
		$simage=array();
		$sid=array();
		$stype=array();
		$sserver=array();
		$sfree=array();

		$sql="select * from components where id=".(int)$component_id;
		$rs->open($sql);
		if(!$rs->eof)
		{

		if(preg_match("/photo/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url,b.free from structure a, photos b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/video/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url,b.free from structure a, videos b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/audio/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url,b.free from structure a, audio b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/vector/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url,b.free from structure a, vector b where a.id=b.id_parent and b.published=1";
		}

		if($rs->row["category"]!=0)
		{
			$sql.=" and a.id_parent=".$rs->row["category"];
		}

		if($rs->row["user"]!="")
		{
			$sql.=" and b.author='".$rs->row["user"]."'";
		}

		if($rs->row["types"]=="featured")
		{
			$sql.=" and b.featured=1";
		}

		if($rs->row["types"]=="free")
		{
			$sql.=" and b.free=1";
		}

		if($rs->row["types"]=="free")
		{
			$sql.=" and b.free=1";
		}

		$sql.=get_password_protected();

		if($rs->row["types"]=="new")
		{
			$sql.=" order by b.data desc";
		}
		elseif($rs->row["types"]=="popular")
		{
			$sql.=" order by b.viewed desc";
		}
		elseif($rs->row["types"]=="downloaded")
		{
			$sql.=" order by b.downloaded desc";
		}
		else
		{
			$sql.=" order by rand()";
		}


		//$sql.=" limit ".$rs->row["quantity"];
		$sql.=" limit ".($rs->row["quantity"]*($str-1)).",".$rs->row["quantity"];
		//echo($sql);

		$ds->open($sql);
		$tt=0;
		while(!$ds->eof)
		{
			if(isset($ds->row["id_parent"]))
			{
				if($tt<$rs->row["quantity"])
				{
					$stitle[]=$ds->row["title"];
					$sdescription[]=$ds->row["description"];
					$sid[]=$ds->row["id"];
					$sauthor[]=$ds->row["author"];
					$sserver[]=$ds->row["server1"];
					$sfree[]=$ds->row["free"];

					$slink[]=surl.item_url($ds->row["id"],$ds->row["url"]);



						if(preg_match("/photo/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=2;}
							$simage[]=show_preview($ds->row["id"],"photo",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
							$stype[]="photo";
						}
						elseif(preg_match("/vector/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=2;}
							$simage[]=show_preview($ds->row["id"],"vector",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
							$stype[]="vector";
						}
						elseif(preg_match("/video/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=3;}
							$simage[]=show_preview($ds->row["id"],"video",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
							$stype[]="video";
						}
						elseif(preg_match("/audio/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=3;}
							$simage[]=show_preview($ds->row["id"],"audio",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
							$stype[]="audio";
						}
						else
						{
							$simage[]="";
						}

				}
				$tt++;
			}
			$ds->movenext();
		}

		$box=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."box_home.tpl");





		for($n=0;$n<count($stitle);$n++)
		{
				if($n<count($slink) and $n<count($simage))
				{
					$boxcontent=$box;
					$boxcontent=str_replace("{TITLE}",$stitle[$n],$boxcontent);
					$boxcontent=str_replace("{DESCRIPTION}",$sdescription[$n],$boxcontent);
					
					$hoverbox_results=get_hoverbox($sid[$n],$stype[$n],$sserver[$n],$stitle[$n],show_user_name($sauthor[$n]));
			
					$str_width=" width='".$hoverbox_results["flow_width"]."' ";
					$str_height=" height='".$hoverbox_results["flow_height"]."' ";

					$boxcontent=str_replace("{WIDTH}",$str_width,$boxcontent);
					$boxcontent=str_replace("{HEIGHT}",$str_height,$boxcontent);
					$boxcontent=str_replace("{LIGHTBOX}",$hoverbox_results["hover"],$boxcontent);
					$boxcontent=str_replace("{URL}",$slink[$n],$boxcontent);
					$boxcontent=str_replace("{ID}",$sid[$n],$boxcontent);
					$boxcontent=str_replace("{IMAGE}",$simage[$n],$boxcontent);
					
					$acartflow = array();
					preg_match_all('|\{if cartflow\}(.*)\{/if\}|Uis',$boxcontent, $acartflow);
					if($sfree[$n]!=1 and isset($acartflow[1][0]) and isset($acartflow[0][0]))
					{
						$boxcontent=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',$acartflow[1][0],$boxcontent);
					}
					else
					{
						if($sfree[$n]==1)
						{
							$sql="select id from items where id_parent=".$sid[$n]." and shipped<>1 order by priority desc";
							$dn->open($sql);
							if(!$dn->eof)
							{
								$boxcontent=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"<li id='hb_free".$sid[$n]."' class='hb_free' title='{lang.Free download}' onClick=\"location.href='".site_root."/members/count.php?id=".$dn->row["id"]."&id_parent=".$sid[$n]."&type=".$stype[$n]."&server=".$sserver[$n]."'\"></li>",$boxcontent);
							}
							else
							{
								$boxcontent=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"<li id='hb_free".$sid[$n]."' class='hb_free' title='{lang.Free download}'></li>",$boxcontent);
							}
						}
						else
						{
							$boxcontent=preg_replace('|\{if cartflow\}(.*)\{/if\}|Uis',"",$boxcontent);
						}
					}
					

				$component_body.=$boxcontent;
				}
		}


		}
	}
$component_body=str_replace("{SITE_ROOT}",site_root,$component_body);
$component_body=translate_text($component_body);
$smarty->cache_lifetime = 3600*$site_cache_components;
$smarty->assign("component", $component_body);
$component_body=$smarty->fetch('component.tpl',$smarty_component_id);
echo($component_body);
}
?>