<?
if(!defined("site_root")){exit();}




//Build categorie table - /admin/categories/
function buildmenu3($t_id,$otstup)
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	global $itg;
	global $nlimit;
	global $_COOKIE;

	$sql="select a.id,a.id_parent,b.id_parent,b.title,b.priority from structure a,category b where a.id=b.id_parent and a.id_parent=".$t_id."  order by b.priority,b.title";
	$dp->open($sql);
	while(!$dp->eof)
	{
	if($nlimit<1000)
	{
		//padding-left
		$otp="";
		for($i=0;$i<$otstup;$i++)
		{
			$otp.="&nbsp;&nbsp;";
		}

		//If included subcategories exist
		$zp=false;
		$sql="select a.id,a.id_parent,b.id_parent from structure a,category b where a.id=b.id_parent and a.id_parent=".$dp->row["id"];
		$dt->open($sql);
		if(!$dt->eof)
		{
			$zp=true;
		}

		//if parent closed
		$vis="";
		$sql="select id_parent from structure where id=".$dp->row["id"];
		$dt->open($sql);
		if(!$dt->eof)
		{
			if(isset($_COOKIE["sub_".$dt->row["id_parent"]]) and (int)$_COOKIE["sub_".$dt->row["id_parent"]]==0)
			{
				$vis="style='display:none'";
			}
		}

		//Plus-minus icon
		$img_marker="minus";

		if(isset($_COOKIE["sub_".$dp->row["id"]]) and (int)$_COOKIE["sub_".$dp->row["id"]]==0)
		{
			$img_marker="plus";
		}

		if($zp)
		{
			$img="<a href='javascript:subopen(".$dp->row["id"].");'><img id='plus".$dp->row["id"]."' src='../images/design/".$img_marker.".gif' width='13' height='13' border='0'></a>&nbsp;";
		}
		else
		{
			$img="<img src='../images/design/e.gif' width='13' height='13' border='0'>&nbsp;";
		}


		$itg.="<tr id='row".$dp->row["id"]."' ".$vis.">
		<td><input type='checkbox' id='sel".$dp->row["id"]."' name='sel".$dp->row["id"]."'></td>
		<td><input type='text' name='priority".$dp->row["id"]."' value='".$dp->row["priority"]."' class='ibox' style='width:40px'></td>
		<td nowrap width='80%'>".$otp.$img."<a href='content.php?id=".$dp->row["id"]."'>".$dp->row["title"]."</a></td>
		<td><div class='link_edit'><a href='content.php?id=".$dp->row["id"]."'>".word_lang("edit")."</a></div></td>
		<td><div class='link_delete'><a href='delete.php?id=".$dp->row["id"]."' onClick=\"return confirm('".word_lang("delete")."?');\">".word_lang("delete")."</a></div></td>
		</tr>";


		buildmenu3($dp->row["id"],$otstup+2);
	}
	$nlimit++;
	$dp->movenext();
	}
}




//Select fields for date
function admin_date($data,$field)
{
$res="";
global $m_month;



$res.="<table border='0' cellpadding='0' cellspacing='0'>
<tr>
<td><select name='".$field."_day' style='width:50px' class='ibox'>";


for($j=1;$j<32;$j++)
{
if($j<10){$ji="0".$j;}
else{$ji=$j;}

$sel="";
if(date("d",$data)==$j){$sel="selected";}

$res.="<option value='".$j."' ".$sel.">".$ji."</option>";

}


$res.="</select>&nbsp;</td>
<td><select name='".$field."_month' style='width:100px' class='ibox'>";

for($j=0;$j<12;$j++)
{
$sel="";
if(date("m",$data)==$j+1){$sel="selected";}

$res.="<option value='".($j+1)."' ".$sel.">".word_lang(strtolower($m_month[$j]))."</option>";

}


$res.="</select>&nbsp;</td>
<td><select name='".$field."_year' style='width:63px' class='ibox'>";

for($j=date("Y")-5;$j<date("Y")+15;$j++)
{
$sel="";
if(date("Y",$data)==$j){$sel="selected";}

$res.="<option value='".$j."' ".$sel.">".$j."</option>";

}


$res.="</select>&nbsp;&nbsp;</td>


<td><select name='".$field."_hour' style='width:50px' class='ibox'>";

for($j=0;$j<24;$j++)
{
if($j<10){$ji="0".$j;}
else{$ji=$j;}

$sel="";
if(date("G",$data)==$j){$sel="selected";}

$res.="<option value='".$j."' ".$sel.">".$ji."</option>";

}


$res.="</select>&nbsp;:&nbsp;</td>

<td><select name='".$field."_minute' style='width:50px' class='ibox'>";

for($j=0;$j<60;$j++)
{
if($j<10){$ji="0".$j;}
else{$ji=$j;}

$sel="";
if(date("i",$data)==$j){$sel="selected";}

$res.="<option value='".$j."' ".$sel.">".$ji."</option>";

}


$res.="</select>&nbsp;:&nbsp;</td>

<td><select name='".$field."_second' style='width:50px' class='ibox'>";

for($j=0;$j<60;$j++)
{
if($j<10){$ji="0".$j;}
else{$ji=$j;}

$sel="";
if(date("s",$data)==$j){$sel="selected";}

$res.="<option value='".$j."' ".$sel.">".$ji."</option>";

}


$res.="</select></td>
</tr>
</table>";



return $res;
}


//The function builds a duration form
function duration_form($data,$field)
{
	$res="";
	
	$res.="<table border='0' cellpadding='0' cellspacing='0'><tr>";
	$res.="<td nowrap><select name='".$field."_hour' style='width:50px' class='ibox'>";
	
	$form_hours=floor($data/3600);
	$form_minutes=floor(($data-$form_hours*3600)/60);
	$form_seconds=$data-$form_hours*3600-$form_minutes*60;
	
	for($j=0;$j<100;$j++)
	{
		if($j<10){$ji="0".$j;}
		else{$ji=$j;}
		$sel="";
		if($form_hours==$j){$sel="selected";}
		$res.="<option value='".$j."' ".$sel.">".$ji."</option>";
	}

	$res.="</select>&nbsp;:&nbsp;</td><td nowrap><select name='".$field."_minute' style='width:50px' class='ibox'>";

	for($j=0;$j<60;$j++)
	{
		if($j<10){$ji="0".$j;}
		else{$ji=$j;}
		$sel="";
		if($form_minutes==$j){$sel="selected";}
		$res.="<option value='".$j."' ".$sel.">".$ji."</option>";
	}

	$res.="</select>&nbsp;:&nbsp;</td><td><select name='".$field."_second' style='width:50px' class='ibox'>";

	for($j=0;$j<60;$j++)
	{
		if($j<10){$ji="0".$j;}
		else{$ji=$j;}
		$sel="";
		if($form_seconds==$j){$sel="selected";}
		$res.="<option value='".$j."' ".$sel.">".$ji."</option>";
	}

	$res.="</select></td></tr></table>";
	return $res;
}
//End. The function builds a duration form



//Build photo upload form
function photo_upload_form()
{
global $ds;
global $rs;
global $file_form;
global $global_settings;
global $_SESSION;
$res="";
		$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table'>";
		if($file_form)
		{
			$res.="<tr class='snd'>
			<td colspan='4'><input name='photo' type='file' style='width:400px' class='ibox'></td>
			</tr><tr>
			<td colspan='4'>".word_lang("use iptc info").": <input name='photo_iptc' type='checkbox' ></td>
			</tr>";
		}
		if(!$global_settings["printsonly"])
		{
			$res.="<tr>
			<th>".word_lang("enabled").":</th>
			<th><b>".word_lang("title").":</b></th>
			<th><b>Max ".word_lang("width")."/".word_lang("height").":</b></th>
			<th><b>".word_lang("price").":</b></th>
			</tr>";


			$sql="select id_parent,name from licenses order by priority";
			$ds->open($sql);
			while(!$ds->eof)
			{
				$res.="<tr class='snd'><td colspan='4'><b>".word_lang("license").": </b>".$ds->row["name"]."</td></tr>";

				$sql="select id_parent,size,title,price from sizes where license=".$ds->row["id_parent"]." order by priority";
				$rs->open($sql);
				while(!$rs->eof)
				{
					$res.="<tr>
					<td><input name='chk".$rs->row["id_parent"]."' type='checkbox' checked></td>
					<td>".$rs->row["title"]."</td>
					<td>";

					if($rs->row["size"]!=0)
					{
						$res.=$rs->row["size"]."px";
					}
					else
					{
						$res.=word_lang("Original size");
					}

					$readonly="readonly";
					if(isset($_SESSION["entry_admin"]) or $global_settings["seller_prices"])
					{
						$readonly="";
					}
		
					$res.="</td>
					<td><input name='price".$rs->row["id_parent"]."' value='".float_opt($rs->row["price"],2)."' type='text' style='width:60px' ".$readonly." class='ibox'></td>
					</tr>";

					$rs->movenext();
				}
				$ds->movenext();
			}
		}


		$res.="</table>";
return $res;
}
//End photo upload form



//Build video upload form
function video_upload_form($lvideo,$lpreviewvideo)
{
global $ds;
global $dr;
global $site_ffmpeg;
global $_SESSION;
global $global_settings;
$res="";

$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table' style='width:700px'>
<tr>
<th></td>
<th><b>".word_lang("title").":</b></th>
<th><b>".word_lang("price").":</b></th>
<th><b>".word_lang("file").":</b></th>
</tr>";


$sql="select id_parent,name from licenses order by priority";
$dr->open($sql);
while(!$dr->eof)
{
	$res.="<tr class='snd'><td colspan='4'><b>".word_lang("license").": </b>".$dr->row["name"]."</td></tr>";

	$sql="select * from video_types where license=".$dr->row["id_parent"]." order by priority";
	$ds->open($sql);
	while(!$ds->eof)
	{
		$res.="<tr>
		<td><input name='video_chk".$ds->row["id_parent"]."' type='checkbox' checked></td>
		<td nowrap>".$ds->row["title"];

		if($ds->row["shipped"]!=1)
		{
			$res.="(";
			$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
			for($i=0;$i<count($uphoto);$i++)
			{
				if($i!=0){$res.=",";}
				$res.="*.".$uphoto[$i];
			}

			$res.=")";
		}

		$readonly="readonly";
		if(isset($_SESSION["entry_admin"]) or $global_settings["seller_prices"])
		{
			$readonly="";
		}

		$res.="</td>
		<td><input class='ibox' name='video_price".$ds->row["id_parent"]."' value='".float_opt($ds->row["price"],2)."' type='text' ".$readonly." style='width:70px'></td>
		<td>";

		if($ds->row["shipped"]!=1)
		{
			$res.="<input name='video_sale".$ds->row["id_parent"]."' type='file' style='width:200px' class='ibox'>";
		}
		else
		{
			$res.=word_lang("shipped");
		}

		$res.="</td>
		</tr>";

		$ds->movenext();
	}
$dr->movenext();
}

$res.="<tr class='snd'><td colspan='4'>(".word_lang("size")." < ".$lvideo."Mb.)</td></tr>";


if($site_ffmpeg==false)
{
	$res.="<tr><th colspan=4><b>".word_lang("preview")." ".word_lang("video").":</b></th></tr><tr><td colspan='4'><input class='ibox' name='preview' type='file' style='width:400px'><span class='smalltext'>(*.flv,*.wmv. ,*.mp4,*.mov. ".word_lang("size")." < ".$lpreviewvideo."Mb.)</span></td></tr>";
}
else
{
	$res.="<tr><th colspan=4><b>".word_lang("Generate video preview from").":</b></th></tr><tr><td colspan='4'>
	<select name='generation' style='width:400px' class='ibox'>";

	$sql="select id_parent,title from video_types order by priority";
	$ds->open($sql);
	while(!$ds->eof)
	{
		$res.="<option value='".$ds->row["id_parent"]."'>".$ds->row["title"]."</option>";

		$ds->movenext();
	}

	$res.="</select>
	</td></tr>";
}



if($site_ffmpeg==false)
{
	$res.="<tr><th colspan=4><b>".word_lang("preview")." ".word_lang("photo").":</th></tr><tr><td colspan='4'><input class='ibox' name='preview2' type='file' style='width:400px'><br><span class='smalltext'>(*.jpg,*.jpeg)</span></td></tr>";
}


$res.="</table>";

return $res;
}
//End video upload form







//Build audio upload form
function audio_upload_form($laudio,$lpreviewaudio)
{
global $ds;
global $dr;
global $_SESSION;
global $global_settings;

$res="";

$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table' style='width:700px'>
<tr>
<th></th>
<th><b>".word_lang("title").":</b></th>
<th><b>".word_lang("price").":</b></th>
<th><b>".word_lang("file").":</b></th>
</tr>";




$sql="select id_parent,name from licenses order by priority";
$dr->open($sql);
while(!$dr->eof)
{

$res.="<tr class='snd'><td colspan='4'><b>".word_lang("license").": </b>".$dr->row["name"]."</td></tr>";


$sql="select * from audio_types  where license=".$dr->row["id_parent"]." order by priority";
$ds->open($sql);
while(!$ds->eof)
{


$res.="<tr>
<td><input name='audio_chk".$ds->row["id_parent"]."' type='checkbox' checked></td>
<td nowrap>".$ds->row["title"];







if($ds->row["shipped"]!=1)

{

$res.="(";


$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
for($i=0;$i<count($uphoto);$i++)
{
if($i!=0){$res.=",";}
$res.="*.".$uphoto[$i];
}

$res.=")";


}


		$readonly="readonly";
		if(isset($_SESSION["entry_admin"]) or $global_settings["seller_prices"])
		{
			$readonly="";
		}

$res.="</td>
<td><input name='audio_price".$ds->row["id_parent"]."' value='".float_opt($ds->row["price"],2)."' type='text' ".$readonly." class='ibox' style='width:70px'></td>
<td>";



if($ds->row["shipped"]!=1)

{

$res.="<input name='audio_sale".$ds->row["id_parent"]."' type='file' style='width:200px' class='ibox'>";

}
else
{

$res.=word_lang("shipped");

}


$res.="</td>
</tr>";

$ds->movenext();
}
$dr->movenext();
}














$res.="<tr class='snd'><td colspan=4><span class='smalltext'>(".word_lang("size")." < ".$laudio."Mb.)</span></td></tr>";








$res.="<tr><th colspan=4><b>".word_lang("preview")." ".word_lang("audio").":</b></th></tr><tr><td colspan=4><input name='preview' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.mp3. ".word_lang("size")." < ".$lpreviewaudio."Mb.)</span></td></tr>";



$res.="<tr><th colspan=4><b>".word_lang("preview")." ".word_lang("photo").":</b></th></tr><tr><td colspan=4><input name='preview2' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.jpg)</span></td></tr>";

$res.="</table>";


return $res;
}
//End audio upload form 




//Build vector upload form
function vector_upload_form($lvector)
{
global $ds;
global $dr;
global $site_flash;
global $_SESSION;
global $global_settings;


$res="";

$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table' style='width:700px'>
<tr>
<th></th>
<th><b>".word_lang("title").":</b></th>
<th><b>".word_lang("price").":</b></th>
<th><b>".word_lang("file").":</b></th>
</tr>";


$sql="select id_parent,name from licenses order by priority";
$dr->open($sql);
while(!$dr->eof)
{

$res.="<tr class='snd'><td colspan='4'><b>".word_lang("license").": </b>".$dr->row["name"]."</td></tr>";

$sql="select * from vector_types  where license=".$dr->row["id_parent"]."  order by priority";
$ds->open($sql);
while(!$ds->eof)
{

$res.="<tr>
<td><input name='vector_chk".$ds->row["id_parent"]."' type='checkbox' checked></td>
<td nowrap>".$ds->row["title"];



if($ds->row["shipped"]!=1)
{

$res.="(";


$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
for($i=0;$i<count($uphoto);$i++)
{
if($i!=0){$res.=",";}
$res.="*.".$uphoto[$i];
}

$res.=")";
}

		$readonly="readonly";
		if(isset($_SESSION["entry_admin"]) or $global_settings["seller_prices"])
		{
			$readonly="";
		}

$res.="</td>
<td><input name='vector_price".$ds->row["id_parent"]."' value='".float_opt($ds->row["price"],2)."' type='text' ".$readonly." style='width:70px'  class='ibox'></td>
<td>";


if($ds->row["shipped"]!=1)
{
$res.="<input name='vector_sale".$ds->row["id_parent"]."' type='file' style='width:200px' class='ibox'>";
}
else
{
$res.=word_lang("shipped");
}

$res.="</td>
</tr>";

$ds->movenext();
}
$dr->movenext();
}






$res.="<tr><td colspan='4'><span class='smalltext'>(".word_lang("size")." < ".$lvector."Mb.)</span></td></tr>";


$res.="<tr><th colspan='4'><b>".word_lang("preview")." ".word_lang("photo").":</b></th></tr><tr><td colspan=4><input name='preview2' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.jpg or *.zip file of jpg photos)</span></td></tr>";

if($site_flash)
{
$res.="<tr><th colspan='4'><b>".word_lang("preview")." Flash:</b></th></tr><tr><td colspan=4><input name='preview3' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.swf)</span></td></tr>";
}

$res.="</table>";

return $res;
}
//End vector upload form 








//Build price update form
function price_update_form($id,$type)
{
global $ds;
global $dr;
global $db;
global $dd;
global $dn;
global $site_servers;
global $site_server_activ;
global $_SESSION;
global $site_ffmpeg;
global $lpreviewvideo;
global $lpreviewaudio;
global $site_flash;
global $global_settings;

if($type=="photo"){$table_name="sizes";}
if($type=="video"){$table_name="video_types";}
if($type=="audio"){$table_name="audio_types";}
if($type=="vector"){$table_name="vector_types";}

$res="";
$rurl="";

//Define server
$server1=$site_server_activ;
if($type=="photo")
{
	$sql="select server1 from photos where id_parent=".(int)$id;
	$dd->open($sql);
	if(!$dd->eof)
	{
		$server1=$dd->row["server1"];
	}
}
if($type=="video")
{
	$sql="select server1 from videos where id_parent=".(int)$id;
	$dd->open($sql);
	if(!$dd->eof)
	{
		$server1=$dd->row["server1"];
	}
}
if($type=="audio")
{
	$sql="select server1 from audio where id_parent=".(int)$id;
	$dd->open($sql);
	if(!$dd->eof)
	{
		$server1=$dd->row["server1"];
	}
}
if($type=="vector")
{
	$sql="select server1 from vector where id_parent=".(int)$id;
	$dd->open($sql);
	if(!$dd->eof)
	{
		$server1=$dd->row["server1"];
	}
}






$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table' style='width:750px'>";


if($type=="photo" and isset($_SESSION['entry_admin']))
{
	$res.="<tr class='snd'>
			<td colspan='4'><input name='photo' type='file' style='width:400px' class='ibox'></td>
			</tr><tr>
			<td colspan='4'>".word_lang("use iptc info").": <input name='photo_iptc' type='checkbox' ></td>
			</tr>";
}

if($type!="photo" or ($type=="photo" and !$global_settings["printsonly"]))
{

$res.="<tr>
<th></th>
<th><b>".word_lang("title").":</b></th>
<th><b>".word_lang("price").":</b></th>";

if($type!="photo")
{
	$res.="<th><b>".word_lang("file").":</b></th>";
	if(isset($_SESSION['entry_admin']))
	{
		$res.="<th><b>".word_lang("reupload").":</b></th>";
	}
}
$res.="</tr>";


	$sql="select id_parent,name from licenses order by priority";
	$dr->open($sql);
	while(!$dr->eof)
	{
		$res.="<tr class='snd'><td colspan='5'><b>".word_lang("license").": </b>".$dr->row["name"]."</td></tr>";

		$sql="select * from ".$table_name."  where license=".$dr->row["id_parent"]."  order by priority";
		$ds->open($sql);
		while(!$ds->eof)
		{
			$sql="select price,url,shipped from items where id_parent=".(int)$id." and price_id=".$ds->row["id_parent"];
			$dd->open($sql);
			if(!$dd->eof)
			{
				$res.="<tr>
				<td><input name='".$type."_chk".$ds->row["id_parent"]."' type='checkbox' checked></td>
				<td nowrap>".$ds->row["title"];
				
				$readonly="readonly";
				if(isset($_SESSION["entry_admin"]) or $global_settings["seller_prices"])
				{
					$readonly="";
				}

				$res.="</td>
				<td><input name='".$type."_price".$ds->row["id_parent"]."' value='".float_opt($dd->row["price"],2)."' type='text' style='width:70px' ".$readonly." class='ibox'></td>";
				
				if($type!="photo")
				{
					$res.="<td>";
				}

				if($dd->row["shipped"]==1)
				{
					$res.=word_lang("shipped");
				}
				else
				{
					$remote_filesize=0;
					$flag_storage=false;
					$remote_file="";
					
					$sql="select url,filename1,filename2,width,height,item_id,filesize from filestorage_files where id_parent=".(int)$id." and filename1='".$dd->row["url"]."'";
					$dn->open($sql);
					if(!$dn->eof)
					{
						$flag_storage=true;
						$remote_filesize=$dn->row["filesize"];
						$remote_file=$dn->row["url"]."/".$dn->row["filename2"];
					}
					
					
					
					
					if(!$flag_storage)
					{
						$url=site_root.$site_servers[$server1]."/".(int)$id."/".$dd->row["url"];
						if(file_exists($_SERVER["DOCUMENT_ROOT"].$url))
						{
							if($type!="photo")
							{
								$res.="<a href='".$url."'>".$dd->row["url"]."</a><br>".float_opt((filesize($_SERVER["DOCUMENT_ROOT"].$url)/1024),2)."Kb.";
							}
							else
							{
								if(isset($_SESSION["entry_admin"]))
								{
									$rurl="<div class='content_exif'><b>".word_lang("file").":</b> <a href='".$url."'>".$dd->row["url"]."</a><br>".get_exif($_SERVER["DOCUMENT_ROOT"].$url)."</div>";
								}
							}
						}
					}
					else
					{
						if($type!="photo")
						{
							$res.="<a href='".$remote_file."'>".$dd->row["url"]."</a><br>".float_opt(($remote_filesize/1024),2)."Kb.";
						}
						else
						{
							$rurl="<div style='margin-top:2px'><b>".word_lang("file").":</b> <a href='".$remote_file."'>".$dd->row["url"]."</a> [".float_opt(($remote_filesize/1024),2)."Kb.]</div>";
						}
					}
				}
				
				if($type!="photo")
				{
					$res.="</td>";
					if(isset($_SESSION['entry_admin']))
					{
						if($ds->row["shipped"]!=1)
						{
							$res.="<td><input name='".$type."_sale".$ds->row["id_parent"]."' type='file' style='width:200px' class='ibox'></td>";
						}
						else
						{
							$res.="<td></td>";
						}
					}
				}
				
				
				
				
				
				
				
				$res.="</tr>";
			}
			else
			{
				if(isset($_SESSION['entry_admin']))
				{
					$res.="<tr>
								<td><input name='".$type."_chk".$ds->row["id_parent"]."' type='checkbox'></td>
								<td nowrap>".$ds->row["title"]."</td><td><input name='".$type."_price".$ds->row["id_parent"]."' value='".float_opt($ds->row["price"],2)."' type='text' style='width:70px'  class='ibox'></td>";
					
					if($type!="photo")
					{
						if($ds->row["shipped"]!=1)
						{
							$res.="<td></td><td><input name='".$type."_sale".$ds->row["id_parent"]."' type='file' style='width:200px' class='ibox'></td>";
						}
						else
						{
							$res.="<td>".word_lang("shipped")."</td><td></td>";
						}
					}			
								
					$res.="</tr>";

				}
			}

		$ds->movenext();
		}
	$dr->movenext();
	}
	

if($type=="video" and isset($_SESSION['entry_admin']))
{
	if($site_ffmpeg==false)
	{
		$res.="<tr><th colspan=6><b>".word_lang("preview")." ".word_lang("video").":</b></th></tr><tr><td colspan='6'><input class='ibox' name='preview' type='file' style='width:400px'><span class='smalltext'>(*.flv,*.wmv. ,*.mp4,*.mov. ".word_lang("size")." < ".$lpreviewvideo."Mb.)</span></td></tr>";
	
		$res.="<tr><th colspan=6><b>".word_lang("preview")." ".word_lang("photo").":</th></tr><tr><td colspan='6'><input class='ibox' name='preview2' type='file' style='width:400px'><br><span class='smalltext'>(*.jpg,*.jpeg)</span></td></tr>";
	}
	else
	{
		$res.="<tr><th colspan=6><b>".word_lang("Generate video preview from").":</b></th></tr><tr><td colspan='6'>
		<select name='generation' style='width:400px' class='ibox'>";

		$sql="select id_parent,title from video_types order by priority";
		$ds->open($sql);
		while(!$ds->eof)
		{
			$res.="<option value='".$ds->row["id_parent"]."'>".$ds->row["title"]."</option>";

			$ds->movenext();
		}

		$res.="</select></td></tr>";
	}
}

if($type=="audio" and isset($_SESSION['entry_admin']))
{
	$res.="<tr><th colspan=6><b>".word_lang("preview")." ".word_lang("audio").":</b></th></tr><tr><td colspan=6><input name='preview' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.mp3. ".word_lang("size")." < ".$lpreviewaudio."Mb.)</span></td></tr>";

	$res.="<tr><th colspan=6><b>".word_lang("preview")." ".word_lang("photo").":</b></th></tr><tr><td colspan=6><input name='preview2' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.jpg)</span></td></tr>";
}

if($type=="vector" and isset($_SESSION['entry_admin']))
{
	$res.="<tr><th colspan='6'><b>".word_lang("preview")." ".word_lang("photo").":</b></th></tr><tr><td colspan=6><input name='preview2' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.jpg or *.zip file of jpg photos)</span></td></tr>";

	if($site_flash)
	{
		$res.="<tr><th colspan='6'><b>".word_lang("preview")." Flash:</b></th></tr><tr><td colspan=6><input name='preview3' type='file' style='width:400px' class='ibox'><br><span class='smalltext'>(*.swf)</span></td></tr>";
	}
}
}



$res.="</table>".$rurl;



return $res;
}
//End. Build price update form










//The function update prices
function price_update($id,$type)
{
global $ds;
global $dr;
global $db;
global $dd;
global $site_servers;
global $site_server_activ;

if($type=="photo"){$table_name="sizes";}
if($type=="video"){$table_name="video_types";}
if($type=="audio"){$table_name="audio_types";}
if($type=="vector"){$table_name="vector_types";}

	$sql="select id_parent,name from licenses order by priority";
	$dr->open($sql);
	while(!$dr->eof)
	{
		$sql="select * from ".$table_name."  where license=".$dr->row["id_parent"]."  order by priority";
		$ds->open($sql);
		while(!$ds->eof)
		{
			$sql="select price,url,shipped from items where id_parent=".(int)$id." and price_id=".$ds->row["id_parent"];
			$dd->open($sql);
			if(!$dd->eof)
			{
				if(isset($_POST[$type."_chk".$ds->row["id_parent"]]))
				{
					$sql="update items set price=".(float)$_POST[$type."_price".$ds->row["id_parent"]]." where id_parent=".(int)$id." and price_id=".$ds->row["id_parent"];
					$db->execute($sql);
				}
				else
				{
					$sql="delete from items where id_parent=".(int)$id." and price_id=".$ds->row["id_parent"];
					$db->execute($sql);
				
					if($dd->row["shipped"]!=1)
					{
						if($type!="photo")
						{
							$url=site_root.$site_servers[$site_server_activ]."/".(int)$id."/".$dd->row["url"];
							if(file_exists($_SERVER["DOCUMENT_ROOT"].$url))
							{
								@unlink($_SERVER["DOCUMENT_ROOT"].$url);
							}
						}
					}
				}
			}
			else
			{	
				if(isset($_SESSION['entry_admin']))
				{
					if($type=="photo")
					{
						$photo_file=get_photo_file($id);
						if($photo_file!="" and isset($_POST[$type."_chk".$ds->row["id_parent"]]))
						{
							$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','".$photo_file."',".(float)$_POST[$type."_price".$ds->row["id_parent"]].",".$ds->row["priority"].",0,".$ds->row["id_parent"].")";
							$db->execute($sql);
						}
					}
				}
			}

		$ds->movenext();
		}
	$dr->movenext();
	}
}
//End. The function update prices


//The function gets file name of the photo publication
function get_photo_file($id)
{
global $db;
$dp = new TMySQLQuery;
$dp->connection = $db;
$photo_file="";

	$sql="select url from items where url<>'' and id_parent=".$id;
	$dp->open($sql);
	if(!$dp->eof)
	{
		$photo_file=$dp->row["url"];
	}
	else
	{
		$sql="select server1 from photos where id_parent=".(int)$id;
		$dp->open($sql);
		if(!$dp->eof)
		{
				$dir = opendir ($_SERVER["DOCUMENT_ROOT"].site_root.server_url($dp->row["server1"])."/".$id);
  				while ($file = readdir ($dir)) 
 				{
    				if($file <> "." && $file <> ".." && $file <> ".DS_Store")
    				{
						if(preg_match("/.jpg$|.jpeg$/i",$file) and !preg_match("/thumb/",$file) and !preg_match("/photo_[0-9]+/",$file)) 
						{
							$photo_file=$file;
						}
    				}
  				}
 				closedir ($dir);
		}
	}

return $photo_file;
}
//End. The function gets file name of the photo publication



//Build prints upload form
function prints_upload_form()
{
global $ds;
global $_SESSION;
$res="";

	$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table'>
	<tr>
	<th></th>
	<th><b>".word_lang("title").":</b></th>
	<th><b>".word_lang("price").":</b></th>
	</tr>";



$sql="select id_parent,title,price,priority from prints order by priority";
$ds->open($sql);
$tr=1;
while(!$ds->eof)
{

		$readonly="readonly";
		if(isset($_SESSION["entry_admin"]))
		{
			$readonly="";
		}

			$snd="";
			if($tr%2==0)
			{
				$snd="class='snd'";
			}
			
			$res.="<tr ".$snd.">
			<td><input name='prints_chk".$ds->row["id_parent"]."' type='checkbox' checked></td>
			<td>".$ds->row["title"]."</td>
			<td><input class='ibox' name='prints_price".$ds->row["id_parent"]."' value='".float_opt($ds->row["price"],2)."' type='text' ".$readonly." style='width:50px'></td>
			</tr>";
$tr++;
$ds->movenext();
}



$res.="</table>";


return $res;
}
//End prints upload form




//Build a table of current prints for the ID
function prints_live($id)
{
global $ds;
global $dr;
global $_SESSION;
$res="";

$sql="select id_parent,title,price,priority from prints order by priority";
$ds->open($sql);
if(!$ds->eof)
{


$res.="<table border='0' cellpadding='5' cellspacing='1' class='profile_table'>
<tr>
<th></th>
<th><b>".word_lang("title").":</b></th>
<th><b>".word_lang("price").":</b></th>
</tr>";



$tr=1;
while(!$ds->eof)
{

$checked="";
$price=$ds->row["price"];


$sql="select id_parent,title,price,priority from prints_items where itemid=".(int)$id." and printsid=".$ds->row["id_parent"]." order by priority";
$dr->open($sql);
if(!$dr->eof)
{
$checked="checked";
$price=$dr->row["price"];
}

		$readonly="readonly";
		if(isset($_SESSION["entry_admin"]))
		{
			$readonly="";
		}
		
		$snd="";
		if($tr%2==0)
		{
			$snd="class='snd'";
		}

$res.="<tr  ".$snd.">
<td><input name='prints_chk".$ds->row["id_parent"]."' type='checkbox' ".$checked."></td>
<td>".$ds->row["title"]."</td>
<td><input class='ibox' name='prints_price".$ds->row["id_parent"]."' ".$readonly." value='".float_opt($price,2)."' type='text' style='width:50px'></td>
</tr>";

$tr++;
$ds->movenext();
}



$res.="</table>";



}


return $res;
}
//End. Build a table of current prints for the ID


//The function updates prints
function prints_update($id)
{
global $ds;
global $dr;
global $db;
global $_POST;


	$sql="select id_parent,title,priority from prints order by priority";
	$ds->open($sql);
	while(!$ds->eof)
	{
		$sql="select id_parent,title,price,priority from prints_items where itemid=".(int)$id." and printsid=".$ds->row["id_parent"]." order by priority";
		$dr->open($sql);

		if(!$dr->eof)
		{
			if(isset($_POST["prints_chk".$ds->row["id_parent"]]))
			{
				$sql="update prints_items set price=".(float)$_POST["prints_price".$ds->row["id_parent"]]." where itemid=".(int)$id." and printsid=".$ds->row["id_parent"];
				$db->execute($sql);
			}
			else
			{
				$sql="delete from prints_items where itemid=".(int)$id." and printsid=".$ds->row["id_parent"];
				$db->execute($sql);
			}
		}
		else
		{
			if(isset($_POST["prints_chk".$ds->row["id_parent"]]))
			{
				$sql="insert into prints_items (title,price,itemid,priority,printsid) values ('".$ds->row["title"]."',".(float)$_POST["prints_price".$ds->row["id_parent"]].",".$id.",".$ds->row["priority"].",".$ds->row["id_parent"].")";
				$db->execute($sql);
			}
		}

	$ds->movenext();
	}


}
//End The function updates prints



//Build <form> in admin panel
function build_admin_form($url,$type)
{
global $admin_fields;
global $admin_meanings;
global $admin_types;
global $admin_names;
global $id;
global $dd;
global $lvideo;
global $lpreviewvideo;
global $laudio;
global $lpreviewaudio;
global $lvector;
global $site_prints;
global $global_settings;


$form_result="";



$border_header="<div class='table_t'><div class='table_b'><div class='table_l'><div class='table_r'><div class='table_bl'><div class='table_br'><div class='table_tl'><div class='table_tr'>";

$border_footer="</div></div></div></div></div></div></div></div>";


$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}

//Show thumb
if($id!=0 and isset($_SESSION['entry_admin']))
{
	$form_result.="<div class='content_preview'><div class='table_t'><div class='table_b'><div class='table_l'><div class='table_r'><div class='table_bl'><div class='table_br'><div class='table_tl'><div class='table_tr'>".show_preview($id,$type,2,0)."</div></div></div></div></div></div></div></div></div>";
}

if(isset($_SERVER["HTTP_REFERER"]) and $_SERVER["HTTP_REFERER"]!="")
{	
	$return_url=$_SERVER["HTTP_REFERER"];
}
else
{
	$return_url="";
}

$form_result.="<form method='post' Enctype='multipart/form-data' name='uploadform' action='".$url."&type=".$type."' style='margin:0'><input type='hidden' name='return_url' value='".$return_url."'>";

for($i=0;$i<count($admin_fields);$i++)
{
	$form_result.="<div class='admin_field'>";
	$form_result.="<span>".word_lang($admin_names[$i]).":</span>";
	
	if($admin_types[$i]=="text")
	{
		$form_result.="<input type='text' name='".$admin_fields[$i]."' style='width:400px' class='ibox' value='".$admin_meanings[$i]."'>";
	}
	
	if($admin_types[$i]=="filepdf")
	{
		$form_result.="<input type='file' name='".$admin_fields[$i]."' style='width:400px' class='ibox'><br>(*.jpg or *.pdf or *.zip)";
		if($admin_meanings[$i].""!="")
		{
			$form_result.="<div style='padding-top:3px'><a 	href='".$admin_meanings[$i]."'>".word_lang("download")."</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='delete_thumb.php?id=".$id."&type=file'>".word_lang("delete")."</a></div>";
		}
	}
	
	if($admin_types[$i]=="file")
	{
		if($type=="category")
		{
			$form_result.="<input type='file' name='".$admin_fields[$i]."' style='width:400px' class='ibox'><br>(*.jpg)";
			

			if($admin_meanings[$i].""!="")
			{
				$form_result.="<div style='padding-top:3px'><div id='preview' style='display:inline'><a 	href='".$admin_meanings[$i]."'>".word_lang("preview")."</a></div>&nbsp;&nbsp;&nbsp;&nbsp;<a href='delete_thumb.php?id=".$id."'>".word_lang("delete")."</a></div>";
			}
		}
		if($type=="photo")
		{	
			if($id==0)
			{
				$form_result.=$border_header.photo_upload_form().$border_footer;
			}
			else
			{
				$form_result.=$border_header.price_update_form($id,"photo").$border_footer;
			}
			if($global_settings["prints"])
			{
				$form_result.="</div><div class='admin_field'>";
				$form_result.="<span>".word_lang("prints and products").":</span>";
				if($id==0)
				{
					$form_result.=$border_header.prints_upload_form().$border_footer;
				}
				else
				{
					$form_result.=$border_header.prints_live($id).$border_footer;
				}
			}
		}
		
		if($type=="video")
		{
			if($id==0)
			{
				$form_result.=$border_header.video_upload_form($lvideo,$lpreviewvideo).$border_footer;
			}
			else
			{
				$form_result.=$border_header.price_update_form($id,"video").$border_footer;
			}
		}
		
		if($type=="audio")
		{
			if($id==0)
			{
				$form_result.=$border_header.audio_upload_form($laudio,$lpreviewaudio).$border_footer;
			}
			else
			{
				$form_result.=$border_header.price_update_form($id,"audio").$border_footer;
			}
		}
		
		if($type=="vector")
		{
			if($id==0)
			{
				$form_result.=$border_header.vector_upload_form($lvector).$border_footer;
			}
			else
			{
				$form_result.=$border_header.price_update_form($id,"vector").$border_footer;
			}
		}
		
	}
	
	if($admin_types[$i]=="int")
	{
		$form_result.="<input type='text' name='".$admin_fields[$i]."' style='width:200px' class='ibox' value='".$admin_meanings[$i]."'>";
	}
	
	if($admin_types[$i]=="float")
	{
		$form_result.="<input type='text' name='".$admin_fields[$i]."' style='width:200px' class='ibox' value='".$admin_meanings[$i]."'>";
	}
	
	if($admin_types[$i]=="textarea")
	{
		$form_result.="<textarea name='".$admin_fields[$i]."' style='width:400px;height:200px' class='ibox'>".$admin_meanings[$i]."</textarea>";
	}
	
	if($admin_types[$i]=="data")
	{
		$form_result.=admin_date($admin_meanings[$i],$admin_fields[$i]);
	}
	
	if($admin_types[$i]=="checkbox")
	{
		$sel="";
		if($admin_meanings[$i]==1){$sel="checked";}
		$form_result.="<input type='checkbox' name='".$admin_fields[$i]."'   ".$sel.">";
	}
	
	if($admin_types[$i]=="category")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'><option value='5'></option>".$admin_meanings[$i]."</select>";
	}
	
	if($admin_types[$i]=="model")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'><option value='0'></option>";
		$sql="select id_parent,name from models order by name";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["id_parent"]==(int)$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["id_parent"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="author")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select login from users where utype='seller' or utype='common' order by login";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["login"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["login"]."' ".$sel.">".$dd->row["login"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="content_type")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select id_parent,name from content_type order by priority";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="format")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from video_format";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="ratio")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from video_ratio";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="rendering")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from video_rendering";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="frames")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from video_frames";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="source")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from audio_source";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="track_format")
	{
		$form_result.="<select name='".$admin_fields[$i]."' style='width:400px' class='ibox'>";
		$sql="select name from audio_format";
		$dd->open($sql);
		while(!$dd->eof)
		{
		$sel="";
		if($dd->row["name"]==$admin_meanings[$i]){$sel="selected";}
		$form_result.="<option value='".$dd->row["name"]."' ".$sel.">".$dd->row["name"]."</option>";
		$dd->movenext();
		}
		$form_result.="</select>";
	}
	
	if($admin_types[$i]=="color")
	{
		$form_result.=color_set($admin_meanings[$i]);
	}
	
	if($admin_types[$i]=="duration")
	{
		$form_result.=duration_form($admin_meanings[$i],$admin_fields[$i]);
	}
	
	
	if($admin_types[$i]=="editor")
	{
		$form_result.="<script type='text/javascript' src='../plugins/tiny_mce/tiny_mce.js'></script>
		<script type='text/javascript'>
	tinyMCE.init({
		// General options
		mode : 'exact',
		elements : '".$admin_fields[$i]."',
		theme : 'advanced',
		plugins : 'autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks',
		document_base_url : '".surl.site_root."/',
		convert_urls : false,
		relative_urls : false,

		// Theme options
		theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect',
		theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
		theme_advanced_buttons3 : 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
		theme_advanced_buttons4 : 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks',
		theme_advanced_toolbar_location : 'top',
		theme_advanced_toolbar_align : 'left',
		theme_advanced_statusbar_location : 'bottom',
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : '../plugins/tiny_mce/css/content.css',

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : '../plugins/tiny_mce/lists/template_list.js',
		external_link_list_url : '../plugins/tiny_mce/lists/link_list.js',
		external_image_list_url : '../plugins/tiny_mce/lists/image_list.js',
		media_external_list_url : '../plugins/tiny_mce/lists/media_list.js',

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'}
		],


	});
	</script>
	<textarea name='".$admin_fields[$i]."' style='width:800px;height:600px'>".$admin_meanings[$i]."</textarea>
	";
	}
	
	$form_result.="</div>";
}

$form_result.="<div id='button_bottom_static'>
		<div id='button_bottom_layout'></div>
		<div id='button_bottom'><input type='submit' value='".word_lang("Save")."' class='btn btn-primary'></div></div>";

$form_result.="</form>";


return $form_result;
}







//Redirect function when a file is being uploaded
function redirect_file($s,$swait)
{
ob_end_clean();

	if($swait==false)
	{
		header("location:".$s);
		exit();
	}
	else
	{
		echo("<html>
		<head>
		<title>".word_lang("upload")."</title>
		</head>
		<body bgcolor='#525151'>
		<script language='javascript'>
		function ff()
		{
		location.href='".$s."';
		}
		function cc()
		{
		hid = setTimeout('ff();',5000);
		} 
		cc()
		</script><div style='margin:250px auto 0px auto;width:310px;background-color:#373737;border: #4a4a4a 4px solid;padding:20px;font: 15pt Arial;color:#ffffff'>".word_lang("wait")."<div><center><img src='".site_root."/images/upload_loading.gif'></center></div></div>
		</body>
		</html>");
	}

}





//Add/update category
function add_update_category($id,$userid,$upload,$published)
{
global $_POST;
global $_SERVER;
global $db;
global $dr;
global $global_settings;


$category_upload=$upload;
if(isset($_POST["upload"])){$category_upload=1;}

$category_published=$published;
if(isset($_POST["published"])){$category_published=1;}

$category_priority=0;
if(isset($_POST["priority"])){$category_priority=(int)$_POST["priority"];}

$flag_new=false;


//Get ID for a new category
if($id==0)
{
		$flag_new=true;
		
		$sql="insert into structure (id_parent,name,module_table) values (".(int)$_POST["category"].",'".result($_POST["title"])."',34)";
		$db->execute($sql);

		$sql="select id from structure where name='".result($_POST["title"])."' order by id desc";
		$dr->open($sql);
		$id=$dr->row['id'];

}




//Upload photo
$photo="";
$swait=false;
$flag=true;	
	
if(preg_match("/text/i",$_FILES["photo"]["type"]))
{
	$flag=false;
}
if(!preg_match("/\.jpg$/i",$_FILES["photo"]["name"]))
{
	$flag=false;
}

$_FILES["photo"]['name']=result_file($_FILES["photo"]['name']);


if($_FILES["photo"]['size']>0 and $_FILES["photo"]['size']<10048*1024)
{
	if($flag==true)
	{
		$photo=site_root."/content/categories/category_".$id.".jpg";
		move_uploaded_file($_FILES["photo"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$photo);

		//make thumb
		easyResize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].$photo,100,(int)$global_settings["category_preview"]);

		$swait=true;
	}
}



//Change database
	if($flag_new)
	{
	//Add a new category

	
		$sql="insert into category (id_parent,title,description,photo,upload,userid,published,priority,password) values (".$id.",'".result($_POST["title"])."','".result($_POST["description"])."','".$photo."',".$category_upload.",".(int)$userid.",".$category_published.",".$category_priority.",'".result($_POST["password"])."')";
		$db->execute($sql);
	
	
	}
	else
	{
	//Update the category
	
		$com="";
		if($userid!=0)
		{
		$com=" and userid=".(int)$userid;
		}
	
		$sql="update category set title='".result($_POST["title"])."',description='".result($_POST["description"])."',password='".result($_POST["password"])."',priority=".$category_priority.",upload=".$category_upload.",published=".$category_published." where id_parent=".$id.$com;
		$db->execute($sql);
		
		if($photo!="")
		{
		$sql="update category set photo='".result($photo)."' where id_parent=".$id.$com;
		$db->execute($sql);
		}
		
	
		$sql="update structure set name='".result($_POST["title"])."',id_parent=".(int)$_POST["category"]." where id=".$id;
		$db->execute($sql);

	}


return $swait;
}








//Delete category
function delete_category($id,$userid)
{
global $db;
global $rs;
global $_SERVER;


	$com="";
	if($userid!=0)
	{
	$com=" and userid=".(int)$userid;
	}

	$sql="select id_parent,photo from category where id_parent=".(int)$id.$com;
	$rs->open($sql);
	if(!$rs->eof)
	{

		if($rs->row["photo"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]))
		{
		unlink($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]);
		}

		$sql="delete from structure where id=".(int)$id;
		$db->execute($sql);

		$sql="delete from category where id_parent=".(int)$id;
		$db->execute($sql);

	}

}



//The function uploads model property release
function model_upload($id)
{
	global $_FILES;
	global $_SERVER;
	global $site_thumb_width;
	global $db;
	
	$swait=false;
	
	//upload photo
	$_FILES["modelphoto"]['name']=result_file($_FILES["modelphoto"]['name']);
	$nf=explode(".",$_FILES["modelphoto"]['name']);
	if($_FILES["modelphoto"]['size']>0 and $_FILES["modelphoto"]['size']<1024*1024*1 and !preg_match("/text/i",$_FILES["modelphoto"]['type']) and preg_match("/.jpg$|.jpeg$/i",$_FILES["modelphoto"]['name']))
	{
		$swait=true;
		$photo=site_root."/content/models/modelphoto".$id.".".$nf[count($nf)-1];
		move_uploaded_file($_FILES["modelphoto"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$photo);

		$size = getimagesize ($_SERVER["DOCUMENT_ROOT"].$photo);

		$wd1=$site_thumb_width;
		if(isset($size[1]))
		{
			if($size[0]<$size[1]){$wd1=$size[0]*$site_thumb_height/$size[1];}
		}
	
		easyResize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].$photo,100,$wd1);

		$sql="update models set modelphoto='".$photo."' where id_parent=".$id;
		$db->execute($sql);
	}

	//upload release
	$_FILES["model"]['name']=result_file($_FILES["model"]['name']);
	$nf=explode(".",$_FILES["model"]['name']);
	if($_FILES["model"]['size']>0 and $_FILES["model"]['size']<1024*1024*5 and !preg_match("/text/i",$_FILES["model"]['type']) and preg_match("/.pdf$|.zip$|.jpg$|.jpeg$/i",$_FILES["model"]['name']))
	{
		$swait=true;
		$photo=site_root."/content/models/model".$id.".".$nf[count($nf)-1];
		move_uploaded_file($_FILES["model"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$photo);

		$sql="update models set model='".$photo."' where id_parent=".$id;
		$db->execute($sql);
	}
	
	return $swait;
}
//End. The function uploads model property release


//The function deletes model property release
function model_delete($id,$user)
{
	global $db;
	global $rs;
	
	if($user=="")
	{
		$sql="select * from models where id_parent=".(int)$id;
	}
	else
	{
		$sql="select * from models where id_parent=".(int)$id." and user='".result($user)."'";
	}
	$rs->open($sql);
	if(!$rs->eof)
	{
		$sql="delete from models where id_parent=".(int)$id;
		$db->execute($sql);

		if($rs->row["modelphoto"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["modelphoto"]))
		{
			@unlink($_SERVER["DOCUMENT_ROOT"].$rs->row["modelphoto"]);
		}

		if($rs->row["model"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["model"]))
		{
			@unlink($_SERVER["DOCUMENT_ROOT"].$rs->row["model"]);
		}
	}
}
//End. The function deletes model property release



//The function deletes files of model property release
function model_delete_file($id,$type,$user)
{
	global $db;
	global $rs;

	if($user=="")
	{
		$sql="select * from models where id_parent=".(int)$id;
	}
	else
	{
		$sql="select * from models where id_parent=".(int)$id." and user='".result($user)."'";
	}
	$rs->open($sql);
	if(!$rs->eof)
	{
		if($type=="photo")
		{
			$sql="update models set modelphoto='' where id_parent=".(int)$id;
			$db->execute($sql);
			if($rs->row["modelphoto"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["modelphoto"]))
			{
				@unlink($_SERVER["DOCUMENT_ROOT"].$rs->row["modelphoto"]);
			}
		}
		else
		{
			$sql="update models set model='' where id_parent=".(int)$id;
			$db->execute($sql);
			if($rs->row["model"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["model"]))
			{
				@unlink($_SERVER["DOCUMENT_ROOT"].$rs->row["model"]);
			}
		}
	}
}
//End. The function deletes files of model property release


//The function adds a new photo to the database
function publication_photo_add()
{
global $site_servers;
global $site_server_activ;
global $pub_vars;
global $dr;
global $db;
$id=0;

//add to structure database
$sql="insert into structure (id_parent,name,module_table) values (".$pub_vars["category"].",'".$pub_vars["title"]."',30)";
$db->execute($sql);

//define id
$sql="select id from structure where name='".$pub_vars["title"]."' order by id desc";
$dr->open($sql);
$id=$dr->row['id'];

//create new folder
if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id))
{
mkdir($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id);
}

	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["color"]))
	{
		$pub_vars["color"]='';
	}
	
	if(isset($_POST["adult"]))
	{
		$pub_vars["adult"]=1;
	}
	else
	{
		$pub_vars["adult"]=0;
	}

//add to photo database
$sql="insert into photos (id_parent,title,description,keywords,folder,userid,published,viewed,data,author,content_type,downloaded,model,examination,server1,free,category2,category3,featured,google_x,google_y,server2,color,editorial,adult) values (".$id.",'".$pub_vars["title"]."','".$pub_vars["description"]."','".$pub_vars["keywords"]."',".$id.",".$pub_vars["userid"].",".$pub_vars["published"].",".$pub_vars["viewed"].",".$pub_vars["data"].",'".$pub_vars["author"]."','".$pub_vars["content_type"]."',".$pub_vars["downloaded"].",".$pub_vars["model"].",'".$pub_vars["examination"]."','".$pub_vars["server1"]."',".$pub_vars["free"].",".$pub_vars["category2"].",".$pub_vars["category3"].",".$pub_vars["featured"].",".$pub_vars["google_x"].",".$pub_vars["google_y"].",0,'".$pub_vars["color"]."',".$pub_vars["editorial"].",".$pub_vars["adult"].")";
$db->execute($sql);




return $id;
}
//End. The function adds a new photo to the database




//The function adds photo sizes to the database
function publication_photo_sizes_add($id,$file,$without_post)
{
global $dr;
global $rs;
global $db;
global $_POST;


	$sql="select * from sizes order by priority";
	$dr->open($sql);
	while(!$dr->eof)
	{
		$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$dr->row["id_parent"];
		$rs->open($sql);
		if($rs->eof)
		{
			$flag=false;
			if($without_post)
			{
				$flag=true;
			}

			if(isset($_POST["chk".$dr->row["id_parent"]]))
			{
				$flag=true;
			}

			$price=$dr->row["price"];
			if(isset($_POST["price".$dr->row["id_parent"]]))
			{
				$price=(float)$_POST["price".$dr->row["id_parent"]];
			}

			if($flag)
			{
				$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$dr->row["title"]."','".result($file)."',".$price.",".$dr->row["priority"].",0,".$dr->row["id_parent"].")";
				$db->execute($sql);
			}

		}
	$dr->movenext();
	}
}
//End. The function adds photo sizes to the database



//The function adds photo watermark/color info  to the database
function publication_watermark_add($id,$file)
{
global $site_watermark;
global $site_server_activ;
global $site_servers;
global $db;

	$watermark_position=5;

	if($site_watermark!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$site_watermark))
	{
		watermark($file,$_SERVER["DOCUMENT_ROOT"].$site_watermark);
	}

	$size = getimagesize ($file);
	$orientation=0;
	if($size[1]>$size[0]){$orientation=1;}

	$sql="update photos set watermark=".$watermark_position.",color='".define_color($file)."',orientation=".$orientation." where id_parent=".$id;
	$db->execute($sql);

}
//End. The function adds photo watermark/color info  to the database


//The function defines google gps coordinates

function getGps($exifCoord, $hemi) 
{
    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

}

function gps2Num($coordPart) 
{
    $parts = explode('/', $coordPart);

    if (count($parts) <= 0)
        return 0;

    if (count($parts) == 1)
        return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
}
//End. The function defines google gps coordinates


//The function adds IPTC info to the database
function publication_iptc_add($id,$photo)
{
global $rs;
global $db;

$size = getimagesize ($photo,$info);
if(isset ($info["APP13"]))
{
	$iptc = iptcparse ($info["APP13"]);

	//Title
	if(isset($iptc["2#005"][0]) and $iptc["2#005"][0]!="")
	{
		$sql="update photos set title='".result($iptc["2#005"][0])."' where id_parent=".$id;
		$db->execute($sql);
		
		$sql="update vector set title='".result($iptc["2#005"][0])."' where id_parent=".$id;
		$db->execute($sql);

		$sql="update structure set name='".result($iptc["2#005"][0])."' where id=".$id;
		$db->execute($sql);
	}

	//Description
	if(isset($iptc["2#120"][0]) and $iptc["2#120"][0]!="")
	{
		$sql="update photos set description='".result($iptc["2#120"][0])."' where id_parent=".$id;
		$db->execute($sql);
		
		$sql="update vector set description='".result($iptc["2#120"][0])."' where id_parent=".$id;
		$db->execute($sql);
	}

	//Keywords
	if(isset($iptc["2#025"][0]) and $iptc["2#025"][0]!="")
	{
		$iptc_kw="";
		for($t=0;$t<count($iptc["2#025"]);$t++)
		{
			if($iptc_kw!=""){$iptc_kw.=",";}
			$iptc_kw.=$iptc["2#025"][$t];
		}
		if($iptc_kw!="")
		{
			$sql="update photos set keywords='".result($iptc_kw)."' where id_parent=".$id;
			$db->execute($sql);
			
			$sql="update vector set keywords='".result($iptc_kw)."' where id_parent=".$id;
			$db->execute($sql);
		}
	}

}

	//Google coordinates
	$exif_info=@exif_read_data($photo,0,true);
	if(isset($exif_info["GPS"]["GPSLongitude"]) and isset($exif_info["GPS"]['GPSLongitudeRef']) and isset($exif_info["GPS"]["GPSLatitude"]) and isset($exif_info["GPS"]['GPSLatitudeRef']))
	{
		$lon = getGps($exif_info["GPS"]["GPSLongitude"], $exif_info["GPS"]['GPSLongitudeRef']);
		$lat = getGps($exif_info["GPS"]["GPSLatitude"], $exif_info["GPS"]['GPSLatitudeRef']);
		
		$sql="update photos set google_x=".$lat.",google_y=".$lon." where id_parent=".$id;
		$db->execute($sql);
	}

}
//End. The function adds IPTC info to the database


//The function adds a new print to the database
function publication_prints_add($id,$without_post)
{
global $rs;
global $db;


	$sql="select id_parent,title,price,priority from prints order by priority";
	$rs->open($sql);
	while(!$rs->eof)
	{

		$flag=false;
		if($without_post)
		{
			$flag=true;
		}
		if(isset($_POST["prints_chk".$rs->row["id_parent"]]))
		{
			$flag=true;
		}

		$price=$rs->row["price"];
		if(isset($_POST["prints_price".$rs->row["id_parent"]]))
		{
			$price=(float)$_POST["prints_price".$rs->row["id_parent"]];
		}


		if($flag)
		{
			$sql="insert into prints_items (title,price,itemid,priority,printsid) values ('".$rs->row["title"]."',".$price.",".$id.",".$rs->row["priority"].",".$rs->row["id_parent"].")";
			$db->execute($sql);
		}
		
		$rs->movenext();
	}
}
//End. The function adds a new print to the database













//The function adds a new video to the database
function publication_video_add()
{
global $site_servers;
global $site_server_activ;
global $pub_vars;
global $dr;
global $db;
$id=0;

//add to structure database
$sql="insert into structure (id_parent,name,module_table) values (".$pub_vars["category"].",'".$pub_vars["title"]."',31)";
$db->execute($sql);

//define id
$sql="select id from structure where name='".$pub_vars["title"]."' order by id desc";
$dr->open($sql);
$id=$dr->row['id'];

//create new folder
if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id))
{
mkdir($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id);
}

	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}

//add to video database
$sql="insert into videos (id_parent,title,description,keywords,folder,userid,published,viewed,data,author,content_type,downloaded,model,examination,server1,free,category2,category3,duration,format,ratio,rendering,frames,holder,usa,featured,google_x,google_y,server2,adult) values (".$id.",'".$pub_vars["title"]."','".$pub_vars["description"]."','".$pub_vars["keywords"]."',".$id.",".$pub_vars["userid"].",".$pub_vars["published"].",".$pub_vars["viewed"].",".$pub_vars["data"].",'".$pub_vars["author"]."','".$pub_vars["content_type"]."',".$pub_vars["downloaded"].",".$pub_vars["model"].",'".$pub_vars["examination"]."','".$pub_vars["server1"]."',".$pub_vars["free"].",".$pub_vars["category2"].",".$pub_vars["category3"].",'".$pub_vars["duration"]."','".$pub_vars["format"]."','".$pub_vars["ratio"]."','".$pub_vars["rendering"]."','".$pub_vars["frames"]."','".$pub_vars["holder"]."','".$pub_vars["usa"]."',".$pub_vars["featured"].",".$pub_vars["google_x"].",".$pub_vars["google_y"].",0,".$pub_vars["adult"].")";
$db->execute($sql);




return $id;
}
//End. The function adds a new video to the database




//The function updates video into the database
function publication_video_update($id,$userid)
{
global $pub_vars;
global $dr;
global $db;


	$sql="select id_parent,userid from videos where id_parent=".$id." and userid=".$pub_vars["userid"];
	$dr->open($sql);
	if(!$dr->eof or $userid==0)
	{
		$sql="update structure set name='".$pub_vars["title"]."',id_parent=".$pub_vars["category"]." where id=".$id;
		$db->execute($sql);
	}

	$com="";
	if($userid!=0)
	{
		$com="  and (userid=".$pub_vars["userid"]." or author='".$pub_vars["author"]."')";
	}
	
	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}

	$sql="update videos set title='".$pub_vars["title"]."',description='".$pub_vars["description"]."',keywords='".$pub_vars["keywords"]."',usa='".$pub_vars["usa"]."',duration='".$pub_vars["duration"]."',format='".$pub_vars["format"]."',ratio='".$pub_vars["ratio"]."',rendering='".$pub_vars["rendering"]."',frames='".$pub_vars["frames"]."',holder='".$pub_vars["holder"]."',model=".$pub_vars["model"].",free=".$pub_vars["free"].",category2=".$pub_vars["category2"].",category3=".$pub_vars["category3"].",downloaded=".$pub_vars["downloaded"].",viewed=".$pub_vars["viewed"].",data=".$pub_vars["data"].",content_type='".$pub_vars["content_type"]."',featured=".$pub_vars["featured"].",published=".$pub_vars["published"].",author='".$pub_vars["author"]."',google_x=".$pub_vars["google_x"].",google_y=".$pub_vars["google_y"].",adult=".$pub_vars["adult"]." where id_parent=".$id.$com;
	$db->execute($sql);



}
//End. The function updates video into the database



//The function uploads a video.
function publication_video_upload($id)
{
global $_POST;
global $_FILES;
global $ds;
global $dr;
global $rs;
global $db;
global $lvideo;
global $lpreview;
global $site_servers;
global $site_server_activ;
global $site_ffmpeg;
global $folder;
global $swait;

$server_id=$site_server_activ;
$sql="select server1 from videos where id_parent=".(int)$id;
$ds->open($sql);
if(!$ds->eof)
{
	$server_id=$ds->row["server1"];
}


$sql="select * from video_types order by priority";
$ds->open($sql);
while(!$ds->eof)
{
	if($ds->row["shipped"]!=1)
	{
		$flag=false;
		$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
		$_FILES["video_sale".$ds->row["id_parent"]]['name']=result_file($_FILES["video_sale".$ds->row["id_parent"]]['name']);
		$nf=explode(".",$_FILES["video_sale".$ds->row["id_parent"]]['name']);
		
		for($i=0;$i<count($uphoto);$i++)
		{
			if(strtolower($uphoto[$i])==strtolower($nf[count($nf)-1]))
			{
			$flag=true;
			}
		}
		
		if(preg_match("/text/i",$_FILES["video_sale".$ds->row["id_parent"]]['type']))
		{
			$flag=false;
		}

		if($_FILES["video_sale".$ds->row["id_parent"]]['size']>0 and $_FILES["video_sale".$ds->row["id_parent"]]['size']<1024*1024*$lvideo)
		{
			if($flag==true)
			{
				$videopath=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["video_sale".$ds->row["id_parent"]]['name'];
				move_uploaded_file($_FILES["video_sale".$ds->row["id_parent"]]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$videopath);
				
				$swait=true;


				$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
				$rs->open($sql);
				if($rs->eof)
					{
						$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','".result($_FILES["video_sale".$ds->row["id_parent"]]['name'])."',".floatval($_POST["video_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",0,".$ds->row["id_parent"].")";
						$db->execute($sql);
					}
					else
					{
						$sql="update items set name='".$ds->row["title"]."',url='".result($_FILES["video_sale".$ds->row["id_parent"]]['name'])."',price=".floatval($_POST["video_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
						$db->execute($sql);
					}
			}
		}
	}
	else
	{
		if(isset($_POST["video_chk".$ds->row["id_parent"]]))
		{
		
			$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
			$rs->open($sql);
			if($rs->eof)
			{
				$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','',".floatval($_POST["video_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",1,".$ds->row["id_parent"].")";
				$db->execute($sql);
				$swait=true;
			}
			else
			{
				$sql="update items set name='".$ds->row["title"]."',price=".floatval($_POST["video_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
				$db->execute($sql);
			}
		}
	}

$ds->movenext();
}




//Upload previews
if($site_ffmpeg==false)
{
	//upload video preview
	if(isset($_FILES["preview"]['name']))
	{
		$_FILES["preview"]['name']=result_file($_FILES["preview"]['name']);
		$nf=explode(".",$_FILES["preview"]['name']);
		if((strtolower($nf[count($nf)-1])=="flv" or strtolower($nf[count($nf)-1])=="wmv" or strtolower($nf[count($nf)-1])=="mov" or strtolower($nf[count($nf)-1])=="mp4") and !preg_match("/text/i",$_FILES["preview"]['type']))
		{
			if($_FILES["preview"]['size']>0 and $_FILES["preview"]['size']<1024*1024*$lpreview)
			{
				$vp=site_root.$site_servers[$server_id]."/".$folder."/thumb.".$nf[count($nf)-1];
				move_uploaded_file($_FILES["preview"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vp);
			
				$swait=true;
			}
		}
	}




	//upload photo preview
	if(isset($_FILES["preview2"]['name']))
	{
		$_FILES["preview2"]['name']=result_file($_FILES["preview2"]['name']);
		$nf=explode(".",$_FILES["preview2"]['name']);
		if((strtolower($nf[count($nf)-1])=="jpg" or strtolower($nf[count($nf)-1])=="jpeg") and !preg_match("/text/i",$_FILES["preview2"]['type']))
		{
			if($_FILES["preview2"]['size']>0 and $_FILES["preview2"]['size']<2048*1024)
			{
				$vp=site_root.$site_servers[$server_id]."/".$folder."/thumb.".$nf[count($nf)-1];
				
				$vp_big=site_root.$site_servers[$server_id]."/".$folder."/thumb100.".$nf[count($nf)-1];
				move_uploaded_file($_FILES["preview2"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vp);
				copy($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].$vp_big);
				
				photo_resize($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].$vp,1);
				photo_resize($_SERVER["DOCUMENT_ROOT"].$vp_big,$_SERVER["DOCUMENT_ROOT"].$vp_big,2);

			}
		}
	}

}
else
{
//FFMPEG generation

	//Define a source file for generation
	$generation_file="";
	$generation_file2="";
	$sql="select * from video_types order by priority";
	$ds->open($sql);
	while(!$ds->eof)
	{
		if($_FILES["video_sale".$ds->row["id_parent"]]['name']!="")
		{
			if(file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["video_sale".$ds->row["id_parent"]]['name']))
			{
				$generation_file2=$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["video_sale".$ds->row["id_parent"]]['name'];

				if(isset($_POST["generation"]) and (int)$_POST["generation"]==$ds->row["id_parent"])
				{
					$generation_file=$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["video_sale".$ds->row["id_parent"]]['name'];
				}
			}
		}

	$ds->movenext();
	}
	
	if($generation_file=="")
	{
		$generation_file=$generation_file2;
	}
	
	if($generation_file!="")
	{
		$fln=generate_flv($generation_file,0,0);
	}



}



}
//End. The function uploads a video.















//The function adds a new audio to the database
function publication_audio_add()
{
global $site_servers;
global $site_server_activ;
global $pub_vars;
global $dr;
global $db;
$id=0;

//add to structure database
$sql="insert into structure (id_parent,name,module_table) values (".$pub_vars["category"].",'".$pub_vars["title"]."',52)";
$db->execute($sql);

//define id
$sql="select id from structure where name='".$pub_vars["title"]."' order by id desc";
$dr->open($sql);
$id=$dr->row['id'];

//create new folder
if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id))
{
mkdir($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id);
}

	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}


//add to audio database
$sql="insert into audio (id_parent,title,description,keywords,folder,userid,published,viewed,data,author,content_type,downloaded,model,examination,server1,free,category2,category3,duration,source,format,holder,featured,google_x,google_y,server2,adult) values (".$id.",'".$pub_vars["title"]."','".$pub_vars["description"]."','".$pub_vars["keywords"]."',".$id.",".$pub_vars["userid"].",".$pub_vars["published"].",".$pub_vars["viewed"].",".$pub_vars["data"].",'".$pub_vars["author"]."','".$pub_vars["content_type"]."',".$pub_vars["downloaded"].",".$pub_vars["model"].",'".$pub_vars["examination"]."','".$pub_vars["server1"]."',".$pub_vars["free"].",".$pub_vars["category2"].",".$pub_vars["category3"].",'".$pub_vars["duration"]."','".$pub_vars["source"]."','".$pub_vars["format"]."','".$pub_vars["holder"]."',".$pub_vars["featured"].",".$pub_vars["google_x"].",".$pub_vars["google_y"].",0,".$pub_vars["adult"].")";
$db->execute($sql);




return $id;
}
//End. The function adds a new audio to the database










//The function updates audio into the database
function publication_audio_update($id,$userid)
{
global $pub_vars;
global $dr;
global $db;


	$sql="select id_parent,userid from audio where id_parent=".$id." and userid=".$pub_vars["userid"];
	$dr->open($sql);
	if(!$dr->eof or $userid==0)
	{
		$sql="update structure set name='".$pub_vars["title"]."',id_parent=".$pub_vars["category"]." where id=".$id;
		$db->execute($sql);
	}

	$com="";
	if($userid!=0)
	{
		$com="  and (userid=".$pub_vars["userid"]." or author='".$pub_vars["author"]."')";
	}
	
	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}

	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}

	$sql="update audio set title='".$pub_vars["title"]."',description='".$pub_vars["description"]."',keywords='".$pub_vars["keywords"]."',duration='".$pub_vars["duration"]."',format='".$pub_vars["format"]."',source='".$pub_vars["source"]."',holder='".$pub_vars["holder"]."',model=".$pub_vars["model"].",free=".$pub_vars["free"].",category2=".$pub_vars["category2"].",category3=".$pub_vars["category3"].",downloaded=".$pub_vars["downloaded"].",viewed=".$pub_vars["viewed"].",data=".$pub_vars["data"].",content_type='".$pub_vars["content_type"]."',featured=".$pub_vars["featured"].",published=".$pub_vars["published"].",author='".$pub_vars["author"]."',google_x=".$pub_vars["google_x"].",google_y=".$pub_vars["google_y"].",adult=".$pub_vars["adult"]." where id_parent=".$id.$com;
	$db->execute($sql);



}
//End. The function updates audio into the database





//The function uploads an audio.
function publication_audio_upload($id)
{
global $_POST;
global $_FILES;
global $ds;
global $dr;
global $rs;
global $db;
global $laudio;
global $lpreview;
global $site_servers;
global $site_server_activ;
global $site_ffmpeg;
global $folder;
global $swait;

$server_id=$site_server_activ;
$sql="select server1 from audio where id_parent=".(int)$id;
$ds->open($sql);
if(!$ds->eof)
{
	$server_id=$ds->row["server1"];
}




$sql="select * from audio_types order by priority";
$ds->open($sql);
while(!$ds->eof)
{
	if($ds->row["shipped"]!=1)
	{
		$flag=false;
		$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
		$_FILES["audio_sale".$ds->row["id_parent"]]['name']=result_file($_FILES["audio_sale".$ds->row["id_parent"]]['name']);
		$nf=explode(".",$_FILES["audio_sale".$ds->row["id_parent"]]['name']);

		for($i=0;$i<count($uphoto);$i++)
		{
			if(strtolower($uphoto[$i])==strtolower($nf[count($nf)-1])){$flag=true;}
		}
		if(preg_match("/text/i",$_FILES["audio_sale".$ds->row["id_parent"]]['type']))
		{
			$flag=false;
		}

		if($_FILES["audio_sale".$ds->row["id_parent"]]['size']>0 and $_FILES["audio_sale".$ds->row["id_parent"]]['size']<1024*1024*$laudio)
		{
			if($flag==true)
			{
				$audiopath=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["audio_sale".$ds->row["id_parent"]]['name'];
				move_uploaded_file($_FILES["audio_sale".$ds->row["id_parent"]]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$audiopath);
				$swait=true;


				$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
				$rs->open($sql);
				if($rs->eof)
				{
					$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','".result($_FILES["audio_sale".$ds->row["id_parent"]]['name'])."',".floatval($_POST["audio_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",0,".$ds->row["id_parent"].")";
					$db->execute($sql);
				}
				else
				{
					$sql="update items set name='".$ds->row["title"]."',url='".result($_FILES["audio_sale".$ds->row["id_parent"]]['name'])."',price=".floatval($_POST["audio_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
					$db->execute($sql);
				}


			}
		}
}
else
{
	if(isset($_POST["audio_chk".$ds->row["id_parent"]]))
	{
		$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
		$rs->open($sql);
		if($rs->eof)
		{
			$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','',".floatval($_POST["audio_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",1,".$ds->row["id_parent"].")";
			$db->execute($sql);
		}
		else
		{
			$sql="update items set name='".$ds->row["title"]."',price=".floatval($_POST["audio_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
			$db->execute($sql);
		}
	}
}





$ds->movenext();
}





//upload audio preview
if(isset($_FILES["preview"]['name']))
{
$_FILES["preview"]['name']=result_file($_FILES["preview"]['name']);
$nf=explode(".",$_FILES["preview"]['name']);

	if(strtolower($nf[count($nf)-1])=="mp3" and !preg_match("/text/i",$_FILES["preview"]['type']))
	{
		if($_FILES["preview"]['size']>0 and $_FILES["preview"]['size']<1024*1024*$lpreview)
		{
			$vp=site_root.$site_servers[$server_id]."/".$folder."/thumb.".$nf[count($nf)-1];
			move_uploaded_file($_FILES["preview"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vp);
			$swait=true;
		}
	}
}



//upload photo preview
if(isset($_FILES["preview2"]['name']))
{
$_FILES["preview2"]['name']=result_file($_FILES["preview2"]['name']);
$nf=explode(".",$_FILES["preview2"]['name']);

	if((strtolower($nf[count($nf)-1])=="jpg" or strtolower($nf[count($nf)-1])=="jpeg") and !preg_match("/text/i",$_FILES["preview2"]['type']))
	{
		if($_FILES["preview2"]['size']>0 and $_FILES["preview2"]['size']<2048*1024)
		{
		$vp=site_root.$site_servers[$server_id]."/".$folder."/thumb.".$nf[count($nf)-1];
		$vp_big=site_root.$site_servers[$server_id]."/".$folder."/thumb100.".$nf[count($nf)-1];
		
		move_uploaded_file($_FILES["preview2"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vp);
		copy($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].$vp_big);
		
		photo_resize($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].$vp,1);
		photo_resize($_SERVER["DOCUMENT_ROOT"].$vp_big,$_SERVER["DOCUMENT_ROOT"].$vp_big,2);

		$swait=true;
		}
	}
}

}
//End. The function uploads an audio.









//The function adds a new vector to the database
function publication_vector_add()
{
global $site_servers;
global $site_server_activ;
global $pub_vars;
global $dr;
global $db;
$id=0;

//add to structure database
$sql="insert into structure (id_parent,name,module_table) values (".$pub_vars["category"].",'".$pub_vars["title"]."',53)";
$db->execute($sql);

//define id
$sql="select id from structure where name='".$pub_vars["title"]."' order by id desc";
$dr->open($sql);
$id=$dr->row['id'];

//create new folder
if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id))
{
mkdir($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id);
}

	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}

//add to vector database
$sql="insert into vector (id_parent,title,description,keywords,folder,userid,published,viewed,data,author,content_type,downloaded,model,examination,server1,free,category2,category3,flash_version,script_version,flash_width,flash_height,featured,google_x,google_y,server2,adult) values (".$id.",'".$pub_vars["title"]."','".$pub_vars["description"]."','".$pub_vars["keywords"]."',".$id.",".$pub_vars["userid"].",".$pub_vars["published"].",".$pub_vars["viewed"].",".$pub_vars["data"].",'".$pub_vars["author"]."','".$pub_vars["content_type"]."',".$pub_vars["downloaded"].",".$pub_vars["model"].",'".$pub_vars["examination"]."','".$pub_vars["server1"]."',".$pub_vars["free"].",".$pub_vars["category2"].",".$pub_vars["category3"].",'".$pub_vars["flash_version"]."','".$pub_vars["script_version"]."',".$pub_vars["flash_width"].",".$pub_vars["flash_height"].",".$pub_vars["featured"].",".$pub_vars["google_x"].",".$pub_vars["google_y"].",0,".$pub_vars["adult"].")";
$db->execute($sql);




return $id;
}
//End. The function adds a new vector to the database










//The function updates vector into the database
function publication_vector_update($id,$userid)
{
global $site_servers;
global $site_server_activ;	
global $pub_vars;
global $dr;
global $db;


if(!file_exists($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id))
{
mkdir($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$id);
}

	$sql="select id_parent,userid from vector where id_parent=".$id." and userid=".$pub_vars["userid"];
	$dr->open($sql);
	if(!$dr->eof or $userid==0)
	{
		$sql="update structure set name='".$pub_vars["title"]."',id_parent=".$pub_vars["category"]." where id=".$id;
		$db->execute($sql);
	}

	$com="";
	if($userid!=0)
	{
		$com="  and (userid=".$pub_vars["userid"]." or author='".$pub_vars["author"]."')";
	}
	
	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["adult"]))
	{
		$pub_vars["adult"]=0;
	}

	$sql="update vector set title='".$pub_vars["title"]."',description='".$pub_vars["description"]."',keywords='".$pub_vars["keywords"]."',flash_version='".$pub_vars["flash_version"]."',script_version='".$pub_vars["script_version"]."',flash_width=".$pub_vars["flash_width"].",flash_height=".$pub_vars["flash_height"].",model=".$pub_vars["model"].",free=".$pub_vars["free"].",category2=".$pub_vars["category2"].",category3=".$pub_vars["category3"].",downloaded=".$pub_vars["downloaded"].",viewed=".$pub_vars["viewed"].",data=".$pub_vars["data"].",content_type='".$pub_vars["content_type"]."',featured=".$pub_vars["featured"].",published=".$pub_vars["published"].",author='".$pub_vars["author"]."',google_x=".$pub_vars["google_x"].",google_y=".$pub_vars["google_y"].",adult=".$pub_vars["adult"]." where id_parent=".$id.$com;
	$db->execute($sql);



}
//End. The function updates vector into the database







//The function updates photo into the database
function publication_photo_update($id,$userid)
{
global $pub_vars;
global $dr;
global $db;


	$sql="select id_parent,userid from photos where id_parent=".$id." and userid=".$pub_vars["userid"];
	$dr->open($sql);
	if(!$dr->eof or $userid==0)
	{
		$sql="update structure set name='".$pub_vars["title"]."',id_parent=".$pub_vars["category"]." where id=".$id;
		$db->execute($sql);
	}

	$com="";
	if($userid!=0)
	{
		$com="  and (userid=".$pub_vars["userid"]." or author='".$pub_vars["author"]."')";
	}
	
	if(!isset($pub_vars["featured"]))
	{
		$pub_vars["featured"]=0;
	}
	
	if(!isset($pub_vars["color"]))
	{
		$pub_vars["color"]="";
	}
	
	if(isset($_POST["editorial"]))
	{
		$pub_vars["editorial"]=1;
	}
	else
	{
		$pub_vars["editorial"]=0;
	}
	
	if(isset($_POST["adult"]))
	{
		$pub_vars["adult"]=1;
	}
	else
	{
		$pub_vars["adult"]=0;
	}

	$sql="update photos set title='".$pub_vars["title"]."',description='".$pub_vars["description"]."',keywords='".$pub_vars["keywords"]."',model=".$pub_vars["model"].",free=".$pub_vars["free"].",category2=".$pub_vars["category2"].",category3=".$pub_vars["category3"].",downloaded=".$pub_vars["downloaded"].",viewed=".$pub_vars["viewed"].",data=".$pub_vars["data"].",content_type='".$pub_vars["content_type"]."',featured=".$pub_vars["featured"].",published=".$pub_vars["published"].",author='".$pub_vars["author"]."',google_x=".$pub_vars["google_x"].",google_y=".$pub_vars["google_y"].",color='".$pub_vars["color"]."',editorial=".$pub_vars["editorial"].",adult=".$pub_vars["adult"]." where id_parent=".$id.$com;
	$db->execute($sql);



}
//End. The function updates photo into the database








//The function makes previews from zip archive of jpg photos
function publication_zip_preview($zarc)
{
global $_POST;
global $_FILES;
global $site_servers;
global $site_server_activ;
global $folder;


$vp=$zarc;

		$archive = new PclZip($_SERVER["DOCUMENT_ROOT"].$vp);
		if ($archive->extract(PCLZIP_OPT_PATH,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder) == true) 
		{
			$afiles=array();

  			$dir = opendir ($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder);
  			while ($file = readdir ($dir)) 
  			{
				if($file <> "." && $file <> "..")
    			{
					if (preg_match("/.jpg$|.jpeg$/i",$file) and !preg_match("/thumb/i",$file)) 
					{ 
						$file=result_file($file);
						$afiles[count($afiles)]=$file;
					}
					else
					{
						@unlink($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file);
					}
					if (preg_match("/php/i",$file)) 
					{
						@unlink($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file);
					}
    			}
 			 }
  			closedir ($dir);
			@unlink($_SERVER["DOCUMENT_ROOT"].$vp);

			sort ($afiles);
			reset ($afiles);	

			for($n=0;$n<count($afiles);$n++)
			{
				$file=$afiles[$n];

				photo_resize($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumbs".$n.".jpg",1);
				photo_resize($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumbz".$n.".jpg",2);
				
				publication_watermark_add(0,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumbz".$n.".jpg");

				if($n==0)
				{				
					photo_resize($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb1.jpg",1);
					photo_resize($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg",2);
					publication_watermark_add(0,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/thumb2.jpg");
				}

				@unlink($_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$site_server_activ]."/".$folder."/".$file);
			}

		}

}
//End. The function makes previews from zip archive of jpg photos


//The function uploads a vector.
function publication_vector_upload($id)
{
global $_POST;
global $_FILES;
global $ds;
global $dr;
global $rs;
global $db;
global $lvector;
global $site_servers;
global $site_server_activ;
global $folder;
global $swait;

$server_id=$site_server_activ;
$sql="select server1 from vector where id_parent=".(int)$id;
$ds->open($sql);
if(!$ds->eof)
{
	$server_id=$ds->row["server1"];
}


//upload flash preview
if(isset($_FILES["preview3"]['name']))
{
	$_FILES["preview3"]['name']=result_file($_FILES["preview3"]['name']);
	$nf=explode(".",$_FILES["preview3"]['name']);

	if(strtolower($nf[count($nf)-1])=="swf" and !preg_match("/text/i",$_FILES["preview3"]['type']))
	{
		if($_FILES["preview3"]['size']>0 and $_FILES["preview3"]['size']<2048*1024)
		{
		$vpf=site_root.$site_servers[$server_id]."/".$folder."/thumb.swf";
		move_uploaded_file($_FILES["preview3"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vpf);
		$swait=true;
		}
	}
}

//Upload xml files:
if(isset($_FILES["xml1"]['name']))
{
	$_FILES["xml1"]['name']=result_file($_FILES["xml1"]['name']);
	$nf=explode(".",$_FILES["xml1"]['name']);

	if(strtolower($nf[count($nf)-1])=="xml")
	{
		if($_FILES["xml1"]['size']>0 and $_FILES["xml1"]['size']<100*1024)
		{
			$vpf=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["xml1"]['name'];
			move_uploaded_file($_FILES["xml1"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vpf);
			$swait=true;
		}
	}
}

if(isset($_FILES["xml2"]['name']))
{
	$_FILES["xml2"]['name']=result_file($_FILES["xml2"]['name']);
	$nf=explode(".",$_FILES["xml2"]['name']);

	if(strtolower($nf[count($nf)-1])=="xml")
	{
		if($_FILES["xml2"]['size']>0 and $_FILES["xml2"]['size']<100*1024)
		{
			$vpf=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["xml2"]['name'];
			move_uploaded_file($_FILES["xml2"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vpf);
			$swait=true;
		}
	}
}

if(isset($_FILES["xml3"]['name']))
{
	$_FILES["xml3"]['name']=result_file($_FILES["xml3"]['name']);
	$nf=explode(".",$_FILES["xml3"]['name']);

	if(strtolower($nf[count($nf)-1])=="xml")
	{
		if($_FILES["xml3"]['size']>0 and $_FILES["xml3"]['size']<100*1024)
		{
			$vpf=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["xml3"]['name'];
			move_uploaded_file($_FILES["xml3"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vpf);
			$swait=true;
		}
	}
}
//End upload xmp files


//Upload photo preview and reads IPTC
if(isset($_FILES["preview2"]['name']))
{
	$_FILES["preview2"]['name']=result_file($_FILES["preview2"]['name']);
	$nf=explode(".",$_FILES["preview2"]['name']);

	if((strtolower($nf[count($nf)-1])=="jpg" or strtolower($nf[count($nf)-1])=="jpeg") and !preg_match("/text/i",$_FILES["preview2"]['type']))
	{
		if($_FILES["preview2"]['size']>0 and $_FILES["preview2"]['size']<2048*1024)
		{
			$vp=site_root.$site_servers[$server_id]."/".$folder."/1.".$nf[count($nf)-1];
			move_uploaded_file($_FILES["preview2"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vp);
			$swait=true;

			photo_resize($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb1.jpg",1);

			photo_resize($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb2.jpg",2);

			publication_watermark_add($id,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb2.jpg");

			//publication_iptc_add($id,$_SERVER["DOCUMENT_ROOT"].$vp);
			
			copy($_SERVER["DOCUMENT_ROOT"].$vp,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb_original.jpg");
	
			@unlink($_SERVER["DOCUMENT_ROOT"].$vp);
		
		}
	}
//End. Upload photo preview and reads IPTC







//Upload zip preview
if(strtolower($nf[count($nf)-1])=="zip"  and !preg_match("/text/i",$_FILES["preview2"]['type']))
{
	if($_FILES["preview2"]['size']>0 and $_FILES["preview2"]['size']<2048*1024)
	{
		move_uploaded_file($_FILES["preview2"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/temp.".$nf[count($nf)-1]);
		publication_zip_preview(site_root.$site_servers[$server_id]."/".$folder."/temp.".$nf[count($nf)-1]);
	}
}
}
//End Upload zip preview



//Upload a file for sale
$sql="select * from vector_types order by priority";
$ds->open($sql);
while(!$ds->eof)
{
	if($ds->row["shipped"]!=1)
	{
		$flag=false;
		$uphoto=explode(",",str_replace(" ","",$ds->row["types"]));
		$_FILES["vector_sale".$ds->row["id_parent"]]['name']=result_file($_FILES["vector_sale".$ds->row["id_parent"]]['name']);
		$nf=explode(".",$_FILES["vector_sale".$ds->row["id_parent"]]['name']);
		
		for($i=0;$i<count($uphoto);$i++)
		{
			if(strtolower($uphoto[$i])==strtolower($nf[count($nf)-1])){$flag=true;}
		}
		
		if(preg_match("/text/i",$_FILES["vector_sale".$ds->row["id_parent"]]['type']))
		{
			$flag=false;
		}

		if($_FILES["vector_sale".$ds->row["id_parent"]]['size']>0 and $_FILES["vector_sale".$ds->row["id_parent"]]['size']<1024*1024*$lvector)
		{
			if($flag==true)
			{
				$vectorpath=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["vector_sale".$ds->row["id_parent"]]['name'];
				move_uploaded_file($_FILES["vector_sale".$ds->row["id_parent"]]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$vectorpath);
				$swait=true;

				$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
				$rs->open($sql);
				if($rs->eof)
				{
					$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','".result($_FILES["vector_sale".$ds->row["id_parent"]]['name'])."',".floatval($_POST["vector_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",0,".$ds->row["id_parent"].")";
					$db->execute($sql);
				}
				else
				{
					$sql="update items set name='".$ds->row["title"]."',url='".result($_FILES["vector_sale".$ds->row["id_parent"]]['name'])."',price=".floatval($_POST["vector_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
					$db->execute($sql);
				}
			}
		}
	}
	else
	{
		if(isset($_POST["vector_chk".$ds->row["id_parent"]]))
		{
			$sql="select id,id_parent,url,name,price from items where id_parent=".$id." and price_id=".$ds->row["id_parent"];
			$rs->open($sql);
			if($rs->eof)
			{
				$sql="insert into items (id_parent,name,url,price,priority,shipped,price_id) values (".$id.",'".$ds->row["title"]."','',".floatval($_POST["vector_price".$ds->row["id_parent"]]).",".$ds->row["priority"].",1,".$ds->row["id_parent"].")";
				$db->execute($sql);
			}
			else
			{
				$sql="update items set name='".$ds->row["title"]."',url='',price=".floatval($_POST["vector_price".$ds->row["id_parent"]])." where id_parent=".$id." and price_id=".$ds->row["id_parent"];
				$db->execute($sql);
			}
		}
	}
$ds->movenext();
}





}
//End. The function uploads a vector.






//The function uploads a photo.
function publication_photo_upload($id)
{
global $_POST;
global $_FILES;
global $site_servers;
global $site_server_activ;
global $folder;
global $swait;
global $db;
global $ds;

$server_id=$site_server_activ;
$sql="select server1 from photos where id_parent=".(int)$id;
$ds->open($sql);
if(!$ds->eof)
{
	$server_id=$ds->row["server1"];
}

$photo="";

$_FILES["photo"]['name']=result_file($_FILES["photo"]['name']);


$flag=true;	
	
if(preg_match("/text/i",$_FILES["photo"]["type"]))
{
	$flag=false;
}

if(!preg_match("/\.jpg$|\.jpeg$/i",$_FILES["photo"]["name"]))
{
	$flag=false;
}

if($_FILES["photo"]["size"]>0)
{
	if($flag==true)
	{
		$photo=site_root.$site_servers[$server_id]."/".$folder."/".$_FILES["photo"]['name'];
		move_uploaded_file($_FILES["photo"]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].$photo);
		
		//If reupload
		$sql="update items set url='".$_FILES["photo"]['name']."' where id_parent=".$id;
		$db->execute($sql);
		
		$swait=true;
	}
}

if($photo!="")
{

	//create different dimensions
	publication_photo_sizes_add($id,$_FILES["photo"]['name'],false);

	//IPTC support
	if(isset($_POST["photo_iptc"]))
	{
	publication_iptc_add($id,$_SERVER["DOCUMENT_ROOT"].$photo);
	}
	
	//Create thumbs
	photo_resize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb1.jpg",1);

	photo_resize($_SERVER["DOCUMENT_ROOT"].$photo,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb2.jpg",2);

	publication_watermark_add($id,$_SERVER["DOCUMENT_ROOT"].site_root.$site_servers[$server_id]."/".$folder."/thumb2.jpg");

	
}

}
//End. The function uploads a photo.







//Search all included for the category
function get_included_publications($t_id)
{
global $db;
$dp = new TMySQLQuery;
$dp->connection = $db;
global $nlimit;
global $res_id;
global $res_module;
global $res_category;
global $res_photo;
global $res_video;
global $res_audio;
global $res_vector;

$sql="select id,module_table from structure where id_parent=".$t_id;
$dp->open($sql);
	while(!$dp->eof)
	{
	
		if($dp->row["module_table"]==34)
		{
			$res_id[]=$dp->row["id"];
			$res_module[]=$dp->row["module_table"];
			$res_category++;
		}
		
		if($dp->row["module_table"]==30)
		{
			$res_id[]=$dp->row["id"];
			$res_module[]=$dp->row["module_table"];
			$res_photo++;
		}
		
		if($dp->row["module_table"]==31)
		{
			$res_id[]=$dp->row["id"];
			$res_module[]=$dp->row["module_table"];
			$res_video++;
		}
		
		if($dp->row["module_table"]==52)
		{
			$res_id[]=$dp->row["id"];
			$res_module[]=$dp->row["module_table"];
			$res_audio++;
		}
		
		if($dp->row["module_table"]==53)
		{
			$res_id[]=$dp->row["id"];
			$res_module[]=$dp->row["module_table"];
			$res_vector++;
		}
	
		if($nlimit<10000)
		{
			get_included_publications($dp->row["id"]);
		}
		
		$nlimit++;
		$dp->movenext();
	}
}
//End. Search all included for the category






?>