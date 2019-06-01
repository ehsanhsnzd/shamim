<?$site="profile_downloads";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>









<?include("profile_top.php");?>

<h1><?=word_lang("my downloads")?></h1>

<?

$sql="select link,tlimit,ulimit,publication_id from downloads where user_id=".(int)$_SESSION["people_id"]." and tlimit<ulimit and data>".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))." order by data desc";
$rs->open($sql);

if(!$rs->eof)
{
	while(!$rs->eof)
	{
		$preview="";
		
		$sql="select server1,title from photos where id_parent=".(int)$rs->row["publication_id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$preview=show_preview($rs->row["publication_id"],"photo",1,1,$ds->row["server1"],$rs->row["publication_id"]);
			$preview_title=$ds->row["title"];
			$preview_class=1;
		}
		
		$sql="select server1,title from videos where id_parent=".(int)$rs->row["publication_id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$preview=show_preview($rs->row["publication_id"],"video",1,1,$ds->row["server1"],$rs->row["publication_id"]);
			$preview_title=$ds->row["title"];
			$preview_class=2;
		}
		
		$sql="select server1,title from audio where id_parent=".(int)$rs->row["publication_id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$preview=show_preview($rs->row["publication_id"],"audio",1,1,$ds->row["server1"],$rs->row["publication_id"]);
			$preview_title=$ds->row["title"];
			$preview_class=3;
		}
		
		$sql="select server1,title from vector where id_parent=".(int)$rs->row["publication_id"];
		$ds->open($sql);
		if(!$ds->eof)
		{
			$preview=show_preview($rs->row["publication_id"],"vector",1,1,$ds->row["server1"],$rs->row["publication_id"]);
			$preview_title=$ds->row["title"];
			$preview_class=4;
		}
		
		if($preview!="")
		{
			?>
			<div class="item_list">
				<div  class="item_list_img">
					<div  class="item_list_img2">
					<a href="<?=site_root?>/members/download.php?f=<?=$rs->row["link"]?>"><img src="<?=$preview?>"></a>
					</div>
				</div>
				<div  class="item_list_text<?=$preview_class?>">
					<div><a href="<?=site_root?>/members/download.php?f=<?=$rs->row["link"]?>"><?=$preview_title?></a></div>
					<div class="idownloaded"><?=word_lang("downloads")?>: <?=$rs->row["tlimit"]?>(<?=$rs->row["ulimit"]?>)</div>
				</div>
			</div>
			<?
		}
		$rs->movenext();
	}
}
else
{
	echo(word_lang("not found"));
}
?>





<?include("profile_bottom.php");?>























<?include("../inc/footer.php");?>