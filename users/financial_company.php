<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-sheet">

        <h2 class="user-panel-sheet-h2">لیست فاکتور ها</h2>

        <?php

if(isset($_POST['submit_last_status']) && isset($_POST['input_id_last_status'])){

		
  $accept =	$_POST['accept_last_status'];
  $id = $_POST['input_id_last_status'];
 
 if(!mysqli_query($connection,"update factor set status = '$accept' where id=$id "))die(mysqli_error($connection));
 

}

        require ('../db_select.php');


        parse_str($_SERVER['QUERY_STRING']);

        if (isset($do) && $do != '' && isset($invoiceID) && $invoiceID != '') {
            if ($do == 'delete') {


                $delete_invoice ="DELETE FROM factor WHERE id='$invoiceID'";

                if (!mysqli_query($connection,$delete_invoice))
                {
                    die('Error: ' . mysqli_error());
                    echo "مشکلی در روند حذف فاکتور به وجود آمد و فاکتور حذف نگردید.";
                }
                else{
                    echo "<span class=\"done-alert\">فاکتور مورد نظر با موفقیت حذف گردید.</span>";
                }

            }
            elseif ($do == 'paid') {
                $sql_paid_invoice = "UPDATE invoices SET is_paid = $pay WHERE invoice_code = '$invoiceID'";
                mysqli_query($connection, "SET NAMES 'utf8'");
                mysqli_query($connection, "SET CHARACTER SET 'utf8'");
                mysqli_query($connection, "SET character_set_connection = 'utf8'");
                if ($connection->query($sql_paid_invoice) === TRUE) {
                    echo "<span class=\"edit-done-alert\">وضعیت فاکتور مربوطه   تغییر یافت</span>";
                } else {
                    echo "مشکلی در تغییر وضعیت پرداخت فاکتور به وجود آمد: " . $sql . "<br>" . $connection->error;
                }
            }
        }

        $username=$user_id_value;
        
        if (isset($username)){



            $sql_invoices = mysqli_query($connection, "SELECT * FROM factor where operator='$username' ORDER BY id DESC");
            $RecordCount = mysqli_num_rows($sql_invoices);
            $showRecord = 20;
            $pages = ceil($RecordCount / $showRecord);


            if(isset($page) && $page != '' && $page >=  1){
                $pageuse = $page - 1;
                $start = ($pageuse * $showRecord);
                $end = $showRecord;
            }
            else{
                $start = 0;
                $end = $showRecord;
            }
			
					
$search_num=$_POST['search_num'];
if (isset($search_num)){
	
	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor WHERE operator='$username' and id LIKE '%$search_num%'  ORDER BY id DESC");

	
	 
	}else{
	
            $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where operator='$username' ORDER BY id DESC LIMIT $start , $end");

}
			

        }else{



            $sql_invoices = mysqli_query($connection, "SELECT * FROM factor ORDER BY id  DESC");
            $RecordCount = mysqli_num_rows($sql_invoices);
            $showRecord = 20;
            $pages = ceil($RecordCount / $showRecord);


            if(isset($page) && $page != '' && $page >=  1){
                $pageuse = $page - 1;
                $start = ($pageuse * $showRecord);
                $end = $showRecord;
            }
            else{
                $start = 0;
                $end = $showRecord;
            }
            $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor   ORDER BY id DESC LIMIT $start , $end");



        }






        ?>

 <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    شماره فاکتور :    <input name="search_num" type="text" id="search_num">
        </form><br>
        <a href="../users/new_factor.php" class="addinvoicelink">افزودن فاکتور</a>

        <?php

        if(!isset($page) || $page == ''){
            $page = 1;
        }
        echo "<br/> صفحه ی ".$page ." از ".$pages;

        ?>
        
           

        <table id="financial-invoices-table">
            <tr>
                <th>ردیف</th>
                <th class="th-darker">شماره فاکتور</th>
                <th>نام</th>
                <th class="th-darker">نام خانوادگی</th>
                <th >تلفن</th>
                <th class="th-darker">تاریخ ایجاد</th>
                <th >پرینت</th>
                <th class="th-darker">جزییات</th>
                <th >ویرایش</th>
                <th  class="th-darker">تکمیل</th>
                

            </tr>
            <tr><?php
                $c = '1';
                while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

                    $sql_invoice_code = $sql_invoices['id'];
					$sql_status= $sql_invoices['status'];

                    $sql_invoice_name = $sql_invoices['name'];
                    $sql_invoice_create_date =  jdate('Y/m/d h:i a',strtotime(  $sql_invoices['date_create'].' +210 minutes'),'none','Iran/Tehran','fa');
                    $sql_invoice_family = $sql_invoices['family'];
                    $sql_invoice_tell = $sql_invoices['tell'];
                    $sql_invoice_is_paid = $sql_invoices['is_paid'];
                    $sql_invoice_print= "<a href=\"factor_print.php?invoiceID=$sql_invoice_code\"><span class=\"green-text\">پرینت</span></a>";
					   $sql_invoice_edit= "<a href=\"factor_edit.php?invoiceID=$sql_invoice_code\"><span class=\"green-text\">ویرایش</span></a>";
                    $sql_invoice_detail= "<a href=\"factor_detail.php?invoiceID=$sql_invoice_code\"><span class=\"green-text\">جزییات</span></a>";

                    $sql_payment_link ="<a    onclick=\"return  confirm('آیا مطمئن به حذف هستید؟')\"  href=\"financial_company.php?do=delete&invoiceID=$sql_invoice_code\"><span class=\"adminpanel-delete-icon\"></span></a>";

                    if (is_null($sql_invoice_deposit_date)) {
                        $sql_invoice_deposit_date = '-';
                    }

                    $sql_is_paid_change_link = "<a href=\"orders_financial.php?invoiceID=$sql_invoice_code\">پرداخت</a>";
				 


                    echo "<tr>";
                    echo "<td>$c</td>";
                    $c++;
                    echo "<td class=\"th-darker\">$sql_invoice_code</td>";
                    echo "<td>$sql_invoice_name</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_family</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_tell</td>";
                    echo "<td>$sql_invoice_create_date</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_print</td>";
                    echo "<td class=\"th-darker\">$sql_invoice_detail</td>";
                       echo "<td class=\"th-darker\">$sql_invoice_edit</td>";
				  	echo "<td>";
				?><form method="post" action="<?=$_SERVER['PHP_SELF'] ?>?page=<?= $page?>"> <?	
					
					    if ($sql_status == 1) { ?>
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_invoice_code?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="0"/> 
                         <input  name="submit_last_status"  type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/true.gif');" value="">
                         
                 
                    <?php } else { ?>
                    
                        <input name="input_id_last_status" type="text" style="display:none;" value="<?=$sql_invoice_code?>"/>
                         <input name="accept_last_status" type="text" style="display:none;" value="1"/> 
                         <input name="submit_last_status" type="submit"   style="border:0; width:25px; height:25px; background-image:url('../library/images/false.gif');" value="">
                  
                    
                    <?php 
					
					
					}
					

                    echo "</form></td></tr>";


                }
                ?>

        </table>

        <div id="paging">
            <ul><?php
                if(isset($page) && $page != '' && $page >=  1){
                    $backpage = $page - 1;
                    $nextpage = $page + 1;
                }
                elseif(isset($page) && $page != '' && $page == $pages) {
                    $backpage = $page - 1;
                    $nextpage = '';
                }
                else{
                    $nextpage = 2;
                }
                if(isset($backpage) && $backpage != '' && $backpage >= 1){
                    echo "<a href=\"?page=$backpage\"><li>صفحه قبل</li></a>";
                }
                for($i = 1; $i <= $pages; $i++){
                    if($i == $page){
                        $active_page_button = "class=\"active_page_button\"";
                    }
                    else{
                        $active_page_button = '';
                    }
                    echo "<a href=\"?page=$i\"><li $active_page_button>$i</li></a>";
                }
                if(isset($nextpage) && $nextpage != '' && $nextpage <= $pages){
                    echo "<a href=\"?page=$nextpage\"><li>صفحه بعد</li></a>";
                }
                ?></ul>
        </div>
	
	</section>

<?php include ("footer.php");?>

