<?php require('header.php');

	require ('config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
			mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");
 

 






 ?>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
 <div style="width:500px">
  <h2 class="itemTitle">
	  	انتقادات و پیشنهادات  	
	  </h2>
    <br>
<br>
<br>
<br>

 <form action="<?= $_SERVER['PHP_SELF'] ?>" name="reviews" id="chronoform_reviews" method="post" class="Chronoform"><div class="ccms_form_element cfdiv_text" id="input_text_21_container_div" style="">
 <table ><tr><td>
 <label>نام / نام خانوادگی</label></td><td><input maxlength="50" size="30" class=" validate['required']" title="" type="text" value="" name="input_text_2" /></td></tr><tr><td>
 <label>شماره تماس</label>
     </td><td>
  <input maxlength="18" size="30" class=" validate['required']" title="" type="text" value="" name="input_text_3" /></td></tr><tr>
  <td>
 <label>نام شرکت</label>
      </td><td><input maxlength="150" size="30" class="" title="" type="text" value="" name="input_company" /></td>
  </tr><tr>
 <td><label>ایمیل</label></td><td><input maxlength="40" size="30" class=" validate['required','email']" title="" type="text" value="" name="input_text_4" /></td></tr>
 <tr>
 <td><label>نشانی</label>   </td><td><input maxlength="150" size="30" class="" title="" type="text" value="" name="input_address" /></td></tr><tr><td><label>موضوع</label>  </td><td><input maxlength="50" size="30" class=" validate['required']" title="" type="text" value="" name="input_text_5" /></td>
 </tr>
 <tr>
 <td>
 <label>انتقاد یا پیشنهاد</label></td><td><textarea cols="30" rows="7" class=" validate['required']" title="" name="input_textarea_6"></textarea></td><td valign="bottom"></td></tr>
 <tr>
 <td><input name="submit" class="" value="ارسال" type="submit" /></td>
 </tr>
 </table>
 </form>
<br>
<br>
<br>
 </div>
 </center>

<?php if( isset($_POST['submit'])){ 
$name=	$_POST['input_text_2'];
$tel=	$_POST['input_text_3'];
$company=	$_POST['input_company'];
$mail=	$_POST['input_text_4'];
$address=	$_POST['input_address'];
$subject=	$_POST['input_text_5'];
$text=	$_POST['input_textarea_6'];
	
	
							if(! mysqli_query($connection, "insert into report(name,tel,email,address,subject,company,text) values('$name','$tel','$mail','$address','$subject','$company','$text')"))echo mysqli_error($connection);
	
	} 
	
	
	require('footer.php'); ?>