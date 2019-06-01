<?$site="orders";?>
<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:login.php");}?>
<?include("../inc/header.php");?>
<? include("../admin/function/show.php");?>
<?include("profile_top.php");?>




<h1><?=word_lang("order")?> #<?=(int)$_GET["id"]?></h1>



<?
$sql="select * from orders where user=".(int)$_SESSION["people_id"]." and id=".(int)$_GET["id"]." order by data desc";
$rs->open($sql);
if(!$rs->eof)
{
?>

<table border="0" cellpadding="0" cellspacing="0" style="width:100%;margin:0px -4px 30px -4px">
<tr valign="top">
<td style="width:32%">
<div class="t" style="display:block"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr2" style="height:<?if($site_credits){echo(270);}else{echo(340);}?>px">

<table border="0" cellpadding="0" cellspacing="0" class="profile_table_home" style="width:90%">
		
		<tr>
			<th colspan="2"><?=word_lang("order details")?></th>
		</tr>
		<tr>
			<td><b><?=word_lang("date")?>:</b></td>
			<td><div class="link_date"><?=date(date_format,$rs->row["data"])?></div></td>
		</tr>
		<tr>
			<td><b><?=word_lang("status")?>:</b></td>
			<td> 
				<?
					if($rs->row["status"]==1){echo("<div class='link_approved'>".word_lang("approved")."</div>");}
					else{echo("<div class='link_pending'>".word_lang("pending")."</div>");}
				?>
			</td>
		</tr>
		<tr>
			<td><b><?=word_lang("shipped")?>:</b></td>
			<td>
				<?
					if($rs->row["shipped"]==0 and $rs->row["shipping"]*1!=0){echo("<div class='link_pending'>".word_lang("not shipped")."</div>");}
					if($rs->row["shipped"]==1 and $rs->row["shipping"]*1!=0){echo("<div class='link_approved'>".word_lang("shipped")."</div>");}
					if($rs->row["shipped"]==0 and $rs->row["shipping"]*1==0){echo("&mdash;");}
				?>
			</td>
		</tr>
		<tr>
			<td><b><?=word_lang("subtotal")?>:</b></td>
			<td><?=currency(1);?><?=float_opt($rs->row["subtotal"],2)?> <?=currency(2);?></td>
		</tr>
	<?if(!$site_credits){?>
		<tr>
			<td><b><?=word_lang("discount")?>:</b></td>
			<td> <?=currency(1);?><?=float_opt($rs->row["discount"],2)?> <?=currency(2);?></td>
		</tr>
	<?}?>
		<tr>
			<td><b><?=word_lang("shipping")?>:</b></td>
			<td><?=currency(1);?><?=float_opt($rs->row["shipping"],2)?> <?=currency(2);?></td>
		</tr>
	<?if(!$site_credits){?>
		<tr>
			<td><b><?=word_lang("taxes")?>:</b></td>
			<td><?=currency(1);?><?=float_opt($rs->row["tax"],2)?> <?=currency(2);?></td>
		</tr>
	<?}?>
		<tr>
			<td><b><?=word_lang("total")?>:</b></td>
			<td><span class="price"><b><?=currency(1);?><?=float_opt($rs->row["total"],2)?> <?=currency(2);?></b></span></td>
		</tr>
</table>

</div></div></div></div></div></div></div></div>
</td>
<td style="width:36%;padding:0px 15px 0px 15px">
<div class="t" style="display:block"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr2" style="height:<?if($site_credits){echo(270);}else{echo(340);}?>px">

<table border="0" cellpadding="0" cellspacing="0" class="profile_table_home" style="width:90%">
		
		<tr>
			<th colspan="2"><?=word_lang("billing address")?></th>
		</tr>
		<tr>
			<td><b><?=word_lang("name")?>:</b></td>
			<td><?=$rs->row["billing_firstname"]." ".$rs->row["billing_lastname"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("country")?>:</b></td>
			<td><?=$rs->row["billing_country"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("state")?>:</b></td>
			<td><?=$rs->row["billing_state"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("city")?>:</b></td>
			<td><?=$rs->row["billing_city"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("zipcode")?>:</b></td>
			<td><?=$rs->row["billing_zip"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("address")?>:</b></td>
			<td><?=$rs->row["billing_address"]?></td>
		</tr>
</table>
</div></div></div></div></div></div></div></div>
</td>
<td style="width:32%">
<div class="t" style="display:block"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr2" style="height:<?if($site_credits){echo(270);}else{echo(340);}?>px">


<table border="0" cellpadding="0" cellspacing="0" class="profile_table_home" style="width:90%">
		
		<tr>
			<th colspan="2"><?=word_lang("shipping address")?></th>
		</tr>
		<tr>
			<td><b><?=word_lang("name")?>:</b></td>
			<td><?=$rs->row["shipping_firstname"]." ".$rs->row["shipping_lastname"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("country")?>:</b></td>
			<td><?=$rs->row["shipping_country"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("state")?>:</b></td>
			<td><?=$rs->row["shipping_state"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("city")?>:</b></td>
			<td><?=$rs->row["shipping_city"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("zipcode")?>:</b></td>
			<td><?=$rs->row["shipping_zip"]?></td>
		</tr>
		<tr>
			<td><b><?=word_lang("address")?>:</b></td>
			<td><?=$rs->row["shipping_address"]?></td>
		</tr>
</table>


</div></div></div></div></div></div></div></div>
</td>
</tr>
</table>




<table border="0" cellpadding="0" cellspacing="0" class="profile_table" style="width:100%">
<tr>
<th>&nbsp;</th>
<th><b>ID</b></th>
<th><b><?=word_lang("item")?></b></th>
<th><b><?=word_lang("price")?></b></th>
<th><b><?=word_lang("qty")?></b></th>
<th><b><?=word_lang("download links")?></b></th>
</tr>
<?
$tr=1;
$sql="select * from orders_content where id_parent=".(int)$_GET["id"]." order by id";
$dn->open($sql);
while(!$dn->eof)
{

if($dn->row["prints"]!=1)
{

$sql="select id,name,price,id_parent,url,shipped from items where id=".$dn->row["item"];
$dr->open($sql);
if(!$dr->eof)
{
?>
<tr valign="top">
<?



$folder="";
$fl="photos";
$url=item_url($dr->row["id_parent"]);

$sql="select id_parent,folder,title,server1 from photos where id_parent=".(int)$dr->row["id_parent"];
$ds->open($sql);
if(!$ds->eof)
{
	$server1=$ds->row["server1"];
	$folder=$ds->row["folder"];

		$sql="select width,height from filestorage_files where id_parent=".$ds->row["id_parent"]." and item_id<>0";
		$dd->open($sql);
		if(!$dd->eof)
		{
			$photo_width=$dd->row["width"];
			$photo_height=$dd->row["height"];
		}
		else
		{
			if(file_exists($DOCUMENT_ROOT.server_url($ds->row["server1"])."/".$folder."/".$dr->row["url"]))
			{
				$size = getimagesize($DOCUMENT_ROOT.server_url($ds->row["server1"])."/".$folder."/".$dr->row["url"]);
				$photo_width=$size[0];
				$photo_height=$size[1];
			}
		}
		
		$rw=$photo_width;
		$rh=$photo_height;


	if($photo_width!=0 and $photo_height!=0)
	{
	$sql="select * from sizes where title='".$dr->row["name"]."'";
	$dd->open($sql);
	if(!$dd->eof)
	{
		if($dd->row["size"]!=0)
		{
			if($rw>$rh)
			{
				$rw=$dd->row["size"];
				if($rw!=0)
				{
					$rh=round($photo_height*$rw/$photo_width);
				}
			}
			else
			{
				$rh=$dd->row["size"];
				if($rh!=0)
				{
					$rw=round($photo_width*$rh/$photo_height);
				}
			}
		}
	}
	}

$fl="photos";
$preview=show_preview($dr->row["id_parent"],"photo",1,1,$ds->row["server1"],$ds->row["folder"]);
}


$sql="select id_parent,folder,title,server1 from videos where id_parent=".(int)$dr->row["id_parent"];
$ds->open($sql);
if(!$ds->eof)
{
$folder=$ds->row["folder"];
$fl="videos";
$server1=$ds->row["server1"];
$preview=show_preview($dr->row["id_parent"],"video",1,1,$ds->row["server1"],$ds->row["folder"]);
}


$sql="select id_parent,folder,title,server1 from audio where id_parent=".(int)$dr->row["id_parent"];
$ds->open($sql);
if(!$ds->eof)
{
$folder=$ds->row["folder"];
$fl="audio";
$server1=$ds->row["server1"];
$preview=show_preview($dr->row["id_parent"],"audio",1,1,$ds->row["server1"],$ds->row["folder"]);
}


$sql="select id_parent,folder,title,server1 from vector where id_parent=".(int)$dr->row["id_parent"];
$ds->open($sql);
if(!$ds->eof)
{
$folder=$ds->row["folder"];
$fl="vector";
$server1=$ds->row["server1"];
$preview=show_preview($dr->row["id_parent"],"vector",1,1,$ds->row["server1"],$ds->row["folder"]);
}




?>

<td>
<div class="white_t"><div class="white_b"><div class="white_l"><div class="white_r"><div class="white_bl"><div class="white_br"><div class="white_tl"><div class="white_tr"><a href="<?=$url?>"><img src="<?=$preview?>" border="0"></a></div></div></div></div></div></div></div></div>
</td>
<td><a href="<?=$url?>"><b><?=$dr->row["id_parent"]?></b></a></td>
<td><?=$dr->row["name"]?><?if($fl=="photos"){?>: <?=$rw?>x<?=$rh?><?}?></td>
<td><span class="price"><?=currency(1);?><?=float_opt($dr->row["price"],2)?> <?=currency(2);?></span></td>
<td><?=$dn->row["quantity"]?></td>
<td>
<?
if($dr->row["shipped"]!=1)
{
if($rs->row["status"]==1)
{
$sql="select link,data,tlimit,ulimit from downloads where id_parent=".$dr->row["id"]." and data>".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))." and tlimit<ulimit+1 and order_id=".(int)$_GET["id"];
$ds->open($sql);
if(!$ds->eof)
{
?>
<div style="margin-bottom:5px"><b><?=word_lang("link")?>:</b> <a href="<?=surl?><?=site_root?>/members/download.php?f=<?=$ds->row["link"]?>" target="blank"><?=surl?><?=site_root?>/members/download.php?f=<?=$ds->row["link"]?></a></div>
<div style="margin-bottom:5px"><b><?=word_lang("expiration date")?>:</b> <?=date(date_format,$ds->row["data"])?></div>
<div><b><?=word_lang("times usage")?>:</b> <?=$ds->row["tlimit"]?>(<?=$ds->row["ulimit"]?>)</div>
<?
}
else{echo(word_lang("expired"));}
}
}
else
{
echo("&mdash;");
}
?>
</td>
</tr>
<?
}
}




if($dn->row["prints"]==1)
{



//Prints items
$sql="select id_parent,title,price,itemid from prints_items where id_parent=".$dn->row["item"];
$dr->open($sql);
if(!$dr->eof)
{




$folder="";
$url=item_url($dr->row["itemid"]);
$sql="select id_parent,folder,title,server1 from photos where id_parent=".(int)$dr->row["itemid"];
$ds->open($sql);
if(!$ds->eof)
{
$title=$ds->row["title"];
$folder=$ds->row["folder"];
$server1=$ds->row["server1"];
$preview=show_preview($ds->row["id_parent"],"photo",1,1,$ds->row["server1"],$ds->row["folder"]);
}






?>
<tr valign="top">
<td><div class="white_t"><div class="white_b"><div class="white_l"><div class="white_r"><div class="white_bl"><div class="white_br"><div class="white_tl"><div class="white_tr"><a href="<?=$url?>"><img src="<?=$preview?>" border="0"></a></div></div></div></div></div></div></div></div></td>
<td><a href="<?=$url?>"><b><?=$dr->row["itemid"]?></b></a></td>
<td><?=word_lang("prints")?>: <?=$dr->row["title"]?>
			<?
			for($i=1;$i<4;$i++)
			{
				if($dn->row["option".$i."_id"]!=0 and $dn->row["option".$i."_value"]!="")
				{
					$sql="select title from products_options where id=".$dn->row["option".$i."_id"];
					$ds->open($sql);
					if(!$ds->eof)
					{
						?><div class="gr"><?=$ds->row["title"]?>: <?=$dn->row["option".$i."_value"]?>.</div> <?
					}
				}
			}
			?>



</td>
<td><span class="price"><?=currency(1);?><?=float_opt($dr->row["price"],2)?> <?=currency(2);?></span></td>
<td><?=$dn->row["quantity"]?></td>
<td>&mdash;</td>
</tr>
<?
}



}





$tr++;
$dn->movenext();
}
?>
</table>


<?}?>

<?include("profile_bottom.php");?>



<?include("../inc/footer.php");?><?=$dn->row["option".$i."_value"]?>.</div> <?
					}
				}
			}
			?>



</td>
<td><span class="price"><?=currency(1);?><?=float_opt($dr->row["price"],2)?> <?=currency(2);?></span></td>
<td><?=$dn->row["quantity"]?></td>
<td>&mdash;</td>
</tr>
<?
}



}





$tr++;
$dn->movenext();
}
?>
</table>


<?}?>

<?include("profile_bottom.php");?>



<?include("../inc/footer.php");?>