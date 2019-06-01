<?if(!defined("site_root")){exit();}?>



<script type="text/javascript" language="JavaScript">


function change_address(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById(value+'_text').innerHTML =req.responseText;
apanel(value,2)

        }
    }

    req.open(null, '<?=site_root?>/members/checkout_address.php', true);
    req.send( {'form': document.getElementById("f"+value) } );
}


function show_shipping(value)
{
	if(value==0)
	{
		$("#shipping_form").slideDown("slow");
	}
	else
	{
		$("#shipping_form").slideUp("slow");
	}
}



function check_country(value)
{
	var req = new JsHttpRequest();
   	req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('states_'+value).innerHTML =req.responseText;
        }
    }
    req.open(null, 'states.php', true);
    req.send( {country: document.getElementById(value+"_country").value,state:  document.getElementById(value+"_state").value,type:value} );
}

function check_field(value) 
{

}

function change_total(value,value2)
{
	var req = new JsHttpRequest();
   	req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById("total_block").innerHTML =req.responseJS.total;	
			document.getElementById("shipping_block").innerHTML =req.responseJS.shipping;	
			document.getElementById("taxes_block").innerHTML =req.responseJS.taxes;	
        }
    }
    req.open(null, 'checkout_shipping.php', true);
    req.send( {shipping:value,type:value2} );
}


function check_shipping()
{
	flag_shipping=true;
	
	address_mass=new Array("firstname","lastname","country","city","zip","address");
	
	
	for(i=0;i<address_mass.length;i++)
	{
		if($("#billing_"+address_mass[i]).val()=="")
		{
			$("#billing_"+address_mass[i]).addClass("ibox_error");
			flag_shipping=false;
		}
		else
		{
			$("#billing_"+address_mass[i]).removeClass("ibox_error");
		}
		
		if($("#thesame2").attr('checked'))
		{
			if($("#shipping_"+address_mass[i]).val()=="")
			{
				$("#shipping_"+address_mass[i]).addClass("ibox_error");
				flag_shipping=false;
			}
			else
			{
				$("#shipping_"+address_mass[i]).removeClass("ibox_error");
			}
		}
	}
	
	if(flag_shipping==false)
	{
		$(window).scrollTo(300,1000, {axis:'y'} );
		$('#order_now').attr('disabled',true);
	}
	else
	{
		$('#order_now').attr('disabled',false);
	}
	
	return flag_shipping;
}
</script>






<?
$checkout_page="<table border='0' cellpadding='0' cellspacing='0' style='width:100%;margin-top:20px'>
<tr valign='top'>
<td style='width:75%'>{RESULTS}</td>
<td style='padding-left:20px'>{MENU}</td>
</tr>
</table>";

if(file_exists($DOCUMENT_ROOT."/".$site_template_url."checkout.tpl"))
{
	$checkout_page=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."checkout.tpl");
}

$checkout_page=str_replace("{MENU}","{SEPARATOR}",$checkout_page);
$checkout_page=str_replace("{RESULTS}","{SEPARATOR}",$checkout_page);

$checkout_parts=explode("{SEPARATOR}",$checkout_page);

$checkout_header=$checkout_parts[0];
$checkout_middle=@$checkout_parts[1];
$checkout_footer=@$checkout_parts[2];







$product_subtotal=0;
$product_shipping=0;
$product_tax=0;
$product_discount=0;
$product_total=0;
$weight=0;
$quantity=0;
$flag_shipping=false;


$cart_id=shopping_cart_id();


if(!isset($_SESSION["checkout_steps"]))
{
	$_SESSION["checkout_steps"]=1;
}

if(!isset($_SESSION["shipping_thesame"]))
{
	$_SESSION["shipping_thesame"]=1;
}


	//Billing and Shipping address
	$sql="select name,lastname,address,city,zipcode,country,state from users where id_parent=".(int)$_SESSION["people_id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		if(!isset($_SESSION["billing_firstname"]))
		{
			$_SESSION["billing_firstname"]=$rs->row["name"];
		}

		if(!isset($_SESSION["billing_lastname"]))
		{
			$_SESSION["billing_lastname"]=$rs->row["lastname"];
		}

		if(!isset($_SESSION["billing_address"]))
		{
			$_SESSION["billing_address"]=$rs->row["address"];
		}

		if(!isset($_SESSION["billing_city"]))
		{
			$_SESSION["billing_city"]=$rs->row["city"];
		}

		if(!isset($_SESSION["billing_zip"]))
		{
			$_SESSION["billing_zip"]=$rs->row["zipcode"];
		}

		if(!isset($_SESSION["billing_country"]))
		{
			$_SESSION["billing_country"]=$rs->row["country"];
		}
		
		if(!isset($_SESSION["billing_state"]))
		{
			$_SESSION["billing_state"]=$rs->row["state"];
		}

		if(!isset($_SESSION["shipping_firstname"]))
		{
			$_SESSION["shipping_firstname"]=$rs->row["name"];
		}

		if(!isset($_SESSION["shipping_lastname"]))
		{
			$_SESSION["shipping_lastname"]=$rs->row["lastname"];
		}

		if(!isset($_SESSION["shipping_address"]))
		{
			$_SESSION["shipping_address"]=$rs->row["address"];
		}

		if(!isset($_SESSION["shipping_city"]))
		{
			$_SESSION["shipping_city"]=$rs->row["city"];
		}

		if(!isset($_SESSION["shipping_zip"]))
		{
			$_SESSION["shipping_zip"]=$rs->row["zipcode"];
		}

		if(!isset($_SESSION["shipping_country"]))
		{
			$_SESSION["shipping_country"]=$rs->row["country"];
		}
		
		if(!isset($_SESSION["shipping_state"]))
		{
			$_SESSION["shipping_state"]=$rs->row["state"];
		}


$items_list="";
$sql="select id,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value from carts_content where id_parent=".$cart_id;
$dq->open($sql);
while(!$dq->eof)
{
	if($items_list!="")
	{
		$items_list.="<div class='checkout_line'></div>";
	}
	
	//Download items
	if($dq->row["item_id"]>0)
	{
		$sql="select id,name,price,id_parent,url,shipped from items where id=".$dq->row["item_id"];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$items_list.="<div class='checkout_list'><a href='".item_url($dr->row["id_parent"])."'><b>#".$dr->row["id_parent"]." &mdash; ".word_lang("file").": ".$dr->row["name"]."</b></a><div style='margin-top:3px'>
			".$dq->row["quantity"]." x ".currency(1).float_opt($dr->row["price"],2)." ".currency(2)."</div></div>";
			
			if($dr->row["shipped"]==1)
			{
				$weight+=$global_settings["cd_weight"];
				$flag_shipping=true;
				$quantity++;
			}
			$product_subtotal+=$dr->row["price"]*$dq->row["quantity"];
		}
	}

	//Prints items
	if($dq->row["prints_id"]>0)
	{
		$sql="select id_parent,title,price,itemid,printsid from prints_items where id_parent=".$dq->row["prints_id"];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$price=define_prints_price($dr->row["price"],$dq->row["option1_id"],$dq->row["option1_value"],$dq->row["option2_id"],$dq->row["option2_value"],$dq->row["option3_id"],$dq->row["option3_value"]);
			

			$items_list.="<div class='checkout_list'><div><a href='".item_url($dr->row["itemid"])."'><b>#".$dr->row["itemid"]." &mdash; ".word_lang("prints and products").":  ".$dr->row["title"]."</b></a></div>
			<span class='gr'>";

			for($i=1;$i<4;$i++)
			{
				if($dq->row["option".$i."_id"]!=0 and $dq->row["option".$i."_value"]!="")
				{
					$sql="select title from products_options where id=".$dq->row["option".$i."_id"];
					$ds->open($sql);
					if(!$ds->eof)
					{
						$items_list.=$ds->row["title"].": ".$dq->row["option".$i."_value"].". ";
					}
				}
			}

			$items_list.="</span>
			<div style='margin-top:3px'>".$dq->row["quantity"]." x ".currency(1).float_opt($price,2)." ".currency(2)."</div></div>";

			$sql="select weight from prints where id_parent=".$dr->row["printsid"];
			$ds->open($sql);
			if(!$ds->eof)
			{
				$weight+=$ds->row["weight"];
				$flag_shipping=true;
			}
			$product_subtotal+=$price*$dq->row["quantity"];
			$quantity+=$dq->row["quantity"];
		}
	}
	
	$dq->movenext();
}









//Discount
$discount_text="";
if(isset($_SESSION["coupon_code"]) and  !$site_credits)
{
	$discount_info=array();
	order_discount_calculate($_SESSION["coupon_code"],$product_subtotal);
	$product_discount=$discount_info["total"];
	$discount_text=$discount_info["text"];
}

//Shipping
$product_shipping=0;
$product_shipping_type=0;

$shipping_list="";
	
if($flag_shipping)
{
	$sql="select id,title,shipping_time,methods,methods_calculation,taxes,regions from shipping where activ=1 and weight_min<=".$weight." and weight_max>=".$weight."  order by title";
	$dr->open($sql);
	while(!$dr->eof)
	{
		$shipping=0;
		
		//Check regions
		$flag_regions=false;
		if($dr->row["regions"]==0)
		{
			$flag_regions=true;
		}
		else
		{
			$sql="select country,state from shipping_regions where id_parent=".$dr->row["id"]." and country='".result($_SESSION["shipping_country"])."'";
			$ds->open($sql);
			while(!$ds->eof)
			{
				if($ds->row["state"]=="")
				{
					$flag_regions=true;
				}
				else
				{
					if($ds->row["state"]==$_SESSION["shipping_state"])
					{
						$flag_regions=true;
					}
				}
				$ds->movenext();
			}
		}
		
		//Calculate
		if($flag_regions)
		{
			if($dr->row["methods"]=="weight")
			{
				$sql="select price from shipping_ranges where from_param<=".$weight." and to_param>=".$weight." and id_parent=".$dr->row["id"]." order by from_param";
			}
			if($dr->row["methods"]=="quantity")
			{
				$sql="select price from shipping_ranges where from_param<=".$quantity." and to_param>=".$quantity." and id_parent=".$dr->row["id"]." order by from_param";
			}
			if($dr->row["methods"]=="subtotal")
			{
				$sql="select price from shipping_ranges where from_param<=".$product_subtotal." and to_param>=".$product_subtotal." and id_parent=".$dr->row["id"]." order by from_param";
			}
			if($dr->row["methods"]=="flatrate")
			{
				$sql="select price from shipping_ranges where id_parent=".$dr->row["id"];
			}
			
			$ds->open($sql);
			if(!$ds->eof)
			{
				if($dr->row["methods_calculation"]=="percent")
				{
					$shipping=$ds->row["price"]*$product_subtotal/100;
				}
				if($dr->row["methods_calculation"]=="currency")
				{
					$shipping=$ds->row["price"];
				}
			}
			
			if($dr->row["taxes"]==1)
			{
				$word_taxes=" - ".word_lang("taxable");
			}
			else
			{
				$word_taxes="";
			}
			
			$shipping_list.="<div style='margin-bottom:3px'><input onClick=\"change_total(this.value,".$dr->row["id"].")\" checked name='shipping_type'  type='radio' value='".$shipping."'>".currency(1).float_opt($shipping,2)." ".currency(2)." &mdash; ".$dr->row["title"]." (".$dr->row["shipping_time"].")".$word_taxes."</div>";
			$product_shipping=$shipping;
			$product_shipping_type=$dr->row["id"];
		}
		$dr->movenext();
	}
}

$flag_shipping_taxable=false;

$sql="select taxes from shipping where id=".$product_shipping_type;
$dr->open($sql);
if(!$dr->eof)
{
	if($dr->row["taxes"]==1)
	{
		$flag_shipping_taxable=true;
	}
}
//End. Shipping



//Taxes rates
$taxes_info=array();
if(!$site_credits)
{
	if($flag_shipping_taxable)
	{
		order_taxes_calculate($product_subtotal+$product_shipping,false,"order");
	}
	else
	{
		order_taxes_calculate($product_subtotal,false,"order");
	}
	$taxes_text="(".$taxes_info["text"].")";
	$product_tax=$taxes_info["total"];
}
else
{
	$taxes_info["total"]=0;
	$taxes_info["included"]=0;
	$taxes_info["text"]="";
}




//Count product total
$product_total=$product_subtotal+$product_shipping+$product_tax*$taxes_info["included"]-$product_discount;


$_SESSION["product_total"]=$product_total;
$_SESSION["product_subtotal"]=$product_subtotal;
$_SESSION["product_shipping"]=$product_shipping;
$_SESSION["product_shipping_type"]=$product_shipping_type;
$_SESSION["product_tax"]=$product_tax;
$_SESSION["product_discount"]=$product_discount;
$_SESSION["weight"]=$weight;


$total_list="";

$total_list.="<tr><td style='padding-bottom:6px'><b>".word_lang("subtotal").":</b></td><td>".currency(1).float_opt($product_subtotal,2)." ".currency(2)."</td></tr></tr>";

if(!$site_credits)
{
	$total_list.="<tr><td style='padding-bottom:6px'><b>".word_lang("discount").$discount_text.":</b></td><td>".currency(1).float_opt($product_discount,2)." ".currency(2)."</td></tr>";
}

$total_list.="<tr><td style='padding-bottom:6px'><b>".word_lang("shipping").":</b></td><td><div id='shipping_block'>".currency(1).float_opt($product_shipping,2)." ".currency(2)."</div></td></tr>";

if(!$site_credits)
{
	$total_list.="<tr><td style='padding-bottom:6px'><b>".word_lang("taxes")." ".$taxes_text.":</b></td><td><div id='taxes_block'>".currency(1).float_opt($product_tax,2)." ".currency(2)."</div></td></tr>";
}



$flag_continue=true;


//if Credits banance isn't sufficient
if($site_credits)
{
	$balance=credits_balance();
	if($balance<$product_total)
	{
		?>
		<p><b><?=word_lang("balance")?>:</b> <span class="price"><?=currency(1)?><?=float_opt($balance-$product_total,2)?> <?=currency(2)?></span></p>
		<input type="button" class="isubmit" value="<?=word_lang("buy credits")?>" onClick="location.href='../users/payment.php?amount=<?=$product_total?>'">
		<?
		$flag_continue=false;
	}
}
//End. if Credits banance isn't sufficient








	
	
	//Place order
if($flag_continue)
{


	echo($checkout_header);
	?>
	
	

<div class="checkoutbox"><?=word_lang("billing and shipping address")?></div>
<div class="checkoutbox_text">

	
<form method="post" action="checkout_address.php" style="margin:0px" <?if($flag_shipping){?>onsubmit="return check_shipping();"<?}?>>	
	<table border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
		<div id="billing_form" name="billing_form" style="display:block;">
		
			<div class='login_header'><h2><?=word_lang("billing address")?>:</h2></div>

			<div class="form_field">
			<span><?=word_lang("first name")?></span>
			<input class="ibox" type="text" name="billing_firstname"  id="billing_firstname" value="<?=$_SESSION["billing_firstname"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("last name")?></b></span>
			<input class="ibox" type="text" id="billing_lastname" name="billing_lastname" value="<?=$_SESSION["billing_lastname"]?>" style="width:300px">
			</div>



			<div class="form_field">
			<span><?=word_lang("country")?></b></span>
			<select name="billing_country" id="billing_country" style="width:310px;" class="ibox" onChange="check_country('billing');"><option value=""></option>
			<?
			for($i=0;$i<count($mcountry);$i++)
			{
				$sel="";
				if($mcountry[$i]==$_SESSION["billing_country"]){$sel="selected";}
				?>
				<option value="<?=$mcountry[$i]?>" <?=$sel?>><?=$mcountry[$i]?></option>
			<?
			}
			?>
			</select>
			</div>
			
			<div class="form_field">
			<span><?=word_lang("state")?></b></span>
			<div id="states_billing">
				<input type="text" name="billing_state" id="billing_state" style="width:310px" value="<?=$_SESSION["billing_state"]?>" class="ibox">
			</div>
			<script>
				check_country('billing');
			</script>
			</div>
			
			<div class="form_field">
			<span><?=word_lang("city")?></b></span>
			<input class="ibox" type="text" name="billing_city" id="billing_city" value="<?=$_SESSION["billing_city"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("zipcode")?></b></span>
			<input class="ibox" type="text" name="billing_zip" id="billing_zip" value="<?=$_SESSION["billing_zip"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("address")?></b></span>
			<textarea class="ibox" name="billing_address" id="billing_address" style="width:300px;height:30px"><?=$_SESSION["billing_address"]?></textarea>
			</div>
		<?if($flag_shipping){?>
			<div class="form_field">
			<span><b><?=word_lang("billing and shipping address are the same")?>:</b></span>
			<input name="thesame" id="thesame1" type="radio" value="1" <?if($_SESSION["shipping_thesame"]==1){echo("checked");}?> onClick="show_shipping(this.value)">&nbsp;<?=word_lang("yes")?>&nbsp;&nbsp;&nbsp;<input name="thesame" id="thesame2" type="radio" value="0" onClick="show_shipping(this.value)" <?if($_SESSION["shipping_thesame"]==0){echo("checked");}?>>&nbsp;<?=word_lang("no")?>
			</div>
		<?}?>

		</div>
		</td>
		<td style="padding-left:150px">
	<?if($flag_shipping){?>
		<div id="shipping_form" name="shipping_form" style="display:<?if($_SESSION["shipping_thesame"]==1){echo("none");}else{echo("block");}?>;">
			<div class='login_header'><h2><?=word_lang("shipping address")?>:</h2></div>

			<div class="form_field">
			<span><?=word_lang("first name")?></span>
			<input class="ibox" type="text" name="shipping_firstname"  id="shipping_firstname" value="<?=$_SESSION["shipping_firstname"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("first name")?></span>
			<input class="ibox" type="text" name="shipping_lastname" id="shipping_lastname" value="<?=$_SESSION["shipping_lastname"]?>" style="width:300px">
			</div>

			

			<div class="form_field">
			<span><?=word_lang("country")?></b></span>
			<select name="shipping_country" id="shipping_country" style="width:310px;" class="ibox" onChange="check_country('shipping');"><option value=""></option>
			<?
			for($i=0;$i<count($mcountry);$i++)
			{
				$sel="";
				if($mcountry[$i]==$_SESSION["shipping_country"]){$sel="selected";}
				?>
				<option value="<?=$mcountry[$i]?>" <?=$sel?>><?=$mcountry[$i]?></option>
			<?
			}
			?>
			</select>
			</div>
			
			<div class="form_field">
			<span><?=word_lang("state")?></b></span>
			<div id="states_shipping">
				<input type="text" name="shipping_state" id="shipping_state" style="width:310px" value="<?=$_SESSION["shipping_state"]?>" class="ibox">
			</div>
			<script>
				check_country('shipping');
			</script>
			</div>
			
			<div class="form_field">
			<span><?=word_lang("city")?></span>
			<input class="ibox" type="text" name="shipping_city" type="text" id="shipping_city" value="<?=$_SESSION["shipping_city"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("zipcode")?></span>
			<input class="ibox" type="text" name="shipping_zip"  id="shipping_zip" value="<?=$_SESSION["shipping_zip"]?>" style="width:300px">
			</div>

			<div class="form_field">
			<span><?=word_lang("address")?></span>
			<textarea class="ibox" name="shipping_address" id="shipping_address" style="width:300px;height:30px"><?=$_SESSION["shipping_address"]?></textarea>
			</div>

		</div>
		<?}?>
		</td>
		</tr>
		</table>
<?
if($_SESSION["checkout_steps"]==1)
{
	?>		
	<input type="submit" class="isubmit" value="<?=word_lang("next step")?>">
	<?
}
else
{
	?>		
	<input type="submit" value="<?=word_lang("change")?>">
	<?
}
?>
</form>
</div>

<?
if($_SESSION["checkout_steps"]>1)
{
	if($flag_shipping)
	{
		?>
		<div class="checkoutbox"><?=word_lang("shipping")?></div>
		<div class="checkoutbox_text">
			<?=$shipping_list?>
		</div>
		<?
	}

?>
<form method="post" action="orders_add.php" style="margin:0px" <?if($flag_shipping){?>onsubmit="return check_shipping();"<?}?>>
	<?
	//Payment gateway
	if(!$site_credits)
	{
		include("payments_settings.php");
		?>
		<div class="checkoutbox"><?=word_lang("select payment method")?></div>
		<div class="checkoutbox_text">

		<script>
		function show_additional_fields(x)
		{
			<?
			if($site_qiwi_account!="")
			{
			?>
				if(x=="qiwi")
				{
					$("#qiwi_telephone").slideDown("slow");
				}
				else
				{
					$("#qiwi_telephone").slideUp("slow");
				}
			<?
			}
			?>
			<?
			if($site_moneyua_account!="")
			{
			?>
				if(x=="moneyua")
				{
					$("#moneyua_method").slideDown("slow");
				}
				else
				{
					$("#moneyua_method").slideUp("slow");
				}
			<?
			}
			?>
		}
		</script>
		

		<?
		$sel=false;

		foreach ($payments as $key => $value) 
		{
			$t="site_".strtolower($key)."_account";
			$tt=$$t;
			if($tt!="" and $key!="fortumo")
			{
				?>
				<div style="margin-bottom:3px"><input name="payment" type="radio" value="<?=$key?>" <?if($sel==false){echo("checked");}?> onClick="show_additional_fields('<?=$key?>')">&nbsp;<?=$value?></div>
				<?
				if($key=="qiwi")
				{
				?>
					<div id="qiwi_telephone" style="display:<?if($sel==false){echo("block");}else{echo("none");}?>;margin-top:5px;margin-left:25px"><b><?=word_lang("telephone")?></b> <small>(Example: 9061234560)</small><br><input type="text" name="telephone" value="" class="ibox" style="width:150px;margin-top:2px;"></div>
				<?
				}

				if($key=="moneyua")
				{
					?>
					<div id="moneyua_method" style="display:<?if($sel==false){echo("block");}else{echo("none");}?>;margin-top:5px;">
						<select name="moneyua_method" style="width:200px;" class="ibox">
							<option value="16">VISA/MASTER Card</option>
							<option value="1">wmz</option>
							<option value="2">wmr</option>
							<option value="3">wmu</option>
							<option value="5">Yandex.Money</option>
							<option value="9">nsmep</option>
							<option value="14">Terminals</option>
							<option value="15">liqpay-USD</option>
							<option value="16">liqpay-UAH</option>
							<option value="17">Privat24-UAH</option>
							<option value="18">Privat24-USD</option>
						</select>
					</div>
					<?
				}
				$sel=true;
			}
		}

	?>


		<?if($site_moneyorder==true){?>
		<div>
			<input name="payment" type="radio" value="moneyorder" 	<?if($sel==false){echo("checked");}?> onClick="show_additional_fields('moneyorder')">&nbsp;<?=word_lang("check or money order")?>
		</div>
		<?$sel=true;}?>
		</div>
		<?
	}
	?>
	

	
<input type="submit" id="order_now" class="add_to_cart" value="<?=word_lang("order now")?>">
</form>
<?
}

echo($checkout_middle);
?>




<div class="checkoutbox2">
	<div class="checkoutbox2_title">
		<?=word_lang("order total")?>
	</div>
	<div class="checkoutbox2_text">
		<div class="checkout_list">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<?=$total_list?>
			</table>
		</div>
		<div class="checkout_list">
		<?
		if(!isset($_SESSION["coupon_code"]) and !$site_credits)
		{
			if(isset($_GET["coupon"]))
			{
				echo("<p><b>Error. The coupon doesn't exist.</b></p>");
			}
			?>
			<div id="coupon_field">
				<form method="post" action="checkout_coupon.php" style="margin:0px">
					<input type="text" name="coupon" style="width:150px" class="ibox" value="<?=word_lang("coupon")?>" onClick="this.value=''">
					<input type="submit" value="Ok" class="isubmit">
				</form>
			</div>
			<?
		}
		?>
		</div>
		
		<div class="checkoutbox2_bottom">
			<div id="total_block">
				<b><?=word_lang("total")?>:</b> <span class="price"><b><?=currency(1).float_opt($product_total,2)." ".currency(2)?></b></span>
			</div>
		</div>
		
	</div>
</div>

<div class="checkoutbox2">
	<div class="checkoutbox2_title">
		<?=word_lang("items")?>
	</div>
	<div class="checkoutbox2_text">
		<?=$items_list?>
		
		<div class="checkoutbox2_bottom">
			<a href="shopping_cart.php"><?=word_lang("change")?></a>
		</div>
	</div>

</div>

<div class="checkoutbox2">
	<div class="checkoutbox2_title">
		<?=word_lang("order information")?>
	</div>
	<div class="checkoutbox2_text">
		<div class="checkout_list">
			<b><?=word_lang("billing address")?>:</b><br>
			<?
			if($_SESSION["billing_firstname"]!="" or $_SESSION["billing_lastname"]!="")
			{
				echo(word_lang("name").": ".$_SESSION["billing_firstname"]." ".$_SESSION["billing_lastname"]."<br>");
			}
			if($_SESSION["billing_country"]!="")
			{
				echo(word_lang("country").": ".$_SESSION["billing_country"]."<br>");
			}
			if($_SESSION["billing_state"]!="")
			{
				echo(word_lang("state").": ".$_SESSION["billing_state"]."<br>");
			}
			if($_SESSION["billing_city"]!="")
			{
				echo(word_lang("city").": ".$_SESSION["billing_city"]."<br>");
			}
			if($_SESSION["billing_zip"]!="")
			{
				echo(word_lang("zipcode").": ".$_SESSION["billing_zip"]."<br>");
			}
			if($_SESSION["billing_address"]!="")
			{
				echo(word_lang("address").": ".$_SESSION["billing_address"]."<br>");
			}
			?>
		</div>
		<?if($flag_shipping){?>
		<div class="checkout_line"></div>
		<div class="checkout_list">	
			<b><?=word_lang("shipping address")?>:</b><br>
			<?
			if($_SESSION["shipping_firstname"]!="" or $_SESSION["shipping_lastname"]!="")
			{
				echo(word_lang("name").": ".$_SESSION["shipping_firstname"]." ".$_SESSION["shipping_lastname"]."<br>");
			}
			if($_SESSION["shipping_country"]!="")
			{
				echo(word_lang("country").": ".$_SESSION["shipping_country"]."<br>");
			}
			if($_SESSION["shipping_state"]!="")
			{
				echo(word_lang("state").": ".$_SESSION["shipping_state"]."<br>");
			}
			if($_SESSION["shipping_city"]!="")
			{
				echo(word_lang("city").": ".$_SESSION["shipping_city"]."<br>");
			}
			if($_SESSION["shipping_zip"]!="")
			{
				echo(word_lang("zipcode").": ".$_SESSION["shipping_zip"]."<br>");
			}
			if($_SESSION["shipping_address"]!="")
			{
				echo(word_lang("address").": ".$_SESSION["shipping_address"]."<br>");
			}
			?>
		</div>
		<?}?>
	</div>
</div>

	
	
	
	
	
	
	
	
	
	

	

	<?
	echo($checkout_footer);
}
}
?>

