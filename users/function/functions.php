<?php
/**
 * Created by PhpStorm.
 * User: Ehsan Hsnzd Azad
 * Date: 01/03/2018
 * Time: 01:20 PM
 */


function imageIsCMYK($path) {

    $t = getimagesize($path);

    if ($t['mime']=="image/tiff"){ return true;} else{

        if (array_key_exists('channels', $t) and 4 == $t['channels']) {

            return true;

        }}

    return false;

}

function make_thumb($path,$file,$ext)
{


    $info = @getimagesize($path.$file.$ext);
    if (!imageIsCMYK($path.$file.$ext)) {

        if (array_key_exists('mime', $info) and 'image/jpeg' == $info['mime']) {

            echo "<div class='error_box' >خطا در فرمت! فایل شما فرمت CMYK نیست. کیفیت مطلوبی نخواهد داشت  </div>";
        }

    }

    $mime=$info['mime'];

    switch ($mime) {

        case 'image/jpeg':

            $image_create_func = 'imagecreatefromjpeg';

            $image_save_func = 'imagejpeg';

            $new_image_ext = '.jpg';

            $quality = 100;

            break;


        case 'image/png':

            $image_create_func = 'imagecreatefrompng';

            $image_save_func = 'imagepng';

            $new_image_ext = '.png';

            $quality = 9;

            break;


        case 'image/gif':

            $image_create_func = 'imagecreatefromgif';

            $image_save_func = 'imagegif';

            $new_image_ext = '.gif';

            $quality = 100;

            break;


        case 'image/tiff':

            $image_create_func = '0';

            $image_save_func = '0';

            $new_image_ext = '0';

            $quality = 0;

            break;


        default:

            //  echo 'پسوند ناشناس<br /><br />';

            $image_create_func = '0';


    }



 $savefunc = $path."s_" .$file . $new_image_ext;


    if ($image_create_func != '0') {
        $height=4000;

        //This is the new file you saving
        $height = $height / 100;

        list($width, $height) = getimagesize($path. $file.$ext);
        $theSize = filesize( $path. $file.$ext) / 1000000;


        $modwidth = 200;
        $diff = $width / $modwidth;
        $modheight = $height / $diff;

        $tn = imagecreatetruecolor($modwidth, $modheight);
        $image = $image_create_func($path.$file.$ext);
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);

        $image_save_func($tn, $savefunc, $quality);
    }
}