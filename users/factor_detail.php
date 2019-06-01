<?php require ("header.php");?>

<section id="user-panel-sheet"><br>
    <br>

    <h2 class="user-panel-sheet-h2">لیست سفارشات</h2>
    <?php
    require ('../config.php');

    $connection = mysqli_connect($server_name, $db_username, $db_password);
    if(!$connection){
        die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
    }
    mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");

    parse_str($_SERVER['QUERY_STRING']);

    $username_value = $_SESSION['print_username'];

    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");
    mysqli_query($connection, "SET character_set_connection = 'utf8'");



    if(isset($_POST['submit_last_status']) && isset($_POST['input_id_last_status'])){


        $accept =	$_POST['accept_last_status'];
        $id = $_POST['input_id_last_status'];

        if(!mysqli_query($connection,"update orders3 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));


    }




    if($_GET['action']=='delete' && isset($_GET['photo'])){


        $id=$_GET['photo'];
        $sql_orders_num = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_id=$id   and (order_print_permission=0  or order_delivery_permission=1)");


        $sql_od_file=mysqli_fetch_assoc($sql_orders_num);
        $file1=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file1'];
        $file4=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file4'] ;


        if (!unlink($file1))
        {
            echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

            echo "<br>
<div style='color:red;text-align:center;'>فایل در حال چاپ! نمی توانید کنسل کنید.</div>";

        }
        else
        {
            echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

            echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
        }

    }

    if($_GET['action']=='delete' && isset($_GET['id'])){

        $id=$_GET['id'];



        
        $select_invoice=mysqli_fetch_assoc($sql_select_invoice);
        $order_invoice=	$select_invoice['order_invoice_code'];
        $file1=$_SERVER['DOCUMENT_ROOT'].$select_invoice['order_file1'];




        $sql_order_delete="update orders1 set order_last_status=6 WHERE order_id=$id and order_print_permission=0 ";



        $sql_deleted_row=mysqli_query($connection,$sql_order_delete)  ;



        $affected=mysqli_affected_rows($connection);

        if ($affected > 0) {






            if (!unlink($file1))
            {
                echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

                echo "<br>
<div style='color:red;text-align:center;'>فایل پیدا نشد! </div>";

            }
            else
            {
                echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

                echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
            }

 

            mysqli_query($connection, "DELETE FROM invoices WHERE invoice_code=	$order_invoice");
            echo "<span class=\"edit-done-alert\"> با موفقیت کنسل شد</span>";
        }



        else {
            echo "<br>
<div style='color:red;text-align:center;'>در حال چاپ! نمی توانید کنسل کنید.</div>";
        }




    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    if($_GET['action']=='delete' && isset($_GET['photo2'])){


        $id=$_GET['photo2'];
        $sql_orders_num = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_id=$id   and (order_print_permission=0  or order_delivery_permission=1)");


        $sql_od_file=mysqli_fetch_assoc($sql_orders_num);
        $file1=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file1'];
        $file4=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file4'] ;


        if (!unlink($file1))
        {
            echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

            echo "<br>
<div style='color:red;text-align:center;'>فایل در حال چاپ! نمی توانید کنسل کنید.</div>";

        }
        else
        {
            echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

            echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
        }

    }

    if($_GET['action']=='delete' && isset($_GET['id2'])){

        $id=$_GET['id2'];



        $sql_select_invoice = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_id=$id");
        $select_invoice=mysqli_fetch_assoc($sql_select_invoice);
        $order_invoice=	$select_invoice['order_invoice_code'];
        $file1=$_SERVER['DOCUMENT_ROOT'].$select_invoice['order_file1'];




        $sql_order_delete="update orders2 set order_last_status=6 WHERE order_id=$id and order_print_permission=0 ";



        $sql_deleted_row=mysqli_query($connection,$sql_order_delete)  ;



        $affected=mysqli_affected_rows($connection);

        if ($affected > 0) {






            if (!unlink($file1))
            {
                echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

                echo "<br>
<div style='color:red;text-align:center;'>فایل پیدا نشد! </div>";

            }
            else
            {
                echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

                echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
            }

 

            mysqli_query($connection, "DELETE FROM invoices WHERE invoice_code=	$order_invoice");
            echo "<span class=\"edit-done-alert\"> با موفقیت کنسل شد</span>";
        }



        else {
            echo "<br>
<div style='color:red;text-align:center;'>در حال چاپ! نمی توانید کنسل کنید.</div>";
        }




    }
	
	
	
	
	
	
	
	
	
	
	

    if($_GET['action']=='delete' && isset($_GET['photo3'])){


        $id=$_GET['photo3'];
        $sql_orders_num = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id=$id   and (order_print_permission=0  or order_delivery_permission=1)");


        $sql_od_file=mysqli_fetch_assoc($sql_orders_num);
        $file1=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file1'];
        $file4=$_SERVER['DOCUMENT_ROOT'].$sql_od_file['order_file4'] ;


        if (!unlink($file1))
        {
            echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

            echo "<br>
<div style='color:red;text-align:center;'>فایل در حال چاپ! نمی توانید کنسل کنید.</div>";

        }
        else
        {
            echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

            echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
        }

    }

    if($_GET['action']=='delete' && isset($_GET['id3'])){

        $id=$_GET['id3'];



        $sql_select_invoice = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id=$id");
        $select_invoice=mysqli_fetch_assoc($sql_select_invoice);
        $order_invoice=	$select_invoice['order_invoice_code'];
        $file1=$_SERVER['DOCUMENT_ROOT'].$select_invoice['order_file1'];




        $sql_order_delete="update orders3 set order_last_status=6 WHERE order_id=$id and order_print_permission=0 ";



        $sql_deleted_row=mysqli_query($connection,$sql_order_delete)  ;



        $affected=mysqli_affected_rows($connection);

        if ($affected > 0) {






            if (!unlink($file1))
            {
                echo ("Error deleting ".$file1."<br>" );
//    echo ("Error deleting ".$file4 );

                echo "<br>
<div style='color:red;text-align:center;'>فایل پیدا نشد! </div>";

            }
            else
            {
                echo ("Deleted ".$file1."<br>" );
//    echo ("Deleted ".$file4 );

                echo "<span class=\"edit-done-alert\">فایل با موفقیت کنسل شد</span>";
            }

 

            mysqli_query($connection, "DELETE FROM invoices WHERE invoice_code=	$order_invoice");
            echo "<span class=\"edit-done-alert\"> با موفقیت کنسل شد</span>";
        }



        else {
            echo "<br>
<div style='color:red;text-align:center;'>در حال چاپ! نمی توانید کنسل کنید.</div>";
        }




    }





    $sql_orders_count = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_user = '$username_value' ORDER BY order_id DESC");

    $RecordCount = mysqli_num_rows($sql_orders_count);
    $showRecord = 10;
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




    $search_num=$_POST['search_num'];
    if (isset($search_num)){

        $sql_orders_of_user = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_user='$username_value' and order_make_number_perforating LIKE '%$search_num%' ORDER BY order_id DESC");

        $sql_orders_of_user_2 = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_user='$username_value' and order_make_number_perforating LIKE '%$search_num%' ORDER BY order_id DESC");

        $sql_orders_of_user_3 = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_user='$username_value' and order_make_number_perforating LIKE '%$search_num%' ORDER BY order_id DESC");



    }else{


        $sql_orders_of_user = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_user = '$username_value' and order_make_number_perforating='$invoiceID' ORDER BY order_id DESC ");

        $sql_orders_of_user_2 = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_user = '$username_value' and factor='$invoiceID'  ORDER BY order_id DESC ");
		
		$sql_orders_of_user_3 = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user = '$username_value' and factor='$invoiceID'  ORDER BY order_id DESC ");

    }


    $sql_invoice_print= "<a href=\"factor_print.php?invoiceID=$invoiceID\"><span class=\"green-text\">پرینت</span></a>";


    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");
    mysqli_query($connection, "SET character_set_connection = 'utf8'");





    ?>

  






    <br>
    <br>
    <br>

 
    <br>

    <table id="financial-invoices-table">
        <tr>
            <th class="th-darker">ردیف</th>
            <th class="th-darker">شماره فاکتور</th>
            <th class="th-darker">عنوان</th>
            <th class="th-darker">قیمت کل</th>
            <th>تاریخ ثبت</th>
            <th class="th-darker">قول تحویل</th>
            <th>اجازه چاپ</th>
            <th class="th-darker">اجازه تحویل</th>
            <th>آخرین وضعیت</th>
            <th class="th-darker">جزئیات</th>
            <th class="th-darker">تحویل</th>
 


        </tr>
        <tr>
        <tr><?php
            $c = '1';
            while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){

                if( $sql_orders['order_make_number_perforating']!=0){

                    $sql_invoice = $sql_orders['order_make_number_perforating'];}
                else{
                    $sql_invoice=	$sql_orders['order_invoice_code'];

                }

                $sql_order_id = $sql_orders['order_id'];
                $sql_order_type = $sql_orders['order_type'];
                $sql_order_total_price = $sql_orders['order_total_price'];
                $sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
             $sql_order_promise_date = jdate('Y/m/d h:i a',strtotime($sql_orders['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa');
                $sql_order_print_permission = $sql_orders['order_print_permission'];
                $sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
                $sql_order_last_status = $sql_orders['order_last_status'];


                $sql_od_file1 = $sql_orders['order_file4'];
                if(isset($sql_od_file1) && $sql_od_file1 != ''){
                    $sql_od_file1_view = "<img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>";
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
                elseif ($sql_order_last_status == '9') {
                    $sql_order_ls = 'تعلیق کارکاه';
                    $od_ls_9 = 'selected';
                }
                elseif ($sql_order_last_status == '10') {
                    $sql_order_ls = 'ویرایش کارگاه';
                    $od_ls_10 = 'selected';
                }

                else{
                    $sql_order_ls = 'وضعیت تعلیق';
                }


                if($sql_order_last_status==9){
                    $read_m="class='th-darker_s'";

                } 	elseif( $sql_order_last_status==5){
                    $read_m="class='th-darker_p'";

                }
                echo "<tr>";
                echo "<td>$c</td>";
                $c++;
                echo "<td $read_m>$sql_invoice </td>";
                echo "<td $read_m>$sql_order_type</td>";
                echo "<td $read_m>$sql_order_total_price تومان</td>";
                echo "<td $read_m>$sql_order_submit_date</td>";
                echo "<td $read_m>$sql_order_promise_date</td>";
                echo "<td $read_m>$sql_order_pp</td>";
                echo "<td $read_m>$sql_order_dp</td>";
                echo "<td $read_m>$sql_order_ls</td>";
                echo "<td $read_m><a href=\"order-details.php?orderID=$sql_order_id\" target=\"_blank\">جزئیات</a></td>";
				   echo "<td $read_m><a href=\"new-order.php?edit_id=$sql_order_id&factor=$invoiceID\" target=\"_blank\">ویرایش</a></td>";


                echo "<td $read_m><a   onclick=\"return  confirm('آیا مطمئن به کنسل هستید؟')\" href='?action=delete&id=$sql_order_id&invoiceID=$invoiceID'>کنسل</a></td>";



                echo "<td $read_m> <a href=\"order-details.php?orderID=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\" >
					
					$sql_od_file1_view<br>
<a href=\"?action=delete&photo=$sql_order_id&invoiceID=$invoiceID\" style=\"color:#f00\">X</a>
					</a></td>";

                echo "</tr>";

                $read_m="";
            }


            ?>

            <?php
            $c = '1';
            while($sql_orders = mysqli_fetch_array($sql_orders_of_user_2)){


                if( $sql_orders['factor']!=0){

                    $sql_invoice = $sql_orders['factor'];}
                else{
                    $sql_invoice=	$sql_orders['order_invoice_code'];

                }

                $sql_order_id = $sql_orders['order_id'];
                $sql_order_type = $sql_orders['order_type'];
                $sql_order_total_price = $sql_orders['order_total_price'];
               $sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
              $sql_order_promise_date = jdate('Y/m/d h:i a',strtotime($sql_orders['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa');
                $sql_order_print_permission = $sql_orders['order_print_permission'];
                $sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
                $sql_order_last_status = $sql_orders['order_last_status'];
				
				 $sql_od_file1 = $sql_orders['order_file1'];
                if(isset($sql_od_file1) && $sql_od_file1 != ''){
                    $sql_od_file1_view = "<img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>";
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
                    $sql_order_ls = 'وضعیت تعلیق';
                }

                if( $sql_order_last_status==5){
                    $read_m="class='th-darker_p'";

                }

                echo "<tr>";
                echo "<td >$c</td>";
                $c++;
                echo "<td $read_m>$sql_invoice</td>";
                echo "<td $read_m>$sql_order_type</td>";
                echo "<td $read_m>$sql_order_total_price تومان</td>";
                echo "<td $read_m>$sql_order_submit_date</td>";
                echo "<td $read_m>$sql_order_promise_date</td>";
                echo "<td $read_m>$sql_order_pp</td>";
                echo "<td $read_m>$sql_order_dp</td>";
                echo "<td $read_m>$sql_order_ls</td>";
                echo "<td $read_m><a href=\"order-details-graphic.php?orderID=$sql_order_id\" target=\"_blank\">جزئیات</a></td>";
				   echo "<td $read_m><a href=\"new-order-graphic.php?edit_id=$sql_order_id&factor=$invoiceID\" target=\"_blank\">ویرایش</a></td>";
				
				  echo "<td $read_m><a  onclick=\"return  confirm('آیا مطمئن به کنسل هستید؟')\"  href='?action=delete&id2=$sql_order_id&invoiceID=$invoiceID'>کنسل</a></td>";


                echo "<td $read_m> <a href=\"order-details.php?orderID=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\" >
					
					$sql_od_file1_view 
					 </td>";
                echo "</tr>";
            }
            ?>




            <?php
            $c = '1';
            while($sql_orders = mysqli_fetch_array($sql_orders_of_user_3)){


                if( $sql_orders['factor']!=0){

                    $sql_invoice = $sql_orders['factor'];}
                else{
                    $sql_invoice=	$sql_orders['order_invoice_code'];

                }

                $sql_order_id = $sql_orders['order_id'];
                $sql_order_type = $sql_orders['order_type'];
                $sql_order_total_price = $sql_orders['order_total_price'];
              $sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');
               $sql_order_promise_date = jdate('Y/m/d h:i a',strtotime($sql_orders['order_promise_date'].' +210 minutes'),'none','Iran/Tehran','fa');
                $sql_order_print_permission = $sql_orders['order_print_permission'];
                $sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
                $sql_order_last_status = $sql_orders['order_last_status'];
				
 				$sql_od_file1 = $sql_orders['order_file1'];
                if(isset($sql_od_file1) && $sql_od_file1 != ''){
                    $sql_od_file1_view = "<img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>";
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
                    $sql_order_ls = 'وضعیت تعلیق';
                }

                if( $sql_order_last_status==5){
                    $read_m="class='th-darker_p'";

                }

                echo "<tr>";
                echo "<td >$c</td>";
                $c++;
                echo "<td $read_m>$sql_invoice</td>";
                echo "<td $read_m>$sql_order_type</td>";
                echo "<td $read_m>$sql_order_total_price تومان</td>";
                echo "<td $read_m>$sql_order_submit_date</td>";
                echo "<td $read_m>$sql_order_promise_date</td>";
                echo "<td $read_m>$sql_order_pp</td>";
                echo "<td $read_m>$sql_order_dp</td>";
                echo "<td $read_m>$sql_order_ls</td>";
                echo "<td $read_m><a href=\"order-details-accessories.php?orderID=$sql_order_id\" target=\"_blank\">جزئیات</a></td>";
				   echo "<td $read_m><a href=\"new-order-accessories.php?edit_id=$sql_order_id&factor=$invoiceID\" target=\"_blank\">ویرایش</a></td>";
				
				  echo "<td  onclick=\"return  confirm('آیا مطمئن به کنسل هستید؟')\"  $read_m><a href='?action=delete&id3=$sql_order_id&invoiceID=$invoiceID'>کنسل</a></td>";


                echo "<td $read_m> <a href=\"order-details.php?orderID=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\" >
					
					$sql_od_file1_view 
 
				 </td><td> ";
				 if($sql_order_last_status>0){
?><form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?invoiceID=<?= $invoiceID?>">

<?

                if ($sql_order_last_status ==8) { ?>

                    <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                    <input name="accept_last_status" type="text" style="display:none;" value="1"/>
                    <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">


                <?php } else { ?>

                    <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                    <input name="accept_last_status" type="text" style="display:none;" value="8"/>
                    <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php

				}
                

                echo " </form>";
				 }
				echo"</td></tr>";
            }
            ?>

    </table>


    <br/>
    <br/>

    <span class="print-button"><a  target="_blank" href="factor_print.php?invoiceID=<?= $invoiceID?>">چاپ فاکتور</a></span>
    <span class="print-button"> ثبت سفارش جدید:  <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$invoiceID?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$invoiceID?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$invoiceID?>"> طراحی و ... </a>
      </span>




</section>



<?php include ("footer.php");?>
