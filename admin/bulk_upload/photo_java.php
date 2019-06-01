<?
//Check access
admin_panel_access("catalog_bulkupload");
?>
<?if(!defined("site_root")){exit();}?>






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
if(mat!="<?=word_lang("please insert")?>:."){
alert(mat+mat2)
}
else
{alert(mat2)}
return false
}




}
}












</script>






<form method="post" action="index.php?d=6" name="uploadform" onsubmit="return check();">

<div class="subheader"><?=word_lang("settings")?></div>
<div class="subheader_text">

<p><b>Select category 1:</b><br><select class="ft" name="category" style="width:300px;margin-top:2px">
<option value=""></option>
<?
$itg="";
$nlimit=0;
buildmenu2(5,0,2,0);
echo($itg);
?>
</select></p>


<p>Select category 2:<br><select class="ft" name="category2" style="width:300px;margin-top:2px">
<option value=""></option>
<?
echo($itg);
?>
</select></p>

<p>Select category 3:<br><select class="ft" name="category3" style="width:300px;margin-top:2px">
<option value=""></option>
<?
echo($itg);
?>
</select></p>




<p><b>Select author:</b><br><select class="ft" name="author" style="width:150px;margin-top:2px">
<option value="">...</option>
<?
$sql="select login from users where utype='seller' or utype='common'  order by login";
$rs->open($sql);
while(!$rs->eof)
{
?>
<option value="<?=$rs->row["login"]?>"><?=$rs->row["login"]?></option>
<?
$rs->movenext();
}
?>
</select></p>

</div>


<div class="subheader"><?=word_lang("price")?></div>
<div class="subheader_text">

<div class="table_t" style="margin-left:-7px"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<table border="0" cellpadding="5" cellspacing="1" class='table_admin' style="width:700px">
<tr>
<th><?=word_lang("enabled")?>:</th>
<th><b><?=word_lang("title")?>:</b></th>
<th><b>Max <?=word_lang("width")?>/<?=word_lang("height")?>:</b></th>
<th><b><?=word_lang("price")?>:</b></th>
</tr>

<?
$sql="select id_parent,name from licenses order by priority";
$ds->open($sql);
while(!$ds->eof)
{
?>
<tr class="snd"><td colspan="4"><b><?=word_lang("license")?>: </b><?=$ds->row["name"]?></td></tr>
<?
$sql="select id_parent,size,title,price from sizes where license=".$ds->row["id_parent"]." order by priority";
$rs->open($sql);
while(!$rs->eof)
{

$price=$rs->row["price"];
$chk="checked";


?>
<tr>
<td><input name="chk<?=$rs->row["id_parent"]?>" type="checkbox" <?=$chk?>></td>
<td><?=$rs->row["title"]?></td>
<td><?if($rs->row["size"]!=0){?><?=$rs->row["size"]?>px<?}else{?><?=word_lang("Original size")?><?}?></td>
<td><?=currency(1)?><?=float_opt($price,2)?> <?=currency(2)?></td>
</tr>
<?
$rs->movenext();
}
$ds->movenext();
}
?>


</table>
</div></div></div></div></div></div></div></div>

</div>





<?if($site_prints){?>
<div class="subheader"><?=word_lang("prints and products")?></div>
<div class="subheader_text">


<div class="table_t" style="margin-left:-7px"><div class="table_b"><div class="table_l"><div class="table_r"><div class="table_bl"><div class="table_br"><div class="table_tl"><div class="table_tr">
<?=prints_upload_form()?>
</div></div></div></div></div></div></div></div>
</div>
<?}?>


<div id="java_bulk"></div>


	<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">
			<input type="submit" value="<?=word_lang("next step")?>" class="btn btn-primary" style="margin-top:20px">
		</div>
	</div>


</form>