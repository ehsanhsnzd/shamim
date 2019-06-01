<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?

$sql="select title,user from blog_categories where title='".result3($_POST["category"])."' and user='".result($_SESSION["people_login"])."'";
$rs->open($sql);
if($rs->eof)
{
	$sql="insert into blog_categories (title,user) values ('".result3($_POST["category"])."','".result($_SESSION["people_login"])."')";
	$db->execute($sql);
}

header("location:blog_categories.php");
?>