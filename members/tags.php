<?include("../admin/function/db.php");?>
<html>
<head>
<title>Tags</title>
<style>
A:link,A:visited {color: #2C78B5;text-decoration: underline;}
A:active,A:hover {color: #2C78B5;text-decoration: underline;}

.tg1{font:7.4pt Tahoma}
.tg2{font:8.4pt Tahoma}
.tg3{font:9.4pt Tahoma}
.tg4{font:10.4pt Tahoma}
</style>
</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<?
$tg=array();
$box_tag_clouds="";

$sql="select keywords from photos order by rand() limit 15";
$rs->open($sql);
while(!$rs->eof)
{
$tgg=explode(",",$rs->row["keywords"]);
for($i=0;$i<count($tgg);$i++)
{
if($tgg[$i]!="")
{
$ftg=true;
for($j=0;$j<count($tg);$j++)
{
if($tg[$j]==$tgg[$i]){$ftg=false;}
}
if($ftg==true){$tg[count($tg)]=$tgg[$i];}
}
}
$rs->movenext();
}


for($j=0;$j<count($tg);$j++)
{
$box_tag_clouds.="<a href='".site_root."/?search=".$tg[$j]."' target='blank'><span class='tg".rand(1,4)."'>".$tg[$j]."</span></a> ";
}



echo($box_tag_clouds);
?>

</body>
</html>