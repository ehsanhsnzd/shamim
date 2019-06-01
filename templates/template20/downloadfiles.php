<?
if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "<a href=\"http://demo.photostorescript.com/templates/wb_theproject/$entry\"> $entry </a><br>";
        }
    }

    closedir($handle);
}

 ?>