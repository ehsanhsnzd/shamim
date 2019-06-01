<?php 
	session_start();
	if ($_SESSION['print_admin'] !== '#$ok*%'){
		header("location: ../admin/login.php");
	}
		require('library/jdf.php');
		
		function offset_detail($c,$order_type,$quantity,$unit_price,$total_price,$all_total,$discount)
{
    if ($total_price!=0) {
$unit_price_d=($unit_price*$discount);

    echo "</tr>";
    echo "<tr>";
    echo "<td>$c</td>";
    $c += 1;
    echo "<td  >$order_type</td>";
    echo "<td   >$quantity</td>";
    echo "<td  >$unit_price تومان</td>";
	    echo "<td  >".($unit_price_d)." تومان</td>";
    echo "<td  >".$total_price-$unit_price_d." تومان</td>";
    echo "</tr>";
 $all_total+=$total_price-$unit_price_d;

} return   $all_total;
}
?>
<!DOCTYPE HTML>
<html lang="fa-IR">
<head>
    <meta charset="utf-8"/>
    <title>پنل مدیریت | شمیم</title>

    <link rel="stylesheet" type="text/css" href="../admin/library/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../admin/library/main.js"></script>
    <link type="text/css" href="styles/jquery-ui-1.8.14.css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.ui.core.js"></script>
    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc.js"></script>
    <script type="text/javascript" src="scripts/calendar.js"></script>

    <script type="text/javascript" src="scripts/jquery.ui.datepicker-cc-fa.js"></script>

    <script type="text/javascript">
        $(function() {

            // استفاده از dropdown
            $('#datepicker1').datepicker({
                changeMonth: true,
                changeYear: true
            });

            $('#datepicker2').datepicker({
                changeMonth: true,
                changeYear: true
            });
            $('#datepicker3').datepicker({
                changeMonth: true,
                changeYear: true
            });

            $('#datepicker4').datepicker({
                changeMonth: true,
                changeYear: true
            });
            //-----------------------------------

        });
    </script>

    <script>

        function refresh() {


            setTimeout(function(){
                window.location.reload();
            },1000)
        }


    </script>

    <style type="text/css">
        *

        p.ui-state-hover
        {
            font-weight: normal;
        }
        p.ui-widget-header
        {
            text-align: center;
            font-weight: normal;
        }
        strong.ui-state-error
        {
            display: block;
            padding: 3px;
            text-align: center;
        }
        body{
            background: #f5f5f5;
            font-family: 'iran-sans';
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>


<?
$username=$_GET['username'];
?>



<?php


require ('../db_select.php');


parse_str($_SERVER['QUERY_STRING']);

if (isset($do) && $do != '' && isset($invoiceID) && $invoiceID != '') {
    if ($do == 'delete') {


        $delete_invoice ="DELETE FROM invoices WHERE invoice_code='$invoiceID'";

        if (!mysqli_query($connection,$delete_invoice))
        {
            die('Error: ' . mysqli_error());
            echo "مشکلی در روند حذف فاکتور به وجود آمد و فاکتور حذف نگردید.";
        }
        else{
            echo "<span class=\"done-alert\">فاکتور مورد نظر با موفقیت حذف گردید.</span>";
        }
        include('../avclass.php');

        del_invoice($username);
    }
    elseif ($do == 'paid') {
        $sql_paid_invoice = "UPDATE invoices SET is_paid = $pay WHERE invoice_code = '$invoiceID'";
        mysqli_query($connection, "SET NAMES 'utf8'");
        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
        mysqli_query($connection, "SET character_set_connection = 'utf8'");
        if ($connection->query($sql_paid_invoice) === TRUE) {
            echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه   تغییر یافت</span>";
        } else {
            echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
        }
    }
}
if (isset($username)){

    $username_text="&username=$username";

    $sql1=

    $sql_invoices = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 where order_user='$username'
GROUP BY fc
");
    $RecordCount = mysqli_num_rows($sql_invoices);
    $showRecord = 40;
    $pages = ceil($RecordCount / $showRecord);


    if(isset($page) && $page != '' && $page >=  1){
        $pageuse = $page - 1;
        $start = ($pageuse * $showRecord);
        $end = $showRecord;
    }
    else{
        $start = 0;
        $end = $showRecord;
    }
    $sql_invoices_of_user = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 where order_user='$username'
GROUP BY fc

	 DESC LIMIT $start , $end");
}else{



    $sql_invoices = mysqli_query($connection, "SELECT fc ,order_user
FROM
(SELECT factor as fc,order_user
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 
GROUP BY fc
DESC ");
    $RecordCount = mysqli_num_rows($sql_invoices);
    $showRecord = 40;
    $pages = ceil($RecordCount / $showRecord);


    if(isset($page) && $page != '' && $page >=  1){
        $pageuse = $page - 1;
        $start = ($pageuse * $showRecord);
        $end = $showRecord;
    }
    else{
        $start = 0;
        $end = $showRecord;
    }
    $sql_invoices_of_user = mysqli_query($connection, "
	
	SELECT fc,order_user
FROM
(SELECT factor as fc,order_user
    
  FROM orders2 
  GROUP BY factor 
  UNION ALL
  SELECT order_make_number_perforating as fc,order_user
    
  FROM orders1
  GROUP 
    BY order_make_number_perforating 
) as t3 where fc=$invoiceID
GROUP BY fc
	 DESC LIMIT $start , $end");

}

$invoice_info_query= mysqli_query($connection, "SELECT id ,order_user
FROM
(SELECT factor as id,order_user
  FROM orders2  where factor=$invoiceID
  GROUP BY factor 
  UNION ALL
  
  SELECT order_make_number_perforating as id,order_user  
  FROM orders1 where order_make_number_perforating=$invoiceID
  GROUP 
    BY order_make_number_perforating 
) as t3 ");
$invoice_info=mysqli_fetch_assoc($invoice_info_query);

$invoice_name=$invoice_info['name'];
$invoice_family=$invoice_info['family'];
$invoice_tell=$invoice_info['tell'];
$order_user=$invoice_info['order_user'];
$invoice_date=jdate('Y/m/d h:i a',strtotime($invoice_info['order_submit_date'] .' +210 minutes'),'none','Iran/Tehran','fa'); 


$dbresult=mysqli_query($connection, "SELECT * FROM user WHERE username = '$order_user'");
		
 
				$row = mysqli_fetch_array($dbresult);
				//$invoice_name= $row['username'];
				$invoice_family= $row['display_name'];
				$invoice_tell= $row['mobile'];

$operator=$invoice_info['operator'];
$sql_od_discount = $invoice_info['order_discount'];
$edit_price = $invoice_info['edit_price'];
$sql_od_last_status_pay = $invoice_info['order_last_status'];
$sql_od_last_status_pay2 = $invoice_info['order_last_status2'];
$sql_od_last_status_pay3 = $invoice_info['order_last_status3'];
$sql_od_last_status_pay4 = $invoice_info['order_last_status4'];
$sql_od_description = $invoice_info['order_description'];



if ($sql_od_last_status_pay == '1') {
    $sql_od_ls = 'پرداخت نقدی ';
    $half_price=$invoice_info['order_half'];
}
elseif ($sql_od_last_status_pay == '2') {
    $sql_od_ls = 'پرداخت Pos';
	$half_price=$invoice_info['order_half'];
}
elseif ($sql_od_last_status_pay == '3') {
    $sql_od_ls = 'پرداخت چک'; 
	$half_price=$invoice_info['order_half'];
}
elseif ($sql_od_last_status_pay == '4') {
    $sql_od_ls = 'واریزی حساب'; 
	$half_price=$invoice_info['order_half'];
}
elseif ($sql_od_last_status_pay == '5') {
    $sql_od_ls = 'پرداخت حسابداری';
$half_price=$invoice_info['order_half'];
}else  {
    $sql_od_ls = 'نامشخص';
 
}
 


if ($sql_od_last_status_pay2 == '1') {
    $sql_od_ls_2 = 'پرداخت نقدی ';
    $half_price_2=$invoice_info['order_half2'];
}
elseif ($sql_od_last_status_pay2 == '2') {
    $sql_od_ls_2 = 'پرداخت Pos';
	$half_price_2=$invoice_info['order_half2'];
}
elseif ($sql_od_last_status_pay2 == '3') {
    $sql_od_ls_2 = 'پرداخت چک'; 
	$half_price_2=$invoice_info['order_half2'];
}
elseif ($sql_od_last_status_pay2 == '4') {
    $sql_od_ls_2 = 'واریزی حساب'; 
	$half_price_2=$invoice_info['order_half2'];
}
elseif ($sql_od_last_status_pay2 == '5') {
    $sql_od_ls_2 = 'پرداخت حسابداری';
$half_price_2=$invoice_info['order_half2'];
}
 


if ($sql_od_last_status_pay3 == '1') {
    $sql_od_ls_3 = 'پرداخت نقدی ';
    $half_price_3=$invoice_info['order_half3'];
}
elseif ($sql_od_last_status_pay3 == '2') {
    $sql_od_ls_3 = 'پرداخت Pos';
	$half_price_3=$invoice_info['order_half3'];
}
elseif ($sql_od_last_status_pay3 == '3') {
    $sql_od_ls_3 = 'پرداخت چک'; 
	$half_price_3=$invoice_info['order_half3'];
}
elseif ($sql_od_last_status_pay3 == '4') {
    $sql_od_ls_3 = 'واریزی حساب'; 
	$half_price_3=$invoice_info['order_half3'];
}
elseif ($sql_od_last_status_pay3 == '5') {
    $sql_od_ls_3 = 'پرداخت حسابداری';
$half_price_3=$invoice_info['order_half3'];
}
 


if ($sql_od_last_status_pay4 == '1') {
    $sql_od_ls_4 = 'پرداخت نقدی ';
    $half_price_4=$invoice_info['order_half4'];
}
elseif ($sql_od_last_status_pay4 == '2') {
    $sql_od_ls_4 = 'پرداخت Pos';
	$half_price_4=$invoice_info['order_half4'];
}
elseif ($sql_od_last_status_pay4 == '3') {
    $sql_od_ls_4 = 'پرداخت چک'; 
	$half_price_4=$invoice_info['order_half4'];
}
elseif ($sql_od_last_status_pay4 == '4') {
    $sql_od_ls_4 = 'واریزی حساب'; 
	$half_price_4=$invoice_info['order_half4'];
}
elseif ($sql_od_last_status_pay4 == '5') {
    $sql_od_ls_4 = 'پرداخت حسابداری';
$half_price_4=$invoice_info['order_half4'];
}
 


$sql_username_name = mysqli_query($connection, "SELECT display_name FROM user WHERE username='$order_user'");
$sql_username_name_result = mysqli_fetch_array($sql_username_name);
$sql_user_realname = $sql_username_name_result['display_name'];



$dedicate_sql=mysqli_query($connection,"select * from dedicate_info");		
$d= mysqli_fetch_array( $dedicate_sql);

$dedicate_sql=mysqli_query($connection,"select * from info");		
$o= mysqli_fetch_array( $dedicate_sql);
$percent_1=$o['percent_1']/100;
?>








<table id="financial-invoices-table" width="100%">
    <tr>
        <th>خریدار</th>
        <th class="th-darker">نام : <?=$invoice_name." ".$invoice_family?></th>
        <th> تاریخ :<?=$invoice_date?> </th>
        <th class="th-darker">تلفن : <?=$invoice_tell?></th>
        <th> فاکتور :  <?=$invoiceID?></th>
    </tr>
    <tr>
        <td height="480" colspan="16" valign="top">
            <table width="100%"><tr>
                    <td>ردیف</td>
                    <td width="40%">شرح</td>
                    <td>تعداد</td>
                    <td>فی</td>
                      <td>تخفیف</td>
                    <td>جمع کل</td>
                </tr>

  <?
                $c=1;

                $order_of_offset=  "SELECT * FROM orders2 where factor=$invoiceID " ;


                if(!empty($invoiceID)){
                    $sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
                    while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
                        $sql_offset_total_price = number_format($sql_offset['order_total_price']);
                        $sql_offset_total_price2 = $sql_offset['order_total_price'];
                        $sql_offset_unit_price = number_format($sql_offset['order_unit_price']);
						$sql_offset_unit_price2 = $sql_offset['order_unit_price'];
                        $sql_order_type = $sql_offset['order_type'];
                        $sql_order_cat = $sql_offset['cat'];
                        $sql_order_total_price = $sql_offset['order_total_price'];
                        $sql_order_submit_date = jdate('Y/m/d h:i a',strtotime(   $sql_offset['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
                        $sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
                        $sql_od_quantity = $sql_offset['order_quantity'];
                        $sql_order_print_permission = $sql_offset['order_print_permission'];
                        $sql_order_delivery_permission = $sql_offset['order_delivery_permission'];

                        $sql_order_paperprice = $sql_offset['paperprice'];
                        $sql_order_zinc = $sql_offset['zinc'];
                        $sql_order_print = $sql_offset['print'];
                        $sql_order_uv = $sql_offset['uv'];
                        $sql_order_light = $sql_offset['light'];
                        $sql_order_porfrag = $sql_offset['porfrag'];
                        $sql_order_linebreak = $sql_offset['linebreak'];
						$sql_order_linebreaka = $sql_offset['linebreaka'];
						$sql_order_sarchasb = $sql_offset['sarchasb'];
                        $sql_order_tigh = $sql_offset['tigh'];
                        $sql_order_manganeh = $sql_offset['manganeh'];
                        $sql_order_template = $sql_offset['template'];
                        $sql_order_sahafi = $sql_offset['sahafi'];
                        $sql_order_numbering = $sql_offset['numbering'];
                        $order_zinc = $sql_offset['order_zinc'];
                        $order_tside = $sql_offset['order_tside'];
                        $papernum = $sql_offset['papernum'];
                        $select_paper_id = $sql_offset['select_paper_id'];
                        $qty_print = $sql_offset['qty_print'];
                        $print_fee = $sql_offset['print_fee'];
                        $zinc_fee = $sql_offset['zinc_fee'];
						$order_code = $sql_offset['code'];
						$order_fast_deliver = $sql_offset['fast_deliver'];
						$discount=$sql_offset['discount'];
						if($discount>0 ){$discount_fee=$discount/100;}
								else{$discount_fee=$percent_1;}
						
                        if( $order_tside=='دو رو با دو زینک'){$zinc_qty=2;}elseif($order_tside=='تک رو'){$zinc_qty=1;}elseif($order_tside=='دو رو با یک زینک'){$order_tside=$zinc_qty=1;}

                        if($sql_order_cat=="1"){$sql_order_cat="کارت ویزیت";  };
                        if($sql_order_cat=="2"){$sql_order_cat=  "تراکت" ;};
                        if($sql_order_cat=="3"){$sql_order_cat= "فاکتور" ; };
                        if($sql_order_cat=="4"){$sql_order_cat=  "قبض";};
                        if($sql_order_cat=="5"){$sql_order_cat=  "پاکت"  ; };
                        if($sql_order_cat=="6"){$sql_order_cat=  "ست اداری";}
                        if($sql_order_cat=="7"){$sql_order_cat=  "بروشور"; };
                        if($sql_order_cat=="8"){$sql_order_cat=  "فولدر"; };
                        if($sql_order_cat=="9"){$sql_order_cat= "پوستر"; };


                        $permission = $sql_offset['order_delivery_permission'];
                        $sql_order_last_status = $sql_offset['order_last_status'];

                        if($sql_order_last_status!=6 ){
                            if($sql_order_paperprice==0){

                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c+=1;
                                if (!empty($sql_od_quantity)){$quantiti_text="- تیراژ: $sql_od_quantity";}
								if(!empty($order_fast_deliver)){	$fast_deliver_text=" (فوری)";}
                                echo "<td $read_m>کد : $order_code - $sql_order_cat: $sql_order_type $quantiti_text $fast_deliver_text</td>";
                                echo "<td  $read_m>$sql_od_lot_quantity</td>";
                                $quantiti_text="";
                                if ($sql_order_paperprice!=0){$sql_offset_unit_price=0;$sql_offset_total_price=0;}
                                echo "<td $read_m>".$sql_offset_unit_price." تومان</td>";
								echo "<td $read_m>".($discount_fee*100)."% - ".$sql_offset_unit_price2*$discount_fee." تومان</td>";
                                echo "<td $read_m>$sql_offset_total_price تومان</td>";

                                $total+=$sql_offset_total_price2;
                            }else{




                                $uv_value=$d['uv'];
                                $light_value=$d['light'];
								$mat_value=$d['mat'];
                                $uvm_value=$d['uvm'];
                                $porfrag_value=$d['porfrag'];
                                $linebreak_value=$d['linebreak'];
								$linebreaka_value=$d['linebreaka'];
								$sarchasb_value=$d['sarchasb'];
                                $tigh_value=$d['tigh'];
                                $manganeh_value=$d['manganeh'];
                                $numbering_value=$d['numbering'];
                                $sahafi_value=$d['sahafi'];

                                $all_total=offset_detail($c,'کاغذ '.$select_paper_id,$papernum,$sql_order_paperprice/$papernum,$sql_order_paperprice,0,$discount_fee);
                                $all_total=offset_detail($c,$order_zinc,$zinc_qty,$zinc_fee,$sql_order_zinc,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'چاپ '.$order_tside,$qty_print,$print_fee,$sql_order_print,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'سلفون یو وی',$qty_print,$uv_value,$sql_order_uv,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'سلفون براق',$qty_print,$light_value,$sql_order_light,$all_total,$discount_fee);
								 $all_total=offset_detail($c,'سلفون مات',$qty_print,$mat_value,$sql_order_uv,$all_total);
                                $all_total=offset_detail($c,'سلفون یووی موضعی',$qty_print,$uvm_value,$sql_order_light,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'پرفراژ',$papernum,$porfrag_value,$sql_order_porfrag,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'خط تا افقی',$papernum,$linebreak_value,$sql_order_linebreak,$all_total,$discount_fee);
								 $all_total=offset_detail($c,'خط تا عمودی',$papernum,$linebreaka_value,$sql_order_linebreaka,$all_total,$discount_fee);
								 $all_total=offset_detail($c,'خط تا عمودی',$papernum,$linebreaka_value,$sql_order_linebreaka,$all_total,$discount_fee);
								  $all_total=offset_detail($c,'سرچسب',$papernum,$sarchasb_value,$sql_order_sarchasb,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'تیغ',$qty_print,$tigh_value,$sql_order_tigh,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'منگنه',$papernum,$manganeh_value,$sql_order_manganeh,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'قالب',$papernum,'',$sql_order_template,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'صحافی',$papernum,$sahafi_value,$sql_order_sahafi,$all_total,$discount_fee);
                                $all_total=offset_detail($c,'شماره زنی',$papernum,$numbering_value,$sql_order_numbering,$all_total,$discount_fee);


                                $total+=$all_total;	 }
                        }
                    }}


                if(!empty($invoiceID)){
                    $make_line_array=array();
                    $make_format_array=array();
                    $make_format_beat=array();

                    $sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$invoiceID");
                    while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){

                        $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                        $sql_banner_total_price2 = $sql_banner['order_total_price'];
                        $sql_banner_unit_price =$sql_banner['order_unit_price'];
                        $sql_order_submit_date = $sql_banner['order_submit_date'];
                        $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                        $sql_od_order_type = $sql_banner['order_type'];
                        $sql_order_last_status = $sql_banner['order_last_status'];

                        $sql_od_make_format = $sql_banner['order_make_format'];
                        $make_format_array[]=$sql_od_make_format;
                        if ($sql_od_make_format == 'true') {
                            $sql_od_make_format = 'حلقه';
                        }
                        else{
                            $sql_od_make_format = '';
                        }

                        $sql_od_make_line = $sql_banner['order_make_line'];
                        $make_line_array[]=$sql_od_make_line;

                        if ($sql_od_make_line == 'true') {
                            $sql_od_make_line = '- ایستند';
                        }
                        else{
                            $sql_od_make_line = '';
                        }

                        $sql_od_make_format_beat = $sql_banner['order_make_format_beat'];
                        $make_format_beat[]=$sql_od_make_format_beat;
                        if ($sql_od_make_format_beat == 'w') {
                            $sql_od_make_format_beat = '- جای داربست (طول)';
                        }
                        elseif ($sql_od_make_format_beat == 'h'){
                            $sql_od_make_format_beat = '- جای داربست (عرض)';
                        }

                        $sql_od_make_header_glue = $sql_banner['order_make_header_glue'];




                        $sql_order_size = $sql_od_order_type.$sql_banner['order_width']."X".$sql_banner['order_height'];
                        $sql_order_last_status = $sql_banner['order_last_status'];


                        $calc_meter=($sql_banner['order_width']/100)*($sql_banner['order_roll']/100);
                        if($calc_meter<1){$calc_meter=1;}

                        $total_size=($calc_meter*$sql_od_lot_quantity)*$sql_banner_unit_price;
                        if($sql_order_last_status!=6){
                            echo "<tr>";
                            echo "<td>$c</td>";
                            $c+=1;
                            echo "<td  $read_m>$calc_meter"."متر - $sql_order_size  ";

						$total_size_d=$total_size*$percent_1;
						 
                            echo "</td>";
                            echo "<td  $read_m>$sql_od_lot_quantity</td>";
                            echo "<td $read_m>".number_format($sql_banner_unit_price)." تومان</td>";
							 echo "<td $read_m>".($percent_1*100)."% - ".number_format($total_size_d)." تومان</td>";
                            echo "<td $read_m>".number_format( $total_size )." تومان</td>";
                            echo "</tr>";

                            $total+= $total_size;
                        }
                    }






                    if (in_array('true',$make_format_array)) {


                        $sql_orders_of_banner = mysqli_query($connection, "SELECT *,sum(order_lot_quantity*order_make_header_glue) as header_glue FROM orders1 where   order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];
                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_header_glue=$sql_banner['header_glue'];
                            $sql_order_last_status = $sql_banner['order_last_status'];
                            $sql_od_make_format = $sql_banner['order_make_format'];
                            if ($sql_od_make_format == 'true') {
                                $sql_od_make_format = 'حلقه';
                            } else {
                                $sql_od_make_format = '';
                            }
                            if($sql_order_last_status!=6){

                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";



                                echo "<span class=\"order-detail-bg\">حلقه  </span>";

                                $total_foramt_d = ( $sql_header_glue * $d['halghe'])*$percent_1;
								$total_foramt=( $sql_header_glue * $d['halghe'])- $total_foramt_d;
                                echo "</td>";
                                echo "<td  $read_m>" .   $sql_header_glue . "</td>";
                                echo "<td $read_m>".$d['halghe']." تومان</td>";
								echo "<td $read_m>".($percent_1*100)."% - ".$total_foramt_d." تومان</td>";
                                echo "<td $read_m>$total_foramt تومان</td>";
                                echo "</tr>";

                                $total += $total_foramt;
                            }




                        }
                    }

                    if (in_array('true',$make_line_array)) {


                        $sql_orders_of_banner = mysqli_query($connection, "SELECT *,sum( CASE WHEN order_make_line = \"true\" THEN order_lot_quantity ELSE 0 END) as condition_true FROM orders1 where   order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];
                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_order_last_status = $sql_banner['order_last_status'];

                            $sql_od_make_line = $sql_banner['order_make_line'];
                            $condition_true = $sql_banner['condition_true'];
                            if ($sql_od_make_line == 'true') {
                                $sql_od_make_line = 'ایستند';
                            } else {
                                $sql_od_make_line = '';
                            }

                            if($sql_order_last_status!=6){
                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";


                                echo "استند
					</td>";  $stand_d=($d['stand'] * $condition_true )*$percent_1;
					$stand_all=($d['stand'] * $condition_true)- $stand_d;
                                echo "<td  $read_m>$condition_true</td>";
                                echo "<td $read_m>".$d['stand']." تومان</td>";
								echo "<td $read_m>".($percent_1*100)."% - ".$stand_d." تومان</td>";
                                echo "<td $read_m>" . $stand_all  . " تومان </td>";
                                echo "</tr>";

                                $total += $stand_all ;
                            }

                        }


                    }


                    if (in_array('h',$make_format_beat) || in_array('w',$make_format_beat)) {
                        $sql_orders_of_banner = mysqli_query($connection, "SELECT  *,sum( CASE WHEN order_make_format_beat = \"w\"   THEN order_width*order_lot_quantity ELSE 0 END) as condition_w,sum( CASE WHEN order_make_format_beat = \"h\"   THEN order_height*order_lot_quantity ELSE 0 END) as condition_h,sum(CASE WHEN order_make_format_beat = \"h\" or order_make_format_beat = \"w\"  THEN order_lot_quantity ELSE 0 END) as total_beat FROM orders1 where order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];
                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_od_make_format_beat = $sql_banner['order_make_format_beat'];
                            $sql_total_beat = (($sql_banner['condition_w']+$sql_banner['condition_h'])*2)/ 100 ." متر";
                            $sql_order_last_status = $sql_banner['order_last_status'];
                            $tuduzi_r += (($sql_banner['condition_w'] / 100) * $d['darbast'] * 2);

                            $tuduzi_r += (($sql_banner['condition_h'] / 100) * $d['darbast'] * 2);


                            if ($sql_od_make_format_beat == 'w') {
                                $sql_od_make_format_beat = '  جای داربست';
                            } elseif ($sql_od_make_format_beat == 'h') {
                                $sql_od_make_format_beat = '  جای داربست';
                            }

                            $sql_od_make_header_glue = $sql_banner['order_make_header_glue'];

                            if($sql_order_last_status!=6){
                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";


                                echo "جای داربست";

                                echo "</td>";

                                echo "<td  $read_m>$sql_total_beat
                </td>";
								$tuduzi_d=$tuduzi_r*$percent_1;
								$tuduzi_r=$tuduzi_r-$tuduzi_d;
                                echo "<td $read_m>".$d['darbast']."  تومان</td>";
								 echo "<td $read_m>".($percent_1*100)."% - ".$tuduzi_d."  تومان</td>";
                                echo "<td $read_m>" . $tuduzi_r . " تومان</td>";
                                echo "</tr>";

                                $total += $tuduzi_r;
                            }

                        }
                    }

                }



                $order_of_offset=  "SELECT * FROM orders3 where factor=$invoiceID " ;


                if(!empty($invoiceID)){
                    $sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
                    while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
                        $sql_offset_total_price = number_format($sql_offset['order_total_price']);
                        $sql_offset_total_price2 = $sql_offset['order_total_price'];
                        $sql_offset_unit_price = number_format($sql_offset['order_unit_price']);
                        $sql_order_type = $sql_offset['order_type'];
                        $sql_order_total_price = $sql_offset['order_total_price'];
                        $sql_order_submit_date = $sql_offset['order_submit_date'];
                        $sql_order_submit_date = $sql_offset['order_submit_date'];						 					$sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
                        $sql_od_quantity = $sql_offset['order_quantity'];
                        $sql_order_print_permission = $sql_offset['order_print_permission'];
                        $sql_order_delivery_permission = $sql_offset['order_delivery_permission'];

                        $permission = $sql_offset['order_delivery_permission'];
                        $sql_order_last_status = $sql_offset['order_last_status'];


                        if($sql_order_last_status!=6){
                            echo "<tr>";
                            echo "<td>$c</td>";
                            $c+=1;
                            echo "<td $read_m>$sql_order_type  </td>";
                            echo "<td  $read_m>$sql_od_lot_quantity</td>";


                            echo "<td $read_m>$sql_offset_unit_price تومان</td>";
                            echo "<td $read_m>$sql_offset_total_price تومان</td>";

                            $total+=$sql_offset_total_price2;

                            echo "</tr>";}
                    }}









                $order_total_half=  "SELECT SUM(t.order_total_price) as total_half FROM (select order_total_price from orders3  where factor=$invoiceID and order_last_status>0 and order_last_status!=6 
	UNION ALL
	 select order_total_price from orders2  where factor=$invoiceID and order_last_status>0  and order_last_status!=6
	  UNION ALL
	   select order_total_price from orders1  where order_make_number_perforating=$invoiceID and order_last_status>0  and order_last_status!=6) t" ;


                if(!empty($invoiceID)){
                    $sql_order_total_half= mysqli_query($connection, $order_total_half);
                    $total_half=mysqli_fetch_assoc($sql_order_total_half);
                    $total_half_price_format=	number_format($total_half['total_half']);
                    $total_half_price=	$total_half['total_half'];

                }
                ?>

            </table>

        </td></tr>
    <tr>
        <td colspan="10">

            <table width="100%">
                <td >نوع پرداخت :<?= $sql_od_ls?> مبلغ :<?= $half_price?>
                    <br>
                    <?  if(isset($sql_od_ls_2)){?>          نوع پرداخت :<?= $sql_od_ls_2?> مبلغ :<?= $half_price_2;?><br><? }?>
                    <?  if(isset($sql_od_ls_3)){?>          نوع پرداخت :<?= $sql_od_ls_3?> مبلغ :<?= $half_price_3;?> <br><? }?>
                    <?  if(isset($sql_od_ls_4)){?>          نوع پرداخت :<?= $sql_od_ls_4?> مبلغ :<?= $half_price_4;?>    <br><? }?>

                    نام طراح : <?=$sql_user_realname ?> <br>

                    <div style="font-size:9px">زمان پیگیری : .............. تاریخ تایید نهایی : .............. </div></td>
                <td align="right" valign="top" width="35%">توضیحات: <?=$sql_od_description?></td>
                <td width="30%">
                    <table width="100%">
                        <tr><td><div align="right"><h3>جمع مبلغ : <?= number_format($total) ?> تومان </h4></div></td></tr>
                        <tr><td><div align="right">بیعانه : <?

                                    if(!empty($half_price) || !empty($half_price_2)  || !empty($half_price_3)|| !empty($half_price_4)){

                                        echo    number_format($half_price+$half_price_2+$half_price_3+$half_price_4) ;
                                    }else{
                                        echo    number_format($total_half_price-$sql_od_discount) ;


                                    }
                                    ?></div> </td></tr>
                        <? if (!empty($sql_od_discount)){?>
                            <tr><td><div align="right">کسر مازاد : <?= number_format($sql_od_discount)?></div> </td></tr>

                        <? } ?>
                        <? if (!empty($edit_price)){?>
                            <tr><td><div align="right">بستانکار : <?= number_format($edit_price)?></div> </td></tr>

                        <? } ?>
                        <tr><td><div align="right">مانده : <?
                                    if ( $total_half_price!=0){ $edit_price=0;}
                                    if(!empty($half_price) || !empty($half_price_2)  || !empty($half_price_3)|| !empty($half_price_4)){

                                        echo    number_format($total-$sql_od_discount-$edit_price-($half_price+$half_price_2+$half_price_3+$half_price_4 )) ;
                                    }else{
                                        echo   number_format(($total-$edit_price)-($total_half_price));

                                    }


                                    ?></div></td></tr>
                    </table>
                </td>
            </table>
        </td>
    </tr>
</table><br>




<table id="financial-invoices-table" width="100%">
    <tr>
        <th width="80%">سند رسید مشتری</th>
        <th >فاکتور : <?=$invoiceID?></th>
    </tr>
    <tr>
        <td colspan="2"><div align="right">نام طراح : <?=$sql_user_realname ?></div></td>
    </tr>
    <tr>
        <td height="140" colspan="2" valign="top">
            <table width="100%" style="font-size:8px"><tr>
                    <td>ردیف</td>
                    <td width="40%">شرح</td>
                    <td>تعداد</td>
                    <td>فی</td>
                    <td>جمع کل</td>
                </tr>  <?
                $c=1;

                $order_of_offset=  "SELECT * FROM orders2 where factor=$invoiceID " ;


                if(!empty($invoiceID)){
                    $sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
                    while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
                        $sql_offset_total_price = number_format($sql_offset['order_total_price']);
                        $sql_offset_total_price2 = $sql_offset['order_total_price'];
                        $sql_offset_unit_price = number_format($sql_offset['order_unit_price']);
                        $sql_order_type = $sql_offset['order_type'];
                        $sql_order_cat = $sql_offset['cat'];
                        $sql_order_total_price = $sql_offset['order_total_price'];
                        $sql_order_submit_date = jdate('Y/m/d h:i a',strtotime(   $sql_offset['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
                        $sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
                        $sql_od_quantity = $sql_offset['order_quantity'];
                        $sql_order_print_permission = $sql_offset['order_print_permission'];
                        $sql_order_delivery_permission = $sql_offset['order_delivery_permission'];

                        $sql_order_paperprice = $sql_offset['paperprice'];
                        $sql_order_zinc = $sql_offset['zinc'];
                        $sql_order_print = $sql_offset['print'];
                        $sql_order_uv = $sql_offset['uv'];
                        $sql_order_light = $sql_offset['light'];
                        $sql_order_porfrag = $sql_offset['porfrag'];
                        $sql_order_linebreak = $sql_offset['linebreak'];
                        $sql_order_tigh = $sql_offset['tigh'];
                        $sql_order_manganeh = $sql_offset['manganeh'];
                        $sql_order_template = $sql_offset['template'];
                        $sql_order_sahafi = $sql_offset['sahafi'];
                        $sql_order_numbering = $sql_offset['numbering'];
                        $order_zinc = $sql_offset['order_zinc'];
                        $order_tside = $sql_offset['order_tside'];
                        $papernum = $sql_offset['papernum'];
                        $select_paper_id = $sql_offset['select_paper_id'];
                        $qty_print = $sql_offset['qty_print'];
                        $print_fee = $sql_offset['print_fee'];
                        $zinc_fee = $sql_offset['zinc_fee'];
                        if( $order_tside=='دو رو با دو زینک'){$zinc_qty=2;}elseif($order_tside=='تک رو'){$zinc_qty=1;}elseif($order_tside=='دو رو با یک زینک'){$order_tside=$zinc_qty=1;}

                        if($sql_order_cat=="1"){$sql_order_cat="کارت ویزیت";  };
                        if($sql_order_cat=="2"){$sql_order_cat=  "تراکت رنگی" ;};
                        if($sql_order_cat=="3"){$sql_order_cat= "تراکت تک رنگ" ; };
                        if($sql_order_cat=="4"){$sql_order_cat=   "تراکت دو رنگ";};
                        if($sql_order_cat=="5"){$sql_order_cat=  "فاکتور"  ; };
                        if($sql_order_cat=="6"){$sql_order_cat=  "قبض رنگی";}
                        if($sql_order_cat=="7"){$sql_order_cat=   "قبض ریسو"; };
                        if($sql_order_cat=="8"){$sql_order_cat=   "پاکت ریسو"; };
                        if($sql_order_cat=="9"){$sql_order_cat= "پاکت رنگی"; };


                        $permission = $sql_offset['order_delivery_permission'];
                        $sql_order_last_status = $sql_offset['order_last_status'];

                        if($sql_order_last_status!=6 ){
                            if($sql_order_paperprice==0){

                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c+=1;
                                if (!empty($sql_od_quantity)){$quantiti_text="- تیراژ: $sql_od_quantity";}
                                echo "<td $read_m>$sql_order_cat: $sql_order_type $quantiti_text</td>";
                                echo "<td  $read_m>$sql_od_lot_quantity</td>";
                                $quantiti_text="";
                                if ($sql_order_paperprice!=0){$sql_offset_unit_price=0;$sql_offset_total_price=0;}
                                echo "<td $read_m>".$sql_offset_unit_price." تومان</td>";
                                echo "<td $read_m>$sql_offset_total_price تومان</td>";

                                $total+=$sql_offset_total_price2;
                            }else{




                                $uv_value=$d['uv'];
                                $light_value=$d['light'];
								$mat_value=$d['mat'];
                                $uvm_value=$d['uvm'];
                                $porfrag_value=$d['porfrag'];
                                $linebreak_value=$d['linebreak'];
                                $tigh_value=$d['tigh'];
                                $manganeh_value=$d['manganeh'];
                                $numbering_value=$d['numbering'];
                                $sahafi_value=$d['sahafi'];

                                $all_total=offset_detail($c,'کاغذ '.$select_paper_id,$papernum,$sql_order_paperprice/$papernum,$sql_order_paperprice,0);
                                $all_total=offset_detail($c,$order_zinc,$zinc_qty,$zinc_fee,$sql_order_zinc,$all_total);
                                $all_total=offset_detail($c,'چاپ '.$order_tside,$qty_print,$print_fee,$sql_order_print,$all_total);
                                $all_total=offset_detail($c,'سلفون یو وی',$qty_print,$uv_value,$sql_order_uv,$all_total);
                                $all_total=offset_detail($c,'سلفون براق',$qty_print,$light_value,$sql_order_light,$all_total);
								 $all_total=offset_detail($c,'سلفون مات',$qty_print,$mat_value,$sql_order_uv,$all_total);
                                $all_total=offset_detail($c,'سلفون یووی موضعی',$qty_print,$uvm_value,$sql_order_light,$all_total);
                                $all_total=offset_detail($c,'پرفراژ',$papernum,$porfrag_value,$sql_order_porfrag,$all_total);
                                $all_total=offset_detail($c,'خط تا',$papernum,$linebreak_value,$sql_order_linebreak,$all_total);
                                $all_total=offset_detail($c,'تیغ',$qty_print,$tigh_value,$sql_order_tigh,$all_total);
                                $all_total=offset_detail($c,'منگنه',$papernum,$manganeh_value,$sql_order_manganeh,$all_total);
                                $all_total=offset_detail($c,'قالب',$papernum,'',$sql_order_template,$all_total);
                                $all_total=offset_detail($c,'صحافی',$papernum,$sahafi_value,$sql_order_sahafi,$all_total);
                                $all_total=offset_detail($c,'شماره زنی',$papernum,$numbering_value,$sql_order_numbering,$all_total);


                                $total+=$all_total;	 }
                        }
                    }}


                if(!empty($invoiceID)){
                    $make_line_array=array();
                    $make_format_array=array();
                    $make_format_beat=array();

                    $sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$invoiceID");
                    while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){

                        $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                        $sql_banner_total_price2 = $sql_banner['order_total_price'];
                        $sql_banner_unit_price =$sql_banner['order_unit_price'];
                        $sql_order_submit_date = $sql_banner['order_submit_date'];
                        $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                        $sql_od_order_type = $sql_banner['order_type'];
                        $sql_order_last_status = $sql_banner['order_last_status'];

                        $sql_od_make_format = $sql_banner['order_make_format'];
                        $make_format_array[]=$sql_od_make_format;
                        if ($sql_od_make_format == 'true') {
                            $sql_od_make_format = 'حلقه';
                        }
                        else{
                            $sql_od_make_format = '';
                        }

                        $sql_od_make_line = $sql_banner['order_make_line'];
                        $make_line_array[]=$sql_od_make_line;

                        if ($sql_od_make_line == 'true') {
                            $sql_od_make_line = '- ایستند';
                        }
                        else{
                            $sql_od_make_line = '';
                        }

                        $sql_od_make_format_beat = $sql_banner['order_make_format_beat'];
                        $make_format_beat[]=$sql_od_make_format_beat;
                        if ($sql_od_make_format_beat == 'w') {
                            $sql_od_make_format_beat = '- جای داربست (طول)';
                        }
                        elseif ($sql_od_make_format_beat == 'h'){
                            $sql_od_make_format_beat = '- جای داربست (عرض)';
                        }

                        $sql_od_make_header_glue = $sql_banner['order_make_header_glue'];




                        $sql_order_size = $sql_od_order_type.$sql_banner['order_width']."X".$sql_banner['order_height'];
                        $sql_order_last_status = $sql_banner['order_last_status'];


                        $calc_meter=($sql_banner['order_width']/100)*($sql_banner['order_roll']/100);
                        if($calc_meter<1){$calc_meter=1;}

                        $total_size=($calc_meter*$sql_od_lot_quantity)*$sql_banner_unit_price;
                        if($sql_order_last_status!=6){
                            echo "<tr>";
                            echo "<td>$c</td>";
                            $c+=1;
                            echo "<td  $read_m>$calc_meter"."متر - $sql_order_size  ";


                            echo "</td>";
                            echo "<td  $read_m>$sql_od_lot_quantity</td>";
                            echo "<td $read_m>".number_format($sql_banner_unit_price)." تومان</td>";
                            echo "<td $read_m>".number_format( $total_size )." تومان</td>";
                            echo "</tr>";

                            $total+= $total_size;
                        }
                    }






                    if (in_array('true',$make_format_array)) {


                        $sql_orders_of_banner = mysqli_query($connection, "SELECT *,sum(order_lot_quantity*order_make_header_glue) as header_glue FROM orders1 where   order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];
                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_header_glue=$sql_banner['header_glue'];
                            $sql_order_last_status = $sql_banner['order_last_status'];
                            $sql_od_make_format = $sql_banner['order_make_format'];
                            if ($sql_od_make_format == 'true') {
                                $sql_od_make_format = 'حلقه';
                            } else {
                                $sql_od_make_format = '';
                            }
                            if($sql_order_last_status!=6){

                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";



                                echo "<span class=\"order-detail-bg\">حلقه  </span>";

                                $total_foramt = ( $sql_header_glue) * $d['halghe'];
                                echo "</td>";
                                echo "<td  $read_m>" .   $sql_header_glue . "</td>";
                                echo "<td $read_m>".$d['halghe']." تومان</td>";
                                echo "<td $read_m>$total_foramt تومان</td>";
                                echo "</tr>";

                                $total += $total_foramt;
                            }




                        }
                    }

                    if (in_array('true',$make_line_array)) {


                        $sql_orders_of_banner = mysqli_query($connection, "SELECT *,sum( CASE WHEN order_make_line = \"true\" THEN order_lot_quantity ELSE 0 END) as condition_true FROM orders1 where   order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];
                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_order_last_status = $sql_banner['order_last_status'];

                            $sql_od_make_line = $sql_banner['order_make_line'];
                            $condition_true = $sql_banner['condition_true'];
                            if ($sql_od_make_line == 'true') {
                                $sql_od_make_line = 'ایستند';
                            } else {
                                $sql_od_make_line = '';
                            }

                            if($sql_order_last_status!=6){
                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";


                                echo "استند
					</td>";
                                echo "<td  $read_m>$condition_true</td>";
                                echo "<td $read_m>".$d['stand']." تومان</td>";
                                echo "<td $read_m>" . $d['stand'] * $condition_true . " تومان </td>";
                                echo "</tr>";

                                $total += $d['stand'] * $condition_true;
                            }

                        }


                    }


                    if (in_array('h',$make_format_beat) || in_array('w',$make_format_beat)) {
                        $sql_orders_of_banner = mysqli_query($connection, "SELECT  *,sum( CASE WHEN order_make_format_beat = \"w\"   THEN order_width*order_lot_quantity ELSE 0 END) as condition_w,sum( CASE WHEN order_make_format_beat = \"h\"   THEN order_height*order_lot_quantity ELSE 0 END) as condition_h,sum(CASE WHEN order_make_format_beat = \"h\" or order_make_format_beat = \"w\"  THEN order_lot_quantity ELSE 0 END) as total_beat FROM orders1 where order_make_number_perforating =$invoiceID");
                        while ($sql_banner = mysqli_fetch_array($sql_orders_of_banner)) {

                            $sql_banner_total_price = number_format($sql_banner['order_total_price']);
                            $sql_banner_total_price2 = $sql_banner['order_total_price'];
                            $sql_banner_unit_price = number_format($sql_banner['order_unit_price']);
                            $sql_order_submit_date = $sql_banner['order_submit_date'];

                            $sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
                            $sql_od_make_format_beat = $sql_banner['order_make_format_beat'];
                            $sql_total_beat = (($sql_banner['condition_w']+$sql_banner['condition_h'])*2)/ 100 ." متر";
                            $sql_order_last_status = $sql_banner['order_last_status'];
                            $tuduzi_r += (($sql_banner['condition_w'] / 100) * $d['darbast'] * 2);

                            $tuduzi_r += (($sql_banner['condition_h'] / 100) * $d['darbast'] * 2);


                            if ($sql_od_make_format_beat == 'w') {
                                $sql_od_make_format_beat = '  جای داربست';
                            } elseif ($sql_od_make_format_beat == 'h') {
                                $sql_od_make_format_beat = '  جای داربست';
                            }

                            $sql_od_make_header_glue = $sql_banner['order_make_header_glue'];

                            if($sql_order_last_status!=6){
                                echo "<tr>";
                                echo "<td>$c</td>";
                                $c += 1;
                                echo "<td  $read_m>";


                                echo "جای داربست";

                                echo "</td>";

                                echo "<td  $read_m>$sql_total_beat
                </td>";
                                echo "<td $read_m>".$d['darbast']."  تومان</td>";
                                echo "<td $read_m>" . $tuduzi_r . " تومان</td>";
                                echo "</tr>";

                                $total += $tuduzi_r;
                            }

                        }
                    }

                }



                $order_of_offset=  "SELECT * FROM orders3 where factor=$invoiceID " ;


                if(!empty($invoiceID)){
                    $sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
                    while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
                        $sql_offset_total_price = number_format($sql_offset['order_total_price']);
                        $sql_offset_total_price2 = $sql_offset['order_total_price'];
                        $sql_offset_unit_price = number_format($sql_offset['order_unit_price']);
                        $sql_order_type = $sql_offset['order_type'];
                        $sql_order_total_price = $sql_offset['order_total_price'];
                        $sql_order_submit_date = $sql_offset['order_submit_date'];
                        $sql_order_submit_date = $sql_offset['order_submit_date'];						 					$sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
                        $sql_od_quantity = $sql_offset['order_quantity'];
                        $sql_order_print_permission = $sql_offset['order_print_permission'];
                        $sql_order_delivery_permission = $sql_offset['order_delivery_permission'];

                        $permission = $sql_offset['order_delivery_permission'];
                        $sql_order_last_status = $sql_offset['order_last_status'];


                        if($sql_order_last_status!=6){
                            echo "<tr>";
                            echo "<td>$c</td>";
                            $c+=1;
                            echo "<td $read_m>$sql_order_type  </td>";
                            echo "<td  $read_m>$sql_od_lot_quantity</td>";


                            echo "<td $read_m>$sql_offset_unit_price تومان</td>";
                            echo "<td $read_m>$sql_offset_total_price تومان</td>";

                            $total+=$sql_offset_total_price2;

                            echo "</tr>";}
                    }}




                ?></table>

        </td>
    </tr>
    <tr>
        <td colspan="2"><div align="right">وجه دریافتی : <? if(!empty($half_price) || !empty($half_price_2)  || !empty($half_price_3)|| !empty($half_price_4)){

                    echo    number_format($half_price+$half_price_2+$half_price_3+$half_price_4) ;
                }else{
                    echo    number_format($total_half_price-$sql_od_discount) ;


                }?> تومان</div> </td>
    </tr>
    </tr>
    <tr><td colspan="2">آدرس: تبریز - میدان ساعت، روبروی پاساژ بهارستان، کوچه شهید ختایی
            تلگرام: @shamimgraphicbot   تلفن: 35577927-041</td></tr>

</table>
