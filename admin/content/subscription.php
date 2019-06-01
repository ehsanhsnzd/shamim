<?if(!defined("site_root")){exit();}?>
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="3" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><b><?=word_lang("approved")?>:</b></th>
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
$sql="select count(id_parent) as count_param from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600)." group by approved";
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
$sql="select count(id_parent) as count_param from subscription_list where data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600)." group by approved";
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
$sql="select subscription from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=0 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
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
$sql="select subscription from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-1*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-7*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-30*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
<td><b>
<?
$count_param=0;
$sql="select subscription from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600);
$rs->open($sql);
while(!$rs->eof)
{
$sql="select price from subscription where id_parent=".$rs->row["subscription"];
$ds->open($sql);
while(!$ds->eof)
{
$count_param+=$ds->row["price"];
$ds->movenext();
}
$rs->movenext();
}
echo(float_opt($count_param,2));
?>
</td>
</tr>
</table>
</div></div></div></div></div></div></div></div>