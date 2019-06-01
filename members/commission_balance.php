<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>

<h1><?=word_lang("my commission")?> &mdash; <?=word_lang("balance")?></h1>


<?if($site_credits==true){?>
<p><b><?=word_lang("price")?>:</b></p>
<?
$sql="select * from payout_price";
$rs->open($sql);
if(!$rs->eof)
{
?>
<?=$rs->row["title"]?> - <?=currency(1,false)?><?=float_opt($rs->row["price"],2)?> <?=currency(2,false)?>
<?
}
?>

<br>
<?}?>



<p><b><?=word_lang("balance")?>:</b></p>

<table border=0 cellpadding=0 cellspacing=0 class=profile_table width="100%">
<tr>
<th><b><?=word_lang("balance")?></b></th>
<th><b><?=word_lang("earning")?></b></th>
<th><b><?=word_lang("refund")?></b></th>
</tr>

<tr>
<td>

<?
$total=0;
$sql="select user,total from commission where user=".(int)$_SESSION["people_id"]." and status=1";
$ds->open($sql);
while(!$ds->eof)
{
$total+=$ds->row["total"];
$ds->movenext();
}
?>
<span class="price"><b><?=currency(1);?><?=float_opt($total,2)?> <?=currency(2);?></b></span>


</td>
<td>
<?
$total=0;
$sql="select user,total from commission where total>0 and user=".(int)$_SESSION["people_id"]." and status=1";
$ds->open($sql);
while(!$ds->eof)
{
$total+=$ds->row["total"];
$ds->movenext();
}
?>
<b><?=currency(1);?><?=float_opt($total,2)?> <?=currency(2);?></b>
</td>
<td>
<?
$total=0;
$sql="select user,total from commission where total<0 and user=".(int)$_SESSION["people_id"]." and status=1";
$ds->open($sql);
while(!$ds->eof)
{
$total+=$ds->row["total"];
$ds->movenext();
}
?>
<b><?=currency(1);?><?=float_opt((-1*$total),2)?> <?=currency(2);?></b>

</td>
</tr>
</table>
