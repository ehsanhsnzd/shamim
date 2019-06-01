<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

	<?php
		parse_str($_SERVER['QUERY_STRING']);

	
		
		require ('../db_select.php');


    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");
    mysqli_query($connection, "SET character_set_connection = 'utf8'");

    $sql_users_number = mysqli_query($connection, "SELECT * FROM users ORDER BY id_parent DESC");
    $RecordCount = mysqli_num_rows($sql_users_number);
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

if (isset($do) && $do != '' && isset($id) && $id != '') {
 
	if ($do == 'delete') {
		 
		 
			$delete_invoice ="DELETE FROM users WHERE id_parent='$id'";

			if (!mysqli_query($connection,$delete_invoice))
			{
			die('Error: ' . mysqli_error());
				echo "مشکلی در روند حذف گاربر به وجود آمد و کاربر حذف نگردید.";
			}
			else{
			echo "<span class=\"done-alert\">کاربر مورد نظر با موفقیت حذف گردید.</span>";
			}}}
			
 




		
	?>

		<h2>لیست کاربران</h2>
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
         کاربری  :    <input name="search_login" type="text" id="search_login">

  
         نام  :    <input name="search_name" type="text" id="search_name">

              شماره تلفن :    <input name="search_tell" type="text" id="search_tell">

            <input name="submit" value="جستجو" type="submit"  class="order-edit-submit">
        <br>
        </form>


		<table id="services-edit-table">
			<tr>
				<th class="th-darker">ردیف</th>
				<th>نام کاربری</th>
				<th class="th-darker">ایمیل</th>
				 
				<th class="th-darker">نام و نام خانوادگی</th>
				<th>موبایل</th>
				<th class="th-darker">آدرس</th>
				<th>ساکن تبریز</th>
                <th>حساب</th>
				<th class="th-darker">ویرایش</th>
			</tr>
			<?php
				$c = '1';

			                class encrypt {
                    /********* Encode *********/
                    public static function encode($pure_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))), utf8_encode(trim($pure_string)), MCRYPT_MODE_ECB, $iv);
                        return base64_encode($encrypted_string);
                    }
                    /********** Decode ************ */
                    public static function decode($encrypted_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))),base64_decode(trim($encrypted_string)), MCRYPT_MODE_ECB, $iv);
                        return $decrypted_string;
                    }
                }
                  $connection = mysql_connect($server_name, $db_username, $db_password);
    if(!$connection){
        die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
    }
    mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
	
	
	  $search_login=$_POST['search_login'];
    $search_tell=$_POST['search_tell'];
	$search_login=$_POST['search_login'];

if (!empty($search_name)){

       $sql_search="SELECT * FROM users WHERE  (  name LIKE '%$search_name%' or lastname LIKE '%$search_name%' )   ORDER BY last_date DESC";

    }elseif (!empty($search_tell)){

   $sql_search= "SELECT * FROM users WHERE    telephone LIKE '%$search_tell%'    ORDER BY last_date DESC";

    }	elseif (!empty($search_login)){

        $sql_search ="SELECT * FROM users WHERE    login LIKE '%$search_login%' ";

    }	else{	
			

		$sql_search="SELECT * FROM users ORDER BY last_date  DESC LIMIT $start , $end";
	}

$dbresult=mysql_query( $sql_search);


			while($row = mysql_fetch_array($dbresult)){
				$users_table_username= $row['login'];
				$users_table_email= $row['email'];
				$users_table_pswd_coded= $row['password'];
                
               


                $users_table_pswd_encoded = encrypt::decode($users_table_pswd_coded, 'GZvazK@(0D!_hoho12%32');

				$users_table_displayname= $row['name']." ".$row['lastname'];
				$users_table_mobile= $row['telephone'];
				$users_table_adress= $row['address'];
				if (isset($row['is_from_tabriz']) && $row['is_from_tabriz'] == '1') {
					$users_table_isfromtabriz= 'بله';
				}
				elseif (isset($row['is_from_tabriz']) && $row['is_from_tabriz'] == '0') {
					$users_table_isfromtabriz= 'خیر';
				}
				else {
					$users_table_isfromtabriz= '-';
				}
				if ($users_table_displayname == '') {
					$users_table_displayname= '-';
				}
				if ($users_table_mobile == '') {
					$users_table_mobile= '-';
				}
				if ($users_table_adress == '') {
					$users_table_adress= '-';
				}
 
				
					$users_table_user_id= $row['id_parent'];



				 $sql_remove_link ="<a href=\"?do=delete&id=$users_table_user_id\"><span class=\"adminpanel-delete-icon\"></span></a>";
				 
				 
				 $connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
			die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
		}
		mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
				 
				 
				 
					if(!	$dbresult3=mysqli_query($connection, "select sum(quantity) as balance,quantity from credits_list where approved=1 and  user='$users_table_username' group by approved")){echo mysqli_error($connection);};

$row2 = mysqli_fetch_array($dbresult3);
if(!empty($row2['quantity'])){
$users_table_balance= "<div class='green-text'>پرداخت اینترنتی</div>";}

$users_table_balance.= number_format($row2['balance'])." تومان";
			echo "<tr>";
				echo "<td class=\"td-darker\">$c</td>";
				$c++;
				echo "<td>$users_table_username</td>";
				echo "<td class=\"td-darker\">$users_table_email</td>";
			//	echo "<td>$users_table_pswd_encoded</td>";
				echo "<td class=\"td-darker\">$users_table_displayname</td>";
				echo "<td>$users_table_mobile</td>";
				echo "<td class=\"td-darker\">$users_table_adress</td>";
				echo "<td>$users_table_isfromtabriz</td>";
						echo "<td>$users_table_balance</td>";
				echo "<td class=\"td-darker\"><a href=\"edit-user.php?id=$users_table_user_id&do=edit\"><span class=\"table-edit-icon\"></span></a></td>";
				echo "<td onclick=\"return  confirm('آیا مطمئن به حذف هستید؟')\">$sql_remove_link</td>";
			echo "<tr>";
				$users_table_balance="";
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