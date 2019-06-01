<?$site="user";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>




<?include("user_top.php");?>






<?
if(isset($user_id))
{
$sql="select id_parent,description from users where id_parent=".(int)$user_id;
$rs->open($sql);
if(!$rs->eof)
{
echo(str_replace("\n","<br>",$rs->row["description"]));

}
}
?>














<?include("user_bottom.php");?>






















<?include("../inc/footer.php");?>