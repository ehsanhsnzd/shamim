<?if(!defined("site_root")){exit();}?>


<?
if(isset($_GET["d"]))
{
	if($_GET["d"]==1)
	{
		echo("<p class='error'>".word_lang("serror1")."</p>");
	}
	if($_GET["d"]==2)
	{
		echo("<p class='error'>".word_lang("serror2")."</p>");
	}
	if($_GET["d"]==3)
	{
		echo("<p class='ok'>".word_lang("serror3")."</p>");
	}
	if($_GET["d"]==4)
	{
		echo("<p class='error'>Error. Incorrect Captcha.</p>");
	}
}
?>


<?

$sql="select * from pages where link='signup'";
$rs->open($sql);
if(!$rs->eof)
{echo(translate_text($rs->row["content"]));}
?>


<script language="javascript">
function anketa(name,pole,nado)
{
	this.name=name;
	this.pole=pole;
	this.nado=nado;
}


ms=new Array(<?if($ss=="add"){?>new anketa('<?=word_lang("login")?>','login',true),<?}?>new anketa('<?=word_lang("password")?>','password',true),new anketa('<?=word_lang("confirm password")?>','password2',true),new anketa('<?=word_lang("first name")?>','name',true),new anketa('<?=word_lang("last name")?>','lastname',true),new anketa('<?=word_lang("telephone")?>','telephone',true),new anketa('<?=word_lang("country")?>','country',true),new anketa('<?=word_lang("e-mail")?>','email',true)<?if($ss=="add" and !$site_captcha){?>,new anketa('<?=word_lang("captcha")?>','rn1',true)<?}?>)


function check_field(value)
{
	if(document.getElementById(value).value=="")
	{
		document.getElementById(value).className = 'ibox_error';
		document.getElementById('error_'+value).innerHTML ="<span class='error'><?=word_lang("incorrect field")?></span>";
	}
	else
	{
		document.getElementById(value).className = 'ibox_ok';
		document.getElementById('error_'+value).innerHTML ="";
	}

	if(value=="country")
	{
		check_state(value);
	}
	if(value=="telephone")
	{
		checkLength(value);
	}
}

function checkLength(value) {
  if (document.getElementById(value).value.length != 11) {
    document.getElementById('error_'+value).innerHTML ="<span class='error'><?=word_lang("تلفن همراه نادرست است")?></span>";
	document.getElementById(value).className = 'ibox_error';
	document.getElementById('telephone_ok').value=-1
  }else
	{
		document.getElementById(value).className = 'ibox_ok';
		document.getElementById('error_'+value).innerHTML ="";
		document.getElementById('telephone_ok').value=1

	}
}

function check_state(value)
{
	var req = new JsHttpRequest();
   	req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('states_content').innerHTML =req.responseText;
        }
    }
    req.open(null, 'states.php', true);
    req.send( {country: document.getElementById(value).value,state:  document.getElementById('state').value} );
}


function check()
{

		flag=true;
		for(i=0;i<ms.length;i++)
		{
			if(ms[i].nado==true)
			{
				if(document.getElementById(ms[i].pole))
				{
					if(document.getElementById(ms[i].pole).value=="")
					{
						flag=false;
						check_field(ms[i].pole);
					}
				}
			}
		}

		if(document.getElementById('login_response').value==-1)
		{
			flag=false;
		}

		if(document.getElementById('email_ok').value==-1)
		{
			flag=false;
		}

		if(document.getElementById('telephone_ok').value==-1)
		{
			flag=false;
		}
	return flag;
}



function check_login(value)
{
    var req = new JsHttpRequest();
    req.onreadystatechange = function()
    {
    	if (req.readyState == 4)
   		{
			document.getElementById('error_login').innerHTML =req.responseText;

			if(req.responseText=="<span class='error'><?=word_lang("serror1")?></span>" || req.responseText=="<span class='error'><?=word_lang("incorrect field")?></span>")
			{
				document.getElementById('login_response').value=-1
				document.getElementById('login').className = 'ibox_error';
			}
			else
			{
				document.getElementById('login_response').value=1
				document.getElementById('login').className = 'ibox_ok';
			}
        }
    }
    req.open(null, 'check_login.php', true);
    req.send(  { login: value }  );
}



function check_email(value)
{
    var req = new JsHttpRequest();
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('error_email').innerHTML =req.responseText;
			if(req.responseText=="<span class='error'><?=word_lang("serror2")?></span>" || req.responseText=="<span class='error'><?=word_lang("incorrect field")?></span>")
			{
				document.getElementById('email_ok').value=-1
				document.getElementById('email').className = 'ibox_error';
			}
			else
			{
				document.getElementById('email_ok').value=1
				document.getElementById('email').className = 'ibox_ok';
			}
        }
    }
    req.open(null, 'check_email.php', true);
    req.send(  { email: value }  );
}



function check_password()
{
	if(document.getElementById('password2').value!="")
	{
		if(document.getElementById('password').value!=document.getElementById('password2').value)
		{
			document.getElementById('password').className = 'ibox_error';
			document.getElementById('password2').className = 'ibox_error';
			document.getElementById('error_password').innerHTML ="<span class='error'><?=word_lang("not equal")?></span>";
		}
		else
		{
			document.getElementById('password').className = 'ibox_ok';
			document.getElementById('password2').className = 'ibox_ok';
			document.getElementById('error_password').innerHTML ="";
		}
	}
}

</script>







<form action="<?if($ss=="add"){?>add.php<?}else{?>modify.php<?}?>" method="POST" name="orderform" onsubmit="return check();">











<?if($ss=="add" and (userupload==1 or $site_affiliate) and $site_signup==1 and !$site_common_account){?>
	<div class="form_field">
		<span><b><?=word_lang("who are you")?>?</b></span>
		<select name="utype" id="utype" style="width:200px;" class="ibox">
		<option value="buyer" <?if($user_fields["utype"]=="buyer"){echo("selected");}?>><?=word_lang("buyer")?></option>

		<?if(userupload==1){?>
			<option value="seller" <?if($user_fields["utype"]=="seller"){echo("selected");}?>><?=word_lang("seller")?></option>
		<?}?>

		<?if($site_affiliate){?>
			<option value="affiliate" <?if($user_fields["utype"]=="affiliate"){echo("selected");}?>><?=word_lang("affiliate")?></option>
		<?}?>
		</select>
	</div>
<?}else{?>
	<input type="hidden" name="utype" id="utype" value="<?=$user_fields["utype"]?>">
<?}?>


	<div class="row">
 		<div class="col-xs-12 col-sm-6 col-md-6">







<?if($ss=="add"){?>
<div class="form_field">
	<input type="hidden" id="login_response" name="login_response" value="0">
	<span><b><?=word_lang("login")?></b></span>
	<input type="text" name="login" id="login" style="width:300px" value="<?=$user_fields["login"]?>" onChange="check_login(this.value);" class="ibox"><div id="error_login" name="error_login">
</div></div>

<?}else{?><input type="hidden" id="login_response" name="login_response" value="0"><input type="hidden" name="login" style="width:300px" value="<?=$user_fields["login"]?>"><div id="error_login" name="error_login" class="error"></div><input type="hidden" id="login_ok" name="login_ok" value="1"><?}?>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><b><?=word_lang("password")?></b></span>
	<input type="password" name="password" id="password" style="width:300px" class="ibox" onChange="check_password();">
	<div id="error_password" name="error_password"></div>
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><b><?=word_lang("confirm password")?></b></span>
	<input type="password" name="password2" id="password2" style="width:300px" class="ibox" onChange="check_password();">
	<div id="error_password2" name="error_password2"></div>
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><b><?=word_lang("first name")?></b></span>
	<input type="text" name="name" id="name" style="width:300px" value="<?=$user_fields["name"]?>" class="ibox" onChange="check_field('name');">
	<div id="error_name" name="error_name"></div>
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><b><?=word_lang("last name")?></b></span>
	<input type="text" name="lastname" id="lastname" style="width:300px" value="<?=$user_fields["lastname"]?>" class="ibox" onChange="check_field('lastname');">
	<div id="error_lastname" name="error_lastname"></div>
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><b><?=word_lang("e-mail")?></b></span>
	<input type="text" name="email" id="email" style="width:300px" value="<?=$user_fields["email"]?>" <?if($ss=="add"){?>onChange="check_email(this.value);"<?}?> class="ibox"><div id="error_email" name="error_email" class="error"></div><input type="hidden" id="email_ok" name="email_ok" value="<?if($ss=="add"){?>0<?}else{?>1<?}?>">
</div>

</div>





<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
<span><?=word_lang("telephone")?></span>
<input type="text" name="telephone"  id="telephone"  onChange="check_field('telephone');" style="width:300px" value="<?=$user_fields["telephone"]?>" class="ibox">
<div id="error_telephone" name="error_telephone"></div>
<input type="hidden" id="telephone_ok" name="telephone_ok" value="0">
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<span><?=word_lang("company")?></span>
	<input type="text" name="company" style="width:300px" value="<?=$user_fields["company"]?>" class="ibox">
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
<span><?=word_lang("address")?></span>
<textarea name="address" style="width:300px;height:30px" class="ibox"><?=$user_fields["address"]?></textarea>
</div>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
<?=word_lang("newsletter")?> <input type="checkbox" name="newsletter" value="1" <?if($user_fields["newsletter"]==1){echo("checked");}?>>
</div>


</div>






<div class="col-xs-12 col-sm-6 col-md-6">

<?if($ss=="add"){?>

<div  class="form_field">
<?
	//Show captcha
	require_once('../admin/function/recaptchalib.php');
	echo(show_captcha());
?>
</div>

<?}?>

</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<?if($ss!="add"){?>

<div class="form_field">
	<span><?=word_lang("about")?></span>
	<textarea name="description" style="width:300px;height:70px" class="ibox"><?=$user_fields["description"]?></textarea>
</div>

<?}?>


</div>			<div class="col-xs-12 col-sm-6 col-md-6">

<div class="form_field">
	<input type="submit" class="isubmit" value="<?if($ss=="add"){?><?=word_lang("sign up")?><?}else{?><?=word_lang("change")?><?}?>">
</div>

</div>
</div>

</form>
