<?
if(!defined("site_root")){exit();}
$box_tag_clouds="";




if (!$smarty->is_cached('tags.tpl',"tags"))
{


	$tg=array();

	$sql="select keywords from photos where published=1 order by rand() limit 6";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$tgg=explode(",",str_replace(";",",",$rs->row["keywords"]));
		for($i=0;$i<count($tgg);$i++)
		{
			$tgg[$i]=trim($tgg[$i]);
			if($tgg[$i]!="")
			{
				$ftg=true;
				for($j=0;$j<count($tg);$j++)
				{
					if($tg[$j]==$tgg[$i]){$ftg=false;}
				}
				if($ftg==true){$tg[count($tg)]=$tgg[$i];}
			}
		}
		$rs->movenext();
	}


	$sql="select keywords from videos where published=1 order by rand() limit 6";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$tgg=explode(",",str_replace(";",",",$rs->row["keywords"]));
		for($i=0;$i<count($tgg);$i++)
		{
			$tgg[$i]=trim($tgg[$i]);
			if($tgg[$i]!="")
			{
				$ftg=true;
				for($j=0;$j<count($tg);$j++)
				{
					if($tg[$j]==$tgg[$i]){$ftg=false;}
				}
				if($ftg==true){$tg[count($tg)]=$tgg[$i];}
			}
		}
		$rs->movenext();
	}


	$sql="select keywords from audio where published=1 order by rand() limit 6";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$tgg=explode(",",str_replace(";",",",$rs->row["keywords"]));
		for($i=0;$i<count($tgg);$i++)
		{
			$tgg[$i]=trim($tgg[$i]);
			if($tgg[$i]!="")
			{
				$ftg=true;
				for($j=0;$j<count($tg);$j++)
				{
					if($tg[$j]==$tgg[$i]){$ftg=false;}
				}
				if($ftg==true){$tg[count($tg)]=$tgg[$i];}
			}
		}
	$rs->movenext();
	}


	$sql="select keywords from vector where published=1 order by rand() limit 6";
	$rs->open($sql);
	while(!$rs->eof)
	{
		$tgg=explode(",",str_replace(";",",",$rs->row["keywords"]));
		for($i=0;$i<count($tgg);$i++)
		{
			$tgg[$i]=trim($tgg[$i]);
			if($tgg[$i]!="")
			{
				$ftg=true;
				for($j=0;$j<count($tg);$j++)
				{
					if($tg[$j]==$tgg[$i]){$ftg=false;}
				}
				if($ftg==true){$tg[count($tg)]=$tgg[$i];}
			}
		}
		$rs->movenext();
	}




	for($j=0;$j<count($tg);$j++)
	{
		$box_tag_clouds.="<a href='".site_root."/?search=".$tg[$j]."' class='tg".rand(1,4)."'>".$tg[$j]."</a> ";
	}

}
$smarty->cache_lifetime = 3600;
$smarty->assign("tags",$box_tag_clouds);
$box_tag_clouds=$smarty->fetch('tags.tpl',"tags");




$file_template=str_replace("{BOX_TAG_CLOUDS}",$box_tag_clouds,$file_template);
?>