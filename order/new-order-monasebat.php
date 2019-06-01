<?php require ("header.php");
include_once('library/jdf.php'); 
?>
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
    
    
    <script src="library/assets/viewportchecker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.post').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated bounceInLeft', // Class to add to the elements when they are visible
	    offset: 100    
	   });   
});            
</script>     
 <br>
 <br>


        <section id="user-panel-sheet">
       <p id="loaded_n_total"><br>
</p>
       <progress id="progressBar" value="0" max="100" style="width:300px; display:none  "></progress>


<div id="status" align="right"> 

<h2 class="user-panel-sheet-h2">سفارش جدید</h2>
        <br />

        <table width="100%">
          <tr>
        <td width="50%" align="center">
  
        <?
		  $sel_monthd= mysqli_query($connection,"select * , DATEDIFF(DATE_ADD(`datef`, interval 30 day) , CURDATE()) AS diff from months order by CASE WHEN diff < 0 THEN 1 ELSE 0 END, diff");  
					 $month_rowd=mysqli_fetch_assoc($sel_monthd) ;
						
						 
						 $date_day= $month_rowd['id'] ;
							 
				 
		
		
		
		  $sel_month= mysqli_query($connection,"select * , DATEDIFF(DATE_ADD(`datef`, interval 30 day) , CURDATE()) AS diff from months order by CASE WHEN diff < 0 THEN 1 ELSE 0 END, diff"); $i=0;
						 while($month_row=mysqli_fetch_array($sel_month)){
						
							 if($i % 3==0){echo '<br>';}
							echo'<a href="?service='.$_GET['service'].'&type='.$_GET['type'].'&month='.$month_row['id'].'"  id="top-order-month">'.$month_row['name']. '</a> ';
							 	 $i++;
							 } 
							 
							 
							 ?>
        </td>
        <td align="top" valign="top">
           <h4>   مناسبت ها </h4>
                <?
				
				if(empty($_GET['month'])){
					$month=$date_day;
					}else{
				$month = $_GET['month'];
					}
			 
					
				  $sel_day= mysqli_query($connection,"select * from date_month where month_id=$month");
				  
				
						 while($day_row=mysqli_fetch_array($sel_day)){ 
						 
						  $date=persiandate(strtotime($day_row['date_from']));
							echo'<a id="month-day"  href="?service='.$_GET['service'].'&type='.$_GET['type'].'&month='.$day_row['month_id'].'&date='.$date.'&dayid='.$day_row['id'].'"  >'. $day_row['text']. '</a> <br>';
							 
							 } ?>
        </td>
        </tr></table>
        
        
        
        
        <br>
<center>
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=stand<? if (!empty($_GET['date'])){echo "&date=".$_GET['date'] ; }?><? if (!empty($_GET['dayid'])){echo "&dayid=".$_GET['dayid'] ; }?>&month=<?=$month ?>" <? if ($_GET['type']=='stand'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?> ><br>
استند</a> 
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=placard<? if (!empty($_GET['date'])){echo "&date=".$_GET['date'] ; }?><? if (!empty($_GET['dayid'])){echo "&dayid=".$_GET['dayid'] ; }?>&month=<?=$month ?>" <? if ($_GET['type']=='placard'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?> ><br>
پلاکارد</a>
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=darbast<? if (!empty($_GET['date'])){echo "&date=".$_GET['date'] ; }?><? if (!empty($_GET['dayid'])){echo "&dayid=".$_GET['dayid'] ; }?>&month=<?=$month ?>" <? if ($_GET['type']=='darbast'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?>><br>
داربست</a>
</center>
  
        <form id="upload_form" name="upload_form" enctype="multipart/form-data" method="post">
                        <div id="order-form-type-div">
                                <h3 class="user-panel-sheet-h3">بنر مناسبتی:</h3>
                                <label for="service-name"> </label>
                    

            
                             <input value="<?= $_GET['service'] ?>" id="service-name" name="service-name-select" style="display:none">
                       
                        <?php
						$type=$_GET['type'];

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

                        $dbresult=mysqli_query($connection, "SELECT * FROM services where hide = 1 and type='$type' ");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['name'];
                                $order_id = $row['id'];
                                if($service == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                               
                        }
                        ?>

                              <br/>
                         
                               <span>2. ابعاد:
                                <?php 
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM type WHERE    type='$type'");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size_w = $row_2['size_w'];
										 $service_size_h =$row_2['size_h'];
                                       echo $service_size_w.'X'.$service_size_h;
                                }
                                ?>
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
                        
             
                        <table width="100%"><tr>
      <td>
 
       </td>
       <td width="15"></td>
       <td valign="top">
       
           <?php  
		   
		   
		   if(empty($_GET['date']))
{
  $date=	 date("Y-m-d");
} else{

$date=gregoriandate($_GET['date']);}


                           
                                ?>
       </td>
       </tr>
       </table>
                        
                      
                        
                       
                      <? 
					  $serv =$_GET['service'];
					  $type =$_GET['type'];
					
					  if(!empty($serv)){
					  ?>
				
<center>    <ul class="enlarge">
 
				<? if (!empty($date)){
					 $selgq= mysqli_query($connection,"select * from gallery where service=$serv and type='$type' and  '$date' = datef ");}
					 else{
						  $selgq= mysqli_query($connection,"select * from gallery   where service=$serv and type='$type' as g 
						   inner join months m
    on g.datef between m.datef and m.datet   ");
						 }
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

 

 
						       تعداد    <input name="order-lot-quantity" value="1"  id="upload-div-order-lot-quantity" style="width:50px"  >
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
                                  <input type="checkbox" name="order_make_format" id="order_make_format">
                                حلقه
                          (500 تومان)
                              تعداد حلقه :   <input name="halghe" value="4"  id="halghe" style="width:50px" disabled >
                                <br/><input type="checkbox" name="order_make_line" id="order_make_line"<? if($_GET['type']=='stand'){echo 'checked';}?>> 
                                استند
                                (15000 تومان)<br/>
                                
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
 <input type="text" id="bannerc"  name="bannerc" value="" style="display:none" /> 
                        <input type="button" name="submit"  onclick="return uploadFile()" class="submitup" value="ثبت و ارسال سفارش"> <? }?>
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

function validateForm(e) {
    var x = document.forms["upload_form"]["order-custom-width"].value;	
    if (x == null || x == "") {
        alert("طول سفارش را وارد کنید");
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
	
	var width =<?=  $service_size_w?> ;
	var height = <?=  $service_size_h?>;
	var num = _('upload-div-order-lot-quantity').value;
 	var bannerc= _('bannerc').value;
		var desc = _('order-form-description').value;
	var istand =   $("#order_make_line").prop("checked");
	var halghe =    $("#order_make_format").prop("checked") ;
	var halghe_n = _('halghe').value;
	var beat = $('input[name=order_make_format_beat]:checked').val();
	var service = _('service-name').value;
	
	// alert(file.name+" | "+file.size+" | "+file.type);
	
	var formdata = new FormData();
 formdata.append("file1", file);
 	formdata.append("order-custom-width", width);
	formdata.append("order-custom-height", height);
	formdata.append("order-lot-quantity", num);
	formdata.append("bannerc", bannerc);
			formdata.append("order-description", desc);
	formdata.append("quan", '<?= $quantity?>');
	formdata.append("order_make_format", halghe);
	formdata.append("halghe", halghe_n);
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
        

 
<?

	function selectdate($table,$id){
	
		  if(!$this->DBLogin())
        {
            return false;
        }

$query="select expire from $table where id = $id";
$runquery=mysql_query($query);
$expire = mysql_fetch_assoc($runquery);

$date=$expire['expire'];
if(strtotime($date)>time()){
$newdate= strtotime($date);
}else{$newdate=time();}
return $newdate;
		}
		
		
		
function persiandate($date){

return  jdate('d/m/Y',$date,'none','Iran/Tehran','en');
}
	

		function gregoriandate($date){
	$dates = explode('/', $date);

$resdate= strtotime(jalali_to_gregorian($dates[2] , $dates[1] ,$dates[0] ,'-'));

	   $cdate = date('Y-m-d',$resdate);
	return $cdate;
		}



 ?>