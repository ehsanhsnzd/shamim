<?php require ("header.php");?>
<?php include ("sidebar.php");

 	$input_paper_name=$_POST['paper_name'];
	$input_paper_size=$_POST['paper_size'];
 	$input_paper_price=$_POST['paper_price'];
	$paper_id=$_POST['select_paper_id'];
	
	if(isset($_GET['select_paper_id'])){	$select_paper_id=$_GET['select_paper_id'];};
	if(isset($_POST['select_paper_id'])){	 $select_paper_id=$_POST['select_paper_id'];};
	
		if(isset($_GET['select_paper_size'])){	$select_paper_size=$_GET['select_paper_size'];};
	if(isset($_POST['paper_size'])){	 $select_paper_size=$_POST['paper_size'];};
	
class dedicate
{
 

    public function dedicate_price()
    {
 

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

 
 
	
	
	
	
	  if (isset($select_paper_id )&& isset($select_paper_size)){
  
   if(! $select_paperid_query=mysqli_query($connection,"select * from paper where name = '$select_paper_id' and size = $select_paper_size ")){ echo mysqli_error($connection);};

 
 $select_price=mysqli_fetch_assoc( $select_paperid_query);
 
 
  }
 
	global $zinc_type;
	global  $tside;
	global $order_type;
 
	
$size=	$_POST['paper_size'];
  $zinc_type=$_POST['zinc_type'];
 $tside=$_POST['tside'];
$paperprice=	 $select_price['price'];


 
 
 $dedicate_sql=mysqli_query($connection,"select * from dedicate_info");
		
$d= mysqli_fetch_array( $dedicate_sql);


	if (isset($tside)){
		
		switch ($size.$zinc_type) {
			
		  case '30454':
                    $zinc = $d['1th4'];
                    $print = $d['1th4p'];
					$next_price1=$d['1th4pn'];
				//	$next_price2=50000;
				$order_zinc='30x45 4color';
                    break;
 
 		  case '50354':
                    $zinc = $d['1th4'];
                    $print = $d['1th4p'];
					$next_price1=$d['1th4pn'];
				//	$next_price2=50000;
          			$order_zinc='50x35 4color';
                    break;
 
 		  case '60454':
                    $zinc = $d['1th4']*2;
                    $print = $d['1th4p']*2;
					$next_price1=$d['1th4pn']*2;
				//	$next_price2=50000;
					$order_zinc='60x45 4color';
                    break;
 
 		  case '50704':
                    $zinc = $d['1th4']*2;
                    $print = $d['1th4p']*2;
					$next_price1=$d['1th4pn']*2;
					//$next_price2=50000;
					$order_zinc='50x70 4color';
                    break;
					
 ///////////////////////
 
		   case '30452':
                    $zinc = $d['1th2'];
                    $print = $d['1th2p'];
					$next_price1=$d['1th2pn'];
				//	$next_price2=40000;
				$order_zinc='30x45 2color';
                    break;
 
 		  case '50352':
                    $zinc = $d['1th2'];
                    $print = $d['1th2p'];
					$next_price1=$d['1th2pn'];
			//		$next_price2=40000;
			          			$order_zinc='50x35 2color';
                    break;
 		  case '60452':
                    $zinc = $d['1th2']*2;
                    $print = $d['1th2p']*2;
					$next_price1=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc='60x45 2color';
                    break;
 
 		  case '50702':
                    $zinc = $d['1th2']*2;
                    $print = $d['1th2p']*2;
					$next_price1=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc='50x70 2color';
                    break;
					
					//////////////////////////////////
					
					
		  case '30451':
                    $zinc = $d['1th1'];
                    $print = $d['1th1p'];
					$next_price1=$d['1th1pn'];
				//	$next_price2=20000;
								$order_zinc='30x45 1color';
                    break;
 
 		  case '50351':
                    $zinc = $d['1th1'];
                    $print = $d['1th1p'];
					$next_price1=$d['1th1pn'];
				//	$next_price2=20000;
				       			$order_zinc='50x35 1color';
                    break;
 		  case '60451':
                    $zinc = $d['1th1']*2;
                    $print = $d['1th1p']*2;
					$next_price1=$d['1th1pn']*2;
				//	$next_price2=40000;
								$order_zinc='60x45 1color';
                    break;
 
 		  case '50701':
                    $zinc = $d['1th1']*2;
                    $print = $d['1th1p']*2;
					$next_price1=$d['1th1pn']*2;
				//	$next_price2=40000;
				$order_zinc='50x70 1color';
                    break;
 
 
}


if($_POST['tside']=='1')
{
	$qty=$_POST['papernum']*2;
 $order_tside='دو رو با یک زینک';
	
	}elseif($_POST['tside']=='2'){
	$qty= $_POST['papernum']*2;
	$zinc=$zinc*2;
	$print=$print*2;
 
	
	 $order_tside='دو رو با دو زینک';
 
	
	}else {$qty= $_POST['papernum']; 
	$order_tside='تک رو';
	}

 $qty_paper=$_POST['papernum']/1000;
$qty_print= ceil($qty/1000);


$papernum=$_POST['papernum'];
$paperprice=(($paperprice*$papernum));

$uv_value=$d['uv'];
$light_value=$d['light'];
$porfrag_value=$d['porfrag'];
$linebreak_value=$d['linebreak'];
$tigh_value=$d['tigh'];
$manganeh_value=$d['manganeh'];
$numbering_value=$d['numbering'];
//$template_value=$_POST['template_value'];
//$sahafi_value=$_POST['sahafi_value'];

if($qty_print>1 ){$next_print=($qty_print-1)*$next_price1;}





if(isset($_POST['uv']) && $size==3045 || isset($_POST['uv']) &&  $size==5035){ $uv=$uv_value*$qty_print;
$additional.=' سلفون یو وی ';
}
if(isset($_POST['uv']) && $size==6045 || isset($_POST['uv']) &&  $size==5070){ $uv=($uv_value*2)*$qty_print;
$additional.='-سلفون یو وی  ';
}

if(isset($_POST['light']) && $size==3045 || isset($_POST['light']) &&  $size==5035){ $light=$light_value*$qty_print;
$additional.='-سلفون براق ';
}
if(isset($_POST['light']) && $size==6045 || isset($_POST['light']) &&  $size==5070){ $light=($light_value*2)*$qty_print;
$additional.='-سلفون براق ';}


if(isset($_POST['porfrag'])){ $porfrag=$porfrag_value*$papernum;$additional.='-پرفراژ ';}
if(isset($_POST['linebreak'])){ $linebreak=$linebreak_value*$papernum;$additional.='-خط تا ';}
if(isset($_POST['numbering'])){ $numbering=$numbering_value*$papernum;$additional.='-شماره زنی ';}
if(isset($_POST['tigh'])){ $tigh=$tigh_value*$qty_print;}
if(isset($_POST['manganeh'])){   $manganeh=$manganeh_value *$papernum ;$additional.='-منگنه ';}
if(isset($_POST['template'])){$template=$template_value;}
if(isset($_POST['sahafi'])){$sahafi=$sahafi_value*$qty_paper;}

 
$order_type=$order_zinc."-".$order_tside."-".$papernum."عدد -".$select_paper_id."-"."($additional)";
 
	return	 $total=$paperprice+$zinc+$print+$next_print+$uv+ $light+$porfrag+$linebreak+$tigh+ $manganeh+$template+$sahafi+$numbering;
	
	 
	
			
			}
			

}
    } 
 
	$dedicate = new dedicate;

if (isset($_POST['submit1'])){
	

$total=	$dedicate->dedicate_price();
 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	?>
	<br>
 

	<section id="user-panel-sheet">
  <div style="border-bottom:2px solid #0C6; padding:10px">
	<a href="new-order-graphic.php" id="rcorners2">عمومی</a>
    
    	<a href="new-order-dedicate.php" id="rcorners1">اختصاصی</a>
	</div><br>

	
	<?
	
	
	
	
	
	if (isset($_POST['submit2']))
	{
		
		?>
		
		
 

	<?php

 

$factor_start=$_POST['factor_start'];
 $factor_num=$_POST['factor_num'];
 $catagory=$_POST['catagory'];
			$service_id = $_POST['service-name-select'];
			$order_quantity_post = $_POST['service-quantity-select'];

			require ('../config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
			mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");

		 


			$order_size = $order_row['size'];
			$order_custom_duration = $order_row['work_time'];
			$order_quantity = $order_row['quantity'.$order_quantity_post];
			$order_price = $order_row['price'.$order_quantity_post];
			$order_custom_width = $_POST['order-custom-width'];
			if (!isset($order_custom_width) || $order_custom_width == '') {
				$order_custom_width = '';
			}			
			$order_custom_height = $_POST['order-custom-height'];
			if (!isset($order_custom_height) || $order_custom_height == '') {
				$order_custom_height = '';
			}
			$order_lot_quantity = $_POST['order-lot-quantity'];
			
			$order_total_price =$dedicate->dedicate_price();
			
						$order_name = $order_type;

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
		
 
			$order_submit_date =  jdate('Y-n-j H:i:s');
			$order_promise_date = jdate('Y-n-j H:i:s', strtotime("+$order_custom_duration days"));



			if ($order_total_price) {
					$user_id_value = $_SESSION['print_username'];
					 
						
					
						
						$sql_invoice = "INSERT INTO invoices (username, cash,cash_off, invoice_create_date, comment)
					VALUES ('$user_id_value', '$order_total_price','$order_total_price', '$order_submit_date', '$order_name')";
				
					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");
					
					if ($connection->query($sql_invoice) == TRUE) {
						$sql_invoice_code = mysqli_query($connection, "SELECT invoice_code,cash_off FROM invoices WHERE username='$user_id_value' AND invoice_create_date='$order_submit_date' AND cash='$order_total_price'");
							$invoice_code_result = mysqli_fetch_array($sql_invoice_code);
					 $invoice_code_value = $invoice_code_result['invoice_code'];
					 $cash_off=  $invoice_code_result['cashoff'];
			
					 $_SESSION['invoice']=$invoice_code_value;
 
							
							
							
							
						
							
								for ($j=1 ; $j < 5 ; $j++) { 
				$allowedExts = array("jpeg", "jpg", "tiff","png");
				$temp = explode(".", $_FILES["order-file-".$j]["name"]);
				$extension = end($temp);
				if (($_FILES["order-file-".$j]["type"] == "image/jpeg")
				|| ($_FILES["order-file-".$j]["type"] == "image/jpg")
				|| ($_FILES["order-file-".$j]["type"] == "image/pjpeg")
				|| ($_FILES["order-file-".$j]["type"] == "image/png")
				|| ($_FILES["order-file-".$j]["type"] == "image/tiff")
				&& ($_FILES["order-file-".$j]["size"] <= 15728640)
				&& in_array($extension, $allowedExts)){
				    if ($_FILES["order-file-".$j]["error"] > 0){
				        echo "Return Code: " . $_FILES["order-file-".$j]["error"] . "<br>";
				    }else{
				    	$file_save_name = "-".$invoice_code_value."_".$_FILES["order-file-".$j]["name"];
					 
	  $increment = '';					
	while(file_exists("../users/images/".$increment.$file_save_name )) {
 
   $increment++;
 	
}	   
							     
				 	 
				            move_uploaded_file($_FILES["order-file-".$j]["tmp_name"],
				            "images/" .$increment . $file_save_name);

				            $file_adress_name =  "file".$j;
				            ${$file_adress_name} = "../users/images/" .$increment . $file_save_name;
			    	}
			    }
			}
						
							   
							     

			if (!isset($file2)) {
				$file2 = '';	
			}
			if (!isset($file3)) {
				$file3 = '';	
			}
			if (!isset($file4)) {
				$file4 = '';	
			}
							
							$sql_order = "INSERT INTO orders2 (
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
							 order_invoice_code) VALUES (
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
							 '$invoice_code_value')";
					
							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");

							if ($connection->query($sql_order) === TRUE) {


									echo "سفارش شما با موفقیت ثبت شد و فاکتور مربوطه صادر گردید. لطفا جهت شروع پروسه انجام سفارش، از بخش فاکتور ها نسبت به پرداخت فاکتور مربوطه اقدام فرمایید. با تشکر";
                                    
                                    
                                    $useremail=mysqli_query($connection, "SELECT email FROM user WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}

                                mail ( $sql_useremail_value, 'سفارش جدید شما ثبت شد' , 'با سلام، کاربر گرامی سفارش جدید شما در وب سایت شمیم ثبت گردید، لطفا جهت شروع پروسه انجام سفارش از قسمت فاکتور ها نسبت به پرداخت فاکتور مربوط به این سفارش اقدام فرمایید. با احترام - کانون تبلیغاتی و چاپخانه شمیم.' , "From: no-reply@shamimgraphic.ir" );
                                
                               mail ( 'shamimtable@gmail.com' , 'سفارش جدید' , 'با سلام، یک سفارش جدید در وب سایت شمیم ثبت گردید. با تشکر' , "From: no-reply@shamimgraphic.ir" );
							   
							   
							   
					


							require_once('../avclass.php');


	
	$total_discount= size_offer($user_id_value,$invoice_code_value,$do,$order);

if($total_discount>0){
	
		
$new_cash_off=max($order_total_price - $total_discount,0);
	
	if(!	mysqli_query($connection, "UPDATE invoices SET cash_off=$new_cash_off WHERE invoice_code = '$invoice_code_value'")){ echo mysqli_error($connection);}
	
	
	}	 
		$order_insert_id= mysqli_insert_id($connection);					
	    $name = 'وب سایت شمیم';
        $email = 'shamimbanner.ir';
        $subject = 'سفارش جدید';
        $message = 'شما یک سفارش جدید از وب سایت شمیم بنر دارید برای مشاهده سفارش خود روی لینک زیر کلیک کنید   

 
 

'.$site_root_adress.'/admin/order-details-graphic.php?orderID='.$order_insert_id
;
							
							  mail ( 'shamimtable@gmail.com' , $subject , "از طرف:".$name."\r\n".$message , "from:".$email );
							  
							  
							  
 $sql_upload_photo = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_user='$user_id_value' AND order_invoice_code='$invoice_code_value'");
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
<br />

                                 <div align="center">						               <div style="background-color:#093; color:#FFF">
  <h3>   قیمت کل : <?= $order_total_price ?> تومان </h3>  </div>
 </div>
 
 
 <? if(!empty($total_discount)){ ?>
       <div align="center">						               <div style="background-color:#C03; color:#FFF">
  <h3>   تخفیف : <?= $total_discount ?> تومان </h3>  </div>
 </div>
<? } ?>

 <?
  $totaler=$order_total_price-$total_discount;
  if( $totaler >0){ ?>
      <div align="center">						               <div style="background-color:#9F3; color:#000">
  <h3>   مبلغ قابل پرداخت: <?= $totaler ?> تومان </h3>  </div>
 </div>

<? }?>

<br />
<br />





<div align="center">




<? 	$balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved");
	$balance= mysqli_fetch_array($balance_user);
	
	
 
		$amount=$totaler;
 
	
if ($balance['balance']>=$amount){
	
 
 ?>
 
     <form name="form2" method="post" preservedata="true" action="financial.php?do=paid&order=orders2&invoiceID=<?=$invoice_code_value?>">
 
 حساب کاربری شما: <?=number_format($balance['balance'])?> تومان + <?=number_format($total_discount)?> تومان تخفیف
 <br />
<br />

        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت از حساب"/><br /><br />
 
      </form>  
 
 <?			
		}else{




?>



    <form name="form1" method="post" preservedata="true" action="payment-graphic.php">
<input type="text" style="display:none" name="invoice" value="<?= $invoice_code_value?>" />
<input type="text" style="display:none" name="amount" value="<?= $total-$total_discount?>" />
<input type="text" style="display:none" name="data" value="<?= $order_name."-".$user_id_value."-".$invoice_code_value."-".$width."X".$height;?>" />



لطفا مبلغ مورد نظر را پرداخت نمایید<br />
<br />
   
  


<table cellpadding="30" style="border:1px solid #999;" width="380"><tr><td align="center">پرداخت از طریق :</td>
<td align="right" valign="bottom">
بانک ملت<br />
<label><img src="images/mellat.jpg" width="85" height="85" />  </label></td>

 
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
		
		
		
		
                                    $useremail=mysqli_query($connection, "SELECT email FROM user WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}

                              //      mail ( $sql_useremail_value, 'سفارش جدید شما ثبت شد' , 'با سلام، کاربر گرامی سفارش جدید شما در وب سایت شمیم ثبت گردید، لطفا جهت شروع پروسه انجام سفارش از قسمت فاکتور ها نسبت به پرداخت فاکتور مربوط به این سفارش اقدام فرمایید. با احترام - کانون تبلیغاتی و چاپخانه شمیم.' , "From: no-reply@shamim14.ir" );
                                
                                //    mail ( 'info@shamim14.ir' , 'سفارش جدید' , 'با سلام، یک سفارش جدید در وب سایت شمیم ثبت گردید. با تشکر' , "From: no-reply@shamim14.ir" );
							}
							else{
								echo "پس از ثبت فاکتور، هنگام ثبت نهایی سفارش مشکلی به وجود آمد. لطفا موضوع را به پشتیبانی سایت اطلاع دهید که فاکتور مربوطه حذف گردد و پس از آن نسبت به ثبت دوباره سفارش اقدام فرمایید و در صورت بروز مجدد مشکل، موضوع را با بخش پشتیبانی در میان بگذارید.";
									echo "Error: " . $sql_order . "<br>" . $connection->error;

							}
					} else {
			    		echo "Error: " . $sql_invoice . "<br>" . $connection->error;
					}

			}

			mysqli_close($connection);

 


	?>




 
		
		
		
		
		
		
		
		
		<?
		
		}
	
	
	else{
	?>
 

 
        <h2 class="user-panel-sheet-h2">سفارش جدید فرم عمومی اختصاصی</h2>
        
        
        
        
        
        
        
        
        
 
                
          <form action="" method="POST"  class="new-order-graphic" enctype="multipart/form-data" >
                
                   <div id="order-form-type-div">
      <? if(! $select_paper_query=mysqli_query($connection,"select * from paper group by name ")){ echo mysqli_error($connection);};?>
<h3>مشخصات کاغذ</h3><br>

<select name="select_paper_id"  id="service-name" onchange="window.location='?select_paper_id='+this.value">
<option value="">انتخاب</option>
<?
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['name'];?>"<? if($select_paper_id== $select_paper_fetch['name']){ echo "selected";};?>><? echo $select_paper_fetch['name'];?></option>
	<?
	
}
 ?>
</select> 
  
  
 سایز : <select name="paper_size"  id="service-name" onchange="window.location='?select_paper_id=<?=$select_paper_id?>&select_paper_size='+this.value">
   <option value=""  >انتخاب</option>
   <option value="3045" <? if($select_paper_size=="3045"){ echo "selected";};?> >30x45 </option>
   <option value="5035" <? if($select_paper_size=="5035"){ echo "selected";};?> >50x35 </option>
   <option value="6045" <? if($select_paper_size=="6045"){ echo "selected";};?> >60x45 </option>
   <option value="5070" <? if($select_paper_size=="5070"){ echo "selected";};?> >50x70 </option>
</select>

  <?
?>
 
<br><br>
 
<h3>مشخصات زینک</h3>
<br>

 
 نوع :

 <select name="zinc_type" id="service-name" onchange=" document.getElementById('submit1').click();" >
   <option>انتخاب کنید </option>
 
   <option value="4" <? if($zinc_type=="4"){ echo "selected";};?> >4 رنگ </option>
   <option value="2" <? if($zinc_type=="2"){ echo "selected";};?> >2 رنگ </option>
   <option value="1" <? if($zinc_type=="1"){ echo "selected";};?> >تک رنگ </option>
  
 </select>
 

 
 نوع چاپ : 
 
 <select name="tside" id="service-name"  onChange="document.getElementById('submit1').click();" >
 

   <option value="0" <? if($tside=="0"){ echo "selected";};?> >تک رو </option>
   <option value="1" <? if($tside=="1"){ echo "selected";};?> >دو رو (یک زینک)</option>
   <option value="2" <? if($tside=="2"){ echo "selected";};?> >دو رو (دو زینک)</option>
  
 </select>
 <br>
 <br>

تعداد کاغذ :  
  
 <input type="text" name="papernum" value="<? if(isset($_POST['papernum']))
{echo $_POST['papernum'];}else{echo '1000';}?>" id="service-name" > 
 <br>
 <br>


<? // number_format($total);?>
 
      
 
<br>
  




<?  
 $dedicate_sql=mysqli_query($connection,"select * from dedicate_info");
		
$d= mysqli_fetch_array( $dedicate_sql); ?>


خدمات دیگر<br>
<br>

<input type="checkbox" name="uv" <? if($_POST['uv']){ echo "checked";};?>  onChange="document.getElementById('submit1').click();"> سلفون یو وی 
 
<br><br>

<input type="checkbox" name="light"  <? if($_POST['light']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> سلفون براق 
 
<br><br>
<input type="checkbox" name="tigh" <? if($_POST['tigh']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
تیغ زنی 
 
 
 <br>
<input type="checkbox" name="porfrag"  <? if($_POST['porfrag']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> 
پر فراژ  
 
<br>
<br>
<input type="checkbox" name="linebreak"  <? if($_POST['linebreak']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
خط تا 
 
<br>
<input type="checkbox" name="manganeh" <? if($_POST['manganeh']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> 
منگنه 
 
<br>
<input type="checkbox" name="numbering" <? if($_POST['numbering']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> 
شماره زنی 
 

<input type="checkbox" name="sahafi" <? if($_POST['numbering']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> 
شماره زنی 
 
<br>
<br>
                          
                          <?   if (preg_match('/shamim/',$user_id_value)){?>
            شماره فاکتور :    <input name="factor_num" value=""  id="factor_num" style="width:50px" alt="" >        <span  style="font-size:9px">اگر قبلا فاکتور شده شماره فاکتور را وارد کنید</span> <br>

<? }?>
                                <br/>
                                <label for="order-file-1">فایل 1:</label><input type="file" name="order-file-1" accept="image/jpg, image/jpeg, image/tiff" ><br/>
                           <label for="order-file-2">فایل 2:</label><input type="file" name="order-file-2" accept="image/jpg, image/jpeg, image/tiff"><br/>
                           
                
                             
                                <label for="order-file-3">فایل 3:</label><input type="file" name="order-file-3" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <label for="order-file-4">فایل 4:</label><input type="file" name="order-file-4" accept="image/jpg, image/jpeg, image/tiff">
                         
                     <br>           
                                
                        <br/><p>در صورت انتخاب کار اضافه، در قسمت توضیحات وارد کنید. مبلغ آن پس از بررسی توسط واحد سفارشات به صورت جداگانه فاکتور خواهد شد.</p>
 <br><br>
            </div>
                      
                        <div id="order-form-description-div">
                        
                   
<br>

                        
                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                <textarea id="order-form-description" name="order-description"></textarea> 
                        </div>

                        <input type="submit"  id="submit1"  name="submit1"  class="profile-edit-submit" style="display:none">
                        
                        <input type="submit"  id="submit2"  name="submit2" value="ثبت و ارسال سفارش"  class="profile-edit-submit">
                </form>

      

<?php } ?>  </section> <? include ("footer.php");?>
