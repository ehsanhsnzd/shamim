<??>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("status")?>:</b></th>
<th><b><?=word_lang("day")?></b></th>
<th><b><?=word_lang("week")?></b></th>
<th><b><?=word_lang("month")?></b></th>
<th><b><?=word_lang("year")?></b></th>
</tr>
<tr>
<td><b><?=word_lang("approved")?></b></td>
<td>
<?
	$count_param=0;
	$sql="select count(id) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by status";
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
<td><b><?=word_lang("pending")?></b></td>
<td>
<?
	$count_param=0;
	$sql="select count(id) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by status";
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
<td><b><?=word_lang("quantity")?></b></td>
<td>
<?
	$count_param=0;
	$sql="select count(id) as count_param from orders where data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by status";
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
	$sql="select count(id) as count_param from orders where data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by status";
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
<td><b><?=word_lang("Total")?> (<?=word_lang("pending")?>)</b></td>
<td>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=0 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
</tr>




<tr>
<td><b><?=word_lang("Total")?> (<?=word_lang("approved")?>)</b></td>
<td><b>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
	echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
	$count_param=0;
	$sql="select sum(total) as count_param from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by status";
	$rs->open($sql);
	if(!$rs->eof)
	{
		$count_param=$rs->row["count_param"];
	}
echo(float_opt($count_param,2));
?>
</td>
</tr>
</table>
</div></div></div></div></div></div></div></div>
