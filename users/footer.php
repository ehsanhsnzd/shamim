	<footer>
		<div id="footer-top-section">
			<div id="footer-max-width">
				<aside id="footer-quick-access">
					<h3>دسترسی سریع</h3>
					<ul>
                        <li><a href=" ">صفحه نخست</a></li>
                        <li><a href=" /fee.php">تعرفه خدمات</a></li>
                        <li><a href=" /termofservices.php">قوانین و مقررات</a></li>
                        <li><a href=" /contact-us.php">تماس با ما</a></li>
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
   				آدرس: تبریز - سه راهی فرودگاه ، جاده سنتو به طرف راه آهن روبروی اولین پمپ گاز
						<hr/>
						تلفن: 35577927-041<br/>
						ایمیل: shamimtable@gmail.com
					</p>
				</aside>


		<?		$host = $_SERVER['HTTP_HOST'];
		 	 if($host == "www.shamimgraphic.ir" or $host == "shamimgraphic.ir") {
		 		 $site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="rYa7KD1Bt1AQbc19">';
		 	 }else{
		 		 $site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="SiyELsfX6ozHQRDI">';
		 	 } echo $site_enamad;?>

        	</div>
		</div>
		<div id="footer-bottom-section">

                <div id="footer-bottom-center">


                  <div style="font-size:9px" align="center">کپی رایت  | تمامی حقوق متعلق به کانون تبلیغاتی و چاپخانه شمیم</div><div id="footer-bottom-max-width">  <div id="footer-bottom-left"> <a href="<?php echo $site_root_adress; ?>"><img src="library/images/logo.png"></a>
                </div>
                </div>




            </div>
		</div>
	</footer>


</html>
