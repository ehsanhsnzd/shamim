<!DOCTYPE html>
<html>
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
<div id="wrapper_line_mobile" class="visible-phone"></div>
<div id="wrapper_top">
	<div class="container">
		<div class="top1">
			<div id="box_languages" class="hidden-phone hidden-tablet">
				{LANGUAGES_LITE2}
			</div>
			<div id="box_members">
				{BOX_MEMBERS}
			</div>	
		</div>
		<div class="row-fluid">
			<div class="span10">
				<div class="hidden-phone hidden-tablet">
					{HORIZONTAL_MENU}
				</div>
				<div id="top_mobile" class="visible-phone visible-tablet">
					<ul>
    					<li><a href="{SITE_ROOT}members/shopping_cart.php">{lang.Shopping cart}</a></li>
    					<li><a href="{SITE_ROOT}members/categories.php">{lang.Categories}</a></li>
    					<li><a href="{SITE_ROOT}members/languages_list.php">{lang.Languages}</a></li>
    				</ul>
				</div>
			</div>
			<div class="span2">
				
				
				<div id="box_cart" class="hidden-phone hidden-tablet">
					{BOX_SHOPPING_CART_LITE}
				</div>
			</div>
		</div>	
	</div>
</div>

<div  class="container">

	<div class="row">
		<div class="span4">
			<div id="logo">
				<a href="{SITE_ROOT}"><img src="{TEMPLATE_ROOT}images/logo.png" alt="{SITE_NAME}"></a>
				<div class="visible-phone visible-tablet">
					<form method='get' action='{SITE_ROOT}index.php'>
						<div class="input-append">
							<input class="span2" name='search' id="appendedInputButton" size="20" type="text"><button class="btn" type="submit">{lang.Search}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="span8">
			<div id="box_search" class="hidden-phone hidden-tablet">
				{BOX_SEARCH}
			</div>
		</div>
	</div>

	<div class="body_content_home">

		<script src="{SITE_ROOT}inc/slides.jquery.js"></script>
		<script>
			$(function(){
				$('#slides').slides({
					preload: true,
					preloadImage: '{TEMPLATE_ROOT}images/slideshow/loading.gif',
					play: 5000,
					pause: 2500,
					hoverPause: true
				});
			});
		</script>
		
		<div class="hidden-phone hidden-tablet">
			<div class="t"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr">
				<div id="slideshow_body">
					<div id="slides">
						<div class="slides_container">
							<div class="slide">
								<a href="{SITE_ROOT}stock-photo/monastery-7470.html" title=""><img src="{SITE_ROOT}images/slide1.jpg" width="970" height="400" alt="Slide 1"></a>
							</div>
							<div class="slide">
								<a href="{SITE_ROOT}stock-photo/sewer-manhole-7471.html" title=""><img src="{SITE_ROOT}images/slide2.jpg" width="970" height="400" alt="Slide 2"></a>
							</div>
							<div class="slide">
								<a href="{SITE_ROOT}stock-photo/arrogant-cat-7464.html" title=""><img src="{SITE_ROOT}images/slide3.jpg" width="970" height="400" alt="Slide 3"></a>
							</div>
							<div class="slide">
								<a href="{SITE_ROOT}stock-photo/fortress-7466.html" title=""><img src="{SITE_ROOT}images/slide4.jpg" width="970" height="400" alt="Slide 4"></a>
							</div>
						</div>
						<a href="#" class="prev"><img src="{TEMPLATE_ROOT}images/slideshow/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
						<a href="#" class="next"><img src="{TEMPLATE_ROOT}images/slideshow/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
					</div>
				</div>
			</div></div></div></div></div></div></div></div>
		</div>
		
		<div class="visible-phone visible-tablet" style="margin-top:-40px"></div>
	
		<div class="home_text">
			<h1>Join Us Today</h1>
			<p>Photo Video Store is a media stock site and photographers community. Every user has different communuty tools: personal blog, messages, reviews, testimonials, friends, avatars.</p>
			<p>Search for royalty-free stock photography, vector illustrations, stock video footage and audio files. Buy stock with Photo Video Store by Credits or get a Subscription.</p>
			
			<script src="{SITE_ROOT}inc/jquery.masonry.min.js"></script>
			<script src="{TEMPLATE_ROOT}custom_home.js"></script>
			
			<div id="tabs" class="hidden-phone hidden-tablet">
				<ul>
					<li id="menu_downloaded" class="tact"><a href="javascript:zcomponent(18,'downloaded',1);"><span>{lang.Most downloaded}</span></a></li>
					<li id="menu_featured"><a href="javascript:zcomponent(19,'featured',1);"><span>{lang.Featured}</span></a></li>
					<li id="menu_popular"><a href="javascript:zcomponent(20,'popular',1);"><span>{lang.Most popular}</span></a></li>
					<li id="menu_new"><a href="javascript:zcomponent(21,'new',1);"><span>{lang.New}</span></a></li>
					<li id="menu_free"><a href="javascript:zcomponent(22,'free',1);"><span>{lang.Free}</span></a></li>
					<li id="menu_random"><a href="javascript:zcomponent(23,'random',1);"><span>{lang.Random}</span></a></li>
				</ul>
			</div>
		</div>
		
		<div id="home_boxes" class="hidden-phone hidden-tablet">
		</div>
	
		<script>
			zcomponent(18,'downloaded',1);
		</script>
		
		<div class="visible-phone visible-tablet" style="margin-top:-60px"></div>

	</div>
</div>

<div id="footer">
	<div id="footer_content" class="container">
		<div id="footer1">
			<div class="hidden-phone">
				<h6>{lang.Media Stock}</h6>
				<ul>
					<li><a href="{SITE_ROOT}">{lang.Home}</a></li>
					{if sitephoto}<li><a href="{SITE_ROOT}index.php?sphoto=1">{lang.Photos}</a></li>{/if}
					{if sitevideo}<li><a href="{SITE_ROOT}index.php?svideo=1">{lang.Video}</a></li>{/if}
					{if siteaudio}<li><a href="{SITE_ROOT}index.php?saudio=1">{lang.Audio}</a></li>{/if}
					{if sitevector}<li><a href="{SITE_ROOT}index.php?svector=1">{lang.Vector}</a></li>{/if}
					<li><a href="{SITE_ROOT}members/categories.php">{lang.Categories}</a></li>
				</ul>
			</div>
			<div id="box_stat2"  class="visible-phone">
				{BOX_STAT}
			</div>
		</div>
		<div id="footer2" class="hidden-phone">
			<h6>{lang.Customers}</h6>
			<ul>
				<li><a href="{SITE_ROOT}members/users_list.php">{lang.Users}</a></li>
				{if sitecredits}<li><a href="{SITE_ROOT}members/credits.php">{lang.Buy Credits}</a></li>{/if}
				{if sitesubscription}<li><a href="{SITE_ROOT}members/subscription.php">{lang.Buy Subscription}</a></li>{/if}
			</ul>
		</div>
		<div id="footer3" class="hidden-phone hidden-tablet">
			<h6>{lang.Site Info}</h6>
			<ul>
				<li><a href="{SITE_ROOT}pages/about.html">{lang.About}</a></li>
				<li><a href="{SITE_ROOT}pages/support.html">{lang.Support}</a></li>
				<li><a href="{SITE_ROOT}pages/privacy-policy.html">{lang.Privacy Policy}</a></li>
				<li><a href="{SITE_ROOT}pages/faq.html">{lang.FAQ}</a></li>
				<li><a href="{SITE_ROOT}news/">{lang.News}</a></li>
			</ul>
		</div>
		<div id="footer4" class="hidden-phone hidden-tablet">
			<h6>{lang.Support}</h6>
			<ul>
				<li><a href="{SITE_ROOT}contacts/">{lang.Contacts}</a></li>
			</ul>
		</div>
		<div id="footer5" class="hidden-phone hidden-tablet">{TELEPHONE}</div>
		<div id="footer6" class="hidden-phone">
			<div id="box_stat">
				{BOX_STAT}
			</div>
		</div>
		<div id="footer7">Copyright &copy; 2013 Photo Video Store<span class="hidden-phone"> - {lang.All rights reserved}</span></div>
		<div id="footer8" class="hidden-phone">
			<div id="box_social">
				<ul>
					<li class="facebook" onClick="location.href=''"></li>
					<li class="google" onClick="location.href=''"></li>
					<li class="twitter" onClick="location.href=''"></li>
				</ul>
			</div>
		</div>
	</div>
</div>


<div id="scroll_box" class="hidden-phone hidden-tablet"></div>
<script src="{SITE_ROOT}inc/jquery.scrollTo-1.4.2-min.js"></script>
</body>
</html>