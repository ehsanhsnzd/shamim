<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("templates_templates");




            $filename = $DOCUMENT_ROOT."/".$site_template_url.$_GET["file"];
            if (is_writeable($filename))
            {
              $file=fopen($filename,'w');
              if ($file)
               fputs($file,stripslashes($_POST["content"]));
              fclose($file);
            }









header("location:index.php?d=1");
?>