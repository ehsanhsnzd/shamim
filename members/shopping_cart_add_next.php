<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);

$params["option1_id"]=0;
$params["option2_id"]=0;
$params["option3_id"]=0;
$params["option1_value"]="";
$params["option2_value"]="";
$params["option3_value"]="";

$content_id=(int)@$_REQUEST['content_id'];


if(@$_REQUEST['item_id']!=0)
{
	//Files
	$params["item_id"]=(int)@$_REQUEST['item_id'];
	$params["prints_id"]=0;

	
	$sql="select id_parent from items where id=".$params["item_id"];
	$dr->open($sql);
	if(!$dr->eof)
	{
		$params["publication_id"]=$dr->row["id_parent"];
	}
}


if(@$_REQUEST['prints_id']!=0)
{
	//Prints
	$params["prints_id"]=(int)@$_REQUEST['prints_id'];
	$params["item_id"]=0;
	
	$sql="select itemid,title,price,printsid from prints_items where id_parent=".$params["prints_id"];
	$dr->open($sql);
	if(!$dr->eof)
	{
		$params["publication_id"]=$dr->row["itemid"];
		
		$sql="select option1,option2,option3 from prints where id_parent=".$dr->row["printsid"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$params["option1_id"]=(int)$ds->row["option1"];
			$params["option2_id"]=(int)$ds->row["option2"];
			$params["option3_id"]=(int)$ds->row["option3"];
			
			if($params["option1_id"]!=0 and isset($_REQUEST["option".$params["option1_id"]]))
			{
				$params["option1_value"]=result($_REQUEST["option".$params["option1_id"]]);
			}
			if($params["option2_id"]!=0 and isset($_REQUEST["option".$params["option2_id"]]))
			{
				$params["option2_value"]=result($_REQUEST["option".$params["option2_id"]]);
			}
			if($params["option3_id"]!=0 and isset($_REQUEST["option".$params["option3_id"]]))
			{
				$params["option3_value"]=result($_REQUEST["option".$params["option3_id"]]);
			}
		}
	}
}




$cart_id=shopping_cart_id();

$sql="update carts_content set option1_id=".$params["option1_id"].",option1_value='".$params["option1_value"]."',option2_id=".$params["option2_id"].",option2_value='".$params["option2_value"]."',option3_id=".$params["option3_id"].",option3_value='".$params["option3_value"]."' where id_parent=".$cart_id." and item_id=".$params["item_id"]." and prints_id=".$params["prints_id"]." and id=".$content_id;
$db->execute($sql);

unset($_SESSION["box_shopping_cart"]);
unset($_SESSION["box_shopping_cart_lite"]);


echo("ok");
?>