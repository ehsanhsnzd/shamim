<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("users_newsletter");
?>
<? include("../inc/begin.php");?>




<h1><?=word_lang("newsletter")?>:</h1>






<?
$d=1;
if(isset($_GET["d"])){$d=$_GET["d"];}
?>



<div class="tabbable">
    	<ul class="nav nav-tabs" style="margin:10px 6px 10px 6px">
    		<li <?if($d==1){echo("class='active'");}?>><a href="index.php?d=1"><?=word_lang("new message")?></a></li>
			<li <?if($d==2){echo("class='active'");}?>><a href="index.php?d=2"><?=word_lang("sentbox")?></a></li>
			<li <?if($d==3){echo("class='active'");}?>><a href="index.php?d=3"><?=word_lang("e-mail")?></a></li>
    	</ul>
</div>







<?if($d==1){include("new.php");}?>
<?if($d==2){include("list.php");}?>
<?if($d==3){include("emails.php");}?>












<? include("../inc/end.php");?>