<?include("../admin/function/db.php");?>
<html>
<head>
<title>Installation - Step 1 - PersianScript.ir</title>
<link rel=stylesheet type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"
</head>
<body>

<div class="box">




<h1>Installation - Step 1</h1>
<p>You should modify the file on ftp: <b>/admin/function/db.php</b></p>

</p>


<h1>Checking:</h1>
<?
$flag=true;
$testdb=mysql_connect(dbhost,dbuser,dbpassword);
if($testdb)
{
	echo("<p>Connecting to MySQL...<b>Ok</b></p>");
	$testdb2=mysql_select_db(dbname,$testdb);
	if($testdb)
	{
		echo("<p>Connecting to database...<b>Ok</b></p>");
	}
	else
	{
		echo("<p>Connecting to database...<b>Error</b></p>");
		$flag=false;
	}
}
else
{
	echo("<p>Connecting to MySQL...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT.site_upload_directory))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT.site_upload_directory."/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT.site_upload_directory."/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}

if (is_writeable($DOCUMENT_ROOT."/content2/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content2/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content2/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT."/content/avatars/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/avatars/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/avatars/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT."/content/blog/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/blog/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/blog/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}



if (is_writeable($DOCUMENT_ROOT."/content/categories/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/categories/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/categories/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}



if (is_writeable($DOCUMENT_ROOT."/content/models/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/models/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/models/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT."/content/users/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/users/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/users/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}

if (is_writeable($DOCUMENT_ROOT."/content/prints/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/prints/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/prints/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}

if (is_writeable($DOCUMENT_ROOT."/content/pwinty/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/content/pwinty/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/content/pwinty/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT."/cache/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/cache/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/cache/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}


if (is_writeable($DOCUMENT_ROOT."/templates_c/"))
{
	echo("<p>Folder <b>".$DOCUMENT_ROOT."/templates_c/</b> is writable...<b>Ok</b></p>");
}
else
{
	echo("<p>".$DOCUMENT_ROOT."/templates_c/ isn't writable (777)...<b>Error</b></p>");
	$flag=false;
}








if($flag==true)
{
	?><br><br>
		<center><input type="button" value="Next Step" onClick="location.href='step2.php'"></center>
	<?
}

?>



</div>
</body>
</html>