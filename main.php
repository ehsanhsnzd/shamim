<!DOCTYPE HTML>
<html lang="fa-IR">
<head>


<script type="text/javascript" src="library/jquery-1.8.0.min.js"></script>
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

<style type="text/css">
 
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
	 
	<title> شمیم</title>
	<link rel="stylesheet" type="text/css" href="library/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery.bxslider.css">
 <link rel="stylesheet" type="text/css" href="library/assets/animate.css" />
 

</head>
    
    
    
    
	<section id="homepage-top-section">
		<div id="top-section-div" align="left">
 
<br>


                <table  width="100%"    > <tr>
 <td>
 
 <div id="top-section-text">
 
<span id="top-section-big-text">کانون تبلیغاتی شمیم </span>
<span id="top-section-small-text">سفارش آنلاین چاپ  بنر , تراکت , کارت ویزیت, ...</span>
	</div>
    <br>
    <br>
<br>

    
    <br>
    
    
</td>
 </tr>
 
 
  <tr>
 <td valign="top"> 
 

 
 <aside style="  text-align:left; display:inline-block; vertical-align:top;">
 <a href="http://shamimbanner.ir" style="font-size:38px; color:#999898"  target="_blank">ShamimBanner.ir</a>
 <div style="font-size:20px">سفارش بنر<a href="http://shamimbanner.ir" style=" color:#16A144" target="_blank"> کلیک کنید</a></div>
 </aside>
 
  <aside style=" display:inline-block"><div style="width:2px; height:120px; background-color:#999898"></div></aside>
 
  <aside style=" padding: 0 56px 0 0; text-align:left; display:inline-block; vertical-align:top">
 <a href="http://shamimgraphic.ir" style="font-size:38px; color:#999898" target="_blank">ShamimGraphic.ir</a>
 <div style="font-size:20px">سفارش افست <a href="http://shamimgraphic.ir" style=" color:#16A144" target="_blank"> کلیک کنید </a>
</div><div>تراکت , کارت ویزیت , فاکتور </div>
 </aside>
 
  <aside style=" display:inline-block"><div style="width:2px; height:120px; background-color:#999898"></div></aside>
 <br>
<br>
<br>
<br>
<br><br>
<br>

 


</td>
</tr>


<tr>   
    <td align="center" >
 
 
    
          <div class="container" >
	<div class="jR3DCarouselGallery"  ></div>
		  </div> 
 
 </td>
 </tr>


 </table>
 <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

     
 </div>



 
	</section>



 
 



