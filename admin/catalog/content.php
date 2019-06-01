<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("catalog_catalog");
?>
<? include("../inc/begin.php");?>
<? include("../function/show.php");?>
<? include("../function/upload.php");?>


<?
//If the item is new
$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}

//Get type
$type="photo";
if(isset($_GET["type"]))
{
	$type=result($_GET["type"]);
}


if(isset($_GET["id"]))
{
	$sql="select module_table from structure where id=".(int)$_GET["id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		if($rs->row["module_table"]==30){$type="photo";}
		if($rs->row["module_table"]==31){$type="video";}
		if($rs->row["module_table"]==52){$type="audio";}
		if($rs->row["module_table"]==53){$type="vector";}
	}
}


	//Fields list
	$admin_fields=array("select_category","category","category2","category3","title","description","keywords","author","file","data","published","featured","viewed","downloaded","free","content_type","model","adult");
	
	$admin_names=array(word_lang("select_category"),word_lang("category"),word_lang("category")." 2",word_lang("category")." 3",word_lang("title"),word_lang("description"),word_lang("keywords"),word_lang("author"),word_lang("file for sale"),word_lang("date"),word_lang("published"),word_lang("featured"),word_lang("viewed"),word_lang("downloads"),word_lang("free"),word_lang("content type"),word_lang("models"),word_lang("adult content"));

	//Fields meanings
	$admin_meanings=array("5","5","5","5","","","","","",mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")),"1","0","0","0","0",$site_content_type,"",0);

	//Fields types
	$admin_types=array("category","category","category","category","text","textarea","text","author","file","data","checkbox","checkbox","int","int","checkbox","content_type","model","checkbox");

if($type=="photo")
{
	$admin_fields[]="color";
	$admin_names[]=word_lang("color");
	$admin_meanings[]="";
	$admin_types[]="color";
	
	$admin_fields[]="editorial";
	$admin_names[]=word_lang("editorial");
	$admin_meanings[]="";
	$admin_types[]="checkbox";
}



if($type=="video")
{
	$admin_fields[]="duration";
	$admin_names[]=word_lang("duration");
	$admin_meanings[]=0;
	$admin_types[]="duration";
	
	$admin_fields[]="format";
	$admin_names[]=word_lang("clip format");
	$admin_meanings[]="";
	$admin_types[]="format";
	
	$admin_fields[]="ratio";
	$admin_names[]=word_lang("Aspect Ratio");
	$admin_meanings[]="";
	$admin_types[]="ratio";
	
	$admin_fields[]="rendering";
	$admin_names[]=word_lang("Field Rendering");
	$admin_meanings[]="";
	$admin_types[]="rendering";
	
	$admin_fields[]="frames";
	$admin_names[]=word_lang("Frames per Second");
	$admin_meanings[]="";
	$admin_types[]="frames";
	
	$admin_fields[]="holder";
	$admin_names[]=word_lang("Copyright Holder");
	$admin_meanings[]="";
	$admin_types[]="text";
	
	$admin_fields[]="usa";
	$admin_names[]=word_lang("U.S. 2257 Information");
	$admin_meanings[]="";
	$admin_types[]="text";
}


if($type=="audio")
{
	$admin_fields[]="duration";
	$admin_names[]=word_lang("duration");
	$admin_meanings[]=0;
	$admin_types[]="duration";
	
	$admin_fields[]="source";
	$admin_names[]=word_lang("Track Source");
	$admin_meanings[]="";
	$admin_types[]="source";
	
	$admin_fields[]="format";
	$admin_names[]=word_lang("Track Format");
	$admin_meanings[]="";
	$admin_types[]="track_format";
	
	
	$admin_fields[]="holder";
	$admin_names[]=word_lang("Copyright Holder");
	$admin_meanings[]="";
	$admin_types[]="text";
	
}

if($type=="vector")
{

	if($site_flash)
	{
	$admin_fields[]="flash_version";
	$admin_names[]="Flash ".word_lang("version");
	$admin_meanings[]="";
	$admin_types[]="text";
	
	$admin_fields[]="script_version";
	$admin_names[]="Script ".word_lang("version");
	$admin_meanings[]="";
	$admin_types[]="text";
	
	$admin_fields[]="flash_width";
	$admin_names[]="Flash ".word_lang("width");
	$admin_meanings[]="0";
	$admin_types[]="int";
	

	$admin_fields[]="flash_height";
	$admin_names[]="Flash ".word_lang("height");
	$admin_meanings[]="0";
	$admin_types[]="int";
	}
	
}

if($site_google)
{
	$admin_fields[]="google_x";
	$admin_names[]=word_lang("Google coordinate X");
	$admin_meanings[]=0;
	$admin_types[]="float";
	
	$admin_fields[]="google_y";
	$admin_names[]=word_lang("Google coordinate Y");
	$admin_meanings[]=0;
	$admin_types[]="float";	
}


//If it isn't a new item
if($id!=0)
{
	//Get parent category
	$sql="select id_parent from structure where id=".$id;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$admin_meanings[0]=$rs->row["id_parent"];
	}

	//Get field's meanings
	if($type=="photo")
	{
		$sql = "select category2,category3,title,description,keywords,author,data,published,featured,viewed,downloaded,free,content_type,model,google_x,google_y,color,editorial,adult from photos where id_parent=".(int)$_GET["id"];
	}
	if($type=="video")
	{
		$sql = "select category2,category3,title,description,keywords,author,data,published,featured,viewed,downloaded,free,content_type,model,duration,format,ratio,rendering,frames,holder,usa,google_x,google_y,adult from videos where id_parent=".(int)$_GET["id"];
	}
	if($type=="audio")
	{
		$sql = "select category2,category3,title,description,keywords,author,data,published,featured,viewed,downloaded,free,content_type,model,duration,source,format,holder,google_x,google_y,adult from audio where id_parent=".(int)$_GET["id"];
	}
	if($type=="vector")
	{
		$sql = "select category2,category3,title,description,keywords,author,data,published,featured,viewed,downloaded,free,content_type,model,flash_version,script_version,flash_width,flash_height,google_x,google_y,adult from vector where id_parent=".(int)$_GET["id"];
	}
	$rs->open($sql);
	if(!$rs->eof)
	{
		for($i=1;$i<count($admin_fields);$i++)
		{
			if($admin_fields[$i]!="file")
			{
				$admin_meanings[$i]=$rs->row[$admin_fields[$i]];
			}
		}
	}
}


//Category's list
$itg="";
$nlimit=0;
buildmenufirst2(5,$admin_meanings[0],2,$id);
$admin_meanings[0]=$itg;

$itg="";
$nlimit=0;
buildmenu2($_GET['first_cat'],$admin_meanings[1],2,$id);
$admin_meanings[1]=$itg;

$itg="";
$nlimit=0;
buildmenu2($_GET['first_cat'],$admin_meanings[2],2,$id);
$admin_meanings[2]=$itg;

$itg="";
$nlimit=0;
buildmenu2($_GET['first_cat'],$admin_meanings[3],2,$id);
$admin_meanings[3]=$itg;

 
 
 
?>

<div class="back"><a href="index.php" class="btn btn-mini"><i class="icon-arrow-left"></i> <?=word_lang("back")?></a></div>


<h1><?
if($id==0)
{
	echo(word_lang("add")." ");
}
else
{
	echo(word_lang("edit")." ");
}

	if($type=="photo")
	{
	echo(word_lang("photo"));
	}
	if($type=="video")
	{
	echo(word_lang("video"));
	}
	if($type=="audio")
	{
	echo(word_lang("audio"));
	}
	if($type=="vector")
	{
	echo(word_lang("vector"));
	}


//upload limits:
$lvideo="UNLIMITED ";
$lpreviewvideo="UNLIMITED ";
$laudio="UNLIMITED ";
$lpreviewaudio="UNLIMITED ";
$lvector="UNLIMITED ";

//File form for photos
$file_form=true;

?>:</h1>

<?=build_admin_form("add.php?id=".$id,$type)?>









<? include("../inc/end.php");?>