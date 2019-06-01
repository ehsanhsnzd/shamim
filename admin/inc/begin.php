<!DOCTYPE html>
<html>
<head>
<title>PhotoStoreScript.com - Content Management System</title>
<meta HTTP-EQUIV="content-type" CONTENT="text/html;charset=<?=$mtg?>">
<link rel="stylesheet" type="text/css" href="<?=site_root?>/inc/bootstrap/css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=site_root?>/inc/bootstrap/css/bootstrap-responsive.css">
<link href="../images/favicon.gif" type="image/gif" rel="icon">
<link href="../images/favicon.gif" type="image/gif" rel="shortcut icon">
<link rel=stylesheet type="text/css" href="<?=site_root?>/admin/inc/style.css">
<script type="text/javascript" src="<?=site_root?>/inc/audio-player.js"></script>
<script type="text/javascript" src="<?=site_root?>/members/swfobject.js"></script>
<script type="text/javascript" src="<?=site_root?>/inc/jquery-1.7.2.min.js"></script>
<script src="<?=site_root?>/inc/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=site_root?>/inc/jquery.lightbox-0.5.js"></script>
<script src="<?=site_root?>/inc/jquery.colorbox.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=site_root?>/admin/inc/scripts.js"></script>
<script language="javascript" src="<?=site_root?>/inc/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
      <script src="<?=site_root?>/inc/bootstrap/js/html5shiv.js"></script>
<![endif]-->
<script>
$(document).ready(function(){
	$(".lbox").colorbox({width:"",height:"", inline:true, href:"#light_box"});
});
</script>
<link rel="stylesheet" type="text/css" href="<?=site_root?>/inc/jquery.lightbox-0.5.css" media="screen" />
    <script type="text/javascript">
    $(function() {
        $('#preview a').lightBox();
    });
    </script>
</head>

<body>
<div id="header">
	<div id="logo">
		<a href="../content/"><img src="<?=site_root?>/admin/images/design/logo.png" width="250" height="37" border="0"></a>
	</div>
	<div id="logout">
		<a href="../auth/exit.php"><?=word_lang("logout")?> [<?=$_SESSION["user_login"]?>]</a>
	</div>
	<div id="languages">
		<?
			$box_languages_lite="<div id='languages_lite'><a href='javascript:lopen();'>".$lang_name[$lng]."</a><span>&nbsp;</span></div><div id='languages_lite2'><a href='javascript:lopen();'><img src='../images/design/close.png' class='close'></a><ul>";
			$sql="select * from languages where display=1 order by name";
			$rs->open($sql);
			while(!$rs->eof)
			{
				$lt="";
				$sel="selected";
				if($lng!=$rs->row["name"]){$lt="2";$sel="";}

				$lng3=strtolower($rs->row["name"]);
				if($lng3=="chinese traditional"){$lng3="chinese";}
				if($lng3=="chinese simplified"){$lng3="chinese";}
				if($lng3=="afrikaans formal"){$lng3="afrikaans";}
				if($lng3=="afrikaans informal"){$lng3="afrikaans";}

				$box_languages_lite.="<li><a href='".site_root."/members/language.php?lang=".$rs->row["name"]."'><img src='".site_root."/admin/images/languages/".$lng3.$lt.".gif'>".$rs->row["name"]."</a></li>";
				$rs->movenext();
			}
			$box_languages_lite.="</ul></div>";
			echo($box_languages_lite);
		?>
	</div>
	<div class="clear"></div>

	<div id="menu">
		<ul>
			<?
				for($i=0;$i<count($menu_admin);$i++)
				{
					?>
					<li id="menu_<?=$menu_admin[$i]?>"><a href="#" onClick="javascript:fmenu('<?=$menu_admin[$i]?>')"><span><?=$menu_admin_name[$i]?></span></a></li>
					<?
				}
			?>
		</ul>
	</div>

	<script>
	flag_open=false

	function lopen()
	{
		if(flag_open==false)
		{
			$("#languages_lite2").slideDown("fast");
			flag_open=true;
		}
		else
		{
			$("#languages_lite2").slideUp("fast");
			flag_open=false;
		}
	}
	</script>
	
	<div class="clear"></div>
</div>
<div id="submenu">
<? include("../inc/menu.php");?>
</div>
<div id="wrapper">


<div class="page_t"><div class="page_b"><div class="page_l"><div class="page_r"><div class="page_bl"><div class="page_br"><div class="page_tl"><div class="page_tr">
<div id="content_body">

<? if ($_GET['error_d']==1){?>
<div id="error_d">ثبت نشد! کد تکراری است</div>


<? } ?>
