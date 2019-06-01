<?php
function remove_files_from_dir_older_than_x_seconds($dir,$seconds = 3600) {
    $files = glob(rtrim($dir, '/')."/*");
    $now   = time();
    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= $seconds) {
                echo "removed $file<br>".PHP_EOL;
                unlink($file);
            }
        } else {
            remove_files_from_dir_older_than_x_seconds($file,$seconds);
        }
    }
    echo $dir."----";
}

remove_files_from_dir_older_than_x_seconds(dirname(__DIR__."/images/images/"), (60 * 60 * 24 * 30) );
remove_files_from_dir_older_than_x_seconds(dirname(__DIR__."/images_graphic/images_graphic/"), (60 * 60 * 24 * 30) );


include("admin/function/db.php");

$sql="delete from carts";
$db->execute($sql);

$sql="delete from carts_content";
$db->execute($sql);

$sql="DELETE FROM factor WHERE is_paid=0 and date_create < subdate(now(),INTERVAL 1 MONTH)";
$db->execute($sql);

$sql="DELETE FROM invoices_mellat WHERE is_paid=0";
$db->execute($sql);



?>
