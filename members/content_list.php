<?
if(!defined("site_root")){exit();}

include("content_list_vars.php");
?>
<style>
/*New styles for the previews. It overwrites style.css file.*/
.item_list 
{ 
	width: <?=($global_settings["thumb_width"]+20)?>px;
}

.item_list_img
{
	width: <?=($global_settings["thumb_width"]+20)?>px;
	height: <?=($global_settings["thumb_width"]+20)?>px;
}

.item_list_text1,.item_list_text2,.item_list_text3,.item_list_text4
{
	width: <?=($global_settings["thumb_width"]+20)?>px;
}
</style>

<?
$search_page="<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr valign='top'>
		<td class='search_left'>
			{MENU}
		</td>
		<td class='search_right'>
			{RESULTS}
		</td>
	</tr>
</table>";

if(file_exists($DOCUMENT_ROOT."/".$site_template_url."catalog.tpl"))
{
	$search_page=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."catalog.tpl");
}

$search_page=str_replace("{MENU}","{SEPARATOR}",$search_page);
$search_page=str_replace("{RESULTS}","{SEPARATOR}",$search_page);

$search_parts=explode("{SEPARATOR}",$search_page);

$search_header=$search_parts[0];
$search_middle=@$search_parts[1];
$search_footer=@$search_parts[2];

?>


<?=$search_header?>
<form id='listing_form' method="get" action="<?=site_root?>/index.php" style="margin:0px">
<?
//Default variables

if(isset($_REQUEST["id_parent"]))
{
	echo("<input type='hidden' name='id_parent' value='".(int)$_REQUEST["id_parent"]."'>");
}

if(isset($_REQUEST["acategory"]))
{
	echo("<input type='hidden' name='acategory' value='".(int)$_REQUEST["acategory"]."'>");
}

if(isset($_REQUEST["items"]))
{
	echo("<input type='hidden' name='items' value='".(int)$_REQUEST["items"]."'>");
}

if(isset($_REQUEST["c"]))
{
	echo("<input type='hidden' name='c' value='".result($_REQUEST["c"])."'>");
}

$vars_categories=build_variables("id_parent","acategory",true,"category");
$vars_portfolio=build_variables("user","portfolio");
$vars_author=build_variables("author","");
$vars_lightbox=build_variables("lightbox","");

//End. Default variables.
?> 

	 
  
<?=$search_middle?>
<div class="search_header_mobile visible-phone"></div>
<div id="search_header">
	<?
	$search_title=word_lang("results");
	if($id_parent!=5)
	{
		$sql2="select title from category where id_parent=".(int)$id_parent;
		$dr->open($sql2);
		if(!$dr->eof)
		{
			$search_title=$dr->row["title"];
		}
	}
	?>
	<h1><?=$search_title?> <span> <?=$record_count?></span></h1>
 </div>
<div class="search_header_mobile visible-phone"></div>

<?
if($flow==1)
{
	?>
	<script src="<?=site_root?>/inc/jquery.masonry.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#flow_body').masonry({
                itemSelector: '.home_box'
            });

            $('.home_preview').each(function(){


                $(this).animate({opacity:'1.0'},1);
                $(this).mouseover(function(){
                    $(this).stop().animate({opacity:'0.6'},600);
                });
                $(this).mouseout(function(){
                    $(this).stop().animate({opacity:'1.0'},300);
                });


                $(".hb_cart").mouseover(function(){
                    $(this).stop().animate({ opacity: 1}, 600);

                });

                $(".hb_cart").mouseout(function(){
                    $(this).stop().animate({ opacity: 0.5}, 600);
                });

                $(".hb_lightbox").mouseover(function(){
                    $(this).stop().animate({ opacity: 1}, 600);
                });

                $(".hb_lightbox").mouseout(function(){
                    $(this).stop().animate({ opacity: 0.5}, 600);
                });

                $(".hb_free").mouseover(function(){
                    $(this).stop().animate({ opacity: 1}, 600);
                });

                $(".hb_free").mouseout(function(){
                    $(this).stop().animate({ opacity: 0.5}, 600);
                });


            });
        });
    </script>
    <script>
        str=2;
        flag_auto=true;
        res=" ";

        function auto_pvs_paging(page) {
            str=page;

            var req = new JsHttpRequest();
            // Code automatically called on load finishing.
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    if(page==1)
                    {
                        document.getElementById('flow_body').innerHTML =req.responseText;
                        res=req.responseText;
                    }
                    else
                    {
                        document.getElementById('flow_body').innerHTML = document.getElementById('flow_body').innerHTML + req.responseText;
                        res=req.responseText;
                        check_carts('In your cart');
                    }

                    $('#flow_body').masonry({
                        itemSelector: '.home_box'
                    });

                    $('#flow_body').masonry('reload') ;


                    $('.home_preview').each(function(){


                        $(this).animate({opacity:'1.0'},1);
                        $(this).mouseover(function(){
                            $(this).stop().animate({opacity:'0.6'},600);
                        });
                        $(this).mouseout(function(){
                            $(this).stop().animate({opacity:'1.0'},300);
                        });


                        $(".hb_cart").mouseover(function(){
                            $(this).stop().animate({ opacity: 1}, 600);

                        });

                        $(".hb_cart").mouseout(function(){
                            $(this).stop().animate({ opacity: 0.5}, 600);
                        });

                        $(".hb_cart2").mouseover(function(){
                            $(this).stop().animate({ opacity: 1}, 600);
                        });

                        $(".hb_cart2").mouseout(function(){
                            $(this).stop().animate({ opacity: 0.5}, 600);
                        });


                        $(".hb_lightbox").mouseover(function(){
                            $(this).stop().animate({ opacity: 1}, 600);
                        });

                        $(".hb_lightbox").mouseout(function(){
                            $(this).stop().animate({ opacity: 0.5}, 600);
                        });

                        $(".hb_free").mouseover(function(){
                            $(this).stop().animate({ opacity: 1}, 600);
                        });

                        $(".hb_free").mouseout(function(){
                            $(this).stop().animate({ opacity: 0.5}, 600);
                        });


                    });


                }
            }
            req.open(null, '/members/content_list_paging.php', true);
            req.send( {sphoto:'1',str: str,id_parent:5} );
            str++;

        }


        $(document).ready(function(){
            $(window).scroll(function(){
                if($(document).height() - $(window).height() - $(window).scrollTop() <150)
                {
                    if(flag_auto)
                    {
                        flag_auto=false;
                        if(res!="")
                        {
                            auto_pvs_paging(str);
                        }
                    }
                }
                else
                {
                    flag_auto=true;
                }
            });
        });
    </script>

    <?
}


if($autopaging==1)
{
	?>
	<script>
	str=2;
	flag_auto=true;
	res=" ";
	
	function auto_paging(page)
	{

		str=page;
	
    	var req = new JsHttpRequest();
   		 // Code automatically called on load finishing.
    	req.onreadystatechange = function() {
        if (req.readyState == 4) {
 		if(page==1)
 		{
			document.getElementById('flow_body').innerHTML =req.responseText;
			res=req.responseText;
		}
		else
		{
			document.getElementById('flow_body').innerHTML = document.getElementById('flow_body').innerHTML + req.responseText;
			res=req.responseText;
			check_carts('<?=word_lang("in your cart")?>');
		}

		<?
		if($flow==1)
		{
		?>
			$('#flow_body').masonry({
  			itemSelector: '.home_box'
			});
		
			$('#flow_body').masonry('reload') ;
		<?
		}
		?>
		
		
		$('.home_preview').each(function(){


     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.6'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});

    		
    		$(".hb_cart").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);

    		});

    		$(".hb_cart").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		
    		$(".hb_cart2").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_cart2").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
 		
    		
    		 $(".hb_lightbox").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_lightbox").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		
    		 $(".hb_free").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_free").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
        

		});


        }
    }
    req.open(null, '<?=site_root?>/members/content_list_paging.php', true);
    req.send( {<?=$flow_vars?>,str: str,id_parent:<?=$id_parent?>} );
    str++;

	}
	
	
	$(document).ready(function(){
		$(window).scroll(function(){
			if($(document).height() - $(window).height() - $(window).scrollTop() <150) 
    		{
    			if(flag_auto)
    			{
    				flag_auto=false;
    				if(res!="")
    				{
    					auto_paging(str);
    				}
    			}
    		}
    		else
    		{
    			flag_auto=true;
    		}
		});
	});
	</script>
	<?
}
?>


<div class='item_list_page center' align="center"  id="flow_body">
	<?
		include("content_list_items.php");

		//Show result
		echo($search_content);
	?>
</div>

<script>
check_carts('<?=word_lang("in your cart")?>');
</script>


<?
if($record_count>$kolvo and $autopaging==0)
{
?>
<div id="search_footer">
	<div id="search_paging2"><?=$paging_text?></div>
</div>
<?
}
?>


<?=$search_footer?>

