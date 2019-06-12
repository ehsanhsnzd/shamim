<?



if(!isset($_SESSION["box_shopping_cart"]) or !isset($_SESSION["box_shopping_cart_lite"]))
{
	$box_shopping_cart=word_lang("empty shopping cart");
	$box_shopping_cart_lite=word_lang("empty shopping cart");
	$script_carts="";

	$cart_id=shopping_cart_id();
	$total=0;
	$quantity=0;

	$sql="select item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value from carts_content where id_parent=".$cart_id;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$box_shopping_cart="<table border=0 cellpadding=3 cellspacing=1 class='tborder'><tr><td class='theader'><span class='smalltext'><b>ID</b></span></td><td class=theader><span class=smalltext><b>".word_lang("item")."</b></td><td class=theader><span class=smalltext><b>".word_lang("price")."</b></td><td class=theader><span class=smalltext><b>".word_lang("qty")."</b></td></tr>";

		while(!$rs->eof)
		{
			if($script_carts!="")
			{
				$script_carts.=",";
				$script_photo.=",";
				$script_title.=",";
				$script_price.=",";
				$script_qty.=",";
				$script_url.=",";
				$script_id.=",";
				$script_remove.=",";
				$script_descr.=",";

				$input_carts.="||";
				$input_photo.="||";
				$input_title.="||";
				$input_price.="||";
				$input_qty.="||";
				$input_url.="||";
				$input_id.="||";
				$input_remove.="||";
				$input_descr.="||";

			}
			$script_remove.=0;
			$input_remove.=0;
			$script_descr.="' '";
			$input_descr.=" ";
			$script_carts.=$rs->row["publication_id"];
			$input_carts.=$rs->row["publication_id"];


		$sql="select id_parent,folder,title,server1 from vector where id_parent=".(int)$rs->row["publication_id"];
				$dr->open($sql);
				if(!$dr->eof)
				{
					$script_title.="'#".$rs->row["publication_id"]." ".$dr->row["title"]."'";
					$input_title.="#".$rs->row["publication_id"]." ".$dr->row["title"];
					$folder=$dr->row["folder"];
					$fl="vector";
					$server1=$dr->row["server1"];
					$script_photo.="'".show_preview($dr->row["id_parent"],"vector",1,1,$dr->row["server1"],$dr->row["folder"])."'";
					$input_photo.=show_preview($dr->row["id_parent"],"vector",1,1,$dr->row["server1"],$dr->row["folder"]);
				}

			if($rs->row["item_id"]>0)
			{
				$sql="select id,name,price,id_parent from items where id=".$rs->row["item_id"];
				$dr->open($sql);
				if(!$dr->eof)
				{
				    if($dr->row["price"]!=0){
				    $script_price.=$dr->row["price"];
                    $input_price.=$dr->row["price"];
                    }
					$script_qty.=$rs->row["quantity"];
					$script_url.="'".item_url($dr->row["id_parent"])."'";
					$script_id.=$rs->row["item_id"];


					$input_qty.=$rs->row["quantity"];
					$input_url.=item_url($dr->row["id_parent"]);
					$input_id.=$rs->row["item_id"];
					$box_shopping_cart.="<tr><td class='tcontent'><span class='smalltext'><a href='".item_url($dr->row["id_parent"])."'>".$dr->row["id_parent"]."</a></td><td class=tcontent><span class=smalltext>".$dr->row["name"]."</td><td class=tcontent><span class=smalltext><span class='price'>".float_opt($dr->row["price"],2,true)."</span></td><td class=tcontent><span class=smalltext>".$rs->row["quantity"]."</td></tr>";
					$total+=$dr->row["price"]*$rs->row["quantity"];
				}
			}

			if($rs->row["prints_id"]>0)
			{
				$sql="select id_parent,title,price,itemid from prints_items where id_parent=".$rs->row["prints_id"];
				$dn->open($sql);
				if(!$dn->eof)
				{
                    $script_title.="'#".$rs->row["publication_id"]." ".$dn->row["title"]."'";
                    $input_title.="#".$rs->row["publication_id"]." ".$dn->row["title"];
                    $folder=$dr->row["folder"];
                    $fl="photo";
                    $server1=$dr->row["server1"];
                    $script_photo.="'".show_preview($dr->row["id_parent"],"photo",1,1,$dr->row["server1"],$dr->row["folder"])."'";
                    $input_photo.=show_preview($dr->row["id_parent"],"photo",1,1,$dr->row["server1"],$dr->row["folder"]);

					$price=define_prints_price($dn->row["price"],$rs->row["option1_id"],$rs->row["option1_value"],$rs->row["option2_id"],$rs->row["option2_value"],$rs->row["option3_id"],$rs->row["option3_value"]);
                    $script_price.=$price;
                    $input_price.=$price;
					$box_shopping_cart.="<tr><td class='tcontent'><span class='smalltext'><a href='".item_url($dn->row["itemid"])."'>".$dn->row["itemid"]."</a></td><td  class=tcontent><span class=smalltext>".word_lang("prints").": ".$dn->row["title"]."</td><td  class=tcontent><span class=smalltext><span class='price'>".float_opt($price,2,true)."</span></td><td class=tcontent><span class=smalltext>".$rs->row["quantity"]."</td></tr>";
					$total+=$price*$rs->row["quantity"];
				}
			}

			$quantity+=$rs->row["quantity"];
			$rs->movenext();
		}

		$box_shopping_cart.="</table><div class=smalltext style='margin-top:5'><b>".word_lang("total").":</b> ".currency(1).float_opt($total,2,true)." ".currency(2)."</div><div style='margin-top:5'><a href='".site_root."/members/shopping_cart.php' class='o'><b>".word_lang("view shopping cart")."</b></a></div>";

		$box_shopping_cart_lite="<a href='".site_root."/members/shopping_cart.php'>".word_lang("shopping cart")."</a> ".$quantity." (".currency(1).float_opt($total,2,true)." ".currency(2).")" ;
	}

	$script_carts="<script>cart_mass=new Array();
	cart_mass = [".$script_carts."];
	cart_title=new Array();
	cart_title=[".$script_title."];
	cart_price=new Array();
	cart_price=[".$script_price."];
	cart_qty=new Array();
	cart_qty=[".$script_qty."];
	cart_url=new Array();
	cart_url=[".$script_url."];
	cart_photo=new Array();
	cart_photo=[".$script_photo."];
	cart_description=new Array();
	cart_description=[".$script_descr."];
	cart_remove=new Array();
	cart_remove=[".$script_remove."];
	cart_content_id=new Array();
	cart_content_id=[".$script_id."];
	</script>
	
	 
	
<input type='hidden' id='list_cart_mass' value='".$input_carts."'>
<input type='hidden' id='list_cart_title' value='".$input_title."'>
<input type='hidden' id='list_cart_price' value='".$input_price."'>
<input type='hidden' id='list_cart_qty' value='".$input_qty."'>
<input type='hidden' id='list_cart_url' value='".$input_url."'>
<input type='hidden' id='list_cart_photo' value='".$input_photo."'>
<input type='hidden' id='list_cart_description' value='".$input_descr."'>
<input type='hidden' id='list_cart_remove' value='".$input_remove."'>
<input type='hidden' id='list_cart_content_id' value='".$input_id."'>
	
	";




	$box_shopping_cart.=$script_carts;
	$box_shopping_cart_lite.=$script_carts;

	$_SESSION["box_shopping_cart"]=$box_shopping_cart;
	$_SESSION["box_shopping_cart_lite"]=$box_shopping_cart_lite;
}
else
{
	$box_shopping_cart=$_SESSION["box_shopping_cart"];
	$box_shopping_cart_lite=$_SESSION["box_shopping_cart_lite"];
}
?>
