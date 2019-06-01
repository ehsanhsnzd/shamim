<header style="background-color:#666"><div class="header-maxwidth" ><?php require('../config.php'); ?>
			<a href=" /users/"><img src="../users/library/images/logo.png"></a>
		    <div class="navacc"  >
  <nav >
				<ul  class="content clearfix" style="background-color:#666;">


					<li><a href="../">صفحه نخست</a></li>
                    <li><a href="../fee.php">تعرفه </a></li>
                    <li>
                       <a href="../users/help.php">    راهنمای طرح </a>
                </li>
					<li><a href="../about-us.php" id=" #order-progress-div">درباره ما</a></li>
					<li><a href="../contact-us.php">تماس با ما</a></li>

                          <li class="dropdown">

                   <div style="background-color:#11BC39; padding:4px 4px 4px 4px ; color:#FFF">
            حساب کاربری :

             <?



$user_id_value= $_SESSION['people_login'];
					 $useremail=mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved");

			$blnc=	mysqli_fetch_assoc($useremail);
			 echo  	number_format( $blnc['balance']);
				$offer=$blnc['offer'];



				 ?> تومان
              </div>

          </li>
				</ul>
		</nav></div>

<br /><br />







    <div class="navlist">
  <nav>
              <ul class="content clearfix">
                <li><a href="../users/">پنل کاربری</a></li>
                 <?   if (preg_match('/shamim/',$user_id_value)){?>
                     <li class="dropdown">   <a href="#">ایجاد فاکتور</a>
                         <ul class="sub-menu">
                   <li><a href="../users/new_factor.php">افزودن فاکتور</a></li>
                             <li><a href="../users/financial_company.php">فاکتور ها</a></li>
                   </ul>
                     </li>
                 <? }?>

                 <li class="dropdown">
                 <a href="#">افزودن سفارش</a>
                    <ul class="sub-menu">




                <li  class="dropdown_sec"><a href="../users/new-order-graphic.php?quantity=1th&lot=1">سفارش چاپ کاغذ</a>

                  <ul class="sub-menu">
                   <li class="dropdown"><a href="new-order-graphic.php?catagory=1&quantity=1th&lot=1">کارت ویزیت</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=1&p_type=عمومی&quantity=1th&lot=1">عمومی</a></li>
                   <li><a href="new-order-graphic.php?catagory=1&p_type=فانتزی&quantity=1th&lot=1">فانتزی</a></li>
                   <li><a href="new-order-graphic.php?catagory=1&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=2&quantity=1th&lot=1">تراکت</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=2&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=2&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=2&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=3&quantity=1th&lot=1">فاکتور</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=3&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=3&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=3&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=4&quantity=1th&lot=1">قبض</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=4&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=4&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=4&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=5&quantity=1th&lot=1">پاکت</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=5&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=5&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=5&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=6&quantity=1th&lot=1">ست اداری</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=6&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=6&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=6&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=7&quantity=1th&lot=1">بروشور</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=7&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=7&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=7&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=8&quantity=1th&lot=1">فولدر</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=8&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=8&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=8&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

                    <li class="dropdown"><a href="http://shamimgraphic.ir/users/new-order-graphic.php?catagory=9&quantity=1th&lot=1">پوستر</a>
                   <ul class="sub-menu">
                   <li><a href="new-order-graphic.php?catagory=9&p_type=افست&quantity=1th&lot=1">افست</a></li>
                   <li><a href="new-order-graphic.php?catagory=9&p_type=ریسو&quantity=1th&lot=1">ریسو</a></li>
                   <li><a href="new-order-graphic.php?catagory=9&p_type=دیجیتال&quantity=1th&lot=1">دیجیتال</a></li>
             		</ul>
                   </li>

              </ul>
                </li>
                     <li>  <a href="../users/new-order.php?service=32&quantity=1th&lot=1">سفارش بنر لارج فرمت</a></li>



                <li><a href="../users/new-order-accessories.php?quantity=1th&lot=1"> سفارش ملزومات تبلیغاتی
</a></li>


                </ul>
                </li>
                <li class="dropdown"><a href="#">لیست سفارشات</a>


                  <ul class="sub-menu">
           <li class="dropdown">

               <li><a href="../users/orders-graphic.php">سفارشات چاپ کاغذ</a></li>
    		    <li><a href="../users/orders.php">سفارشات بنر لارج فرمت</a></li>


                  <li><a href="../users/orders-accessories.php"> سفارشات ملزومات تبلیغاتی
 </a></li>
                </ul>

                </li>
           <?   if (!preg_match('/shamim/',$user_id_value)){?>     <li><a href="../users/financial.php">لیست فاکتور ها</a></li>
           <? } ?>

                 <li class="dropdown">
                <a href="#"> کاربری</a>
                <ul class="sub-menu">

                 <li><a href="../members/profile_about.php">پروفایل کاربری</a></li>

             </ul>
             </li>

              <li class="dropdown">
                <a href="../users/report.php"> گزارش مالی</a>
                <ul class="sub-menu">

                 <li><a href="../users/report.php">گزارش مالی</a></li>
   <li><a href="payment.php">افزایش اعتبار</a>			 		    </li>
             </ul>
             </li>

                <li class="dropdown">
                <a href="#">ارسال سفارشات</a>
                <ul class="sub-menu">
                <li><a href="../users/delivery-request.php">درخواست ارسال مرسوله</a>



                </li>

                <li><a href="../users/delivery-requests-list.php">لیست درخواست های ارسال</a></li>



             </ul>
             </li>




             <li><a href="../users/login.php?logout=true">خروج </a></li>

             </ul>
             </nav>
           </div>

</header>
