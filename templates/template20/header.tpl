<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="{TEMPLATE_ROOT}bootstrap.min.rtl.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" >
<link href="{TEMPLATE_ROOT}assets/fonts/fontello/css/fontello.css" rel="stylesheet">
<link href="{TEMPLATE_ROOT}assets/css/style.css" rel="stylesheet" >
<link href="{TEMPLATE_ROOT}assets/css/skins/light_blue.css" rel="stylesheet">
<link href="{TEMPLATE_ROOT}style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./slick/slick.css">
<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
<link rel="stylesheet/less" type="text/css" href="{TEMPLATE_ROOT}MainStyle.less" />
<script src="{TEMPLATE_ROOT}less.min.js" type="text/javascript"></script>
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

					<div class="col-xs-9 col-sm-6 col-md-8">
						<div id="header-top-second"  class="clearfix">
                            {BOX_MEMBERS}



						</div>
					</div>



					<!-- -->
					<div class="col-xs-9 col-sm-6 col-md-4">
						<div class="header-dropdown-buttons">
							<ul class="list-inline hidden-sm hidden-xs">
								<li class="fs20">{TELEPHONE}<i class="fa fa-phone-square pr-5 pl-10 large ocolor"></i></li>

							</ul>



						</div>
					</div>

				</div>
			</div>
		</div>

		<header class="header  fixed   clearfix">

			<div class="container">
				<div class="row">

					<div class="max_width">
						<center>
							<div class="top_on_bg">
								<br>
								<br>
								<div class="top_logo"></div>


								<div class="container">
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-2">
										</div>
										<div class="col-xs-4 col-sm-4 col-md-1 center">

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
										<div class="col-xs-11 col-sm-11 col-md-6" >
											<div id="box_search" class="hidden-phone hidden-tablet">
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

								<div class="inline_content"><img src="../images/subscription-text.png"/> </div>
								<div class="inline_content"><a href="../members/subscription.php" class="btn-subscription"></a> </div>

							</div>
						</center>
					</div>
				</div>
			</div>


			<header class="header  fixed   clearfix">

				<div class="container">
					<div class="row">

						<div class="col-md-12">
							<div class="header-right clearfix">
								<div class="animated with-dropdown-buttons">
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


	<br>
	<br>



	<div class="container">
