<?php require ("header.php");?>
<?php include ("sidebar.php");



parse_str($_SERVER['QUERY_STRING']);
$_GET['edit_id'] = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';

$edit_id=$_GET['edit_id'];
$factor=$_GET['factor'];



                        require ('../config.php');
                        $connection = mysqli_connect($server_name, $db_username, $db_password);
                        if(!$connection){
                                die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                        }
                        mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
                        mysqli_query($connection, "SET NAMES 'utf8'");
                        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
                        mysqli_query($connection, "SET character_set_connection = 'utf8'");

$catagory = isset($catagory) ? $catagory : '';
$_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$_POST['size'] = isset($_POST['size']) ? $_POST['size'] : '';









if(!empty($edit_id)){


	$sql_order_details = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_id = '$edit_id'");


				$sql_od = mysqli_fetch_array($sql_order_details);
$fast_deliver_edit= $sql_od['fast_deliver'];
$sql_od_lot_last= $sql_od['last_lot'];
					$sql_od_id = $sql_od['order_id'];
				 	$sql_od_type = $sql_od['order_type'];
					$sql_od_f_start = $sql_od['factor_start'];
					$sql_od_size = $sql_od['order_size'];
					$quantity_edit = $sql_od['order_quantity'];
					$sql_od_total_price = $sql_od['order_total_price'];
					$sql_od_unit_price = $sql_od['order_unit_price'];
					$lot_edit = $sql_od['order_lot_quantity'];
					$sql_od_submit_date = $sql_od['order_submit_date'];
					$sql_od_promise_date = $sql_od['order_promise_date'];
					$sql_od_user = $sql_od['order_user'];

					  $dbresult=mysqli_query($connection, "SELECT * FROM services2 where name='$sql_od_type'"); $sql_ods=mysqli_fetch_assoc($dbresult);

$catagory_edit=$sql_ods['cat'];
$fast_type_edit=$sql_ods['fast_type'];
$p_type_edit=$sql_ods['p_type'];
$color_type_edit=$sql_ods['color_type'];
$print_type_edit=$sql_ods['print_type'];
$size_type_edit=$sql_ods['size_type'];
$paper_type_edit=$sql_ods['paper_type'];
$factor_type_edit=$sql_ods['factor_type'];
$ghabz_type_edit=$sql_ods['ghabz_type'];
$pocket_type_edit=$sql_ods['pocket_type'];
$riso_paper_type_edit=$sql_ods['riso_paper_type'];
$service_edit=$sql_ods['id'];


				$sql_od_username_name = mysqli_query($connection, "SELECT lastname FROM users WHERE login='$sql_od_user'");
				$sql_od_username_name_result = mysqli_fetch_array($sql_od_username_name);
				$sql_od_user_realname = $sql_od_username_name_result['lastname'];


					$sql_od_width = $sql_od['order_width'];
					if ($sql_od_width == '') {
						$sql_od_width = '-';
					}
					$sql_od_height = $sql_od['order_height'];
					if ($sql_od_height == '') {
						$sql_od_height = '-';
					}

					$sql_od_duration = $sql_od['order_duration'];


										if( $sql_od['factor']!=0){

		$sql_od_invoice_code = $sql_od['factor'];}
		else{
		$sql_od_invoice_code=	$sql_od['order_invoice_code'];

			}



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
						$sql_od_file1_view = "<img src=\"..".$sql_od_file1."\">
<a href=\"".$sql_od_file1."\" >دانلود</a>";
					}
					else{
						$sql_od_file1_view = '';
					}
					$sql_od_file2 = $sql_od['order_file2'];
					if(isset($sql_od_file2) && $sql_od_file2 != ''){
						$sql_od_file2_view = "<img src=\"..".$sql_od_file2."\">
<a href=\"".$sql_od_file2."\" >دانلود</a>";
					}
					else{
						$sql_od_file2_view = '';
					}
					$sql_od_file3 = $sql_od['order_file3'];
					if(isset($sql_od_file3) && $sql_od_file3 != ''){
						$sql_od_file3_view = "<img src=\"..".$sql_od_file3."\">
<a href=\"".$sql_od_file3."\" >دانلود</a>";
					}
					else{
						$sql_od_file3_view = '';
					}
					$sql_od_file4 = $sql_od['order_file4'];
					if(isset($sql_od_file4) && $sql_od_file4 != ''){
						$sql_od_file4_view = "<img src=\"..".$sql_od_file4."\">
<a href=\"".$sql_od_file4."\" >دانلود</a>";
					}
					else{
						$sql_od_file4_view = '';
					}

					$od_pp_no_selected='';
					$od_pp_yes_selected='';
					if ($sql_od_print_permission == '0') {
						$sql_od_pp = 'خیر';
						$od_pp_no_selected='selected';
					}
					elseif ($sql_od_print_permission == '1') {
						$sql_od_pp = 'بله';
						$od_pp_yes_selected='selected';
					}
					else{
						$sql_od_pp = '';
					}

					$od_dp_no_selected='';
					$od_dp_yes_selected='';
					if ($sql_od_delivery_permission == '0') {
						$sql_od_dp = 'خیر';
						$od_dp_no_selected='selected';
					}
					elseif ($sql_od_delivery_permission == '1') {
						$sql_od_dp = 'بله';
						$od_dp_yes_selected='selected';
					}
					else{
						$sql_od_dp = '';
					}

					$od_ls_0 = '';
					$od_ls_1 = '';
					$od_ls_2 = '';
					$od_ls_3 = '';
					$od_ls_4 = '';
					$od_ls_5 = '';
					$od_ls_6 = '';
					$od_ls_7 = '';
					if ($sql_od_last_status == '0') {
						$sql_od_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_od_last_status == '1') {
						$sql_od_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_od_last_status == '2') {
						$sql_od_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_od_last_status == '3') {
						$sql_od_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_od_last_status == '4') {
						$sql_od_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_od_last_status == '5') {
						$sql_od_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_od_last_status == '6') {
						$sql_od_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}

					elseif ($sql_od_last_status == '7') {
						$sql_od_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_od_last_status == '8') {
						$sql_od_ls = 'تحویل مشتری';
						$od_ls_8 = 'selected';
					}

					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
					if (!isset($sql_od_bijak_code)) {
						$sql_od_bijak_code= '-';
					}

					$sql_od_make_format = $sql_od['order_make_format'];
					if ($sql_od_make_format == '1') {
						$sql_od_make_format = '-قالب سازی';
					}
					else{
						$sql_od_make_format = '';
					}

					$sql_od_make_line = $sql_od['order_make_line'];
					if ($sql_od_make_line == '1') {
						$sql_od_make_line = '-خط تا';
					}
					else{
						$sql_od_make_line = '';
					}

					$sql_od_make_format_beat = $sql_od['order_make_format_beat'];
					if ($sql_od_make_format_beat == '1') {
						$sql_od_make_format_beat = '-ضرب قالب';
					}
					else{
						$sql_od_make_format_beat = '';
					}

					$sql_od_make_header_glue = $sql_od['order_make_header_glue'];
					if ($sql_od_make_header_glue == '1') {
						$sql_od_make_header_glue = '-سرچسب';
					}
					else{
						$sql_od_make_header_glue = '';
					}

					$sql_od_make_np	 = $sql_od['order_make_number_perforating'];
					if ($sql_od_make_np == '1') {
						$sql_od_make_np = '-شماره و پرفراژ';
					}
					else{
						$sql_od_make_np = '';
					}

					$sql_od_make_binding = $sql_od['order_make_binding'];
					if ($sql_od_make_binding == '1') {
						$sql_od_make_binding = '-صحافب';
					}
					else{
						$sql_od_make_binding = '';
					}

					$sql_od_make_design	 = $sql_od['order_make_design'];
					if ($sql_od_make_design == '1') {
						$sql_od_make_design = '-طراحی';
					}
					else{
						$sql_od_make_design = '';
					}
					if ($sql_od_make_format == '' && $sql_od_make_line == '' && $sql_od_make_format_beat == '' && $sql_od_make_header_glue == '' && $sql_od_make_np == '' && $sql_od_make_binding == '' && $sql_od_make_design == '') {
						$order_addition_services = '-';
					}
					else{
						$order_addition_services = '';
					}
}

$_GET['catagory'] = isset($_GET['catagory']) ? $_GET['catagory'] : $catagory_edit;
$_GET['fast_type'] = isset($_GET['fast_type']) ? $_GET['fast_type'] : $fast_type_edit;
$_GET['p_type'] = isset($_GET['p_type']) ? $_GET['p_type'] : $p_type_edit;
$_GET['print_type'] = isset($_GET['print_type']) ? $_GET['print_type'] : $print_type_edit;
$_GET['color_type'] = isset($_GET['color_type']) ? $_GET['color_type'] : $color_type_edit;
$_GET['size_type'] = isset($_GET['size_type']) ? $_GET['size_type'] : $size_type_edit;
$_GET['paper_type'] = isset($_GET['paper_type']) ? $_GET['paper_type'] : $paper_type_edit;
$_GET['factor_type'] = isset($_GET['factor_type']) ? $_GET['factor_type'] : $factor_type_edit;
$_GET['ghabz_type'] = isset($_GET['ghabz_type']) ? $_GET['ghabz_type'] : $ghabz_type_edit;
$_GET['pocket_type'] = isset($_GET['pocket_type']) ? $_GET['pocket_type'] : $pocket_type_edit;
$_GET['riso_paper_type'] = isset($_GET['riso_paper_type']) ? $_GET['riso_paper_type'] : $riso_paper_type_edit;
$_GET['service'] = isset($_GET['service']) ? $_GET['service'] : $service_edit;
$_GET['quantity'] = isset($_GET['quantity']) ? $_GET['quantity'] : $quantity_edit;
$_GET['lot'] = isset($_GET['lot']) ? $_GET['lot'] : $lot_edit;
$_GET['fast_deliver'] = isset($_GET['fast_deliver']) ? $_GET['fast_deliver'] : $fast_deliver_edit;

$fast_deliver=$_GET['fast_deliver'];
$lot=$_GET['lot'];
$quantity=$_GET['quantity'];
$service=$_GET['service'];
$catagory=$_GET['catagory'];
$fast_type=$_GET['fast_type'];
$p_type=$_GET['p_type'];
$print_type=$_GET['print_type'];
$color_type=$_GET['color_type'];
$size_type=$_GET['size_type'];
$paper_type=$_GET['paper_type'];
$factor_type=$_GET['factor_type'];
$ghabz_type=$_GET['ghabz_type'];
$pocket_type=$_GET['pocket_type'];
$riso_paper_type=$_GET['riso_paper_type'];

?>
<br>

        <section id="user-panel-sheet">

<div   <?   if (!preg_match('/shamim/',$user_id_value)){?> style="display:none"<? }?> >
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$factor?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$factor?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$factor?>"> طراحی و ... </a>
       <a class="print-button" target="_blank" href="factor_print.php?invoiceID=<?=$factor?>">چاپ فاکتور</a>
      </div>

        <br>

        <div style="border-bottom:2px solid #0C6; padding:10px">
	<a href="new-order-graphic.php?factor=<?=$factor?><? if(!empty($edit_id)){echo "&edit_id=".$edit_id;}?>" id="rcorners1">عمومی</a>

    	<a href="new-order-dedicate.php?factor=<?=$factor?><? if(!empty($edit_id)){echo "&edit_id=".$edit_id;}?>" id="rcorners2">اختصاصی</a>
	</div><br>
        <h2 class="user-panel-sheet-h2">سفارش فرم عمومی</h2>
                <form name="graphic_form" class="new-order-graphic" id="new-order-graphic" enctype="multipart/form-data" action="new-order-confirm.php" method="post">
                        <div id="order-form-type-div">
                        <div style="display:inline-block">


                            <label for="service-name">انتخاب سرویس:</label>

                            <select name="catagory" id="service-name" onchange="window.location='?catagory='+this.value+'&quantity=1th&lot=1&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
                                <option value=""  >انتخاب کنید</option>
                                <option value="1" <? if($catagory=="1"){ echo "selected";};?> >کارت ویزیت</option>
                                <option value="2" <? if($catagory=="2"){ echo "selected";};?>>تراکت</option>
                                <option value="3" <? if($catagory=="3"){ echo "selected";};?>>فاکتور</option>
                                <option value="4" <? if($catagory=="4"){ echo "selected";};?>>قبض</option>
                                <option value="5" <? if($catagory=="5"){ echo "selected";};?>>پاکت</option>
                                <option value="6" <? if($catagory=="6"){ echo "selected";};?>>ست اداری</option>
                                <option value="7" <? if($catagory=="7"){ echo "selected";};?>>بروشور</option>
                                <option value="8" <? if($catagory=="8"){ echo "selected";};?>>فولدر</option>
                                <option value="9" <? if($catagory=="9"){ echo "selected";};?>>پوستر</option>
                                <option value="10" <? if($catagory=="10"){ echo "selected";};?>>اعلامیه ترحیم</option>
                            </select><br>

<br>
<?
   $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and p_type!=''");
  $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){
?>
نوع چاپ :
       <select name="p_type" id="service-name"  onchange="window.location='?catagory='+<?=$catagory?>+'&fast_type=<?=$fast_type?>&color_type=<?=$color_type?>&p_type='+this.value+'&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
           <option value=""  >انتخاب کنید</option>
           <?
           $select_paper_query=mysqli_query($connection,"select * from services2 where cat='$catagory' group by p_type ");
           while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){

               if(!isset($_GET['work_type'])){
                   $work_type=$select_paper_fetch['work_time'] ;
                   $work_time_text=$select_paper_fetch['work_time_text'] ;}

               ?>

               <option value="<? echo $select_paper_fetch['p_type'];?>"<? if($p_type== $select_paper_fetch['p_type']){ echo "selected";};?>><? echo $select_paper_fetch['p_type'];?></option>
               <?

           }
           ?>

       </select>

                            <? }
                            $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and color_type!=''");
                            $fast_type_row= mysqli_num_rows($dbresult_fast_type);
                            if ($fast_type_row>0){
                                ?>

                                <select name="color_type" id="service-name"  onchange="window.location='?catagory='+<?=$catagory?>+'&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&color_type='+this.value+'&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
                                    <option value=""  >انتخاب کنید</option>
                                    <?
                                    $select_paper_query=mysqli_query($connection,"select * from services2 where cat='$catagory' group by color_type ");
                                    while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
                                        ?>

                                        <option value="<? echo $select_paper_fetch['color_type'];?>"<? if($color_type== $select_paper_fetch['color_type']){ echo "selected";};?>><? echo $select_paper_fetch['color_type'];?></option>
                                        <?

                                    }
                                    ?>

                                </select>



   <? }
       $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and fast_type!=''");
       $fast_type_row= mysqli_num_rows($dbresult_fast_type);
       if ($fast_type_row>0){
           ?>

           زمان :  <select name="fast_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type='+this.value+'&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
               <option value=""  >انتخاب کنید</option>
               <option value="fast" <? if($fast_type=="fast"){ echo "selected";};?> >فوری </option>
               <option value="unfast" <? if($fast_type=="unfast"){ echo "selected";};?>>غیر فوری</option>

           </select>



       <? } $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and print_type!=''");
$fast_type_row= mysqli_num_rows($dbresult_fast_type);
if ($fast_type_row>0){?>
    نحوه چاپ :    <select name="print_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type='+this.value+'&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>&fast_deliver=<?=$fast_deliver?>'" >
        <option value=""  >انتخاب کنید</option>

        <?   $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' group by print_type");
        while(	$service_type_row= mysqli_fetch_array($dbresult)){
            $printtype=$service_type_row['print_type'] ;
            if($printtype==1){$printtext='تک';}
            if($printtype==2){$printtext='دو';}
            ?>

            <option value="<?=$printtype?>" <? if($print_type==$printtype){ echo "selected";};?> ><?=$printtext?> رو </option>

        <? } ?>

    </select>
       <? }   $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and paper_type!=''");
  $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){?>
    جنس کاغذ :  <select name="paper_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type='+this.value+'&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>&fast_deliver=<?=$fast_deliver?>'" >
         <option value=""  >انتخاب کنید</option>
           <?
           $select_paper_query=mysqli_query($connection,"select * from services2 where cat='$catagory' and p_type='$p_type' and print_type='$print_type' group by paper_type ");
           while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
               if(!isset($_GET['work_type'])){
                   $work_type=$select_paper_fetch['work_time'] ;
                   $work_time_text=$select_paper_fetch['work_time_text'] ;}
               ?>

               <option value="<? echo $select_paper_fetch['paper_type'];?>"<? if($paper_type== $select_paper_fetch['paper_type']){ echo "selected";};?>><? echo $select_paper_fetch['paper_type'];?></option>
               <?

           }
           ?>
        </select>





        <? }    $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and factor_type!=''");
   $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){?><br><br>
        فاکتور :    <select name="factor_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type='+this.value+'&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
         <option value=""  >انتخاب کنید</option>

       <option value="kd" <? if($factor_type=="kd"){ echo "selected";};?>>کاربندار</option>
       <option value="bk" <? if($factor_type=="bk"){ echo "selected";};?>>بدون کاربن</option>



        </select>
       <br>
       <br>

شروع شماره فاکتور :<input name="factor_start" id="service-quantity"    style="width:70px" placeholder="مثال: 0001" required >
<br><br>


<? }   $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and ghabz_type!=''");
   $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){?>



  قبض :      <select name="ghabz_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type='+this.value+'&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" >
                 <option value=""  >انتخاب کنید</option>
            <option value="n" <? if($ghabz_type=="n"){ echo "selected";};?>>با شماره</option>
         <option value="un" <? if($ghabz_type=="un"){ echo "selected";};?>>بدون شماره</option>

         </select>
      <? if($ghabz_type=="n"){?>

شروع شماره فاکتور :<input name="factor_start" id="service-quantity"    style="width:70px" placeholder="مثال: 0001" required >
         <?   }}


    $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and size_type!=''");
  $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){?>
       سایز :   <select name="size_type"  id="service-name" onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type='+this.value+'&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>&fast_deliver=<?=$fast_deliver?>'" >
         <option value=""  >انتخاب کنید</option>

         <?   $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and p_type='$p_type' and paper_type='$paper_type' group by size_type");

		while(	$service_type_row= mysqli_fetch_array($dbresult)){
		    $size_paper=$service_type_row['size_type'] ;
            if(!isset($_GET['work_type'])){
                $work_type=$service_type_row['work_time'] ;
                $work_time_text=$service_type_row['work_time_text'] ;}

            $fast_fee = $service_type_row['fast_fee'];?>
        <option value="<?=$size_paper?>" <? if($size_type=="$size_paper"){ echo "selected";};?> ><?=$size_paper?></option>
         <? }?>

        </select> <? }?>


                            <br>
                            <br>
<?
                            $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and color_type='$color_type'   and p_type='$p_type' and fast_type='$fast_type' and paper_type='$paper_type'  and print_type='$print_type' and size_type='$size_type' and factor_type='$factor_type' and ghabz_type='$ghabz_type'   group by work_time");
                            $fast_type_row= mysqli_num_rows($dbresult_fast_type);
                            $service_type_row_worktime= mysqli_fetch_assoc($dbresult_fast_type);
                            $work_time_first=$service_type_row_worktime['work_time'] ;

?>
                            مدت زمان :   <select name="work_type"  id="service-name" onchange="window.location='?service=<?=$service?>&catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&work_type='+this.value+'&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>&fast_deliver=<?=$fast_deliver?>'" >
                                <option value=""  >انتخاب کنید</option>

                                <?   $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and color_type='$color_type'   and p_type='$p_type' and fast_type='$fast_type' and paper_type='$paper_type'  and print_type='$print_type' and size_type='$size_type' and factor_type='$factor_type' and ghabz_type='$ghabz_type'   group by work_time");

                                while(	$service_type_row= mysqli_fetch_array($dbresult)){
                                    $work_time=$service_type_row['work_time'] ;
                                    $work_time_text=$service_type_row['work_time_text'] ;
                                    $fast_fee = $service_type_row['fast_fee'];?>
                                    <option value="<?=$work_time?>" <? if($work_type=="$work_time"){ echo "selected";};?> ><?=$work_time_text?></option>

                                <? }?>
                                <? if (!empty($fast_fee)){ ?>   <option value="f" <? if($work_type=="f"){ echo "selected";};?>>فوری (یک روز)</option> <? } ?>
                            </select>
                                <br>

                                <?
//                                if(empty($fast_fee)){
//                                    $offer_sql=mysqli_query($connection,"select * from info");
//                                    $o= mysqli_fetch_array( $offer_sql);
//                                    $fast_fee=$o['fast_fee'];}

                                if($work_type=='f'){
                                    $selected_fast_deliver='checked';
                                    $fast_deliver_fee=$fast_fee*$lot;
                                }
                                else{
                                    $work_type_query="and work_time='$work_type'" ;
                                }

                               // if ($fast_fee>0){
                                    ?>


                            <input  style="display:none" type="checkbox" name="fast_deliver" id="fast_deliver" onchange="window.location='new-order-graphic.php?service=<?=$service?>&catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=<?= $quantity ?>&fast_deliver='+this.checked+'&lot=<?= $lot?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" <?=$selected_fast_deliver?>  >
                            <!--
                            <label for="fast_deliver">  فوری</label>
                            <span   style="font-size:9px; width:200px"> //number_format($fast_fee)?> تومان (1 روز کاری)</span>
                            -->

                                    <input id="fast_fee" name="fast_fee" value="<?=$fast_fee ?>" style="display:none">
                                    <input id="fast_deliver_fee" name="fast_deliver_fee" value="<?=$fast_deliver_fee ?>" style="display:none">

                                <? // } ?>



                            <br>
                            <br>

<?
   $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory' and color_type='$color_type'  ".$work_type_query."  and p_type='$p_type' and fast_type='$fast_type' and paper_type='$paper_type'  and print_type='$print_type' and size_type='$size_type' and factor_type='$factor_type' and ghabz_type='$ghabz_type' or id='$service'");
  $fast_type_row= mysqli_num_rows($dbresult_fast_type);
   if ($fast_type_row>0){
?>
                                <label for="service-name">1. انتخاب نوع خدمات:</label>
                                <select id="service-name" name="service-name-select" onchange="window.location='new-order-graphic.php?service='+this.value+'&catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&work_type=<?=$work_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=1th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" required>

                      <?

                        $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory'  and color_type='$color_type'   ".$work_type_query."  and p_type='$p_type'  and fast_type='$fast_type' and paper_type='$paper_type' and print_type='$print_type' and size_type='$size_type' and factor_type='$factor_type' and ghabz_type='$ghabz_type' or id='$service'");

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
                              <?
               if(empty($service)){
			      $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat='$catagory'  and color_type='$color_type'  ".$work_type_query." and p_type='$p_type' and fast_type='$fast_type' and paper_type='$paper_type' and print_type='$print_type' and size_type='$size_type' and factor_type='$factor_type' and ghabz_type='$ghabz_type' or id='$service'");

			   $row = mysqli_fetch_assoc($dbresult);
			   $order_id_first = $row['id'];
			     $service  = $order_id_first;


				  } }?>
                                <br/>
                                <span>2. ابعاد:
                                <?php
                                if (isset($service)) {
                                        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE id='$service' ");
                                        $row_2 = mysqli_fetch_array($dbresult);
                                        $service_size = $row_2['size'];
                                                echo $service_size;
                                }
                                ?>
                                </span><br/>
                                <label for="service-quantity">3. تیراژ:</label>
                                <select id="service-quantity" name="service-quantity-select" onchange="window.location='new-order-graphic.php?service='+<?=$service?>+'&catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&work_type=<?=$work_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity='+this.value+'th&lot=<?= $lot ?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" reqired>

                        <?php
$dedicate_sql=mysqli_query($connection,"select * from  info");
$d= mysqli_fetch_array( $dedicate_sql);
 $percent_1=$d['percent_1'];

                        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE id='$service'");
                        $row_2 = mysqli_fetch_array($dbresult);
                                $quantity1 = $row_2['quantity1'];
								$fast_fee = $row_2['fast_fee'];
								$discount=$row_2['discount'];
								$photo_id= $row_2['photo_id'];
								$size_w_none=$row_2['size_w'];
								$size_h_none=$row_2['size_h'];



								if($discount>0 ){$discount_fee=$discount/100;}
								else{$discount_fee=$percent_1/100;}


								if(empty($edit_id)){
								$size_w=$row_2['size_w'];
								$size_h=$row_2['size_h'];

								}else{
								$size_w=$sql_od_width ;
								$size_h=$sql_od_height;
									}
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
								  $quantity5 = $row_2['quantity5'];
                                if ($quantity5 == '0') {
                                        $quantity5 = '';
                                }

                                                if($quantity == '1th' || $quantity1==$quantity){
                                                     $selected1 = "selected";
													 $quantity = '1th';
                                                }
                                                else{
                                                     $selected1 = "";
                                                }

                                                if($quantity == '2th'|| $quantity2==$quantity){
                                                     $selected2 = "selected";
												 	 $quantity = '2th';
                                                }
                                                else{
                                                     $selected2 = "";
                                                }

                                                if($quantity == '3th'|| $quantity3==$quantity){
                                                     $selected3 = "selected";
												 	 $quantity = '3th';
                                                }
                                                else{
                                                     $selected3 = "";
                                                }

                                                if($quantity == '4th'|| $quantity4==$quantity){
                                                     $selected4 = "selected";
											 	 $quantity ='4th';
                                                }
                                                else{
                                                     $selected4 = "";
                                                }
												   if($quantity == '5th'|| $quantity5==$quantity){
                                                     $selected5 = "selected";
												 	 $quantity = '5th';
                                                }
                                                else{
                                                     $selected5 = "";
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
										     if ($quantity5 != '') {
                                                echo "<option value=\"5\" ".$selected5.">$quantity5</option>";
                                        }
                        ?>

                                </select><br/>


                                 <label for="order-file-3">4. تعداد: </label>
                                <input name="order-lot-quantity" id="service-quantity"  onchange="window.location='new-order-graphic.php?service='+<?=$service?>+'&catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&color_type=<?=$color_type?>&work_type=<?=$work_type?>&fast_type=<?=$fast_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>&quantity=<?= $quantity ?>&lot='+this.value+'&fast_deliver=<?=$fast_deliver?>&factor=<?=$factor?>&edit_id=<?=$edit_id?>'" value="<?= $lot?>" style="width:50px" required>



                                <br>
                                <span>
                                <div id="show-price" style="display:inline-block"> قیمت:
                                <?php
                                if(isset($quantity)){
                                        if ($quantity == '1th') {
                                                if(!empty($row_2['price1'])){
													$price_total=$row_2['price1']*$lot+$fast_deliver_fee;

                                                        $primary_price = $row_2['price1']*$lot;
                                                }
                                        }
                                        elseif ($quantity == '2th') {
                                                if(!empty($row_2['price2'])){
                                                    $price_total=$row_2['price2']*$lot+$fast_deliver_fee;
                                                        $primary_price = $row_2['price2']*$lot;
                                                }
                                        }
                                        elseif ($quantity == '3th') {
                                                if(!empty($row_2['price3'] )){
                                                      $price_total=$row_2['price3']*$lot+$fast_deliver_fee;
                                                        $primary_price = $row_2['price3']*$lot;
                                                }
                                        }
                                        elseif ($quantity == '4th') {
                                                if(!empty($row_2['price4'])){
                                                      $price_total=$row_2['price4']*$lot+$fast_deliver_fee;
                                                        $primary_price = $row_2['price4']*$lot;
                                                }
                                        }

				   elseif ($quantity == '5th') {
                                                if(!empty($row_2['price5'])){
                                                     $price_total=$row_2['price5']*$lot+$fast_deliver_fee;
                                                        $primary_price = $row_2['price5']*$lot;
                                                }
                                        }
                                }

								echo  $price_total. ' تومان';

                                ?>

                                           

1 لت


<input style="display:none" value="1" name="last_lot" />


<br>
<br>
 <span> بعد از تخفیف :
<div  style="display:inline-block; color:#BA0707">
<?  $discount_total=$price_total*$discount_fee;
echo  $price_total=$price_total-$discount_total;

 ?> تومان
</div>
 </span>

                                </div>

                                 <input id="primary_price" value="<?=$primary_price ?>" style="display:none">
                                </span><br/>



                        </div>


                        <div style="display:inline-block; text-align:left;width:60%">
                      <?
			    if (isset($catagory)){
                          $dbresult_fast_type=mysqli_query($connection, "SELECT * FROM service_photo where photo_cat=$catagory ");
  $fast_type_row= mysqli_fetch_assoc($dbresult_fast_type);

					   if (isset($fast_type_row['photo'])){
					    ?>

                        <img src="../library/images/<?=$fast_type_row['photo']?>">

                        <? }}?>


                        </div>


                          </div>
                        <div id="order-form-upload-div">
                                <h3 class="user-panel-sheet-h3">پارامتر های سفارشی و فایل های چاپ:</h3>
                                <label >طول سفارشی:</label>
                                <input type="text" name="order-custom-width" id="upload-div-order-width" placeholder="پیشفرض" value="<?=$size_w?>">
   <input type="text" id="width-none" value="<?=$size_w_none?>" style="display:none">

                          <label for="order-file-2">عرض سفارشی:</label>
                                <input type="text" name="order-custom-height" id="upload-div-order-height" placeholder="پیشفرض" value="<?=$size_h?>">
 <input type="text" id="height-none" value="<?=$size_h_none?>" style="display:none">

  <script>




      /* Script written by Adam Khoury @ DevelopPHP.com */
      /* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
      function _(el){
          return document.getElementById(el);
      }
      function uploadFile(){
          $("#progressBar").show();
          var file1 = _("file1").files[0];
          var file2 = _("file2").files[0];
          var file3 = _("file3").files[0];
          var file4 = _("file4").files[0];

          if (file1) {  _("file-text-1").value= _("file1").files[0].name;  }
            if (file2) {  _("file-text-2").value= _("file2").files[0].name;  }
              if (file3) {  _("file-text-3").value= _("file3").files[0].name;  }
                if (file4) {  _("file-text-4").value= _("file4").files[0].name;  }


          //alert(file.name+" | "+file.size+" | "+file.type);

          var formdata = new FormData();
          formdata.append("order-file-1", file1);
          formdata.append("order-file-2", file2);
          formdata.append("order-file-3", file3);
          formdata.append("order-file-4", file4);
          var ajax = new XMLHttpRequest();
          ajax.upload.addEventListener("progress", progressHandler, false);
          ajax.addEventListener("load", completeHandler, false);
          ajax.addEventListener("error", errorHandler, false);
          ajax.addEventListener("abort", abortHandler, false);
          ajax.open("POST", "upload_listner.php");
          ajax.send(formdata);
      }
      function progressHandler(event){
          _("loaded_n_total").innerHTML = "آپلود "+event.loaded+" بایت از "+event.total;
          var percent = (event.loaded / event.total) * 100;
          _("progressBar").value = Math.round(percent);
          _("status").innerHTML = Math.round(percent)+"% آپلود شده... لطفا صبر کنید";
      }
      function completeHandler(event){
          _("status").innerHTML = event.target.responseText;

           _("file1").value="";
           _("file2").value="";
           _("file3").value="";
           _("file4").value="";
          $( "#new-order-graphic" ).submit();
      }
      function errorHandler(event){
          _("status").innerHTML = "آپلود ناموفق";
      }
      function abortHandler(event){
          _("status").innerHTML = "آپلود متوقف شد";
      }

$(document).ready(function(){






    $.post("lot.php",
        {
          width: $("#upload-div-order-width").val(),
          height:$("#upload-div-order-height").val(),
		  widthnone: $("#width-none").val(),
          heightnone:$("#height-none").val(),
		   fee:$("#primary_price").val(),
		   fast_deliver:$("#fast_deliver").attr("checked"),
		   fast_deliver_fee:$("#fast_deliver_fee").val()
        },
        function(data,lot){
			$("#show-price").html(data);


        });

    $("#upload-div-order-width").change(function(){


        $.post("lot.php",
        {
          width: $("#upload-div-order-width").val(),
          height:$("#upload-div-order-height").val(),
		  widthnone: $("#width-none").val(),
          heightnone:$("#height-none").val(),
		   fee:$("#primary_price").val(),
		   fast_deliver:$("#fast_deliver").attr("checked"),
		      fast_deliver_fee:$("#fast_deliver_fee").val()
        },
        function(data,lot){
			$("#show-price").html(data);


        });


    });


	  $("#upload-div-order-height").change(function(){
        $.post("lot.php",
        {
          width: $("#upload-div-order-width").val(),
          height:$("#upload-div-order-height").val(),
		  widthnone: $("#width-none").val(),
          heightnone:$("#height-none").val(),
		   fee:$("#primary_price").val(),
		   fast_deliver:$("#fast_deliver").attr("checked"),
		      fast_deliver_fee:$("#fast_deliver_fee").val()
        },
        function(data,lot){
			$("#show-price").html(data);

        });
    });
});

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


</script>

                          <br>

                          <?   if (preg_match('/shamim/',$user_id_value)){?>
            شماره فاکتور :    <input name="factor_num" value="<?=$factor?>"  id="factor_num" style="width:50px" alt=""  <? if(!empty($_GET['factor'])){echo "readonly";} ?> >        <span  style="font-size:9px">اگر قبلا فاکتور شده شماره فاکتور را وارد کنید</span> <br>

<? }?>

<input name="edit_id" value="<?=$edit_id?>"  id="edit_id"  style="display:none">
                                <br/>
                                <label for="order-file-1">فایل 1:</label><input onchange="checkext(this.value,'file1')" type="file" name="order-file-1" id="file1" accept="application/pdf, image/jpg, image/jpeg"  <? if(in_array($user_id_value,$site_users)){  ?> required <? }?>/><br/>
                                <input value="" type="text" name="order-file-input-1" id="file-text-1"  style="display:none"/>
                               <label for="order-file-2">فایل 2:</label><input  onchange="checkext(this.value,'file2')" type="file" name="order-file-2"  id="file2" accept="application/pdf, image/jpg, image/jpeg" ><br/>
                                <input value=""  type="text" name="order-file-input-2" id="file-text-2" style="display:none"/>


                                <label for="order-file-3">فایل 3:</label><input  onchange="checkext(this.value,'file3')" type="file" name="order-file-3"  id="file3" accept="application/pdf, image/jpg, image/jpeg"><br/>
                                  <input value=""  type="text" name="order-file-input-3" id="file-text-3" style="display:none"/>

                                <label for="order-file-4">فایل 4:</label><input  onchange="checkext(this.value,'file4')" type="file" name="order-file-4"  id="file4" accept="application/pdf, image/jpg, image/jpeg">
                                  <input value=""  type="text" name="order-file-input-4" id="file-text-4" style="display:none"/>

                                <br/>

                            <progress id="progressBar" value="0" max="100" style="width:300px; display: none"></progress>

                            <div id="loaded_n_total"></div>
                            <div id="status"></div>
                                <br/>



                            <span id="order_form_total_price">
                                </span>

                        </div>


                        <? if($catagory!="1"){?>
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
                        <? } ?>
                        <div id="order-form-description-div">


<br>


                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                <textarea id="order-form-description" name="order-description"><?=$sql_od_description?></textarea>
                        </div>

                    <input  value="submiter" class="profile-edit-submit" name="submiter" style="display: none">
                </form>
            <input type="button"  value="ثبت و ارسال سفارش" class="profile-edit-submit" onclick="uploadFile()">
        </section>


<?php include ("footer.php");?>
