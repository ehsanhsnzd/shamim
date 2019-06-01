<?php require ("header.php");?>

<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">



	<h2>ویرایش خدمات</h2>



		<?php

 $select_paper_query=mysqli_query($connection,"select * from paper group by name ");

	if(isset($_POST['name']) && $_POST['name'] != '' &&

	isset($_POST['size']) && $_POST['size'] != '' &&

	isset($_POST['quantity1']) && $_POST['quantity1'] != '' &&

	isset($_POST['price1']) && $_POST['price1'] != '' &&

	isset($_POST['worktime']) && $_POST['worktime'] != ''){



	parse_str($_SERVER['QUERY_STRING']);



	$service_name = $_POST['name'];

	$code=$_POST['code'];

	$fast_fee=$_POST['fast_fee'];

	$discount=$_POST['discount'];

	$service_size = $_POST['size'];

	$service_quantity1 = $_POST['quantity1'];

	$service_price1 = $_POST['price1'];

	$service_worktime = $_POST['worktime'];

		$service_worktime_text = $_POST['worktimetext'];



		$size_w=$_POST['size_w'];

		$size_h=$_POST['size_h'];

		$size_w_p=$_POST['size_w_p'];

		$size_h_p=$_POST['size_h_p'];

		$size_g_p=$_POST['size_g_p'];

		$zinc_price=$_POST['zinc_price'];
        $zinc_price_2=$_POST['zinc_price_2'];
        $zinc_price_3=$_POST['zinc_price_3'];
        $zinc_price_4=$_POST['zinc_price_4'];
        $zinc_price_5=$_POST['zinc_price_5'];

        $print_price=$_POST['print_price'];
        $print_price_2=$_POST['print_price_2'];
        $print_price_3=$_POST['print_price_3'];
        $print_price_4=$_POST['print_price_4'];
        $print_price_5=$_POST['print_price_5'];



        $service_quantity2 = '0';

	$service_price2 = '0';

	$service_quantity3 = '0';

	$service_price3 = '0';

	$service_quantity4 = '0';

	$service_price4 = '0';



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



	require ('../db_select.php');



	if (!isset($service_name) || $service_name == '' || !isset($service_size) || $service_size == '' || !isset($service_quantity1) || $service_quantity1 == '' || !isset($service_price1) || $service_price1 == ''){

	    echo "<span class=\"admin-panel-alert\">لطفا همه فیلد هایی که با * مشخص شده اند را پر نمایید.</span>";

	}

	else{













$catagory=$_POST['catagory'];

$p_type=$_POST['p_type'];

$color_type=$_POST['color_type'];

$fast_type=$_POST['fast_type'];

$print_type=$_POST['print_type'];

$size_type=$_POST['size_type'];

$paper_type=$_POST['paper_type'];

$paper_type_fee=$_POST['paper_type_fee'];
$factor_type=$_POST['factor_type'];

$ghabz_type=$_POST['ghabz_type'];

$pocket_type=$_POST['pocket_type'];

$riso_paper_type=$_POST['riso_paper_type'];

$photo_id=$_POST['photo_id'];





		$sql = "UPDATE services2 SET name = '$service_name' , size = '$service_size' , quantity1 = '$service_quantity1' , price1 = '$service_price1' , quantity2 = '$service_quantity2' , price2 = '$service_price2' , quantity3 = '$service_quantity3' , price3 = '$service_price3' , quantity4 = '$service_quantity4' , price4 = '$service_price4'

		 , quantity5 = '$service_quantity5' , price5 = '$service_price5' , work_time = '$service_worktime'

,size_w='$size_w',size_h='$size_h',size_w_p='$size_w_p',size_h_p='$size_h_p',size_g_p='$size_g_p',zinc_price='$zinc_price',zinc_price_2='$zinc_price_2',zinc_price_3='$zinc_price_3',zinc_price_4='$zinc_price_4',zinc_price_5='$zinc_price_5',print_price='$print_price',print_price_2='$print_price_2',print_price_3='$print_price_3',print_price_4='$print_price_4',print_price_5='$print_price_5'









		,work_time_text='$service_worktime_text',cat='$catagory',fast_type='$fast_type',paper_type='$paper_type',paper_type_fee='$paper_type_fee',print_type='$print_type',size_type='$size_type',factor_type='$factor_type',ghabz_type='$ghabz_type',riso_paper_type='$riso_paper_type',pocket_type='$pocket_type',photo_id='$photo_id',p_type='$p_type',color_type='$color_type',fast_fee='$fast_fee',code='$code',discount='$discount'







		  WHERE id = $id";

		mysqli_query($connection, "SET NAMES 'utf8'");

		mysqli_query($connection, "SET CHARACTER SET 'utf8'");

		mysqli_query($connection, "SET character_set_connection = 'utf8'");

		if ($connection->query($sql) === TRUE) {

			echo "<span class=\"edit-done-alert\">تغییرات مورد نظر با موفقیت اعمال گردید.</span>";

		} else {

    echo "Error: " . $sql . "<br>" . $connection->error;

		}

	}

}



		parse_str($_SERVER['QUERY_STRING']);



		require ('../db_select.php');



		$dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE id = $id");



		echo "<form id=\"service-add-form\" action=\"edit-service-graphic.php?id=$id&do=$do\" method=\"post\">";



		$row = mysqli_fetch_array($dbresult);







$catagory=$row['cat'];

$p_type=$row['p_type'];

$color_type=$row['color_type'];

$fast_type=$row['fast_type'];

$print_type=$row['print_type'];

$size_type=$row['size_type'];

$paper_type=$row['paper_type'];

$paper_type_fee=$row['paper_type_fee'];
$factor_type=$row['factor_type'];

$ghabz_type=$row['ghabz_type'];

$pocket_type=$row['pocket_type'];

$riso_paper_type=$row['riso_paper_type'];

$photo_id=$row['photo_id'];



				$service_edit_name= $row['name'];

				$code= $row['code'];

				$fast_fee=$row['fast_fee'];

				$discount=$row['discount'];

				$service_edit_size= $row['size'];

				$service_edit_work_time= $row['work_time'];

				$service_edit_work_time_text= $row['work_time_text'];

				$size_w=$row['size_w'];

				$size_h=$row['size_h'];

				$size_w_p=$row['size_w_p'];

				$size_h_p=$row['size_h_p'];

				$size_g_p=$row['size_g_p'];

		$zinc_price=$row['zinc_price'];
        $zinc_price_2=$row['zinc_price_2'];
        $zinc_price_3=$row['zinc_price_3'];
        $zinc_price_4=$row['zinc_price_4'];
        $zinc_price_5=$row['zinc_price_5'];

        $print_price=$row['print_price'];
        $print_price_2=$row['print_price_2'];
        $print_price_3=$row['print_price_3'];
        $print_price_4=$row['print_price_4'];
        $print_price_5=$row['print_price_5'];


			 	$service_edit_quantity1= $row['quantity1'];

				$service_edit_price1= $row['price1'];

				$service_edit_quantity2= $row['quantity2'];

				if ($service_edit_quantity2 == 0) {

					$service_edit_quantity2 = '';

				}

				$service_edit_price2= $row['price2'];

				if ($service_edit_price2 == 0) {

					$service_edit_price2= '';

				}

				$service_edit_quantity3= $row['quantity3'];

				if ($service_edit_quantity3 == 0) {

					$service_edit_quantity3 = '';

				}

				$service_edit_price3= $row['price3'];

				if ($service_edit_price3 == 0) {

					$service_edit_price3= '';

				}

				$service_edit_quantity4= $row['quantity4'];

				if ($service_edit_quantity4 == 0) {

					$service_edit_quantity4 = '';

				}

				$service_edit_price4= $row['price4'];

				if ($service_edit_price4 == 0) {

					$service_edit_price4= '';

				}



		$service_edit_quantity5= $row['quantity5'];

				if ($service_edit_quantity5 == 0) {

					$service_edit_quantity5 = '';

				}

				$service_edit_price5= $row['price5'];

				if ($service_edit_price5 == 0) {

					$service_edit_price5= '';

				}







?>





       <select name="catagory"  >

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

        <select name="p_type" >

         <option value=""  > </option>

            <option value="عمومی" <? if($p_type=="عمومی"){ echo "selected";};?> >عمومی </option>

            <option value="افست" <? if($p_type=="افست"){ echo "selected";};?>>افست</option>

            <option value="فانتزی" <? if($p_type=="فانتزی"){ echo "selected";};?>>فانتزی</option>

            <option value="دیجیتال" <? if($p_type=="دیجیتال"){ echo "selected";};?>>دیجیتال</option>

            <option value="ریسو" <? if($p_type=="ریسو"){ echo "selected";};?>>ریسو</option>



        </select>



<br>



        رنگ:

        <select name="color_type" >

            <option value=""> </option>

            <option value="رنگی" <? if($color_type=="رنگی"){ echo "selected";};?>>رنگی</option>

            <option value="تک رنگ" <? if($color_type=="تک رنگ"){ echo "selected";};?>>تک رنگ</option>

            <option value="دو رنگ" <? if($color_type=="دو رنگ"){ echo "selected";};?>>دو رنگ</option>

        </select>



کاغذ:

 <select name="paper_type"   >

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

   <select name="print_type"   >

         <option value=""  > </option>

        <option value="1" <? if($print_type=="1"){ echo "selected";};?> >تک رو </option>

        <option value="2" <? if($print_type=="2"){ echo "selected";};?>>دو رو</option>





      </select><br>



        سایز:  <select name="size_type"   >

         <option value=""  ></option>

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

            <select name="factor_type" >

                <option value=""  ></option>

        <option value="kd" <? if($factor_type=="kd"){ echo "selected";};?>>کاربندار</option>

         <option value="bk" <? if($factor_type=="bk"){ echo "selected";};?>>بدون کاربن</option>







        </select>



        قبض:

                    <select name="ghabz_type"  >

                 <option value=""  > </option>

            <option value="n" <? if($ghabz_type=="n"){ echo "selected";};?>>با شماره</option>

         <option value="un" <? if($ghabz_type=="un"){ echo "selected";};?>>بدون شماره</option>



         </select>

         پاکت:

          <select name="pocket_type"   >

          <option value=""  > </option>



           <option value="80g" <? if($pocket_type=="80g"){ echo "selected";};?>>تحریر 80 گرم</option>

           <option value="100g" <? if($pocket_type=="100g"){ echo "selected";};?>>تحریر 100 گرم</option>

           <option value="120g" <? if($pocket_type=="120g"){ echo "selected";};?>>تحریر 120 گرم</option>



          <option value="k" <? if($pocket_type=="k"){ echo "selected";};?>>کتان</option></select>



<br>

<br>



انتخاب عکس :

<select name="photo_id">

<option></option>

    <?   $dbresult=mysqli_query($connection, "SELECT * FROM service_photo");



		while(	$service_type_row= mysqli_fetch_array($dbresult)){

		$photoid=$service_type_row['id'] ;

		$photoname=$service_type_row['name'] ;?>



        <option value="<?=$photoid?>" <? if($photoid=="$photo_id"){ echo "selected";};?>  ><?=$photoname?></option>

         <? }?>



        </select>



<br>

<?

			echo "<label for=\"add_service_name\">نام خدمت:</label><input type=\"text\" name=\"name\" id=\"add_service_name\" class=\"service_edit_name\" placeholder=\"نام خدمت*\" value=\"$service_edit_name\" required><br/>";

			?><input type="text" name="code" id="code" placeholder="کد*" required value="<?=$code?>"><br/>

			 <input type="text" name="fast_fee" id="fast_fee" placeholder="قیمت فوری*" value="<?=$fast_fee?>"><br>

              <input type="text" name="discount" id="discount" placeholder="تخفیف*" value="<?=$discount?>"><br>

			<?

			echo "<label for=\"add_service_size\">ابعاد:</label><input type=\"text\" name=\"size\" id=\"add_service_size\" placeholder=\"ابعاد*\" value=\"$service_edit_size\" required>";

			echo "<label for=\"add_service_worktime\">مدت کار:</label><input type=\"number\" name=\"worktime\"id=\" add_service_worktime\" placeholder=\"تعداد روز کاری برای تحویل*\" value=\"$service_edit_work_time\" required><br/>";



			?>





   متن روز کاری برای تحویل :   <input name="worktimetext" value="<?=$service_edit_work_time_text?>" placeholder="متن روز کاری برای تحویل*" required><br/>

          طول  :     <input name="size_w" value="<?=$size_w?>" placeholder="طول*" required>

            عرض :      <input name="size_h" value="<?=$size_h?>" placeholder="عرض*" required> <br>



						طول قیمت :     <input name="size_w_p" value="<?=$size_w_p?>" placeholder="طول*" required>

							عرض قیمت :      <input name="size_h_p" value="<?=$size_h_p?>" placeholder="عرض*" required><br>

							گراماژ قیمت :      <input name="size_g_p" value="<?=$size_g_p?>" placeholder="گراماژ*" required>


								<select name="paper_type_fee"  >
												 <option value=""  >انتخاب کنید</option>
				<?$select_paper_type_query=mysqli_query($connection,"select type from paper_type group by type");
				while($row_paper_type=mysqli_fetch_array($select_paper_type_query)){ ?>

								<option value="<?=$row_paper_type['type']?>" <?if($row_paper_type['type']==$paper_type_fee){echo "selected";}?> ><?=$row_paper_type['type']?></option>
				<? }?>
								</select>
        <br>
        <hr>


			<?


            ?>زینک قیمت : <input name="zinc_price" value="<?=$zinc_price?>" placeholder="زینک*" required> چاپ قیمت :      <input name="print_price" value="<?=$print_price?>" placeholder="چاپ*" required><br><?

            echo "<label for=\"add_service_quantity1\">تیراژ اول:</label><input  name=\"quantity1\" id=\"add_service_quantity1\" placeholder=\"تیراژ 1*\" value=\"$service_edit_quantity1\" required>";

			echo "<label for=\"add_service_price1\">قیمت اول:</label><input type=\"number\" name=\"price1\" id=\"add_service_price1\" placeholder=\"قیمت تیراژ 1*\" value=\"$service_edit_price1\" required><br/><hr>";

        ?>زینک قیمت : <input name="zinc_price_2" value="<?=$zinc_price_2?>" placeholder="زینک*" required> چاپ قیمت :      <input name="print_price_2" value="<?=$print_price_2?>" placeholder="چاپ*" required><br><?

        echo "<label for=\"add_service_quantity2\">تیراژ دوم:</label><input  name=\"quantity2\" id=\"add_service_quantity2\" placeholder=\"تیراژ 2\" value=\"$service_edit_quantity2\">";

			echo "<label for=\"add_service_price2\">قیمت دوم:</label><input type=\"number\" name=\"price2\" id=\"add_service_price2\" placeholder=\"قیمت تیراژ 2\" value=\"$service_edit_price2\"><br/><hr>";

        ?>زینک قیمت : <input name="zinc_price_3" value="<?=$zinc_price_3?>" placeholder="زینک*" required> چاپ قیمت :      <input name="print_price_3" value="<?=$print_price_3?>" placeholder="چاپ*" required><br><?

        echo "<label for=\"add_service_quantity3\">تیراژ سوم:</label><input  name=\"quantity3\" id=\"add_service_quantity3\" placeholder=\"تیراژ 3\" value=\"$service_edit_quantity3\">";

			echo "<label for=\"add_service_price3\">قیمت سوم:</label><input type=\"number\" name=\"price3\" id=\"add_service_price3\" placeholder=\"قیمت تیراژ 3\" value=\"$service_edit_price3\"><br/><hr>";

        ?>زینک قیمت : <input name="zinc_price_4" value="<?=$zinc_price_4?>" placeholder="زینک*" required> چاپ قیمت :      <input name="print_price_4" value="<?=$print_price_4?>" placeholder="چاپ*" required><br><?

        echo "<label for=\"add_service_quantity4\">تیراژ چهارم:</label><input  name=\"quantity4\" id=\"add_service_quantity4\" placeholder=\"تیراژ 4\" value=\"$service_edit_quantity4\">";

        echo "<label for=\"add_service_price4\">قیمت چهارم:</label><input type=\"number\" name=\"price4\" id=\"add_service_price4\" placeholder=\"قیمت تیراژ 4\" value=\"$service_edit_price4\"><br/><hr>";

        ?>زینک قیمت : <input name="zinc_price_5" value="<?=$zinc_price_5?>" placeholder="زینک*" required> چاپ قیمت :      <input name="print_price_5" value="<?=$print_price_5?>" placeholder="چاپ*" required><br><?

				echo "<label for=\"add_service_quantity5\">تیراژ پنجم:</label><input  name=\"quantity5\" id=\"add_service_quantity5\" placeholder=\"تیراژ 5\" value=\"$service_edit_quantity5\">";

			echo "<label for=\"add_service_price5\">قیمت پنجم:</label><input type=\"number\" name=\"price5\" id=\"add_service_price5\" placeholder=\"قیمت تیراژ 5\" value=\"$service_edit_price5\"><br/>";

			echo "<input type=\"submit\" value=\"ثبت ویرایش خدمت\">";



			echo "</form>";

	mysqli_close($connection);

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

