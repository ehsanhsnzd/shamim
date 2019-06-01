<?
session_start();
parse_str($_SERVER['QUERY_STRING']);

if (isset($_GET['addorder'])){


	$_SESSION['print_username'] = $_GET['addorder'];
	$_SESSION['people_login'] = $_GET['addorder'];
	$_SESSION['people_id'] = $id;

		$_SESSION['print_user']='ok';
	header("Location: ../users/");

	}

 ?><?php require ("header.php");?>
<?php include ("sidebar.php");?>


	<section id="admin-panel-sheet">

	<h2>ویرایش کاربر</h2>

		<?php


        require ('../config.php');



		$do=$_GET['do'];
		$id_parent=$_GET['id_parent'];




if (isset($do) && $do != '' && isset($id_parent) && $id_parent != '') {

	if ($do == 'delete') {


			$delete_invoice ="DELETE FROM credits_list WHERE id_parent='$id_parent'";

			if (!mysqli_query($connection,$delete_invoice))
			{
			die('Error: ' . mysqli_error());
				echo "مشکلی در روند حذف اعتبار به وجود آمد و فاکتور حذف نگردید.";
			}
			else{
			echo "<span class=\"done-alert\">اعتبار مورد نظر با موفقیت حذف گردید.</span>";
			}}}





                class encrypt {
                    /********* Encode *********/
                    public static function encode($pure_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))), utf8_encode(trim($pure_string)), MCRYPT_MODE_ECB, $iv);
                        return base64_encode($encrypted_string);
                    }

                    /********** Decode ************ */
                    public static function decode($encrypted_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))),base64_decode(trim($encrypted_string)), MCRYPT_MODE_ECB, $iv);
                        return $decrypted_string;
                    }
                }



  $connection = mysql_connect($server_name, $db_username, $db_password);
        if(!$connection){
            die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        }
        mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");




	if(isset($_POST['username']) && $_POST['username'] != '' &&
	isset($_POST['email']) && $_POST['email'] != '' &&
	isset($_POST['password']) && $_POST['password'] != ''){



	$user_username = $_POST['username'];
	$user_email = $_POST['email'];
	$user_password = $_POST['password'];
	$user_display_name = $_POST['display_name'];
	$user_display_lastname = $_POST['display_lastname'];
	$user_mobile = $_POST['mobile'];
		$balance = $_POST['balance'];
	$user_adress = $_POST['adress'];
	if (isset($_POST['is_from_tabriz']) && $_POST['is_from_tabriz'] = '1') {
		$user_isfromtabriz = '1';
	}elseif (!isset($_POST['is_from_tabriz']) || $_POST['is_from_tabriz'] = '' || $_POST['is_from_tabriz'] = '0' ) {
		$user_isfromtabriz = '0';
	}
	if (isset($_POST['accept']) && $_POST['accept'] = '1') {
		$accept = '1';
	}elseif (!isset($_POST['accept']) || $_POST['accept'] = '' || $_POST['accept'] = '0' ) {
		$accept = '0';
	}




	if (!isset($user_username) || $user_username == '' || !isset($user_email) || $user_email == '' || !isset($user_password) || $user_password == ''){
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند را پر نمایید.</span>";
	}
	else{
        if(empty($balance)){$balance=0;}

                $userpass_coded = encrypt::encode($user_password, 'GZvazK@(0D!_hoho12%32');





		$sql = "UPDATE users SET  email = '$user_email' ,  name = '$user_display_name' ,lastname = '$user_display_lastname' , telephone = '$user_mobile' , address = '$user_adress' , is_from_tabriz = '$user_isfromtabriz' , accept = '$accept' WHERE id_parent = $id";

		if (mysql_query($sql) === TRUE) {
			echo "<span class=\"edit-done-alert\">تغییرات مورد نظر با موفقیت اعمال گردید.</span>";

		} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
}




		parse_str($_SERVER['QUERY_STRING']);






        $dbresult=mysql_query( "SELECT * FROM users WHERE id_parent = $id");

		echo "<form id=\"service-add-form\" action=\"edit-user.php?id=$id&do=$do\" method=\"post\">";

				$row = mysql_fetch_array($dbresult);
				$users_table_username= $row['login'];
				$users_table_balance= number_format($row['balance']);
				$users_table_email= $row['email'];
				$users_table_password_coded= $row['password'];
                $users_table_password_decoded = encrypt::decode($users_table_password_coded, 'GZvazK@(0D!_hoho12%32');
				$users_table_displayname= $row['name'];
				$users_table_displaylastname= $row['lastname'];
				$users_table_mobile= $row['telephone'];
				$users_table_adress= $row['address'];
				if ($row['is_from_tabriz'] == '1') {
					$users_table_isfromtabriz= 'checked';
				} else {
					$users_table_isfromtabriz= '';
				}
				if ($row['accept'] == '1') {
					$users_table_accept= 'checked';
				}  else {
					$users_table_accept= '';
				}

				$users_table_user_id= $row['user_id'];


        $connection = mysqli_connect($server_name, $db_username, $db_password);
        if(!$connection){
            die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        }
        mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        mysqli_query($connection, "SET NAMES 'utf8'");
        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
        mysqli_query($connection, "SET character_set_connection = 'utf8'");

if(!	$dbresult3=mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$users_table_username' group by approved")){echo mysqli_error($connection);};

$row2 = mysqli_fetch_array($dbresult3);



$quantity_total=$row2['balance'];

				if(!empty($_POST['balance'])){

					$date_now = date('Y-n-j H:i:s');


if(!	mysqli_query($connection, "insert into credits_list (type,title,data,user,quantity,approved,payment,credits,expiration_date,quantity_total) values ('".$_POST["balance-type"]."','".$_POST["title"]."','".$date_now."','".$user_username."',".(float)$balance.",1,0,0,0,".(float)$quantity_total.")")){ echo mysqli_error($connection);}
                    mysqli_query($connection, "update users set last_date=now() WHERE login = '$users_table_username'");
				}





$users_table_balance= "<span class='green-text'>".number_format($quantity_total)." تومان</span>";

			echo "<label for=\"edit_user_username\">نام کاربری*:</label><input type=\"text\" name=\"username\" id=\"edit_user_username\" placeholder=\"نام کاربری*\" value=\"$users_table_username\" required>";
			echo "<label for=\"edit_user_email\">ایمیل*:</label><input type=\"email\" name=\"email\" id=\"edit_user_email\" placeholder=\"ایمیل*\" value=\"$users_table_email\" required><br/>";
			echo "<label style='display:none' for=\"edit_user_password\">گذرواژه*:</label><input style='display:none' type=\"text\" name=\"password\"id=\" edit_user_password\" placeholder=\"گذرواژه*\" value=\"$users_table_password_decoded\" required>";
			echo "<label for=\"edit_user_displayname\">نام:</label><input type=\"text\" name=\"display_name\" id=\"edit_user_displayname\" placeholder=\"نام\" value=\"$users_table_displayname\"><br/>";
				echo "<label for=\"edit_user_displayname\">نام خانوادگی:</label><input type=\"text\" name=\"display_lastname\" id=\"edit_user_displaylastname\" placeholder=\"نام خانوادگی\" value=\"$users_table_displaylastname\"><br/>";
			echo "<label for=\"edit_user_mobile\">موبایل:</label><input type=\"number\" name=\"mobile\" id=\"edit_user_mobile\" placeholder=\"موبایل\" value=\"$users_table_mobile\">";
        echo "<label for=\"edit_user_balance\" style='text-align:left; width:200px'> حساب  :  $users_table_balance </label><br/>";

        echo "<label for=\"edit_user_balance\"> مبلغ:</label><input type=\"number\" name=\"balance\" id=\"edit_user_balance\" placeholder=\"اضافه کردن مبلغ\" > تومان";

					echo "<label for=\"edit_user_title\"> توضیحات:</label><input type=\"text\" name=\"title\" id=\"edit_user_title\" placeholder=\"توضیحات بابت\" >  ";

                        echo "<select name=\"balance-type\" class=\"order-edit-select\">";
                                echo"<option value=\"1\" >اعتبار </option>
									<option value=\"2\" >چک </option>
									<option value=\"3\">نقد </option>
									<option value=\"6\">کنسل </option>
									<option value=\"0\">واریزی حساب</option>";
                        echo "</select><br/>";


			echo "<label for=\"edit_user_adress\">آدرس:</label><textarea style='height:80px' name=\"adress\" id=\"edit_user_adress\" placeholder=\"آدرس\">$users_table_adress</textarea><br/>";
			echo "<label for=\"edit_user_isfromtabriz\">ساکن تبریز:</label><input type=\"checkbox\" name=\"is_from_tabriz\" id=\"edit_user_isfromtabriz\" $users_table_isfromtabriz><br/>";

			echo "<label for=\"accept\">تایید ورود:</label><input type=\"checkbox\" name=\"accept\" id=\"edit_user_isfromtabriz\" $users_table_accept><br/>";

			echo "<input type=\"submit\" value=\"ثبت ویرایش کاربر\">";

			echo "</form>";
	mysqli_close($connection);
		?>


			<span class="alert-title">نکات مهم (راهنما):</span>
				<p>- فیلد های ستاره دار (*) نمی توانند خالی باشند.
				<br/>- توجه داشته باشید که در صورتی که بدون اطلاع کاربر، شناسه، ایمیل یا رمز عبور وی تغییر داده شود، کاربر به هنگام ورود به حساب خود دچار مشکل می گردد.
 <br>
<br>
<br>
<br>
<br>





<?php


	require ('../db_select.php');

	parse_str($_SERVER['QUERY_STRING']);

   ?>
<?
	$sql_invoices = mysqli_query($connection, "select * from credits_list  where  user='$users_table_username' ");
	$RecordCount = mysqli_num_rows($sql_invoices);
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
	$sql_invoices_of_user = mysqli_query($connection, "select * from credits_list  where  user='$users_table_username' ORDER BY id_parent  DESC LIMIT $start , $end  ");



?>


<a href="add-invoice.php?user=<?=$users_table_username?>" class="addinvoicelink">افزودن فاکتور</a>

<a href="?addorder=<?=$users_table_username?>&id=<?=$id?>" class="addinvoicelink">افزودن سفارش</a>

<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages;

?><br>
<br>
<br>
<br>
<br>
<br>
<br>


<a style="display:inline-block"  class="addinvoicelink" href="financial.php?username=<?=$users_table_username?>"> لیست فاکتورها</a>

<a style="display:inline-block"   href="financial_factor.php?username=<?=$users_table_username?>"  class="addinvoicelink">  فاکتورهای شرکت</a>
		<table id="financial-invoices-table" width="95%">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">کاربر </th>
				<th>شماره</th>
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
					echo "<td class=\"th-darker\">$sql_invoice_code</td>";
					echo "<td><small>$sql_invoice_comment";



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
            echo " $sql_order_type ";



        }
    }



	$order_of_offset=  "SELECT * FROM orders3 where factor=$sql_invoice_id " ;


	if(!empty($sql_invoice_id)){
			$sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
						while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){

						    $sql_order_last_status = $sql_offset['order_last_status'];

				        	$sql_order_type = $sql_offset['order_type'];



					echo " تعداد: $sql_od_lot_quantity ";
					echo " $sql_order_type ";






						}

	}












echo"</small></td>";
					echo "<td class=\"th-darker\">$sql_invoice_cash</td>";
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
					echo "<a href=\"?page=$i&id=$id\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage&id=$id\"><li>صفحه بعد</li></a>";
				}
		  ?></ul>
		</div>


	</section>



<?php include ("footer.php"); ?>
