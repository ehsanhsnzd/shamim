<?php require ("header.php");?>

	<section id="user-panel-sheet">



	<?php

if (isset($_POST['submit'])){

	$edit_id=$_POST['edit_id'];
 $factor_num=$_POST['factor_num'];
 $catagory=$_POST['catagory'];
 $service_id = $_POST['service-name-select'];
 $order_quantity_post = 1;

	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_id = '$edit_id'");
	$sql_od = mysqli_fetch_array($sql_order_details);
	if(	$sql_od['sql_od_last_status'] >0){$edit_price=$sql_od_total_price;}



			require ('../config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
			mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");

			$dbresult = mysqli_query($connection, "SELECT * FROM services3 WHERE id = $service_id");
			$order_row = mysqli_fetch_array($dbresult);

			$order_name = $order_row['name'].' - '.$_POST['order_type_name'];;
			$order_size = $order_row['size'];
			$order_custom_duration = $order_row['work_time'];
			$order_quantity = $order_row['quantity'.$order_quantity_post];
			$order_price = $order_row['price'.$order_quantity_post];
			if($order_price==0){$order_price=$_POST['order-price'];}

			$order_custom_width = $_POST['order-custom-width'];
			if (!isset($order_custom_width) || $order_custom_width == '') {
				$order_custom_width = '';
			}
			$order_custom_height = $_POST['order-custom-height'];
			if (!isset($order_custom_height) || $order_custom_height == '') {
				$order_custom_height = '';
			}
			$order_lot_quantity = $_POST['order-lot-quantity'];

			if((int) $order_lot_quantity != $order_lot_quantity) {echo "مشکل در تعداد سفارش.... دوباره امتحان کنید."; die();}

			$order_total_price = $order_price * $order_lot_quantity;

			if (isset($_POST['order_make_format'])) {
				$order_make_format = '1';
			}
			else{
				$order_make_format = '0';
			}
			if (isset($_POST['order_make_line'])) {
				$order_make_line = '1';
			}
			else{
				$order_make_line = '0';
			}
			if (isset($_POST['order_make_format_beat'])) {
				$order_make_format_beat = '1';
			}
			else{
				$order_make_format_beat = '0';
			}
			if (isset($_POST['order_make_header_glue'])) {
				$order_make_header_glue = '1';
			}
			else{
				$order_make_header_glue = '0';
			}
			if (isset($_POST['order_make_number_perforating'])) {
				$order_make_number_perforating = '1';
			}
			else{
				$order_make_number_perforating = '0';
			}
			if (isset($_POST['order_make_binding'])) {
				$order_make_binding = '1';
			}
			else{
				$order_make_binding = '0';
			}
			if (isset($_POST['order_make_design'])) {
				$order_make_design = '1';
			}
			else{
				$order_make_design = '0';
			}
			if (isset($_POST['order-description'])) {
				$order_description = $_POST['order-description'];
			}
			else{
				$order_description = '';
			}




		//


			$order_submit_date =  date('Y-m-d H:i:s');
			$order_promise_date = date('Y-m-d H:i:s', strtotime("+$order_custom_duration days"));



					$user_id_value = $_SESSION['print_username'];


								$true_upload =array();
										for ($j=1 ; $j < 5 ; $j++) {
					$allowedCompressedTypes = array("application/x-rar-compressed", "application/zip", "application/x-zip",  "application/x-zip-compressed",'application/x-rar', 'application/rar',"image/jpeg","image/jpg","image/png","image/tiff");


				$temp = explode(".", $_FILES["order-file-".$j]["name"]);
				$extension = end($temp);
				if ( in_array($_FILES["order-file-".$j]["type"], $allowedCompressedTypes)
			){
				    if ($_FILES["order-file-".$j]["error"] > 0){
				        echo "Return Code: " . $_FILES["order-file-".$j]["error"] . "<br>";
				    }else{
				    	$file_save_name = "-".$factor_num."_".$_FILES["order-file-".$j]["name"];

	  $increment = '';
	while(file_exists("../users/images/".$increment.$file_save_name )) {

   $increment++;

}


				            move_uploaded_file($_FILES["order-file-".$j]["tmp_name"],
				            "images/" .$increment . $file_save_name);

				            $file_adress_name =  "file".$j;
				            ${$file_adress_name} = "/users/images/" .$increment . $file_save_name;

								if(!empty($edit_id)){
							mysqli_query($connection,"UPDATE orders3 set
							 order_file".$j."='".${$file_adress_name}."'
							 where order_id=$edit_id");
							}
			  	$true_upload[]=1;
			    	}
			    }
			}
    if( in_array($user_id_value,$site_users)){$true_upload[] = 1; }
	if ( in_array(1 , $true_upload))
		 {

			if (!isset($file2)) {
				$file2 = '';
			}
			if (!isset($file3)) {
				$file3 = '';
			}
			if (!isset($file4)) {
				$file4 = '';
			}

								if(empty($edit_id)){
					   $connection_sql = mysql_connect($server_name, $db_username, $db_password);

             mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



             $sql_username_name = mysql_query( "SELECT name,lastname,telephone FROM users WHERE login='$user_id_value'");
             $sql_username_name_result = mysql_fetch_array($sql_username_name);
            $invoice_name=$sql_username_name_result['name'];
			$invoice_lastname=$sql_username_name_result['lastname'];
			$invoice_tell=$sql_username_name_result['telephone'];



			if (!in_array($user_id_value,$site_users)) {
				$sql_invoice = "INSERT INTO factor ( operator, cash, date_create,date_show, comment,name,family,tell)
					VALUES ( '$user_id_value', '$order_total_price', '$order_submit_date','$order_submit_date', '$order_name','$invoice_name','$invoice_lastname','$invoice_tell')";
					}
					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");


                        if($factor_num==""){$factor_num=$invoice_code_value;}else{
						$invoice_code_value=$factor_num;
						}

					if ($connection->query($sql_invoice) == TRUE) {
				// $sql_invoice_code = mysqli_query($connection, "SELECT invoice_code,cash_off FROM invoices WHERE username='$user_id_value' AND invoice_create_date='$order_submit_date' AND cash='$order_total_price'");
				// $invoice_code_result = mysqli_fetch_array($sql_invoice_code);
				// $invoice_code_value = $invoice_code_result['invoice_code'];
				// $cash_off=  $invoice_code_result['cashoff'];
					$invoice_code_value=mysqli_insert_id($connection);
					 $_SESSION['invoice']=$invoice_code_value;


							} else {
			    		echo "Error: " . $sql_invoice . "<br>" . $connection->error;
					}




							$sql_order = "INSERT INTO orders3 (
							 order_user,
							 order_type,
							 order_size,
							 order_width,
							 order_height,
							 order_quantity,
							 order_duration,
							 order_unit_price,
							 order_lot_quantity,
							 order_total_price,
							 order_file1,
							 order_file2,
							 order_file3,
							 order_file4,
							 order_make_format,
							 order_make_line,
							 order_make_format_beat,
							 order_make_header_glue,
							 order_make_number_perforating,
							 order_make_binding,
							 order_make_design,
							 order_submit_date,
							 order_promise_date,
							 order_description,
							 order_invoice_code,factor) VALUES (
							 '$user_id_value',
							 '$order_name',
							 '$order_size',
							 '$order_custom_width',
							 '$order_custom_height',
							 '$order_quantity',
							 '$order_custom_duration',
							 '$order_price',
							 '$order_lot_quantity',
							 '$order_total_price',
							 '$file1',
							 '$file2',
							 '$file3',
							 '$file4',
							 '$order_make_format',
							 '$order_make_line',
							 '$order_make_format_beat',
							 '$order_make_header_glue',
							 '$order_make_number_perforating',
							 '$order_make_binding',
							 '$order_make_design',
							 '$order_submit_date',
							 '$order_promise_date',
							 '$order_description',
							 '$invoice_code_value','$factor_num')";
								}else{

									$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id = '$edit_id'");
$sql_od = mysqli_fetch_array($sql_order_details);
if(	$sql_od['order_last_status'] >0){$edit_price=$sql_od['order_total_price'];}

									$sql_order = "UPDATE orders3 set

							 order_type= '$order_name',


							 order_quantity= '$order_quantity',
							 order_duration='$order_custom_duration',
							 order_unit_price= '$order_price',
							 order_lot_quantity='$order_lot_quantity',
							 order_total_price='$order_total_price'  ,
							 order_last_status=0

							 where order_id=$edit_id";


							 	 if(!mysqli_query($connection,"update factor set date_show = '$order_submit_date' ,read_m=0,edit_price='$edit_price' where id=$factor_num "))die(mysqli_error($connection));
									}
							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");

							if ($connection->query($sql_order) === TRUE) {


									echo "سفارش شما با موفقیت ثبت شد و فاکتور مربوطه صادر گردید. لطفا جهت شروع پروسه انجام سفارش، از بخش فاکتور ها نسبت به پرداخت فاکتور مربوطه اقدام فرمایید. با تشکر";


                                    $useremail=mysqli_query($connection, "SELECT email FROM users WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}





				//			require_once('../avclass.php');



//	$total_discount= size_offer($user_id_value,$invoice_code_value,$do,$order);

//if($total_discount>0){


//$new_cash_off=max($order_total_price - $total_discount,0);

//	if(!	mysqli_query($connection, "UPDATE invoices SET cash_off=$new_cash_off WHERE invoice_code = '$invoice_code_value'")){ echo mysqli_error($connection);}


//	}
		$order_insert_id= mysqli_insert_id($connection);
	    $name = 'وب سایت شمیم';
        $email = 'shamimbanner.ir';
        $subject = 'سفارش جدید';
        $message = 'شما یک سفارش جدید از وب سایت شمیم بنر دارید برای مشاهده سفارش خود روی لینک زیر کلیک کنید




'.$site_root_adress.'/admin/order-details-graphic.php?orderID='.$order_insert_id
;




 $sql_upload_photo = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_user='$user_id_value' AND order_invoice_code='$invoice_code_value'");
							$upload_photo_result = mysqli_fetch_array($sql_upload_photo);

			$file1=		$upload_photo_result['order_file1'];
			$file2=		$upload_photo_result['order_file2'];
			$file3=		$upload_photo_result['order_file3'];
			$file4=		$upload_photo_result['order_file4'];
?>

<br>
<br><center>
      <? if(!empty($file1)){?>
<img src="<?=$file1?>" alt="فایل 1"/>
         <? }?>

               <? if(!empty($file2)){?>
<img src="<?=$file2?>" alt="فایل 2"/>
         <? }?>

               <? if(!empty($file3)){?>
<img src="<?=$file3?>" alt="فایل 3"/>
         <? }?>

               <? if(!empty($file4)){?>
<img src="<?=$file4?>" alt="فایل 4"/>
         <? }?>

       </center>

<br />


  <br>اضافه کردن سفارش
<br>
<br>

   <div >
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$factor_num?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$factor_num?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$factor_num?>"> طراحی و ... </a>
       <a class="print-button"  target="_blank" href="factor_print.php?invoiceID=<?=$factor_num?>">چاپ فاکتور</a>
      </div>


<br />

                                 <div align="center">						               <div style="background-color:#093; color:#FFF">
  <h3>   قیمت کل : <?= $order_total_price ?> تومان </h3>  </div>
 </div>


<br />
<br />





<div align="center">




<? 	$balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved");
	$balance= mysqli_fetch_array($balance_user);



		$amount=$order_total_price;


if ($balance['balance']>=$order_total_price){


 ?>

     <form name="form2" method="post" preservedata="true" action="financial.php?do=paid&order=orders3&invoiceID=<?=$invoice_code_value?>">

 حساب کاربری شما: <?=number_format($balance['balance'])?> تومان <br />
<br />

        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت از حساب"/><br /><br />

      </form>

 <?
		}else{




?>



    <form name="form1" method="post" preservedata="true" action="http://shamimbanner.ir/users/payment.php">
<input type="text" style="display:none" name="invoice" value="<?= $invoice_code_value?>" />
<input type="text" style="display:none" name="data" value="<?= $order_name."-".$user_id_value."-".$invoice_code_value."-".$width."X".$height;?>" />



لطفا مبلغ مورد نظر را پرداخت نمایید<br />
<br />




<table cellpadding="30" style="border:1px solid #999;" width="380"><tr><td align="center">پرداخت از طریق :</td>
<td align="right" valign="bottom">
بانک ملت<br />
<label><img src="library/images/mellat.jpg" width="85" height="85" />  </label></td>


</tr>
  <tr>
    <td colspan="3" align="center"><br />

        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت"/><br /><br />


</td>

  </tr>
</table>
      </form>

<?
		}




                                    $useremail=mysqli_query($connection, "SELECT email FROM users WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}

                              //      mail ( $sql_useremail_value, 'سفارش جدید شما ثبت شد' , 'با سلام، کاربر گرامی سفارش جدید شما در وب سایت شمیم ثبت گردید، لطفا جهت شروع پروسه انجام سفارش از قسمت فاکتور ها نسبت به پرداخت فاکتور مربوط به این سفارش اقدام فرمایید. با احترام - کانون تبلیغاتی و چاپخانه شمیم.' , "From: no-reply@shamim14.ir" );

                                //    mail ( 'info@shamim14.ir' , 'سفارش جدید' , 'با سلام، یک سفارش جدید در وب سایت شمیم ثبت گردید. با تشکر' , "From: no-reply@shamim14.ir" );
							}
							else{
								echo "پس از ثبت فاکتور، هنگام ثبت نهایی سفارش مشکلی به وجود آمد. لطفا موضوع را به پشتیبانی سایت اطلاع دهید که فاکتور مربوطه حذف گردد و پس از آن نسبت به ثبت دوباره سفارش اقدام فرمایید و در صورت بروز مجدد مشکل، موضوع را با بخش پشتیبانی در میان بگذارید.";
									echo "Error: " . $sql_order . "<br>" . $connection->error;
                                mysqli_query($connection, "delete from factor where id =$invoice_code_value");
							}


			}else{    echo "آپلود ناموفق <br><br> ";}

			mysqli_close($connection);


			}


	?>




	</section>

<?php include ("footer.php");?>
