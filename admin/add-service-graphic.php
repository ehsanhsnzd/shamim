<?php require ("header.php");?>
<?php include ("sidebar.php");


$catagory = isset($catagory) ? $catagory : '';
$_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$_POST['size'] = isset($_POST['size']) ? $_POST['size'] : '';
$_GET['catagory'] = isset($_GET['catagory']) ? $_GET['catagory'] : '';
$_GET['p_type'] = isset($_GET['p_type']) ? $_GET['p_type'] : '';
$_GET['color_type'] = isset($_GET['color_type']) ? $_GET['color_type'] : '';
$_GET['fast_type'] = isset($_GET['fast_type']) ? $_GET['fast_type'] : '';
$_GET['print_type'] = isset($_GET['print_type']) ? $_GET['print_type'] : '';
$_GET['size_type'] = isset($_GET['size_type']) ? $_GET['size_type'] : '';
$_GET['paper_type'] = isset($_GET['paper_type']) ? $_GET['paper_type'] : '';
$_GET['factor_type'] = isset($_GET['factor_type']) ? $_GET['factor_type'] : '';
$_GET['ghabz_type'] = isset($_GET['ghabz_type']) ? $_GET['ghabz_type'] : '';
$_GET['pocket_type'] = isset($_GET['pocket_type']) ? $_GET['pocket_type'] : '';
$_GET['riso_paper_type'] = isset($_GET['riso_paper_type']) ? $_GET['riso_paper_type'] : '';
$_GET['worktimetext'] = isset($_GET['worktimetext']) ? $_GET['worktimetext'] : '';
 
$catagory=$_GET['catagory'];
$fast_type=$_GET['fast_type'];
$p_type=$_GET['p_type'];
$color_type=$_GET['color_type'];
$print_type=$_GET['print_type'];
$size_type=$_GET['size_type'];
$paper_type=$_GET['paper_type'];
$factor_type=$_GET['factor_type'];
$ghabz_type=$_GET['ghabz_type'];
$pocket_type=$_GET['pocket_type'];
$riso_paper_type=$_GET['riso_paper_type'];
?>
	<section id="admin-panel-sheet">
	<?php 
 $select_paper_query=mysqli_query($connection,"select * from paper group by name ");	

if(isset($_POST['name']) && $_POST['name'] != '' && 
	isset($_POST['size']) && $_POST['size'] != '' && 
	isset($_POST['quantity1']) && $_POST['quantity1'] != '' && 
	isset($_POST['price1']) && $_POST['price1'] != '' && 
	isset($_POST['worktime']) && $_POST['worktime'] != ''){
			$catagory = $_POST['catagory'];
	$service_name = $_POST['name'];
	$code=$_POST['code'];
	$size_w=$_POST['size_w'];
	$size_h=$_POST['size_h'];
	$service_size = $_POST['size'];
	$service_quantity1 = $_POST['quantity1'];
	$service_price1 = $_POST['price1'];
	$service_worktime = $_POST['worktime'];	
		$service_worktime_text = $_POST['worktimetext'];	
	$service_quantity2 = '0';
	$service_price2 = '0';
	$service_quantity3 = '0';
	$service_price3 = '0';
	$service_quantity4 = '0';
	$service_price4 = '0';
	$service_quantity5 = '0';
	$service_price5 = '0';

	if(isset($_POST['quantity2']) && isset($_POST['price2'])){
		$service_quantity2 = $_POST['quantity2'];
		$service_price2 = $_POST['price2'];
	}
	if ($_POST['quantity2'] == '') {
		$service_quantity2 = '0';
	}
	if ($_POST['price2'] == '') {
		$service_price2 = '0';
	}
	if(isset($_POST['quantity3']) && isset($_POST['price3'])){
		$service_quantity3 = $_POST['quantity3'];
		$service_price3 = $_POST['price3'];
	}
	if ($_POST['quantity3'] == '') {
		$service_quantity3 = '0';
	}
	if ($_POST['price3'] == '') {
		$service_price3 = '0';
	}
	if(isset($_POST['quantity4']) && isset($_POST['price4'])){
		$service_quantity4 = $_POST['quantity4'];
		$service_price4 = $_POST['price4'];
	}
	if ($_POST['quantity4'] == '') {
		$service_quantity4 = '0';
	}
	if ($_POST['price4'] == '') {
		$service_price4 = '0';
	}
	if(isset($_POST['quantity5']) && isset($_POST['price5'])){
		$service_quantity5 = $_POST['quantity5'];
		$service_price5 = $_POST['price5'];
	}
	if ($_POST['quantity5'] == '') {
		$service_quantity5 = '0';
	}
	if ($_POST['price5'] == '') {
		$service_price5 = '0';
	}
$catagory=$_POST['catagory'];
$p_type=$_POST['p_type'];
$color_type=$_POST['color_type'];
$fast_type=$_POST['fast_type'];
$print_type=$_POST['print_type'];
$size_type=$_POST['size_type'];
$paper_type=$_POST['paper_type'];
$factor_type=$_POST['factor_type'];
$ghabz_type=$_POST['ghabz_type'];
$pocket_type=$_POST['pocket_type'];
$fast_fee=$_POST['fast_fee'];
$discount=$_POST['discount'];
$riso_paper_type=$_POST['riso_paper_type'];
$photo_id=$_POST['photo_id'];
 
	require ('../db_select.php');

	if (!isset($service_name) || $service_name == '' || !isset($service_size) || $service_size == '' || !isset($service_quantity1) || $service_quantity1 == '' || !isset($service_price1) || $service_price1 == ''){
	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند پر نمایید.</span>";
	}
	else{ 
	
	
		$sql = "INSERT INTO services2 (name, size, quantity1, price1, quantity2, price2, quantity3, price3, quantity4, price4,quantity5, price5, work_time,work_time_text,cat,p_type,fast_type,paper_type,print_type,size_type,factor_type,ghabz_type,riso_paper_type,pocket_type,fast_fee,photo_id,size_w,size_h,code,discount)
		VALUES ('$service_name', '$service_size', '$service_quantity1', '$service_price1', '$service_quantity2', '$service_price2', '$service_quantity3', '$service_price3', '$service_quantity4', '$service_price4','$service_quantity5', '$service_price5', '$service_worktime','$service_worktime_text','$catagory','$p_type','$fast_type','$paper_type','$print_type','$size_type','$factor_type','$ghabz_type','$riso_paper_type','$pocket_type','$fast_fee','$photo_id','$size_w','$size_h','$code','$discount')";
		
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");
		
		if ($connection->query($sql) === TRUE) {
			echo "خدمت جدید با موفقیت به لیست خدمات افزوده شد.";
		} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	mysqli_close($connection);
}


?>
	<h2>افزودن خدمات</h2><br/>
		<form action="add-service-graphic.php" method="post" id="service-add-form">
        
                               
        <select name="catagory"  onchange="window.location='?catagory='+this.value" >
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
نوع:
        <select name="p_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type='+this.value+'&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
         <option value=""  > </option>
        <option value="عمومی" <? if($p_type=="عمومی"){ echo "selected";};?> >عمومی </option>
        <option value="افست" <? if($p_type=="افست"){ echo "selected";};?>>افست</option>
        <option value="فانتزی" <? if($p_type=="فانتزی"){ echo "selected";};?>>فانتزی</option>
        <option value="دیجیتال" <? if($p_type=="دیجیتال"){ echo "selected";};?>>دیجیتال</option>
        <option value="ریسو" <? if($p_type=="ریسو"){ echo "selected";};?>>ریسو</option>


        </select>


            رنگ:
            <select name="color_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&p_type=<?=$p_type?>&fast_type=<?=$fast_type?>&color_type='+this.value+'&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
                <option value=""> </option>
                <option value="رنگی" <? if($color_type=="رنگی"){ echo "selected";};?>>رنگی</option>
                <option value="تک رنگ" <? if($color_type=="تک رنگ"){ echo "selected";};?>>تک رنگ</option>
                <option value="دو رنگ" <? if($color_type=="دو رنگ"){ echo "selected";};?>>دو رنگ</option>
            </select>

            <br>
زمان:
        <select name="fast_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type='+this.value+'&p_type=<?=$p_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
         <option value=""  > </option>
        <option value="fast" <? if($fast_type=="fast"){ echo "selected";};?> >فوری </option>
        <option value="unfast" <? if($fast_type=="unfast"){ echo "selected";};?>>غیر فوری</option>
       
        </select> 

 کاغذ:     
 <select name="paper_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&paper_type='+this.value+'&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
         <option value=""  > </option>
         
         <?
		 
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['name'];?>"<? if($paper_type== $select_paper_fetch['name']){ echo "selected";};?>><? echo $select_paper_fetch['name'];?></option>
	<?
	
}
 ?>
     </select> <br>
 
        
   نحوه چاپ:  
   <select name="print_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&paper_type=<?=$paper_type?>&print_type='+this.value+'&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
         <option value=""  > </option>
        <option value="1" <? if($print_type=="1"){ echo "selected";};?> >تک رو </option>
        <option value="2" <? if($print_type=="2"){ echo "selected";};?>>دو رو</option>
        
       
        </select><br>

        سایز:  <select name="size_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type='+this.value+'&factor_type=<?=$factor_type?>&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
         <option value=""  > </option>
        <option value="A6" <? if($size_type=="A6"){ echo "selected";};?> >A6</option>
        <option value="A5" <? if($size_type=="A5"){ echo "selected";};?>>A5</option>
          <option value="A4" <? if($size_type=="A4"){ echo "selected";};?> >A4</option>
        <option value="A3" <? if($size_type=="A3"){ echo "selected";};?>>A3</option>
          <option value="B6" <? if($size_type=="B6"){ echo "selected";};?> >B6</option>
        <option value="B5" <? if($size_type=="B5"){ echo "selected";};?>>B5</option>
         <option value="B4" <? if($size_type=="B4"){ echo "selected";};?>>B4</option>
          <option value="B3" <? if($size_type=="B3"){ echo "selected";};?>>B3</option>
        <option value="m" <? if($size_type=="m"){ echo "selected";};?>>ملخی</option>
        </select>
        فاکتور:
            <select name="factor_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type='+this.value+'&ghabz_type=<?=$ghabz_type?>&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
                <option value=""  ></option>
        <option value="kd" <? if($factor_type=="kd"){ echo "selected";};?>>کاربندار</option>
         <option value="bk" <? if($factor_type=="bk"){ echo "selected";};?>>بدون کاربن</option>
     
        
       
        </select>
        
        قبض:
                    <select name="ghabz_type"  onchange="window.location='?catagory='+<?=$catagory?>+'&color_type=<?=$color_type?>&fast_type=<?=$fast_type?>&p_type=<?=$p_type?>&paper_type=<?=$paper_type?>&print_type=<?=$print_type?>&size_type=<?=$size_type?>&factor_type=<?=$factor_type?>&ghabz_type='+this.value+'&pocket_type=<?=$pocket_type?>&riso_paper_type=<?=$riso_paper_type?>'" >
                 <option value=""  > </option>
            <option value="n" <? if($ghabz_type=="n"){ echo "selected";};?>>با شماره</option>
         <option value="un" <? if($ghabz_type=="un"){ echo "selected";};?>>بدون شماره</option>
         
         </select>

<br>

انتخاب عکس :
<select name="photo_id">
<option></option>
    <?   $dbresult=mysqli_query($connection, "SELECT * FROM service_photo"); 
		 
		while(	$service_type_row= mysqli_fetch_array($dbresult)){
		$photoid=$service_type_row['id'] ;
		$photoname=$service_type_row['name'] ;?>
         
        <option value="<?=$photoid?>"   ><?=$photoname?></option>
         <? }?>
       
        </select> 


<br/><input name="size_w" value="<?=$size_w?>" placeholder="طول*" required><input name="size_h" value="<?=$size_h?>" placeholder="عرض*" required> 
<br>

			<input type="text" name="name" id="add_service_name" placeholder="نام خدمت*" required value="<?=$_POST['name']?>"><br/>
            <input type="text" name="code" id="code" placeholder="کد*" required value="<?=$_POST['code']?>"><br/>
             <input type="text" name="fast_fee" id="fast_fee" placeholder="قیمت فوری*" value="<?=$_POST['fast_fee']?>"><br>
             <input type="text" name="discount" id="discount" placeholder="تخفیف*" value="<?=$_POST['discount']?>"><br>

			<input type="text" name="size" value="<?=$_POST['size']?>" placeholder="ابعاد*" required>
			<input type="number" name="worktime" value="<?=$_POST['worktime']?>" placeholder="تعداد روز کاری برای تحویل*" required>
            
            <input name="worktimetext" value="<?=$_POST['worktimetext']?>" placeholder="متن روز کاری برای تحویل*" required><br/>
			<input  name="quantity1"  value="<?=$_POST['quantity1']?>" placeholder="تیراژ 1*" required>
			<input type="number" name="price1" value="<?=$_POST['price1']?>" placeholder="قیمت تیراژ 1*" required><br/>
			<input   name="quantity2"  value="<?=$_POST['quantity2']?>" placeholder="تیراژ 2">
			<input type="number" name="price2"  value="<?=$_POST['price2']?>" placeholder="قیمت تیراژ 2"><br/>
			<input   name="quantity3"  value="<?=$_POST['quantity3']?>" placeholder="تیراژ 3">
			<input type="number" name="price3" value="<?=$_POST['price3']?>" placeholder="قیمت تیراژ 3"><br/>
			<input   name="quantity4"   value="<?=$_POST['quantity4']?>" placeholder="تیراژ 4">
			<input type="number" name="price4"  value="<?=$_POST['price4']?>" placeholder="قیمت تیراژ 4"><br/>
            	<input   name="quantity5"   value="<?=$_POST['quantity5']?>" placeholder="تیراژ 5">
			<input type="number" name="price5"  value="<?=$_POST['price5']?>" placeholder="قیمت تیراژ 5"><br/>
			<input type="submit" value="ثبت خدمت جدید">
		</form>
        
          <br>
   <br>
   <br> 
        
        
        
        
        
        
        
       <div  > 
        
   <h2>     
        اضافه کردن عکس ها:
       </h2> <br>

        
        
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"   id="options"  enctype="multipart/form-data" >

   
      
  <input type="file"  name="userfile" id="fileToUpload" class="inpts" style="width:200px" value="<? echo $_POST['userfile'] ?>"/>	
  <br><br>
<br>


            
            <input type="text" name="photo_name">
  
 
        		<input type="submit" name="submit1" value="ثبت "><br>
<br>

		</form>
        
        
        </div>
        
        <?
        
        
        
if (isset($_POST['submit1'])) {

 
		$upload_path = '../library/images/';

 
$filename = $_FILES['userfile']['name'];
$extension=".".end(explode(".", $filename));	
$photo_name=$_POST['photo_name'];

  $increment = '';					
	while(file_exists($upload_path.$increment.$photo_name.$extension )) {
 
   $increment++;
 	
}	   
	

if(!is_writable($upload_path)){
 echo 'You cannot upload to the specified directory, please CHMOD it to 777.';}
else{
	
if(file_exists($_FILES['userfile']['tmp_name'])){	
	$pathi = $_FILES['userfile']['name'];
	$ext = pathinfo($pathi, PATHINFO_EXTENSION);
	
if($ext != "jpg" && $ext != "png" && $ext != "jpeg"
&& $ext != "gif"
&& $ext != "GIF"
&& $ext != "JPEG"
&& $ext != "PNG"
&& $ext != "JPG" )
{ $this->HandleError( "پسوند فایل ناشناس است");}
	$reserveq="insert into service_photo set photo= '$increment$extension',name='$photo_name' ";
	
	if(!mysqli_query($connection,$reserveq)){ echo "ارور: " .$connection->error ;
		}	
$photo_id = mysqli_insert_id($connection);
 
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path.$increment.$extension)) { 
		
 

} else {
    $this->HandleError("مشکلی در آپلود عکس وجود دارد");
}
}
}
 
echo "  با موفقیت ذخیره شد. ";

 
 
?>	
	
<?

	}
	 
?>	
        
        
        
		<article class="guild-section">
			<span class="alert-title">نکات مهم (راهنما):</span>
				<p>- در فیلد های تیراژ فقط عدد وارد شود مثلا: 1000
				<br/>- در قسمت مربوط به قیمت نیز فقط قیمت به صورت رقم و بدون ذکر واحد پولی درج شود.
				<br/>- قیمت ها بر اساس واحد پولی "تومان" درج گردد.
				<br/>- قیمت هر تعداد تیراژ زیر پایینی آن است و با شماره مشخص گردیده است.
				<br/>- می توانید تا 4 نوع تیراژ و قیمت تعیین کنید که اولی الزامی بوده و بقیه اختیاری است.
				<br/>- حتی در صورتی که قیمت چند نوع تیراژ برابر باشد، فیلد مربوط به هر یک را پر کنید؛ برای مثال در صورتی که هم تیراژ 1000 تا 10000 تومان و هم تیراژ 2000 تا 10000 تومان باشد، باید فیلد قیمت 2000 تا نیز تکمیل گردد.
				<br/>- برای فیلد تعداد روز مورد نیاز برای تحویل کار نیز فقط تعداد روز را وارد نمایید و از نوشتن واژه "روز" در کنار عدد خود داری نمایید.
		</article>
	</section>

<?php include ("footer.php"); ?>