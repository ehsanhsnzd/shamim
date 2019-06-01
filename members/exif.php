<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);

$id=@$_REQUEST['id'];

$sql="select server1,folder from photos where id_parent=".(int)$id;
$rs->open($sql);
if(!$rs->eof)
{
	$sql="select url from items where id_parent=".(int)$id;
	$dr->open($sql);
	if(!$dr->eof)
	{
		$img=$_SERVER["DOCUMENT_ROOT"].site_root.server_url($rs->row["server1"])."/".$rs->row["folder"]."/".$dr->row["url"];
		if(file_exists($img))
		{
			echo("<h2>EXIF:	</h2>");
			echo(get_exif($img));
		}
	}
}
?>
