<??>
<?
//Check access
admin_panel_access("catalog_upload");

$sql="select id_parent,title,description,folder,published,userid,viewed,downloaded,data,server1,model,refuse_reason from ".$table." where examination=0 and userid>0 ".$com." ".$com2;

$rs->open($sql);
$record_count=$rs->rc;

//limit
$lm=" limit ".($kolvo*($str-1)).",".$kolvo;
$sql.=$lm;

$tr=1;
$rs->open($sql);
if(!$rs->eof)
{





?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="5" cellspacing="1" class="table_admin" style="width:100%">
<tr>
<th><?=word_lang("preview")?></th>

<th nowrap class="hidden-phone hidden-tablet"><a href="index.php?d=<?=$d?>&status=<?=$pstatus?><?=$varsort_id?>">ID</a> <?if($pid==1){?><img src="<?=site_root?>/admin/images/sort_up.gif"><?}?><?if($pid==2){?><img src="<?=site_root?>/admin/images/sort_down.gif"><?}?></th>



<th nowrap class="hidden-phone hidden-tablet"><a href="index.php?d=<?=$d?>&status=<?=$pstatus?><?=$varsort_title?>"><?=word_lang("title")?></a>  <?if($ptitle==1){?><img src="<?=site_root?>/admin/images/sort_up.gif"><?}?><?if($ptitle==2){?><img src="<?=site_root?>/admin/images/sort_down.gif"><?}?></th>

<th nowrap><a href="index.php?d=<?=$d?>&status=<?=$pstatus?><?=$varsort_user?>"><?=word_lang("user")?></a>  <?if($puser==1){?><img src="<?=site_root?>/admin/images/sort_up.gif"><?}?><?if($puser==2){?><img src="<?=site_root?>/admin/images/sort_down.gif"><?}?></th>



<th nowrap class="hidden-phone hidden-tablet"><a href="index.php?d=<?=$d?>&status=<?=$pstatus?><?=$varsort_data?>"><?=word_lang("date")?></a>  <?if($pdata==1){?><img src="<?=site_root?>/admin/images/sort_up.gif"><?}?><?if($pdata==2){?><img src="<?=site_root?>/admin/images/sort_down.gif"><?}?></th>

<th><?=word_lang("status")?></th>
<th class="hidden-phone hidden-tablet"><?=word_lang("reason for rejection")?></th>
<?if($site_model){?>
<th class="hidden-phone hidden-tablet"><?=word_lang("models")?></th>
<?}?>

<th><?=word_lang("delete")?></th>
</tr>
<?
while(!$rs->eof)
{










$id_parent=0;
$sql="select id_parent from structure where id=".$rs->row["id_parent"];
$ds->open($sql);
if(!$ds->eof)
{
$id_parent=$ds->row["id_parent"];
}

$preview_url="../catalog/content.php?id=".$rs->row["id_parent"];
$preview_url2="";

if($table=="photos")
{
	$delete_url="2";
	$edit_url="30";
	$preview=show_preview($rs->row["id_parent"],"photo",1,1,$rs->row["server1"],$rs->row["folder"]);


	//Define if the publication is remote
	$flag_storage=false;
	$remote_file="";
	$remote_filename="";
	$remote_extention="";

	$sql="select url,filename1,filename2,width,height,item_id from filestorage_files where id_parent=".$rs->row["id_parent"]." and item_id<>0";
	$ds->open($sql);
	if(!$ds->eof)
	{
		$remote_file=$ds->row["url"]."/".$ds->row["filename2"];
		$remote_filename=$ds->row["filename1"];
		$flag_storage=true;
	}

	if(!$flag_storage)
	{
		$sql="select id,id_parent,url,price,price_id from items where id_parent=".$rs->row["id_parent"];
		$dr->open($sql);
		if(!$dr->eof)
		{
			$preview_url=site_root.server_url($rs->row["server1"])."/".$rs->row["folder"]."/".$dr->row["url"];
			$preview_url2=$_SERVER["DOCUMENT_ROOT"].site_root.server_url($rs->row["server1"])."/".$rs->row["folder"]."/".$dr->row["url"];
		}
	}
	else
	{
		$preview_url=$remote_file;
		$preview_url2=$preview_url;
	}

}

if($table=="videos")
{
	$delete_url="3";
	$edit_url="31";
	$preview=show_preview($rs->row["id_parent"],"video",1,1,$rs->row["server1"],$rs->row["folder"]);
}

if($table=="audio")
{
	$delete_url="4";
	$edit_url="52";

	$preview=show_preview($rs->row["id_parent"],"audio",1,1,$rs->row["server1"],$rs->row["folder"]);
}

if($table=="vector")
{
	$delete_url="5";
	$edit_url="53";

	$preview=show_preview($rs->row["id_parent"],"vector",1,1,$rs->row["server1"],$rs->row["folder"]);
}
















?>
<tr valign="top" <?if($tr%2==0){echo("class='snd'");}?>>
<td class='preview_img'><a href="<?=$preview_url?>" target="blank"><img src="<?=$preview?>" border="0"></a></td>
<td class="hidden-phone hidden-tablet"><?=$rs->row["id_parent"]?></td>


<td class="hidden-phone hidden-tablet"><div class="link_file"><a href='../catalog/content.php?id=<?=$rs->row["id_parent"]?>'><?=$rs->row["title"]?></a></div></td>
<td><?
$sql="select id_parent,login from users where id_parent=".$rs->row["userid"];
$ds->open($sql);
if(!$ds->eof)
{
?>
<div class="link_user"><a href="../customers/content.php?id=<?=$ds->row["id_parent"]?>"><?=$ds->row["login"]?></a></div>
<?
}
?></td>
<td class="gray hidden-phone hidden-tablet"><?=date(date_short,$rs->row["data"])?></td>
<td>
<div id="status<?=$rs->row["id_parent"]?>" name="status<?=$rs->row["id_parent"]?>">


<a href="javascript:fstatus(<?=$rs->row ["id_parent"]?>,1,'<?=$table?>');" <?if($rs->row["published"]!=1){?>class="gray"<?}?>><?=word_lang("approved")?></a><br>
<a href="javascript:fstatus(<?=$rs->row ["id_parent"]?>,0,'<?=$table?>');" <?if($rs->row["published"]!=0){?>class="gray"<?}?>><?=word_lang("pending")?></a><br>
<a href="javascript:fstatus(<?=$rs->row ["id_parent"]?>,2,'<?=$table?>');" <?if($rs->row["published"]!=2){?>class="gray"<?}?>><?=word_lang("declined")?></a>



</div>

</td>
<td class="hidden-phone hidden-tablet">

<div id="reason<?=$rs->row["id_parent"]?>" style="margin-bottom:5px;display:none">
<textarea id="reason_text<?=$rs->row["id_parent"]?>" class="ibox" style="width:200px;height:60px;margin-bottom:3px">
<?=$rs->row["refuse_reason"]?>
</textarea>
<input type="button" onClick="refuse_reason(<?=$rs->row["id_parent"]?>,'<?=$table?>')" class="isubmit" value="<?=word_lang("save")?>">
</div>


<div id="reason_edit<?=$rs->row["id_parent"]?>">
<div id="reason_content<?=$rs->row["id_parent"]?>"><?=$rs->row["refuse_reason"]?></div>
<a href="javascript:reason_open(<?=$rs->row["id_parent"]?>)"><?=word_lang("edit")?></a>

</div>
</td>
<?if($site_model){?>
<td class="hidden-phone hidden-tablet">
<?
if((int)$rs->row["model"]!=0)
{
?>
<a href="../models/content.php?id=<?=$rs->row["model"]?>"><?=word_lang("preview")?></a>
<?
}
?>
</td>
<?}?>


<td>
<div class="link_delete"><a href='delete.php?id=<?=$rs->row["id_parent"]?>&d=<?=$delete_url?>' onClick="return confirm('<?=word_lang("delete")?>?');"><?=word_lang("delete")?></a></div>
</td>
</tr>
<?
$tr++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>
<?
echo(paging2($record_count,$str,$kolvo,$kolvo2,"index.php","&d=".$d."&status=".$pstatus.$varsort));
}
else
{
echo("<p><b>".word_lang("not found")."</b></p>");
}
?>
