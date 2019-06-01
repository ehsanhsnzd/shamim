<? include("function/db.php");?>
<?
//Check access

?>

<?include("../members/JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);


$id=(int)@$_REQUEST['id'];
$doc=@$_REQUEST['doc'];

$sql="select approved,id_parent from subscription_list where id_parent=".$id;
$rs->open($sql);
if(!$rs->eof)
{
if($rs->row["approved"]==1)
{
$sql="update subscription_list set approved=0 where id_parent=".$id;
$db->execute($sql);

?>
<a href="javascript:doLoad3(<?=$rs->row["id_parent"]?>);" class="red"><?=word_lang("pending")?></a>
<?
}
else
{
    $sql="update subscription_list set approved=1 where id_parent=".$id;
    $db->execute($sql);

?>
<a href="javascript:doLoad3(<?=$rs->row["id_parent"]?>);"><?=word_lang("approved")?></a>
<?


}
}

?>