<?php
	session_start();
	if ($_SESSION['print_admin'] !== '#$ok*%'){
		header("location: ../admin/login.php");

	}
	    require('library/jdf.php');
        require('admin-settings.php');
?>
<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
	<meta charset="utf-8"/>
	<title>پنل مدیریت | شمیم</title>





	<link rel="stylesheet" type="text/css" href="../admin/library/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../admin/library/main.js"></script>
    <link type="text/css" href="styles/jquery-ui-1.8.14.css" rel="stylesheet" />
      <script type="text/javascript" src="scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="scripts/calendar.js"></script>

    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc-fa.js"></script>

    <script type="text/javascript" language="JavaScript" src="../../members/JsHttpRequest.js"></script>
    <script type="text/javascript" language="JavaScript">

        function doLoad3(value,type,status) {
            var req = new JsHttpRequest();
            // Code automatically called on load finishing.
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    document.getElementById('sstatus'+value).innerHTML =req.responseText;

                }
            }
            req.open(null, 'status/status_offset.php', true);
            req.send( {'id': document.getElementById("sf"+value), 'type': type ,'value': status }  );
        }
        </script>

    <script>
	$(function () {
    "use strict";

    $("img").click(function () {
        var $src = $(this).attr("src");
        $(".show").fadeIn();
        $(".img-show img").attr("src", $src);
    });

    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });

    });
    </script>

    <script type="text/javascript">
	    $(function() {

	        // استفاده از dropdown
	        $('#datepicker1').datepicker({
	            changeMonth: true,
	            changeYear: true
	        });

            $('#datepicker2').datepicker({
                changeMonth: true,
                changeYear: true
            });
						$('#datepicker4').datepicker({
							 changeMonth: true,
							 changeYear: true
					 });

							$('#datepicker5').datepicker({
									changeMonth: true,
									changeYear: true
							});

			       $('#datepicker3').datepicker({
	            changeMonth: true,
	            changeYear: true,
			 altField: '#d',
    onSelect : function(){
        $('#bydate').submit();
    }
	        });


	    });
    </script>

    <script>

     function refresh() {

    setTimeout(function(){
    window.location.reload();
    },1000)
     }

    </script>

    <style type="text/css">
        *

		p.ui-state-hover
		{
			font-weight: normal;
		}
        p.ui-widget-header
        {
            text-align: center;
            font-weight: normal;
        }
        strong.ui-state-error
        {
            display: block;
            padding: 3px;
            text-align: center;
        }
    </style>
</head>
<body>

	<header>
		<a href="#"><img src="../admin/library/images/logo.png" class="admin-header-logo"></a>
		<a href="login.php?logout=true" target="_blank" class="admin-header-link">خروج از پنل مدیریت</a><a href="<?php
            require ('../config.php');
            echo $site_root_adress; ?>" target="_blank" class="admin-header-link">مشاهده وب سایت</a><p class="admin-header-text">مدیر گرامی، خوش آمدید.</p>
	</header>
