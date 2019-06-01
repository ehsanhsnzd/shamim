<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("templates_templates");
?>
<? include("../inc/begin.php");?>


<h1><?=word_lang("templates")?>:</h1>


<p>
You have 2 ways to modify the template's files:
</p>

<ul>
	<li>In the folder <b><?=site_root?>/<?=$site_template_url?></b> on ftp</li>
	<li>In the form below. The files must have writable permissions in the directory <b><?=site_root?>/<?=$site_template_url?></b></li>
</ul>

<p>You should refresh <a href="../caching/"><b>cache files</b></a> after you change a template.</p>



<br>


<select class="ft" style="width:250px;margin-left:6px" onChange="location.href='index.php?file='+this.value">
<option value=""><?=word_lang("select template file")?></option>
<?
echo($DOCUMENT_ROOT."/".$site_template_url);
if(file_exists($DOCUMENT_ROOT."/".$site_template_url))
{


  $dir = opendir ($DOCUMENT_ROOT."/".$site_template_url);

  while ($file = readdir ($dir)) 
  {
    if($file <> "." && $file <> ".." && $file <> "images" && $file <> ".DS_Store")
    {
$sel="";
if(isset($_GET["file"]) and $_GET["file"]==$file){$sel="selected";}
?>
<option value="<?=$file?>" <?=$sel?>><?=$file?></option>
<?

}
}
  closedir ($dir);
}
?>
</select>

<br><br>
<?
if(isset($_GET["d"])){echo("<p><b>The template has been modified successfully.</b></p>");}
?>
<?
if(isset($_GET["file"]))
{
?>
<form method="post" action="change.php?file=<?=$_GET["file"]?>">
<textarea name="content" style="width:800px;height:600px;margin-left:6px">
<?=file_get_contents($DOCUMENT_ROOT."/".$site_template_url.$_GET["file"])?>
</textarea><br>


	<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">
			<input type="submit" value="<?=word_lang("save")?>" class="btn btn-primary" style="margin-top:20px">
		</div>
	</div>

</form>
<?
}
?>



























<? include("../inc/end.php");?>