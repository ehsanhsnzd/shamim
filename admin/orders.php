<?php

 header("Refresh:300");

 require ("header.php");?>
<?php include ("sidebar.php");  ?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست سفارشات</h2><br>
<br>
<form action="orders.php" method="post"  id="service-add-form">
    شماره فاکتور :    <input name="search_num" type="text" id="search_num">


    <select id="service-name" name="catagory"   >
                                <option value=""   selected>انتخاب کنید</option>

                        <?php
	$catagory=$_POST['catagory'];
                        parse_str($_SERVER['QUERY_STRING']);

                        require ('../config.php');
                        $connection = mysqli_connect($server_name, $db_username, $db_password);
                        if(!$connection){
                                die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                        }
                        mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                        mysqli_query($connection, "SET NAMES 'utf8'");
                        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
                        mysqli_query($connection, "SET character_set_connection = 'utf8'");

                        $dbresult=mysqli_query($connection, "SELECT * FROM services");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['name'];
                                $order_id = $row['id'];
                                if($catagory == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                                echo "<option value=\"$order_id\" ".$selected.">$order_name</option>";
                        }
                        ?>

                                </select>




         <div class="maxl">
  <label class="radio inline">
      <input type="radio" name="pay" value="1" <? if($_POST['pay']==1 || empty($_POST['pay'])){echo "checked";}?>>
      <span> پرداخت شده</span>
   </label>
  <label class="radio inline">
      <input type="radio" name="pay" value="0"<? if($_POST['pay']=='0'){echo "checked";}?>>
      <span>پرداخت نشده </span>
  </label>
<input type="submit" value="نمایش"></div>

                          </form>

 <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
 <br>


<?php

	require ('../db_select.php');
$page=$_GET['page'];

	$sql_orders_number = mysqli_query($connection, "SELECT * FROM orders1 ORDER BY order_id DESC");
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
$accept_last_status=$_POST['accept_last_status'];;






 if(!mysqli_query($connection,"update orders1 set order_print_permission =$accept , order_delivery_permission =$accept ,order_last_status = '$accept_last_status'where order_id=$id "))die(mysqli_error($connection));





}



if(isset($_POST['submit_last_status']) && isset($_POST['input_id_last_status'])){

$accept =	$_POST['accept_last_status'];
 $id = $_POST['input_id_last_status'];
 $order_text=$_POST['text_last_status'];


    if(!mysqli_query($connection,"update orders1 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));

    if ($accept == 7) {

    $order_of_tel_sql =  "SELECT tell,name,family FROM factor where  id =  (select order_make_number_perforating  from orders1 where order_id=$id)" ;
		$order_of_tel= mysqli_query($connection, $order_of_tel_sql);
		$sql_order_tel = mysqli_fetch_assoc($order_of_tel);

require_once('../sms/sms.class.php');
$name=$sql_order_tel['name'].' ';
$family=$sql_order_tel['family'].' ';
 $Receptors = array($sql_order_tel['tell']);

	$resp = $gate->SendSMS('جناب '.$name.$family.'
	سفارش شما آماده تحویل می باشد
	'. $order_text.'
	'.$result_main_page_name, $smsnum, $Receptors);

	}


}

if(isset($_POST['submit_last_status_2']) && isset($_POST['input_id_last_status_2'])){


  $accept =	$_POST['accept_last_status_2'];
  $id = $_POST['input_id_last_status_2'];







 if(!mysqli_query($connection,"update orders1 set order_last_status = '$accept' where order_id=$id "))die(mysqli_error($connection));


}




	$sql_orders_of_user_unprint = mysqli_query($connection, "SELECT * FROM orders1 where order_print_permission=0 ORDER BY order_submit_date DESC  ");

	$sql_orders_unprint = mysqli_num_rows($sql_orders_of_user_unprint);

	if ($sql_orders_unprint>0)
	{ echo "<div class=\"ui-state-error\">شما تعداد ".$sql_orders_unprint . " سفارش چاپ نشده دارید. برای مشاهده <a href=\"?unprint=0\">کلیک کنید</a></div>";



		}


	if (!isset($_POST['pay'])){ $pay=1;}else{
	$pay=$_POST['pay'];}

if(isset($_GET['unprint'])){
$order_of_user_query= "SELECT * FROM orders1 where  order_print_permission=0 ORDER BY order_submit_date DESC LIMIT $start , $end";
}


elseif (isset($_POST['search_num']) &&  $_POST['catagory']==0 ){
	$search_num=$_POST['search_num'];


	if($pay==1){
	$pay_query="order_last_status>0";}elseif($pay==0){
		$pay_query="order_last_status<=0";}


		$order_of_user_query =  "SELECT * FROM orders1 where  order_make_number_perforating LIKE '%$search_num%'  and $pay_query ORDER BY order_submit_date DESC  " ;
	}


elseif (isset($_POST['catagory']) && $_POST['catagory']>0 ){
	$catagory=$_POST['catagory'];
		$search_num=$_POST['search_num'];


	if($pay==1){
	$pay_query="order_last_status>0";}elseif($pay==0){
		$pay_query="order_last_status<=0";}

		$order_of_user_query =  "SELECT * FROM orders1 where  service_id =$catagory and order_make_number_perforating LIKE '%$search_num%' and $pay_query ORDER BY order_submit_date DESC LIMIT $start , $end" ;
	}



else{

 if($pay==1){
	$pay_query=" and order_last_status>0  and order_last_status!=6";}elseif($pay==0){
		$pay_query="and order_last_status=6";}

		$order_of_user_query=  "SELECT * FROM orders1 where order_file1!='' $pay_query ORDER BY order_submit_date DESC LIMIT $start , $end" ;
}








		$sql_orders_of_user= mysqli_query($connection, $order_of_user_query);


if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages;

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
				<th class="th-darker">اندازه</th>
				<th>اجازه چاپ</th>
				<th class="th-darker">اجازه تحویل</th>
				<th>آخرین وضعیت</th>
                <th class="th-darker">دانلود</th>
				<th class="th-darker">مشاهده</th>
			  <? if ($_SESSION['print_admin_name']!='delivery'){  ?>		<th class=>ویرایش</th>  <? } ?>

                		<th class=>تحویل</th>
                     <?php  if ($_SESSION['print_admin_name']!='mousavi'){ 		 ?>
                        <th class=>تحویل مشتری</th>
                        <? } ?>
			</tr>
			 <?php
				$c = '0';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){



	if( $sql_orders['order_make_number_perforating']!=0){

		$sql_invoice = $sql_orders['order_make_number_perforating'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];

			}

					$sql_order_id = $sql_orders['order_id'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					$sql_order_submit_date = $sql_orders['order_submit_date'];
					$sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_submit_date'].' +210 minutes'),'none','Iran/Tehran','fa');						 					$sql_od_lot_quantity = $sql_orders['order_lot_quantity'];


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



             $sql_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$sql_order_user'");
             $sql_username_name_result = mysql_fetch_array($sql_username_name);
             $sql_order_user_realname = $sql_username_name_result['name']." ".$sql_username_name_result['lastname'];

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
						$sql_order_ls = 'کارگاه';
						$od_ls_10 = 'selected';
					}
					else{
						$sql_order_ls = 'وضعیت تعلیق';
					}

$read_m=$sql_orders['read_m'];



 if ($_SESSION['print_admin_name']=='mousavi'){

if($read_m!=1){
$read_m="class='th-darker_r'";
if($sql_order_type=='استیکر'){
	$read_m="class='th-darker_s'";

	}elseif($sql_order_type=='فلکس'){
	$read_m="class='th-darker_f'";


	}elseif($sql_order_type=='مش'){
	$read_m="class='th-darker_m'";

	} }	else $read_m='';


	}else{

		if($sql_order_last_status==9){
	$read_m="class='th-darker_s'";

	}

	}

					if ($sql_order_last_status == '0' || $sql_order_last_status == '5') {
					$read_m_status='class=th-darker-unpaid';
					} else{ $read_m_status=$read_m;}
?>
		<form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>">


            <?   $sql_dw_file1=basename($sql_od_file);

					echo "<tr>";


					echo "<td $read_m><a name=\"field$c\">$c</a></td>";

					echo "<td  $read_m name>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_promise_date</td>";
					echo "<td $read_m>$sql_order_pp</td>";
					echo "<td  $read_m>$sql_order_dp</td>";
					echo "<td $read_m_status>$sql_order_ls</td>";
					echo "<td $read_m>";
				//		if(file_exists("../users/images/" . $sql_dw_file1)){
					echo"<a href=\"$sql_od_file\"  >
					<img src=\"library/images/download.png\">
					</a>";
		 	  //			}
					echo "</td>";
					echo "<td $read_m><a 	href=\"order-details.php?orderID=$sql_order_id\"  >

					$sql_od_file1_view
					</a></td>";
					 if ($_SESSION['print_admin_name']!='delivery'){

					echo "<td $read_m><a href=\"order-edit.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td>";

					 }

			 if ($_SESSION['print_admin_name']=='mousavi'){

						echo "<td>";






					    if ($sql_order_last_status == 3) { ?>
                        <input name="input_id" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept" type="text" style="display:none;" value="0"/>
                            <input name="accept_last_status" type="text" style="display:none;" value="10"/>
                         <input  name="submit"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">



                    <?php } else { ?>

                        <input name="input_id" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept" type="text" style="display:none;" value="1"/>
                            <input name="accept_last_status" type="text" style="display:none;" value="3"/>
                         <input name="submit" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php }


			echo "</td>";
			 }else{



		echo "<td>";


					    if ($sql_order_last_status == 7 || $sql_order_last_status == 8) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/>
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">

                            <?  if(isset($_POST['search_num'])){?>
                                <input name="search_num" type="text" style="display:none;"  value="<?=$_POST['search_num']?>">
                                <?
                            }
                            ?>


                    <?php } else { ?>

                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                        <input name="text_last_status" type="text" style="display:none;" value="فاکتور:<?=$sql_invoice?> <?=$sql_order_type?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="7"/>
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">

                            <?  if(isset($_POST['search_num'])){ ?>
                                <input name="search_num" type="text"  style="display:none;"  value="<?=$_POST['search_num']?>">
                            <? } ?>

                    <?php  echo "</td>";


					}



						echo "<td>";


					    if ($sql_order_last_status == 8) { ?>
                        <input name="input_id_last_status_2" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status_2" type="text" style="display:none;" value="1"/>
                         <input  name="submit_last_status_2"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">


                    <?php } else { ?>

                        <input name="input_id_last_status_2" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status_2" type="text" style="display:none;" value="8"/>
                         <input name="submit_last_status_2" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">


                    <?php  echo "</td>";


					}

					}





		$c++;
				echo "</tr></form>";
			}
			?>

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
