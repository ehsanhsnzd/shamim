<?php require ("header.php");?>
<?php include ("sidebar.php");

?>
   <section id="tile-head2">
	<section id="homepage-top-section2" align="center">
    <br>
<br>
<br>
 
<br>
<br>
<br>
<div class="post">

   <? include_once('menu.tpl');?>  
<br>
 <br>


        <section id="user-panel-sheet" align="right">
       <p id="loaded_n_total">
</p><br>
<progress id="progressBar" value="0" max="100" style="width:300px; display:none  "></progress> 


         <div id="status"> 
         
        <h2 class="user-panel-sheet-h2">سفارش جدید</h2>
        
        <br>
   <? include_once('../menu2.tpl');?>  
        
  
        <form id="upload_form" name="upload_form" enctype="multipart/form-data" method="post">
                        <div id="order-form-type-div">
                                <h3 class="user-panel-sheet-h3">عتبات:</h3>
                                <label for="service-name"> </label>
                    
            <input value="<?= $_GET['service'] ?>" id="service-name" name="service-name-select" style="display:none">
                       
                        
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

                   
                        ?>
                              <br/>
                         
                               <span>1. ابعاد:
                                <?php 
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM type WHERE type='$type'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size_w = $row_2['size_w'];
										 $service_size_h =$row_2['size_h'];
                                       echo $service_size_w.'X'.$service_size_h;
                                }
                                ?>
                          </span><br/>
                       
                                <span>2. مدت زمان(روز کاری):
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services WHERE id='$service'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_work_time = $row_2['work_time'];
                                                echo $service_work_time . 'روز';
                                }
                                ?>
                                </span><br/>
                                <span>3. قیمت متر مربع :
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
                        
             
                        
                        
                       
                      <? 
					  $serv =$_GET['service'];
					  $type =$_GET['type'];
					
					  if(!empty($serv)){
					  ?>
				
<center>    <ul class="enlarge">
 
				<?
					 $selgq= mysqli_query($connection,"select * from gallery where service=$serv and type='$type'  ");
						 while($selg=mysqli_fetch_array($selgq)){
$i++; ?>   


  <li><img  src="../banner/Banner-<? echo $_GET['service'].'-'. $selg['id'].$selg['ext']; ?>" width="200px"  
onclick="changeText(<? echo $selg['id'] ?>,this)"  style="cursor: pointer;  "
/><span><img src="../banner/Banner-<? echo $_GET['service'].'-'. $selg['id'].$selg['ext']; ?>" /> </span>
  
  
  </li> 



 


 




				 
							 
							 
						<?	 
						
						
						
						}
						?></ul> 
                        
                        </center>
                        <br>
<br>

 

 
						       تعداد    <input name="order-lot-quantity" value="1"  id="upload-div-order-lot-quantity" style="width:50px" >
                               <br>
		  <input type="text" name="order-custom-width" id="upload-div-order-width" placeholder="پیشفرض" onChange="handleChange(this);"  style="display:none"  value="<?=$service_size_w?>"  >
	<input type="text" name="order-custom-height" id="upload-div-order-height" placeholder="پیشفرض"  style="display:none" value="<?=$service_size_h?>">
	<input type="file" name="file1" id="file1"  value="file1"  style="display:none" >
						<? }?>
                        <script>
	 function changeText(value,el) {
     document.getElementById('bannerc').value = value;   
 
 
}
</script>	


 <?
					
				if(isset($service)){		  ?>
                        
                        
                        
                        
                        
                        
                        
                        <div id="order-form-addition-div">
                                <h3 class="user-panel-sheet-h3">خدمات اضافه:</h3>
                                <p>
                                  <input type="checkbox" name="order_make_format" id="order_make_format" checked>
                                حلقه
                          (500 تومان)
                              تعداد حلقه :   <input name="halghe" value="4"  id="halghe" style="width:50px" disabled >
                               <br/><input type="checkbox" name="order_make_line" id="order_make_line" <? if($_GET['type']=='stand'){echo 'checked';}?>> 
                                ایستند
                                (15000 تومان)  تعداد :   <input name="stand" value="1"  id="stand" style="width:50px" disabled ><br/>
                                
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat" value="w">
                                      داربست گزاری طول                                (1500 تومان) 
                                <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat2" value="h">                                      
                                  داربست گزاری عرض 
                                (1500 تومان)                                
                          <p><br/>
                           <script>
 
 document.getElementById('order_make_format').onchange = function() {
    document.getElementById('halghe').disabled = !this.checked;
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
           </form></div>
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
	function updateInput(ish){
    _('upload-div-order-height').value = ish;
}

						function handleChange(input) {
							var metr=_('meter').value;
    if (input.value > metr ) input.value =metr;
   
  }
  
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	
	validateFormb();
	var file = _("file1").files[0];
	
	var width = _('upload-div-order-width').value;
	var height = _('upload-div-order-height').value;
	var num = _('upload-div-order-lot-quantity').value;
 	var bannerc= _('bannerc').value;
		var desc = _('order-form-description').value;
	var istand =   $("#order_make_line").prop("checked");
	var halghe =    $("#order_make_format").prop("checked") ;
	var halghe_n = _('halghe').value;
	var beat = $('input[name=order_make_format_beat]:checked').val();
	var service = _('service-name').value;
		var stand_n = _('stand').value;
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
	formdata.append("order_make_line", istand);
	formdata.append("order_make_format_beat", beat);
	formdata.append("service", service);
 		formdata.append("stand", stand_n);
	
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

    <script src="library/assets/viewportchecker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.post').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated bounceInLeft', // Class to add to the elements when they are visible
	    offset: 100    
	   });   
});            
</script>     
 

        </section>
        </section>
        </section>
        

 
