<?php require ("header.php");?>
<?php include ("sidebar.php");?>
<?
 	  parse_str($_SERVER['QUERY_STRING']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$balance_type=$_POST['balance-type'];
    $dates = $_POST['datepicker1'];
    $dates2 = $_POST['datepicker2'];
}else{
  $balance_type=$_GET['balance-type'];
      $dates = $_GET['datepicker1'];
      $dates2 = $_GET['datepicker2'];
}
switch( $balance_type){
    case 0: $order_select_0="selected";break;
    case 1: $order_select_1="selected";break;
    case 2: $order_select_2="selected";break;
    case 3: $order_select_3="selected";break;
    case 4: $order_select_4="selected";break;
    case 6: $order_select_6="selected";break;
}

?>	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">گزارش پرداخت<?= $username?></h2>
    <?php
        echo "<form id=\"order-edit-form\" action=".$_SERVER['PHP_SELF']." method=\"post\">";
        echo "<select name=\"balance-type\" class=\"order-edit-select\">";
            echo"<option value=\"1\" $order_select_1  >اعتبار </option>
            <option value=\"2\" $order_select_2 >چک </option>
            <option value=\"3\" $order_select_3>نقد </option>
            <option value=\"4\" $order_select_4>بدهکار </option>
            <option value=\"6\" $order_select_6>کنسل </option>
            <option value=\"0\" $order_select_0>واریزی حساب</option>";

            echo "</select>";
          echo " از تاریخ :            <input type=\"text\" id=\"datepicker1\" class=\"inpts\" name=\"datepicker1\"  />
            تا تاریخ :            <input type=\"text\" id=\"datepicker2\" class=\"inpts\" name=\"datepicker2\"  />";

        echo "<input type=\"submit\" class=\"order-edit-submit\" value=\"ثبت\"  name=\"submit\"></td>";

        echo "</form>";




	require ('../db_select.php');





    $dates_ex = explode('/', $dates);
    $dates2_ex = explode('/', $dates2);
    $resdate= strtotime(jalali_to_gregorian($dates_ex[2] , $dates_ex[1] ,$dates_ex[0] ,'-'));
    $resdate2= strtotime(jalali_to_gregorian($dates2_ex[2] , $dates2_ex[1] ,$dates2_ex[0] ,'-'));
    $datefrom = date('Y-m-d',$resdate);
    $dateto =date('Y-m-d', $resdate2);


    $sql_invoices = mysqli_query($connection, "select * from credits_list where type=$balance_type and date(data) between '$datefrom' and '$dateto'");
    $RecordCount = mysqli_num_rows($sql_invoices);
    $showRecord = 30;
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
	parse_str($_SERVER['QUERY_STRING']);

  if($balance_type==4){$pointer="<";}
    elseif($balance_type==0){$pointer=">";}
    if($balance_type==4 or $balance_type==0){
        $sql_invoices_of_user = mysqli_query($connection, "select * from credits_list where quantity $pointer 0  and  type NOT IN(1,2,3,6) and date(data) between '$datefrom' and '$dateto'  ORDER BY data  DESC LIMIT $start , $end  ");
    }else {
        $sql_invoices_of_user = mysqli_query($connection, "select * from credits_list where type=$balance_type and date(data) between '$datefrom' and '$dateto'  ORDER BY data  DESC LIMIT $start , $end  ");
    }


?>


    <?php

    if(!isset($page) || $page == ''){
        $page = 1;
    }
    echo "<br/> صفحه ی ".$page ." از ".$pages;

    ?><br>
    <br>


    <table id="financial-invoices-table" width="95%">
        <tr>
            <th>ردیف</th>
            <th class="th-darker">شماره </th>
            <th>عنوان</th>
            <th class="th-darker">مبلغ</th>
            <th class="th-darker">بدهکار</th>
            <th class="th-darker">بستانکار</th>
            <th class="th-darker">مانده</th>
            <th>تاریخ ایجاد</th>
            <th class="th-darker">وضعیت تایید</th>

            <th class="th-darker">حذف</th>

        </tr>
        <tr><?php
            $c = '1';
            while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

                $sql_invoice_code = $sql_invoices['id_parent'];
                $sql_invoice_cash = number_format($sql_invoices['quantity']);
                $sql_invoice_cash_int = $sql_invoices['quantity'];
                $sql_invoice_cash_total=number_format($sql_invoices['quantity_total']);
                $sql_invoice_id=$sql_invoices['invoice_id'];
                $sql_invoice_user=$sql_invoices['user'];
                if($sql_invoice_cash<0){
                    $sql_invoice_cash='<span class="red-text">'. $sql_invoice_cash.' تومان</span>';
                }else{ $sql_invoice_cash='<span class="green-text">'. $sql_invoice_cash.' تومان</span>';}
                if($sql_invoice_cash_int>0){
                    $sql_invoice_cash_out='';
                    $sql_invoice_cash_in=$sql_invoice_cash;}else{
                    $sql_invoice_cash_in='';
                    $sql_invoice_cash_out=$sql_invoice_cash;
                }
                $sql_invoice_comment = $sql_invoices['title'];
                $sql_invoice_is_paid = $sql_invoices['approved'];
                $sql_invoice_create_date=   jdate('Y/m/d h:i a',strtotime( $sql_invoices['data'].' +210 minutes'),'none','Iran/Tehran','fa');

                if (is_null($sql_invoice_deposit_date)) {
                    $sql_invoice_deposit_date = '-';
                }
                if ($sql_invoice_is_paid == '0') {
                    $sql_invoice_is_paid= '<span class="red-text">تایید نشده</span>';


                }
                elseif ($sql_invoice_is_paid == '1') {
                    $sql_invoice_is_paid= '<span class="green-text">تایید شده</span>';

                    $sql_is_paid_change_link = '-';
                }

                $id_user=$_GET['id'];
                $sql_payment_link ="<a href=\"?id=$id_user&do=delete&id_parent=$sql_invoice_code\"><span class=\"adminpanel-delete-icon\"></span></a>";

                echo "<tr>";
                echo "<td>$c</td>";
                $c++;
                echo "<td class=\"th-darker\">$sql_invoice_user</td>";
                echo "<td class=\"th-darker\">$sql_invoice_code</td>";
                echo "<td>$sql_invoice_comment";



                if(!empty($sql_invoice_id)){

                    $sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$sql_invoice_id");
                    while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){
                        $sql_order_last_status = $sql_banner['order_last_status'];
                        if($sql_order_last_status!=6) {
                            $sql_banner_total_price += $sql_banner['order_total_price'];
                            $sql_banner_price = $sql_banner['order_total_price'];
                        }
                        $sql_order_submit_date = $sql_banner['order_submit_date'];						 					$sql_od_lot_quantity = $sql_banner['order_lot_quantity'];

                        $sql_order_promise_date ='بنر'. $sql_banner['order_width']."X".$sql_banner['order_height'];




                        echo " تعداد: $sql_od_lot_quantity ";
                        echo "$sql_order_promise_date ";


                    }}




                $order_of_offset=  "SELECT * FROM orders2 where factor=$sql_invoice_id " ;


                if(!empty($sql_invoice_id)) {
                    $sql_orders_of_offset = mysqli_query($connection, $order_of_offset);
                    while ($sql_offset = mysqli_fetch_array($sql_orders_of_offset)) {
                        $sql_order_last_status = $sql_offset['order_last_status'];
                        $sql_order_type = $sql_offset['order_type'];



                        echo " تعداد: $sql_od_lot_quantity ";
                        echo "$sql_order_type ";



                    }
                }



                $order_of_offset=  "SELECT * FROM orders3 where factor=$sql_invoice_id " ;


                if(!empty($sql_invoice_id)){
                    $sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
                    while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){

                        $sql_order_last_status = $sql_offset['order_last_status'];

                        $sql_order_type = $sql_offset['order_type'];



                        echo " تعداد: $sql_od_lot_quantity ";
                        echo "$sql_order_type ";






                    }

                }












                echo"</td>";
 
                echo "<td class=\"th-darker\">$sql_invoice_cash_out</td>";
                echo "<td class=\"th-darker\">$sql_invoice_cash_in</td>";
                echo "<td class=\"th-darker\">$sql_invoice_cash_total</td>";

                echo "<td>$sql_invoice_create_date</td>";
                echo "<td class=\"th-darker\">$sql_invoice_is_paid</td>";

                echo "<td class=\"th-darker\">$sql_payment_link  </td>";

                echo "</tr>";


            }
            ?>

    </table>

    <div id="paging">
        <ul><?php
            if(isset($page) && $page != '' && $page >=  1){
                $backpage = $page - 1;
                $nextpage = $page + 1;
            }
            elseif(isset($page) && $page != '' && $page == $pages) {
                $backpage = $page - 1;
                $nextpage = '';
            }
            else{
                $nextpage = 2;
            }
            if(isset($backpage) && $backpage != '' && $backpage >= 1){
                echo "<a href=\"?page=$backpage&id=$id\"><li>صفحه قبل</li></a>";
            }
            for($i = 1; $i <= $pages; $i++){
                if($i == $page){
                    $active_page_button = "class=\"active_page_button\"";
                }
                else{
                    $active_page_button = '';
                }
                echo "<a href=\"?page=$i&id=$id&balance-type=$balance_type&datepicker1=$dates&datepicker2=$dates2\"><li $active_page_button>$i</li></a>";
            }
            if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
                echo "<a href=\"?page=$nextpage&id=$id\"><li>صفحه بعد</li></a>";
            }
            ?></ul>
    </div>

</section>

<?php include ("footer.php"); ?>
