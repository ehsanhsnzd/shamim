<?php
	session_start();
	if(!isset($_SESSION["people_id"])){header("location:login.php");}
	
	require('library/jdf.php');
?>
<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>شمیم | پنل کاربران</title>
	<link rel="stylesheet" type="text/css" href="../users/library/style.css">
 
    <link rel="stylesheet" type="text/css" href="../library/css/style.css">
 
<meta charset=utf-8 />
 
<link rel="stylesheet" href="library/nav.css" type="text/css"  />


   
    
    <!-- js -->
<script src="../users/library/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
		
		 $( '.dropdown' ).hover(
            function(){
                $(this).children('.sub-menu').slideDown(200);
            },
            function(){
                $(this).children('.sub-menu').slideUp(200);
            }
        );
		
		
		if ($(window).width() > 600) {     
              

		
        $( '.dropdown_sec' ).hover(
            function(){
                $(this).children('.sub-menu').slideDown(200);
            },
            function(){
                $(this).children('.sub-menu').slideUp(200);
            }
        );
		
		}
    }); // end ready
</script>
 
 
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->    

	<script type="text/javascript" src="/library/jquery-2.2.0.min.js"></script>
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../users/library/jquery.js" type="text/javascript"></script>
   
<script src="../users/library/main-photo.js" type="text/javascript"></script>
    

	<script type="text/javascript" src="../users/library/main.js"></script>
	<script src="../users/library/dropzone.js"></script>
 
	<link rel="stylesheet" href="../users/library/dropzone.css">
    
     <link rel="stylesheet" type="text/css" href="../library/assets/animate.css" />





   <link type="text/css" href="../admin/styles/jquery-ui-1.8.14.css" rel="stylesheet" />
      <script type="text/javascript" src="../admin/scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../admin/scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="../admin/scripts/calendar.js"></script>

    <script type="text/javascript" src="../admin/scripts/jquery.ui.datepicker-cc-fa.js"></script>

    <script type="text/javascript">
	    $(function() {
	     
 

	 
	 $('#datepicker').datepicker({
    onSelect: function(dateText, inst) { 
        window.location = '?service=<?=$_GET['service']?>&quantity=1th&type=<?=$_GET['type']?>&date=' + dateText;
    }
});
	 
	 
	        //-----------------------------------
 
	    });
    </script>  
    
      <script>
						
						$(function() {

$("img").click(function() {

    $("img").not(this).removeClass("hover");

    $(this).toggleClass("hover");

  });
 

});
	 function changeText(value,el) {
     document.getElementById('bannerc').value = value;   
 
 
}



 

 
</script>	
  
 
  
 
 
<link rel="stylesheet" type="text/css" href="../templates/template20/style.css">
 
 
 
  
  
</head>
<body>

<?php require ("user_menu.php");
?>
  
