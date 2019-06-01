<?
//Check access
admin_panel_access("settings_ffmpeg");

if(!defined("site_root")){exit();}


$sql="select * from ffmpeg";
$rs->open($sql);
if(!$rs->eof)
{
?>
<form method="post" action="change.php">
<div class="form_field"> 
	<span><b><?=word_lang("enabled")?>:</b></span>
	<input name="ffmpeg" type="checkbox" <?if($rs->row["ffmpeg"]==1){echo("checked");}?>>
</div>


<div class="form_field">
	<span><b><?=word_lang("path")?>:</b></span>
	<input name="fpath" value="<?=$rs->row["fpath"]?>" type="text" style="width:300"><br><span class="smalltext">Usually the path is /usr/local/bin/ffmpeg</span>
</div>


<div class="form_field">
	<span><b>Video preview format:</b></span>
	<select name="video_format">
		<option value="mp4" <?if($rs->row["video_format"]=="mp4"){echo("selected");}?>>MP4</option>
		<option value="flv" <?if($rs->row["video_format"]=="flv"){echo("selected");}?>>FLV</option>
	</select>
</div>

<div class="form_field">
	<span><b>Preview duration (sec):</b></span>
	<input name="duration" value="<?=$rs->row["duration"]?>" type="text" style="width:97">
</div>


<div class="form_field">
	<span><b><?=word_lang("preview")?> <?=word_lang("video")?> <?=word_lang("size")?>:</b></span>
	<input name="video_width" value="<?=$rs->row["video_width"]?>" type="text" style="width:40"> x <input name="video_height" value="<?=$rs->row["video_height"]?>" type="text" style="width:40">
</div>


<div class="form_field">
	<span><b><?=word_lang("preview")?> <?=word_lang("photo")?> <?=word_lang("size")?>:</b></span>

	<input name="thumb_width" value="<?=$rs->row["thumb_width"]?>" type="text" style="width:40"> x <input name="thumb_height" value="<?=$rs->row["thumb_height"]?>" type="text" style="width:40">
</div>

<div class="form_field">
	<span><b>Amount of JPG thumbs:</b></span>
	<input name="frequency" value="<?=$rs->row["frequency"]?>" type="text" style="width:97">
</div>




<div class="form_field">
	<input type="submit" class="btn btn-primary" value="<?=word_lang("change")?>">
</div>

</form>

<?
}
?>