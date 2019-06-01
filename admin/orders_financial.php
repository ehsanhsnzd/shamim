<?php

 header("Refresh:300");

 require ("header.php");?>
<?php include ("sidebar.php");  ?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست فاکتورها</h2><br>
 </div>




<?php
parse_str($_SERVER['QUERY_STRING']);
mysqli_query($connection, "UPDATE factor set read_m=1 WHERE id = $invoiceID");


	require ('../db_select.php');
$page=$_GET['page'];

	if (empty($_POST['pay'])){$pay=1;}else{
	$pay=$_POST['pay'];}

	$sql_orders_number = mysqli_query($connection, "SELECT * FROM orders1 where order_make_number_perforating=$invoiceID ORDER BY order_id DESC");
	$RecordCount = mysqli_num_rows($sql_orders_number);
	$showRecord = 20;
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







if(isset($_POST['submit']) && isset($_POST['input_id'])){


 $accept =	$_POST['accept'];
 $id = $_POST['input_id'];







 if(!mysqli_query($connection,"update orders1 set order_print_permission =$accept , order_delivery_permission =$accept where order_id=$id "))die(mysqli_error($connection));




}





if(isset($_POST['submit_last_status']) && isset($_POST['input_id_last_status'])){


  $accept =	$_POST['accept_last_status'];
  $id = $_POST['input_id_last_status'];







 if(!mysqli_query($connection,"update  orders1 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));


 if(!mysqli_query($connection,"update  orders2 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));


 if(!mysqli_query($connection,"update  orders3 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));


}





if(isset($_GET['unprint'])){
$order_of_user_query= "SELECT * FROM orders1 where  order_print_permission=0 ORDER BY order_id DESC LIMIT $start , $end";
}


elseif (isset($_POST['search_num']) &&  $_POST['catagory']==0 ){
	$search_num=$_POST['search_num'];


	if($pay==1){
	$pay_query="order_last_status>0";}elseif($pay==0){
		$pay_query="order_last_status<=0";}


		$order_of_user_query =  "SELECT * FROM orders1 where  order_make_number_perforating LIKE '%$search_num%'  and $pay_query ORDER BY order_id DESC LIMIT $start , $end" ;
	}


elseif (isset($_POST['catagory']) && $_POST['catagory']>0 ){
	$catagory=$_POST['catagory'];
		$search_num=$_POST['search_num'];


	if($pay==1){
	$pay_query="order_last_status>0";}elseif($pay==0){
		$pay_query="order_last_status<=0";}

		$order_of_user_query =  "SELECT * FROM orders1 where  service_id =$catagory and order_make_number_perforating LIKE '%$search_num%' and $pay_query ORDER BY order_id DESC LIMIT $start , $end" ;
	}



else{


		$order_of_user_query=  "SELECT * FROM orders1  where order_make_number_perforating=$invoiceID ORDER BY order_id DESC " ;
}




	$order_of_user_query2=  "SELECT * FROM orders2 where factor=$invoiceID ORDER BY order_id DESC " ;

	$order_of_user_query3=  "SELECT * FROM orders3 where factor=$invoiceID ORDER BY order_id DESC " ;




		$sql_orders_of_user= mysqli_query($connection, $order_of_user_query);
				$sql_orders_of_user2= mysqli_query($connection, $order_of_user_query2);

		$sql_orders_of_user3= mysqli_query($connection, $order_of_user_query3);

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages;


  if(isset($_POST['submit'])){



			$order_submit_date =  jdate('Y-n-j H:i:s');


        	$edited_order_status = $_POST['order-status-edit-select'];
      $edited_order_status2 = $_POST['order-status-edit-select2'];
      $edited_order_status3 = $_POST['order-status-edit-select3'];
      $edited_order_status4 = $_POST['order-status-edit-select4'];
      $order_half = $_POST['half'];
      $order_half2 = $_POST['half2'];
      $order_half3 = $_POST['half3'];
      $order_half4 = $_POST['half4'];
       $order_order_description = $_POST['order-description'];
			$edited_order_discount =$_POST['discount'];

				$sql = "UPDATE factor SET order_discount = '$edited_order_discount' ,
				 order_last_status = '$edited_order_status',
  order_last_status2 = '$edited_order_status2',
   order_last_status3 = '$edited_order_status3',
    order_last_status4 = '$edited_order_status4',
    order_half='$order_half',
	order_half2='$order_half2',
	order_half3='$order_half3',
	order_half4='$order_half4',
     order_description= '$order_order_description',
     is_paid=1

     WHERE id = '$invoiceID'";
				mysqli_query($connection, "SET NAMES 'utf8'");
				mysqli_query($connection, "SET CHARACTER SET 'utf8'");
				mysqli_query($connection, "SET character_set_connection = 'utf8'");
				if ($connection->query($sql) == TRUE) {
					echo "<span class=\"edit-done-alert\">ویرایش سفارش با موفقیت ثبت گردید.</span>";
				} else {
		    echo "<span class=\"admin-panel-alert\">مشکلی در ثبت ویرایش سفارش در پایگاه داده به وجود آمد.</span>";
				}
			}



$sql_order_details = mysqli_query($connection, "SELECT * FROM factor WHERE id = '$invoiceID'");


				$sql_od = mysqli_fetch_array($sql_order_details);


					$sql_od_discount = $sql_od['order_discount'];
					$sql_od_last_status = $sql_od['order_last_status'];
                    $sql_od_last_status2 = $sql_od['order_last_status2'];
                    $sql_od_last_status3 = $sql_od['order_last_status3'];
                    $sql_od_last_status4 = $sql_od['order_last_status4'];
                    $sql_od_half = $sql_od['order_half'];
                    $sql_od_half2 = $sql_od['order_half2'];
                    $sql_od_half3 = $sql_od['order_half3'];
                    $sql_od_half4 = $sql_od['order_half4'];
                    $sql_od_order_description = $sql_od['order_description'];


if ($sql_od_last_status == '1') {

						$od_ls_1 = 'selected';
					}
					elseif ($sql_od_last_status == '2') {

						$od_ls_2 = 'selected';
					}
					elseif ($sql_od_last_status == '3') {

						$od_ls_3 = 'selected';
					}
						elseif ($sql_od_last_status == '4') {

						$od_ls_4 = 'selected';
					}
						elseif ($sql_od_last_status == '5') {

						$od_ls_5 = 'selected';
					}
						else {

						$od_ls_0 = 'selected';
					}



if ($sql_od_last_status2 == '1') {

    $od_ls2_1 = 'selected';
}
elseif ($sql_od_last_status2 == '2') {

    $od_ls2_2 = 'selected';
}
elseif ($sql_od_last_status2 == '3') {

    $od_ls2_3 = 'selected';
}
elseif ($sql_od_last_status2 == '4') {

    $od_ls2_4 = 'selected';
}
elseif ($sql_od_last_status2 == '5') {

    $od_ls2_5 = 'selected';
}
else {

    $od_ls2_0 = 'selected';
}



if ($sql_od_last_status3 == '1') {

    $od_ls3_1 = 'selected';
}
elseif ($sql_od_last_status3 == '2') {

    $od_ls3_2 = 'selected';
}
elseif ($sql_od_last_status3 == '3') {

    $od_ls3_3 = 'selected';
}
elseif ($sql_od_last_status3 == '4') {

    $od_ls3_4 = 'selected';
}
elseif ($sql_od_last_status3 == '5') {

    $od_ls3_5 = 'selected';
}
else {

    $od_ls3_0 = 'selected';
}



if ($sql_od_last_status4 == '1') {

    $od_ls4_1 = 'selected';
}
elseif ($sql_od_last_status4 == '2') {

    $od_ls4_2 = 'selected';
}
elseif ($sql_od_last_status4 == '3') {

    $od_ls4_3 = 'selected';
}
elseif ($sql_od_last_status4 == '4') {

    $od_ls4_4 = 'selected';
}
elseif ($sql_od_last_status4 == '5') {

    $od_ls4_5 = 'selected';
}
else {

    $od_ls4_0 = 'selected';
}



echo "<form id=\"order-edit-form\" action=".$_SERVER['PHP_SELF']."?invoiceID=".$invoiceID." enctype=\"multipart/form-data\" method=\"post\">";
		echo "<table class=\"order-details-last-div\"><tr><td>";
echo "<p>وضعیت پرداخت:</p></td><td>"; echo "<select name=\"order-status-edit-select\" class=\"order-edit-select\">";

										echo "<option value=\"0\" $od_ls_0>نامشخص</option>
									<option value=\"1\" $od_ls_1>پرداخت نقدی </option>
									<option value=\"2\" $od_ls_2>پرداخت Pos</option>
									<option value=\"3\" $od_ls_3>پرداخت چک </option>
									<option value=\"4\" $od_ls_4>واریزی حساب</option>
									<option value=\"5\" $od_ls_5>پرداخت حسابداری</option>";
								echo "</select>
<input type=\"text\" name=\"half\" class=\"order-edit-input\" value=\"$sql_od_half\">

<br>
								 <select name=\"order-status-edit-select2\" class=\"order-edit-select\">";
									echo "<option value=\"0\" $od_ls_0>نامشخص</option>
									<option value=\"1\" $od_ls2_1>پرداخت نقدی </option>
									<option value=\"2\" $od_ls2_2>پرداخت Pos</option>
									<option value=\"3\" $od_ls2_3>پرداخت چک </option>
									<option value=\"4\" $od_ls2_4>واریزی حساب</option>
									<option value=\"5\" $od_ls2_5>پرداخت حسابداری</option>\";

								</select><input type=\"text\" name=\"half2\" class=\"order-edit-input\" value=\"$sql_od_half2\">
<br>

					 <select name=\"order-status-edit-select3\" class=\"order-edit-select\">";
									echo "<option value=\"0\" $od_ls_0>نامشخص</option>
									<option value=\"1\" $od_ls3_1>پرداخت نقدی </option>
									<option value=\"2\" $od_ls3_2>پرداخت Pos</option>
									<option value=\"3\" $od_ls3_3>پرداخت چک </option>
									<option value=\"4\" $od_ls3_4>واریزی حساب</option>
									<option value=\"5\" $od_ls3_5>پرداخت حسابداری</option>

								</select ><input type = \"text\" name=\"half3\" class=\"order-edit-input\" value =\"$sql_od_half3\" >
<br >";

echo "<select name=\"order-status-edit-select4\" class=\"order-edit-select\">";
									echo "<option value=\"0\" $od_ls_0>نامشخص</option>
									<option value=\"1\" $od_ls4_1>پرداخت نقدی </option>
									<option value=\"2\" $od_ls4_2>پرداخت Pos</option>
									<option value=\"3\" $od_ls4_3>پرداخت چک </option>
									<option value=\"4\" $od_ls4_4>واریزی حساب</option>
									<option value=\"5\" $od_ls4_5>پرداخت حسابداری</option>

								</select ><input type = \"text\" name=\"half4\" class=\"order-edit-input\" value =\"$sql_od_half4\" >
<br >";




echo "</td></tr>";

											echo "<tr><td><p> 	کسر مازاد 	: </p></td><td><input type=\"text\" name=\"discount\" class=\"order-edit-input\" value=\"$sql_od_discount\"></td><td>";

													echo "<input type=\"submit\" class=\"order-edit-submit\" value=\"ثبت ویرایش\" name=\"submit\"></td>";


								echo  "<tr><td><p>  توضیحات:  <textarea rows='4' style='width: 300px' id=\"order-form-description\" name=\"order-description\">$sql_od_order_description</textarea> </td>";

echo "</form>";
$sql_invoice_print= "<a href=\"factor_print.php?invoiceID=$invoiceID\"><span class=\"green-text\">پرینت</span>";
?>
			<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
				<th>نام کاربری</th>
				<th class="th-darker">نام و نام خانوادگی کاربر</th>
				<th>عنوان</th>
				<th class="th-darker">تعداد</th>
				<th>تاریخ ثبت</th>
			 <th  class="th-darker">مبلغ</th>
				<th>اجازه چاپ</th>
				<th  class="th-darker">اجازه تحویل</th>
				<th>آخرین وضعیت</th>
                <th  class="th-darker"><?=$sql_invoice_print?></th>


			</tr>
			<tr><?php
				$c = '0';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){



	if( $sql_orders['order_make_number_perforating']!=0){

		$sql_invoice = $sql_orders['order_make_number_perforating'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];

			}

					$sql_order_id = $sql_orders['order_id'];
					$invoiceID = $sql_orders['order_make_number_perforating'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = jdate('Y/m/d h:i a',strtotime( $sql_orders['order_submit_date'] .' +210 minutes'),'none','Iran/Tehran','fa');
					 						 					$sql_od_lot_quantity = $sql_orders['order_lot_quantity'];


						$sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];

					$permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_user = $sql_orders['order_user'];
					if($sql_order_last_status!=6){
					$total+=$sql_order_total_price;
					}
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

	$sql_od_file1 = $sql_orders['order_file4'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){



						$sql_od_file1_view = " <img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>  ";
					}
					else{
						$sql_od_file1_view = '';
					}


					$sql_od_file = $sql_orders['order_file1'];

		 if(isset($sql_od_file) && $sql_od_file != ''){
						$sql_od_file_view = " <img src=\"".$site_root_adress.$sql_od_file1."\" width='70'>  ";
					}
					else{
						$sql_od_file_view = '';
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

					elseif ($sql_order_last_status== '9') {
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

$read_m=$sql_orders['read_m'];



					if ($sql_order_last_status == '0') {
					$read_m_status='class=th-darker-unpaid';
					} else{ $read_m_status=$read_m;}
?>
				<form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>&invoiceID=<?=$invoiceID?>#field<?= $c-1 ?>"><tr>
                <? $sql_dw_file1=basename($sql_od_file);
					echo "<td $read_m><a name=\"field$c\">$c</a></td>";

					echo "<td  $read_m name>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_total_price</td>";
					echo "<td $read_m>$sql_order_pp</td>";
					echo "<td  $read_m>$sql_order_dp</td>";
					echo "<td $read_m_status>$sql_order_ls</td>";
					echo "<td $read_m><a href=\"order-edit.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td>";



						echo "<td>";


					    if ($sql_order_last_status >= 1 && $sql_od_last_status>0) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="0"/>
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">


                    <?php } else if($sql_od_last_status>0) { ?>

                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/>
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php  echo "</td>";


					}





		$c++;
				echo " </tr></form>";
			}
			?>














































            	<tr><?php
				$c = '1';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user2)){



	if( $sql_orders['factor']!=0){

		$sql_invoice = $sql_orders['factor'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];

			}

					$sql_order_id = $sql_orders['order_id'];
					$invoiceID = $sql_orders['factor'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = jdate('Y/m/d h:i a',strtotime( $sql_orders['order_submit_date'] .' +210 minutes'),'none','Iran/Tehran','fa');
					 					 					$sql_od_lot_quantity = $sql_orders['order_lot_quantity'];

						$sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];

					$permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_user = $sql_orders['order_user'];
				if($sql_order_last_status!=6){
                    $total+=$sql_order_total_price;
					}
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
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\" width='70'>";
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

 if ($sql_order_last_status == '0') {
					$read_m_status='class=th-darker-unpaid';
					} else{ $read_m_status=$read_m;}

?>
				<form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>&invoiceID=<?=$invoiceID?>#field<?= $c-1 ?>"><tr>
                <?
					echo "<td $read_m><a name=\"field$c\">$c</a></td>";

					echo "<td  $read_m name>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_total_price</td>";
					echo "<td $read_m>$sql_order_pp</td>";
					echo "<td  $read_m>$sql_order_dp</td>";
					echo "<td  $read_m_status>$sql_order_ls</td>";
				 	echo "<td $read_m><a href=\"order-edit-graphic.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td> ";




						echo "<td>";


					    if ($sql_order_last_status >= 1 && $sql_od_last_status>0) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="0"/>
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">


                    <?php } else if($sql_od_last_status>0) { ?>

                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/>
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php  echo "</td>";


					}





		$c++;
				echo " </tr></form>";
			}












































				while($sql_orders = mysqli_fetch_array($sql_orders_of_user3)){



	if( $sql_orders['factor']!=0){

		$sql_invoice = $sql_orders['factor'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];

			}

					$sql_order_id = $sql_orders['order_id'];
					$invoiceID = $sql_orders['factor'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = jdate('Y/m/d h-i a',strtotime( $sql_orders['order_submit_date'] .' +210 minutes'),'none','Iran/Tehran','fa'); ;
				 				 					$sql_od_lot_quantity = $sql_orders['order_lot_quantity'];

						$sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];

					$permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_user = $sql_orders['order_user'];
						if($sql_order_last_status!=6){
                $total+=$sql_order_total_price;
					}
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
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\" width='70'>";
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

	  if ($sql_order_last_status == '0') {
					$read_m_status='class=th-darker-unpaid';
					} else{ $read_m_status=$read_m;}
?>
				<form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>&invoiceID=<?=$invoiceID?>#field<?= $c-1 ?>"><tr>
                <?
					echo "<td $read_m><a name=\"field$c\">$c</a></td>";

					echo "<td  $read_m name>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_total_price</td>";
					echo "<td $read_m>$sql_order_pp</td>";
					echo "<td  $read_m>$sql_order_dp</td>";
					echo "<td $read_m_status>$sql_order_ls</td>";
				 echo "<td $read_m><a href=\"order-edit-accessories.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td> ";



						echo "<td>";


					    if ($sql_order_last_status >= 1 && $sql_od_last_status>0) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="0"/>
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">


                    <?php } else if($sql_od_last_status>0){ ?>

                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/>
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php  echo "</td>";


					}





		$c++;
				echo " </tr></form>";
			}
			?>

     <tr><td colspan="15">
   جمع کل :<?=number_format($total) ?> تومان

                </td></tr>





























            </table>



		<div id="paging">
			<ul><?php


			if(isset($_GET['unprint'])){$unprint_link= "&unprint=".$_GET['unprint'];}


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
					echo "<a href=\"?page=$backpage$unprint_link\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i$unprint_link\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage$unprint_link\"><li>صفحه بعد</li></a>";
				}
		  ?></ul>
		</div>


	</section>

<?php include ("footer.php"); ?>
