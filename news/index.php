<?$site="news";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>


<h1><?=word_lang("news")?></h1>


<?
//Текущая страница
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}

//Количество новостей на странице
$kolvo=k_str;

//Количество страниц на странице
$kolvo2=k_str2;




if(isset($_GET["id"]))
{
$sql="select * from news where id_parent=".(int)$_GET["id"];
$rs->open($sql);
if(!$rs->eof)
{
?>


<p><span class="newstitle"><?=$rs->row["title"]?></span><br><?=stripslashes(translate_text($rs->row["announce"]))?></p>
<?=stripslashes(translate_text($rs->row["content"]))?>
<p class="datenews"><?=date(date_short,$rs->row['data'])?></p>

<p align="right"><a href="<?=site_root?>/news/" class="r">All News &#187;</a></p>
<?
}
}
else
{
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<?
$sql="select * from news order by data desc";
$rs->open($sql);
$n=0;
while(!$rs->eof)
{
if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
{
?>
<tr><td style="padding-bottom:15"><p><span class="datenews"><?=date(date_short,$rs->row["data"])?></span><br><span class="newstitle"><?=$rs->row["title"]?></span><br><?=stripslashes(translate_text($rs->row["announce"]))?><br><a href="<?=site_root?>/news/<?=$rs->row["id_parent"]?>/"><?=word_lang("more")?>...</a></p></td></tr>
<?
}
$n++;
$rs->movenext();
}
?>
</table>
<?
echo(paging2($n,$str,$kolvo,$kolvo2,site_root."/news/index.php",""));



}
?>


<p><a href="<?=site_root?>/news/rss.php"><img src="<?=site_root?>/images/rss.gif" border="0" width="41" height="15"></a></p>



<?include("../inc/footer.php");?>