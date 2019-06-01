<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

	<?php
		parse_str($_SERVER['QUERY_STRING']);

		if (isset($id) && isset($do) && $do == 'delete') {

			require ('../db_select.php');

			$delete_record="DELETE FROM services WHERE id='$id'";

			if (!mysqli_query($connection,$delete_record))
			{
			die('Error: ' . mysqli_error());
			}
			else{
			echo "<span class=\"done-alert\">خدمت مورد نظر حذف گردید.</span>";
			}
		}
	
		
		require ('../db_select.php');
	$sql_services_count = mysqli_query($connection, "SELECT * FROM services ORDER BY id DESC");
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

		$dbresult=mysqli_query($connection, "SELECT * FROM services ORDER BY id LIMIT $start , $end");



	?>

		<h2>ویرایش خدمات&nbsp;<span class="smaller">(نکته: قیمت ها به تومان است.)</span></h2>
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
		<table id="services-edit-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شناسه خدمت</th>
				<th>نام خدمت</th>
                	<th></th>
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
						$type= $row['type'];
				$services_table_size= $row['size_h'].'X'.$row['size'];
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
				echo "<td class=\"td-right-align\">$type</td>";
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
				echo "<td><a href=\"edit-service.php?id=$services_table_service_id&do=edit\"><span class=\"table-edit-icon\"></span></a></td>";
				echo "<td><a href=\"services-list.php?id=$services_table_service_id&do=delete\"><span class=\"table-delete-icon\"></span></a></td>";
			echo "<tr>";
			}
			?>
		</table>

		<div id="paging">
			<ul><?php
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
					echo "<a href=\"?page=$backpage\"><li>صفحه قبل</li></a>";
				}
				for($i = 1; $i <= $pages; $i++){
					if($i == $page){
						$active_page_button = "class=\"active_page_button\"";
					}
					else{
						$active_page_button = '';
					}
					echo "<a href=\"?page=$i\"><li $active_page_button>$i</li></a>";
				 }
				if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
					echo "<a href=\"?page=$nextpage\"><li>صفحه بعد</li></a>";
				}
		  ?></ul>	
		</div>

	</section>

<?php include ("footer.php"); ?>