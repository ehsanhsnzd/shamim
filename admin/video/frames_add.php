<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("settings_video");


$sql="insert into video_frames (name) values ('".result($_POST["new"])."')";
$db->execute($sql);





header("location:index.php?d=4");
?>