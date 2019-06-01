<?php require ("header.php");?>

<?php include ("sidebar.php");?>



	<section id="admin-panel-sheet">



	<?php

		parse_str($_SERVER['QUERY_STRING']);


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$catagory=$_POST['catagory'];
			$p_type=$_POST['p_type'];

		}else{
			$catagory=$_GET['catagory'];
			$p_type=$_GET['p_type'];

		}


		if (isset($id) && isset($do) && $do == 'delete') {



			require ('../db_select.php');



			$delete_record="DELETE FROM services2 WHERE id='$id'";



			if (!mysqli_query($connection,$delete_record))

			{

			die('Error: ' . mysqli_error());

			}

			else{

			echo "<span class=\"done-alert\">خدمت مورد نظر حذف گردید.</span>";

			}

		}





		require ('../db_select.php');

	$sql_services_count = mysqli_query($connection, "SELECT * FROM services2 ORDER BY id DESC");

	$RecordCount = mysqli_num_rows($sql_services_count);

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




		if(isset($catagory)){

		$dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat=$catagory and p_type='$p_type' ORDER BY id ");

}


	?>



		<h2>ویرایش خدمات&nbsp;<span class="smaller">(نکته: قیمت ها به تومان است.)</span></h2>



		<br>



<form id="service-add-form" action="<?=$_SERVER['PHP_SELF']?>" method="post">

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
		 </select>



		 <select name="p_type" >
             <option value="" <? if($p_type==""){ echo "selected";};?>></option>
			 	 <option value="افست" <? if($p_type=="افست"){ echo "selected";};?>>افست</option>

				 <option value="عمومی" <? if($p_type=="عمومی"){ echo "selected";};?> >عمومی </option>

				 <option value="فانتزی" <? if($p_type=="فانتزی"){ echo "selected";};?>>فانتزی</option>

				 <option value="دیجیتال" <? if($p_type=="دیجیتال"){ echo "selected";};?>>دیجیتال</option>

				 <option value="ریسو" <? if($p_type=="ریسو"){ echo "selected";};?>>ریسو</option>



		 </select>

<input type="submit" name="submit_cat" value="نمایش">

</form>

<?php



if(!isset($page) || $page == ''){

$page = 1;

}

// echo "<br/> صفحه ی ".$page ." از ".$pages;



?>

		<table id="services-edit-table" width="95%">

			<tr>

				<th>ردیف</th>

				<th class="th-darker">شناسه خدمت</th>

				<th>نام خدمت</th>

				<th>ابعاد</th>

				<th>مدت انجام کار</th>

				<th class="th-darker">تیراژ اول</th>

				<th class="th-darker">قیمت اول</th>

				<th>تیراژ دوم</th>

				<th>قیمت دوم</th>

				<th class="th-darker">تیراژ سوم</th>

				<th class="th-darker">قیمت سوم</th>

				<th>تیراژ چهارم</th>

				<th>قیمت چهارم</th>

				<th>ویرایش</th>

				<th>حذف</th>

			</tr>

			<?php

				$c = '1';

			while($row = mysqli_fetch_array($dbresult)){

				$services_table_name= $row['name'];

				$services_table_size= $row['size'];

				$services_table_work_time= $row['work_time'];

				$services_table_quantity1= $row['quantity1'];

				$services_table_price1= $row['price1'];

				$services_table_quantity2= $row['quantity2'];

				if ($services_table_quantity2 == 0) {

					$services_table_quantity2 = '-';

				}

				$services_table_price2= $row['price2'];

				if ($services_table_price2 == 0) {

					$services_table_price2= '-';

				}

				$services_table_quantity3= $row['quantity3'];

				if ($services_table_quantity3 == 0) {

					$services_table_quantity3 = '-';

				}

				$services_table_price3= $row['price3'];

				if ($services_table_price3 == 0) {

					$services_table_price3= '-';

				}

				$services_table_quantity4= $row['quantity4'];

				if ($services_table_quantity4 == 0) {

					$services_table_quantity4 = '-';

				}

				$services_table_price4= $row['price4'];

				if ($services_table_price4 == 0) {

					$services_table_price4= '-';

				}

				$services_table_service_id= $row['id'];

			echo "<tr>";

				echo "<td>$c</td>";

				$c++;

				echo "<td class=\"td-darker\">$services_table_service_id</td>";

				echo "<td class=\"td-right-align\">$services_table_name</td>";

				echo "<td>$services_table_size</td>";

				echo "<td>$services_table_work_time روز</td>";

				echo "<td class=\"td-darker\">$services_table_quantity1</td>";

				echo "<td class=\"td-darker\">$services_table_price1</td>";

				echo "<td>$services_table_quantity2</td>";

				echo "<td>$services_table_price2</td>";

				echo "<td class=\"td-darker\">$services_table_quantity3</td>";

				echo "<td class=\"td-darker\">$services_table_price3</td>";

				echo "<td>$services_table_quantity4</td>";

				echo "<td>$services_table_price4</td>";

				echo "<td><a href=\"edit-service-graphic.php?id=$services_table_service_id&do=edit\"><span class=\"table-edit-icon\"></span></a></td>";

				echo "<td><a href=\"services-list-graphic.php?id=$services_table_service_id&do=delete&catagory=$catagory&p_type=$p_type\"><span class=\"table-delete-icon\"></span></a></td>";

			echo "<tr>";

			}

			?>

		</table>





	</section>



<?php include ("footer.php"); ?>

