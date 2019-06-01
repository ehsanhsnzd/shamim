<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);

$title="";
$price="";
$publication_title="";
$prints_options=array();


if((int)@$_REQUEST['id']>0)
{
	//Files
	$params["item_id"]=(int)@$_REQUEST['id'];
	$params["prints_id"]=0;

	
	$sql="select id_parent,name,price from items where id=".$params["item_id"];
	$dr->open($sql);
	if(!$dr->eof)
	{
		$params["publication_id"]=$dr->row["id_parent"];
		$title=$dr->row["name"];
		$price=$dr->row["price"];
	}
}
else
{
	//Prints
	$params["prints_id"]=-1*@$_REQUEST['id'];
	$params["item_id"]=0;
	
	$sql="select itemid,title,price,printsid from prints_items where id_parent=".$params["prints_id"];
	$dr->open($sql);
	if(!$dr->eof)
	{
		$params["publication_id"]=$dr->row["itemid"];
		$title=$dr->row["title"];
		$price=$dr->row["price"];
		
		$sql="select option1,option2,option3 from prints where id_parent=".$dr->row["printsid"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$prints_options[]=(int)$ds->row["option1"];
			$prints_options[]=(int)$ds->row["option2"];
			$prints_options[]=(int)$ds->row["option3"];
		}
	}
}

$sql="select name from structure where id=".$params["publication_id"];
$dr->open($sql);
if(!$dr->eof)
{
	$publication_title=$dr->row["name"];
}


$params["quantity"]=1;
$params["option1_id"]=0;
$params["option2_id"]=0;
$params["option3_id"]=0;
$params["option1_value"]="";
$params["option2_value"]="";
$params["option3_value"]="";

$cart_id=shopping_cart_add($params);



$cart_content=file_get_contents($_SERVER["DOCUMENT_ROOT"].site_root."/".$site_template_url."shopping_cart.tpl");

//Show thumb
$size_result=define_thumb_size($params["publication_id"]);
$cart_content=str_replace("{IMAGE}",$size_result["thumb"],$cart_content);
$cart_content=str_replace("{WIDTH}",$size_result["width"],$cart_content);
$cart_content=str_replace("{HEIGHT}",$size_result["height"],$cart_content);

$cart_content=str_replace("{PUBLICATION_TITLE}",$publication_title,$cart_content);
$cart_content=str_replace("{TITLE}",$title,$cart_content);
$cart_content=str_replace("{ID}",$params["publication_id"],$cart_content);
$cart_content=str_replace("{ITEM_ID}",$params["item_id"],$cart_content);
$cart_content=str_replace("{PRINTS_ID}",$params["prints_id"],$cart_content);
$cart_content=str_replace("{PRICE}",currency(1).float_opt($price,2)." ".currency(2),$cart_content);



$prints_content="";
for($i=0;$i<count($prints_options);$i++)
{
	if($prints_options[$i]!=0)
	{
		//Default meaning
		$option_default="";
		$sql="select option".($i+1)."_value from carts_content where id_parent=".$cart_id." and prints_id=".$params["prints_id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$option_default=$ds->row["option".($i+1)."_value"];
		}
		
		$sql="select title,type,activ,required from products_options where activ=1 and id=".$prints_options[$i];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$prints_content.="<div class='param'><b>".$dr->row["title"].":</b><br>";
			
			if($dr->row["type"]=="selectform")
			{
				$prints_content.="<select name='option".$prints_options[$i]."' style='width:150px'>";
			}
			
			$sql="select id,title,price,adjust from products_options_items where id_parent=".$prints_options[$i]." order by id";
			$ds->open($sql);
			while(!$ds->eof)
			{
				$sel="";
				$sel2="";
				
				if($option_default==$ds->row["title"])
				{
					$sel="selected";	
				}
				$sel2="checked";
				
				if($dr->row["type"]=="selectform")
				{
					$prints_content.="<option value='".$ds->row["title"]."' ".$sel.">".$ds->row["title"]."</option>";
				}
				if($dr->row["type"]=="radio")
				{
					$prints_content.="<input name='option".$prints_options[$i]."' type='radio' value='".$ds->row["title"]."' ".$sel2.">&nbsp;".$ds->row["title"]."&nbsp;&nbsp;";
				}
				
				$ds->movenext();
			}
			
			if($dr->row["type"]=="selectform")
			{
				$prints_content.="</select>";
			}
			
			$prints_content.="</div>";
		}
	}
}


$sql="select id from carts_content where id_parent=".$cart_id." and item_id=".$params["item_id"]." and prints_id=".$params["prints_id"];
$ds->open($sql);$sql2=$sql;
if(!$ds->eof)
{
	$cart_content=str_replace("{CONTENT_ID}",$ds->row["id"],$cart_content);
}

$cart_content=str_replace("{PRINTS_OPTIONS}",$prints_content,$cart_content);
$cart_content=str_replace("{SITE_ROOT}",site_root,$cart_content);
$cart_content=translate_text($cart_content);

unset($_SESSION["box_shopping_cart"]);
unset($_SESSION["box_shopping_cart_lite"]);

include("shopping_cart_add_content.php");
$GLOBALS['_RESULT'] = array(
  "box_shopping_cart"     => $box_shopping_cart,
  "box_shopping_cart_lite"     => $box_shopping_cart_lite,
  "cart_content"     => $cart_content
); 

?>