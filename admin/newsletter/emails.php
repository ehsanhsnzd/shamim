<?
//Check access
admin_panel_access("users_newsletter");


?>
<p>Here you can fing all user's emails with enabled 'Newsletter' option.</p>
<?
$emails_buyers="";
$emails_sellers="";
$emails_affiliates="";
$emails_common="";

$sql="select email,utype from users where accessdenied=0";
$rs->open($sql);
while(!$rs->eof)
{
if($rs->row["email"]!="")
{
	if($rs->row["utype"]=="buyer")
	{
		if($emails_buyers!="")
		{
			$emails_buyers.="; ";
		}
		$emails_buyers.=$rs->row["email"];
	}
	if($rs->row["utype"]=="seller")
	{
		if($emails_sellers!="")
		{
			$emails_sellers.="; ";
		}
		$emails_sellers.=$rs->row["email"];
	}
	if($rs->row["utype"]=="affiliate")
	{
		if($emails_affiliates!="")
		{
			$emails_affiliates.="; ";
		}
		$emails_affiliates.=$rs->row["email"];
	}
	if($rs->row["utype"]=="common")
	{
		if($emails_common!="")
		{
			$emails_common.="; ";
		}
		$emails_common.=$rs->row["email"];
	}
}
	$rs->movenext();
}

?>
<h2><?=word_lang("buyer")?>:</h2>
<textarea style="width:600px;height:150px;margin-left:6px"><?=$emails_buyers?></textarea>

<h2><?=word_lang("seller")?>:</h2>
<textarea style="width:600px;height:150px;margin-left:6px"><?=$emails_sellers?></textarea>

<h2><?=word_lang("affiliate")?>:</h2>
<textarea style="width:600px;height:150px;margin-left:6px"><?=$emails_affiliates?></textarea>

<h2><?=word_lang("common")?>:</h2>
<textarea style="width:600px;height:150px;margin-left:6px"><?=$emails_common?></textarea>
