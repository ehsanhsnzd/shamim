<!DOCTYPE html>
<html lang="{LANG_SYMBOL}">
<head>
<title>{SITE_NAME}</title>
<link rel="stylesheet" type="text/css" href="{SITE_ROOT}inc/bootstrap/css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="{SITE_ROOT}inc/bootstrap/css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="{TEMPLATE_ROOT}style.css">
<script language="javascript" src="{SITE_ROOT}inc/scripts.js"></script>
<script src="{SITE_ROOT}inc/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="{SITE_ROOT}inc/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="{SITE_ROOT}inc/jquery.colorbox-min.js" type="text/javascript"></script>
<script src="{SITE_ROOT}members/JsHttpRequest.js" type="text/javascript"></script>
<script src="{TEMPLATE_ROOT}custom.js" type="text/javascript"></script>
<script language="javascript" src="{SITE_ROOT}inc/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
      <script src="{SITE_ROOT}inc/bootstrap/js/html5shiv.js"></script>
<![endif]-->
<meta name="description" content="{DESCRIPTION}">
<meta name="keywords" content="{KEYWORDS}">
<meta http-equiv="Content-Type" content="text/html; charset={MTG}">
{META_SOCIAL}
<link href="{SITE_ROOT}images/favicon.gif" type="image/gif" rel="icon">
<link href="{SITE_ROOT}images/favicon.gif" type="image/gif" rel="shortcut icon">
</head>
<body>
<div class="container-fluid">

      <div class="row-fluid">
    	<div class="span11">
    		<div class="hidden-phone">
    			{HORIZONTAL_MENU}
    		</div>
    		<div class="visible-phone" id="top_mobile">
    			<ul>
    				<li class="first"><a href="{SITE_ROOT}members/shopping_cart.php">{lang.Shopping cart}</a></li>
    				<li><a href="{SITE_ROOT}members/categories.php">{lang.Categories}</a></li>
    			</ul>
   	 		</div>
    	</div>
    	<div class="span1">
    		<div class="hidden-phone">
    			{LANGUAGES_LITE2}
    		</div>
    	</div>
    </div>
    
    <div class="row-fluid">
    	<div class="span4">
    		<div id="logo" class="hidden-phone">
    			<a href="{SITE_ROOT}"><img src="{TEMPLATE_ROOT}images/logo.png" alt="{SITE_NAME}"></a>
    		</div>
 			<div  id="logo-mobile" class="visible-phone">
    		 		<a href="{SITE_ROOT}"><img src="{TEMPLATE_ROOT}images/logo.png" alt="{SITE_NAME}"></a>
					<form method='get' action='{SITE_ROOT}index.php'>
						<div class="input-append">
							<input class="span2" name='search' id="appendedInputButton" size="26" type="text"><button class="btn" type="submit">{lang.Search}</button>
						</div>
					</form>
			</div>
    	</div>
    	<div class="span8">
    		<div id="box_search" class="hidden-phone">
    			{BOX_SEARCH}
    		</div>
    	</div>
    </div>
    
    <div class="row-fluid">
    	<div class="span10">{BOX_MEMBERS}</div>
    	<div class="span2">
    		<div class="hidden-phone">
    			{BOX_SHOPPING_CART_LITE}
    		</div>
    	</div>
    </div>
    
    <div class="hidden-phone">
    	<div class="home_body">
		<script type="text/javascript" src="{SITE_ROOT}inc/fadeslideshow.js">

/***********************************************
* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>
<script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [970, 400], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		["{SITE_ROOT}images/slide1.jpg", "{SITE_ROOT}photo/monastery-.html", "", ""],
		["{SITE_ROOT}images/slide2.jpg", "{SITE_ROOT}photo/sewer-manhole.html", "", ""],
		["{SITE_ROOT}images/slide3.jpg", "{SITE_ROOT}photo/arrogant-cat.html", "", ""],
		["{SITE_ROOT}images/slide4.jpg", "{SITE_ROOT}photo/fortress.html", "", ""]//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:3000, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 2500, //transition duration (milliseconds)
	descreveal: "always",
	togglerid: ""
})




</script>



			<div id="fadeshow1"></div>
		</div>
    </div>
    
    <div class="row-fluid home_content hidden-phone">
    	<div class="span9">
    	<script type="text/javascript" language="JavaScript">

ar_menu=new Array('downloaded','featured','popular','new','free','random');


function zcomponent(id,ctype) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
        
        
        for(i=0;i<ar_menu.length;i++)
        {
        document.getElementById('menu_'+ar_menu[i]).className="";
        }
        document.getElementById('menu_'+ctype).className="tact";
        
document.getElementById('tabs_content').innerHTML =req.responseText;
        }
    }
    req.open(null, '{SITE_ROOT}members/component_light.php', true);
    req.send( {id: id, ctype: ctype} );
}


zcomponent(13,'downloaded');
</script>
    	
    	
    	
    		<div id="tabs">
				<ul>
					<li id="menu_downloaded" class="tact"><a href="javascript:zcomponent(13,'downloaded');"><span>{lang.Most downloaded}</span></a></li>
					<li id="menu_featured"><a href="javascript:zcomponent(12,'featured');"><span>{lang.Featured}</span></a></li>
					<li id="menu_popular"><a href="javascript:zcomponent(14,'popular');"><span>{lang.Most popular}</span></a></li>
					<li id="menu_new"><a href="javascript:zcomponent(16,'new');"><span>{lang.New}</span></a></li>
					<li id="menu_free"><a href="javascript:zcomponent(17,'free');"><span>{lang.Free}</span></a></li>
					<li id="menu_random"><a href="javascript:zcomponent(15,'random');"><span>{lang.Random}</span></a></li>
				</ul>
			</div>

			<div id="tabs_content"></div>
    	
    	
    		<div class="home_text">
    			<h1>Join Us Today</h1>
				<p>Photo Video Store is a media stock site and photographers community. Every user has different communuty tools: personal blog, messages, reviews, testimonials, friends, avatars.</p>
				<p>Search for royalty-free stock photography, vector illustrations, stock video footage and audio files. Buy stock with Photo Video Store by Credits or get a Subscription.</p>
				
				<div class="home_tags hidden-phone">
					{BOX_TAG_CLOUDS}
				</div>
			</div>
    	</div>
    	<div class="span3">
    		<div class="home_box_right">
				<h2>{lang.Photographers}</h2>
				{BOX_PHOTOGRAPHERS}

				<h2>{lang.Stat}</h2>
				{BOX_STAT}

				<h2>{lang.Color}</h2>
				<map name="colors">
					<area href="{SITE_ROOT}index.php?color=red&sphoto=1" shape="rect" coords="0,0,20,20">
					<area href="{SITE_ROOT}index.php?color=orange&sphoto=1" shape="rect" coords="23,0,43,20">
					<area href="{SITE_ROOT}index.php?color=yellow&sphoto=1" shape="rect" coords="46,0,66,20">
					<area href="{SITE_ROOT}index.php?color=green&sphoto=1" shape="rect" coords="69,0,89,20">
					<area href="{SITE_ROOT}index.php?color=cian&sphoto=1" shape="rect" coords="92,0,112,20">
					<area href="{SITE_ROOT}index.php?color=blue&sphoto=1" shape="rect" coords="115,0,135,20">
					<area href="{SITE_ROOT}index.php?color=magenta&sphoto=1" shape="rect" coords="138,0,158,20">
					<area href="{SITE_ROOT}index.php?color=black&sphoto=1" shape="rect" coords="161,0,181,20">
				</map>
				<img src="{TEMPLATE_ROOT}images/colors.png" width="181" height="20" border="0"  usemap="#colors">
			</div>
    	</div>
    </div>
    <div class="visible-phone" id="stats_mobile">
    	<h1>Join Us Today</h1>
		<p>Photo Video Store is a media stock site and photographers community. Every user has different communuty tools: personal blog, messages, reviews, testimonials, friends, avatars.</p>
		<p>Search for royalty-free stock photography, vector illustrations, stock video footage and audio files. Buy stock with Photo Video Store by Credits or get a Subscription.</p>
    
    	{BOX_STAT}
    </div>
    <div class="row-fluid">
    	<div class="span12">
    		<div id="footer">
				<ul>
					<li><a href="{SITE_ROOT}">{lang.Home}</a>&nbsp;|&nbsp;</li>
					<li><a href="{SITE_ROOT}pages/about.html">{lang.About}</a>&nbsp;|&nbsp;</li>
					<li><a href="{SITE_ROOT}news/">{lang.News}</a>&nbsp;|&nbsp;</li>
					<li><a href="{SITE_ROOT}contacts/">{lang.Contacts}</a></li>
					<li class="visible-phone" >&nbsp;|&nbsp;<a href="{SITE_ROOT}members/languages_list.php">{lang.languages}</a></li>
				</ul>
				<div style='clear:both;'>
					Copyright &copy; 2013 Photo Video Store - {lang.All rights reserved}.
				</div>
			</div>
    	</div>
    </div>
    
</div>
</body>
</html>