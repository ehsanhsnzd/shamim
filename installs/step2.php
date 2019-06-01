<?include("../admin/function/db.php");?>
<html>
<head>
<title>Installation - Step 2</title>
<link rel=stylesheet type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"
</head>
<body>
<div class="box">
<h1>Installation - Step 2</h1>
<?


	$zapros=file_get_contents($DOCUMENT_ROOT."/install/dump.sql");
	$sql = explode( ");", $zapros );
	for($i=0;$i<count($sql);$i++)
	{
		if($sql[$i]!="")
		{
			$db->execute( $sql[$i].")" );
		}
	}




$sql="select * from people";
$rs->open($sql);
if(!$rs->eof)
{
	echo("<p><b>The script has beed installed successfully. The installation is complete!</b></p><br>");
	echo("<p>You should delete <b>/install/</b> directory.</p><br>");
	echo("<p><b>Admin panel:</b> ".surl.site_root."/admin/auth/fullaccess.php<br>");
	echo("<b>Login:</b> ".$rs->row["login"]."<br>");
	echo("<b>Password:</b> demo</p>");
}
else
{
	echo("<p><b>Error!</b> The database was not created. Probably you didn't add a mysql user to the database.</p><p> You should go to <b>hosting cpanel -> mysql -> add user to database</b> and click <b>Install</b> again.</p>");
	echo("<p><center><input type='button' value='Back' onClick=\"location.href='step2.php'\"></center></p>");
}
?>



</div>
</body>
</html>