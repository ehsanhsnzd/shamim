<?
include("../admin/function/db.php");
include("JsHttpRequest.php");

$JsHttpRequest =new JsHttpRequest($mtg);
$id_parent=(int)$_REQUEST["id_parent"];

include("content_list_vars.php");
include("content_list_items.php");
	
//Show result
if(!$flag_empty)
{
	echo($search_content);
}
?>