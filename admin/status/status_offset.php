<? include("../function/db.php");
include("../library/jdf.php");
?>


<?include("../../members/JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);


$id=(int)@$_REQUEST['status_id'];
$type=@$_REQUEST['type'];
$value=(int)@$_REQUEST['value'];


if($value==1){$value=0;}elseif($value==0){$value=1;}

set_offset($id,$type,$value);



function set_offset($id,$type,$value)
{
    global $db;
    $sql = "insert into status_offset (id,$type) values($id,$value) ON DUPLICATE KEY UPDATE $type=$value ";
    $db->execute($sql);

}

require ('../../db_select.php');

$order_of_user_query=  "SELECT * FROM orders2 where order_id=".$id ;




$sql_orders_of_user= mysqli_query($connection, $order_of_user_query);
 $sql_orders = mysqli_fetch_assoc($sql_orders_of_user) ;



    if( $sql_orders['factor']!=0){

        $sql_invoice = $sql_orders['factor'];}
    else{
        $sql_invoice=	$sql_orders['order_invoice_code'];

    }

  $sql_order_id = $sql_orders['order_id'];
    $sql_order_type = $sql_orders['order_type'];
    $sql_order_total_price = $sql_orders['order_total_price'];
    $sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
    $sql_od_lot_quantity = $sql_orders['order_lot_quantity'];


    $sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
    $sql_order_print_permission = $sql_orders['order_print_permission'];
    $sql_order_delivery_permission = $sql_orders['order_delivery_permission'];

    $permission = $sql_orders['order_delivery_permission'];
    $sql_order_last_status = $sql_orders['order_last_status'];
    $sql_order_user = $sql_orders['order_user'];

    $connection = mysql_connect($server_name, $db_username, $db_password);
    if(!$connection){
        die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
    }
    mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



    $sql_order_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$sql_order_user'");
    $sql_order_username_name_result = mysql_fetch_array($sql_order_username_name);
    $sql_order_user_realname = $sql_order_username_name_result['name']." ".$sql_order_username_name_result['lastname'];

    $connection = mysqli_connect($server_name, $db_username, $db_password);
    if(!$connection){
        die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
    }
    mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");
    mysqli_query($connection, "SET character_set_connection = 'utf8'");
    $sql_od_file1 = $sql_orders['order_file1'];
    if(isset($sql_od_file1) && $sql_od_file1 != ''){
        $base_file1 = basename($sql_od_file1);
        $sql_od_file1_view =
            "<img src=\"../users/images_graphic/s_".$base_file1."\" width='70' />";
    }
    else{
        $sql_od_file1_view = '';
    }


    if ($sql_order_print_permission == '0') {
        $sql_order_pp = 'خیر';
    }
    elseif ($sql_order_print_permission == '1') {
        $sql_order_pp = 'بله';
    }
    else{
        $sql_order_pp = '';
    }

    if ($sql_order_delivery_permission == '0') {
        $sql_order_dp = 'خیر';
    }
    elseif ($sql_order_delivery_permission == '1') {
        $sql_order_dp = 'بله';
    }
    else{
        $sql_order_dp = '';
    }
    if ($sql_order_last_status == '0') {
        $sql_order_ls = 'در انتظار پرداخت فاکتور';
        $od_ls_0 = 'selected';
    }
    elseif ($sql_order_last_status == '1') {
        $sql_order_ls = 'در انتظار بررسی';
        $od_ls_1 = 'selected';
    }
    elseif ($sql_order_last_status == '2') {
        $sql_order_ls = 'پروسه چاپ';
        $od_ls_2 = 'selected';
    }
    elseif ($sql_order_last_status == '3') {
        $sql_order_ls = 'آماده تحویل';
        $od_ls_3 = 'selected';
    }
    elseif ($sql_order_last_status == '4') {
        $sql_order_ls = 'تحویل داده شده';
        $od_ls_4 = 'selected';
    }
    elseif ($sql_order_last_status == '5') {
        $sql_order_ls = 'تعلیق کار';
        $od_ls_5 = 'selected';
    }
    elseif ($sql_order_last_status == '6') {
        $sql_order_ls = 'کنسل شد';
        $od_ls_6 = 'selected';
    }
    elseif ($sql_order_last_status == '7') {
        $sql_order_ls = 'تحویل شرکت';
        $od_ls_7 = 'selected';
    }

    elseif ($sql_order_last_status == '8') {
        $sql_order_ls = 'تحویل مشتری';
        $od_ls_8 = 'selected';
    }

    else{
        $sql_od_ls = 'وضعیت تعلیق';
    }
    $read_m=$sql_orders['read_m'];

    if($read_m!=1){
        $read_m="class='th-darker_r'";

        if($sql_order_type=='استیکر'){
            $read_m="class='th-darker_s'";

        }elseif($sql_order_type=='فلکس'){
            $read_m="class='th-darker_f'";


        }elseif($sql_order_type=='مش'){
            $read_m="class='th-darker_m'";

        }
        elseif($sql_order_last_status == '6'){
            $read_m="class='th-darker_s'";
        }

    }else $read_m='';

    if($sql_order_last_status == '6'){
        $read_m="class='th-darker_s'";
    }
    if($sql_order_last_status == '5'){
        $read_m="class='th-darker_m'";
    }


?>








<?


echo "<td  $read_m name>$sql_invoice</td>";
echo "<td $read_m>$sql_order_user</td>";
echo "<td  $read_m>$sql_order_user_realname</td>";
echo "<td $read_m>$sql_order_type</td>";
echo "<td $read_m>$sql_order_submit_date</td>";
echo "<td $read_m>$sql_order_ls</td>";
echo "<td $read_m>
					
					$sql_od_file1_view
					 </td>";





          $sql_status_query= mysqli_query($connection,"select * from status_offset where id =$sql_order_id");
                    $sql_status = mysqli_fetch_assoc($sql_status_query);
          if (empty($sql_status['print'])){$print_status=0;}else{$print_status=$sql_status['print'];}
          if (empty($sql_status['zinc'])){$zinc_status=0;}else{$zinc_status=$sql_status['zinc'];}
          if (empty($sql_status['paper'])){$paper_status=0;}else{$paper_status=$sql_status['paper'];}
          if (empty($sql_status['selfon'])){$selfon_status=0;}else{$selfon_status=$sql_status['selfon'];}
          if (empty($sql_status['cut'])){$cut_status=0;}else{$cut_status=$sql_status['cut'];}
          if (empty($sql_status['tigh'])){$tigh_status=0;}else{$tigh_status=$sql_status['tigh'];}
          if (empty($sql_status['sahafi'])){$sahafi_status=0;}else{$sahafi_status=$sql_status['sahafi'];}

          if($sql_status['print']==1){$status_print_class="status_true";}else{$status_print_class="status_false";}
          if($sql_status['zinc']==1){$status_zinc_class="status_true";}else{$status_zinc_class="status_false";}
          if($sql_status['paper']==1){$status_paper_class="status_true";}else{$status_paper_class="status_false";}
          if($sql_status['selfon']==1){$status_selfon_class="status_true";}else{$status_selfon_class="status_false";}
          if($sql_status['cut']==1){$status_cut_class="status_true";}else{$status_cut_class="status_false";}
          if($sql_status['tigh']==1){$status_tigh_class="status_true";}else{$status_tigh_class="status_false";}
          if($sql_status['sahafi']==1){$status_sahafi_class="status_true";}else{$status_sahafi_class="status_false";}

          ?>




<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'print',<?=$print_status?>);" class="<?=$status_print_class?>" ></a></td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'zinc',<?=$zinc_status?>);" class="<?=$status_zinc_class?>" ></a> </td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'paper',<?=$paper_status?>);" class="<?=$status_paper_class?>" ></a>  </td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'selfon',<?=$selfon_status?>);" class="<?=$status_selfon_class?>" ></a></td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'cut',<?=$cut_status?>);" class="<?=$status_cut_class?>" ></a>  </td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'tigh',<?=$tigh_status?>);" class="<?=$status_tigh_class?>" ></a> </td>
<td><a href="javascript:doLoad3(<?=$sql_order_id ?>,'sahafi',<?=$sahafi_status?>);" class="<?=$status_sahafi_class?>" ></a></td>

<? echo "<td $read_m><a href=\"order-edit-graphic.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td> "; ?>


