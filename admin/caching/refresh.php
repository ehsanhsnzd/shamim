<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("templates_caching");


if($_GET["id"]==1)
{
$smarty->clear_cache(null,"header");
}

if($_GET["id"]==2)
{
$smarty->clear_cache(null,"footer");
}

if($_GET["id"]==3)
{
$smarty->clear_cache(null,"home");
}

if($_GET["id"]==4)
{
$smarty->clear_cache(null,"item");
}

if($_GET["id"]==0)
{
$smarty->clear_all_cache();
}


header("location:index.php");
?>