<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

	<?php
		parse_str($_SERVER['QUERY_STRING']);

	
		
		require ('../db_select.php');
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");

	$sql_users_number = mysqli_query($connection, "SELECT * FROM user ORDER BY user_id DESC");
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

		$dbresult=mysqli_query($connection, "SELECT * FROM user ORDER BY user_id DESC LIMIT $start , $end");
		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");



	?>

		<h2>لیست کاربران</h2>
<?php

if(!isset($page) || $page == ''){
$page = 1;
}
 echo "<br/> صفحه ی ".$page ." از ".$pages; 

?>
		<table id="services-edit-table">
			<tr>
				<th class="th-darker">ردیف</th>
				<th>نام کاربری</th>
				<th class="th-darker">ایمیل</th>
				<th>گذرواژه</th>
				<th class="th-darker">نام و نام خانوادگی</th>
				<th>موبایل</th>
				<th class="th-darker">آدرس</th>
				<th>ساکن تبریز</th>
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
                
			while($row = mysqli_fetch_array($dbresult)){
				$users_table_username= $row['username'];
				$users_table_email= $row['email'];
				$users_table_pswd_coded= $row['password'];
                
                


                $users_table_pswd_encoded = encrypt::decode($users_table_pswd_coded, 'GZvazK@(0D!_hoho12%32');

				$users_table_displayname= $row['display_name'];
				$users_table_mobile= $row['mobile'];
				$users_table_adress= $row['adress'];
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
				$users_table_user_id= $row['user_id'];
			echo "<tr>";
				echo "<td class=\"td-darker\">$c</td>";
				$c++;
				echo "<td>$users_table_username</td>";
				echo "<td class=\"td-darker\">$users_table_email</td>";
				echo "<td>$users_table_pswd_encoded</td>";
				echo "<td class=\"td-darker\">$users_table_displayname</td>";
				echo "<td>$users_table_mobile</td>";
				echo "<td class=\"td-darker\">$users_table_adress</td>";
				echo "<td>$users_table_isfromtabriz</td>";
				echo "<td class=\"td-darker\"><a href=\"edit-user.php?id=$users_table_user_id&do=edit\"><span class=\"table-edit-icon\"></span></a></td>";
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