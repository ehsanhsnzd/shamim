<?php
require ("header.php");
include ("sidebar.php");

 if (preg_match('/shamim/',$user_id_value)){
   parse_str($_SERVER['QUERY_STRING']);
   $edit_id=$_GET['edit_id'];
?>

        <section id="user-panel-sheet">

<div   <?   if (!preg_match('/shamim/',$user_id_value)){?> style="display:none"<? }?> >
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$factor?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$factor?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$factor?>"> طراحی و ... </a>
       <a class="print-button"  target="_blank" href="factor_print.php?invoiceID=<?=$factor?>">چاپ فاکتور</a>
      </div><br>

        <br>

        <h2 class="user-panel-sheet-h2">سفارش  تجهیزات تبلیغاتی</h2>
                 <form class="new-order" enctype="multipart/form-data" action="new-order-accessories-confirm.php" method="post">
                  <div style="display:inline-block; vertical-align:top">        <div id="order-form-type-div">
                                <h3 class="user-panel-sheet-h3">انتخاب سرویس:</h3>
                                <label for="service-name">1. انتخاب نوع خدمات:</label>
                                <select id="service-name" name="service-name-select" onchange="window.location='new-order-accessories.php?service='+this.value+'&quantity=1th&lot=1'+'&factor=<?=$_GET['factor']?>&edit_id=<?=$edit_id?>'" required>
                                <option value="" disabled selected>انتخاب کنید</option>

                        <?php

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


    if(!empty($edit_id)){


	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders3 WHERE order_id = '$edit_id'");


				$sql_od = mysqli_fetch_array($sql_order_details);
$fast_deliver= $sql_od['fast_deliver'];
$sql_od_lot_last= $sql_od['last_lot'];
					$sql_od_id = $sql_od['order_id'];
				 	$sql_od_type = $sql_od['order_type'];
					$service_id = $sql_od['service_id'];
					$sql_od_f_start = $sql_od['factor_start'];
					$sql_od_size = $sql_od['order_size'];
					$quantity_edit = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];
					$lot = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = $sql_od['order_submit_date'];
					$sql_od_promise_date = $sql_od['order_promise_date'];
					$sql_od_user = $sql_od['order_user'];
					$sql_od_description = $sql_od['order_description'];


					  $dbresult=mysqli_query($connection, "SELECT * FROM services3 where name='$sql_od_type'"); $sql_ods=mysqli_fetch_assoc($dbresult);


$service_edit=$sql_ods['id'];



					}

                        $_GET['service'] = isset($_GET['service']) ? $_GET['service'] : $service_edit;
                        $_GET['lot'] = isset($_GET['lot']) ? $_GET['lot'] : $lot;

                        $lot=$_GET['lot'];
                        $service=$_GET['service'] ;

                        $dbresult=mysqli_query($connection, "SELECT * FROM services3");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['name'];
                                $order_id = $row['id'];
                                if($service == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                                echo "<option value=\"$order_id\" ".$selected.">$order_name</option>";
                        }
                        ?>

                                </select>
                                <br/>   <span>نام سفارش : <input name="order_type_name" type="text"  id="service-name" /></span><br/>
                                <span>2. ابعاد:
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services3 WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size = $row_2['size'].'x'.$row_2['size_h'];
                                                echo $service_size;
                                }
                                ?>
                                </span><br/>
                                <span>3. مدت زمان(روز کاری):
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services3 WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_work_time = $row_2['work_time'];
										$photo_id=$row_2['photo_id'];
                                                echo $service_work_time . 'روز';
                                }
                                ?>
                                </span><br/>
                                <span>4. قیمت:
                                <?php

                                                if($row_2['price1'] !='0'){
                                                        echo $row_2['price1'] . 'تومان';
                                                        $primary_price = $row_2['price1'];

												}?>
                                </span><br/>
                                </div> </div>
                                <div style="display:inline-block; text-align:left;width:60%">
                      <?
			    if (isset($photo_id)){
                          $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM service_photo where id=$photo_id ");
  $fast_type_row= mysqli_fetch_assoc($dbresult_fast_type);

					   if (isset($fast_type_row['photo'])){
					    ?>

<br>

                        <img src="../library/images/<?=$fast_type_row['photo']?>" width="400px" >

                        <? }}?>


                        </div>





                  <div id="order-form-upload-div">
                                <h3 class="user-panel-sheet-h3">پارامتر های سفارشی و تعداد:</h3>
                                <label for="order-lot-quantity">تعداد :</label>
                                <input type="text" name="order-lot-quantity" id="upload-div-order-lot-quantity"  value="<?= $lot?>" required/>



                                <br/> <?   if (preg_match('/shamim/',$user_id_value)){?> شماره فاکتور :    <input name="factor_num" value="<?=$_GET['factor']?>"  id="factor_num" style="width:50px" alt="" <? if(!empty($_GET['factor'])){echo "readonly";} ?> >        <span  style="font-size:9px">اگر قبلا فاکتور شده شماره فاکتور را وارد کنید</span> <br>

<? }?>
 <input name="edit_id" value="<?=$edit_id?>"  id="edit_id"  style="display:none">
                                <br>
<br>
 <label for="order-file-1">فایل 1:</label><input type="file" name="order-file-1" accept="image/jpg, image/jpeg, image/tiff"  <? if(!in_array($user_id_value,$site_users)){  ?> required <? }?>/><br/>
                               <label for="order-file-2">فایل 2:</label><input type="file" name="order-file-2" accept="image/jpg, image/jpeg, image/tiff" ><br/>



                                <label for="order-file-3">فایل 3:</label><input type="file" name="order-file-3" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <label for="order-file-4">فایل 4:</label><input type="file" name="order-file-4" accept="image/jpg, image/jpeg, image/tiff">
                                <br><br/>

                                <span id="order_form_total_price">قیمت کل:

                            <input type="number" name="order-price" id="upload-div-order-lot-quantity"    value="<?php
                                         if(!empty($sql_od_total_price)){
											echo $sql_od_total_price;
										 }else{
											if (isset($lot)) {
                                                $totalprice = $primary_price * $lot;
												echo $totalprice;
                                        }
											}
                                ?>" required <? if ($service==41){echo "readonly";}?>>

                                </span>
                        </div>
                        <div id="order-form-description-div">
                          <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                <textarea id="order-form-description" name="order-description"><? $sql_od_description?></textarea>
                        </div>

                        <input type="submit" name="submit" value="ثبت و ارسال سفارش">
                </form>

        </section>

<?php
}

include ("footer.php");?>
