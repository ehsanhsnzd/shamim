<?

require ('config.php');
$token= "360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc";



    $url= "https://api.telegram.org/bot".$token."/getfile?file_id=BQADBAADkQEAAt3dgVNazK2NWISBIwI";

    $message =  file_get_contents($url);

    $arrayMessage= json_decode($message, true);
    $filepath=$arrayMessage['result']['file_path'];

 echo  $file_full_path="https://api.telegram.org/file/bot".$token."/".$filepath;


    $info = pathinfo($filepath);






        $text=urlencode('حجم فایل بیشتر از 20mb میباشد
			لطفا روی @shamimgraphic کلیک کنید و فایل خود را به این نام کاربری ارسال کنید
			');





            $dbresult=mysqli_query($connection, "SELECT * FROM orders2 where order_user='advertise_149626618' order by order_id desc");

            $result=mysqli_fetch_assoc($dbresult);


            $order_id=$result['order_id'];


            if($num_banner>1){$num_banner='_NUMS-'.$num_banner;}
            else{$num_banner='';}


            while(file_exists("/users/images/" . $increment.  $file_save_name)) {
                $increment++;
            }

            $file_save_name =$increment.'_'.$order_id .$num_banner.'.'. $info['extension'];

            file_put_contents("/var/www/shamimbanner.ir/users/images/$file_save_name", file_get_contents($file_full_path ));


       echo "<br>". $file_save_name="/users/images/$file_save_name";

echo "<br>".dirname(__FILE__);

            $dbresult=mysqli_query($connection, "update $table set $field='$file_save_name' where order_user='$user'");

            $totalprice=$getprice;


            $text=urlencode('فایل شما با موفقیت دریافت شد.(شما میتوانید تعداد 4 عدد فایل ارسال نمایید)
		بعد از آپلود فایها روی ثبت و پرداخت کلیک کنید.
			');

            $poets= array(
                'keyboard' => array(array('ثبت و پرداخت'),array('بازگشت'))
            );
            $jsonPoets= json_encode($poets);

            $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
            file_get_contents($url);









    ?>