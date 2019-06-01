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
			
			
			
			
			
			
?>



        <section id="user-panel-sheet">
 
        <h2 class="user-panel-sheet-h2">ایجاد فاکتور</h2>
        <table><td>
                 <form class="new-order" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post" >
                  <div style="display:inline-block; vertical-align:top">        <div id="order-form-type-div">
                   <div class="input_align">    نام :   </div>         
                         
                         
                          <div class="input_align">    <input type="text" name="name" id="upload-div-order-lot-quantity"    required></div>
                          
                         <br>
                         
                           <div class="input_align"> نام خانوادگی :   </div> 
  
    <div class="input_align">     <input type="text" name="family" id="upload-div-order-lot-quantity"    required>
                   </div>
            <br>
              <div class="input_align">  شماره تماس :    </div> 
         <div class="input_align">    <input name="tell" id="upload-div-order-lot-quantity"    required type="number"></div>
                         <br>
   
                                   
                               
                        <input type="submit" name="submit" value="ثبت و ادامه">
                </form>
          </td><td width="500" align="center" valign="top">
                <?
                
				if (isset($_POST['submit'])){
					
				$name=$_POST['name'];
				$family=$_POST['family'];
				$tell=$_POST['tell'];
				$operator=$_SESSION['print_username'];
				
				$order_submit_date =    date('Y-m-d H:i:s');
				
                	$sql_invoice = "INSERT INTO factor ( name, family,tell,date_create,date_show,operator)
					VALUES ( '$name', '$family','$tell','$order_submit_date','$order_submit_date','$operator')";

					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");
					
					if ($connection->query($sql_invoice) == TRUE) {
						 
						
 $invoice_code_value = mysqli_insert_id($connection);
  ?>
<br>اضافه کردن سفارش
<br>
<br>

   <div >
      <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$invoice_code_value?>">بنر</a>
      <a class="print-button" href="new-order-graphic.php?factor=<?=$invoice_code_value?>">فرم عمومی</a>
      <a class="print-button" href="new-order-accessories.php?factor=<?=$invoice_code_value?>">  طراحی و ...</a>
      </div>

  <?
					}}?>
   </td></table>
        </section>


   
  
<?php include ("footer.php");?>
