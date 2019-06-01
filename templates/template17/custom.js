

$(document).ready(function(){

     $(".lanbox").colorbox({width:"730",height:"420", inline:true, href:"#languages_lite2"});
        
     $(".lbox").colorbox({width:"",height:"", inline:true, href:"#login_box"});
        
     $('#search').keyup(function() 
	{
 		 show_search();
	});
	
	
	$("#instant_search").hover
	(
			function () 
			{
				
			},
			function () 
			{
				$('#instant_search').slideUp("fast");
				document.getElementById('instant_search').innerHTML ="";
			}
	);
	
	$(window).scroll(function(){
    	if ($(window).scrollTop() > 500) 
    	{
    		$('#scroll_box').slideDown("slow");
   	 	}
    	else 
    	{
    		$('#scroll_box').slideUp("slow");
    	};
    });
    
    
    $("#scroll_box").click
    (
		function () 
		{
			$(window).scrollTo(0, 1000, {axis:'y'} );
		}
	);

});
    
    
    
    
    
