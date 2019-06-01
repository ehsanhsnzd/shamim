<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_ffmpeg");

$ffmpeg=0;


if(isset($_POST["ffmpeg"])){$ffmpeg=1;}





$sql="update ffmpeg set fpath='".result($_POST["fpath"])."',video_width=".(int)$_POST["video_width"].",video_height=".(int)$_POST["video_height"].",thumb_width=".(int)$_POST["thumb_width"].",thumb_height=".(int)$_POST["thumb_height"].",ffmpeg=".$ffmpeg.",frequency=".(int)$_POST["frequency"].",duration=".(int)$_POST["duration"].",video_format='".result($_POST["video_format"])."'";
$db->execute($sql);

$_SESSION["site_ffmpeg"]=$ffmpeg;
$_SESSION["site_ffmpeg_width"]=(int)$_POST["video_width"];
$_SESSION["site_ffmpeg_height"]=(int)$_POST["video_height"];


header("location:index.php");
?>