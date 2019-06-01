<?$site="map";?>
<?include("../admin/function/db.php");?>
<?include("../inc/header.php");?>
<? include("../admin/function/show.php");?>

<h1><?=word_lang("Google map")?></h1>

<?
if($global_settings["google_coordinates"])
{
	?>
		<style>
		#map1
		{
			width:700px;
			height:500px;
			color:#000000;
		}
		#map1 a
		{
			color:#0a82aa;
		}
	</style>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?=site_root?>/inc/jquery.ui.map.js"></script>
	<script>
	$(document).ready(function(){
		$('#map1').gmap('option', 'zoom', 4);
		
		$('#map1').gmap().bind('init', function(evt, map) { 
        	
        	<?
	$sql="(select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title,b.published,b.folder,b.server1,b.google_x,b.google_y,b.description from structure a,photos b where b.published=1 and a.id=b.id_parent and b.google_x<>0 and b.google_y<>0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title,b.published,b.folder,b.server1,b.google_x,b.google_y,b.description from structure a,videos b where b.published=1 and a.id=b.id_parent and b.google_x<>0 and b.google_y<>0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title,b.published,b.folder,b.server1,b.google_x,b.google_y,b.description from structure a,audio b where b.published=1 and a.id=b.id_parent and b.google_x<>0 and b.google_y<>0) union (select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title,b.published,b.folder,b.server1,b.google_x,b.google_y,b.description from structure a,vector b where b.published=1 and a.id=b.id_parent and b.google_x<>0 and b.google_y<>0) order by rand() limit 0,30";
	$rs->open($sql);
	$n=0;
	while(!$rs->eof)
	{
		$img_url="";
		
		
		$remote_width=0;
		$remote_height=0;
		$flag_storage=false;
		
		
		if($rs->row["module_table"]==30)
		{	
			$img_url=show_preview($rs->row["id"],"photo",1,1,$rs->row["server1"],$rs->row["folder"],false);
			
			$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$rs->row["id"]." and (filename1='thumb1.jpg' or filename1='thumb1.jpeg')";
			$ds->open($sql);
			if(!$ds->eof)
			{
				$remote_width=$ds->row["width"];
				$remote_height=$ds->row["height"];
				$flag_storage=true;
			}
		}
		if($rs->row["module_table"]==31)
		{
			$img_url=show_preview($rs->row["id"],"video",1,1,$rs->row["server1"],$rs->row["folder"],false);
			
			$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$rs->row["id"]." and (filename1='thumb.jpg' or filename1='thumb.jpeg' or thumb0.jpg' or filename1='thumb0.jpeg')";
			$ds->open($sql);
			if(!$ds->eof)
			{
				$remote_width=$ds->row["width"];
				$remote_height=$ds->row["height"];
				$flag_storage=true;
			}
		}
		if($rs->row["module_table"]==52)
		{
			$img_url=show_preview($rs->row["id"],"audio",1,1,$rs->row["server1"],$rs->row["folder"],false);
			
			$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$rs->row["id"]." and (filename1='thumb.jpg' or filename1='thumb.jpeg')";
			$ds->open($sql);
			if(!$ds->eof)
			{
				$remote_width=$ds->row["width"];
				$remote_height=$ds->row["height"];
				$flag_storage=true;
			}
		}
		if($rs->row["module_table"]==53)
		{
			$img_url=show_preview($rs->row["id"],"vector",1,1,$rs->row["server1"],$rs->row["folder"],false);
			
			$sql="select url,filename1,filename2,width,height from filestorage_files where id_parent=".$rs->row["id"]." and (filename1='thumb1.jpg' or filename1='thumb1.jpeg' or filename1='thumb.jpg' or filename1='thumb.jpeg')";
			$ds->open($sql);
			if(!$ds->eof)
			{
				$remote_width=$ds->row["width"];
				$remote_height=$ds->row["height"];
				$flag_storage=true;
			}
		}
		
		
		

		
		
		if(!$flag_storage)
		{
			$size = @getimagesize ($_SERVER["DOCUMENT_ROOT"].$img_url);
			$img_width=round($size[0]/2);
			$img_height=round($size[1]/2);
		}
		else
		{
			$img_width=round($remote_width/2);
			$img_height=round($remote_height/2);
		}
         ?>
         $('#map1').gmap('addMarker', 
         	{
         		'position': '<?=$rs->row["google_x"]?>,<?=$rs->row["google_y"]?>', 
         		'bounds': true,
         		/*
         		'icon':
         		{
         			'url':'<?=$img_url?>',
         			'size':
         			{
         				'width':'<?=$img_width?>', 
         				'height':'<?=$img_height?>'
         			}
         		},
         		*/
         	} 
         ).click(function() 
         {
			$('#map1').gmap('openInfoWindow', {'content': '<a href="<?=item_url($rs->row["id"])?>"><img border="0" src="<?=$img_url?>"></a><div style="padding:5px 0px 3px 0px"><a href="<?=item_url($rs->row["id"])?>"><b><?=addslashes(str_replace("\r","",str_replace("\n","",$rs->row["title"])))?></b></a></div><?=addslashes(str_replace("\r","",str_replace("\n","",$rs->row["description"])))?>'}, this);
		 })
		<?
		$n++;
		$rs->movenext();
	}
	?>
		});
	});
	</script>
	<div id="map1"></div>
	<?
}
?>


<?include("../inc/footer.php");?>