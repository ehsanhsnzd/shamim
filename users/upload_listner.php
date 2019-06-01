<?php

$edit_id = $_POST['edit_id'];
$factor_start = $_POST['factor_start'];
$factor_start = isset($factor_start) ? $factor_start : '0';

$factor_num = $_POST['factor_num'];
$catagory = $_POST['catagory'];
$service_id = $_POST['service-name-select'];
$order_quantity_post = $_POST['service-quantity-select'];

require('../config.php');
$connection = mysqli_connect($server_name, $db_username, $db_password);
if (!$connection) {
    die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
}
mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
mysqli_query($connection, "SET NAMES 'utf8'");
mysqli_query($connection, "SET CHARACTER SET 'utf8'");
mysqli_query($connection, "SET character_set_connection = 'utf8'");

$dbresult = mysqli_query($connection, "SELECT * FROM services2 WHERE id = $service_id");
$order_row = mysqli_fetch_array($dbresult);
if ($order_row['print_type'] == 1) {
    $print_type = 'تک رو';
} else if ($order_row['print_type'] == 2) {
    $print_type = 'دو رو';
}
if (!empty($order_row['code'])) {
    $order_code = '[کد : ' . $order_row['code'] . ']';
}
$order_name = $order_row['name'] . ' [' . $order_row['p_type'] . ' ' . $order_row['color_type'] . ' ' . $print_type . ' ' . $order_row['size_type'] . ' ' . $order_row['paper_type'] . ' ' . $order_row['factor_type'] . ' ' . $order_row['ghabz_type'] . ']' . $order_code;
$order_size = $order_row['size'];
$discount = $order_row['discount'];
$order_custom_duration = $order_row['work_time'];
$order_quantity = $order_row['quantity' . $order_quantity_post];

$order_custom_width = $_POST['order-custom-width'];
if (!isset($order_custom_width) || $order_custom_width == '') {
    $order_custom_width = '';
}
$order_custom_height = $_POST['order-custom-height'];
if (!isset($order_custom_height) || $order_custom_height == '') {
    $order_custom_height = '';
}
$order_lot_quantity = $_POST['order-lot-quantity'];


$fast_deliver = $_POST['fast_deliver'];
if ($fast_deliver == 'on') {
    $fast_deliver_fee = $_POST['fast_fee'];
}
$order_price = $order_row['price' . $order_quantity_post] + $fast_deliver_fee;
$last_lot = $_POST['last_lot'];

$dedicate_sql = mysqli_query($connection, "select * from  info");
$d = mysqli_fetch_array($dedicate_sql);
$percent_1 = $d['percent_1'];

if ($discount > 0) {
    $discount_fee = $discount / 100;
} else {
    $discount_fee = $percent_1 / 100;
}

$order_total_price = $order_price * $order_lot_quantity * $last_lot;
$order_total_discount = $order_total_price * $discount_fee;

$order_total_price = $order_total_price - $order_total_discount;
if (isset($_POST['order_make_format'])) {
    $order_make_format = '1';
} else {
    $order_make_format = '0';
}
if (isset($_POST['order_make_line'])) {
    $order_make_line = '1';
} else {
    $order_make_line = '0';
}
if (isset($_POST['order_make_format_beat'])) {
    $order_make_format_beat = '1';
} else {
    $order_make_format_beat = '0';
}
if (isset($_POST['order_make_header_glue'])) {
    $order_make_header_glue = '1';
} else {
    $order_make_header_glue = '0';
}
if (isset($_POST['order_make_number_perforating'])) {
    $order_make_number_perforating = '1';
} else {
    $order_make_number_perforating = '0';
}
if (isset($_POST['order_make_binding'])) {
    $order_make_binding = '1';
} else {
    $order_make_binding = '0';
}
if (isset($_POST['order_make_design'])) {
    $order_make_design = '1';
} else {
    $order_make_design = '0';
}
if (isset($_POST['order-description'])) {
    $order_description = $_POST['order-description'];
} else {
    $order_description = '';
}


//	require('library/jdf.php');


$order_submit_date = date('Y-m-d H:i:s');
$order_promise_date = date('Y-m-d H:i:s', strtotime("+$order_custom_duration days"));


    include("function/functions.php");
    $true_upload = array();
    for ($j = 1; $j < 5; $j++) {
        $allowedCompressedTypes = array("application/pdf","/x-rar-compressed", "application/zip", "application/x-zip", "application/x-zip-compressed", 'application/x-rar', 'application/rar', 'application/x-rar-compressed', "image/jpeg", "image/jpg", "image/png", "image/tiff");

        $temp = explode(".", $_FILES["order-file-" . $j]["name"]);
        $extension = end($temp);
        if (in_array($_FILES["order-file-" . $j]["type"], $allowedCompressedTypes)
        ) {
            if ($_FILES["order-file-" . $j]["error"] > 0) {
                echo "Return Code: " . $_FILES["order-file-" . $j]["error"] . "<br>";
            } else {
                $file_save_name = $_FILES["order-file-" . $j]["name"];
                $info = pathinfo($file_save_name);
                $file_save_name = "-" . $factor_num.$info["filename"];
                $increment = 1;
                while (file_exists("../users/images_graphic/" . $increment . $file_save_name.'.' . $info['extension'])) {

                    $increment++;

                }


               if( move_uploaded_file($_FILES["order-file-" . $j]["tmp_name"],
                    "images_graphic/" . $increment . $file_save_name.'.' . $info['extension'])){
                   echo "$fileName آپلود با موفقیت انجام شد ";
               } else {
                   echo "آپلود ناموفق";
               }
               }

                $file_adress_name = "file" . $j;
                ${$file_adress_name} = "../users/images_graphic/" . $increment . $file_save_name.'.' . $info['extension'];


                make_thumb("../users/images_graphic/", $increment . $file_save_name, '.' . $info['extension']);


                $true_upload[] = 1;
            }

    }
if( in_array($user_id_value,$site_users)){$true_upload[] = 1; }
    if (in_array(1, $true_upload)) {


        if (!isset($file2)) {
            $file2 = '';
        }
        if (!isset($file3)) {
            $file3 = '';
        }
        if (!isset($file4)) {
            $file4 = '';
        }
      } else {
          echo "آپلود ناموفق <br><br> ";
      }

?>
