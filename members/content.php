<?if(!defined("site_root")){exit();}?>
<? include("admin/function/show.php");?>


<?include("$DOCUMENT_ROOT/members/members_menu.php");?>


<?


if(count($_POST)==0 and (count($_GET)==0 or isset($_GET["template"])))
{







$homepage="";
if (!$smarty->is_cached('home.tpl',cache_id('home')) or $site_cache_home<0)
{
	$homepage=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."home.tpl");
	include("$DOCUMENT_ROOT/members/homepage.php");
}



if($site_cache_home>=0)
{
	if($site_cache_home>0)
	{
		$smarty->cache_lifetime = $site_cache_home*3600;
	}
	$smarty->assign('home', $homepage);
	$homepage=$smarty->fetch('home.tpl',cache_id('home'));
}






echo(translate_text($homepage));


}
else
{







if(!check_password(0,$id_parent,0))
{
	$boxcontent=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."item_protected.tpl");
	$boxcontent=str_replace("{WORD_PROTECTED}",word_lang("password protected"),$boxcontent);
	$boxcontent=str_replace("{ID_PARENT}",$id_parent,$boxcontent);
	$boxcontent=str_replace("{SITE_ROOT}",site_root."/",$boxcontent);
	$boxcontent=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$boxcontent);
	echo($boxcontent);
	$boxcontent="";
}
else
{



if($module_table==30 or $module_table==31 or $module_table==52 or  $module_table==53)
{
?>

	<?if($global_settings["google_coordinates"]){?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?=site_root?>/inc/jquery.ui.map.js"></script>
	<script type="text/javascript" language="JavaScript">
	function map_show(x,y)
	{
		document.getElementById('reviewscontent').style.display='none';
		document.getElementById('reviewscontent').innerHTML ="<h2>Google Map:</h2><div id='map'></div>";
		$("#reviewscontent").slideDown("slow");
         pos=x+","+y;
        $('#map').gmap({'zoom':11, 'center': pos}).bind('init', function(ev, map) {
                $('#map').gmap('addMarker', { 'position': map.getCenter(), 'bounds': false})
        });


	}
	</script>
	<?}?>


<script src='<?=site_root?>/admin/plugins/galleria/galleria-1.2.9.js'></script>
<script type="text/javascript" language="JavaScript">

//The function adds an item into the shopping cart
function add_cart(x)
{
	if(x==0)
	{
		value=document.getElementById("cart").value;
	}
	if(x==1)
	{
		value=document.getElementById("cartprint").value;
	}
    var req = new JsHttpRequest();
    
    
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
				if(document.getElementById('shopping_cart'))
				{
					document.getElementById('shopping_cart').innerHTML =req.responseJS.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite'))
				{
					document.getElementById('shopping_cart_lite').innerHTML =req.responseJS.box_shopping_cart_lite;
				}

				$.colorbox({html:req.responseJS.cart_content,width:'400px',scrolling:false});
        }
    }
    req.open(null, '<?=site_root?>/members/shopping_cart_add.php', true);
    req.send( {id: value } );
}



//The function shows prints previews

function show_prints_preview(id)
{
    var req = new JsHttpRequest();
        
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
        	$.colorbox({html:req.responseJS.prints_content,width:'600px',scrolling:false});
        }
    }
    req.open(null, '<?=site_root?>/members/prints_preview.php', true);
    req.send( {id: id } );
}




//The function shows a download link
function add_download(a_type,a_parent,a_server)
{
	if(document.getElementById("cart"))
	{
		location.href="<?=site_root?>/members/count.php?type="+a_type+"&id="+document.getElementById("cart").value+"&id_parent="+a_parent+"&server="+a_server;
	}
}





//Voting function
function doVote(value)
{
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('votebox').innerHTML =req.responseText;
        }
    }
    req.open(null, '<?=site_root?>/members/vote_add.php?id_parent=<?=$id_parent?>', true);
    req.send( { vote: value } );
}


//Show reviews
function reviews_show(value)
{
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('reviewscontent').innerHTML =req.responseText;
			document.getElementById('reviewscontent').style.display='none';
			$("#reviewscontent").slideDown("slow");
        }
    }
    req.open(null, '<?=site_root?>/members/reviews_content.php', true);
    req.send( { id: value } );
}


//Show EXIF
function exif_show(value)
{
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('reviewscontent').innerHTML =req.responseText;
			document.getElementById('reviewscontent').style.display='none';
			$("#reviewscontent").slideDown("slow");
        }
    }
    req.open(null, '<?=site_root?>/members/exif.php', true);
    req.send( { id: value } );
}

//Add a new review
function reviews_add(value)
{
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('reviewscontent').innerHTML =req.responseText;
			document.getElementById('reviewscontent').style.display='none';
			$("#reviewscontent").slideDown("slow");
        }
    }
    req.open(null, '<?=site_root?>/members/reviews_content.php', true);
    req.send( {'form': document.getElementById(value) } );
}

//Hide reviews
function reviews_hide()
{
	document.getElementById('reviewscontent').innerHTML ="";
	$("#reviewscontent").slideUp("slow");
}


//Show share tools
share_flag=true;
function share_show(value) 
{
	if(share_flag)
	{
    	var req = new JsHttpRequest();
   		 // Code automatically called on load finishing.
   		 req.onreadystatechange = function()
    	{
        	if (req.readyState == 4)
        	{
				document.getElementById('share').innerHTML =req.responseText;
				document.getElementById('share').style.display='none';
				$("#share").slideDown("slow");
        	}
		}
    	req.open(null, '<?=site_root?>/members/share.php', true);
    	req.send( { id: value } ); 
    	share_flag=false; 
	}
	else
	{
		$("#share").slideUp("slow");
		share_flag=true;
	}
}



//Show pixels/inches
function show_size(value)
{
	if($('#link_size1_'+value).hasClass('link_pixels'))
	{
		$('#p'+value+' div.item_pixels').css({'display':'none'});
		$('#p'+value+' div.item_inches').css({'display':'block'});
		$('#link_size1_'+value).removeClass("link_pixels");
		$('#link_size1_'+value).addClass("link_inches");
		$('#link_size2_'+value).removeClass("link_inches");
		$('#link_size2_'+value).addClass("link_pixels");
	}
	else
	{
		$('#p'+value+' div.item_pixels').css({'display':'block'});
		$('#p'+value+' div.item_inches').css({'display':'none'});
		$('#link_size1_'+value).removeClass("link_inches");
		$('#link_size1_'+value).addClass("link_pixels");
		$('#link_size2_'+value).removeClass("link_pixels");
		$('#link_size2_'+value).addClass("link_inches");
	}
}





//Show tell a friend
function tell_show(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('reviewscontent').innerHTML =req.responseText;
			document.getElementById('reviewscontent').style.display='none';
			$("#reviewscontent").slideDown("slow");
        }
    }
    req.open(null, '<?=site_root?>/members/tell_a_friend.php', true);
    req.send( { id: value } );
}


//Show tell a friend form
function tell_add(value)
{
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			document.getElementById('reviewscontent').innerHTML =req.responseText;
        }
    }
    req.open(null, '<?=site_root?>/members/tell_a_friend.php', true);
    req.send( {'form': document.getElementById(value) } );
}










//Related items scrolling
$(function()
{
  //Get our elements for faster access and set overlay width
  var div = $('div.sc_menu'),
  ul = $('ul.sc_menu'),
  // unordered list's left margin
  ulPadding = 15;

  //Get menu width
  var divWidth = div.width();

  //Remove scrollbars
  div.css({overflow: 'hidden'});

  //Find last image container
  var lastLi = ul.find('li:last-child');

  //When user move mouse over menu
  div.mousemove(function(e){

    //As images are loaded ul width increases,
    //so we recalculate it each time
    var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;

    var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
    div.scrollLeft(left);
  });
});



rimg=new Image()
rimg.src="<?=site_root."/".$site_template_url?>images/rating1.gif"

rimg2=new Image()
rimg2.src="<?=site_root."/".$site_template_url?>images/rating2.gif"

//Show rating
function mrating(j)
{
	for(i=1;i<6;i++)
	{
		if(i<=j)
		{
			document.getElementById("rating"+i.toString()).src =rimg.src
		}
	}
}

//Show rating2
function mrating2(item_rating)
{
	for(i=5;i>0;i--)
	{
		if(i>item_rating)
		{
			document.getElementById("rating"+i.toString()).src =rimg2.src
		}
	}
}


//Show prices by license
function apanel(x)
{

	sizeboxes=new Array();
	<?
	$sql="select id_parent from licenses order by priority";
	$rs->open($sql);
	$nn=0;
	while(!$rs->eof)
	{
		?>
		sizeboxes[<?=$nn?>]=<?=$rs->row["id_parent"]?>;
		<?
	$nn++;
	$rs->movenext();
	}
	
	if(($module_table==30 or  $module_table==53) and $site_prints)
	{
	?>
		//Prints
		sizeboxes[<?=$nn?>]=0;
	<?
	}
	?>
	
	//Hide item cart button
	if(document.getElementById("item_button_cart"))
	{
		if(x==0)
		{
			document.getElementById("item_button_cart").style.display='none';
		}
		else
		{
			document.getElementById("item_button_cart").style.display='block';
		}
	}


	for(i=0;i<sizeboxes.length;i++)
	{
		if(document.getElementById('p'+sizeboxes[i].toString()))
		{
			if(sizeboxes[i]==x)
			{
				document.getElementById('p'+sizeboxes[i].toString()).style.display ='inline';
			}
			else
			{
				document.getElementById('p'+sizeboxes[i].toString()).style.display ='none';
			}
		}
	}
}



//Show added items 
function xcart(x)
{

	cartitems=new Array();
	<?
	$sql="select id from items where id_parent=".$id_parent." order by priority";
	$rs->open($sql);
	$nn=0;
	while(!$rs->eof)
	{
		?>
		cartitems[<?=$nn?>]=<?=$rs->row["id"]?>;
		<?
	$nn++;
	$rs->movenext();
	}
	?>


	for(i=0;i<cartitems.length;i++)
	{
		if(document.getElementById('tr_cart'+cartitems[i].toString()))
		{
			if(cartitems[i]==x)
			{
				document.getElementById('tr_cart'+cartitems[i].toString()).className ='tr_cart_active';
				document.getElementById('cart').value =x;
			}
			else
			{
				document.getElementById('tr_cart'+cartitems[i].toString()).className ='tr_cart';
			}
		}
	}


	    var aRadio = document.getElementsByTagName('input'); 
	    for (var i=0; i < aRadio.length; i++)
	    { 
	        if (aRadio[i].type != 'radio') continue; 
	        if (aRadio[i].value == x) aRadio[i].checked = true; 
	    } 

}




//Show added prints
function xprint(x)
{

	printitems=new Array();
	<?
	$sql="select id_parent,title,price from prints_items where itemid=".(int)$id_parent." order by priority";
	$rs->open($sql);
	$nn=0;
	while(!$rs->eof)
	{
		?>
		printitems[<?=$nn?>]=<?=$rs->row["id_parent"]?>;
		<?
	$nn++;
	$rs->movenext();
	}
	?>


	for(i=0;i<printitems.length;i++)
	{
		if(document.getElementById('tr_cart'+printitems[i].toString()))
		{
			if(printitems[i]==x)
			{
				document.getElementById('tr_cart'+printitems[i].toString()).className ='tr_cart_active';
				document.getElementById('cartprint').value =-1*x;
			}
			else
			{
				document.getElementById('tr_cart'+printitems[i].toString()).className ='tr_cart';
			}
		}
	}


	    var aRadio = document.getElementsByTagName('input'); 
	    for (var i=0; i < aRadio.length; i++)
	    { 
	        if (aRadio[i].type != 'radio') continue; 
	        if (aRadio[i].value == -1*x) 
	        {
	        	aRadio[i].checked = true; 
	        }
	    } 

}

</script>

<?
}





if($module_table==30)
{
	//Show photo item
	include("content_photo.php");
}
elseif($module_table==31)
{
	//Show video item
	include("content_video.php");
}
elseif($module_table==52)
{
	//Show audio item
	include("content_audio.php");
}
elseif($module_table==53)
{
	//Show vector item
	include("content_vector.php");
}
else
{


?>

<script type="text/javascript" language="JavaScript">







//Add to cart on catalog listing
function add_cart(x)
{
	flag_add=true;
	x_number=0;
	value=x;
    var req = new JsHttpRequest();
    for(i=0;i<cart_mass.length;i++)
	{
		if(cart_mass[i]==x)
		{
			flag_add=false;
			x_number=i;
		}
	}
    
    if(flag_add)
    {
    	cart_mass[cart_mass.length]=x;
    	
    	// Code automatically called on load finishing.
    	req.onreadystatechange = function()
    	{
       	 	if (req.readyState == 4)
       	 	{
				if(document.getElementById('shopping_cart'))
				{
					document.getElementById('shopping_cart').innerHTML =req.responseJS.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite'))
				{
					document.getElementById('shopping_cart_lite').innerHTML =req.responseJS.box_shopping_cart_lite;
				}
				if(document.getElementById('cart'+value.toString()))
				{
					document.getElementById('cart'+value.toString()).innerHTML ="<a href='javascript:add_cart("+value+");' class='ac2'><?=word_lang("in your cart")?></a>";
				}
        	}
   	 	}
    	req.open(null, '<?=site_root?>/members/shopping_cart_add_light.php', true);
    	req.send( {id: value } );
    }
    else
    {
   	 	cart_mass[x_number]=0;
   	 	
   	 	// Code automatically called on load finishing.
    	req.onreadystatechange = function()
    	{
        	if (req.readyState == 4)
        	{
				if(document.getElementById('shopping_cart'))
				{
					document.getElementById('shopping_cart').innerHTML =req.responseJS.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite'))
				{
					document.getElementById('shopping_cart_lite').innerHTML =req.responseJS.box_shopping_cart_lite;
				}
				if(document.getElementById('cart'+value.toString()))
				{
					document.getElementById('cart'+value.toString()).innerHTML ="<a href='javascript:add_cart("+value+");' class='ac'><?=word_lang("add to cart")?></a>";
				}
        	}
   	 	}
   	 	req.open(null, '<?=site_root?>/members/shopping_cart_delete_light.php', true);
    	req.send( {id: value } );
    }
}




		$(function(){
		$('.preview_listing').each(function(){
     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.3'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});
		});

		});

</script>
<?


//Show item list
include("content_list.php");
}









}
}
?>