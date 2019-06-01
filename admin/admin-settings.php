<?php
require('../config.php');

$offer_sql=mysqli_query($connection,"select * from info");
$o= mysqli_fetch_array( $offer_sql);

$smsnum=$o['smsnum'];


$setting_result=mysqli_query($connection, "SELECT * FROM site_settings");
$row = mysqli_fetch_array($setting_result);

if (isset($row['first_page_title']) && $row['first_page_title'] != '') {
    $result_main_page_name= $row['first_page_title'];
}
?>