	<footer><?php require('../config.php'); ?>
		<div id="footer-top-section">
			<div id="footer-max-width">
				<aside id="footer-quick-access">
					<h3>دسترسی سریع</h3>
					<ul>
                        <li><a href=" ">صفحه نخست</a></li>
                        <li><a href=" /price-list.php">تعرفه خدمات</a></li>
                        <li><a href=" /guild-files.php">فایل های راهنما</a></li>
                        <li><a href=" /termofservices.php">قوانین و مقررات</a></li>
                        <li><a href=" /contactus.php">تماس با ما</a></li>
					</ul>
				</aside>

				<aside id="footer-panel-links">
					<h3>پنل کاربران</h3>
					<ul>
						<li><a href=" /users">صفحه نخست پنل کاربری</a></li>
						<li><a href=" /users/login.php">ورود به پنل کاربری</a></li>
						<li><a href="members/signup.php">ثبت نام در پنل کاربران</a></li>
						<li><a href=" /users/password-reset.php">بازیابی گذرواژه فراموش شده</a></li>
						<li><a href=" /guild-files.php">راهنمای استفاده از پنل کاربری</a></li>
					</ul>
				</aside>

				<aside id="footer-contact-form">
					<h3>تماس با ما</h3>
					<form id="footer-contact-form" action="users/contact-form-confirm.php?url=<?php $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";echo($fullurl); ?>" method="post">
						<input type="text" name="name" placeholder="نام و نام خانوادگی*" required>
						<input type="email" name="email" placeholder="آدرس ایمیل*" required>
						<input type="text" name="subject" placeholder="موضوع پیام*" requird>
						<textarea name="message" id="message" placeholder="متن پیام...*" required></textarea>
						<input type="submit" name="submit" value="ارسال پیام">
					</form>
				</aside>

				<aside id="footer-contact-info">
					<h3>مشخصات تماس</h3>
					<p>
   					آدرس: تبریز - میدان ساعت، روبروی پاساژ بهارستان، کوچه شهید ختایی           
						<hr/>
						تلفن: 35577927-041<br/>
						ایمیل: info@shamim14.ir
					</p>
				</aside>
                
                 <img id='hwlaxlapnbpebrgwwmcs' style='cursor:pointer' onclick='window.open("https://trustseal.enamad.ir/Verify.aspx?id=43268&p=odshfuixwkynhwmbaqgw", "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30")' alt='' src='https://trustseal.enamad.ir/logo.aspx?id=43268&p=aodsvjymqesgkzoeukaq'/>
			</div>
		</div>
		<div id="footer-bottom-section">
			<div id="footer-bottom-max-width">
                <div id="footer-bottom-right">		
                  <div>کپی رایت 1395| تمامی حقوق متعلق به کانون تبلیغاتی و چاپخانه شمیم<br/><a href="http://www.shamimwebdesign.ir/" title="طراحی سایت">طراحی و توسعه</a>: <a href="http://www.shamimwebdesign.ir/" title="طراحی وب سایت">شمیم وب دیزاین</a></div>
                </div>   <div id="footer-bottom-left"> 
                <a href="<?php echo $site_root_adress; ?>"><img src="library/images/logo.png"></a>
                </div>
                
            
            </div>
		</div>
	</footer>


</html>