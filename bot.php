<?php
header('Content-Type: text/html; charset=utf-8');
$message= file_get_contents("php://input");
$arrayMessage= json_decode($message, true);

$token= "360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc";
$chat_id= $arrayMessage['message']['from']['id'];
$chat_last= $arrayMessage['message']['from']['last_name'];
$user=$chat_last.'_'.$chat_id;
$command= $arrayMessage['message']['text'];
$fileid= $arrayMessage['message']['document']['file_id'];
$file_size= $arrayMessage['message']['document']['file_size'];
$mimtype= $arrayMessage['message']['document']['mime_type'];
$fileidphoto= $arrayMessage['message']['photo'][2]['file_id'];

//  sendkeyboard(array('بازگشت'),$message,$chat_id);




include("admin/function/db.php");
include("members/content_home_items.php");
require ('config.php');
$connection = mysqli_connect($server_name, $db_username, $db_password);
if(!$connection){
    die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
}
mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
mysqli_query($connection, "SET NAMES 'utf8'");
mysqli_query($connection, "SET CHARACTER SET 'utf8'");
mysqli_query($connection, "SET character_set_connection = 'utf8'");



ob_start();
define('API_KEY','360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc');
define( "site_address", "http://shamimgraphic.ir" );



function makeHTTPRequest($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}



$update = json_decode(file_get_contents('php://input'));

if(isset($update->callback_query)){
    $callbackMessage = 'در حال بروزرسانی... لطفا کمی صبر کنید';
    var_dump(makeHTTPRequest('answerCallbackQuery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>$callbackMessage
    ]));
    $chat_id = $update->callback_query->message->chat->id;
    $message_id = $update->callback_query->message->message_id;
    $tried = $update->callback_query->data;

    if(!empty(buildmenubot($tried)) && !isphoto($tried)) {

        var_dump(
            makeHTTPRequest('editMessageText', [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                'text' => "برای نمایش طرح یکی از شاخه ها را انتخاب کنید",
                'reply_markup' => json_encode([
                    'inline_keyboard' => buildmenubot($tried)
                ])
            ])
        );
    }elseif(!isphoto($tried)){

        $photoes=photobot($tried);
            foreach($photoes as $item){
            $textitem2=$item[2];
                //Show photo
                if($item[3]==30)
                {
                    $item_type="photo";
                    $itembox=str_replace("{CLASS}","1",$itembox);
                }

                //Show video
                if($item[3]==31)
                {
                    $item_type="video";
                    $itembox=str_replace("{CLASS}","2",$itembox);
                }

                //Show audio
                if($item[3]==52)
                {
                    $item_type="audio";
                    $itembox=str_replace("{CLASS}","3",$itembox);
                }

                //Show vector
                if($item[3]==53)
                {
                    $item_type="vector";
                    $itembox=str_replace("{CLASS}","4",$itembox);
                }
                makeHTTPRequest('sendPhoto', [
                    'chat_id' => $chat_id,
                    'caption' =>"کد ".$tried,
                    'photo' =>site_address.show_preview($item[0],$item_type,2,1,$item[1],$item[2]),
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                          [  ['text' => "انتخاب", 'callback_data' => $textitem2] ]
                        ]
                    ])
                ]);

            }

    }else{



         if (  isvalue('orders1','order_file1',$user)==false && isvalue('orders1','order_make_design',$user)==false && isvalue('orders1','order_type',$user)==true ) {

               $dbresult = mysqli_query($connection, "update orders1 set order_description='از طرحهای آماده ربات $tried ' and order_make_design=1 where order_user='$user'");


             $invoice = create_invoice($user, getprice($user)+5000, 'ربات');

             $dbresult = mysqli_query($connection, "update  orders1 set 	order_invoice_code='$invoice',order_make_number_perforating='$invoice' where order_user='$user' ORDER BY order_id DESC LIMIT 1");

             $text = urlencode('با موفقیت انتخاب شد
			شماره فاکتور: ' . $invoice . '
			مبلغ قابل پرداخت: ' . number_format(getprice($user)) . ' تومان');

             $poets = json_encode([
                 'inline_keyboard' => [
                     [
                         ['text' => "پرداخت", 'url' => 'http://www.shamimbanner.ir/users/payment.php?invoice=' . $invoice]
                     ]
                 ]
             ]);
             $jsonPoets = $poets;

             $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
             file_get_contents($url);

         }

        if (  isvalue('orders2','order_file1',$user)==false && isvalue('orders2','order_make_design',$user)==false && isvalue('orders2','order_type',$user)==true ) {

            $dbresult = mysqli_query($connection, "update orders2 set order_description='از طرحهای آماده ربات $tried ' and order_make_design=1 where order_user='$user'");



            $dbresult=mysqli_query($connection, "SELECT order_total_price FROM orders2 WHERE order_user='$user'  ORDER BY order_id DESC LIMIT 1");
            $row_type = mysqli_fetch_array($dbresult);
            $order_total_price=$row_type['order_total_price'];


            $invoice=create_invoice($user,$order_total_price+5000,'ربات');
            $dbresult=mysqli_query($connection, "update  orders2 set 	order_invoice_code='$invoice',factor='$invoice' where order_user='$user' ORDER BY order_id DESC LIMIT 1");
            $text=urlencode('با موفقیت انتخاب شد');
            sendkeyboard(array(array('بازگشت')),$text,$chat_id);


            $text=urlencode('شماره فاکتور: '.  $invoice.'
			مبلغ قابل پرداخت: '.number_format($order_total_price). ' تومان');

            $poets=   json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"پرداخت",'url'=>'http://www.shamimbanner.ir/users/payment.php?invoice='.$invoice]
                    ]
                ]
            ]);
            $jsonPoets= $poets;

            $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
            file_get_contents($url);



        }

        }
}
function categorymenu($id)
{


    $update = json_decode(file_get_contents('php://input'));

    var_dump(makeHTTPRequest('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>urlencode("قیمت طرح ۵,۰۰۰ تومان 
        یکی از دسته بندی ها را انتخاب کنید"),
        'reply_markup'=>json_encode([
            'inline_keyboard'=>

                    buildmenubot($id)


        ])
    ]));

}

function uploadphoto($user,$chat_id,$token,$fileid,$fileidphoto,$mimtype,$file_size,$table,$field,$getprice,$make_design,$command,$cat)
{

    require('config.php');


    if ($command == 'آپلود') {




        $text = urlencode('فایل خود را  آپلود کنید. (توجه داشته باشید  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید. حداکثر حجم: 20mb , حداکثر تعداد ارسال: 4 فایل)');

        sendkeyboard(array(array('طراحی اختصاصی', 'آپلود', 'طرحهای آماده'), array('بازگشت')), $text, $chat_id);


    } elseif ($command == 'طرحهای آماده') {

        switch ($cat) {
            case '1':
                $catagory=9182;
                break;
            case '2':
                $catagory=10024;
                break;
            case '3':
                $catagory=9185;
                break;
            case '4':
                $catagory=5;
                break;
            case '5':
                $catagory=9389;
                break;
            case '6':
                $catagory=10023;
                break;
            case '7':
                $catagory=9247;
                break;
            case '8':
                $catagory=5;
                break;
            case '9':
                $catagory=5;
                break;
        }

        categorymenu($catagory);


    } elseif ($command == 'طراحی اختصاصی') {

        if(empty($make_design) || $make_design<2){$work_price=15000;}else{$work_price=30000;$work_price_text=' برای دو رو';};

        $text = urlencode("(هزینه طراحی اختصاصی: ".
         $work_price.
         " تومان ".
         $work_price_text.
        " لطفا تمامی متن طراحی خود را در یک سطر ارسال کنید)"
            );
        sendkeyboard(array(array('طراحی اختصاصی', 'آپلود', 'طرحهای آماده'), array('بازگشت')), $text, $chat_id);


    } else {


        $allowedCompressedTypes = array("application/x-rar-compressed", "application/zip", "application/x-zip", "application/octet-stream", "application/x-zip-compressed", 'application/x-rar', 'application/rar', 'application/x-rar-compressed', 'application/force-download', 'application/octet-stream', "image/jpeg", "image/jpg", "image/png", "image/tiff");


        if (!empty($fileidphoto) || in_array($mimtype, $allowedCompressedTypes)) {

            if (!empty($fileid)) {


                $url = "https://api.telegram.org/bot" . $token . "/getfile?file_id=" . $fileid;

                $message = file_get_contents($url);

                $arrayMessage = json_decode($message, true);
                $filepath = $arrayMessage['result']['file_path'];

                $file_full_path = "https://api.telegram.org/file/bot" . $token . "/" . $filepath;


                $info = pathinfo($filepath);


                if ($file_size < 20000) {

                    $text = urlencode('حجم فایل بیشتر از 20mb میباشد
			لطفا روی @shamimgraphic کلیک کنید و فایل خود را به این نام کاربری ارسال کنید
			');
                    sendkeyboard(array(array('بازگشت')), $text, $chat_id);
                } else {

                    if (in_array($mimtype, $allowedCompressedTypes)
                    ) {


                        $dbresult = mysqli_query($connection, "SELECT * FROM orders2 where order_user='$user' order by order_id desc");

                        $result = mysqli_fetch_assoc($dbresult);


                        $order_id = $result['order_id'];


                        if ($num_banner > 1) {
                            $num_banner = '_NUMS-' . $num_banner;
                        } else {
                            $num_banner = '';
                        }


                        while (file_exists("/users/images/" . $increment . $file_save_name)) {
                            $increment++;
                        }

                        $file_save_name = $increment . '_' . $order_id . $num_banner . '.' . $info['extension'];

                        file_put_contents("/var/www/shamimbanner.ir/users/images/$file_save_name", fopen($file_full_path, 'r'));


                        $file_save_name = "/users/images/$file_save_name";

                        $dbresult = mysqli_query($connection, "update $table set $field='$file_save_name' where order_user='$user' and order_id=$order_id");

                        $totalprice = $getprice;


                        $text = urlencode('فایل شما با موفقیت دریافت شد.(شما میتوانید تعداد 4 عدد فایل ارسال نمایید)
		بعد از آپلود فایها روی ثبت و پرداخت کلیک کنید.
			');

                        $poets = array(
                            'keyboard' => array(array('ثبت و پرداخت'), array('بازگشت'))
                        );
                        $jsonPoets = json_encode($poets);

                        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
                        file_get_contents($url);


                    } else {

                        $text = urlencode('فرمت فایل غیر مجاز است
  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید.
  ');

                        sendkeyboard(array(array('بازگشت')), $text, $chat_id);
                    }
                }


            } else {

                $text = urlencode('لطفا در فرمت فایل  بفرستید
  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید.
  ');

                sendkeyboard(array(array('بازگشت')), $text, $chat_id);
            }

        } else {
            if ($command != 'ثبت و پرداخت') {
                $dbresult = mysqli_query($connection, "update $table set  order_make_design=$make_design , order_description='$command' where order_user='$user'  ORDER BY order_id DESC LIMIT 1");

                if ($make_design > 1) {
                    $make_design_price = 30000;
                } else {
                    $make_design_price = 15000;
                }


                $text = urlencode('
	متن طراحی: ' . $command . '
	
	توضیحات طرح دریافت شد. طرح برای تایید برای شما ارسال خواهد شد.
	لطفا برای انجام پروسه چاپ روی پرداخت کلیک کنید
	
	مبلغ قابل پرداخت: ' . number_format($getprice + $make_design_price) . ' تومان
	
	');
                $poets = array(
                    'keyboard' => array(array('ثبت و پرداخت'), array('بازگشت'))
                );
                $jsonPoets = json_encode($poets);

                $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
                file_get_contents($url);

                $totalprice = $getprice + $make_design_price;
            }
        }
        return $totalprice;
    }
}




function sendkeyboard($datas,$text,$chat_id){
    $token= "360554366:AAGrL2_qhyYGa3pV-we0fbieLt-4jB1oZKc";

    $poets= array(
        'keyboard' =>
            $datas

    );
    $jsonPoets= json_encode($poets);

    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
    file_get_contents($url);
}



function isvalue($table,$field,$username){


    require ('config.php');


    $dbresult=mysqli_query($connection, "SELECT * FROM $table where order_user='$username' and $field!='' and(order_file1='' and order_make_design=0) order by order_id");

    $result=mysqli_fetch_assoc($dbresult);

    if(  $result[$field]!=0 || $result[$field]!=''){

        return true; ;
    }else{ return false;}



}

function create_invoice($user_id_value,$order_total_price,$order_name){

    require ('config.php');
    // require('../users/library/jdf.php');
    $order_submit_date =  date('Y-n-j H:i:s');

    $sql_invoice="INSERT INTO factor ( operator, cash, date_create,date_show, comment,name,family,tell)
					VALUES ( '$user_id_value', '$order_total_price', '$order_submit_date','$order_submit_date', '$order_name','$invoice_name','$invoice_lastname','$invoice_tell')";

    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");
    mysqli_query($connection, "SET character_set_connection = 'utf8'");

    if ($connection->query($sql_invoice) == TRUE) {


        return $invoice_code_value = mysqli_insert_id($connection);}

}

function getprice($user){


    require ('config.php');



    $dbresult=mysqli_query($connection, "SELECT * FROM orders1 where order_user='$user' order by order_id desc");

    $result=mysqli_fetch_assoc($dbresult);

    $order_type=	$result['order_type'];

    $dbresult3=mysqli_query($connection, "SELECT * FROM services WHERE name='$order_type'");
    $row_3 = mysqli_fetch_array($dbresult3);



    if($row_3['price1'] !='0'){
        $bannerp= $row_3['price1']  ;
    }

    $num=	$result['order_lot_quantity'];
    $width= $result['order_width']/100 ;
    $height=	$result['order_height']/100;
    $halghe_n  =  $result['order_make_header_glue'];
    $tuduzi=		$result['order_make_format_beat'] ;

    $calc_meter=$width*$height*$num;
    if($calc_meter<1){$calc_meter=1;}

    $total=($calc_meter)*$bannerp;
    if ($halghe_n>0){$halghe_r=500* $halghe_n;}else{$halghe_r=0;}
    $total+=$halghe_r*$num;


    if($tuduzi=='w'){$tuduzi_r=$width*1500*2;}
    elseif($tuduzi=='h'){$tuduzi_r=$height*1500*2;}
    $total+=$tuduzi_r;
    $total=$total;
    return  $total;

}



$order_name=array();
$dbresult=mysqli_query($connection, "SELECT * FROM services where hide=0 order by name");

while($row = mysqli_fetch_array($dbresult)){
    $order_name[] =  $row['name'];
    $order_name_keyboard[] = array( $row['name']);


}

$order_name_2=array();
$dbresult=mysqli_query($connection, "SELECT * FROM services2 order by id");

while($row = mysqli_fetch_array($dbresult)){
    $order_name_2[] = $row['name'].'.'.$row['p_type'].'.'.$row['color_type'];

}

$order_name_offset=array('کارت ویزیت','تراکت',
    'فاکتور','قبض',
    'پاکت','ست اداری',
    'بروشور','فولدر',
    'پوستر');





if($command == '/start' || $command == 'بازگشت'){
    $dbresult=mysqli_query($connection, "delete from orders1 where order_user='$user' and order_file1='' and order_make_design=0 ");
    $dbresult=mysqli_query($connection, "delete from orders2 where order_user='$user' and order_file1='' and order_make_design=0 ");

    $text= "به چاپ شمیم خوش آمدید";
    $poets= array(
        'keyboard' => array(
            array( 'پیگیری سفارش' , 'ثبت سفارش' ),

            array( 'درباره ما', 'پشتیبانی','تماس با ما' )

        )
    );
    $jsonPoets= json_encode($poets);

    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
    file_get_contents($url);
}

else if($command == 'پیگیری سفارش'){


    $text= "لطفا شماره فاکتور را وارد کنید";

    sendkeyboard(array(array('بازگشت')),$text,$chat_id);
}


else if($command == 'ثبت سفارش'){
    $text= "لطفا یکی از خدمات را انتخاب کنید";
    $poets= array(
        'keyboard' => array(
            array( 'لارج فرمت' ),
            array( 'چاپ کاغذ' )

        )
    );
    $jsonPoets= json_encode($poets);

    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
    file_get_contents($url);
}

else if($command == 'لارج فرمت'){
    $text= "لطفا نوع چاپ را انتخاب کنید";



    $poets= array(
        'keyboard' => $order_name_keyboard
    );
    $jsonPoets= json_encode($poets);

    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
    file_get_contents($url);
}


else if($command == 'چاپ کاغذ' ){
    $text= "لطفا نوع چاپ را انتخاب کنید";



    $poets= array(
        'keyboard' => array(  array('کارت ویزیت','تراکت'),
            array('فاکتور','قبض'),
            array('پاکت','ست اداری'),
            array('بروشور','فولدر'),
            array('پوستر'))
    );
    $jsonPoets= json_encode($poets);

    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
    file_get_contents($url);
}



else  if($command == '/aboutus'){
    $text= "این یک متن درباره ماست";
    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text;
    file_get_contents($url);
}

else  if($command =='پشتیبانی'){
    $text= "با کلیک رو @shamimgraphic با پشتیبانی آنلاین ما ارتباط برقرار کنید";
    $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text;
    file_get_contents($url);
}
else{





    if(isvalue('orders1','order_type',$user)==false && in_array($command,$order_name)){

        $dbresult=mysqli_query($connection, "INSERT INTO orders1 (
							 order_user,
							 order_type) values('$user','$command')");

        $text= urlencode("طول سفارش را وارد کنید
 در فرمت سانتیمتر (مثال: برای 1 متر [100] را وارد کنید)");
        sendkeyboard(array(array('بازگشت')),$text,$chat_id);

    }


    else if (  isvalue('orders1','order_height',$user)==false && isvalue('orders1','order_type',$user)==true){


        if(is_numeric($command)){

            $text= urlencode("عرض سفارش را وارد کنید
  در فرمت سانتیمتر (مثال: برای 1 متر [100] را وارد کنید)");
            $dbresult=mysqli_query($connection, "update  orders1 set order_height='$command' where order_user='$user'");
        }else {
            $text= "برای طول در فرمت سانتیمتر وارد شود";
        }


        sendkeyboard(array(array('بازگشت')),$text,$chat_id);

    }


    else if (  isvalue('orders1','order_width',$user)==false && isvalue('orders1','order_type',$user)==true ){


        if(is_numeric($command)){

            $text=urlencode('تعداد حلقه را وارد کنید.
	  به طور معمول 4 عدد برای 4 گوشه نیاز است
	برای بدون حلقه عدد 0 را وارد کنید.
	');

            $dbresult=mysqli_query($connection, "update orders1 set order_width='$command' where order_user='$user'");
        }else {
            $text= "عرض در فرمت سانتیمتر وارد شود";
        }


        sendkeyboard(array(array('بازگشت')),$text,$chat_id);

    }



    else if (  isvalue('orders1','order_make_header_glue',$user)==false && isvalue('orders1','order_type',$user)==true){


        if(is_numeric($command)){

            $text=urlencode('تعداد سفارش از این نوع را وارد کنید.');

            $dbresult=mysqli_query($connection, "update  orders1 set order_make_header_glue='$command' where order_user='$user' ");






        }else {


            $text= urlencode( 'تعداد حلقه در فرمت عدد وارد شود.
برای سفارش بدون حلقه عدد 0 را وارد کنید

');
        }



        sendkeyboard(array(array('بازگشت')),$text,$chat_id);

    }


    else if (  isvalue('orders1','order_lot_quantity',$user)==false && isvalue('orders1','order_type',$user)==true ){





        if(is_numeric($command) && $command >=1){
            $dbresult=mysqli_query($connection, "update  orders1 set order_lot_quantity=$command where order_user='$user'");


            $text='مبلغ قابل پرداخت: '.number_format(getprice($user)). ' تومان';
            sendkeyboard(array(array('بازگشت')),$text,$chat_id);

            $text= urlencode('یکی از روشها را برای طرح انتخاب کنید');



        }else {
            $text= "برای تعداد حداقل عدد 1 وارد شود";
        }


        sendkeyboard(array(array('طراحی اختصاصی', 'آپلود',  'طرحهای آماده'),array('بازگشت')), $text, $chat_id);

    }


    else if (  isvalue('orders1','order_file1',$user)==false && isvalue('orders1','order_make_design',$user)==false && isvalue('orders1','order_type',$user)==true ) {


        if ($command == 'آپلود') {

            $text = urlencode('فایل خود را  آپلود کنید. (توجه داشته باشید  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید)
             (حداکثر حجم: 20mb در غیر اینصورت از طریق وبسایت: shamimgraphic.ir اقدام فرمایید) 
 ');
            sendkeyboard(array(array('طراحی اختصاصی', 'آپلود',  'طرحهای آماده'),array('بازگشت')), $text, $chat_id);


        }

        elseif($command=='طرحهای آماده'){

            categorymenu(8012);


        }

        elseif($command=='طراحی اختصاصی'){

            $text=urlencode("(هزینه طراحی اختصاصی: 15,000 تومان)
            لطفا تمامی متن طراحی خود را در یک سطر ارسال کنید");
            sendkeyboard(array(array('طراحی اختصاصی', 'آپلود',  'طرحهای آماده'),array('بازگشت')), $text, $chat_id);



        }else {



            $allowedCompressedTypes = array("application/x-rar-compressed", "application/zip", "application/x-zip", "application/x-zip-compressed", 'application/x-rar', 'application/rar', 'application/x-rar-compressed', "image/jpeg", "image/jpg", "image/png", "image/tiff");


            if (!empty($fileidphoto) || in_array($mimtype, $allowedCompressedTypes)) {

                if (!empty($fileid)) {


                    $url = "https://api.telegram.org/bot" . $token . "/getfile?file_id=" . $fileid;

                    $message = file_get_contents($url);

                    $arrayMessage = json_decode($message, true);
                    $filepath = $arrayMessage['result']['file_path'];

                    $file_full_path = "https://api.telegram.org/file/bot" . $token . "/" . $filepath;


                    $info = pathinfo($filepath);


                    if ($file_size < 20000) {

                        $text = urlencode('حجم فایل بیشتر از 20mb میباشد
			لطفا روی @shamimgraphic کلیک کنید و فایل خود را به این نام کاربری ارسال کنید
			');
                        sendkeyboard(array(array('بازگشت')),$text,$chat_id);
                    } else {

                        if (in_array($mimtype, $allowedCompressedTypes)
                        ) {

                            $dbresult = mysqli_query($connection, "SELECT * FROM orders1 where order_user='$user' order by order_id desc");

                            $result = mysqli_fetch_assoc($dbresult);

                            $num_banner = $result['order_lot_quantity'];
                            $width = $result['order_width'];
                            $height = $result['order_height'];
                            $order_id = $result['order_id'];

                            if ($num_banner > 1) {
                                $num_banner = '_NUMS-' . $num_banner;
                            } else {
                                $num_banner = '';
                            }


                            while (file_exists("/users/images/" . $increment . $file_save_name)) {
                                $increment++;
                            }

                            $file_save_name = $increment . 'Size-' . $width . 'X' . $height . '_' . $order_id . $num_banner . '.' . $info['extension'];

                            file_put_contents("/var/www/shamimbanner.ir/users/images/$file_save_name", fopen($file_full_path, 'r'));


                            $file_save_name = "/users/images/$file_save_name";

                            $dbresult = mysqli_query($connection, "update orders1 set order_file1='$file_save_name' where order_user='$user' and order_id='$order_id'");

                            $invoice = create_invoice($user, getprice($user), 'ربات');

                            $dbresult = mysqli_query($connection, "update  orders1 set 	order_invoice_code='$invoice',order_make_number_perforating='$invoice' where order_user='$user' ORDER BY order_id DESC LIMIT 1");

                            $text = urlencode('آپلود با موفقیت انجام شد
			شماره فاکتور: ' . $invoice . '
			مبلغ قابل پرداخت: ' . number_format(getprice($user)) . ' تومان');

                            $poets = json_encode([
                                'inline_keyboard' => [
                                    [
                                        ['text' => "پرداخت", 'url' => 'http://www.shamimbanner.ir/users/payment.php?invoice=' . $invoice]
                                    ]
                                ]
                            ]);
                            $jsonPoets = $poets;

                            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
                            file_get_contents($url);

                        } else {

                            $text = urlencode('فرمت فایل غیر مجاز است
  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید.
  ');

                            sendkeyboard(array(array('بازگشت')),$text,$chat_id);
                        }
                    }


                } else {

                    $text = urlencode('لطفا در فرمت فایل  بفرستید
  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید.
  ');

                    sendkeyboard(array(array('بازگشت')),$text,$chat_id);
                }

            }else{
            $dbresult = mysqli_query($connection, "update orders1 set order_description='$command' and order_make_design=1 where order_user='$user'");


            $invoice = create_invoice($user, getprice($user) + 15000, 'ربات');

            $dbresult = mysqli_query($connection, "update  orders1 set 	order_invoice_code='$invoice',order_make_number_perforating='$invoice' where order_user='$user' ORDER BY order_id DESC LIMIT 1");

            $text = urlencode('
	متن طراحی: ' . $command . '
	
	توضیحات طرح دریافت شد. طرح برای تایید برای شما ارسال خواهد شد.
	لطفا برای انجام پروسه چاپ روی پرداخت کلیک کنید
	
	مبلغ قابل پرداخت: ' . number_format(getprice($user) + 15000) . ' تومان
	
	شماره فاکتور: ' . $invoice);


            $poets = json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "پرداخت", 'url' => 'http://www.shamimbanner.ir/users/payment.php?invoice=' . $invoice]
                    ]
                ]
            ]);
            $jsonPoets = $poets;

            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
            file_get_contents($url);

        }}

    }




    else if(  in_array($command,$order_name_offset)){



        switch ($command) {
            case 'کارت ویزیت':
                $catagory=1;
                break;
            case 'تراکت':
                $catagory=2;
                break;
            case 'فاکتور':
                $catagory=3;
                break;
            case 'قبض':
                $catagory=4;
                break;
            case 'پاکت':
                $catagory=5;
                break;
            case 'ست اداری':
                $catagory=6;
                break;
            case 'بروشور':
                $catagory=7;
                break;
            case 'فولدر':
                $catagory=8;
                break;
            case 'پوستر':
                $catagory=9;
                break;
        }

        $order_service=array();
        $dbresult=mysqli_query($connection, "SELECT * FROM services2 where cat=$catagory group by name");

        while($row = mysqli_fetch_array($dbresult)){
            $order_service[] = array($row['name'].'.'.$row['p_type'].'.'.$row['color_type']);

        }

        $text='نوع کاغذ و اندازه و سایر مشخصات را انتخاب نمایید';
        $poets= array(
            'keyboard' => $order_service
        );
        $jsonPoets= json_encode($poets);

        $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
        file_get_contents($url);


    }else  if(isvalue('orders2','order_type',$user)==false && in_array($command,$order_name_2)){


        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE CONCAT(name,'.',p_type,'.',color_type)='$command'");
        $row_2 = mysqli_fetch_array($dbresult);
        $quantity1 = $row_2['quantity1'];
        $price1=$row_2['price1'];
        $size_w=$row_2['size_w'];
        $size_h=$row_2['size_h'];
        $cat=$row_2['cat'];
        $quantity=array();
        if ($quantity1 != '0') {
            $quantity_text.='تیراژ '. $quantity1.' عدد '.$price1.' تومان
';											 $quantity[]=$quantity1;
        }
        $quantity2 = $row_2['quantity2'];
        $price2=$row_2['price2'];
        if ($quantity2 != '0') {
            $quantity[]=$quantity2;
            $quantity_text.='تیراژ '. $quantity2.' عدد '.$price2.' تومان
';
        }
        $quantity3 = $row_2['quantity3'];
        $price3=$row_2['price3'];
        if ($quantity3 != '0') {
            $quantity[]=$quantity3;
            $quantity_text.='تیراژ '. $quantity3.' عدد '.$price3.' تومان
';
        }
        $quantity4 = $row_2['quantity4'];
        $price4=$row_2['price4'];
        if ($quantity4 != '0') {
            $quantity[]=$quantity4;
            $quantity_text.='تیراژ '. $quantity4.' عدد '.$price4.' تومان
';
        }
        $quantity5 = $row_2['quantity5'];
        $price5=$row_2['price5'];
        if ($quantity5 != '0') {
            $quantity[]=$quantity5;
            $quantity_text.='تیراژ '. $quantity5.' عدد '.$price5.' تومان
';

        }
        $quantity_text.=' 
';
        $quantity_text=urlencode($quantity_text);








        $dbresult=mysqli_query($connection, "INSERT INTO orders2 (
							 order_user,
							 order_type,cat) values('$user','$command','$cat')");

        $text= urlencode("یکی از تیراژ ها را انتخاب کنید");
        sendkeyboard(array(array('بازگشت')),$text,$chat_id);






        $poets= array(
            'keyboard' => array($quantity,array('بازگشت'))
        );
        $jsonPoets= json_encode($poets);

        $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$quantity_text."&reply_markup=".$jsonPoets;
        file_get_contents($url);






    }  else if (  isvalue('orders2','order_quantity',$user)==false  && isvalue('orders2','order_type',$user)==true ){

        $quantity=array();
        $dbresult=mysqli_query($connection, "SELECT order_type FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];

        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE CONCAT(name,'.',p_type,'.',color_type)='$row_order_type'");
        $row_2 = mysqli_fetch_array($dbresult);
        if ($row_2['quantity1'] != '0') {
            $quantity[]=   $row_2['quantity1'];}
        if ($row_2['quantity2'] != '0') {
            $quantity[]=   $row_2['quantity2'];}
        if ($row_2['quantity3'] != '0') {
            $quantity[]=   $row_2['quantity3'];}
        if ($row_2['quantity4'] != '0') {
            $quantity[]=   $row_2['quantity4'];}
        if ($row_2['quantity5'] != '0') {
            $quantity[]=   $row_2['quantity5'];}


        if( in_array($command,$quantity)){

            $work_time_text=$row_2['work_time_text'];
            $size_h=$row_2['size_h'];
            $size_w=$row_2['size_w'];
            $cat=$row_2['cat'];
            $print_type=$row_2['print_type'];
            if(!empty($work_time_text)){$work_time_comment='مدت زمان پروسه چاپ: '.$work_time_text.'
';};
            if(!empty($size_h) && !empty($size_w)){$work_size_comment='اندازه: '.$size_h.'X'.$size_w.'
';};
            if(empty($print_type) || $print_type<2){$work_price=15000;}else{$work_price=30000;$work_price_text=' برای دو رو';};

            $text=urlencode($work_time_comment.$work_size_comment);
            sendkeyboard(array(array('بازگشت')),$text,$chat_id);

            if ($cat==2){
                $text=urlencode('فوری یا غیر فوری بودن سفارش را انتخاب کنید.
 در صورت فوری بودن مبلغ 60,000 تومان به سفارش اضافه میشود (1 الی 2 روز کاری)');
                sendkeyboard(array(array('فوری','غیر فوری'),array('بازگشت')),$text,$chat_id);

            }else{
                $text=urlencode('فایل خود را  آپلود کنید. (توجه داشته باشید  در تلگرام فرمت عکس قابل قبول نیست. از طریق دکمه فایل بفرستید. حداکثر حجم: 20mb )

برای طراحی متن توضیحات را وارد کنید. (هزینه طراحی: '.$work_price.' تومان'.$work_price_text.')');
                sendkeyboard(array(array('بازگشت')),$text,$chat_id);
            }

            $dbresult=mysqli_query($connection, "update  orders2 set order_quantity='$command' where order_user='$user' ");






        }else {


            $text= urlencode( 'یکی از تیراژ های بالا را وارد کنید');

            $poets= array(
                'keyboard' => array($quantity,array('بازگشت'))
            );
            $jsonPoets= json_encode($poets);

            $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
            file_get_contents($url);
        }




    }


    else if (  $command=='فوری'  && isvalue('orders2','order_type',$user)==true ){


        $dbresult=mysqli_query($connection, "update  orders2 set 	fast_deliver='on' where order_user='$user' ");

        $dbresult=mysqli_query($connection, "SELECT order_type,order_quantity FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];


        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE name='$row_order_type'");
        $row_2 = mysqli_fetch_array($dbresult);






        $text= urlencode('یکی از روشها را برای طرح انتخاب کنید');
        sendkeyboard(array(array('طراحی اختصاصی', 'آپلود',  'طرحهای آماده'),array('بازگشت')), $text, $chat_id);



    }


    else if ( $command=='ثبت و پرداخت' ){



        $dbresult=mysqli_query($connection, "SELECT order_total_price FROM orders2 WHERE order_user='$user'  ORDER BY order_id DESC LIMIT 1");
        $row_type = mysqli_fetch_array($dbresult);
        $order_total_price=$row_type['order_total_price'];


        $invoice=create_invoice($user,$order_total_price,'ربات');
        $dbresult=mysqli_query($connection, "update  orders2 set 	order_invoice_code='$invoice',factor='$invoice' where order_user='$user' ORDER BY order_id DESC LIMIT 1");
        $text=urlencode('سفارش با موفقیت ثبت شد');
        sendkeyboard(array(array('بازگشت')),$text,$chat_id);


        $text=urlencode('شماره فاکتور: '.  $invoice.'
			مبلغ قابل پرداخت: '.number_format($order_total_price). ' تومان');

        $poets=   json_encode([
            'inline_keyboard'=>[
                [
                    ['text'=>"پرداخت",'url'=>'http://www.shamimbanner.ir/users/payment.php?invoice='.$invoice]
                ]
            ]
        ]);
        $jsonPoets= $poets;

        $url= "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$text."&reply_markup=".$jsonPoets;
        file_get_contents($url);


    }





    else if (  isvalue('orders2','order_file1',$user)==false && isvalue('orders2','order_make_design',$user)==false && isvalue('orders2','order_type',$user)==true ){

        $dbresult=mysqli_query($connection, "SELECT order_type,order_quantity,fast_deliver FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];
        $quantity=$row_type['order_quantity'];
        $fast_deliver=$row_type['fast_deliver'];

        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE name='$row_order_type'");
        $row_price = mysqli_fetch_array($dbresult);
        if($quantity== $row_price['quantity1']){$price=$row_price['price1'];}
        if($quantity== $row_price['quantity2']){$price=$row_price['price2'];}
        if($quantity== $row_price['quantity3']){$price=$row_price['price3'];}
        if($quantity== $row_price['quantity4']){$price=$row_price['price4'];}
        if($quantity== $row_price['quantity5']){$price=$row_price['price5'];}

        $print_type=$row_price['print_type'];

        if($print_type>1){$make_deisgn=2;}else{$make_deisgn=1;}
        if($fast_deliver=='on'){$fast_price=70000;}else{$fast_price=0;}
        $price+=$fast_price;
        $price=uploadphoto($user,$chat_id,$token,$fileid,$fileidphoto,$mimtype,$file_size,'orders2','order_file1',$price,$make_deisgn,$command);

        $dbresult=mysqli_query($connection, "update  orders2 set 	order_total_price='$price' where order_user='$user' ORDER BY order_id DESC LIMIT 1");





    }




    else if (  isvalue('orders2','order_file2',$user)==false && isvalue('orders2','order_make_design',$user)==false && isvalue('orders2','order_type',$user)==true ){

        $dbresult=mysqli_query($connection, "SELECT order_type FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];
        $quantity=$row_type['order_quantity'];
        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE name='$row_order_type'");
        if($quantity= $row_2['quantity1']){$price=$row_2['price1'];}
        if($quantity= $row_2['quantity2']){$price=$row_2['price2'];}
        if($quantity= $row_2['quantity3']){$price=$row_2['price3'];}
        if($quantity= $row_2['quantity4']){$price=$row_2['price4'];}
        if($quantity= $row_2['quantity5']){$price=$row_2['price5'];}

        $print_type=$row_2['print_type'];

        if($print_type>1){$make_deisgn=2;$make_design_price=30000;}else{$make_deisgn=1;$make_design_price=15000;}

        $price=uploadphoto($user,$chat_id,$token,$fileid,$fileidphoto,$mimtype,$file_size,'orders2','order_file2',$price,$make_deisgn,$command);

        $dbresult=mysqli_query($connection, "update  orders2 set 	order_total_price='$price' where order_user='$user' ");




    }


    else if (  isvalue('orders2','order_file3',$user)==false && isvalue('orders2','order_make_design',$user)==false && isvalue('orders2','order_type',$user)==true ){

        $dbresult=mysqli_query($connection, "SELECT order_type FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];
        $quantity=$row_type['order_quantity'];
        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE name='$row_order_type'");
        if($quantity= $row_2['quantity1']){$price=$row_2['price1'];}
        if($quantity= $row_2['quantity2']){$price=$row_2['price2'];}
        if($quantity= $row_2['quantity3']){$price=$row_2['price3'];}
        if($quantity= $row_2['quantity4']){$price=$row_2['price4'];}
        if($quantity= $row_2['quantity5']){$price=$row_2['price5'];}

        $print_type=$row_2['print_type'];

        if($print_type>1){$make_deisgn=2;$make_design_price=30000;}else{$make_deisgn=1;$make_design_price=15000;}

        $price=uploadphoto($user,$chat_id,$token,$fileid,$fileidphoto,$mimtype,$file_size,'orders2','order_file3',$price,$make_deisgn,$command);

        $dbresult=mysqli_query($connection, "update  orders2 set 	order_total_price='$price' where order_user='$user' ");




    }



    else if (  isvalue('orders2','order_file4',$user)==false && isvalue('orders2','order_make_design',$user)==false && isvalue('orders2','order_type',$user)==true ){

        $dbresult=mysqli_query($connection, "SELECT order_type,order_quantity FROM orders2 WHERE order_user='$user' and order_file1='' and order_make_design=0 ");
        $row_type = mysqli_fetch_array($dbresult);
        $row_order_type=$row_type['order_type'];
        $quantity=$row_type['order_quantity'];
        $dbresult=mysqli_query($connection, "SELECT * FROM services2 WHERE name='$row_order_type'");
        if($quantity== $row_2['quantity1']){$price=$row_2['price1'];}
        if($quantity== $row_2['quantity2']){$price=$row_2['price2'];}
        if($quantity== $row_2['quantity3']){$price=$row_2['price3'];}
        if($quantity== $row_2['quantity4']){$price=$row_2['price4'];}
        if($quantity== $row_2['quantity5']){$price=$row_2['price5'];}

        $print_type=$row_2['print_type'];

        if($print_type>1){$make_deisgn=2;$make_design_price=30000;}else{$make_deisgn=1;$make_design_price=15000;}

        uploadphoto($user,$chat_id,$token,$fileid,$fileidphoto,$mimtype,$file_size,'orders2','order_file4',$price,$make_deisgn,$command);

        $dbresult=mysqli_query($connection, "update  orders2 set 	order_total_price='$price' where order_user='$user' ");




    }



    else if (   ($command/10000)>=1 ){

        $dbresult=mysqli_query($connection, " 
		 SELECT  order_last_status   from orders2 where order_invoice_code='$command' 
		 UNION ALL
		 SELECT  order_last_status   from orders1 where order_invoice_code='$command' 
		");
        $row_type = mysqli_fetch_array($dbresult);
        $sql_order_last_status=$row_type['order_last_status'];
        if ($sql_order_last_status == '0') {
            $sql_order_ls = 'در انتظار پرداخت فاکتور';

        }
        elseif ($sql_order_last_status == '1') {
            $sql_order_ls = 'در انتظار بررسی';

        }
        elseif ($sql_order_last_status == '2') {
            $sql_order_ls = 'پروسه چاپ';

        }
        elseif ($sql_order_last_status == '3') {
            $sql_order_ls = 'آماده تحویل';

        }
        elseif ($sql_order_last_status == '4') {
            $sql_order_ls = 'تحویل داده شده';

        }
        elseif ($sql_order_last_status == '5') {
            $sql_order_ls = 'تعلیق کار';

        }
        elseif ($sql_order_last_status == '6') {
            $sql_order_ls = 'کنسل شد';

        }
        elseif ($sql_order_last_status == '7') {
            $sql_order_ls = 'تحویل شرکت';

        }
        elseif ($sql_order_last_status == '8') {
            $sql_order_ls = 'تحویل مشتری';

        }

        elseif ($sql_order_last_status== '9') {
            $sql_order_ls = 'تعلیق کار';

        }
        elseif ($sql_order_last_status == '10') {
            $sql_order_ls = 'تحویل چاپخانه';

        }
        elseif ($sql_order_last_status == '11') {
            $sql_order_ls = 'ویرایش';

        }

        else{
            $sql_order_ls = 'نامشخص';
        }

        if ($sql_order_last_status == '0') {


            $dbresult=mysqli_query($connection, "SELECT cash FROM factor WHERE operator='$user' and id='$command'  ORDER BY id DESC LIMIT 1");
            $row_type = mysqli_fetch_array($dbresult);
            $order_total_price=$row_type['cash'];

            $text = urlencode('وضعیت سفارش شما : ' . $sql_order_ls .
                '
                شماره فاکتور: ' . $command . '
			مبلغ قابل پرداخت: ' . number_format($order_total_price) . ' تومان');

            $poets = json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "پرداخت", 'url' => 'http://www.shamimbanner.ir/users/payment.php?invoice=' . $command]
                    ]
                ]
            ]);
            $jsonPoets = $poets;

            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $jsonPoets;
            file_get_contents($url);

        }else {

            $text = urlencode('وضعیت سفارش شما : ' . $sql_order_ls);
            sendkeyboard(array(array('بازگشت')),$text,$chat_id);
        }
    }

}



?>