<??>

<h1><?=word_lang("purchase statement")?></h1>
<?
if(isset($_GET["product_id"]) and isset($_GET["product_type"]) and (isset($_SESSION["people_id"]) or isset($_SESSION["entry_admin"])))
{
	$flag=false;
	$billing_info= array();
	$shipping_info= array();
	$order_info=array();

	$user_sql="";
	if(isset($_SESSION["people_id"]) and !isset($_SESSION["entry_admin"]))
	{
		if($_GET["product_type"]=="order")
		{
			$user_sql=" user=".(int)$_SESSION["people_id"]." and ";
		}
		if($_GET["product_type"]=="credits")
		{
			$user_sql=" user='".result($_SESSION["people_login"])."' and ";
		}
		if($_GET["product_type"]=="subscription")
		{
			$user_sql=" user='".result($_SESSION["people_login"])."' and ";
		}
	}


	if($_GET["product_type"]=="order")
	{


		$sql="select id,shipping_firstname,shipping_lastname,shipping_address,shipping_country,shipping_city,shipping_zip,billing_firstname,billing_lastname,billing_address,billing_country,billing_city,billing_zip,user,total,data from orders where ".$user_sql." id=".(int)$_GET["product_id"];
		$rs->open($sql);
		if(!$rs->eof)
		{
			$flag=true;

			$order_info["id"]=$rs->row["id"];
			$order_info["user"]=user_url_back($rs->row["user"]);
			$order_info["name"]=word_lang("order");
			$order_info["total"]=$rs->row["total"];
			$order_info["date"]=date(date_short,$rs->row["data"]);

			$billing_info["billing_firstname"]=$rs->row["billing_firstname"];
			$billing_info["billing_lastname"]=$rs->row["billing_lastname"];
			$billing_info["billing_address"]=$rs->row["billing_address"];
			$billing_info["billing_country"]=$rs->row["billing_country"];
			$billing_info["billing_city"]=$rs->row["billing_city"];
			$billing_info["billing_zip"]=$rs->row["billing_zip"];

			$shipping_info["shipping_firstname"]=$rs->row["shipping_firstname"];
			$shipping_info["shipping_lastname"]=$rs->row["shipping_lastname"];
			$shipping_info["shipping_address"]=$rs->row["shipping_address"];
			$shipping_info["shipping_country"]=$rs->row["shipping_country"];
			$shipping_info["shipping_city"]=$rs->row["shipping_city"];
			$shipping_info["shipping_zip"]=$rs->row["shipping_zip"];
		}
	}
	if($_GET["product_type"]=="credits")
	{
		$sql="select id_parent,billing_firstname,billing_lastname,billing_address,billing_country,billing_city,billing_zip,title,user,data,total  from credits_list where ".$user_sql." id_parent=".(int)$_GET["product_id"];
		$rs->open($sql);
		if(!$rs->eof)
		{
			$flag=true;

			$order_info["id"]=$rs->row["id_parent"];
			$order_info["user"]=$rs->row["user"];
			$order_info["name"]=word_lang("credits").": ".$rs->row["title"];
			$order_info["total"]=$rs->row["total"];
			$order_info["date"]=date(date_short,$rs->row["data"]);

			$billing_info["billing_firstname"]=$rs->row["billing_firstname"];
			$billing_info["billing_lastname"]=$rs->row["billing_lastname"];
			$billing_info["billing_address"]=$rs->row["billing_address"];
			$billing_info["billing_country"]=$rs->row["billing_country"];
			$billing_info["billing_city"]=$rs->row["billing_city"];
			$billing_info["billing_zip"]=$rs->row["billing_zip"];

			$shipping_info["shipping_firstname"]="";
			$shipping_info["shipping_lastname"]="";
			$shipping_info["shipping_address"]="";
			$shipping_info["shipping_country"]="";
			$shipping_info["shipping_city"]="";
			$shipping_info["shipping_zip"]="";
		}
	}
	if($_GET["product_type"]=="subscription")
	{
		$sql="select id_parent,billing_firstname,billing_lastname,billing_address,billing_country,billing_city,billing_zip,title,user,data1,total from subscription_list where ".$user_sql." id_parent=".(int)$_GET["product_id"];
		$rs->open($sql);
		if(!$rs->eof)
		{
			$flag=true;

			$order_info["id"]=$rs->row["id_parent"];
			$order_info["user"]=$rs->row["user"];
			$order_info["name"]=word_lang("subscription").": ".$rs->row["title"];
			$order_info["total"]=$rs->row["total"];
			$order_info["date"]=date(date_short,$rs->row["data1"]);

			$billing_info["billing_firstname"]=$rs->row["billing_firstname"];
			$billing_info["billing_lastname"]=$rs->row["billing_lastname"];
			$billing_info["billing_address"]=$rs->row["billing_address"];
			$billing_info["billing_country"]=$rs->row["billing_country"];
			$billing_info["billing_city"]=$rs->row["billing_city"];
			$billing_info["billing_zip"]=$rs->row["billing_zip"];

			$shipping_info["shipping_firstname"]="";
			$shipping_info["shipping_lastname"]="";
			$shipping_info["shipping_address"]="";
			$shipping_info["shipping_country"]="";
			$shipping_info["shipping_city"]="";
			$shipping_info["shipping_zip"]="";
		}
	}

	if($flag)
	{
		?>

		<?
		if(!isset($_GET["print"]))
		{
			?>
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%;margin-bottom:30px">
			<tr>
			<td width="33%">
			<h2><?=$site_name?></h2>
			</td>
			<td style="width:33%">
			<?=str_replace("\n","<br>",$global_settings["company_address"])?>
			</td>
			<td width="33%">
			</td>
			</tr>
			</table>
			<?
		}
		?>



		<table border="0" cellpadding="0" cellspacing="0" class="payment_table">
		<tr valign="top">
		<th><?=word_lang("billing information")?></th>
		<th><?=word_lang("payment information")?></th>
		<th><?=word_lang("order information")?></th>
		</tr>

		<tr valign="top">
		<td>
			<table border="0" cellpadding="0" cellspacing="0" class="payment_table2">
			<tr>
			<td><b><?=word_lang("name")?>:</b></td>
			<td><?=$billing_info["billing_firstname"]?> <?=$billing_info["billing_lastname"]?></td>
			</tr>

			<tr>
			<td><b><?=word_lang("address")?>:</b	></td>
			<td>
			<?
			if($billing_info["billing_address"]!="")
			{
				echo($billing_info["billing_address"]."<br>");
			}
			if($billing_info["billing_city"]!="" or $billing_info["billing_zip"]!="" or $billing_info["billing_country"]!="")
			{
				echo($billing_info["billing_city"]." ".$billing_info["billing_zip"].", ".$billing_info["billing_country"]."<br>");
			}
			?>
			</td>
			</tr>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" class="payment_table2">
			<?
			$sql="select id_parent,user,data,total,ip,tnumber,ptype,pid,processor from payments where pid=".(int)$_GET["product_id"];
			$rs->open($sql);
			if(!$rs->eof)
			{
				?>
				<tr>
				<td><b><?=word_lang("type")?>:</b></td>
				<td>
				<?
				if(isset($payments[$rs->row["processor"]]))
				{
					echo($payments[$rs->row["processor"]]);
				}
				else
				{
					if($rs->row["processor"]=="moneyorder")
					{
						echo(word_lang("check or money order"));
					}
				}
				?>
				</td>
				</tr>
				<?
				if($rs->row["tnumber"]!="")
				{
					?>
					<tr>
					<td><b><?=word_lang("transaction id")?>:</b></td>
					<td><?=$rs->row["tnumber"]?></td>
					</tr>
					<?
				}
			}
			?>
			<tr>
			<td><b><?=word_lang("total")?>:</b></td>
			<td>
			<?
			if($_GET["product_type"]=="subscription" or $_GET["product_type"]=="credits" or (!$site_credits and $_GET["product_type"]=="order"))
			{
				echo(currency(1,false).float_opt($order_info["total"],2)." ".currency(2,false));
			}
			else
			{
				echo(currency(1,true).float_opt($order_info["total"],2)." ".currency(2,true));
			}
			?>
			</td>
			</tr>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" class="payment_table2">
			<tr>
			<td><b><?=word_lang("login")?>:</b></td>
			<td><?=$order_info["user"]?></td>
			</tr>
			<tr>
			<td><b><?=word_lang("order")?> ID:</b></td>
			<td><?=$order_info["id"]?></td>
			</tr>
			<tr>
			<td><b><?=word_lang("title")?>:</b></td>
			<td><?=$order_info["name"]?></td>
			</tr>
			<tr>
			<td><b><?=word_lang("date")?>:</b></td>
			<td><?=$order_info["date"]?></td>
			</tr>
			</table>
		</td>
		</tr>
		</table>

		<?
	}
?>
<br><br>
<h2><?=word_lang("order")?></h2>
<?=show_order_content($_GET["product_type"],$_GET["product_id"])?>
<?
}
?>

