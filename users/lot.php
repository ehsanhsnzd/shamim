<? 
$width_none=$_POST['widthnone'];
if(empty($width_none)){$width_none=1;}
$height_none=$_POST['heightnone'];
if(empty($height_none)){$height_none=1;}
$fee=$_POST['fee'];

$width=$_POST['width'];
if(empty($width)){$width=1;}
$height=$_POST['height'];
if(empty($height)){$height=1;}

$fast_deliver=$_POST['fast_deliver'];
if ($fast_deliver=='checked'){
	$fast_deliver_fee=$_POST['fast_deliver_fee'];
	}
	
	
$lot_w=ceil($width/$width_none);

$lot_h=ceil($height/$height_none);

$lot_total=$lot_w*$lot_h;

$fee=$fee*$lot_total;
?>
قیمت:  <?=$fee+$fast_deliver_fee?> تومان           

<?= $lot_total ?> لت

<input style="display:none" value="<?= $lot_total ?>" name="last_lot" />


<br>
<br>
<span> بعد از تخفیف :
<div style="display:inline-block; color:#BA0707">
<?
include("../db_select.php");
$dedicate_sql = mysqli_query($connection, "select * from  info");
$d = mysqli_fetch_array($dedicate_sql);
$percent_1 = $d['percent_1'];

if ($discount > 0) {
    $discount_fee = $discount / 100;
} else {
    $discount_fee = $percent_1 / 100;
}


$discount_total=($fee+$fast_deliver_fee)*$discount_fee;
echo  $price_total=($fee+$fast_deliver_fee)-$discount_total;

?> تومان
</div>
 </span>