<?php require ("header.php");?>
<?php include ("sidebar.php");?>

        <section id="user-panel-sheet">
        <h2 class="user-panel-sheet-h2">سفارش جدید</h2>
                <form class="new-order" enctype="multipart/form-data" action="new-order-confirm.php" method="post">
                        <div id="order-form-type-div">
                                <h3 class="user-panel-sheet-h3">انتخاب سرویس:</h3>
                                <label for="service-name">1. انتخاب نوع خدمات:</label>
                                <select id="service-name" name="service-name-select" onchange="window.location='new-order.php?service='+this.value+'&quantity=1th&lot=1'" required>
                                <option value="" disabled selected>نتخاب کنید</option>

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

                        $dbresult=mysqli_query($connection, "SELECT * FROM services");

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

                                </select><br/>
                                <span>2. ابعاد:
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size = $row_2['size'];
                                                echo $service_size;
                                }
                                ?>
                                </span><br/>
                                <label for="service-quantity">3. تیراژ:</label>
                                <select id="service-quantity" name="service-quantity-select" onchange="window.location='new-order.php?service=<?php echo $service; ?>&quantity='+this.value+'th&lot=1'" reqired>
                                        
                        <?php 

                        $dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id='$service'");
                        $row_2 = mysqli_fetch_array($dbresult);
                                $quantity1 = $row_2['quantity1'];
                                if ($quantity1 == '0') {
                                        $quantity1 = '';
                                }
                                $quantity2 = $row_2['quantity2'];
                                if ($quantity2 == '0') {
                                        $quantity2 = '';
                                }
                                $quantity3 = $row_2['quantity3'];
                                if ($quantity3 == '0') {
                                        $quantity3 = '';
                                }
                                $quantity4 = $row_2['quantity4'];
                                if ($quantity4 == '0') {
                                        $quantity4 = '';
                                }
                                        if (isset($quantity)) {
                                                if($quantity == '1th'){
                                                     $selected1 = "selected";
                                                }
                                                else{
                                                     $selected1 = "";
                                                }

                                                if($quantity == '2th'){
                                                     $selected2 = "selected";
                                                }
                                                else{
                                                     $selected2 = "";
                                                }

                                                if($quantity == '3th'){
                                                     $selected3 = "selected";
                                                }
                                                else{
                                                     $selected3 = "";
                                                }

                                                if($quantity == '4th'){
                                                     $selected4 = "selected";
                                                }
                                                else{
                                                     $selected4 = "";
                                                }
                                        }
                                                echo "<option value=\"1\" ".$selected1.">$quantity1</option>";
                                        if ($quantity2 != '') {
                                                echo "<option value=\"2\" ".$selected2.">$quantity2</option>";
                                        }
                                        if ($quantity3 != '') {
                                                echo "<option value=\"3\" ".$selected3.">$quantity3</option>";
                                        }
                                        if ($quantity4 != '') {
                                                echo "<option value=\"4\" ".$selected4.">$quantity4</option>";
                                        }
                        ?> 

                                </select><br/>
                                <span>4. مدت زمان(روز کاری):
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_work_time = $row_2['work_time'];
                                                echo $service_work_time . 'روز';
                                }
                                ?>
                                </span><br/>
                                <span>5. قیمت:
                                <?php
                                if(isset($quantity)){
                                        if ($quantity == '1th') {
                                                if($row_2['price1'] !='0'){
                                                        echo $row_2['price1'] . 'تومان';
                                                        $primary_price = $row_2['price1'];
                                                }
                                        }                                        
                                        elseif ($quantity == '2th') {
                                                if($row_2['price2'] !='0'){
                                                        echo $row_2['price2'] . 'تومان';
                                                        $primary_price = $row_2['price2'];
                                                }
                                        }
                                        elseif ($quantity == '3th') {
                                                if($row_2['price3'] !='0'){
                                                        echo $row_2['price3'] . 'تومان';
                                                        $primary_price = $row_2['price3'];
                                                }
                                        }
                                        elseif ($quantity == '4th') {
                                                if($row_2['price4'] !='0'){
                                                        echo $row_2['price4'] . 'تومان';
                                                        $primary_price = $row_2['price4'];
                                                }
                                        }
                                }
                                ?>
                                </span><br/>
                        </div>
                        
                        <? if (!isset($_GET['service'])){ ?>
                        
                        
                        <div id="order-form-upload-div">
                                <h3 class="user-panel-sheet-h3">پارامتر های سفارشی و فایل های چاپ:</h3>
                                <label for="order-file-1">طول سفارشی:</label>
                                <input type="text" name="order-custom-width" id="upload-div-order-width" placeholder="پیشفرض">
                                <label for="order-file-2">عرض سفارشی:</label>
                                <input type="text" name="order-custom-height" id="upload-div-order-height" placeholder="پیشفرض">
                                <label for="order-file-3">تعداد لت:</label>
                                <select name="order-lot-quantity" id="upload-div-order-lot-quantity"  onchange="window.location='new-order.php?service=<?php echo $service; ?>&quantity=<?php echo $quantity; ?>&lot='+this.value+''" required>
                                <?php

                                        if(isset($lot)){
                                                for ($i=1; $i <= 10; $i++) { 
                                                        if($lot == $i){
                                                             ${'selected_lot'.$i} = "selected";
                                                        }
                                                        else{
                                                             ${'selected_lot'.$i} = "";
                                                        }
                                                }
                                        }
                                        echo "<option value=\"1\" ".$selected_lot1.">1</option>";
                                        echo "<option value=\"2\" ".$selected_lot2.">2</option>";
                                        echo "<option value=\"3\" ".$selected_lot3.">3</option>";
                                        echo "<option value=\"4\" ".$selected_lot4.">4</option>";
                                        echo "<option value=\"5\" ".$selected_lot5.">5</option>";
                                        echo "<option value=\"6\" ".$selected_lot6.">6</option>";
                                        echo "<option value=\"7\" ".$selected_lot7.">7</option>";
                                        echo "<option value=\"8\" ".$selected_lot8.">8</option>";
                                        echo "<option value=\"9\" ".$selected_lot9.">9</option>";
                                        echo "<option value=\"10\" ".$selected_lot10.">10</option>";
                                ?>
                                </select>
                                <br/>
                                <label for="order-file-1">فایل 1:</label><input type="file" name="order-file-1" accept="image/jpg, image/jpeg, image/tiff" required/><br/>
                                <label for="order-file-2">فایل 2:</label><input type="file" name="order-file-2" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <label for="order-file-3">فایل 3:</label><input type="file" name="order-file-3" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <label for="order-file-4">فایل 4:</label><input type="file" name="order-file-4" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                <br/><span id="order_form_total_price">قیمت کل:
                                <?php
                                        if (isset($lot)) {
                                                $totalprice = $primary_price * $lot;
                                                echo $totalprice; 
                                        }
                                ?>
                                </span>
                        </div>
                        
                        
                        
                      <? }  else {
					 $serv =$_GET['service'];
					 
							 $selgq= mysqli_query($connection,"select * from gallery where service=$serv");
						 while($selg=mysqli_fetch_array($selgq)){
$i++;
 
?><img src="../banner/Banner-<? echo $_GET['service'].'-'. $selg['id'].$selg['ext']; ?>"  onclick="changeText(<? echo $selg['id'] ?>)"/>
 	<script>
function changeText(value) {
     document.getElementById('bannerc').value = value;   
}
</script>					 
							 
							 
						<?	if($i % 2 == 0){ echo '<br>';} 
						
						
						
						}
						?> <input type="text" id="bannerc"  name="bannerc" value=""/>  <?
						}
						  ?>
                        
                        
                        
                        
                        
                        
                        
                        <div id="order-form-addition-div">
                                <h3 class="user-panel-sheet-h3">خدمات اضافه:</h3>
                                <input type="checkbox" name="order_make_format" id="order_make_format"><label for="order_make_format">قالب سازی</label>
                                <br/><input type="checkbox" name="order_make_line" id="order_make_line"><label for="order_make_line">خط تا</label>
                                <br/><input type="checkbox" name="order_make_format_beat" id="order_make_format_beat"><label for="order_make_format_beat">ضرب قالب</label>
                                <br/><input type="checkbox" name="order_make_header_glue" id="order_make_header_glue"><label for="order_make_header_glue">سرچسب</label>
                                <br/><input type="checkbox" name="order_make_number_perforating" id="order_make_number_perforating"><label for="order_make_number_perforating">شماره و پرفراژ</label>
                                <br/><input type="checkbox" name="order_make_binding" id="order_make_binding"><label for="order_make_binding">صحافی</label>
                                <br/><input type="checkbox" name="order_make_design" id="order_make_design"><label for="order_make_design">طراحی</label>
                                <br/><p>در صورت انتخاب کار اضافه، مبلغ آن پس از بررسی توسط واحد سفارشات به صورت جداگانه فاکتور خواهد شد.</p>
 
                        </div>
                        <div id="order-form-description-div">
                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                <textarea id="order-form-description" name="order-description"></textarea> 
                        </div>

                        <input type="submit" name="submit" value="ثبت و ارسال سفارش">
                </form>

        </section>

<?php include ("footer.php");?>
