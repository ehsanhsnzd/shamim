<?if(!defined("site_root")){exit();}?>

<form method="post" action="secpay_change.php">
<?
$sql="select * from gateway_secpay";
$rs->open($sql);
if(!$rs->eof)
{
?>



<div class='admin_field'>
<span><?=word_lang("merchant id")?>:</span>
<input type='text' name='account'  style="width:400px" value="<?=$rs->row["account"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("password")?>:</span>
<input type='text' name='password'  style="width:400px" value="<?=$rs->row["password"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("mail subject")?>:</span>
<input type='text' name='subject'  style="width:400px" value="<?=$rs->row["subject"]?>">
</div>

<div class='admin_field'>
<span><?=word_lang("mail message")?>:</span>
<textarea name="message" style="width:400px;height:50px"><?=$rs->row["message"]?></textarea>
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
