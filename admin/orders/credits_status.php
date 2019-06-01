<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("orders_credits");
?>

<?include("../../members/JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);


$id=(int)@$_REQUEST['id'];
$doc=@$_REQUEST['doc'];

$sql="select approved,id_parent from credits_list where id_parent=".$id;
$rs->open($sql);
if(!$rs->eof)
{
if($rs->row["approved"]==1)
{
$sql="update credits_list set approved=0 where id_parent=".$id;
$db->execute($sql);
affiliate_delete_commission($id,"credits");
?>
<a href="javascript:doLoad2(<?=$rs->row["id_parent"]?>);" class="red"><?=word_lang("pending")?></a>
<?
}
else
{
credits_approve($id,"");
send_notification('credits_to_user',$id);
send_notification('credits_to_admin',$id);

?>
<a href="javascript:doLoad2(<?=$rs->row["id_parent"]?>);"><?=word_lang("approved")?></a>
<?


}
}


?>