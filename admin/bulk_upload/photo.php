<?
//Check access
admin_panel_access("catalog_bulkupload");
?>
<??>




<script language="javascript">
	function anketa(name,pole,nado)
	{
		this.name=name;
		this.pole=pole;
		this.nado=nado;
	}


	ms=new Array(new anketa('<?=word_lang("category")?>','category',true),new anketa('<?=word_lang("author")?>','author',true))


	function check()
	{
		with(document.uploadform)
		{
			flag=true
			mat="<?=word_lang("please insert")?>: "
			mat2=""
			for(i=0;i<ms.length;i++)
			{
				dd=eval(ms[i].pole+".value");
				if(ms[i].nado==true){if(dd==""){flag=false;mat+="\""+ms[i].name+"\","}}

				if(ms[i].pole=="email")
				{
					mm=dd
					mr=mm.split("@")
					if(mr.length==1){mat2+=" <?=word_lang("incorrect")?> "+ms[i].name+".";flag=false}
				}
			}

			if(flag==false)
			{
				mat=mat.substring(0,mat.length-1)+"."
				if(mat!="<?=word_lang("please insert")?>:.")
				{
					alert(mat+mat2)
				}
				else
				{
					alert(mat2)
				}
				return false
			}
		}
	}
</script>






<form method="post" action="photo_upload.php" name="uploadform" onsubmit="return check();">


<div class="subheader"><?=word_lang("photos")?></div>
<div class="subheader_text">

<b>You should preupload</b> *.jpg files here <b><?=site_root?><?=photopreupload?></b> on FTP


<?
$n=0;
$afiles=array();

  $dir = opendir ($DOCUMENT_ROOT.photopreupload);
  while ($file = readdir ($dir)) 
  {

    if($file <> "." && $file <> "..")
    {
	if (preg_match("/.jpg$|.jpeg$/i",$file)) 
	{ 
	$afiles[count($afiles)]=$file;
	$n++;
	}
    }
  }
  closedir ($dir);
sort ($afiles);
reset ($afiles);
?>
<script language="javascript">

function selectall()
{
	if(document.getElementById("allphotos").checked)
	{
		for(i=0;i<<?=count($afiles)?>;i++)
		{
			document.getElementById("f"+i.toString()).checked=true;
		}
	}
	else
	{
		for(i=0;i<<?=count($afiles)?>;i++)
		{
			document.getElementById("f"+i.toString()).checked=false;
		}
	}
}

</script>

<?

$page_mass=array(10,20,30,40,50,100,0);


?>




<table border="0" cellpadding="0" cellspacing="0" class="bulk_header">
<tr>
<td style="padding-left:6px" class="gray">
There are <b><?=$n?></b> files
</td>
<td style="padding-left:6px;text-align:right" class="gray">
<select onChange="location.href=this.value" style="padding:1px;margin:5px">
<?
for($i=0;$i<count($page_mass);$i++)
{
	$sel="";
	if($page_mass[$i]==(int)$_SESSION["bulk_page"])
	{
		$sel="selected";
	}
	?>
	<option value="index.php?d=1&quantity=<?=$page_mass[$i]?>" <?=$sel?>>
	<?
	if($page_mass[$i]==0)
	{
		echo(word_lang("all files"));
	}
	else
	{
		echo($page_mass[$i]);
	}
	?>
	</option>
	<?
}
?>
</select>
</td>
<td align="right">
<?
if((int)$_SESSION["bulk_page"]!=0)
{
	echo(paging2($n,$str,(int)$_SESSION["bulk_page"],7,site_root."index.php","&d=1"));
	$kolvo=(int)$_SESSION["bulk_page"];
}
else
{
	$kolvo=100000000000;
}
?>
</td>
</tr>
</table>


<div class="table_t" style="margin-left:-6px;"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="5" cellspacing="1" class='table_admin' style="width:700px">
<tr>
<th><input type="checkbox" id="allphotos" checked onClick="selectall()"></th>
<th><?=word_lang("preview")?></th>
<th><?=word_lang("IPTC info")?>: <?=word_lang("title")?>/<?=word_lang("description")?>/<?=word_lang("keywords")?></th>
</tr>
<?
for($i=0;$i<count($afiles);$i++)
{
	if($i>$kolvo*($str-1)-1 and $i<$kolvo*$str)
	{
		$title="";
		$description="";
		$keywords="";

		$size = getimagesize ($_SERVER["DOCUMENT_ROOT"].site_root.photopreupload.$afiles[$i],$info);
		if(isset ($info["APP13"]))
		{
			$iptc = iptcparse ($info["APP13"]);

			//Title
			if(isset($iptc["2#005"][0]) and $iptc["2#005"][0]!="")
			{
				$title=$iptc["2#005"][0];
			}
	
			//Description
			if(isset($iptc["2#120"][0]) and $iptc["2#120"][0]!="")
			{
				$description=$iptc["2#120"][0];
			}
	
			//Keywords
			if(isset($iptc["2#025"][0]) and $iptc["2#025"][0]!="")
			{
				$iptc_kw="";
				for($t=0;$t<count($iptc["2#025"]);$t++)
				{
					if($iptc_kw!=""){$iptc_kw.=",";}
					$iptc_kw.=$iptc["2#025"][$t];
				}
				if($iptc_kw!="")
				{
					$keywords=$iptc_kw;
				}
			}
		}
		?>
		<tr valign="top" <?if(($i+1)%2==0){echo("class='snd'");}?>>
			<td><input name="f<?=$i?>" id="f<?=$i?>" type="checkbox" checked style="margin-top:3px"></td>
			<td align="center"><img src="image.php?file=<?=$afiles[$i]?>"><input name="file<?=$i?>" type="hidden" value="<?=$afiles[$i]?>"></td>
			<td>
			<div><input class='ft' type="text" name="title<?=$i?>" value="<?=$title?>" style="width:400px"></div>
			<div style="margin-top:3px"><textarea class='textarea' name="description<?=$i?>" style="width:400px;height:50px"><?=$description?></textarea></div>
			<div style="margin-top:3px"><input class='ft' type="text" name="keywords<?=$i?>" value="<?=$keywords?>" style="width:400px"></div>
			</td>
		</tr>
		<?
	}
}
?>
</table>
</div></div></div></div></div></div></div></div>

<br>
</div>


<div class="subheader"><?=word_lang("settings")?></div>
<div class="subheader_text">


<div class="form_field">
	<span><b>Select category 1:</b></span>
	<select class="ft" name="category" style="width:300px">
		<option value=""></option>
		<?
		$itg="";
		$nlimit=0;
		buildmenu2(5,0,2,0);
		echo($itg);
		?>
	</select>
</div>


<div class="form_field">
	<span>Select category 2:</span>
	<select class="ft" name="category2" style="width:300px">
		<option value=""></option>
		<?
		echo($itg);
		?>
		</select>
</div>


<div class="form_field">
	<span>Select category 3:</span>
	<select class="ft" name="category3" style="width:300px;">
		<option value=""></option>
		<?
		echo($itg);
		?>
	</select>
</div>




<div class="form_field">
	<span><b>Select author:</b></span>
	<select class="ft" name="author" style="width:150px;margin-top:2px">
		<option value="">...</option>
		<?
		$sql="select login from users where utype='seller' or utype='common' order by login";
		$rs->open($sql);
		while(!$rs->eof)
		{
			?>
			<option value="<?=$rs->row["login"]?>"><?=$rs->row["login"]?></option>
			<?
			$rs->movenext();
		}
		?>
	</select>
</div>



<p><b>Remove</b> files from <?=photopreupload?> after the upload<br>
<input type="checkbox" name="remove" checked>



</div>




<?if(!$global_settings["printsonly"]){?>
<div class="subheader"><?=word_lang("price")?></div>
<div class="subheader_text">
	<?$file_form=false;?>
	<div class="table_t" style="margin-left:-6px;"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
	<?=photo_upload_form()?>
	</div></div></div></div></div></div></div></div>
	<br>
</div>
<?}?>


<?if($site_prints){?>
<div class="subheader"><?=word_lang("prints and products")?></div>
<div class="subheader_text">
	<div class="table_t" style="margin-left:-6px;"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
	<?=prints_upload_form()?>
	</div></div></div></div></div></div></div></div>
</div>
<?}?>




</p>


	<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">
			<input type="submit" class="btn btn-primary" value="<?=word_lang("upload")?>" style="margin-top:20px">
		</div>
	</div>
</form>
