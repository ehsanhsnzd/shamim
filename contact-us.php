 <?php require('header.php'); ?>

    
    <article class="page-sheet">
        <h3>تماس با ما</h3>
        <p>
آدرس: تبریز - سه راهی فرودگاه ، جاده سنتو به طرف راه آهن روبروی اولین پمپ گاز
            <br/>
تلفن: 35577927-041
            <br/>
ایمیل: shamimtable@gmail.com
      <hr/>
					<form id="contact-page-form" action="users/contact-form-confirm.php?url=<?php $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";echo($fullurl); ?>" method="post">
						<input type="text" name="name" placeholder="نام و نام خانوادگی*" required><br/>
						<input type="email" name="email" placeholder="آدرس ایمیل*" required><br/>
						<input type="text" name="subject" placeholder="موضوع پیام*" requird><br/>
						<textarea name="message" id="message" placeholder="متن پیام...*" required></textarea><br/>
						<input type="submit" name="submit" value="ارسال پیام">
					</form>
        </p>
    </article>
    

<?php require('footer.php'); ?>