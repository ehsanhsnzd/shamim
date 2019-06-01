<?php require ("header.php");?>

<?php include ("sidebar.php");?>



	<section id="admin-panel-sheet">



        <h2 class="user-panel-sheet-h2">تنظیمات سایت</h2>



<?php



	require ('../db_select.php');





	if(isset($_POST['submit'])){

		if (isset($_POST['first-page-name']) && $_POST['first-page-name'] !='' ) {

			$main_page_new_title = $_POST['first-page-name'];

			$site_new_main_adress = $_POST['site-main-adress'];



			$sql = "UPDATE site_settings SET first_page_title = '$main_page_new_title' , site_main_adress = '$site_new_main_adress' WHERE id = '1'";

			mysqli_query($connection, "SET NAMES 'utf8'");

			mysqli_query($connection, "SET CHARACTER SET 'utf8'");

			mysqli_query($connection, "SET character_set_connection = 'utf8'");

			if ($connection->query($sql) === TRUE) {

				echo "<span class=\"edit-done-alert\">تغییرات مورد نظر با موفقیت اعمال گردید.</span>";

			} else {

			    echo "Error: " . $sql . "<br>" . $connection->error;

			}



		}

		else{

			echo "<span class=\"admin-panel-alert\">به نظر می رسد فیلد ها ناقص پر شده اند.</span>";

		}

	}



	$setting_result=mysqli_query($connection, "SELECT * FROM site_settings");

				$row = mysqli_fetch_array($setting_result);

				if (isset($row['first_page_title']) && $row['first_page_title'] != '') {

					$result_main_page_name= $row['first_page_title'];

				}

				else{

					$result_main_page_name= '';

				}

				if (isset($row['site_main_adress']) && $row['site_main_adress'] != '') {

					$result_site_main_adress= $row['site_main_adress'];

				}

				else{

					$result_site_main_adress= '';

				}











    if (isset($_POST['submit1'])) {





    $upload_path = '../images/';





    $filename = $_FILES['userfile']['name'];

    $extension=".".end(explode(".", $filename));

    $photo_name=$_POST['photo_name'];

    $title=$_POST['title_photo'];

    $description=$_POST['description'];



    $increment = '';

    while(file_exists($upload_path.$increment.$photo_name.$extension )) {



        $increment++;



    }





    if(!is_writable($upload_path)){

        echo 'You cannot upload to the specified directory, please CHMOD it to 777.';}

    else{



        $reserveq="update index_photo set photo= '".$increment.$photo_name.$extension."',name='$photo_name' ,title='$title', description='$description' where photo_cat='".$_POST['catagory']."'";

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

            mysqli_query($connection, "SET NAMES 'utf8'");

            mysqli_query($connection, "SET CHARACTER SET 'utf8'");

            mysqli_query($connection, "SET character_set_connection = 'utf8'");



            if(!mysqli_query($connection,$reserveq)){ echo "ارور: " .$connection->error ;

            }

            $photo_id = mysqli_insert_id($connection);



            if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path.$increment.$photo_name.$extension)) {







            } else {

                $this->HandleError("مشکلی در آپلود عکس وجود دارد");

            }

        }

    }



    echo "  با موفقیت ذخیره شد. ";







    ?>



    <?



}

$cat=$_GET['cat'];
$paper=$_GET['paper'];
$p_type=$_GET['p_type'];


if(isset($_POST['submit_fast_fee'])) {
    $dbresult=mysqli_query($connection, "update services2 set fast_fee=".$_POST["fast_fee"]." WHERE cat=".$_POST['cat_fast']);
}


if(isset($_POST['submit_paper'])){



	$cat=$_POST['cat'];

	$p_type=$_GET['p_type'];
	$public_paper=$_POST['public_paper'];

	$paper_type_fee=$_POST['paper_type_fee'];
	$dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE cat=$cat and p_type='$p_type'");

	while($row = mysqli_fetch_array($dbresult)){

		$id_service=$row['id'];

		$size_h=$row['size_h_p'];

		$size_w=$row['size_w_p'];

		$size_g=$row['size_g_p'];


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

	 $paperprice = ((($size_w * $size_h * $size_g) / 10000) * $public_paper) / 1000;

	 $price1=0;

	 $price2=0;

	 $price3=0;

	 $price4=0;

	 $price5=0;



	if($row['quantity1']>1){		$price1= ($row['quantity1']*$paperprice)+$zinc_price+$print_price;	$price1=ceil($price1/100)*100;}

	if($row['quantity2']>1){		$price2= ($row['quantity2']*$paperprice)+$zinc_price_2+$print_price_2;	$price2=ceil($price2/100)*100;}

	if($row['quantity3']>1){		$price3= ($row['quantity3']*$paperprice)+$zinc_price_3+$print_price_3;	$price3=ceil($price3/100)*100;}

	if($row['quantity4']>1){		$price4= ($row['quantity4']*$paperprice)+$zinc_price_4+$print_price_4;	$price4=ceil($price4/100)*100;}

	if($row['quantity5']>1){		$price5= ($row['quantity5']*$paperprice)+$zinc_price_5+$print_price_5;	$price5=ceil($price5/100)*100;}





		mysqli_query($connection, "update services2 set price1=$price1,price2=$price2,price3=$price3,price4=$price4,price5=$price5 where id =$id_service and paper_type_fee='$paper_type_fee' and size_w_p!=0");

	}



	mysqli_query($connection, "insert into service_paper(paper,p_type,cat,price) values('$paper','$p_type',$cat,$public_paper) ON DUPLICATE KEY
	UPDATE paper='$paper', p_type='$p_type', cat=$cat, price='$public_paper' ");




}



$paper_sql=mysqli_query($connection,"select * from service_paper where cat=$cat and p_type='$p_type' and paper='$paper'");

$paper_row= mysqli_fetch_array( $paper_sql);

$price_show=$paper_row['price'];


?>

<form id="service-add-form" method="post" action="setting.php?cat=<?=$cat?>&p_type=<?=$p_type?>&paper=<?=$paper?>">



 <label for="first-page-name">کاغذ :</label>

	 <input type="text" id="first-page-name" name="public_paper" value="<?= $price_show ?>"  > تومان

	 <br>

	 <select name="paper_type_fee"   onchange="window.location='?paper='+this.value+'&p_type=<?=$p_type?>&cat=<?=$cat?>'" >
						<option value=""  >انتخاب کنید</option>
<?$select_paper_type_query=mysqli_query($connection,"select type from paper_type group by type");
while($row_paper_type=mysqli_fetch_array($select_paper_type_query)){ ?>

	 <option value="<?=$row_paper_type['type']?>"   <? if($row_paper_type['type']==$paper){echo "selected";} ?>><?=$row_paper_type['type']?></option>
<? }?>
	 </select>


					<select name="cat"  onchange="window.location='?cat='+this.value+'&p_type=<?=$p_type?>&paper=<?=$paper?>'"  >

										<option value=""  >انتخاب کنید</option>

					 <option value="1" <? if($cat==1){echo "selected";} ?>  >کارت ویزیت</option>

					 <option value="2" <? if($cat==2){echo "selected";} ?> >تراکت</option>

					 <option value="3" <? if($cat==3){echo "selected";} ?>>فاکتور</option>

					 <option value="4" <? if($cat==4){echo "selected";} ?>>قبض</option>

					 <option value="5" <? if($cat==5){echo "selected";} ?>>پاکت</option>

							<option value="6" <? if($cat==6){echo "selected";} ?> >ست اداری</option>

							 <option value="7"  <? if($cat==7){echo "selected";} ?>>بروشور</option>

								<option value="8"  <? if($cat==8){echo "selected";} ?>>فولدر</option>

								 <option value="9" <? if($cat==9){echo "selected";} ?> >پوستر</option>

                        <option value="10" <? if($cat==10){echo "selected";} ?> >اعلامیه ترحیم</option>

					 </select>


					 <select name="p_type"  onchange="window.location='?p_type='+this.value+'&cat=<?=$cat?>&paper=<?=$paper?>'" >
								<option value=""  >انتخاب کنید</option>
					 <option value="عمومی" <? if($p_type=="عمومی"){ echo "selected";};?> >عمومی </option>
					 <option value="افست" <? if($p_type=="افست"){ echo "selected";};?>>افست</option>
					 <option value="فانتزی" <? if($p_type=="فانتزی"){ echo "selected";};?>>فانتزی</option>
					 <option value="دیجیتال" <? if($p_type=="دیجیتال"){ echo "selected";};?>>دیجیتال</option>
					 <option value="ریسو" <? if($p_type=="ریسو"){ echo "selected";};?>>ریسو</option>


				 </select>
				 <br>

					         <input type="submit" name="submit_paper" value="ذخیره کاغذ">

				 </form>





	<form id="service-add-form" method="post" action="setting.php">

		<label for="first-page-name">عنوان صفحه نخست سایت:</label><input type="text" id="first-page-name" name="first-page-name" value="<?php echo $result_main_page_name; ?>" required>

		<br/><br/><label for="site-main-adress">آدرس اصلی سایت:</label><input type="text" id="site-main-adress" name="site-main-adress" placeholder="مثلا http://shamim14.ir" value="<?php echo $result_site_main_adress; ?>">

		<br/><br/><input type="submit" name="submit" value="ذخیره تنظیمات">

	</form>





        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"   id="options"  enctype="multipart/form-data" >





            <select name="catagory">

                <option value="">انتخاب کنید</option>

                <option value="1">موقعیت 1</option>

                <option value="2">موقعیت 2</option>

                <option value="3">موقعیت 3</option>

                <option value="4">موقعیت 4</option>

                <option value="5">موقعیت 5</option>



            </select><br>

            <input type="file"  name="userfile" id="fileToUpload" class="inpts" style="width:200px" value="<? echo $_POST['userfile'] ?>"/>

            <br>

            عنوان :<input type="text" name="title_photo" class="inpts">

            <br>

             توضیحات :<input type="text" name="description" class="inpts">



            <br><br>

            <br>







            نام عکس :   <input type="text" name="photo_name">





            <input type="submit" name="submit1" value="ثبت "><br>

            <br>



        </form>







    <?




	if(isset($_POST['submit_dedicate'])){








		mysqli_query($connection,"update dedicate_info set 1th4='".$_POST['zinc4']."',

1th4p='".$_POST['zinc4p']."',

1th4pn='".$_POST['zinc4pn']."',

1th2='".$_POST['zinc2']."',

1th2p='".$_POST['zinc2p']."',

1th2pn='".$_POST['zinc2pn']."',

1th1='".$_POST['zinc1']."',

1th1p='".$_POST['zinc1p']."',

1th1pn='".$_POST['zinc1pn']."',

uv='".$_POST['uv']."',

light='".$_POST['light']."',

porfrag='".$_POST['porfrag']."',

linebreak='".$_POST['linebreak']."',

tigh='".$_POST['tigh']."',

manganeh='".$_POST['manganeh']."',

mat='".$_POST['mat']."',

uvm='".$_POST['uvm']."',

sarchasb='".$_POST['sarchasb']."',

linebreaka='".$_POST['linebreaka']."',

public_paper='".$_POST['public_paper']."',

halghe='".$_POST['halghe']."',

stand='".$_POST['stand']."',

darbast='".$_POST['darbast']."',

numbering='".$_POST['numbering']."'");





		}







 $dedicate_sql=mysqli_query($connection,"select * from dedicate_info");



$d= mysqli_fetch_array( $dedicate_sql);





	 ?>





    <form id="service-add-form" method="post" action="setting.php">

		<label for="first-page-name">زینک 4color:</label>

		<input type="text" id="first-page-name" name="zinc4" value="<?= $d['1th4']; ?>"  >



        	<label for="first-page-name">چاپ اولیه 4color :</label>

		<input type="text" id="first-page-name" name="zinc4p" value="<?= $d['1th4p']; ?>"  >



        <label for="first-page-name">چاپ بعدی 4color :</label>

		<input type="text" id="first-page-name" name="zinc4pn" value="<?= $d['1th4pn']; ?>"  >



		<br/><br/>











        		<label for="first-page-name">زینک 2color:</label>

		<input type="text" id="first-page-name" name="zinc2" value="<?= $d['1th2']; ?>"  >



        	<label for="first-page-name">چاپ اولیه 2color :</label>

		<input type="text" id="first-page-name" name="zinc2p" value="<?=$d['1th2p']; ?>"  >



        <label for="first-page-name">چاپ بعدی 2color :</label>

		<input type="text" id="first-page-name" name="zinc2pn" value="<?= $d['1th2pn']; ?>"  >



		<br/><br/>









        		<label for="first-page-name">زینک 1color:</label>

		<input type="text" id="first-page-name" name="zinc1" value="<?= $d['1th1']; ?>"  >



        	<label for="first-page-name">چاپ اولیه 1color :</label>

		<input type="text" id="first-page-name" name="zinc1p" value="<?= $d['1th1p']; ?>"  >



        <label for="first-page-name">چاپ بعدی 1color :</label>

		<input type="text" id="first-page-name" name="zinc1pn" value="<?= $d['1th1pn']; ?>"  >

		 <br>

<br>

    <label for="first-page-name">یو وی:</label>

		<input type="text" id="first-page-name" name="uv" value="<?= $d['uv']; ?>"  >



          <label for="first-page-name">براق:</label>

		<input type="text" id="first-page-name" name="light" value="<?= $d['light']; ?>"  >



        <label for="first-page-name">مات:</label>

        <input type="text" id="first-page-name" name="mat" value="<?= $d['mat']; ?>"  >

<br>

<br>



        <label for="first-page-name">یو وی موضعی:</label>

        <input type="text" id="first-page-name" name="uvm" value="<?= $d['uvm']; ?>"  >



        <label for="first-page-name">سرچسب:</label>

        <input type="text" id="first-page-name" name="sarchasb" value="<?= $d['sarchasb']; ?>"  >



        <label for="first-page-name">تیغ:</label>

		<input type="text" id="first-page-name" name="tigh" value="<?= $d['tigh']; ?>"  >

        <br>

  <label for="first-page-name">پرفراژ:</label>

		<input type="text" id="first-page-name" name="porfrag" value="<?= $d['porfrag']; ?>"  >

          <label for="first-page-name">خط تا افقی:</label>

		<input type="text" id="first-page-name" name="linebreak" value="<?= $d['linebreak']; ?>"  >

        <label for="first-page-name">خط تا عمودی:</label>

        <input type="text" id="first-page-name" name="linebreaka" value="<?= $d['linebreaka']; ?>"  ><br>



          <label for="first-page-name">برش:</label>

		<input type="text" id="first-page-name" name="manganeh" value="<?= $d['manganeh']; ?>"  >

  <label for="first-page-name">شماره زنی:</label>

		<input type="text" id="first-page-name" name="numbering" value="<?= $d['numbering']; ?>"  >

		<br>




				<br>



				  <label for="first-page-name">حلقه:</label>

						<input type="text" id="first-page-name" name="halghe" value="<?= $d['halghe']; ?>"  >



  <label for="first-page-name">استند:</label>

		<input type="text" id="first-page-name" name="stand" value="<?= $d['stand']; ?>"  >



  <label for="first-page-name">داربست:</label>

		<input type="text" id="first-page-name" name="darbast" value="<?= $d['darbast']; ?>"  >





		<br/><br/>



        <input type="submit" name="submit_dedicate" value="ذخیره تنظیمات">





	</form>

        <?

	if(isset($_POST['submit_offer'])){



		mysqli_query($connection,"update info set
 smsnum='".$_POST['smsnum']."',
 
 fee_1='".$_POST['price1']."',

fee_2='".$_POST['price2']."',

fee_3='".$_POST['price3']."',

fee_4='".$_POST['price4']."',

fee_5='".$_POST['price5']."',

paper_qty_1='".$_POST['paper_qty_1']."',

paper_qty_2='".$_POST['paper_qty_2']."',

paper_percent_1='".$_POST['paper_percent_1']."',

paper_percent_2='".$_POST['paper_percent_2']."',

percent_1='".$_POST['offer1']."',

percent_2='".$_POST['offer2']."',

percent_3='".$_POST['offer3']."',

percent_4='".$_POST['offer4']."',

percent_5='".$_POST['offer5']."'");
}



 $offer_sql=mysqli_query($connection,"select * from info");



$o= mysqli_fetch_array( $offer_sql);

	 ?>

        <form id="service-add-form" method="post" action="setting.php">

          <label for="first-page-fast_fee">قیمت فوری:</label><input type="text" id="first-page-fast_fee" name="fast_fee" value="">

            <select name="cat_fast">

                <option value=""  >انتخاب کنید</option>

                <option value="1"   >کارت ویزیت</option>

                <option value="2"  >تراکت</option>

                <option value="3" >فاکتور</option>

                <option value="4" >قبض</option>

                <option value="5" >پاکت</option>

                <option value="6"  >ست اداری</option>

                <option value="7" >بروشور</option>

                <option value="8"  >فولدر</option>

                <option value="9"  >پوستر</option>

                <option value="10"  >اعلامیه ترحیم</option>

            </select>

            <br/><br/><input type="submit" name="submit_fast_fee" value="ذخیره">
        </form>

    <form id="service-add-form" method="post" action="setting.php">

                <label for="first-page-smsnum">شماره sms:</label><input type="text" id="first-page-smsnum" name="smsnum" value="<?=$o['smsnum']  ?>" required>

                <br>
                <hr>

                <label for="first-page-price1">مبلغ اول:</label><input type="text" id="first-page-price1" name="price1" value="<?=$o['fee_1']  ?>" required>
                <label for="first-page-offer1">تخفیف اول:</label><input type="text" id="first-page-offer1" name="offer1" value="<?=$o['percent_1']  ?>" required>

                <br>



	            <label for="first-page-price2">مبلغ دوم:</label><input type="text" id="first-page-price2" name="price2" value="<?=$o['fee_2']  ?>" required>
        		<label for="first-page-offer2">تخفیف دوم:</label><input type="text" id="first-page-offer2" name="offer2" value="<?=$o['percent_2']  ?>" required>


        <br>
        <hr>

        <label for="first-page-paper_qty_1">عدد   تحریر:</label><input type="text" id="first-page-paper_qty_1" name="paper_qty_1" value="<?=$o['paper_qty_1']  ?>" required>

        <label for="first-page-paper_percent_1">درصد  :</label><input type="text" id="first-page-paper_percent_1" name="paper_percent_1" value="<?=$o['paper_percent_1']  ?>" required>

        <br>

        <label for="first-page-paper_qty_2">عدد  گلاسه:</label><input type="text" id="first-page-paper_qty_2" name="paper_qty_2" value="<?=$o['paper_qty_2']  ?>" required>

        <label for="first-page-paper_percent_2">درصد  :</label><input type="text" id="first-page-paper_percent_2" name="paper_percent_2" value="<?=$o['paper_percent_2']  ?>" required>

        <br>


		<br/><br/><input type="submit" name="submit_offer" value="ذخیره تنظیمات">

	</form>

	</section>



<?php include ("footer.php"); ?>

