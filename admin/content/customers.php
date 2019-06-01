<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("customers")?></b></th>
<th><b><?=word_lang("approved")?></b></th>
<th><b><?=word_lang("pending")?></b></th>
<th><b><?=word_lang("new")?></b></th>
</tr>
<tr>
<td><b><?=word_lang("buyer")?></b></td>
<td><a href="../customers/index.php?pub_type=buyer">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=0 and utype='buyer' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=1 and utype='buyer' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where utype='buyer' and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
</tr>
<tr class="snd">
<td><b><?=word_lang("seller")?></b></td>
<td><a href="../customers/index.php?pub_type=seller">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=0 and utype='seller' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=1 and utype='seller' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where utype='seller' and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
</tr>


<tr>
<td><b><?=word_lang("affiliate")?></b></td>
<td><a href="../customers/index.php?pub_type=affiliate">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=0 and utype='affiliate' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=1 and utype='affiliate' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where utype='affiliate' and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
</tr>



<tr class="snd">
<td><b><?=word_lang("common")?></b></td>
<td><a href="../customers/index.php?pub_type=common">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=0 and utype='common' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=1 and utype='common' group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where utype='common' and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by utype";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
</tr>




<tr>
<td><b><?=word_lang("total")?></b></td>
<td><a href="../customers/">
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=0 group by accessdenied";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?></a>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where accessdenied=1 group by accessdenied";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select count(id_parent) as count_param from users where data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by login";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo($count_param);
?>
</td>
</tr>
</table>
</div></div></div></div></div></div></div></div>