<?
function download_remote_file($file_url, $save_to)
 {
   $content = file_get_contents($file_url);
   file_put_contents($save_to, $content);
 }

download_remote_file("https://api.telegram.org/file/bot360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc/documents/file_104.jpg",realpath("./images/images") . '/file.jpg');
//  copy(file_get_contents("https://api.telegram.org/file/bot360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc/documents/file_104.jpg","images/images/a.jpg");
//file_put_contents("images/". $increment . $base_name, file_get_contents($_POST['url']) );




  ?>
