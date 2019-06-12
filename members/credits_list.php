<??>
<p><b><?=word_lang("balance")?>: <span class="price"><?=currency(1)?><?=float_opt(credits_balance(),2)?> <?=currency(2)?></span></b></p>

<?
//������� ��������
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}

//���������� �������� �� ��������
$kolvo=k_str;

//���������� ������� �� ��������
$kolvo2=k_str2;



$sql="select quantity,data,title,approved,payment,expiration_date,id_parent from credits_list where user='".result($_SESSION["people_login"])."' order by data desc";
$rs->open($sql);
if(!$rs->eof)
{
?>
<table border="0" cellpadding="0" cellspacing="0"  class="profile_table" width="100%">
<tr>
<th class='hidden-phone hidden-tablet'><?=word_lang("date")?></th>
<th><?=word_lang("title")?></th>
<th class='hidden-phone hidden-tablet'><?=word_lang("quantity")?></th>
<th class='hidden-phone hidden-tablet'><?=word_lang("expiration date")?></th>
<th><?=word_lang("approved")?></th>
</tr>
<?
$tr=1;
$n=0;
while(!$rs->eof)
{
if($n>=$kolvo*($str-1) and $n<$kolvo*$str)
{
?>
<tr <?if($tr%2==0){echo("class='snd'");}?>>
<td class='hidden-phone hidden-tablet'><div class="link_date"><?=date(date_format,$rs->row["data"])?></div></td>
<td nowrap>
<?if($rs->row["quantity"]>0){?>
<div class="link_credits"><a href="payments.php?product_id=<?=$rs->row["id_parent"]?>&product_type=credits&print=1">
<?}else{?>
<div class="link_order">
<?}?>
<?=$rs->row["title"]?>
<?if($rs->row["quantity"]>0){?>
</a>
<?}?>
</div>
</td>
<td nowrap class='hidden-phone hidden-tablet'><?=float_opt($rs->row["quantity"],2)?></td>
<td class='hidden-phone hidden-tablet'>
<?
if($rs->row["quantity"]>0)
{
	if($rs->row["expiration_date"]==0)
	{
		echo(word_lang("never"));
	}
	else
	{
		echo("<div class='link_date'>".date(date_short,$rs->row["expiration_date"])."</div>");
	}
}
else
{
	echo("&#8212;");
}
?>
</td>
<td><?if($rs->row["approved"]==1){echo("<div class='link_approved'>".word_lang("approved")."</div>");}else{echo("<div class='link_pending'>".word_lang("pending")."</div>");}?></td>



</tr>
<?
}
$tr++;
$rs->movenext();
}
?>
</table>
<?
echo(paging2($n,$str,$kolvo,$kolvo2,"credits.php","&d=2"));
}
else
{
?>
<p><?=word_lang("not found")?>.</p>
<?
}
?>
