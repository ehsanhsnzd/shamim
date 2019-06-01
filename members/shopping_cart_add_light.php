<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);





$id_parent=(int)@$_REQUEST['id'];



$id=0;
$sql="select id from items where id_parent=".$id_parent." order by price";
$dr->open($sql);
if(!$dr->eof)
{
	$id=$dr->row["id"];
}
//if($site_printsonly)
//{
	$sql="select id_parent from prints_items where itemid=".$id_parent." order by price";
	$dr->open($sql);
	if(!$dr->eof)
	{
        $params["prints_id"]=$dr->row["id_parent"];
	}else{
        $params["prints_id"]=0;
    }
//}


if(!$site_printsonly)
{
	//Files
	$params["item_id"]=$id;
//	$params["prints_id"]=0;
}
else
{
	//Prints
	$params["prints_id"]=$id;
	$params["item_id"]=0;
}

$params["publication_id"]=$id_parent;
$params["quantity"]=1;
$params["option1_id"]=0;
$params["option2_id"]=0;
$params["option3_id"]=0;
$params["option1_value"]="";
$params["option2_value"]="";
$params["option3_value"]="";

shopping_cart_add($params);







unset($_SESSION["box_shopping_cart"]);
unset($_SESSION["box_shopping_cart_lite"]);



include("shopping_cart_add_content.php");
$GLOBALS['_RESULT'] = array(
  "box_shopping_cart"     => $box_shopping_cart,
  "box_shopping_cart_lite"     => $box_shopping_cart_lite,
); 
?>