<? function tiff2jpg($file) {
    $mgck_wnd = NewMagickWand();
    MagickReadImage($mgck_wnd, $file);

    $img_colspc = MagickGetImageColorspace($mgck_wnd);
    if ($img_colspc == MW_CMYKColorspace) {
        echo "$file was in CMYK format<br />";
        MagickSetImageColorspace($mgck_wnd, MW_RGBColorspace);
    }
    MagickSetImageFormat($mgck_wnd, 'JPG' );
    MagickWriteImage($mgck_wnd, str_replace('.tif', '.jpg', $file));
}

 
 
 $image = new Imagick($_SERVER["DOCUMENT_ROOT"].'/content/7905/Untitled-3.tif');
    $image->setImageFormat('jpg');
    $image->writeImage('something.jpg');

// tiff2jpg($_SERVER["DOCUMENT_ROOT"].'/content/7905/Untitled-3.tif');


?><img src='something.jpg' >