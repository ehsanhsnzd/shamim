<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_sellercategories");
?>
<? include("../inc/begin.php");?>
<? include("../function/show.php");?>
<? include("../function/upload.php");?>


<?
//If it is new
$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}


//Fields list
$admin_fields=array("name","priority","category","upload","upload2","upload3","upload4","menu","blog","percentage","photolimit","videolimit","previewvideolimit","audiolimit","previewaudiolimit","vectorlimit");

$admin_names=array(word_lang("title"),word_lang("priority"),word_lang("Allow to create category"),word_lang("Allow to upload photo"),word_lang("Allow to upload video"),word_lang("Allow to upload audio"),word_lang("Allow to upload vector"),word_lang("Show in menu"),word_lang("Blog"),word_lang("Percentage of sale to site owner"),word_lang("Upload photo limit (Mb)"),word_lang("Upload video limit (Mb)"),word_lang("Upload preview video limit"),word_lang("Upload audio limit (Mb)"),word_lang("Upload preview audio limit"),word_lang("Upload vector limit (Mb)"));

//Fields meanings
$admin_meanings=array("","1","1","1","1","1","1","0","0","50","10","10","10","10","10","10");

//Fields types
$admin_types=array("text","int","checkbox","checkbox","checkbox","checkbox","checkbox","checkbox","checkbox","int","int","int","int","int","int","int","int");




//If it isn't a new category
if($id!=0)
{
	//Get field's meanings
	$sql = "select name,priority,category,upload,upload2,upload3,upload4,menu,blog,percentage,photolimit,videolimit,previewvideolimit,audiolimit,previewaudiolimit,vectorlimit from user_category where id_parent=".(int)$_GET["id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		for($i=0;$i<count($admin_fields);$i++)
		{
			$admin_meanings[$i]=$rs->row[$admin_fields[$i]];
		}
	}
}


?>

<div class="back"><a href="index.php" class="btn btn-mini"><i class="icon-arrow-left"></i> <?=word_lang("back")?></a></div>


<h1><?
if($id==0)
{
echo(word_lang("add")." &mdash; ".word_lang("customer categories"));
}
else
{
echo(word_lang("edit")." &mdash; ".word_lang("customer categories"));
}
?>:</h1>

<?=build_admin_form("add.php?id=".$id,"catalog")?>

<? include("../inc/end.php");?>