<?$site="billing";$site2="";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<?include("profile_top.php");?>
<?include("payments_settings.php");?>

<?
if(isset($_GET["type"]))
{
	$_SESSION["billing_type"]=$_GET["type"];
}

if(isset($_POST["credits"]))
{
	$_SESSION["billing_id"]=(int)$_POST["credits"];
}

if(isset($_POST["subscription"]))
{
	$_SESSION["billing_id"]=(int)$_POST["subscription"];
}
?>


<h1><?=word_lang("buy ".result($_SESSION["billing_type"]))?></h1>

<div class="login_header">

<div style="float:right;">[ <a href="<?=result($_SESSION["billing_type"])?>.php?d=1"><?=word_lang("change")?></a> ]</div>	

<h2 style="margin-top:30px"><?=word_lang("order")?></h2></div>

<?include("billing_content.php");?>


<?
if(!isset($_SESSION["coupon_code"]))
{
	?>
	<div class="login_header" style="margin-top:30px"><h2><?=word_lang("coupon")?></h2></div>

	<?
	if(isset($_GET["coupon"]))
	{
		echo("<p><b>Error. The coupon doesn't exist.</b></p>");
	}
	?>

<!--	<div class="form_field" id="coupon_field">-->
<!--	<form method="post" action="billing_coupon.php">-->
<!--	--><?//=word_lang("code")?><!--:&nbsp;&nbsp;-->
<!--	<input type="text" name="coupon" style="width:150px" class="ibox">-->
<!--	<input type="submit" value="Ok" class="isubmit">-->
<!--	</form>-->
<!--	</div>-->
<?
}
?>
	

	

<div class="login_header"><h2 style="margin-top:50px"><?=word_lang("billing address")?></h2></div>

<?
$sql="select name,lastname,address,city,zipcode,country from users where id_parent=".(int)$_SESSION["people_id"];
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
}
?>




<form method="post"  Enctype="multipart/form-data"  action="billing2.php">



<div class="form_field">
<span><?=word_lang("first name")?></b></span>
<input class="ibox" type="text" name="billing_firstname" value="<?=$_SESSION["billing_firstname"]?>" style="width:400px">
</div>

<div class="form_field">
<span><?=word_lang("last name")?></b></span>
<input class="ibox" type="text" name="billing_lastname" value="<?=$_SESSION["billing_lastname"]?>" style="width:400px">
</div>

<div class="form_field">
<span><?=word_lang("city")?></b></span>
<input class="ibox" type="text" name="billing_city" value="<?=$_SESSION["billing_city"]?>" style="width:400px">
</div>

<div class="form_field">
<span><?=word_lang("country")?></b></span>
<select name="billing_country" style="width:400px;" class="ibox"><option value=""></option>
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
<span><?=word_lang("zipcode")?></b></span>
<input class="ibox" type="text" name="billing_zip" value="<?=$_SESSION["billing_zip"]?>" style="width:400px">
</div>

<div class="form_field">
<span><?=word_lang("address")?></b></span>
<textarea class="ibox" name="billing_address" style="width:400px;height:100px"><?=$_SESSION["billing_address"]?></textarea>
</div>
    <br>
<input class="isubmit" type="submit" value="<?=word_lang("next step")?>" style="margin-top:30px">
</form>






<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>