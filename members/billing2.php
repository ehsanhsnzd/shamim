<?$site="billing";$site2="";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<?include("profile_top.php");?>
<?include("payments_settings.php");?>

<?
foreach ($_POST as $key => $value)
{
	if(preg_match("/billing/",$key))
	{
		$_SESSION[$key]=$value;
	}
}
?>


<h1><?=word_lang("buy ".result($_SESSION["billing_type"]))?></h1>

<div class="login_header">

<div style="float:right;">[ <a href="<?=result($_SESSION["billing_type"])?>.php?d=1"><?=word_lang("change")?></a> ]</div>	

<h2 style="margin-top:30px"><?=word_lang("order")?></h2></div>

<?
include("billing_content.php");
?>
	
	
<div class="login_header">
<h2 style="margin-top:30px"><?=word_lang("select payment method")?></h2>
</div>

<form method="post" action="billing3.php">

<?if($_SESSION["billing_type"]=="credits"){?>
<input type="hidden" name="credits" value="<?=$_SESSION["billing_id"]?>">
<?}?>
<?if($_SESSION["billing_type"]=="subscription"){?>
<input type="hidden" name="subscription" value="<?=$_SESSION["billing_id"]?>">
<?}?>


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



<table border="0" cellpadding="0" cellspacing="0" class="profile_table" width="100%">
<tr>
<th width="50"></th>
<th><b><?=word_lang("payments")?>:</b></th>
</tr>
<?
$sel=false;


foreach ($payments as $key => $value) 
{
	$t="site_".strtolower($key)."_account";
	$tt=$$t;
	if($tt!="" and $key!="fortumo")
	{
	?>
	<tr>
	<td align="center" width="50"><input name="payment" type="radio" value="<?=$key?>" <?if($sel==false){echo("checked");}?> onClick="show_additional_fields('<?=$key?>')">
	</td>
	<td>
	<?=$value?>
	<?
	if($key=="qiwi")
	{
		?>
		<div id="qiwi_telephone" style="display:<?if($sel==false){echo("block");}else{echo("none");}?>;margin-top:5px;"><b><?=word_lang("telephone")?></b> <small>(Example: 9061234560)</small><br><input type="text" name="telephone" value="" class="ibox" style="width:150px;margin-top:2px;"></div>
		<?
	}
	?>
	<?
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
	?>
	</td>
	</tr>
	<?
	$sel=true;
	}
}

?>


<?if($site_moneyorder==true){?>
<tr>
<td align="center"><input name="payment" type="radio" value="moneyorder" <?if($sel==false){echo("checked");}?> onClick="show_additional_fields('moneyorder')"></td>
<td><?=word_lang("check or money order")?></td>
</tr>
<?$sel=true;}?>
</table>
<input type="hidden" name="tip" value="<?=$_SESSION["billing_type"]?>">
<input class='isubmit' type="submit" value="<?=word_lang("next step")?>" style="margin-top:30px">

</form>



<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>