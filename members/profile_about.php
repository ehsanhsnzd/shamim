<?$site="profile_about";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>









<?include("profile_top.php");?>

<h1><?=word_lang("my profile")?></h1>




<?
$sql="select login,avatar,photo from users where login='".result($_SESSION["people_login"])."'";
$rs->open($sql);
if(!$rs->eof)
{
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr valign="top">
<td width="50%"><h2><?=word_lang("avatar")?>:</h2>



<table border="0" cellpadding="0" cellspacing="0">
<tr valign="top">

<?if($rs->row["avatar"]!=""){?>
<td style="padding-right:10px">
<?if(file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["avatar"])){?>
<div style="margin-bottom:5px"><img src="<?=$rs->row["avatar"]?>" width="<?=avatarwidth?>"></div>
<?}?>
<div><a href="profile_photo_delete.php?type=avatar"><?=word_lang("delete")?></a></div>
</td>
<?}?>


<td>
<form method=post Enctype="multipart/form-data" action="profile_photo_upload.php?type=avatar">
<div class="smalltext"><b><?=word_lang("file types")?>:</b> *.jpg,*.jpeg,*.gif,*.png.</div>
<div class="smalltext"><b><?=word_lang("size")?></b> < 50Kb. <b><?=word_lang("width")?></b> = <?=avatarwidth?>px.</div>
<div style="margin-top:5px"><input type=file name="avatar" style="width:200px"></div>
<div style="margin-top:5px"><input class='isubmit' type="submit" value="<?=word_lang("upload")?>"></div>
</form>
</td>
</tr>
</table>












</td>

<td width="50%" style="padding-left:10px"><h2><?=word_lang("photo")?>:</h2>









<table border="0" cellpadding="0" cellspacing="0">
<tr valign="top">

<?if($rs->row["photo"]!=""){?>
<td style="padding-right:10px">
<?if(file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"])){?>
<div style="margin-bottom:5px"><img src="<?=$rs->row["photo"]?>" width="<?=userphotowidth?>"></div>
<?}?>
<div><a href="profile_photo_delete.php?type=photo"><?=word_lang("delete")?></a></div>
</td>
<?}?>


<td>
<form method=post Enctype="multipart/form-data" action="profile_photo_upload.php?type=photo">
<div class="smalltext"><b><?=word_lang("file types")?>:</b> *.jpg,*.jpeg,*.gif,*.png.</div>
<div class="smalltext"><b><?=word_lang("size")?></b> < 200Kb. <b><?=word_lang("width")?></b> = <?=userphotowidth?>px.</div>
<div style="margin-top:5px"><input type=file name="photo" style="width:200px"></div>
<div style="margin-top:5px"><input class='isubmit' type="submit" value="<?=word_lang("upload")?>"></div>
</form>
</td>
</tr>
</table>











</td>
</tr>
</table>
<?
}





?>


<div style="margin-top:40px" class="profile_separator"></div>

<h1 style="margin-top:20px"><?=word_lang("settings")?></h1>



<?
$sql="select id_parent,login,name,email,telephone,address,data1,ip, accessdenied,country,category,lastname,city,state,zipcode,avatar,photo,description,website,utype,company,newsletter,paypal,moneybookers,examination,passport ,authorization,aff_commission_buyer,aff_commission_seller,aff_visits ,aff_signups,aff_referal,business from users where id_parent=".(int)$_SESSION["people_id"];
$rs->open($sql);
if(!$rs->eof)
{

$user_fields["login"]=$rs->row["login"];
$user_fields["name"]=$rs->row["name"];
$user_fields["country"]=$rs->row["country"];
$user_fields["telephone"]=$rs->row["telephone"];
$user_fields["address"]=$rs->row["address"];
$user_fields["email"]=$rs->row["email"];
$user_fields["lastname"]=$rs->row["lastname"];
$user_fields["city"]=$rs->row["city"];
$user_fields["state"]=$rs->row["state"];
$user_fields["zipcode"]=$rs->row["zipcode"];
$user_fields["description"]=$rs->row["description"];
$user_fields["website"]=$rs->row["website"];
$user_fields["utype"]=$rs->row["utype"];
$user_fields["company"]=$rs->row["company"];
$user_fields["newsletter"]=$rs->row["newsletter"];
$user_fields["business"]=$rs->row["business"];
}



$ss="modify";



include("signup_content.php");

?>






<?include("profile_bottom.php");?>























<?include("../inc/footer.php");?>