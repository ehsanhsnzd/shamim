<?php require ("header.php");?>
<?php include ("sidebar.php");

$_GET['type'] = isset($_GET['type']) ? $_GET['type'] : '';
?>
   <section id="tile-head2">
	<section id="homepage-top-section2" align="center">
    <br>
<br>
<br>
<br>
<br>
<br>

 <? include_once('menu.tpl');?>   
<br>

<div class="post">
     
 <br>
 


        <section id="user-panel-sheet" align="right">
       <p id="loaded_n_total"><br>

</p>
 
<br>

<progress id="progressBar" value="0" max="100" style="width:300px; display:none  "></progress> 


         <div id="status"> 
         
        <h2 class="user-panel-sheet-h2">سفارش جدید</h2>
        
  
        <form id="upload_form" name="upload_form" enctype="multipart/form-data" method="post">
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

                        $dbresult=mysqli_query($connection, "SELECT * FROM services where hide=0 order by id desc ");

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
                         <?   if ( $_GET['service']!=22 || $_GET['service']!=23 ||$_GET['service']!=24){ ?>
                               <span>2. ابعاد:
                                <?php 
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size_w = $row_2['size'];
										 $service_size_h =$row_2['size_h'];
                                       echo $service_size_w.'X'.$service_size_h;
                                }
                              }   ?>
                                </span><br/>
                       
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
                                <span>5. قیمت متر مربع :
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
                        
                        <?   if ( $_GET['service']==29 || $_GET['service']==30 ||$_GET['service']==31 ||$_GET['service']==32){ ?>
                        
                        
                        <div id="order-form-upload-div" style=" background-color:#CCC">
                                <h3 class="user-panel-sheet-h3">پارامتر های سفارشی و فایل های چاپ:</h3>
                                
                                
                      <div style="display:inline-block;">
                              <br>

                                <label for="order-file-1">عرض سفارشی:</label></div>
                                
                     <div style="display:inline-block;">
                                 <span  style="font-size:9px"> عرض رول</span><br>


<? if( $_GET['service']==32){ ?>
                                <select name="meter" id="meter" style="font-size:14px; " onChange=" updateInput(this.value) ">
                                <option value="100">100 سانت</option>
                                  <option value="120">120 سانت</option>
                                <option value="135">135 سانت</option>
                                <option value="150">150 سانت</option>
                                   <option value="165">165 سانت</option>
                                <option value="200">200 سانت</option>
                                  <option value="220">220 سانت</option>
                                    <option value="250">250 سانت</option>
                                      <option value="265">265 سانت</option>
                                <option value="280">280 سانت</option>
                                   <option value="300">300 سانت</option>
                                <option value="320" selected>320 سانت</option>
 </select>
                                
                                
                           <? }elseif( $_GET['service']==31){ ?>
                           
                            <select name="meter" id="meter" style="font-size:14px; " onChange=" updateInput(this.value) ">
                                <option value="165">165 سانت</option>
                                 <option value="225">225 سانت</option>
                                <option value="320">320 سانت</option>
                               
                               
                                
                                
                                </select>
                           
                                <? }elseif( $_GET['service']==29){ ?>
                                
                                   <select name="meter" id="meter" style="font-size:14px; " onChange=" updateInput(this.value) ">
                                <option value="100">100 سانت</option>
                                <option value="150">150 سانت</option>
                                <option value="200">200 سانت</option>
                               
                               
                                
                                
                                </select>
                                
                                   <? }elseif( $_GET['service']==30){ ?>
                                
                                   <select name="meter" id="meter" style="font-size:14px; " onChange=" updateInput(this.value) ">
                                <option value="150">150 سانت</option>

                               
                               
                                
                                
                                </select>
                                
                                <? }?>
                             <span  style="font-size:9px">بیشتر از متراژ  رول نمی تواند باشد</span>
                   <br><input type="text" name="order-custom-height" id="upload-div-order-height" placeholder="عرض خود را انتخاب کنید"  onChange="handleChange(this);"  value="320"   >
         </div> 
         
           <div style="display:inline-block;"><br>

                                <label for="order-file-2">طول سفارشی : </label> 
                                   <input type="text" name="order-custom-width" id="upload-div-order-width" placeholder="طول خود را انتخاب کنید"     >
                          </div><br>
<span style="font-size:9px">
                            برای عرض بیشتر از رول تماس بگیرید
</span>
                             <p>
                                  <br>
                              تعداد    <input name="order-lot-quantity" value="1"  id="upload-div-order-lot-quantity" style="width:50px" >
                               <br>
                             </p><br>

                             <p>
                               <label for="file1">فایل :</label>
<input type="file" name="file1" id="file1" accept="image/jpg, image/jpeg, image/tiff" required  >
    (فرمت های قابل قبول jpg,png,tif )
                               <br/>
                               
                               <br><br/>
                               <br/>
                        
                        </div>
                      
                        
                        
                      <? }  else { 
					  $serv =$_GET['service'];
					  if(!empty($serv)){
					   echo "  <table width='100%'><tr>";
					
					 
							 $selgq= mysqli_query($connection,"select * from gallery where service=$serv");
						 while($selg=mysqli_fetch_array($selgq)){
$i++; ?><td align="center">
 
<img src="../banner/Banner-<? echo $_GET['service'].'-'. $selg['id'].$selg['ext']; ?>"  onclick="changeText(<? echo $selg['id'] ?>,this)"onmouseover="" style="cursor: pointer;" />
<br>


</td>

				 
							 
							 
						<?	if($i % 2 == 0){ echo '</tr><tr>';} 
						
						
						
						}
						?></tr></table>
						       تعداد    <input name="order-lot-quantity" value="1"  id="upload-div-order-lot-quantity" style="width:50px" >
                               <br>
		  <input type="text" name="order-custom-width" id="upload-div-order-width" placeholder="پیشفرض" onChange="handleChange(this);"  style="display:none"  value="<?=$service_size_w?>"  >
	<input type="text" name="order-custom-height" id="upload-div-order-height" placeholder="پیشفرض"  style="display:none" value="<?=$service_size_h?>">
	<input type="file" name="file1" id="file1"  value="file1"  style="display:none" >
						<? }?>
                        <script>
	 function changeText(value,el) {
     document.getElementById('bannerc').value = value;   
 
    el.style.border = "1px solid blue";
}
</script>	


 <?
						}
				if(isset($service)){		  ?>
                        
                        
                        
                        
                        
                        
                        
                        <div id="order-form-addition-div">
                                <h3 class="user-panel-sheet-h3">خدمات اضافه:</h3>
                                <p>
                                  <input type="checkbox" name="order_make_format" id="order_make_format">
                                حلقه
                          (500 تومان)
                              تعداد حلقه :   <input name="halghe" value="4"  id="halghe" style="width:50px" disabled >
                                <br/><input type="checkbox" name="order_make_line" id="order_make_line" <? if($_GET['type']=='stand'){echo 'checked';}?>> 
                                ایستند
                                (15000 تومان)  تعداد :   <input name="stand" value="1"  id="stand" style="width:50px" disabled ><br/>
                                
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat" value="w">
                                       طول جای داربست                              (1500 تومان) 
                                <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat2" value="h">
عرض  جای داربست (1500 تومان)                                
                          <p><br/>
<script>
 
 document.getElementById('order_make_format').onchange = function() {
    document.getElementById('halghe').disabled = !this.checked;
};
 document.getElementById('order_make_line').onchange = function() {
    document.getElementById('stand').disabled = !this.checked;
};

</script>
                                </p>
                                <p>در صورت انتخاب کار اضافه، مبلغ آن پس از بررسی توسط واحد سفارشات به صورت جداگانه فاکتور خواهد شد.</p>
 
                        </div>
                        
                        <div id="order-form-description-div">
                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                 
                                <textarea id="order-form-description" name="order-description"></textarea> 
                        </div>
 <input type="text" id="bannerc"  name="bannerc" value="" style="display:none"/> 
                        <input type="button" name="submit"  onclick="return uploadFile()" value="ثبت و ارسال سفارش"> <? }?>
                </form></div><br>
<br>
<br>

<script>




/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */

	function validateFormb(e) {
    var x = document.forms["upload_form"]["bannerc"].value;	
    if (x == null || x == "") {
        alert("طرح مورد نظر خود را انتخاب کنید");
e.stopImmediatePropagation();
return false;
       }
}

function validateForm(e) {
    var x = document.forms["upload_form"]["order-custom-width"].value;	
    if (x == null || x == "") {
        alert("طول سفارش را وارد کنید");
e.stopImmediatePropagation();
return false;
       }
	   
	   if( document.getElementById("file1").files.length == 0 ){
        alert("فایل خود را انتخاب کنید");
e.stopImmediatePropagation();
return false;
}
}

	function updateInput(ish){
    _('upload-div-order-height').value = ish;
}

						function handleChange(input) {
	 var metrt=_('meter').value; 
				 
    if (input.value > parseFloat(metrt) ) input.value =metrt;
 
  }
  
  
  				 
  
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	
	validateForm();
 
 
	var file = _("file1").files[0];
	
	var width = _('meter').value;
	var height = _('upload-div-order-height').value;
	var num = _('upload-div-order-lot-quantity').value;
 	var bannerc= _('bannerc').value;
		var desc = _('order-form-description').value;
	var istand =   $("#order_make_line").prop("checked");
	var halghe =    $("#order_make_format").prop("checked") ;
	var halghe_n = _('halghe').value;
	var stand_n = _('stand').value;
	var beat = $('input[name=order_make_format_beat]:checked').val();
	var service = _('service-name').value;
	 
	
	
	// alert(file.name+" | "+file.size+" | "+file.type);
	
	var formdata = new FormData();
 formdata.append("file1", file);
 	formdata.append("order-custom-width", width);
	formdata.append("order-custom-height", height);
	formdata.append("order-lot-quantity", num);
			formdata.append("order-description", desc);
		formdata.append("bannerc", bannerc);
	formdata.append("quan", '<?= $quantity?>');
	formdata.append("order_make_format", halghe);
	formdata.append("halghe", halghe_n);
		formdata.append("stand", stand_n);
	formdata.append("order_make_line", istand);
	formdata.append("order_make_format_beat", beat);
	formdata.append("service", service);
 
 
	
	var ajax = new XMLHttpRequest();
 
if(typeof(file) != "undefined" && file !== null) {
    	ajax.upload.addEventListener("progress", progressHandler, false);
		 document.getElementById('progressBar').style.display = 'block';
}

	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);	
	document.body.scrollTop = document.documentElement.scrollTop = 0;
	 
 
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "آپلود شده "+event.loaded+" بایت از "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% آپلود شده... لطفا صبر کنید.";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
 
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script> 


 


 

        </section>
        </section>
        </section>
        

<script>

</script>
 