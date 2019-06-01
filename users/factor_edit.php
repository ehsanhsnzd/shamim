<?php require ("header.php");?>
<?php include ("sidebar.php");
	parse_str($_SERVER['QUERY_STRING']);

	require ('../config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
			mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");
			
					if (isset($_POST['submit'])){
					
				$name=$_POST['name'];
				$family=$_POST['family'];
				$tell=$_POST['tell'];
				$operator=$_SESSION['print_username'];
				
				$order_submit_date =  jdate('Y-n-j H:i:s');
				
                	$sql_invoice = "update factor set name='$name', family='$family',tell='$tell' where id =$invoiceID ";

					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");
					
					if ($connection->query($sql_invoice) == TRUE) {
						 
						
}}
			
			 $invoice_code_value = $invoiceID;
			
			   $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where id=$invoiceID");
			$od_invoice=mysqli_fetch_assoc($sql_invoices_of_user);
			$name=$od_invoice['name'];
			$family=$od_invoice['family'];
			$tell=$od_invoice['tell'];
?>



        <section id="user-panel-sheet">
 
        <h2 class="user-panel-sheet-h2">ایجاد فاکتور</h2>
        <table><td>
                 <form class="new-order" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>?invoiceID=<?=$invoiceID?>" method="post" >
                  <div style="display:inline-block; vertical-align:top">        <div id="order-form-type-div">
                   <div class="input_align">    نام :   </div>         
                         
                         
                          <div class="input_align">    <input type="text" name="name" id="upload-div-order-lot-quantity" value="<?=$name?>"  required></div>
                          
                         <br>
                         
                           <div class="input_align"> نام خانوادگی :   </div> 
  
    <div class="input_align">      <input type="text" name="family" id="upload-div-order-lot-quantity"  value="<?=$family?>"  required>
                   </div>
            <br>
              <div class="input_align">  شماره تماس :    </div> 
         <div class="input_align">    <input name="tell" id="upload-div-order-lot-quantity"   value="<?=$tell?>"  required ></div>
                         <br>
   
                                   
                               
                        <input type="submit" name="submit" value="ثبت و ویرایش">
                </form>
          </td><td width="500" align="center" valign="top">
 
  <br>اضافه کردن سفارش
<br>
<br>

   <div >
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$invoice_code_value?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$invoice_code_value?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$invoice_code_value?>">  طراحی و ...</a>
      </div>


   </td></table>
        </section>


   
  
<?php include ("footer.php");?>