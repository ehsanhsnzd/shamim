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

?>

	<form id="service-add-form" method="post" action="setting.php">
		<label for="first-page-name">عنوان صفحه نخست سایت:</label><input type="text" id="first-page-name" name="first-page-name" value="<?php echo $result_main_page_name; ?>" required>
		<br/><br/><label for="site-main-adress">آدرس اصلی سایت:</label><input type="text" id="site-main-adress" name="site-main-adress" placeholder="مثلا http://shamim14.ir" value="<?php echo $result_site_main_adress; ?>">
		<br/><br/><input type="submit" name="submit" value="ذخیره تنظیمات">
	</form>
	</section>

<?php include ("footer.php"); ?>
