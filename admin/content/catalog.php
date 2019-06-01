<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" style="width:100%">
<tr>
<th><b><?=word_lang("item")?>:</b></th>
<th><b><?=word_lang("approved")?></b></th>
<th><b><?=word_lang("pending")?></b></th>
</tr>
<tr>
<td><b><?=word_lang("category")?></b></td>
<td><a href="../categories/">
	<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from category where published=1 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
	?>
</a></td>
<td><a href="../categories/">
	<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from category where published=0 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
</tr>
<tr class="snd">
<td><b><?=word_lang("photo")?></b></td>
<td><a href="../catalog/index.php?type=photo&pub_type=approved">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from photos where published=1 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</a>
</td>
<td><a href="../catalog/index.php?type=photo&pub_type=pending">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from photos where published=0 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</a>
</td>
</tr>
<tr>
<td><b><?=word_lang("video")?></b></td>
<td><a href="../catalog/index.php?type=video&pub_type=approved">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from videos where published=1 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td><a href="../catalog/index.php?type=video&pub_type=pending">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from videos where published=0 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
</tr>
<tr class="snd">
<td><b><?=word_lang("audio")?></b></td>
<td><a href="../catalog/index.php?type=audio&pub_type=approved">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from audio where published=1 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td><a href="../catalog/index.php?type=audio&pub_type=pending">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from audio where published=0 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
</tr>
<tr>
<td><b><?=word_lang("vector")?></b></td>
<td><a href="../catalog/index.php?type=vector&pub_type=approved">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from vector where published=1 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td><a href="../catalog/index.php?type=vector&pub_type=pending">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from vector where published=0 group by published";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
</tr>
</table>
</div></div></div></div></div></div></div></div>