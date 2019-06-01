<?$site="user";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>



<?
//������� ��������
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}


//���������� �������� �� ��������
$kolvo=60;


//���������� ������� �� ��������
$kolvo2=k_str2;
?>


<h1><?=word_lang("photographers")?></h1>

<div class="seller_menu">
<?
$alfavit=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

foreach($alfavit as $key => $value)
{
	$sel="";
	if(isset($_GET["letter"]) and (int)$_GET["letter"]==$key){$sel="class='seller_menu_active'";}
	?>
	<a href="users_list.php?letter=<?=strtolower($key)?>" <?=$sel?>><?=$value?></a>
	<?
}

?>
</div>

<div class="vertical_line">&nbsp;</div>



<?
$com="";
$com2="";
$aletter="";
if(isset($_GET["letter"]))
{
	if($global_settings["show_users_type"]=="name")
	{
		$com=" and name like '".$alfavit[(int)$_GET["letter"]]."%'";
	}
	else
	{
		$com=" and login like '".$alfavit[(int)$_GET["letter"]]."%'";
	}
	
	$aletter="&letter=".(int)$_GET["letter"];
}

if($global_settings["show_users_type"]=="name")
{
	$com2=" order by name";
}
else
{
	$com2=" order by login";
}
	


$n=0;
$sql="select id_parent,avatar,login from users where (utype='seller' or utype='common') ".$com.$com2;
$rs->open($sql);
if(!$rs->eof)
{
	?>
	<div style="clear:both;">
	<?
	while(!$rs->eof)
	{
		if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
		{

			$qty=0;

			$sql="select id_parent from photos where published=1 and (userid=".$rs->row["id_parent"]." or author='".$rs->row["login"]."')";
			$ds->open($sql);
			$qty+=$ds->rc;

			$sql="select id_parent from videos where published=1 and (userid=".$rs->row["id_parent"]." or author='".$rs->row["login"]."')";
			$ds->open($sql);
			$qty+=$ds->rc;

			$sql="select id_parent from audio where published=1 and (userid=".$rs->row["id_parent"]." or author='".$rs->row["login"]."')";
			$ds->open($sql);
			$qty+=$ds->rc;

			$sql="select id_parent from vector where published=1 and (userid=".$rs->row["id_parent"]." or author='".$rs->row["login"]."')";
			$ds->open($sql);
			$qty+=$ds->rc;
			?>

			<div style="padding-right:50px;width:200px;float:left;height:50px" class="seller_list">
			<?=show_user_avatar($rs->row["login"],"login")?>&nbsp;<span>(<?=$qty?> files)</span></div>
			<?
		}
		$n++;
		$rs->movenext();
	}
	?>
	</div>

	<?
}
else
{
	echo("<p><b>".word_lang("not found")."</b></p>");
}
?>


<?include("../inc/footer.php");?>