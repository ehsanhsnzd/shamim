<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_ffmpeg");
?>
<? include("../inc/begin.php");?>






<h1>FFMPEG</h1>





<div class="subheader"><?=word_lang("overview")?></div>
<div class="subheader_text">
	<a href="https://ffmpeg.org/"><b>FFMPEG</b></a> is a library which allows to generate *.flv,*.mp4 and *.jpg previews for a video file. You should ask your hosting support if your server supports the software. Otherwise you have to upload the video's previews separately.
</div>

<div class="subheader"><?=word_lang("settings")?></div>
<div class="subheader_text">
<?include("settings.php");?>
</div>

<div class="subheader"><?=word_lang("test")?></div>
<div class="subheader_text">
<?include("test.php");?>
</div>















<? include("../inc/end.php");?>