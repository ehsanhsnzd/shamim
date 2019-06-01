<aside>
	<ul>
    

		
		 <? if ($_SESSION['print_admin_name']=='mousavi' || $_SESSION['print_admin_name']=='support'){ ?>       <a href="../admin"><li><span class="aside-home-icon"></span>صفحه اصلی پنل مدیریت</li></a>
             <a href="orders.php"><li><span class="aside-orders-icon"></span>لیست سفارشات بنر</li></a>
        
          <? } ?>
          
           <? if ($_SESSION['print_admin_name']=='mousavi'){ ?>       
        
             <a href="users_view.php"><li><span class="aside-users-icon"></span>لیست کاربران</li></a>
               <a href="orders-offset.php"><li><span class="aside-orders-icon"></span>لیست سفارشات افست</li></a>
          <? } ?>
          
            <? if ($_SESSION['print_admin_name']=='hekmat'){ ?>       
        
            
               <a href="orders-offset.php"><li><span class="aside-orders-icon"></span>لیست سفارشات افست</li></a>
          <? } ?>
         
        
      <? if ($_SESSION['print_admin_name']=='support'){ ?>  
      
      
      	<a href="orders-graphic.php"><li><span class="aside-orders-icon"></span>لیست سفارشات کاغذ</li></a>
        
     	<a href="orders-accessories.php"><li><span class="aside-orders-icon"></span>لیست سفارشات تجهیزات</li></a>
            <? } ?>
         <? if ($_SESSION['print_admin_name']=='mousavi' || $_SESSION['print_admin_name']=='riso'  || $_SESSION['print_admin_name']=='support'){ ?>       
        <a href="orders-riso.php"><li><span class="aside-orders-icon"></span>لیست سفارشات ریسو</li></a>
        <a href="delivery-requests.php"><li><span class="aside-delivery-icon"></span>درخواست های ارسال</li></a>
        <? } ?>
         <? if ($_SESSION['print_admin_name']=='support'){ ?>  
    <a href="orders-send.php"><li><span class="aside-orders-icon"></span>لیست ارسال چاپ</li></a>
        
 
		
        <a href="services-list.php"><li><span class="aside-editservices-icon"></span>ویرایش خدمات بنر</li></a>
		<a href="add-service.php"><li><span class="aside-addservice-icon"></span>افزودن خدمات بنر</li></a>
		<a href="services-list-graphic.php"><li><span class="aside-editservices-icon"></span>ویرایش خدمات افست</li></a>
        		<a href="add-service-graphic.php"><li><span class="aside-addservice-icon"></span>افزودن خدمات افست</li></a>
				<a href="services-list-accessories.php"><li><span class="aside-editservices-icon"></span>ویرایش خدمات تجهیزات</li></a>
        		<a href="add-service-accessories.php"><li><span class="aside-addservice-icon"></span>افزودن خدمات تجهیزات</li></a>
		
		<a href="financial.php"><li><span class="aside-financial-icon"></span>لیست فاکتور ها</li></a>
        <a href="financial_mellat.php"><li><span class="aside-financial-icon"></span>لیست پرداخت ملت</li></a>
        <a href="report_credit.php"><li><span class="aside-financial-icon"></span>گزارش مالی</li></a>
       <a href="financial_company.php"><li><span class="aside-financial-icon"></span>فاکتور های شرکت</li></a>
		<a href="users.php"><li><span class="aside-users-icon"></span>لیست کاربران</li></a>
        	<a href="../members/signup.php"><li><span class="aside-users-icon"></span>افزودن کاربر</li></a>
             	<a href="calc.php"><li><span class="aside-users-icon"></span>حساب افست</li></a>
		<a href="setting.php"><li><span class="aside-setting-icon"></span>تنظیمات سایت</li></a>           
        	<a href="filemanager"><li><span class="aside-setting-icon"></span>مدیریت فایل ها</li></a>
             <a href="sms.php"><li><span class="aside-setting-icon"></span>پنل اس ام اس</li></a>
                <? }?>  
                 <? if ($_SESSION['print_admin_name']=='delivery' ){ ?>       
                <a href="financial_company.php"><li><span class="aside-financial-icon"></span>فاکتور های شرکت</li></a>
               
          <? } ?> 
	</ul>
</aside> 