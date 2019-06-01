<?
$site="publications";$site2="";
include("../admin/function/db.php");
if(!isset($_SESSION["people_id"])){header("location:login.php");}
if(userupload==0){header("location:profile_home.php");}
include("../inc/header.php");
include("profile_top.php");
include("../admin/function/upload.php");


if(userupload==0){exit;}
?>





<h1><?=word_lang("edit")?> &mdash; <?=word_lang("photo")?> #<?=@$_GET["id"]?></h1>


<?
$title="";
$description="";
$keywords="";
$foldername="";
$folderid="";
$folderid2=0;
$folderid3=0;
$model=0;
$free=0;
$editorial=0;
$google_x=0;
$google_y=0;
$adult=0;
$pnew=true;
if(isset($_GET["id"]))
{
	$sql="select id_parent,title,description,keywords,userid,model,free,category2,category3,google_x,google_y,editorial,adult from photos where id_parent=".(int)$_GET["id"]."  and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$title=$rs->row["title"];
		$description=$rs->row["description"];
		$keywords=$rs->row["keywords"];
		$model=$rs->row["model"];
		$free=$rs->row["free"];
		$folderid2=(int)$rs->row["category2"];
		$folderid3=(int)$rs->row["category3"];
		$pnew=false;
		$google_x=$rs->row["google_x"];
		$google_y=$rs->row["google_y"];
		$free=$rs->row["free"];
		$editorial=$rs->row["editorial"];
		$adult=$rs->row["adult"];

		$sql="select id,id_parent from structure where id=".$rs->row["id_parent"];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$sql="select id,id_parent,name from structure where id=".$dr->row["id_parent"];
			$ds->open($sql);
			if(!$ds->eof)
			{
				$foldername=$ds->row["name"];
				$folderid=$ds->row["id"];
			}
		}
	}
}
?>




<form method="post" Enctype="multipart/form-data" action="upload_photo.php?d=2<?if(isset($_GET["id"])){echo("&id=".$_GET["id"]);}?>" name="uploadform">


<div class="subheader"><?=word_lang("preview")?></div>	
<div class="subheader_text">
<?
if(isset($_GET["id"]))
{
?>
<?=show_preview((int)$_GET["id"],"photo",2,0)?>
<?
}
?>
</div>


<?
if(!$global_settings["printsonly"])
{
?>
<div class="subheader"><?=word_lang("file for sale")?></div>	
<div class="subheader_text">
<div  class="form_field">
	<?=price_update_form((int)$_GET["id"],"photo")?>
</div>
</div>
<?
}
?>


<?
if($global_settings["prints_users"])
{
	?>
	<div class="subheader"><?=word_lang("prints and products")?></div>	
	<div class="subheader_text">
	<div class="form_field">
	<?
	if(isset($_GET["id"]))
	{
		echo(prints_live((int)$_GET["id"]));
	}
	?>
	</div>
	</div>
	<?
}
?>


<div class="subheader"><?=word_lang("settings")?></div>	
<div class="subheader_text">

<table border="0" cellpadding="0" cellspacing="2" align="right">
<tr height="15">
<td width="20" class="upload_ok">&nbsp;</td>
<td class="smalltext"> - <?=word_lang("upload permitted")?></td>
</tr>
<tr height="15">
<td width="20" class="upload_error">&nbsp;</td>
<td class="smalltext"> - <?=word_lang("upload denied")?></td>
</tr>
<tr>
<td colspan="2" style="padding-top:10px">


</td>
</tr>
</table>




<div name="sparent" id="sparent" class="form_field">
	<span><b><?=word_lang("category")?> 1:</b></span>
	<select name="folder" style="width:450px" class='ibox'>
	<option value=""></option>
	<?
	$itg="";
	$smarty_buildmenu5_id="buildmenu|5|".(int)$folderid;
	if (!$smarty->is_cached('buildmenu5.tpl',$smarty_buildmenu5_id))
	{
		$nlimit=0;
		buildmenu5(5,(int)$folderid,2,0);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu5', $itg);
	$itg=$smarty->fetch('buildmenu5.tpl',$smarty_buildmenu5_id);
	echo($itg);
	?>
	</select>
</div>







<div  class="form_field">
	<span><?=word_lang("category")?> 2:</span>
	<select name="folder2" style="width:450px" class='ibox'>
	<option value=""></option>
	<?
	$itg="";
	$smarty_buildmenu5_id="buildmenu|5|".(int)$folderid2;
	if (!$smarty->is_cached('buildmenu5.tpl',$smarty_buildmenu5_id))
	{
		$nlimit=0;
		buildmenu5(5,(int)$folderid2,2,0);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu5', $itg);
	$itg=$smarty->fetch('buildmenu5.tpl',$smarty_buildmenu5_id);
	echo($itg);
	?>
	</select>
</div>



<div  class="form_field">
	<span><?=word_lang("category")?> 3:</span>
	<select name="folder3" style="width:450px" class='ibox'>
	<option value=""></option>
	<?
	$itg="";
	$smarty_buildmenu5_id="buildmenu|5|".(int)$folderid3;
	if (!$smarty->is_cached('buildmenu5.tpl',$smarty_buildmenu5_id))
	{
		$nlimit=0;
		buildmenu5(5,(int)$folderid3,2,0);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu5', $itg);
	$itg=$smarty->fetch('buildmenu5.tpl',$smarty_buildmenu5_id);
	echo($itg);
	?>
	</select>
</div>






<div  class="form_field">
	<span><b><?=word_lang("title")?>:</b></span>
	<input class='ibox' name="title" value="<?=$title?>" type="text" style="width:450px">
</div>

<div  class="form_field">
	<span><b><?=word_lang("description")?>:</b></span>
	<textarea name="description" style="width:450px;height:70px" class='ibox'><?=$description?></textarea>
</div>

<div  class="form_field">
	<span><b><?=word_lang("keywords")?>:</b></span>
	<textarea name="keywords" style="width:450px;height:70px" class='ibox'><?=$keywords?></textarea><span class="smalltext">(Example: key1,key2)</span>
</div>











<?if($site_model){?>
<div class="form_field">
	<span><b><?=word_lang("model property release")?>:</b></span>
	<select name="model" style="width:450px" class='ibox'>
	<option value="0"></option>
	<?
	$sql="select id_parent,name from models where user='".result($_SESSION["people_login"])."' order by name";
	$ds->open($sql);
	while(!$ds->eof)
	{
		$sel="";
		if($ds->row["id_parent"]==$model){$sel="selected";}
		?>
		<option value="<?=$ds->row["id_parent"]?>" <?=$sel?>><?=$ds->row["name"]?></option>
		<?
		$ds->movenext();
	}
	?>
	</select>&nbsp;&nbsp;&nbsp;<a href="models.php"><?=word_lang("edit")?></a>
</div>
<?}?>



<?if($site_google){?>
	<div class="form_field">
		<span><b><?=word_lang("Google coordinate X")?>:</b></span>
		<input class='ibox' name="google_x" value="<?=$google_x?>" type="text" style="width:200px">
	</div>

	<div class="form_field">
		<span><b><?=word_lang("Google coordinate Y")?>:</b></span>
		<input class='ibox' name="google_y" value="<?=$google_y?>" type="text" style="width:200px">
	</div>
<?}?>


<?
if(!$global_settings["printsonly"])
{
?>
<div class="form_field">
	<span><b><?=word_lang("free")?>:</b></span> 
	<input name="free" type="checkbox" <?if($free==1){echo("checked");}?>>
</div>
<?}?>

<div class="form_field">
	<span><b><?=word_lang("editorial")?>:</b></span> 
	<input name="editorial" type="checkbox" <?if($editorial==1){echo("checked");}?>>
</div>

<?
if($global_settings["adult_content"])
{
?>
<div class="form_field">
	<span><b><?=word_lang("adult content")?>:</b></span> 
	<input name="adult" type="checkbox" <?if($adult==1){echo("checked");}?>>
</div>
<?}?>

</div>


<div class="form_field">
	<input class='isubmit' value="<?=word_lang("change")?>" name="subm" type="submit" <?if(!isset($_GET["id"])){?>disabled<?}?>>
</div>

</form>


<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>