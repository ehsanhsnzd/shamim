<?$site="messages";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>


<?
$type="inbox";
?>



<?include("profile_top.php");?>
<?


//������� ��������
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}

//���������� �������� �� ��������
$kolvo=k_str;


//���������� ������� �� ��������
$kolvo2=k_str2;
?>

<input type="button" value="<?=word_lang("new message")?>" class="profile_button" onClick="location.href='messages_new.php'">

<h1><?=word_lang("messages")?> - <?=word_lang("inbox")?></h1>

<script language="javascript">
function publications_select_all(sel_form)
{
    if(sel_form.selector.checked)
   	{
        $("input:checkbox", sel_form).attr("checked",true);
    }
    else
    {
        $("input:checkbox", sel_form).attr("checked",false);
    }
}
</script>



<?

$sql="select id_parent,touser,fromuser,subject,data,viewed,trash,del from messages where touser='".result($_SESSION["people_login"])."' and trash=0 and del=0 order by data desc";
$rs->open($sql);
if(!$rs->eof)
{
	?>
	<form method="post" action="messages_to_trash.php" id="commentsform" name="commentsform">
	<table border="0" cellpadding="0" cellspacing="0" class="profile_table" width="100%">
	<tr>
	<th><input type="checkbox" id="selector" name="selector" onClick="publications_select_all(document.commentsform);"></th>
	<th><?=word_lang("from")?>:</th>
	<th width="50%"><?=word_lang("subject")?>:</th>
	<th class='hidden-phone hidden-tablet'><?=word_lang("date")?>:</th>
	</tr>
	<?
	$n=0;
	$tr=1;
	while(!$rs->eof)
	{
		if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
		{
			?>
			<tr <?if($tr%2==0){echo("class='snd'");}?>>
			<td><input type="checkbox" id="m<?=$rs->row["id_parent"]?>" name="m<?=$rs->row["id_parent"]?>" value="1"></td>
			<td nowrap><?=show_user_avatar($rs->row["fromuser"],"login")?></td>
			<td><div class="link_message"><a href="messages_content.php?m=<?=$rs->row["id_parent"]?>"><?if($rs->row["viewed"]==0){echo("<b>");}?><?=$rs->row["subject"]?></a></div></td>
			<td nowrap class='hidden-phone hidden-tablet'><div class="link_date"><?=date(datetime_format,$rs->row["data"])?></div></td>
			</tr>
			<?
		}
		$tr++;
		$n++;
		$rs->movenext();
	}
	?>
	</table><input class='isubmit' type="submit" value="<?=word_lang("delete")?>" style="margin-top:4px"></form>
	<?
	echo(paging2($n,$str,$kolvo,$kolvo2,"messages.php",""));
}
else
{
	echo("<b>".word_lang("not found")."</b>");
}
?>


<?include("profile_bottom.php");?>
<?include("../inc/footer.php");?>