<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<head>

		<style>
			#playground-container{height:300px;-webkit-overflow-scrolling:touch}
			#preview-container{border-top:2px solid #CCC;border-bottom:2px solid #CCC;width:100%;height:100%}
			.preview-iframe{border:0;width:100%;height:100%}
			.playground-editor{padding:0;top:0;width:100%;border:2px solid #CCC;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}

		</style>

		<link href="{TEMPLATE_ROOT}assets/css/carousel.css" rel="stylesheet" >
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="{SITE_ROOT}images/favicon.gif" type="image/gif" rel="icon">
		<link href="{SITE_ROOT}images/favicon.gif" type="image/gif" rel="shortcut icon">
		<title>{SITE_NAME}</title>
		<meta name="description" content="{DESCRIPTION}">
		<meta name="keywords" content="{KEYWORDS}">
		<meta http-equiv="Content-Type" content="text/html; charset={MTG}">
		{META_SOCIAL}
 
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
         <link href="{TEMPLATE_ROOT}bootstrap.min.rtl.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" >
		<link href="{TEMPLATE_ROOT}assets/fonts/fontello/css/fontello.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
		<link href="{TEMPLATE_ROOT}assets/plugins/rs-plugin/css/settings.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/animations/2.1/css/animations.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" rel="stylesheet">		
		<link href="{TEMPLATE_ROOT}assets/css/style.css" rel="stylesheet" >
		<link href="{TEMPLATE_ROOT}assets/css/skins/light_blue.css" rel="stylesheet">
		<link href="{TEMPLATE_ROOT}style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="{TEMPLATE_ROOT}custom.js" type="text/javascript"></script>
		<script src="{SITE_ROOT}members/JsHttpRequest.js" type="text/javascript"></script>
		<script type="text/javascript">!function(){function t(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,localStorage.getItem("rayToken")?t.src="https://app.raychat.io/scripts/js/"+o+"?rid="+localStorage.getItem("rayToken")+"&href="+window.location.href:t.src="https://app.raychat.io/scripts/js/"+o;var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}var e=document,a=window,o="778e66bc-298e-486b-a76f-a24095f0592c";"complete"==e.readyState?t():a.attachEvent?a.attachEvent("onload",t):a.addEventListener("load",t,!1)}();</script>
	</head>
<body class="no-trans front-page transparent-header ">
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		<div class="page-wrapper">
			<div class="header-container">
				<div class="header-top dark ">
					<div class="container">
						<div class="row">
						 
							<div class="col-xs-9 col-sm-6 col-md-4">
								<div id="header-top-second"  class="clearfix">
									{BOX_MEMBERS}



								</div>
							</div>
                            
                            	<div class="col-xs-9 col-sm-6 col-md-4">
							 
							</div>

							<!-- -->
							<div class="col-xs-9 col-sm-6 col-md-4">
							<div class="header-dropdown-buttons">
					<ul class="list-inline hidden-sm hidden-xs">
										<li><i class="fa fa-phone pr-5 pl-10"></i>{TELEPHONE}</li>
										 
									</ul>


							
							</div>
							</div>

						</div>
					</div>
				</div>
                
                <div class="container">
						<div class="row">

 <div class="col-xs-9 col-sm-6 col-md-2">
   <div id="logo" class="logo" align="right">
								<a href="{SITE_ROOT}"><div id="logo" >شمیم</div></a>
							</div>
							<div class="site-slogan" align="right">
								کانون تبلیغاتی و چاپ
							</div>
         </div>  
            
             
            <div class="col-xs-9 col-sm-6 col-md-2">
		 
				<div class="header-left clearfix center" style="padding-bottom:10px">
					<div class="header-dropdown-buttons">


						<div class="btn-group dropdown"  id="cart_desktop"></div>
                        {BOX_SHOPPING_CART_LITE}
						<script>
                            cart_word='{lang.Cart}';
                            cart_word_checkout='{lang.Checkout}';
                            cart_word_view='{lang.View Cart}';
                            cart_word_subtotal='{lang.Subtotal}';
                            cart_word_total='{lang.Total}';
                            cart_word_qty='{lang.Quantity}';
                            cart_word_item='{lang.Item}';
                            cart_word_delete='{lang.Delete}';
                            cart_currency1='';
                            cart_currency2='تومان';
                            site_root='{SITE_ROOT}';
						</script>
					</div>
				</div>
            </div>
             <div class="col-xs-9 col-sm-6 col-md-7">
				<div id="box_search" class="hidden-phone hidden-tablet" style="padding:10px 0 0 0">
					{BOX_SEARCH}
				</div>
				<div id="box_search_mobile" class="visible-phone visible-tablet">
					<form method='get' action='{SITE_ROOT}index.php'>
						<div class="input-append">
							<input class="span2" name='search' id="appendedInputButton" size="20" type="text"><button class="btn" type="submit">{lang.Search}</button>
						</div>
					</form>
				</div>
			</div>
           
           
          
            
            </div>
            </div>
                
                
				<header class="header  fixed   clearfix">
					
					<div class="container">
						<div class="row">

							<div class="col-md-12">
								<div class="header-right clearfix">
								<div class="main-navigation  animated with-dropdown-buttons">
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>
											<div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
												{HORIZONTAL_MENU}

												<script>
                                                    $(document).ready(function(){
													 
														
                                                        $(".dropdown1").hover(
                                                            function() {
                                                                 
                                                                $(this).toggleClass('open');
                                                            },
                                                            function() {
                                                               
                                                                $(this).toggleClass('open');
                                                            }
                                                        );
                                                    });



												</script>
											</div>
										</div>
									</nav>
								</div>
								</div>
							</div>
						</div>
					</div>					
				</header>
			</div>









<script>
$(document).ready(function() {
    $('#carousel').carousel({
	    interval: 10000
	})
});
</script>



			<div id="playground-container" style="overflow: hidden">
			<div id="preview-container"><iframe id="snippet-preview" class="preview-iframe" src="templates/template20/slider.php"></iframe></div>
			</div>


 <section id="main-page-center" class="center">
        <a href="/users/new-order.php?service=32&quantity=1th&lot=1"><div id="main-page-new-order" class="main-page-block">
                <div id="main-page-new-order-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>

        <a href="/users/new-order-graphic.php?quantity=1th&lot=1"><div id="main-page-order-list" class="main-page-block">
                <div id="main-page-order-list-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>


        <a href="category/12514.html"><div id="main-page-accessories" class="main-page-block">
                <div id="main-page-accessories-img"></div>
                <h2>برای سفارش کلیک کنید</h2>
            </div></a>



    </section>

			<!-- section start -->
			<!-- ================ -->
			<section class="section default-bg clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action text-center">
								<div class="row">
									<div class="col-sm-8">
										<h1 class="title">برای عضویت کلیک کنید</h1>

									</div>
									<div class="col-sm-4">
										<br>
										<p><a href="members/signup.php" class="btn btn-lg btn-gray-transparent btn-animated">عضویت<i class="fa fa-arrow-right pl-20"></i></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>






			<br>




			<section class="stats padding-bottom-clear dark-translucent-bg hovered background-img-7" >




				<div class="footer-top animated-text" style="background-color:#3167B2;">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="call-to-action text-center">
									<div class="row">
										<div class="col-sm-8">
											<h3>با پرداخت 28,500 تومان 100,000 تومان اشتراک 10 روزه دریافت کنید</h3>
											<h3>با پرداخت 57,000 تومان 790,000 تومان اشتراک 1 ماهه دریافت کنید</h3>

										</div>
										<div class="col-sm-4">
											<p class="mt-10"><a href="{SITE_ROOT}members/subscription.php" class="btn btn-animated btn-lg btn-gray-transparent">{lang.خرید اشتراک}<i class="fa fa-cart-arrow-down pl-20"></i></a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

