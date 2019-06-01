<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("users_newsletter");

if($_POST["subject"]!="" and ($_POST["message_text"]!="" or $_POST["message_html"]!=""))
{
	$content="";
	if($_POST["html"]==0)
	{
		$content=$_POST["message_text"];
		$content_db=result($_POST["message_text"]);
	}
	else
	{
		$content=str_replace("\n","",str_replace("\r","",$_POST["message_html"]));
		$content_db=result_html($content);
	}
	
	
	$sql="insert into newsletter (data,touser,types,subject,content,html) values (".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",'".result($_POST["to"])."','".result($_POST["types"])."','".result($_POST["subject"])."','".$content_db."',".(int)$_POST["html"].")";
	$db->execute($sql);
	
	if($_POST["html"]==1)
	{
			if(file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/templates/emails/header.tpl"))
			{
				$content=str_replace("{SITE_ROOT}",surl.site_root,file_get_contents($_SERVER["DOCUMENT_ROOT"].site_root."/templates/emails/header.tpl")).$content;
			}
			if(file_exists($_SERVER["DOCUMENT_ROOT"].site_root."/templates/emails/footer.tpl"))
			{
				$content.=str_replace("{SITE_ROOT}",surl.site_root,file_get_contents($_SERVER["DOCUMENT_ROOT"].site_root."/templates/emails/footer.tpl"));
			}
	}

	$com="";
	if($_POST["to"]=="newsletter"){$com="where newsletter=1";}
	if($_POST["to"]=="buyer_newsletter"){$com="where newsletter=1 and utype='buyer'";}
	if($_POST["to"]=="seller_newsletter"){$com="where newsletter=1 and utype='seller'";}
	if($_POST["to"]=="affiliate_newsletter"){$com="where newsletter=1 and utype='affiliate'";}
	if($_POST["to"]=="common_newsletter"){$com="where newsletter=1 and utype='common'";}
	$sql="select login,email from users ".$com;
	$rs->open($sql);
	while(!$rs->eof)
	{
		if(($_POST["types"]=="all" and $_POST["html"]==0) or $_POST["types"]=="message")
		{
			$sql="insert into messages (touser,fromuser,subject,content,data,viewed,trash,del) values ('".$rs->row["login"]."','Site Administration','".result2($_POST["subject"])."','".$content_db."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",0,0,0)";
			$db->execute($sql);
		}
		
		$content=str_replace("{SITE_NAME}",$site_name,$content);
		$content=str_replace("{ADDRESS}",$global_settings["company_address"],$content);
		
		$content=translate_text($content);

		if($_POST["types"]=="all" or $_POST["types"]=="email")
		{
			$m= new Mail; 
			$m->From(from_email);
			$m->To($rs->row["email"]);
			$m->Subject($_POST["subject"]); 
			$m->Body($content);
			$m->Send((int)$_POST["html"]);
		}
		
		$rs->movenext();
	}
}

header("location:index.php?d=2");
?>