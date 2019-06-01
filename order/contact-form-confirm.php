<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>ارسال فرم...</title>
    <style>
        body{
            direction: rtl;
            padding: 2em;
            background: #f7f7f7;
        }
        #sent{
            font-size: 1.1em;
            color: #0f0;
            text-align: center;
        }
        #wrong{
            font-size: 1.1em;
            color: #f00;
            text-align: center;
        }
    </style>
</head>
    <body>
<?php

if(isset($_POST['submit'])){
    echo $_POST['name'];
    echo $_POST['subject'];
    echo $_POST['email'];
    echo $_POST['message'];
    if(isset($_POST['name']) && $_POST['name'] != '' 
    && isset($_POST['email']) && $_POST['email'] != '' 
    && isset($_POST['subject']) && $_POST['subject'] != '' 
    && isset($_POST['message']) && $_POST['message'] != ''){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        mail ( 'shamimtable@gmail.com' , $subject , "از طرف:".$name."<br/>".$message , "from:".$email );
        echo "<span id=\"sent\">پیام شما فرستاده شد.<br/>در حال انتقال به صفحه مبدا...</span>";
            
	   parse_str($_SERVER['QUERY_STRING']);
        
        if(isset($url)){
            ?><SCRIPT language="JavaScript">
              function Go2NewUrl(){
                  top.location="<?php echo $url; ?>";
              }
              if (top.frames.length==0){
                  setTimeout('Go2NewUrl()',50000);
              }
            </SCRIPT><?php
        }
    }
    else{
        echo "<span id=\"wrong\">به نظر می رسد فیلد های فرم ناقص پر شده است.</span>";
    }
}
else{
    echo "<span id=\"wrong\">به نظر می رسد اشتباهی وارد این صفحه شده اید!</span>";
}
?>

    </body>
</html>