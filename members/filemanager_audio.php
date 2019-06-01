<?
if(!isset($_GET["id"]))
{
	$site="upload_audio";
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
	echo(word_lang("upload audio"));
}
else
{
	echo(word_lang("edit")." &mdash; ".word_lang("audio")." #".$_GET["id"]);
}
?>
</h1>

<?
$fields_show=array();
$fields_required="";
$fields_required2="";
$sql="select * from video_fields order by priority";
$rs->open($sql);
while(!$rs->eof)
{
	if($rs->row["activ"]==1 or $rs->row["always"]==1)
	{
		$fields_show[$rs->row["name"]]=1;
		if($rs->row["required"]==1 and $rs->row["fname"]!="terms" and $rs->row["fname"]!="sale" and $rs->row["fname"]!="previewvideo" and $rs->row["fname"]!="previewpicture" and $rs->row["fname"]!="duration")
		{
			if($fields_required!=""){$fields_required.=",";}
			$fields_required.="'".$rs->row["fname"]."'";
			
			if($fields_required2!=""){$fields_required2.=",";}
			$fields_required2.="0";
		}
	}
$rs->movenext();
}


?>

<script>
	form_fields=new Array(<?=$fields_required?>);
	fields_emails=new Array(<?=$fields_required2?>);
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
$duration=0;
$format="";
$source="";
$holder="";
$model=0;
$free=0;
$pnew=false;
$google_x=0;
$google_y=0;
$adult=0;
if(isset($_GET["id"]))
{
	$sql="select id_parent,title,description,keywords,userid,duration,format,source,holder,model,free,category2,category3,google_x,google_y,adult from audio where id_parent=".(int)$_GET["id"]." and (userid=".(int)$_SESSION["people_id"]." or author='".result($_SESSION["people_login"])."')";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$title=$rs->row["title"];
		$description=$rs->row["description"];
		$keywords=$rs->row["keywords"];
		$duration=$rs->row["duration"];
		$format=$rs->row["format"];
		$source=$rs->row["source"];
		$holder=$rs->row["holder"];
		$model=$rs->row["model"];
		$free=$rs->row["free"];
		$pnew=true;
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





<form method="post" Enctype="multipart/form-data" action="upload_audio.php?d=4<?if(isset($_GET["id"])){echo("&id=".$_GET["id"]);}?>" name="uploadform"  onSubmit="return my_form_validate();">


<?
if(isset($_GET["id"]))
{
?>
<div class="subheader"><?=word_lang("preview")?></div>	
<div class="subheader_text">
<?=show_preview((int)$_GET["id"],"audio",2,0)?>
</div>
<?
}
?>




<div class="subheader"><?=word_lang("file for sale")?></div>	
<div class="subheader_text">
<?
if(isset($fields_show["file for sale"])){
if(!isset($_GET["id"]))
{
?>
	<div  class="form_field">
		<?=audio_upload_form($laudio,$lpreviewaudio);?>
	</div>
<?
}
else
{
?>
	<div  class="form_field">
		<span><b><?=word_lang("prices")?>:</b></span>
		<?=price_update_form((int)$_GET["id"],"audio")?>
	</div>
<?
}
}
?>
</div>

<div class="subheader"><?=word_lang("settings")?></div>	
<div class="subheader_text">




<?if(isset($fields_show["category"])){?>

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


<div  class="form_field">
	<span><b><?=word_lang("category")?> 2:</b></span>
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
	<span><b><?=word_lang("category")?> 3:</b></span>
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

<?}?>

<?if(isset($fields_show["title"])){?>
	<div  class="form_field">
		<span><b><?=word_lang("title")?>:</b></span>
		<input class='ibox' name="title" id="title" value="<?=$title?>" type="text" style="width:450px">
	</div>
<?}?>

<?if(isset($fields_show["description"])){?>
	<div class="form_field">
		<span><b><?=word_lang("description")?>:</b></span>
		<textarea class='ibox' name="description" id="description" style="width:450px;height:70px"><?=$description?></textarea>
	</div>
<?}?>

<?if(isset($fields_show["keywords"])){?>
	<div  class="form_field">
		<span><b><?=word_lang("keywords")?>:</b></span>
		<textarea name="keywords" id="keywords" style="width:450px;height:70px" class='ibox'><?=$keywords?></textarea>
		<span class="smalltext">(Example: key1,key2)</span>
	</div>
<?}?>






<?if(isset($fields_show["duration"])){?>
	<div  class="form_field">
		<span><b><?=word_lang("duration")?>:</b></span>
		<?=duration_form($duration,"duration")?>
	</div>
<?}?>


<?if(isset($fields_show["track format"])){?>
	<div  class="form_field">
		<span><b><?=word_lang("track format")?>:</b></span>
		<select name="format" id="format" class='ibox' style="width:150px">
		<option value="">...</option>
		<?
		$sql="select * from audio_format";
		$dr->open($sql);
		while(!$dr->eof)
		{
			$sel="";
			if($dr->row["name"]==$format){$sel="selected";}
			?>
			<option value="<?=$dr->row["name"]?>" <?=$sel?>><?=$dr->row["name"]?></option>
			<?
			$dr->movenext();
		}
		?>
		</select>
	</div>
<?}?>




<?if(isset($fields_show["track source"])){?>
	<div class="form_field">
		<span><b><?=word_lang("track source")?>:</b></span>
		<select name="source" id="source" class='ibox' style="width:150px">
		<option value="">...</option>
		<?
		$sql="select * from audio_source";
		$dr->open($sql);
		while(!$dr->eof)
		{
			$sel="";
			if($dr->row["name"]==$source){$sel="selected";}
			?>
			<option value="<?=$dr->row["name"]?>" <?=$sel?>><?=$dr->row["name"]?></option>
			<?
			$dr->movenext();
		}
		?>
		</select>
	</div>
<?}?>





<?if(isset($fields_show["copyright holder"])){?>
	<div class="form_field">
		<span><b><?=word_lang("copyright holder")?>:</b></span>
		<input class='ibox' name="holder" id="holder" value="<?=$holder?>" type="text" style="width:200px">
	</div>
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


	<div class="form_field">
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


<?if(isset($fields_show["terms and conditions"])){?>


	
	<?if(!isset($_GET["id"])){?>
	<div class="subheader"><?=word_lang("terms and conditions")?></div>	
<div class="subheader_text">
		<div class="form_field">
			<iframe src="<?=site_root?>/members/agreement.php?type=terms" frameborder="no" scrolling="yes" class="framestyle_terms"></iframe>

			<br><input name="terms" type="radio" value="1" onClick="document.uploadform.subm.disabled=false;"> <?=word_lang("i agree")?>
		</div>
		</div>
	<?}?>

<?}?>








<div  class="form_field">
	<input class='isubmit' value="<?if(isset($_GET["id"])){echo(word_lang("change"));}else{echo(word_lang("upload"));}?>" name="subm" type="submit" <?if(!isset($_GET["id"])){?>disabled<?}?>>
</div>

</form>

<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>