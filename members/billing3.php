<?$site="billing";$site2="";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<?include("profile_top.php");?>
<?include("payments_settings.php");?>

<?
if(isset($_POST["payment"]))
{
	$_SESSION["billing_payment"]=result($_POST["payment"]);
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

<div style="float:right;">[ <a href="billing.php"><?=word_lang("change")?></a> ]</div>

<h2 style="margin-top:30px"><?=word_lang("billing address")?></h2>
</div>

<p>
<?
			if($_SESSION["billing_firstname"]!="" or $_SESSION["billing_lastname"]!="")
			{
				echo($_SESSION["billing_firstname"]." ".$_SESSION["billing_lastname"]."<br>");
			}
			if($_SESSION["billing_address"]!="")
			{
				echo($_SESSION["billing_address"]."<br>");
			}
			if($_SESSION["billing_city"]!="" or $_SESSION["billing_zip"]!="" or $_SESSION["billing_country"]!="")
			{
				echo($_SESSION["billing_city"]." ".$_SESSION["billing_zip"].", ".$_SESSION["billing_country"]."<br>");
			}
			?>
</p>


<div class="login_header">

<div style="float:right;">[ <a href="billing2.php"><?=word_lang("change")?></a> ]</div>


<h2 style="margin-top:30px"><?=word_lang("Payment gateways")?></h2>
</div>

<p>
<?
if(isset($payments[$_SESSION["billing_payment"]]))
{
	echo($payments[$_SESSION["billing_payment"]]);
}
else
{
	if($_SESSION["billing_payment"]=="moneyorder")
	{
		echo(word_lang("check or money order"));
	}
}
?>
</p>


<form method="post" action="payments_process.php">

<?if($_SESSION["billing_type"]=="credits"){?>
<input type="hidden" name="credits" value="<?=$_SESSION["billing_id"]?>">
<?}?>
<?if($_SESSION["billing_type"]=="subscription"){?>
<input type="hidden" name="subscription" value="<?=$_SESSION["billing_id"]?>">
<?}?>

<input type="hidden" name="payment" value="<?=$_SESSION["billing_payment"]?>">

<input type="hidden" name="tip" value="<?=$_SESSION["billing_type"]?>">


<?if(isset($_POST["telephone"])){?>
<input type="hidden" name="telephone" value="<?=result($_POST["telephone"])?>">
<?}?>

<?if(isset($_POST["moneyua_method"])){?>
<input type="hidden" name="moneyua_method" value="<?=result($_POST["moneyua_method"])?>">
<?}?>

    <div class="alert-warning" >
        <button onclick="$('.alert-warning').hide()" type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
        <strong>پرداخت</strong> لطفا مبلغ مورد نظر را پرداخت کنید
    </div>

<input class='isubmit' type="submit" value="<?=word_lang("buy")?>" style="margin-top:30px">

</form>




<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>