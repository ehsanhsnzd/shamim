<??>

<?
if($currency_egold==0)
{
?>
<p><font color="red">Error. E-gold does not support <b><?=$currency_code1?></b></font></p>
<?
}
?>


<form method="post" action="egold_change.php">
<?
$sql="select * from gateway_egold";
$rs->open($sql);
if(!$rs->eof)
{
?>


<div class='admin_field'>
<span><?=word_lang("account")?>:</span>
<input type='text' name='account'  style="width:400px" value="<?=$rs->row["account"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("name")?>:</span>
<input type='text' name='name'  style="width:400px" value="<?=$rs->row["name"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("alternative password")?>:</span>
<input type='text' name='password'  style="width:400px" value="<?=$rs->row["password"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("enable")?>:</span>
<input type='checkbox' name='enable' value="1" <?if($rs->row["activ"]==1){echo("checked");}?>>
</div>

<div class='admin_field'>
<span><?=word_lang("allow ipn")?>:</span>
<input type='checkbox' name='ipn' value="1" <?if($rs->row["ipn"]==1){echo("checked");}?>>
</div>


<?
}
?>
<input type="submit" class="btn btn-primary" value="<?=word_lang("change")?>" style="margin-top:3px">
</form>
