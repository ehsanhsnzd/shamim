<?
	Header("location: users/");

$site="signup";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>

<h1><?=word_lang("sign up")?></h1>

<?if($_GET["activation"]=="off"){?>
<p><?=word_lang("با تشکر عضویت شما با موفقیت ثبت شد. نام کاربری شما فعلا غیر فعال می باشد.")?></p>
<?}?>

<?if($_GET["activation"]=="on"){?>
<p><?=word_lang("با تشکر عضویت شما با موفقیت ثبت شد.")?></p>
<?}?>

<?if($_GET["activation"]=="user"){?>
<p><?=word_lang("confirmation sent")?></p>
<?}?>

<?if($_GET["activation"]=="admin"){?>
<p><?=word_lang("با تشکر عضویت شما با موفقیت ثبت شد. نام کاربری شما پس از تایید مدییریت فعال خواهد شد.")?></p>
<?}?>





<?include("../inc/footer.php");?>