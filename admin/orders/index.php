<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("orders_orders");



//Get Search
$search="";
if(isset($_GET["search"])){$search=result($_GET["search"]);}
if(isset($_POST["search"])){$search=result($_POST["search"]);}

//Get Search type
$search_type="";
if(isset($_GET["search_type"])){$search_type=result($_GET["search_type"]);}
if(isset($_POST["search_type"])){$search_type=result($_POST["search_type"]);}





//Get pub_type
$pub_type="all";
if(isset($_GET["pub_type"])){$pub_type=result($_GET["pub_type"]);}
if(isset($_POST["pub_type"])){$pub_type=result($_POST["pub_type"]);}


//Items
$items=30;
if(isset($_GET["items"])){$items=(int)$_GET["items"];}
if(isset($_POST["items"])){$items=(int)$_POST["items"];}


//Search variable
$var_search="search=".$search."&search_type=".$search_type."&items=".$items."&pub_type=".$pub_type;





?>
<? include("../inc/begin.php");?>



<a class="btn toright" href="export_csv.php"><i class="icon-th"></i> <?=word_lang("export as csv file")?></a>

<a class="btn toright" href="export_xls.php"><i class="icon-th-list"></i> <?=word_lang("export as xls file")?></a>



<h1><?=word_lang("orders")?></h1>




<script type="text/javascript" language="JavaScript" src="../../members/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function doLoad(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('status'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, 'status.php', true);
    req.send( {'id': value} );
}



function doLoad4(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('shipping'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, 'shipping.php', true);
    req.send( {'id': value} );
}


</script>







<?






//Sort by date
$adate=0;
if(isset($_GET["adate"])){$adate=(int)$_GET["adate"];}



//Sort by ID
$aid=0;
if(isset($_GET["aid"])){$aid=(int)$_GET["aid"];}

//Sort by default
if($adate==0 and $aid==0)
{
$adate=2;
}



//Add sort variable
$com="";


if($adate!=0)
{
	$var_sort="&adate=".$adate;
	if($adate==1){$com=" order by data ";}
	if($adate==2){$com=" order by data desc ";}
}



if($aid!=0)
{
	$var_sort="&aid=".$aid;
	if($aid==1){$com=" order by id ";}
	if($aid==2){$com=" order by id desc ";}
}








//Items on the page
$items_mass=array(10,20,30,50,75,100);




//Search parameter
$com2="";

if($search!="")
{

	if($search_type=="id")
	{
		$com2.=" and id=".(int)$search." ";
	}
	if($search_type=="login")
	{
		$com2.=" and user = '".user_url($search)."' ";
	}

}


if($pub_type=="approved")
{
	$com2.=" and status=1 ";
}
if($pub_type=="pending")
{
	$com2.=" and status=0 ";
}


//Item's quantity
$kolvo=$items;


//Pages quantity
$kolvo2=k_str2;


//Page number
if(!isset($_GET["str"])){$str=1;}
else{$str=(int)$_GET["str"];}


$n=0;

$sql="select * from orders where id>0 ";


$sql.=$com2.$com;

$rs->open($sql);
$record_count=$rs->rc;





//limit
$lm=" limit ".($kolvo*($str-1)).",".$kolvo;




$sql.=$lm;

//echo($sql);
$rs->open($sql);

?>
<div id="catalog_menu">


<form method="get" action="index.php" style="margin:0px">

<div class="toleft">
<span><?=word_lang("search")?>:</span>
<input type="text" name="search" style="width:200px" class="ft" value="<?=$search?>" onClick="this.value=''">
<select name="search_type" style="width:100px" class="ft">
<option value="login" <?if($search_type=="login"){echo("selected");}?>><?=word_lang("login")?></option>
<option value="id" <?if($search_type=="id"){echo("selected");}?>>ID</option>

</select>
<br><input type="submit" class="btn" value="<?=word_lang("search")?>" style="margin-top:3px">
</div>










<div class="toleft">
<span><?=word_lang("type")?>:</span>
<select name="pub_type" style="width:100px" class="ft">
<option value="all"><?=word_lang("all")?></option>
<option value="approved" <?if($pub_type=="approved"){echo("selected");}?>><?=word_lang("approved")?></option>
<option value="pending" <?if($pub_type=="pending"){echo("selected");}?>><?=word_lang("pending")?></option>

</select>
</div>




<div class="toleft">
<span><?=word_lang("page")?>:</span>
<select name="items" style="width:50px" class="ft">
<?
for($i=0;$i<count($items_mass);$i++)
{
$sel="";
if($items_mass[$i]==$items){$sel="selected";}
?>
<option value="<?=$items_mass[$i]?>" <?=$sel?>><?=$items_mass[$i]?></option>
<?
}
?>

</select>
</div>
<div class="toleft_clear"></div>
</form>


</div>



<?




$tr=1;
if(!$rs->eof)
{
?>


<div style="padding:0px 0px 15px 6px"><?echo(paging($record_count,$str,$kolvo,$kolvo2,"index.php","&".$var_search.$var_sort));?></div>

<script language="javascript">
function publications_select_all(sel_form)
{
    if(sel_form.selector.checked)
   	{
        $("input:checkbox", sel_form).attr("checked",true);
    }
    else
    {
        $("input:checkbox", sel_form).attr("checked",false);
    }
}
</script>



<form method="post" action="order_delete.php" style="margin:0px"  id="adminform" name="adminform">
<div class="table_t2"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="0" cellspacing="1" class="table_admin" width="100%">
<tr>
<th><input type="checkbox"  name="selector" value="1" onClick="publications_select_all(document.adminform);"></th>
<th>
<a href="index.php?<?=$var_search?>&aid=<?if($aid==2){echo(1);}else{echo(2);}?>">ID</a> <?if($aid==1){?><img src="<?=site_root?>/admin/images/sort_up.gif" width="11" height="8"><?}?><?if($aid==2){?><img src="<?=site_root?>/admin/images/sort_down.gif" width="11" height="8"><?}?>
</th>
<th class="hidden-phone hidden-tablet">
<a href="index.php?<?=$var_search?>&adate=<?if($adate==2){echo(1);}else{echo(2);}?>"><?=word_lang("date")?></a> <?if($adate==1){?><img src="<?=site_root?>/admin/images/sort_up.gif" width="11" height="8"><?}?><?if($adate==2){?><img src="<?=site_root?>/admin/images/sort_down.gif" width="11" height="8"><?}?>
</th>
<th class="hidden-phone hidden-tablet"><?=word_lang("subtotal")?></b></th>
<?if(!$site_credits){?>
<th class="hidden-phone hidden-tablet"><?=word_lang("discount")?></b></th>
<?}?>
<th class="hidden-phone hidden-tablet"><?=word_lang("shipping")?></b></th>
<?if(!$site_credits){?>
<th class="hidden-phone hidden-tablet"><?=word_lang("taxes")?></b></th>
<?}?>
<th class="hidden-phone hidden-tablet"><?=word_lang("total")?></b></th>
<th><?=word_lang("status")?></b></th>
<th class="hidden-phone hidden-tablet"><?=word_lang("shipping")?></b></th>
<th class="hidden-phone hidden-tablet"><?=word_lang("user")?></b></th>
<?if(!$site_credits){?>
<th class="hidden-phone hidden-tablet"></th>
<?}?>
	
</tr>








<?
while(!$rs->eof)
{

$cl="";
if($rs->row["status"]!=1)
{
$cl="class='red'";
}


$cl2="";
if($rs->row["shipped"]!=1)
{
$cl2="class='red'";
}
?>
<tr <?if($tr%2==0){echo("class='snd'");}?> valign="top">
<td><input type="checkbox" name="sel<?=$rs->row["id"]?>" id="sel<?=$rs->row["id"]?>"></td>


<td class="big">

<div class="link_order"><a href="order_content.php?id=<?=$rs->row["id"]?>"><b><?=word_lang("order")?> #<?=$rs->row["id"]?></b></a></div>


</td>

<td class="gray hidden-phone hidden-tablet"><?=date(date_format,$rs->row["data"])?></td>
<td class="hidden-phone hidden-tablet"><?=currency(1);?><?=float_opt($rs->row["subtotal"],2)?> <?=currency(2);?></td>
<?if(!$site_credits){?>
<td class="hidden-phone hidden-tablet"><?=currency(1);?><?=float_opt($rs->row["discount"],2)?> <?=currency(2);?></td>
<?}?>
<td class="hidden-phone hidden-tablet"><?=currency(1);?><?=float_opt($rs->row["shipping"],2)?> <?=currency(2);?></td>
<?if(!$site_credits){?>
<td class="hidden-phone hidden-tablet"><?=currency(1);?><?=float_opt($rs->row["tax"],2)?> <?=currency(2);?></td>
<?}?>
<td class="hidden-phone hidden-tablet"><b><?=currency(1);?><?=float_opt($rs->row["total"],2)?> <?=currency(2);?></b></td>
<td><div id="status<?=$rs->row["id"]?>" name="status<?=$rs->row["id"]?>" class="link_status"><a href="javascript:doLoad(<?=$rs->row["id"]?>);" <?=$cl?>><?if($rs->row["status"]==1){echo(word_lang("approved"));}else{echo(word_lang("pending"));}?></a></div>
</td>
<td class="gray hidden-phone hidden-tablet">
<?
if($rs->row["shipping"]*1!=0)
{
?>

<div id="shipping<?=$rs->row["id"]?>" name="shipping<?=$rs->row["id"]?>" class="link_status"><a href="javascript:doLoad4(<?=$rs->row["id"]?>);" <?=$cl2?>><?if($rs->row["shipped"]==1){echo(word_lang("shipped"));}else{echo(word_lang("not shipped"));}?></a></div>
<?
}
else
{
echo("&mdash;");
}
?>

</td>
<td class="hidden-phone hidden-tablet"><?
$sql="select id_parent,login from users where id_parent=".$rs->row["user"];
$ds->open($sql);
if(!$ds->eof)
{
?>
<div class="link_user"><a href="../customers/content.php?id=<?=$ds->row["id_parent"]?>"><?=$ds->row["login"]?></a></div>
<?
}
?></td>

<?if(!$site_credits){?>
<td class="hidden-phone hidden-tablet"><div class="link_payment"><a href="payments.php?product_id=<?=$rs->row["id"]?>&product_type=order&print=1" target="blank"><?=word_lang("purchase statement")?></a></div></td>
<?}?>


</tr>
<?
$tr++;
$n++;
$rs->movenext();
}
?>
</table>
</div></div></div></div></div></div></div></div>







<input type="submit" value="<?=word_lang("delete")?>" style="margin:10px 0px 0px 6px" class="btn btn-danger">


</form>
<div style="padding:25px 0px 0px 6px;"><?echo(paging($record_count,$str,$kolvo,$kolvo2,"index.php","&".$var_search.$var_sort));?></div>
<?
}
else
{
echo("<p><b>".word_lang("not found")."</b></p>");
}
?>







































<? include("../inc/end.php");?>