<?
if(!defined("site_root")){exit();}

if(isset($component_id))
{
	$smarty_component_id="component|".$component_id."|".$lng;
	if(!$smarty->is_cached('component.tpl',$smarty_component_id))
	{
		$stitle=array();
		$sdescription=array();
		$sauthor=array();
		$slink=array();
		$simage=array();
		$sid=array();

		$sql="select * from components where id=".(int)$component_id;
		$rs->open($sql);
		if(!$rs->eof)
		{

		if(preg_match("/photo/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url from structure a, photos b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/video/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url from structure a, videos b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/audio/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url from structure a, audio b where a.id=b.id_parent and b.published=1";
		}

		if(preg_match("/vector/",$rs->row["content"]))
		{
			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.description,b.folder,b.author,b.server1,b.url from structure a, vector b where a.id=b.id_parent and b.published=1";
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


		$sql.=" limit ".$rs->row["quantity"];

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


					$slink[]=surl.item_url($ds->row["id"],$ds->row["url"]);



						if(preg_match("/photo/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=2;}
							$simage[]=show_preview($ds->row["id"],"photo",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
						}
						elseif(preg_match("/vector/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=2;}
							$simage[]=show_preview($ds->row["id"],"vector",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
						}
						elseif(preg_match("/video/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=3;}
							$simage[]=show_preview($ds->row["id"],"video",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
						}
						elseif(preg_match("/audio/",$rs->row["content"]))
						{
							$ttt=1;
							if(preg_match("/2/",$rs->row["content"])){$ttt=3;}
							$simage[]=show_preview($ds->row["id"],"audio",$ttt,1,$ds->row["server1"],$ds->row["folder"]);
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




		$n=0;
		for($i=0;$i<$rs->row["arows"];$i++)
		{

			for($j=0;$j<$rs->row["acells"];$j++)
			{
				if($n<count($stitle) and $n<count($slink) and $n<count($simage))
				{
					$boxcontent=$box;
					$boxcontent=str_replace("{TITLE}",$stitle[$n],$boxcontent);
					$boxcontent=str_replace("{DESCRIPTION}",$sdescription[$n],$boxcontent);

					$str_width="";
					$str_height="";
					
					if($rs->row["content"]=="photo1" or $rs->row["content"]=="photo2")
					{
						
						$remote_width=0;
						$remote_height=0;
						$flag_storage=false;
						$photo_width=0;
						$photo_height=0;
						
						if($rs->row["content"]=="photo1")
						{
							$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$sid[$n]." and filename1 like '%thumb1%'";
							$item_img_preview=show_preview($sid[$n],"photo",1,1,"","",false);
						}
						else
						{
							$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$sid[$n]." and filename1 like '%thumb2%'";
							$item_img_preview=show_preview($sid[$n],"photo",2,1,"","",false);
						}
						
						$ds->open($sql);
						if(!$ds->eof)
						{
							$remote_width=$ds->row["width"];
							$remote_height=$ds->row["height"];
							$flag_storage=true;
						}
						
						if(!$flag_storage and file_exists($_SERVER["DOCUMENT_ROOT"].$item_img_preview))
						{
							$size = getimagesize($_SERVER["DOCUMENT_ROOT"].$item_img_preview);
							$photo_width=$size[0];
							$photo_height=$size[1];
						}
			
						if($remote_width!=0 and $remote_height!=0)
						{
							$photo_width=$remote_width;
							$photo_height=$remote_height;
						}
						
						$width_limit=200;
						if($photo_width>$width_limit or $photo_height>$width_limit)
						{
							$photo_height=round($photo_height*$width_limit/$photo_width);
							$photo_width=$width_limit;
						}
						
						$str_width=" width='".$photo_width."' ";
						$str_height=" height='".$photo_height."' ";
					}
					$boxcontent=str_replace("{WIDTH}",$str_width,$boxcontent);
					$boxcontent=str_replace("{HEIGHT}",$str_height,$boxcontent);
					$boxcontent=str_replace("{URL}",$slink[$n],$boxcontent);
					$boxcontent=str_replace("{IMAGE}",$simage[$n],$boxcontent);


				$component_body.=$boxcontent;
				}
				$n++;
			}

		}


		}
	}
$smarty->cache_lifetime = 3600*$site_cache_components;
$smarty->assign("component", $component_body);
$component_body=$smarty->fetch('component.tpl',$smarty_component_id);
}
?>