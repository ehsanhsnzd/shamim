<?$site="models";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>

<?
if($global_settings["show_model"]==1)
{
	$sql="select * from models where id_parent=".(int)$_GET["model"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		?>
		<h1><?=$rs->row["name"]?></h1>

		<?if($rs->row["modelphoto"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["modelphoto"])){?>
			<img src="<?=$rs->row["modelphoto"]?>" align="left" vspace="0" hspace="0" style="margin-right:15;margin-bottom:5">
		<?}?>

		<?=str_replace("\r","<br>",$rs->row["description"])?>

		<?if($rs->row["model"]!="" and file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["model"])){?>
			<p><a href="<?=$rs->row["model"]?>"><b><?=word_lang("model property release")?></b></a></p>
		<?}?>
		<?
	}
	else
	{
		echo("<b>".word_lang("not found")."</b>");
	}
}
?>



<?include("../inc/footer.php");?>