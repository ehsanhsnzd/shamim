<?
$site="categories";
include("../admin/function/db.php");
//if(!isset($_SESSION["people_id"])){header("location:login.php");exit();}
include("../inc/header.php");
?>

<h1><?=word_lang("categories")?></h1>

<?
$view=1;






//Show icons
if($view==1)
{
?>

<div id="category_boxes">
<?
	$category_box="<div class='category_box'><h2><nobr>{TITLE}</nobr></h2><a href='{URL}'><img src='{PHOTO}' alt='{TITLE}' width='{WIDTH}' height='{HEIGHT}'></a></div>";
	
	if(file_exists($DOCUMENT_ROOT."/".$site_template_url."category.tpl"))
	{
		$category_box=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."category.tpl");
	}

	$sql="select title,url,photo,description from category where published=1 order by title";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$n=0;
		$category_list="";
		while(!$rs->eof)
		{
			$category_current=$category_box;
			
			$photo=site_root."/images/e.gif";
			$width=$global_settings["category_preview"];
			$height=0;
			if($rs->row["photo"]!="")
			{
				$photo=$rs->row["photo"];
				
				if(file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]))
				{
					$size = getimagesize($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]);
					$width=$size[0];
					$height=$size[1];
				}
			}
			
			$category_current=str_replace("{TITLE}",$rs->row["title"],$category_current);
			$category_current=str_replace("{URL}",site_root.$rs->row["url"],$category_current);
			$category_current=str_replace("{PHOTO}",$photo,$category_current);
			$category_current=str_replace("{DESCRIPTION}",$rs->row["description"],$category_current);
			$category_current=str_replace("{WIDTH}",$width,$category_current);
			$category_current=str_replace("{HEIGHT}",$height,$category_current);
			
			$category_list.=$category_current;
			$n++;
			$rs->movenext();
		}
		echo($category_list);
	}
	?>
	</div>
	<style>
	.category_box
	{
		width:<?=($global_settings["category_preview"]+20)?>px;
	}
	</style>
	<script src="<?=site_root?>/inc/jquery.masonry.min.js"></script>
<script>
$('#category_boxes').masonry({
  		itemSelector: '.category_box'
		});
		
			$('.home_preview').each(function(){
     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.3'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});
		});
</script>
	<?
}
//End. Show icons











//Show tree view
if($view==2)
{
	$n=0;
	$sql="select a.id,a.id_parent,b.id_parent,b.title,b.priority,b.published,b.url from structure a,category b where a.id=b.id_parent and a.id_parent=5 and b.published=1 order by b.priority,b.title";
	$rs->open($sql);
	if(!$rs->eof)
	{
		?>
		<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px">
		<tr valign="top">
		<?
		while(!$rs->eof)
		{
			if($n%4==0 and $n!=0){echo("</tr><tr valign='top'>");}

			$sql="select a.id,a.id_parent,b.id_parent,b.title,b.priority,b.published,b.url from structure a,category b where a.id=b.id_parent and a.id_parent=".$rs->row["id"]." and b.published=1 order by b.priority,b.title";
			$ds->open($sql);
			?>
			<td class="catbox">
			<div class="cat1"><a href="<?=site_root.$rs->row["url"]?>"><?=$rs->row["title"]?></a></div>
			<?
			while(!$ds->eof)
			{
				?>
				<div class="cat2"><a href="<?=site_root.$ds->row["url"]?>"><?=$ds->row["title"]?></a></div>
				<?
				$ds->movenext();
			}
			?>
			</td>
			<?
			$n++;
			$rs->movenext();
		}
		?>
		</tr>
		</table>
		<?
	}
}
//End. Show tree view


//Show tag clouds
if($view==3)
{
	$sql="select title,url from category order by rand()";
	$rs->open($sql);
	while(!$rs->eof)
	{
		echo("<a href='".site_root.$rs->row["url"]."' class='tg".rand(1,4)."'>".$rs->row["title"]."</a> ");
		$rs->movenext();
	}
}
//End. Show tag clouds












//Show icons by date
if($view==4)
{
?>

<div id="category_boxes">
<?
	$category_box="<div class='category_box'><h2><nobr>{TITLE}</nobr></h2><a href='{URL}'><img src='{PHOTO}' alt='{TITLE}' width='{WIDTH}' height='{HEIGHT}'></a></div>";
	
	if(file_exists($DOCUMENT_ROOT."/".$site_template_url."category.tpl"))
	{
		$category_box=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."category.tpl");
	}

	$sql="select id_parent,title,url,photo,description from category where published=1 order by id_parent desc";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$n=0;
		$category_list="";
		while(!$rs->eof)
		{
			$count_id=0;
			$sql="select id from structure where id_parent=".$rs->row["id_parent"]." and (module_table=30 or module_table=31 or module_table=52 or  module_table=53)";
			$ds->open($sql);
			while(!$ds->eof)
			{
				$count_id++;
				$ds->movenext();
			}
			
			
			
			
			if($count_id>0)
			{
			
				$category_current=$category_box;
			
				$photo=site_root."/images/icon_photo.gif";
				$width=120;
				$height=90;
				if($rs->row["photo"]!="")
				{
					$photo=$rs->row["photo"];
				
					if(file_exists($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]))
					{
						$size = getimagesize($_SERVER["DOCUMENT_ROOT"].$rs->row["photo"]);
						$width=$size[0];
						$height=$size[1];
					}
				}
			
				$category_current=str_replace("{TITLE}",$rs->row["title"],$category_current);
				$category_current=str_replace("{URL}",site_root.$rs->row["url"],$category_current);
				$category_current=str_replace("{PHOTO}",$photo,$category_current);
				$category_current=str_replace("{DESCRIPTION}",$rs->row["description"]."<br><b>".word_lang("files").": ".$count_id."</b>",$category_current);
				$category_current=str_replace("{WIDTH}",$width,$category_current);
				$category_current=str_replace("{HEIGHT}",$height,$category_current);
			
				$category_list.=$category_current;
				$n++;
			}
			$rs->movenext();
		}
		echo($category_list);
	}
	?>
	</div>
	<script src="<?=site_root?>/inc/jquery.masonry.min.js"></script>
<script>
$('#category_boxes').masonry({
  		itemSelector: '.category_box'
		});
		
			$('.home_preview').each(function(){
     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.3'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});
		});
</script>
	<?
}
//End. Show icons by date

?>



<?include("../inc/footer.php");?>