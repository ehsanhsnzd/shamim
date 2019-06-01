<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("users_administrators");
?>
<? include("../inc/begin.php");?>



<div class="back"><a href="index.php" class="btn btn-mini"><i class="icon-arrow-left"></i> <?=word_lang("back")?></a></div>

<script language="javascript">
function publications_select_all(sel_form)
{
    if(sel_form.allrights.checked)
   	{
        $("input:checkbox", sel_form).attr("checked",true);
    }
    else
    {
        $("input:checkbox", sel_form).attr("checked",false);
    }
}
</script>


<h1><?=word_lang("administrators")?> &mdash; <?
if(!isset($_GET["id"]))
{
	echo(word_lang("add")." ");
}
else
{
	echo(word_lang("edit")." ");
}
?></h1>

<?
$user_fields=array();
$user_fields["login"]="";
$user_fields["name"]="";

$user_rights=array();


if(isset($_GET["id"]))
{
	$sql="select login,name from people where id=".(int)$_GET["id"];
	$rs->open($sql);
	if(!$rs->eof)
	{
		$user_fields["login"]=$rs->row["login"];
		$user_fields["name"]=$rs->row["name"];
	}
	
	$sql="select user_rights from people_rights where user=".(int)$_GET["id"];
	$rs->open($sql);
	while(!$rs->eof)
	{
		$user_rights[$rs->row["user_rights"]]=1;
		$rs->movenext();
	}
}
?>










<form method="post" action="add.php<?if(isset($_GET["id"])){echo("?id=".$_GET["id"]);}?>"  Enctype="multipart/form-data" id="adminform" name="adminform">

<div class="subheader"><?=word_lang("common information")?></div>
<div class="subheader_text">



	<div class='admin_field'>
	<span><?=word_lang("login")?>:</span>
	<input type="text" name="l" value="<?=$user_fields["login"]?>" style="width:150px">
	</div>

	<div class='admin_field'>
	<span><?=word_lang("password")?>:</span>
	<input type="password" name="p" value="<?if(isset($_GET["id"])){echo("********");}?>" style="width:150px">
	</div>
	

	<div class='admin_field'>
	<span><?=word_lang("confirm password")?>:</span>
	<input type="password" name="p2" value="<?if(isset($_GET["id"])){echo("********");}?>" style="width:150px">
	</div>
	
	<div class='admin_field'>
	<span><?=word_lang("name")?>:</span>
	<input type="text" name="name" value="<?=$user_fields["name"]?>" style="width:150px">
	</div>

</div>
	
	
<div class="subheader"><?=word_lang("access rights")?></div>
<div class="subheader_text">

<input type="checkbox" name="allrights" onClick="publications_select_all(document.adminform);">&nbsp;<?=word_lang("select all")?>


</div>

<?
for($i=0;$i<count($menu_admin);$i++)
{
	?>
	<div class="subheader"><?=preg_replace("/<i.*<\/i> /","",$menu_admin_name[$i])?></div>
	<div class="subheader_text">
	<?
	foreach ($submenu_admin as $key => $value) 
	{
		if(preg_match("/^".$menu_admin[$i]."_/",$key))
		{
			$sel="";
			if(isset($user_rights[$key]))
			{
				$sel="checked";
			}
			?>
			<div class="rights_point">
				<input type="checkbox" name="<?=$key?>" value="1" <?=$sel?>>&nbsp;<?=$value?>
			</div>
			<?
		}
	}
	?>
	</div>
	<?
}
?>



<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">
			<input type="submit" class="btn btn-primary" value="<?=word_lang("save")?>">
		</div>
	</div>




</form>




<? include("../inc/end.php");?>