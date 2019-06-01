<?$site="user";?>
<?include("admin/function/db.php");?>
<?include("inc/header.php");?>


                        <?

function checkqty($id,$qty){
  require ('../config.php');
  $connection = mysqli_connect($server_name, $db_username, $db_password);
 mysqli_select_db($connection,$db_name) ;

 $service_sql=mysqli_query($connection, "SELECT * FROM $service where  id=$id ");

  $numrow=mysqli_fetch_assoc($service_sql);

  if ($numrow['quantity'.$qty]>1){
	  return true;
	  }else{return false;}

}




function cat_name($cat_id){

	switch ($cat_id){

	case 1:	$cat_name='کارت ویزیت';
	break;

		case 2:	$cat_name='تراکت';
	break;

		case 3:	$cat_name='فاکتور';
	break;

		case 4:	$cat_name='قبض';
	break;

		case 5:	$cat_name='پاکت';
	break;
		case 6:	$cat_name='ست اداری';
	break;
		case 7:	$cat_name='بروشور';
	break;
	    case 8:	$cat_name='فولدر';
	break;
	    case 9:	$cat_name='پوستر';
	break;
        case 10:	$cat_name='اعلامیه ترحیم';
            break;
	}

return $cat_name;
	}


function showqty($service,$percent_discount){

	 require ('config.php');
require ('db_select.php');


$dedicate_sql = mysqli_query($connection, "select * from  info");
$d = mysqli_fetch_array($dedicate_sql);
$percent = $d['percent_'.$percent_discount]/100;


	$service_sql=mysqli_query($connection, "SELECT * FROM $service  group by cat,p_type,color_type");

  $count=0;
 	while($service_row = mysqli_fetch_array($service_sql)){
	 $cat=$service_row['cat'];
	 $p_type=$service_row['p_type'];
	  $color_type=$service_row['color_type'];
    $count++;


?> <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="fa fa-plus" aria-hidden="true"></i><a title="<?=cat_name($service_row['cat']).' '.$p_type.' '.$color_type; ?>" data-toggle="collapse" data-parent="#accordion" href="#<?=$cat.$p_type.$count ?>"><?=cat_name($service_row['cat']).' '.$p_type.' '.$color_type; ?></a>
                    </h5>
                </div>
                <div id="<?=$cat.$p_type.$count?>" class="panel-collapse collapse">
                    <div class="panel-body">

                      <table class="Price">
                            <thead class="Fix_Header">
                                <tr>
                                    <td class="Subject_Price">
                                        محصول
                                    </td>
                                    <td>
                                        <table class="Header_Price">
                                            <tr>
                                                <td>طرف</td>
                                                <td>سایز</td>
                                                <td>تیراژ</td>
                                                <td class="With_9">تحویل</td>
                                                <td class="With_26">قیمت (تومان)</td>
                                                <td class="With_26">قیمت (بعد از تخفیف)</td>
                                                <td>سفارش</td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </thead>

                           <?  	$service_sql_cat=mysqli_query($connection, "SELECT * FROM $service  where  cat=$cat  and p_type='$p_type' and color_type='$color_type' group by name order by size_type, paper_type");

 	$c=0;
 	while($service_row_cat = mysqli_fetch_array($service_sql_cat)){
	 $name=$service_row_cat['name'];
	$c++;
	 if($c % 2==0){$style_bg="style='background-color:#DDDDDD'";}else{$style_bg="";}

    ?>

                              <tbody <?=$style_bg ?>>
                <tr>
                    <td class="Subject_Price">
                        <h6><?=$name?></h6>
                    </td>
                    <td class="Row_Price">

                        <table class="MainPrice">

                         <?  	$service_sql_type=mysqli_query($connection, "SELECT * FROM $service  where  cat='$cat' and p_type='$p_type' and color_type='$color_type' and name='$name' order by size_type,quantity1");


 	while($service_row_type = mysqli_fetch_array($service_sql_type)){
	 $p_type=$service_row_type['p_type'];
	  $color_type=$service_row_type['color_type'];
	    if($service_row_type['print_type']==1){$printtype="تک رو";}
  elseif($service_row_type['print_type']==2){$printtype="دو رو";}else{$printtype="-";}


  $service_id=$service_row_type['id'];
$catagory=$service_row_type['cat'];
$fast_type=$service_row_type['fast_type'];
$print_type=$service_row_type['print_type'];
$p_type=$service_row_type['p_type'];
$color_type=$service_row_type['color_type'];
$size_type=$service_row_type['size_type'];
$paper_type=$service_row_type['paper_type'];
$factor_type=$service_row_type['factor_type'];
$ghabz_type=$service_row_type['ghabz_type'];



                         for ($j = 1; $j < 5; $j++) {
                         if(!empty($service_row_type['quantity'.$j])){
?>
                    <tr>
                        <td class="Product_Price">
                            <a href="<?="users/new-order-graphic.php?service=$service_id&catagory=$catagory&p_type=$p_type&color_type=$color_type&fast_type=$fast_type&paper_type=$paper_type&print_type=$print_type&size_type=$size_type&factor_type=$factor_type&ghabz_type=$ghabz_type&pocket_type=$pocket_type&riso_paper_type=$riso_paper_type&quantity=1th&lot=1"?>">
                                <table class="Header_Price" >
                                    <tr <?=$style_bg ?>>

                                        <td><?=$printtype?></td>
                                        <td><?=$service_row_type['size_type']?>-<?=$service_row_type['size']?>
                                          <div>
                                          <small>  <?=$service_row_type['paper_type']?> </small>
                                          </div>
                                        </td>
                                        <td><?=$service_row_type['quantity'.$j]?></td>
                                        <td class="With_9"><?=$service_row_type['work_time_text']?></td>
                                        <td class="With_26"><?=number_format($service_row_type['price'.$j])?></td>
                                        <td class="With_26"><?$discount=$service_row_type['price'.$j]*$percent; echo number_format($service_row_type['price'.$j]-$discount)?></td>
                                        <td><span class="fa-shopping-basket"></span></td>
                                    </tr>
                                </table>
                            </a>
                        </td>


                    </tr>
                    <? }}} ?>
                    </table>

                    </td>

                </tr>


                            </tbody>
   <? } ?>
                        </table>



    </div>
     </div>
      </div>
  <? } ?>
 <? }


function showqty2($service,$percent_discount){

	 require ('config.php');
require ('db_select.php');

$dedicate_sql = mysqli_query($connection, "select * from  info");
$d = mysqli_fetch_array($dedicate_sql);
$percent = $d['percent_'.$percent_discount]/100;


?> <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="fa fa-plus" aria-hidden="true"></i><a title="لارج فرمت" data-toggle="collapse" data-parent="#accordion" href="#large">لارج فرمت</a>
                    </h5>
                </div>
                <div id="large" class="panel-collapse collapse">
                    <div class="panel-body">

                      <table class="Price">
                            <thead class="Fix_Header">
                                <tr>
                                    <td class="Subject_Price">
                                        محصول
                                    </td>
                                    <td>
                                        <table class="Header_Price">
                                            <tr>
                                                <td>طرف</td>
                                                <td>سایز</td>
                                                <td>تیراژ</td>
                                                <td class="With_9">تحویل</td>
                                                <td class="With_26">قیمت (تومان)</td>
                                                <td class="With_26">قیمت (بعد از تخفیف)</td>
                                                <td>سفارش</td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </thead>

                           <?  	$service_sql_cat=mysqli_query($connection, "SELECT * FROM $service  group by name ");

 	$c=0;
 	while($service_row_cat = mysqli_fetch_array($service_sql_cat)){
	 $name=$service_row_cat['name'];
	$c++;
	 if($c % 2==0){$style_bg="style='background-color:#DDDDDD'";}else{$style_bg="";}

    ?>

                              <tbody <?=$style_bg ?>>
                <tr>
                    <td class="Subject_Price">
                        <h6><?=$name?></h6>
                    </td>
                    <td class="Row_Price">

                        <table class="MainPrice">

                         <?  	$service_sql_type=mysqli_query($connection, "SELECT * FROM $service  where    name='$name' order by name");


 	while($service_row_type = mysqli_fetch_array($service_sql_type)){


        $service_id=$service_row_type['id'];
  ?>
                    <tr>
                        <td class="Product_Price">
                            <a href="<?="users/new-order.php?service=$service_id&quantity=1th&lot=1"?>">
                                <table class="Header_Price" >
                                    <tr <?=$style_bg ?>>
                                        <td><?=$printtype?></td>
                                        <td><?=$service_row_type['size_type']?>-<?=$service_row_type['size']?>
                                          <div>
                                          <small>  <?=$service_row_type['paper_type']?> </small>
                                          </div>
                                        </td>
                                        <td><?=$service_row_type['quantity1']?></td>
                                        <td class="With_9"><?=$service_row_type['work_time_text']?></td>
                                        <td class="With_26"><?=number_format($service_row_type['price1'])?></td>
                                        <td class="With_26"><?$discount=$service_row_type['price1']*$percent; echo number_format($service_row_type['price1']-$discount)?></td>
                                        <td><span class="fa-shopping-basket"></span></td>
                                    </tr>
                                </table>
                            </a>
                        </td>


                    </tr>
                    <? } ?>
                    </table>

                    </td>

                </tr>


                            </tbody>
   <? } ?>
                        </table>



    </div>
     </div>
      </div>

 <? } ?>





 <div class="Main_Box col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="panel-group" id="accordion">

<? showqty("services2",1);
showqty2("services",2);
?>

</div>

 </div>

<?include("inc/footer.php");?>
