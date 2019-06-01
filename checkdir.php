<?php

$arr=[];
if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            array_push($arr,$entry);
        }
    }

    closedir($handle);
}

print_r($arr);