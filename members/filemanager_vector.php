<?
if(!isset($_GET["id"]))
{
	$site="upload_vector";
}
else
{
	$site="publications";
}
$site2="";
include("../admin/function/db.php");
if(!isset($_SESSION["people_id"])){header("location:login.php");}
if(userupload==0){header("location:profile_home.php");}
include("../inc/header.php");
include("profile_top.php");
include("../admin/function/upload.php");
?>

<h1>
<?
if(!isset($_GET["id"]))
{
	echo(word_lang("upload vector"));
}
else
{
	echo(word_lang("edit")." &mdash; ".word_lang("vector")." #".$_GET["id"]);
}
?>
</h1>

<script>
	form_fields=new Array('folder','title');
	fields_emails=new Array(0,0);
	error_message="<?=word_lang("Incorrect field")?>";
</script>
<script src="<?=site_root?>/inc/jquery.qtip-1.0.0-rc3.min.js"></script>

<?
$title="";
$description="";
$keywords="";
$foldername="";
$folderid="";
$folderid2=0;
$folderid3=0;
$model=0;
$flash_version="";
$script_version="";
$flash_width=$site_flash_width;
$flash_height=$site_flash_height;
$free=0;
$pnew=true;
$google_x=0;
$google_y=0;
$adult=0;
if(isset($_GET["id"]))
{
	$sql="select id_parent,title,description,keywords,userid,model,flash_width,flash_height,flash_version,script_version,free,category2,category3,google_x,google_y,adult from vector where id_parent=".(int)$_GET["id"]."  and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$title=$rs->row["title"];
		$description=$rs->row["description"];
		$keywords=$rs->row["keywords"];
		$model=$rs->row["model"];
		$flash_width=$rs->row["flash_width"];
		$flash_height=$rs->row["flash_height"];
		$flash_version=$rs->row["flash_version"];
		$script_version=$rs->row["script_version"];
		$free=$rs->row["free"];
		$pnew=false;
		$folderid2=(int)$rs->row["category2"];
		$folderid3=(int)$rs->row["category3"];
		$google_x=$rs->row["google_x"];
		$google_y=$rs->row["google_y"];
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







<form method="post" Enctype="multipart/form-data" action="upload_vector.php?d=5<?if(isset($_GET["id"])){echo("&id=".$_GET["id"]);}?>" name="uploadform"  onSubmit="return my_form_validate();">


<?
if(isset($_GET["id"]))
{
?>
<div class="subheader"><?=word_lang("preview")?></div>	
<div class="subheader_text">
<?=show_preview((int)$_GET["id"],"vector",2,0)?>
</div>
<?
}
?>


<div class="subheader"><?=word_lang("file for sale")?></div>	
<div class="subheader_text">
<?
if(!isset($_GET["id"]))
{
?>
	<div style="margin-bottom:3px">
		<?=vector_upload_form($lvector)?>
	</div>
<?
}
else
{
?>
	<div  class="form_field">
		<?=price_update_form((int)$_GET["id"],"vector")?>
	</div>
<?
}
?>
</div>









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
</table>

<div name="sparent" id="sparent" class="form_field">
	<span><b><?=word_lang("category")?> 1:</b></span>
	<select name="folder" id="folder" style="width:450px" class='ibox'>
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


<div class="form_field">
	<span><?=word_lang("category")?> 2:</span>
	<select name="folder2" id="folder2" style="width:450px" class='ibox'>
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
	<select name="folder3" id="folder3" style="width:450px" class='ibox'>
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

<div class="form_field">
	<span><b><?=word_lang("title")?>:</b></span>
	<input class='ibox' name="title" id="title" value="<?=$title?>" type="text" style="width:450px">
</div>

<div  class="form_field">
	<span><b><?=word_lang("description")?>:</b></span>
	<textarea name="description" id="description" style="width:450px;height:70px" class='ibox'><?=$description?></textarea>
</div>

<div  class="form_field">
	<span><b><?=word_lang("keywords")?>:</b></span>
	<textarea name="keywords" id="keywords" style="width:450px;height:70px" class='ibox'><?=$keywords?></textarea>
	<span class="smalltext">(Example: key1,key2)</span>
</div>



<?if($pnew){?>
	<?if($site_flash){?>
		<div  class="form_field">
			<span><b>Flash <?=word_lang("size")?>:</b></span>
			<input name="flash_width" id="flash_width" class="ibox" type="text" style="width:30px" value="<?=$flash_width?>">&nbsp;x&nbsp;<input name="flash_height" type="text" class="ibox" style="width:30px" value="<?=$flash_height?>">
		</div>


		<div  class="form_field">
			<span><b><?=word_lang("flash version")?>:</b></span>
			<input name="flash_version" id="flash_version" class="ibox" type="text" style="width:200px" value="<?=$flash_version?>">
			<span class="smalltext">(Example: mx2004+,8+,cs3+)</span>
		</div>


		<div  class="form_field">
			<span><b><?=word_lang("flash script version")?>:</b></span>
			<input name="script_version" id="script_version" class="ibox" type="text" style="width:200px" value="<?=$script_version?>">
			<span class="smalltext">(Example: as1,as2,as3)</span>
		</div>


		<div  class="form_field">
			<span><b>Flash XML file 1:</b></span>
			<input name="xml1" type="file" style="width:300px">
			<span class="smalltext">(*.xml)</span>
		</div>


		<div class="form_field">
			<span><b>Flash XML file 2:</b></span>
			<input name="xml2" type="file" style="width:300px">
			<span class="smalltext">(*.xml)</span>
		</div>


		<div class="form_field">
			<span><b>Flash XML file 3:</b></span>
			<input name="xml3" type="file" style="width:300px">
			<span class="smalltext">(*.xml)</span>
		</div>

	<?}?>
<?}?>










<?if($site_model){?>
	<div class="form_field">
		<span><b><?=word_lang("model property release")?>:</b></span>
		<select name="model" id="model" style="width:200px" class='ibox'>
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
		<input class='ibox' name="google_x" id="google_x" value="<?=$google_x?>" type="text" style="width:200px">
	</div>

	<div class="form_field">
		<span><b><?=word_lang("Google coordinate Y")?>:</b></span>
		<input class='ibox' name="google_y" id="google_y" value="<?=$google_y?>" type="text" style="width:200px">
	</div>
<?}?>



<div  class="form_field">
	<span><b><?=word_lang("free")?>:</b></span>
	<input name="free" id="free" type="checkbox" <?if($free==1){echo("checked");}?>>
</div>

<?if($global_settings["adult_content"]){?>
<div class="form_field">
	<span><b><?=word_lang("adult content")?>:</b></span>
	<input name="adult" type="checkbox" <?if($adult==1){echo("checked");}?>>
</div>
<?}?>


</div>


<?if(!isset($_GET["id"])){?>
<div class="subheader"><?=word_lang("terms and conditions")?></div>	
<div class="subheader_text">
	<div class="form_field">
		<iframe src="<?=site_root?>/members/agreement.php?type=terms" frameborder="no" scrolling="yes" class="framestyle_terms"></iframe><br>
		<input name="terms" type="radio" value="1" onClick="document.uploadform.subm.disabled=false;"> <?=word_lang("i agree")?>
	</div>
</div>
<?}?>



<div  class="form_field">
	<input class='isubmit' value="<?if(isset($_GET["id"])){echo(word_lang("change"));}else{echo(word_lang("upload"));}?>" name="subm" type="submit" <?if(!isset($_GET["id"])){?>disabled<?}?>>
</div>

</form>


<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>