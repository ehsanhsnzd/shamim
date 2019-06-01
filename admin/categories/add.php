<?  include("../function/db.php");?>
<? include("../function/upload.php");?>
<? if(isset($_POST['submitcat']))
{
	$first_cat=$_POST['select_category'];
	 redirect_file("content.php?first_cat=$first_cat",$swait);
}else{
//Check access
admin_panel_access("catalog_categories");

//If the category is new
$id=0;
if(isset($_GET["id"])){$id=(int)$_GET["id"];}

$swait=add_update_category($id,0,0,0);

$smarty->clear_cache(null,"buildmenu");
if($id!=0)
{
	category_url($id);
}
redirect_file("content.php",$swait);
}

?>