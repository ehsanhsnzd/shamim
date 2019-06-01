<? include("../function/db.php");?>
<?

$slova="";
if(isset($_GET["d"]))
{
	$d=(int)$_GET["d"];
	if($d==1){$slova="<b>".word_lang("error")."</b>";}
	if($d==2){$slova="<b>Incorrect captcha</b>";}
	$slova="<div id='login_error'>".$slova."</div>";
}



?>




<html>
<head>
<title>Content Management System</title>
<link rel="stylesheet" type="text/css" href="<?=site_root?>/inc/bootstrap/css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=site_root?>/inc/bootstrap/css/bootstrap-responsive.css">
<link href="../images/favicon.gif" type="image/gif" rel="icon">
<link href="../images/favicon.gif" type="image/gif" rel="shortcut icon">
<link rel=stylesheet type="text/css" href="<?=site_root?>/admin/inc/style.css">
<script language="javascript" src="<?=site_root?>/inc/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
      <script src="<?=site_root?>/inc/bootstrap/js/html5shiv.js"></script>
<![endif]-->
</head>
<body>





<form method=post action="check2.php">
<div id="login">
<?=$slova?>

<div id="login_header"><?=word_lang("auth")?></div>

<div id="login_footer">

<div class="form_field">
<input type="text" name="login" class="input-medium" style="width:250px" placeholder="<?=word_lang("login")?>">
</div>

<div class="form_field">
<input name="password" type="password" style="width:250px" placeholder="<?=word_lang("password")?>">
</div>

<div class="form_field">
<?$rr=rand(0,9);?>
<input id="rn1" name="rn1" type="text" value=""  style="width:70px"  class=ft><input name="rn2" type="hidden" value="<?=$rr?>"><img src="<?=site_root?>/images/c<?=$rr?>.gif" width="80" height="30" style="margin-left:9px">
</div>

<div class="form_field">
<input type="submit" class="btn btn-primary" value="<?=word_lang("login")?>">
</div>

</div>
</div>
</form>





</body>
</html>