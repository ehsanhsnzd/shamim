<?
if(!defined("site_root")){exit();}


//Current page
if(!isset($_REQUEST["str"])){$str=1;}
else{$str=(int)$_REQUEST["str"];}

if(isset($_REQUEST["sort"])){$sort=(int)$_REQUEST["sort"];}
else{$sort=1;}

if(!isset($_REQUEST["vd"])){$vd=$global_settings["sorting_catalog"];}
else{$vd=$_REQUEST["vd"];}

$search="";
if(isset($_REQUEST["search"])){$search=$_REQUEST["search"];}



//Search history
if($search!="")
{
	if(!isset($_SESSION["search_query"]) or $_SESSION["search_query"]!=result($search))
	{
		$sql="insert into search_history (zapros,data) values ('".result($search)."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).")";
		$db->execute($sql);
		$_SESSION["search_query"]=result($search);
	}
}

$items=k_str;
if(isset($_REQUEST["items"]))
{
	$items=(int)$_REQUEST["items"];
}


//Количество новостей на странице
$kolvo=$items;


//Количество страниц на странице
$kolvo2=k_str2;


$scripts_variables=array("c","portfolio","user","lightbox","sphoto","svideo","saudio","svector","acategory","kw_list","author","item_id","swatermark","color","orientation","holder","frames","rendering","ratio","format","format2","source","duration_video","duration_audio","editorial","creative","id_parent","items","search","str","sort","vd","category","acategory","adult","flow","autopaging");

//The function builds all current variables list
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
	$db = new TMySQLConnection;
	$dq = new TMySQLQuery;
	$db->connect();
	$dq->connection = $db;
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







//Sql conditions
$com="";
$com2="";


//File types
$mass_types=array();
if($site_photo){$mass_types["photo"]=1;}
if($site_video){$mass_types["video"]=1;}
if($site_audio){$mass_types["audio"]=1;}
if($site_vector){$mass_types["vector"]=1;}


if(!isset($_REQUEST["sphoto"]))
{
	$mass_types["photo"]=0;
}

if(!isset($_REQUEST["svideo"]))
{
	$mass_types["video"]=0;
}


if(!isset($_REQUEST["saudio"]))
{
	$mass_types["audio"]=0;
}


if(!isset($_REQUEST["svector"]))
{
	$mass_types["vector"]=0;
}

$sformat=0;
foreach ($mass_types as $key => $value)
{
	$sformat+=$value;
}
if($sformat==0)
{
	foreach ($mass_types as $key => $value)
	{
		$mass_types[$key] = 1;
	}
}
//End. File types


//All Free Featured
$c="all";
if(isset($_REQUEST["c"])){$c=result($_REQUEST["c"]);}



//Sorting
if($vd=="popular"){$com=" order by aviewed desc";}
if($vd=="title"){$com=" order by atitle";}
if($vd=="slideshow"){$com=" order by atitle";}
if($vd=="date"){$com=" order by adata desc";}
if($vd=="new"){$com=" order by adata desc";}
if($vd=="rated"){$com=" order by arating desc";}
if($vd=="random"){$com=" order by rand()";}
if($vd=="downloaded"){$com=" order by adownloaded desc";}


//Flow
if($global_settings["flow_default"])
{
	$flow=1;
}
else
{
	$flow=0;
}


if($global_settings["flow"])
{
	if(isset($_COOKIE["flow_setting"]))
	{
		$flow=(int)$_COOKIE["flow_setting"];
	}

	if(isset($_REQUEST["flow"]))
	{
		$flow=(int)$_REQUEST["flow"];
	}
}
setcookie("flow_setting",$flow,time()+60*60*24*30,"/",str_replace("http://","",surl));

$flow_vars=build_variables("str","",true,"",true);


//Auto paging 
if($global_settings["auto_paging_default"])
{
	$autopaging=1;
}
else
{
	$autopaging=0;
}


if($global_settings["auto_paging"])
{
	if(isset($_COOKIE["autopaging_setting"]))
	{
		$autopaging=(int)$_COOKIE["autopaging_setting"];
	}
	
	if(isset($_REQUEST["autopaging"]))
	{
		$autopaging=(int)$_REQUEST["autopaging"];
	}
}
setcookie("autopaging_setting",$autopaging,time()+60*60*24*30,"/",str_replace("http://","",surl));




//Subcategories content
global $itg;
if($id_parent!=5 and !isset($_REQUEST["acategory"]))
{
	//Search all subcategories from the category
	$itg="";
 
		$nlimit=0;
		buildmenu8((int)$id_parent);
	 
 

	$com2="((a.id_parent=".(int)$id_parent." or b.category2=".(int)$id_parent." or b.category3=".(int)$id_parent.") ".$itg.")";
}






//Searching
$sch=array();
if(isset($search) and $search!="")
{
	$sch=explode(" ",trim(result($search)));
}


foreach ($_REQUEST as $key => $value) 
{
	$tt=explode("_",$key);
	if($tt[0]=="s" and isset($tt[1]))
	{
		$sch[count($sch)]=result($tt[1]);
	}
}

//Keywords massive
$kw_mass=array();
if(isset($_REQUEST["kw_list"]) and $_REQUEST["kw_list"]!="")
{
	$kw_mass=explode("|",result($_REQUEST["kw_list"]));
	for($i=0;$i<count($kw_mass);$i++)
	{
			$sch[]=$kw_mass[$i];
	}
}



if(count($sch)>0)
{
	if($com2!="")
	{
		$com2.=" and ";
	}
	
	$com2.="(";
	$search="";
	for($i=0;$i<count($sch);$i++)
	{
		
		
		if($i!=0){$com2.=" and ";}
			
		//$com2.=" (b.title like '%".$sch[$i]."%' or b.description rlike '[[:<:]]".$sch[$i]."[[:>:]]' or b.keywords rlike '[[:<:]]".$sch[$i]."[[:>:]]') ";
		
		//Cirillic
		//$com2.=" (UCASE(b.title) like UCASE('%".$sch[$i]."%') or UCASE(b.description) like UCASE('%".$sch[$i]."%') or UCASE(b.keywords) like UCASE('%".$sch[$i]."%')) ";
		
		//Old
		$com2.=" (b.title like '%".$sch[$i]."%' or b.description like '%".$sch[$i]."%' or b.keywords like '%".$sch[$i]."%') ";
			
		if($i!=0){$search.=" ";}
		$search.=$sch[$i];
	}
	$com2.=")";
}



//User portfolio
if(isset($_REQUEST["portfolio"]) and isset($_REQUEST["user"]))
{
	$sql="select login from users where  id_parent=".(int)$_REQUEST["user"];
	$dr->open($sql);
	if(!$dr->eof)
	{
		if($com2!="")
		{
			$com2.=" and ";
		}
		$com2.=" b.author='".result3($dr->row["login"])."' ";
	}
}

//Author
if(isset($_REQUEST["author"]) and $_REQUEST["author"]!='')
{
	if($com2!="")
	{
		$com2.=" and ";
	}
	$com2.=" b.author='".result3($_REQUEST["author"])."' ";
}


//User lightbox
if(isset($_REQUEST["lightbox"]))
{
	$com2_part="(";
	$sql="select item from lightboxes_files where id_parent=".(int)$_REQUEST["lightbox"];
	$dr->open($sql);
	while(!$dr->eof)
	{
		if($com2_part!="("){$com2_part.=" or ";}
		$com2_part.=" a.id=".$dr->row["item"]." ";
		$dr->movenext();
	}
	$com2_part.=")";
	if($com2!="")
	{
		$com2.=" and ";
	}
	$com2.=$com2_part;
}




//Free or featured
if($c=="featured")
{
	if($com2!=""){$com2.=" and ";}
	$com2.="b.featured=1";
}
elseif($c=="free")
{
	if($com2!=""){$com2.=" and ";}
	$com2.="b.free=1";
}
else
{
}


if($com2==""){$com2=" b.data>0 ";}


//Category
$category="";
if(isset($_REQUEST["acategory"]) and $_REQUEST["acategory"]!="" and $_REQUEST["acategory"]!=5)
{
	//Search all subcategories from the category
	$itg="";
	
	$smart_buildmenu8_id="buildmenu|8|".(int)$_REQUEST["acategory"];
	if (!$smarty->is_cached('buildmenu8.tpl',$smart_buildmenu8_id))
	{
		$nlimit=0;
		buildmenu8((int)$_REQUEST["acategory"]);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu8', $itg);
	$itg=$smarty->fetch('buildmenu8.tpl',$smart_buildmenu8_id);

	$category=" and ((a.id_parent=".(int)$_REQUEST["acategory"]." or b.category2=".(int)$_REQUEST["acategory"]." or b.category3=".(int)$_REQUEST["acategory"].") ".$itg.")";
}



//item id
$item_id="";
if(isset($_REQUEST["item_id"]) and $_REQUEST["item_id"]!="")
{
	$item_id=" and b.id_parent=".(int)$_REQUEST["item_id"];
	$com2="b.data>0";
}

//item id
$adult_sql="";
if(isset($_REQUEST["adult"]))
{
	$adult_sql=" and b.adult<>1";
}




//Watermark
$wtr="";
if(isset($_POST["swatermark"]))
{
	$wtr="and b.watermark=".(int)$_POST["swatermark"];
}


//Color
$color="";
if(isset($_REQUEST["color"]) and $_REQUEST["color"]!="")
{
	$color=" and b.color='".result3($_REQUEST["color"])."'";
}




//Orientation
$orientation="";
if(isset($_REQUEST["orientation"]) and ((int)$_REQUEST["orientation"]==0 or (int)$_REQUEST["orientation"]==1))
{
	$orientation=" and b.orientation=".(int)$_REQUEST["orientation"];
}



//Copyright holder
$holder="";
if(isset($_REQUEST["holder"]) and $_REQUEST["holder"]!="")
{
	$holder=" and b.holder='".result3($_REQUEST["holder"])."'";
}



//Frames
$frames="";
if(isset($_REQUEST["frames"]) and $_REQUEST["frames"]!="")
{
	$frames=" and b.frames='".result3($_REQUEST["frames"])."'";
}




//Rendering
$rendering="";
if(isset($_REQUEST["rendering"]) and $_REQUEST["rendering"]!="")
{
	$rendering=" and b.rendering='".result3($_REQUEST["rendering"])."'";
}



//Ratio
$ratio="";
if(isset($_REQUEST["ratio"]) and $_REQUEST["ratio"]!="")
{
	$ratio=" and b.ratio='".result3($_REQUEST["ratio"])."'";
}



//Format video
$format="";
if(isset($_REQUEST["format"]) and $_REQUEST["format"]!="")
{
	$format=" and b.format='".result3($_REQUEST["format"])."'";
}

//Format audio
$format2="";
if(isset($_REQUEST["format2"]) and $_REQUEST["format2"]!="")
{
	$format2=" and b.format='".result3($_REQUEST["format2"])."'";
}



//Source
$source="";
if(isset($_REQUEST["source"]) and $_REQUEST["source"]!="")
{
	$source=" and b.source='".result3($_REQUEST["source"])."'";
}


//Duration video
$duration_video="";
$duration_video1=0;
$duration_video2=1800;
if(isset($_REQUEST["duration_video"]) and $_REQUEST["duration_video"]!="")
{
	$duration_mass=explode(" - ",result($_REQUEST["duration_video"]));
	if(isset($duration_mass[0]) and isset($duration_mass[1]))
	{
		$duration_video1=(int)$duration_mass[0];
		$duration_video2=(int)$duration_mass[1];
		$duration_video=" and b.duration>".((int)$duration_mass[0]-1)." and b.duration<".((int)$duration_mass[1]+1);
	}
}


//Duration audio
$duration_audio="";
$duration_audio1=0;
$duration_audio2=1800;
if(isset($_REQUEST["duration_audio"]) and $_REQUEST["duration_audio"]!="")
{
	$duration_mass=explode(" - ",result($_REQUEST["duration_audio"]));
	if(isset($duration_mass[0]) and isset($duration_mass[1]))
	{
		$duration_audio1=(int)$duration_mass[0];
		$duration_audio2=(int)$duration_mass[1];
		$duration_audio=" and b.duration>".((int)$duration_mass[0]-1)." and b.duration<".((int)$duration_mass[1]+1);
	}
}


//Editorial and Creative
$editorial="checked";
$creative="checked";
$editorial_sql="";
if(isset($_REQUEST["editorial"]) and !isset($_REQUEST["creative"]))
{
	$editorial="checked";
	$creative="";
	$editorial_sql=" and b.editorial=1 ";
}

if(isset($_REQUEST["creative"]) and !isset($_REQUEST["editorial"]))
{
	$creative="checked";
	$editorial="";
	$editorial_sql=" and b.editorial=0 ";
}




//Limit
$lm="";


$n=0;

$sql_mass=array();

$sql_password_protected=get_password_protected();

$sql_mass["photo"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.description,b.folder,b.viewed as aviewed,b.keywords,b.rating as arating,b.downloaded as adownloaded,b.free,b.author,b.server1,b.category2,b.category3,b.url from structure a,photos b where b.published=1 and a.id=b.id_parent ".$wtr.$color.$orientation.$category.$item_id.$editorial_sql.$adult_sql." and ".$com2.$sql_password_protected;


$sql_mass["video"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.description,b.folder,b.viewed as aviewed,b.keywords,b.rating as arating,b.downloaded as adownloaded,b.free,b.author,b.server1,b.category2,b.category3,b.url from structure a,videos b where b.published=1 and a.id=b.id_parent ".$wtr.$category.$item_id.$holder.$frames.$rendering.$ratio.$format.$duration_video.$adult_sql." and ".$com2.$sql_password_protected;

$sql_mass["audio"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.description,b.folder,b.viewed as aviewed,b.keywords,b.rating as arating,b.downloaded as adownloaded,b.free,b.author,b.server1,b.category2,b.category3,b.url from structure a,audio b where b.published=1 and a.id=b.id_parent ".$wtr.$category.$item_id.$holder.$format2.$source.$duration_audio.$adult_sql." and ".$com2.$sql_password_protected;

$sql_mass["vector"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle,b.data as adata,b.published,b.description,b.folder,b.viewed as aviewed,b.keywords,b.rating as arating,b.downloaded as adownloaded,b.free,b.author,b.server1,b.category2,b.category3,b.url from structure a,vector b where b.published=1 and a.id=b.id_parent ".$wtr.$category.$item_id.$adult_sql." and ".$com2.$sql_password_protected;






$xx=0;
$sql="";
foreach ($mass_types as $key => $value)
{
	if($value==1)
	{
		if($xx!=0){$sql.=" union ";}
		$sql.="(".$sql_mass[$key].")";
		$xx++;
	}
}

//limit
$lm=" limit ".($kolvo*($str-1)).",".$kolvo;
$sql2=$sql." ".$com;
//echo($sql2);
//Cache id
$sql_cache_id=build_listing_id();


//Paging smarty cache
$record_count=0;
$paging_text="";
$paging_cache_id="p|".$sql_cache_id."|".$lang_symbol[$lng];
if(!$smarty->is_cached('paging.tpl',$paging_cache_id) or $site_cache_catalog<0 or isset($_REQUEST["lightbox"]))
{
	$rs->open($sql2);
	$record_count=$rs->rc;
	$paging_text=paging2($record_count,$str,$kolvo,$kolvo2,site_root."/index.php",build_variables("str","",false));
}
if($site_cache_catalog>=0)
{
	if($site_cache_catalog>0)
	{
		$smarty->cache_lifetime = $site_cache_catalog*3600;
	}
	$smarty->assign('paging',$paging_text);
	$smarty->assign('record_count',$record_count);
	if(!isset($_REQUEST["lightbox"]))
	{
		$paging_content=$smarty->fetch('paging.tpl',$paging_cache_id);
		$paging_mass=explode("|",$paging_content);
		$record_count=(int)$paging_mass[0];
		$paging_text=$paging_mass[1];
	}
}
//End. Paging smarty cache





//Category menu
$categorymenu="<ul>";
$vars_category=build_variables("acategory","id_parent");
//$sql="select id_parent,title from category order by title";
$sql3="select a.id,a.id_parent,b.id_parent,b.title from structure a,category b where a.id=b.id_parent and a.id_parent=5 order by b.priority";
$ds->open($sql3);
while(!$ds->eof)
{
	$categorymenu.="<li><a href='".$vars_category."&id_parent=".$ds->row["id_parent"]."'>".$ds->row["title"]."</a></li>";
	$ds->movenext();
}
$categorymenu.="</ul>";
//End. Category menu




//Sort menu
$vars_sort=build_variables("vd","");
$sortmenu="<select onChange='location.href=this.value' style='width:160px' class='ibox2'>";
$mass_sort["downloaded"]=word_lang("most downloaded");
$mass_sort["popular"]=word_lang("most popular");
$mass_sort["date"]=word_lang("date");
$mass_sort["title"]=word_lang("title");
$mass_sort["rated"]=word_lang("top rated");
$mass_sort["random"]=word_lang("random");
foreach ($mass_sort as $key => $value) 
{
	$sel="";
	if($key==$vd)
	{
		$sel="selected";
	}
	$sortmenu.="<option value='".$vars_sort."&vd=".$key."' ".$sel.">".$value."</option>";
}
$sortmenu.="</select>";
//End. Sort menu




//Content menu
$cmenu=array("all","featured","free");
$vars_contentmenu=build_variables("c","");
$contentmenu="<select onChange='location.href=this.value' style='width:110px' class='ibox2'>";
for($i=0;$i<count($cmenu);$i++)
{
	$sel="";
	if($c==$cmenu[$i]){$sel=" selected ";}

	$contentmenu.="<option value='".$vars_contentmenu."&c=".$cmenu[$i]."' ".$sel.">".word_lang($cmenu[$i])."</option>";
}
$contentmenu.="</select>";
//End. Content menu




//Items menu
$citems=array(10,20,30,50,100);
$vars_itemsmenu=build_variables("items","str");
$itemsmenu="<select onChange='location.href=this.value' style='width:60px' class='ibox2'>";
for($i=0;$i<count($citems);$i++)
{
	$sel="";
	if($items==$citems[$i]){$sel=" selected ";}

	$itemsmenu.="<option value='".$vars_itemsmenu."&items=".$citems[$i]."&str=1' ".$sel.">".$citems[$i]."</option>";
}
$itemsmenu.="</select>";
//End. Items menu


?>