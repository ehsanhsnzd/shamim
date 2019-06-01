<?php
$token= "360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc";

$newURL = "https://api.telegram.org/bot" . $token . "/".$_SERVER['REQUEST_URI'].'?' . http_build_query($_POST);
//header("Location: {$newURL}");

echo $_SERVER['REQUEST_URI'];
?>