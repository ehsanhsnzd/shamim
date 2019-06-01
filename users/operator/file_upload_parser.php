<?php 		session_start();

$_POST['service-name-select'] = isset($_POST['service-name-select']) ? $_POST['service-name-select'] : '';

$_POST['service-quantity-select'] = isset($_POST['service-quantity-select']) ? $_POST['service-quantity-select'] : '';

$halghe_r = isset($halghe_r) ? $halghe_r : '';
$tuduzi_r = isset($tuduzi_r) ? $tuduzi_r : '';
$order_row = isset($order_row) ? $order_row : '';
$file1  = isset($file1 ) ? $file1  : '';
$istand_r  = isset($istand_r ) ? $istand_r  : '';
$order_custom_duration = isset($order_custom_duration) ? $order_custom_duration : '';
$order_name = isset($order_name) ? $order_name : '';
$order_size = isset($order_size) ? $order_size : '';
$order_quantity = isset($order_quantity) ? $order_quantity : ''; 


$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
 
$width=$_POST['order-custom-width'] ;
$height=	$_POST['order-custom-height'];
$invoice_num= $_POST['invoice_num'];

				$allowedExts = array("jpeg", "jpg", "tiff","png","gif","tif");
				$temp = explode(".", $_FILES["file1"]["name"]);
				$extension = end($temp);
				if (($_FILES["file1"]["type"] == "image/jpeg")
				|| ($_FILES["file1"]["type"] == "image/jpg")
				|| ($_FILES["file1"]["type"] == "image/pjpeg")
				|| ($_FILES["file1"]["type"] == "image/tiff")
 
			 
				&& in_array($extension, $allowedExts)){
					
					
					
				    if ($_FILES["file1"]["error"] > 0){
				        echo "Return Code: " . $_FILES["file1"]["error"] . "<br>";
				    }else{
				    	$file_save_name = $_FILES["file1"]["name"];
						 
							    $info = pathinfo($file_save_name);
							    $file_save_name ='Size-' .$width.'X'.$height.'_'.$invoice_num .'.'. $info['extension'];
								  $file_save_noext = 'Size-' . $width.'X'.$height.'_'.$invoice_num ;
								  
								  
								  $increment = ''; //start with no suffix

while(file_exists("../users/images/" . $increment.  $file_save_name)) {
    $increment++;
}
							 
				           if( move_uploaded_file($_FILES["file1"]["tmp_name"],
				            "../users/images/" . $increment.  $file_save_name)){

				            $file_adress_name =  "file1";
			        ${$file_adress_name} = "../users/images/" .$increment. $file_save_name;
							
							

    echo "$fileName آپلود با موفقیت انجام شد. <br>";
} else {
    echo "آپلود ناموفق <br>";
}



			    	}
			    }
				
				
				
			    
		  $info = @getimagesize($file1);
	   $mime = $info['mime'];
		  switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = '.jpg';
					$quality= 100;
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = '.png';
					$quality = 9;
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = '.gif';
					$quality = 100;
                    break;
					
				 
					
					      case 'image/tiff':
                    $image_create_func = '0';
                    $image_save_func = '0';
                    $new_image_ext = '0';
					$quality = 0;
                    break;

            default: 
                   echo 'پسوند ناشناس';
    }
			
				
		    if($image_create_func!=0){
          $save = "../users/images/s_" .$increment.  $file_save_noext.$new_image_ext; //This is the new file you saving

          list($width, $height) = getimagesize($file1);

          $modwidth = 70;
          $diff = $width / $modwidth;
          $modheight = $height / $diff;

          $tn = imagecreatetruecolor($modwidth, $modheight) ;
          $image = $image_create_func($file1) ;
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

          $image_save_func($tn, $save,$quality) ;
			}
								if (($_FILES["file3"]["type"] == "image/jpeg")
				|| ($_FILES["file3"]["type"] == "image/jpg")
				|| ($_FILES["file3"]["type"] == "image/pjpeg")
				|| ($_FILES["file3"]["type"] == "image/tiff")
				
				&& in_array($extension, $allowedExts)){
				    if ($_FILES["file3"]["error"] > 0){
				        echo "Return Code: " . $_FILES["file3"]["error"] . "<br>";
				    }else{
				    	$file_save_name = $_FILES["file3"]["name"];
						 
							    $info = pathinfo($file_save_name);
							    $file_save_name = $info['filename'] . '1' . '.' . $info['extension'];
							 
				           if( move_uploaded_file($_FILES["file3"]["tmp_name"],
				            "../users/images/" . $file_save_name)){

				            $file_adress_name =  "file3";
		         ${$file_adress_name} = "../users/images/" . $file_save_name;
							
							

    echo "$fileName آپلود با موفقیت انجام شد. <br>";
} else {
    echo "آپلود ناموفق <br>";
}



			    	}
			    }
?>
<?php



			$service_id = $_POST['service'];
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
if (!empty($service_id)){
			$dbresult = mysqli_query($connection, "SELECT * FROM services WHERE id = $service_id");
			$order_row = mysqli_fetch_array($dbresult);
			$order_name=$order_row['name'];
}


$servi=$_POST['service'];

									$quantity=$_POST['quan'];
							 $dbresult3=mysqli_query($connection, "SELECT * FROM services WHERE id='$servi'");
                                        $row_3 = mysqli_fetch_array($dbresult3);
									
									 
                                if(isset($quantity)){
                                        if ($quantity == '1th') {
                                                if($row_3['price1'] !='0'){
                                                         $bannerp= $row_3['price1']  ;
                                                        $primary_price = $row_3['price1'];
                                                }
                                        }                                        
                                        elseif ($quantity == '2th') {
                                                if($row_3['price2'] !='0'){
                                                        $bannerp= $row_3['price2']  ;
                                                        $primary_price = $row_3['price2'];
                                                }
                                        }
                                        elseif ($quantity == '3th') {
                                                if($row_3['price3'] !='0'){
                                                        $bannerp=  $row_3['price3']  ;
                                                        $primary_price = $row_3['price3'];
                                                }
                                        }
                                        elseif ($quantity == '4th') {
                                                if($row_3['price4'] !='0'){
                                                     $bannerp =   $row_3['price4']  ;
                                                        $primary_price = $row_3['price4'];
                                                }
                                        }
                                }
                             
									
										
			 
									
                                    
							 	$width=$_POST['order-custom-width']/100 ;
								$height=	$_POST['order-custom-height']/100;
								$num=	$_POST['order-lot-quantity'];
									
							  $halghe =		$_POST['order_make_format'];
					      	  $halghe_n  =  $_POST['halghe'];
									
								 $istand=		$_POST['order_make_line']  ;
									
							 	$tuduzi=		$_POST['order_make_format_beat'] ;
					
									
									
								 $total=(($width*$height)*$num)*$bannerp;
									if ($halghe=='true'){$halghe_r=500* $halghe_n;}
								 	$total+=$halghe_r;
										if ($istand=='true'){$istand_r=15000;}
								 		$total+=$istand_r;
						if($tuduzi=='w'){$tuduzi_r=$width*1500*2;}elseif($tuduzi=='h'){$tuduzi_r=$height*1500*2;}
$total+=$tuduzi_r;
						
						
						
		 
			$order_price = $bannerp;
			$order_custom_width = $_POST['order-custom-width'];
			if (!isset($order_custom_width) || $order_custom_width == '') {
				$order_custom_width = '';
			}			
			$order_custom_height = $_POST['order-custom-height'];
			if (!isset($order_custom_height) || $order_custom_height == '') {
				$order_custom_height = '';
			}
			$order_lot_quantity = $_POST['order-lot-quantity'];
			$order_total_price = $total;

			if (isset($_POST['order_make_format'])) {
				$order_make_format = $_POST['order_make_format'];
			}
			else{
				$order_make_format = '0';
			}
			if (isset($_POST['order_make_line'])) {
				$order_make_line = $_POST['order_make_line'];
			}
			else{
				$order_make_line = '0';
			}
			if (isset($_POST['order_make_format_beat'])) {
				$order_make_format_beat = $_POST['order_make_format_beat'];
			}
			else{
				$order_make_format_beat = '0';
			}
			if (isset($_POST['halghe'])) {
				$order_make_header_glue =$_POST['halghe'];
			}
			else{
				$order_make_header_glue = '0';
			}
			if (isset($_POST['invoice_num'])) {
				$order_make_number_perforating = $_POST['invoice_num'];
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


 
			if (!isset($file2)) {
				$file2 = '';	
			}
			if (!isset($file3)) {
				$file3 = '';	
			}
			if (!isset($file4)) {
				$file4 = '';	
			}

			require('library/jdf.php');
			$order_submit_date =  jdate('Y-n-j H:i:s');
			$order_promise_date = jdate('Y-n-j H:i:s', strtotime("+$order_custom_duration days"));



					$user_id_value = $_SESSION['print_username'];
					$sql_invoice = "INSERT INTO invoices (invoice_code,username, cash, invoice_create_date, comment)
					VALUES ('$invoice_num','$user_id_value', '$order_total_price', '$order_submit_date', '$order_name')";
//$invoice_id = mysqli_insert_id($connection);
					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");
					
					if ($connection->query($sql_invoice) == TRUE) {
							$sql_invoice_code = mysqli_query($connection, "SELECT invoice_code FROM invoices WHERE username='$user_id_value' AND invoice_create_date='$order_submit_date' AND cash='$order_total_price'");
							$invoice_code_result = mysqli_fetch_array($sql_invoice_code);
					 $invoice_code_value = $invoice_code_result['invoice_code'];
			
					 $_SESSION['invoice']=$invoice_code_value;
 
 
 
 	
 $bannerc=$_POST['bannerc'];
 
 if(!empty($bannerc)){	
 
 
 $selgq= mysqli_query($connection,"select * from gallery where id = $bannerc");
 $selg= mysqli_fetch_assoc($selgq);
 $file2="/banner/Banner-".$servi.'-'. $bannerc .$selg['ext'];


 
 }
							$sql_order = "INSERT INTO orders (
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
							  $order_custom_width, 
							  $order_custom_height, 
							 '$order_quantity', 
							 '$order_custom_duration', 
							 '$order_price', 
							 '$order_lot_quantity', 
							 '$order_total_price', 
							 '$file1', 
							 '$file2', 
							 '$file3', 
							 '$save', 
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


 

									?>
                                    
                                    <br />
<br />

                                 <div align="center">						               <div style="background-color:#093; color:#FFF">
                                 
                                 <h3>   قیمت کل : <?= $total ?> تومان </h3>
                                 
                                 
                                  </div>

</div>

<br />
<br />

<div align="center">
    <form name="form1" method="post" preservedata="true" action="payment.php">
<input type="text" style="display:none" name="invoice" value="<?= $invoice_code_value?>" />
<input type="text" style="display:none" name="amount" value="<?= $total.'0'?>" />
<input type="text" style="display:none" name="data" value="<?= $order_name."-".$user_id_value."-".$invoice_code_value."-".$width."X".$height;?>" />




لطفا مبلغ مورد نظر را پرداخت نمایید<br />
<br />


<table cellpadding="30" style="border:1px solid #999;"><tr><td align="center">پرداخت از طریق :</td>
<td align="right" valign="bottom">
بانک ملت<br />
<label>
<input type="radio" name="payment" value="mellat" checked="checked"/>
  <img src="images/4.jpg" width="85" height="85" />  </label>
</td>

  <td align="right" valign="top">کارت به کارت<br />
  <label> <input type="radio" name="payment" value="card" />
 <img src="images/card.gif" width="85" height="85" /></label>
</td>
</tr>
  <tr>
    <td colspan="3" align="center"><br />
    
        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت"/><br />

</td>
 
  </tr>
</table>
      </form>       
           
<?
                                    
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

		
 if(!empty($bannerc)){

 ?> <br />
<br />
بنر انتخابی :<br />

<img src="../banner/Banner-<? echo $servi.'-'. $selg['id'].$selg['ext']; ?>"   />
<br>


		<? }		
 		
 
  
 		
 if(!empty($file1)){

 ?> <br />
<br />
بنر انتخابی :<br />

<img src="../users/images/<?= $increment.$file_save_name; ?>" width="400"   />
<br>


		<? }
		
				
 if(!empty($file3)){

 ?> <br />
<br />
عکس آپلود شده :<br />

<img src="../users/images/<?=  $increment.$file_save_name; ?>" width="400"   />
<br>


		<? }		
?>					
		
 

  </div>
 


<?
mysqli_close($connection);
if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];


		require ('../config.php');
		$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
		mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");


	$query = mysqli_query($connection, "SELECT username FROM user WHERE username = '".$username."'");
	if (!$query){
		echo("Error description: " . mysqli_error($connection));
	}
	$result_exist_username = mysqli_num_rows($query);


	$query = mysqli_query($connection, "SELECT email FROM user WHERE email = '".$email."'");
	if (!$query){
		echo("Error description: " . mysqli_error($connection));
	}
	$result_exist_email = mysqli_num_rows($query);



	if (($result_exist_username != 0) && ($result_exist_email != 0)){
		echo "<span class=\"login-alert\">خطا: نام کاربری یا گذرواژه تکراری است.</span>";
		echo "<span class=\"login-alert\">در صورتی که قبلا ثبت نام کرده اید و رمز عبور خود را فراموش کرده اید به <a href=\"#\">صفحه بازیابی رمز عبور</a>مراجعه کنید.</span>";
	}
	elseif (!isset($username) || $username == ''){
	    echo "<span class=\"login-alert\">فیلد نام کاربری نباید خالی باشد!</span>";
	}
	elseif (!isset($email) || $email == ''){
	    echo "<span class=\"login-alert\">فیلد آدرس ایمیل نباید خالی باشد!</span>";
	}
	elseif (!isset($password) || $password == ''){
	    echo "<span class=\"login-alert\">فیلد کلمه عبور نباید خالی باشد!</span>";
	}
	elseif (!isset($confirm_password) || $confirm_password == '' || $confirm_password !== $password){
	    echo "<span class=\"login-alert\">فیلد تکرار گذرواژه خالی مانده و یا اشتباه است!</span>";
	}
	else{
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

                $pass_coded = encrypt::encode($password, 'GZvazK@(0D!_hoho12%32');

		$sql = "INSERT INTO user (username, email, password)
		VALUES ('$username', '$email', '$pass_coded')";

		if ($connection->query($sql) === TRUE) {
			$_SESSION['print_user'] = 'ok';
		$_SESSION['print_username'] = $username;

                                    
                //                    mail ( $email , "ثبت نام شما در شمیم تکمیل شد" , "با سلام، کاربر گرامی، ثبت نام شما در وب سایت شمیم تکمیل شد. از هم اکنون می توانید با استفاده از نام کاربری و گذرواژه خود وارد حساب کاربری خود شده و سفارشات خود را ارسال فرمایید. با احترام، کانون تبلیغات و چاپخانه شمیم | info@shamim14.ir" , "from:no-reply@shamim14.ir" );                
                                
			header("Location: ../users/index.php");
			die();
		} else {
		    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}

	mysqli_close($connection); 

}








?>





