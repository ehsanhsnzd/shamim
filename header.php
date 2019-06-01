<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
 

	<link rel="stylesheet" href="library/jquery.treeview.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script src="library/jquery.cookie.js" type="text/javascript"></script>
	<script src="library/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="library/demo.js"></script>
	
 
<script type="text/javascript" src="dist/jR3DCarousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var slides = [{src: 'images/cube banner-100.jpg'}, {src: 'images/cube banner-200.jpg'}, {src: 'images/cube banner-300.jpg'}]
	var jR3DCarousel;
	var carouselProps =  {
			 		  width: 400, 				/* largest allowed width */
					  height: 267, 				/* largest allowed height */
					  slideLayout : 'fill',     /* "contain" (fit according to aspect ratio), "fill" (stretches object to fill) and "cover" (overflows box but maintains ratio) */
					  animation: 'slide3D', 		/* slide | scroll | fade | zoomInSlide | zoomInScroll */
					  animationCurve: 'ease',
					  animationDuration: 2000,
					  animationInterval: 1000,
					  //slideClass: 'jR3DCarouselCustomSlide',
					  autoplay: true,
					  onSlideShow: show,		/* callback when Slide show event occurs */
					  navigation: null,	/* circles | squares */
					  slides: slides 			/* array of images source or gets slides by 'slide' class */
						  
				}
	function setUp(){
 		jR3DCarousel = $('.jR3DCarouselGallery').jR3DCarousel(carouselProps);

		$('.settings').html('<pre>$(".jR3DCarouselGallery").jR3DCarousel('+JSON.stringify(carouselProps, null, 4)+')</pre>');		
		
	}
	function show(slide){
		console.log("Slide shown: ", slide.find('img').attr('src'))
	}
	$('.carousel-props input').change(function(){
		if(isNaN(this.value))
			carouselProps[this.name] = this.value || null; 
		else
			carouselProps[this.name] = Number(this.value) || null; 
		
		for(var i = 0; i < 999; i++)
	     clearInterval(i);
		$('.jR3DCarouselGallery').empty();
		setUp();
		jR3DCarousel.showNextSlide();
	})
	
	$('[name=slides]').change(function(){
		carouselProps[this.name] = getSlides(this.value); 
		for (var i = 0; i < 999; i++)
	     clearInterval(i);
		$('.jR3DCarouselGallery').empty();
		setUp();
		jR3DCarousel.showNextSlide();		
	});
	
	function getSlides(no){
		slides = [];
		for ( var i = 0; i < no; i++) {
			slides.push({src: 'https://unsplash.it/'+Math.floor(1366-Math.random()*200)+'/'+Math.floor(768+Math.random()*200)})
		}
		return slides;
	}
	
	//carouselProps.slides = getSlides(7);
	setUp()

  })
</script>



<script>
function scrollit(object){

$('html, body').animate({
    scrollTop: object.offset().top
}, 1000);
}
</script>


<style type="text/css">
body {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	background: darkcyan;
}

.container {
	width:100%;
	padding-right: 15px;
	padding-left: 15px;
	margin-right: auto;
	margin-left: auto;
	text-align:left;
 
 
}

.jR3DCarouselGallery,.jR3DCarouselGallery1 {
	margin: 0 auto; /* optional - if want to center align */
}

.container {
	text-align: center;
}

.wrapper {
	padding-right: 10px;
	padding-left: 10px;
	width: 48%;
	height: 299px;
	float: left;
	overflow: auto;
	border-left: 1px solid #999;
}

.wrapper div {
	margin: 8px auto;
}
</style>


	<meta charset="utf-8"/>
	<?php
	require ('db_select.php');

	$site_mainpage_name=mysqli_query($connection, "SELECT * FROM site_settings WHERE id = '1'");
				$smn_row = mysqli_fetch_array($site_mainpage_name);
				$first_page_title_var = $smn_row['first_page_title'];
	?>
	<title><?php echo $first_page_title_var; ?></title>
	<link rel="stylesheet" type="text/css" href="library/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery.bxslider.css">
 <link rel="stylesheet" type="text/css" href="library/assets/animate.css" />
 	<link rel="stylesheet" type="text/css" href="library/component.css" />


</head>
<body>

<? require ("home_menu.php"); ?>