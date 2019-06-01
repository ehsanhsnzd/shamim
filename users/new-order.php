<?php require ("header.php");?>
<?php include ("sidebar.php");

  parse_str($_SERVER['QUERY_STRING']);

$_GET['type'] = isset($_GET['type']) ? $_GET['type'] : '';
$_GET['edit_id'] = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';

$edit_id=$_GET['edit_id'];
$factor=$_GET['factor'];
$height=100;
$sql_od_lot_quantity=1;
$quantity='1th';


if(!empty($edit_id)){

	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders1 WHERE order_id = '$edit_id'");


				$sql_od = mysqli_fetch_array($sql_order_details);

					$sql_od_id = $sql_od['order_id'];
					$sql_od_type = $sql_od['order_type'];
					$sql_od_size = $sql_od['order_size'];
					$sql_od_quantity = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];	
					$sql_od_lot_quantity = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = $sql_od['order_submit_date'];
					$sql_od_promise_date = $sql_od['order_promise_date'];
					$sql_od_user = $sql_od['order_user'];
					$service = $sql_od['service_id'];
					
					

					$sql_od_width = $sql_od['order_width'];
					if ($sql_od_width == '') {
						$sql_od_width = '-';
					}
					$width=$sql_od_width;
					$sql_od_height = $sql_od['order_height'];
					if ($sql_od_height == '') {
						$sql_od_height = '-';
					}
					$height=$sql_od_height;

					$sql_od_duration = $sql_od['order_duration'];
				
				
						if( $sql_od['order_make_number_perforating']!=0){
					
		$sql_od_invoice_code = $sql_od['order_make_number_perforating'];}
		else{
		$sql_od_invoice_code=	$sql_od['order_invoice_code'];
			
			}
		$factor=	$sql_od_invoice_code	;
				
					$sql_od_bijak_code = $sql_od['order_bijak_code'];
					$sql_od_print_permission = $sql_od['order_print_permission'];
					$sql_od_delivery_permission = $sql_od['order_delivery_permission'];
					$sql_od_last_status = $sql_od['order_last_status'];
					$sql_od_description = $sql_od['order_description'];
					
					 
					if (!isset($sql_od_description) || $sql_od_description == '') {
						$sql_od_description = '-';
					}
					$sql_od_file1 = $sql_od['order_file1'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\">";
					}
					else{
						$sql_od_file1_view = '';
					}
					
					
					 $sql_dw_file1=basename($sql_od_file1);
	
					
					
					
					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
		 		$sql_od_file4_view = "
 <div style=\"background-image:url('..$sql_od_file4');\" class=\"imgback\" >
 
  <a href=\"download.php?download_file=$sql_dw_file1\" class=\"downloadbutton\" ></a>
  
  </div> ";
					}
					else{
						$sql_od_file4_view = '';
					}
			 

					$sql_od_make_format = $sql_od['order_make_format'];
					if ($sql_od_make_format == 'true') {
						$sql_od_make_format = 'حلقه';
					}
					else{
						$sql_od_make_format = '';
					}


    $sql_od_make_cut = $sql_od['order_make_cut'];
    if ($sql_od_make_cut == 'true') {
        $sql_od_make_cut = 'حلقه';
    }
    else{
        $sql_od_make_cut = '';
    }

					$sql_od_make_line = $sql_od['order_make_line'];
					if ($sql_od_make_line == 'true') {
						$sql_od_make_line = '- ایستند';
					}
					else{
						$sql_od_make_line = '';
					}

					$sql_od_make_format_beat = $sql_od['order_make_format_beat'];
					if ($sql_od_make_format_beat == 'w') {
						$sql_od_make_format_beat = '- جای داربست (طول)';
						$sql_od_make_format_beat_value = 'w';
					}
						elseif ($sql_od_make_format_beat == 'h'){
						$sql_od_make_format_beat = '- جای داربست (عرض)';
						$sql_od_make_format_beat_value = 'h';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];
                    $sql_od_make_banner_cut = $sql_od['order_make_banner_cut'];


}




?>
   <section id="tile-head2">
	<section id="homepage-top-section2" align="center">
 
 

 <? // include_once('../menu.tpl');?>   
 

<div class="post">
     
 <br>
 


        <section id="user-panel-sheet" align="right">
       <p id="loaded_n_total"> 
</p>
 
 <div   <?   if (!preg_match('/shamim/',$user_id_value)){?> style="display:none"<? }?>>
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$factor?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$factor?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$factor?>"> طراحی و ... </a>
       <a class="print-button" target="_blank" href="factor_print.php?invoiceID=<?=$factor?>">چاپ فاکتور</a>
      </div>
<br>

<progress id="progressBar" value="0" max="100" style="width:300px; display:none  "></progress> 


         <div id="status"> 
         
        <h2 class="user-panel-sheet-h2">سفارش</h2>
        
        
        
  
        <form id="upload_form" name="upload_form" enctype="multipart/form-data" method="post">
                        <div id="order-form-type-div">
                                <h3 class="user-panel-sheet-h3">انتخاب سرویس:</h3>
                                <label for="service-name">1. انتخاب نوع خدمات:</label>
                                <select id="service-name" name="service-name-select" onchange="window.location='new-order.php?service='+this.value+'&quantity=1th&lot=1&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" required>
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
                        
                        
                        
                        
                        <div id="order-form-upload-div" style=" background-color:#CCC">
                                <h3 class="user-panel-sheet-h3">پارامتر های سفارشی و فایل های چاپ:</h3>
                                
                                
                      <div style="display:inline-block;">
                              <br>

                                <label for="order-file-1">عرض سفارشی:</label></div>
                                
                     <div style="display:inline-block;">
                                 <span  style="font-size:9px"> عرض رول</span><br>

                         <select name="meter"  style="font-size:14px; " onChange=" updateInput(this.value)"  id="meter">
<? $dbresult=mysqli_query($connection, "SELECT * FROM meters WHERE service='$service'");
while($row_meter = mysqli_fetch_array($dbresult)){
if(!empty($row_meter['meter'])){ ?>
                             <option value="<?=$row_meter['meter']?>"><?=$row_meter['meter']?> سانت </option>

<? }  } ?>


                         </select>
                                

                             <span  style="font-size:9px">بیشتر از متراژ  رول نمی تواند باشد</span>
                   <br><input type="number" name="order-custom-height" id="upload-div-order-height" placeholder="عرض خود را انتخاب کنید"  onChange="handleChange(this);"  value="<?=$height?>"   >
         </div> 
         
           <div style="display:inline-block;"><br>

                                <label for="order-file-2">طول سفارشی : </label> 
                                   <input type="number" name="order-custom-width" id="upload-div-order-width" placeholder="طول خود را انتخاب کنید"  value="<?=$width?>"   >
                          </div><br>
<span style="font-size:9px">
                            برای عرض بیشتر از رول تماس بگیرید
</span>
                             <p>
                                  <br>
                              تعداد    <input type="number" name="order-lot-quantity" value="<?=$sql_od_lot_quantity ?>"  id="upload-div-order-lot-quantity" style="width:50px" >
                                <div             <?   if (!in_array($user_id_value,$site_users)){?> style="display:none"<? }?>>
  
                    
                                         شماره فاکتور :    <input name="invoice_num" value="<?=$factor?>"  id="invoice_num" style="width:50px" alt="" <? if(!empty($factor)){echo "readonly";} ?>>        <span  style="font-size:9px">اگر قبلا فاکتور شده شماره فاکتور را وارد کنید</span> <br>
                              
          </div>
                             </p><br>
                          
                             <p>
                               <label for="file1">فایل :</label>
<input onchange="checkext(this.value,'file1')" type="file" name="file1" id="file1" accept="image/jpg, image/jpeg, image/tiff"  <?   if (in_array($user_id_value,$site_users)){?> required  style="display:none"<? }?>>
(فرمت های قابل قبول jpg,png,tif,zip,rar )

                               <br/>
                               
                               <br><br/>
                               <br/>
                        
                        
                        <div id="show-price" style="display:inline-block"></div>
                        </div>
                      
                        
                        
                    
			<?	if(isset($service)){	
			
			$dedicate_sql=mysqli_query($connection,"select * from dedicate_info");		
$d= mysqli_fetch_array( $dedicate_sql);	
				  ?>
                        
                        
                        
                        
                        
                        
                        
                        <div id="order-form-addition-div">
                                <h3 class="user-panel-sheet-h3">خدمات اضافه:</h3>
                             				
                               <p>
                                  <input type="checkbox" name="order_make_format" id="order_make_format" <? if (!empty($sql_od_make_format)){echo "checked";}?>>
                                حلقه
                          (<?=$d['halghe']?> تومان)
                              تعداد حلقه :   <input name="halghe" value="<? if (!empty($sql_od_make_format)){ echo $sql_od_make_header_glue ;}?>"  id="halghe" style="width:50px" <? if (empty($sql_od_make_format)){echo "disabled";}?> ></p>
                                <p><input type="checkbox" name="order_make_line" id="order_make_line" <? if (!empty($sql_od_make_line)){echo "checked";}?> > 
                                ایستند
                                (<?=$d['stand']?> تومان)     <input name="stand" value="1"  id="stand" style="width:50px; display:none" disabled ></p>
                               <p>
                            <input type="checkbox" name="order_make_cut" id="order_make_cut" <? if (!empty($sql_od_make_cut)){echo "checked";}?>>
                           برش
                            (<?=$d['banner_cut']?> تومان)
                            تعداد برش :   <input name="banner_cut" value="<? if (!empty($sql_od_make_cut)){ echo $sql_od_make_banner_cut ;}?>"  id="banner_cut" style="width:50px" <? if (empty($sql_od_make_cut)){echo "disabled";}?> > <span id="cut_result"></span></p>
                            <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat" value="w" <?  if ($sql_od_make_format_beat_value=='w'){echo "checked"; } ?>>
                                       طول جای داربست                              (<?=$d['darbast']?> تومان) 
                              </p>  <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat2" value="h" <?  if ($sql_od_make_format_beat_value=='h'){echo "checked"; } ?>>
عرض  جای داربست (<?=$d['darbast']?> تومان)                                
                          </p>
                          
                          <p>
                                      <input type="radio" name="order_make_format_beat" id="order_make_format_beat3" <?  if ($sql_od_make_format_beat=='undefined'){echo "checked"; } ?> value="undefined" >
بدون  جای داربست                                
                          </p>

 



                               <input type="checkbox" name="image_resize" id="image_resize" checked>
                               نمایش تصویر در لیست
                               <br/><br>

<script>
    function checkext(data,idelement) {

        var ext = data.match(/\.([^\.]+)$/)[1];
        switch(ext)
        {
            case 'jpg':
            case 'png':
            case 'pdf':
            case 'tif':
            case 'rar':
            case 'zip':
                break;
            default:
                alert('فقط فرمت JPG(عکس) قابل قبول است');
                _(idelement).value='';
        }
    }
 
 document.getElementById('order_make_format').onchange = function() {
    document.getElementById('halghe').disabled = !this.checked;
};
 document.getElementById('order_make_line').onchange = function() {
    document.getElementById('stand').disabled = !this.checked;
};
 document.getElementById('order_make_cut').onchange = function() {
     document.getElementById('banner_cut').disabled = !this.checked;
 };

</script>
                                </p>
                                <p>در صورت انتخاب کار اضافه، مبلغ آن پس از بررسی توسط واحد سفارشات به صورت جداگانه فاکتور خواهد شد.</p>
 
                        </div>
                        
                        <div id="order-form-description-div">
                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                 
                                <textarea id="order-form-description" name="order-description" ><?=$sql_od_description?></textarea> 
                        </div>
 <input type="text" id="bannerc"  name="bannerc" value="" style="display:none"/> 
  <input type="text" id="edit_id"  name="edit_id" value="<?=$edit_id?>" style="display:none"/> 
                        <input type="button" name="submit"  onclick="return uploadFile()" class="profile-edit-submit" value="ثبت و ارسال سفارش"> <? }?>
                </form></div><br>
<br>
<br>
<? 
$dedicate_sql=mysqli_query($connection,"select * from  info");		
$o= mysqli_fetch_array( $dedicate_sql);
$percent_2=$o['percent_2'];

if($discount>0 ){$discount_fee=$discount/100;}
else{$discount_fee=$percent_2/100;}
$halghe=$d['halghe'];
$halghe_d=$d['halghe']*$discount_fee;
$halghe_d=$d['halghe']-$halghe_d;

$banner_cut=$d['banner_cut'];
$banner_cut_d=$d['banner_cut']*$discount_fee;
$banner_cut_d=$d['banner_cut']-$banner_cut_d;

$darbast=$d['darbast'];
$darbast_d=$d['darbast']*$discount_fee;
$darbast_d=$d['darbast']-$darbast_d;
$stand=$d['stand'];
$stand_d=$d['stand']*$discount_fee;
$stand_d=$d['stand']-$stand_d;


$primary_price_d=$primary_price*$discount_fee;
$primary_price_d=$primary_price-$primary_price_d;


?>
<script>

$(document).ready(function(){
	
 
	var checkdata=0;
	var checkdata_cut=0;
    var checkdata_cut_d=0;
    var checkdata_s=0;
	var checkdata_dh=0;
	var checkdata_dw=0;
    var checkdata_d=0;
    var checkdata_s_d=0;
    var checkdata_dh_d=0;
    var checkdata_dw_d=0;

	var qty= $("#upload-div-order-lot-quantity").val() ;
 
	
	
	
	  $("#order_make_format_beat").click(function(){  
	
	
	     if (document.getElementById('order_make_format_beat').checked) {
           checkdata_dw=((($("#upload-div-order-width").val() / 100)*2 )*<?=$darbast?>);
             checkdata_dw_d=((($("#upload-div-order-width").val() / 100)*2 )*<?=$darbast_d?>);
		    checkdata_dh=0;
             checkdata_dh_d=0;




        } else {checkdata_dw=0;checkdata_dw_d=0;}

          $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


      });
		
		
		  $("#order_make_format_beat2").click(function(){  
	
	
	     if (document.getElementById('order_make_format_beat2').checked) {
             checkdata_dh=((($("#upload-div-order-height").val() / 100)*2 )*<?=$darbast?>);
             checkdata_dh_d=((($("#upload-div-order-height").val() / 100)*2 )*<?=$darbast_d?>);
             checkdata_dw=0;
             checkdata_dw_d=0;

        } else {checkdata_dh=0;checkdata_dh_d=0;}

              $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


          });
		
		
		  $("#order_make_format_beat3").click(function(){  
	
	
	     if (document.getElementById('order_make_format_beat2').checked) {
           checkdata_dh=0;
		    checkdata_dw=0;

             checkdata_dh_d=0;
             checkdata_dw_d=0;

        } else {checkdata_dh=0;checkdata_dh_d=0;}
              $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");

          });
		
		
	
	
	  $("#order_make_line").click(function(){  
	
	
	     if (document.getElementById('order_make_line').checked) {
           checkdata_s=($("#stand").val()*<?=$stand?>);
             checkdata_s_d=($("#stand").val()*<?=$stand_d?>);

        } else {checkdata_s=0;checkdata_s_d=0;}
          $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


      });
		
		
		
		
	  $("#order_make_format").click(function(){  
	
	
	     if (document.getElementById('order_make_format').checked) {
           checkdata=($("#halghe").val()*<?=$halghe?>);
             checkdata_d=($("#halghe").val()*<?=$halghe_d?>);

        } else {checkdata=0;checkdata_d=0;}
          $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


      });


    $("#order_make_cut").click(function(){


        if (document.getElementById('order_make_cut').checked) {
            checkdata_cut=($("#banner_cut").val()*<?=$banner_cut?>);
            checkdata_cut_d=($("#banner_cut").val()*<?=$banner_cut_d?>);

        } else {checkdata_cut=0;checkdata_cut_d=0;}
        $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


    });



    $("#banner_cut").change(function(){
	cut_result=parseInt($("#banner_cut").val())  +1;
	
        if (document.getElementById('order_make_cut').checked) {
            checkdata_cut=($("#banner_cut").val()*<?=$banner_cut?>);
            checkdata_cut_d=($("#banner_cut").val()*<?=$banner_cut_d?>);

        } else {checkdata_cut=0;checkdata_cut_d=0;}
		
		 $("#cut_result").html(" حاصل کار: "+ cut_result+ " عدد" );
        $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");

    });
		
		
		
	  $("#stand").change(function(){  
	
	
	     if (document.getElementById('order_make_line').checked) {
           checkdata_s=($("#stand").val()*<?=$darbast?>);
             checkdata_s_d=($("#stand").val()*<?=$darbast_d?>);

        } else {checkdata_s=0;checkdata_s_d=0;}
          $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


      });
		
		
	
	
	 $("#halghe").change(function(){  

	     if (document.getElementById('order_make_format').checked) {
           checkdata=($("#halghe").val()*<?=$halghe?>);
             checkdata_d=($("#halghe").val()*<?=$halghe_d?>);

        } else {checkdata=0;checkdata_d=0;}
         $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");

     });
	
		
		
    $("#upload-div-order-width").change(function(){  
	
	data_width= $("#upload-div-order-width").val() ;
	data_height= $("#meter").val() ;
	
		if(data_width*data_height<10000){data_width=100;data_height=100}


        data= (data_width*data_height/10000)*<?=$primary_price?>;
        data_d= (data_width*data_height/10000)*<?=$primary_price_d?>;


        $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");



    });
		
		    $("#upload-div-order-height").change(function(){  
	data_width=  $("#upload-div-order-width").val() ;
	data_height=  $("#meter").val() ;
	
	
		if(data_width*data_height<10000){data_width=100;data_height=100}
	 
	data= (data_width*data_height/10000)*<?=$primary_price?>;
                data_d= (data_width*data_height/10000)*<?=$primary_price_d?>;
                $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


            });
		
		    $("#meter").change(function(){  
	data_width=  $("#upload-div-order-width").val() ;
	data_height=  $("#upload-div-order-height").val() ;
	
	
	if(data_width*data_height<10000){data_width=100;data_height=100}
	 
	
	data= (data_width*data_height/10000)*<?=$primary_price?>;
                data_d= (data_width*data_height/10000)*<?=$primary_price_d?>;

                $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


            });
		
		
		
 
 
     $("#upload-div-order-lot-quantity").change(function(){  
	
	qty=  $("#upload-div-order-lot-quantity").val() ;

         $("#show-price").html("قیمت : "+ (data + checkdata_cut+checkdata + checkdata_s+checkdata_dh+checkdata_dw)*qty + " تومان" + " <br />" +  "  قیمت بعد از تخفیف :"+ (data_d + checkdata_cut_d + checkdata_d + checkdata_s_d+checkdata_dh_d+checkdata_dw_d)*qty + " تومان");


     });
 
		
    });


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
	    <? if( !preg_match('/shamim/',$user_id_value)){   ?>
	   if( document.getElementById("file1").files.length == 0 ){
        alert("فایل خود را انتخاب کنید");
e.stopImmediatePropagation();
return false;
}
<? }?>
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
 
		var invoice_num = _('invoice_num').value;
	var rollmeter = _('meter').value;
	var width = _('upload-div-order-width').value;
	var height = _('upload-div-order-height').value;
	var num = _('upload-div-order-lot-quantity').value;
 	var bannerc= _('bannerc').value;
	var edit_id= _('edit_id').value;
	var desc = _('order-form-description').value;
	var istand =   $("#order_make_line").prop("checked");
	var halghe =    $("#order_make_format").prop("checked") ;
    var make_cut =    $("#order_make_cut").prop("checked") ;
	var image_resize =    $("#image_resize").prop("checked") ;
	
	var halghe_n = _('halghe').value;
    var banner_cut = _('banner_cut').value;
	var stand_n = _('stand').value;
	var beat = $('input[name=order_make_format_beat]:checked').val();
	var service = _('service-name').value;
	 
	
	
	// alert(file.name+" | "+file.size+" | "+file.type);
	
	var formdata = new FormData();
 formdata.append("file1", file);
formdata.append("invoice_num", invoice_num);
formdata.append("rollmeter", rollmeter);
 	formdata.append("order-custom-width", width);
	formdata.append("order-custom-height", height);
	formdata.append("order-lot-quantity", num);
	formdata.append("order-description", desc);
	formdata.append("bannerc", bannerc);
	formdata.append("quan", '<?= $quantity?>');
	formdata.append("order_make_format", halghe);
    formdata.append("order_make_cut", make_cut);
	formdata.append("halghe", halghe_n);
    formdata.append("banner_cut", banner_cut);
	formdata.append("stand", stand_n);
	formdata.append("order_make_line", istand);
	formdata.append("image_resize", image_resize);
	formdata.append("edit_id", edit_id);
	
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
 