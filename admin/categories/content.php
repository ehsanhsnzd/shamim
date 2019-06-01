<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("catalog_categories");
?>
<? include("../inc/begin.php");?>
<? include("../function/show.php");?>
<? include("../function/upload.php");?>


<?
//If the category is new
$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}


//Fields list
$admin_fields=array("select_category","category","title","priority","password","description","photo","upload","published");

$admin_names=array(word_lang("select_category"),word_lang("category"),word_lang("title"),word_lang("priority"),word_lang("password"),word_lang("description"),word_lang("preview"),word_lang("upload"),word_lang("published"));

//Fields meanings
$admin_meanings=array("5","5","","0","","","","1","1");

//Fields types
$admin_types=array("category","category","text","int","text","textarea","file","checkbox","checkbox");




//If it isn't a new category
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
	$sql = "select title,priority,password,description,photo,upload,published from category where id_parent=".(int)$_GET["id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		for($i=1;$i<count($admin_fields);$i++)
		{
			$admin_meanings[$i]=$rs->row[$admin_fields[$i]];
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
?>

<div class="back"><a href="index.php" class="btn btn-mini"><i class="icon-arrow-left"></i> <?=word_lang("back")?></a></div>


<h1><?
if($id==0)
{
echo(word_lang("add category"));
}
else
{
echo(word_lang("edit"));
}
?>:</h1>

<?=build_admin_form("add.php?id=".$id,"category")?>

<? include("../inc/end.php");?>