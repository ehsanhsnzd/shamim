<?php require ("header.php");?>
<?php include ("sidebar.php");

	$catagory=$_POST['catagory'];

  ?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست سفارشات</h2><br>
 
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"  id="service-add-form">
    شماره فاکتور :    <input name="search_num" type="text" id="search_num">
 
                               
        <select name="catagory"   id="service-name" >
                 
                 <option value="10" <? if($catagory=="10"){ echo "selected";};?> >اختصاصی</option>
        <option value="1" <? if($catagory=="1"){ echo "selected";};?> >کارت ویزیت</option>
        <option value="2" <? if($catagory=="2"){ echo "selected";};?>>تراکت رنگی</option>
        <option value="3" <? if($catagory=="3"){ echo "selected";};?>>تراکت تک رنگ</option>
        <option value="4" <? if($catagory=="4"){ echo "selected";};?>>تراکت دو رنگ</option>
        <option value="5" <? if($catagory=="5"){ echo "selected";};?>>فاکتور </option>
           <option value="6" <? if($catagory=="6"){ echo "selected";};?>>قبض رنگی</option>
            <option value="7" <? if($catagory=="7"){ echo "selected";};?>>قبض ریسو</option>
             <option value="8" <? if($catagory=="8"){ echo "selected";};?>>پاکت ریسو</option>
              <option value="9" <? if($catagory=="9"){ echo "selected";};?>>پاکت رنگی</option>
        </select>          
        <br>

      از  تاریخ  : <input type="text" id="datepicker1" class="inpts" name="datepicker1"  /> 
        تا تاریخ : <input type="text" id="datepicker2" class="inpts" name="datepicker2"  /> 
                               
         <div class="maxl">
  <label class="radio inline"> 
      <input type="radio" name="pay" value="1" <? if($_POST['pay']==1 || empty($_POST['pay'])){echo "checked";}?>>
      <span> پرداخت شده</span> 
   </label>
  <label class="radio inline"> 
      <input type="radio" name="pay" value="0"<? if($_POST['pay']=='0'){echo "checked";}?>>
      <span>پرداخت نشده </span> 
  </label>
<input type="submit" value="نمایش"></div>
             
        </form>
 
 <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
 <br>

 


<?php
	
	require ('../db_select.php');
$page=$_GET['page'];

$pay=$_POST['pay'];
	$sql_orders_number = mysqli_query($connection, "SELECT * FROM orders2 ORDER BY order_id");
	$RecordCount = mysqli_num_rows($sql_orders_number);
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



 

$datefrom = $_POST['datepicker1'];
$datefrom = explode('/', $datefrom);
$resdate= strtotime(jalali_to_gregorian($datefrom[2] , $datefrom[1] ,$datefrom[0] ,'-'));
$datefrom = date('Y-m-d',$resdate);

$dateto = $_POST['datepicker2'];
$dateto = explode('/', $dateto);
$resdate2= strtotime(jalali_to_gregorian($dateto[2] , $dateto[1] ,$dateto[0] ,'-'));
$dateto = date('Y-m-d',$resdate2);

$datefromnow=date("Y-m-d");
$datetonow=date("Y-m-d");


if(isset($_POST['submit_last_status']) && isset($_POST['input_id_last_status'])){

		
  $accept =	$_POST['accept_last_status'];
  $id = $_POST['input_id_last_status'];







 if(!mysqli_query($connection,"update orders2 set order_send = '$accept' where order_id=$id "))die(mysqli_error($connection));
 

}
 


 
 

if(isset($_GET['unprint'])){ 
$order_of_user_query= "SELECT * FROM orders2 where  order_print_permission=0 ORDER BY order_id DESC LIMIT $start , $end";
}  
	

	
elseif (isset($_POST['search_num']) &&  $_POST['catagory']==0 ){
	$search_num=$_POST['search_num'];
	
		if($pay==1){
	 $pay_query="order_last_status>0";}elseif($pay==0){
 $pay_query="order_last_status<=0";}

		$order_of_user_query =  "SELECT * FROM orders2 where  factor LIKE '%$search_num%'  and $pay_query  ORDER BY order_id DESC LIMIT $start , $end" ;
	}
	
 
elseif (isset($_POST['catagory']) && $_POST['catagory']>0 ){
	$catagory=$_POST['catagory'];
	$search_num=$_POST['search_num'];
		 
	if($pay==1){
	$pay_query="order_last_status>0 and order_last_status!=6";}elseif($pay==0){
		$pay_query="(order_last_status<=0 or order_last_status=6)";}
		
		 
		
		if($catagory==10){
		$order_of_user_query =  "SELECT * FROM orders2 where  paperprice >0 and factor LIKE '%$search_num%' and (order_send_date between '$datefrom' and '$dateto') and $pay_query ORDER BY order_id DESC" ;
		}else{
		$order_of_user_query =  "SELECT * FROM orders2 where  cat =$catagory and factor LIKE '%$search_num%'
		and (order_send_date between '$datefrom' and '$dateto') and $pay_query ORDER BY order_id DESC ";
		}
		
	}
	else{
	
	
	$order_of_user_query=  "SELECT * FROM orders2 where order_last_status>0  and order_last_status!=6
	and (order_send_date between '$datefromnow' and '$datetonow')
	 ORDER BY order_id DESC LIMIT $start , $end" ;
}

 
	
		$sql_orders_of_user= mysqli_query($connection, $order_of_user_query);


if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>



			<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
				<th>نام کاربری</th>
				<th class="th-darker">نام و نام خانوادگی کاربر</th>
				<th>عنوان</th>
				<th class="th-darker">تعداد</th>
				<th>تاریخ ثبت</th>
				<th class="th-darker">اندازه</th>
				<th>چاپخانه</th>
				<th class="th-darker">لیتوگراف</th>
                <th>سلفون</th>
				<th class="th-darker">لترپرس</th>
                <th>صحاف</th>
				<th class="th-darker">سایر</th>
				<th>آخرین وضعیت</th>
				<th>ویرایش</th> 
                <th class="th-darker">تحویل چاپخانه</th>
      
                
			</tr>
		 <?php
				$c = '1';
				while($sql_orders = mysqli_fetch_array($sql_orders_of_user)){

				
 	
	if( $sql_orders['factor']!=0){
					
		$sql_invoice = $sql_orders['factor'];}
		else{
		$sql_invoice=	$sql_orders['order_invoice_code'];
			
			}

					$sql_order_id = $sql_orders['order_id'];
					$sql_order_type = $sql_orders['order_type'];
					$sql_order_total_price = $sql_orders['order_total_price'];
					if($sql_orders['order_send_date']!=0){
					$sql_order_submit_date=   jdate('Y/m/d h:i a',strtotime(   $sql_orders['order_send_date'].' +210 minutes'),'none','Iran/Tehran','fa');					
					}
					$sql_od_lot_quantity = $sql_orders['order_lot_quantity'];
					
					
						$sql_order_promise_date = $sql_orders['order_width']."X".$sql_orders['order_height'];
					$sql_order_print_permission = $sql_orders['order_print_permission'];
					$sql_order_delivery_permission = $sql_orders['order_delivery_permission'];
					
					$permission = $sql_orders['order_delivery_permission'];
					$sql_order_last_status = $sql_orders['order_last_status'];
					$sql_order_send=$sql_orders['order_send'];
					$sql_order_printing_house=$sql_orders['printing_house'];
					$sql_order_lithograph=$sql_orders['lithograph'];
					$sql_order_selfon=$sql_orders['selfon'];
					$sql_order_letterpress=$sql_orders['letterpress'];
					$sql_order_sahaf=$sql_orders['sahaf'];
					$sql_order_others=$sql_orders['others'];
					$sql_order_user = $sql_orders['order_user'];

         $connection = mysql_connect($server_name, $db_username, $db_password);
         if(!$connection){
             die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
         }
         mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



         $sql_order_username_name = mysql_query( "SELECT name,lastname FROM users WHERE login='$sql_order_user'");
         $sql_order_username_name_result = mysql_fetch_array($sql_order_username_name);
         $sql_order_user_realname = $sql_order_username_name_result['name']." ".$sql_order_username_name_result['lastname'];

         $connection = mysqli_connect($server_name, $db_username, $db_password);
         if(!$connection){
             die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
         }
         mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
         mysqli_query($connection, "SET NAMES 'utf8'");
         mysqli_query($connection, "SET CHARACTER SET 'utf8'");
         mysqli_query($connection, "SET character_set_connection = 'utf8'");
	$sql_od_file1 = $sql_orders['order_file1'];
					if(isset($sql_od_file1) && $sql_od_file1 != ''){
						$sql_od_file1_view = "<img src=\"".$sql_od_file1."\" width='70'>";
					}
					else{
						$sql_od_file1_view = '';
					}
				

					if ($sql_order_print_permission == '0') {
						$sql_order_pp = 'خیر';
					}
					elseif ($sql_order_print_permission == '1') {
						$sql_order_pp = 'بله';
					}
					else{
						$sql_order_pp = '';
					}

					if ($sql_order_delivery_permission == '0') {
						$sql_order_dp = 'خیر';
					}
					elseif ($sql_order_delivery_permission == '1') {
						$sql_order_dp = 'بله';
					}
					else{
						$sql_order_dp = '';
					}
if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_order_last_status == '5') {
						$sql_order_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
					elseif ($sql_order_last_status == '6') {
						$sql_order_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}
					elseif ($sql_order_last_status == '7') {
						$sql_order_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					
						elseif ($sql_order_last_status == '8') {
						$sql_order_ls = 'تحویل مشتری';
						$od_ls_8 = 'selected';
					}
					
					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
$read_m=$sql_orders['read_m'];
			
			if($read_m!=1){
$read_m="class='th-darker_r'";

if($sql_order_type=='استیکر'){
	$read_m="class='th-darker_s'";
	
	}elseif($sql_order_type=='فلکس'){
	$read_m="class='th-darker_f'";

	
	}elseif($sql_order_type=='مش'){
	$read_m="class='th-darker_m'";
	
	}
	elseif($sql_order_last_status == '6'){
		$read_m="class='th-darker_s'";
				}
	
				}else $read_m='';  
				
 if($sql_order_last_status == '6'){
		$read_m="class='th-darker_s'";
				}		
				if($sql_order_last_status == '5'){
					$read_m="class='th-darker_m'";	
					}	
				
?> <tr>
				<form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>"> 
               
         
             
          <?  
					echo "<td $read_m><a name=\"field$c\">$c</a></td>";
					
					echo "<td  $read_m name>$sql_invoice</td>";
					echo "<td $read_m>$sql_order_user</td>";
					echo "<td  $read_m>$sql_order_user_realname</td>";
					echo "<td $read_m>$sql_order_type</td>";
					echo "<td  $read_m>$sql_od_lot_quantity</td>";
					echo "<td $read_m>$sql_order_submit_date</td>";
					echo "<td  $read_m>$sql_order_promise_date</td>";
					echo "<td $read_m>$sql_order_printing_house</td>";
					echo "<td $read_m>$sql_order_lithograph</td>";
					echo "<td $read_m>$sql_order_selfon</td>";
					echo "<td $read_m>$sql_order_letterpress</td>";
					echo "<td $read_m>$sql_order_sahaf</td>";
					echo "<td $read_m>$sql_order_others</td>";
					echo "<td $read_m>$sql_order_ls</td>";
					 
					$sql_order_submit_date='';
		 	
					
					echo "<td $read_m><a href=\"order-edit-graphic.php?id=$sql_order_id\" target=\"_blank\" onClick=\"refresh();\"><span class=\"orders-table-edit-icon\"></span></a></td> ";
				 
					
 				
					
	 
					
					
						echo "<td>";
					
					
					    if ($sql_order_send == 1) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="0"/> 
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">
                         
                 
                    <?php } else { ?>
                    
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_order_id?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/> 
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">
                  
                    
                    <?php  echo "</td>";
					
					
			 
					
					}  
					
					
					
					
					 
					
		$c++;			
				echo " </tr></form>";
			}
			?>
			
		</table>



		<div id="paging">
			<ul><?php 
			
			
			if(isset($_GET['unprint'])){$unprint_link= "&unprint=".$_GET['unprint'];}
			
			
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
					echo "<a href=\"?page=$backpage$unprint_link\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i$unprint_link\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage$unprint_link\"><li>صفحه بعد</li></a>";
				}
				
				
				
				
		  ?></ul>	
		</div>


	</section>

<?php include ("footer.php"); ?>