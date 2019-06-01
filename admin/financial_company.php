<?php
if (isset($_POST['submitadd'])){


    session_start();

    $_SESSION['print_username'] = $_POST['userorder'];
    $_SESSION['print_user']='ok';
    header("Location: ../users/new_factor.php");

}



require ("header.php");
 ?>
<?php include ("sidebar.php");?>
<?$username=$_GET['username'];
?>
<section id="user-panel-index">
     <form id="admin-panel-index-financial"  action="financial_factor.php" method="post">       <b class="user-panel-sheet-h2">لیست فاکتور ها<?= $username?>
             از تاریخ :            <input type="text" id="datepicker1" class="inpts" name="datepicker1"  />
             تا تاریخ :            <input type="text" id="datepicker2" class="inpts" name="datepicker2"  />

             <select name="order-status-edit-select" class="order-edit-select">

                 <option value="0" >نامشخص</option>
                 <option value="1" >پرداخت نقدی </option>
                 <option value="2">پرداخت Pos</option>
                 <option value="3" >پرداخت چک </option>
                 <option value="4">واریزی حساب</option>
                 <option value="5" >پرداخت حسابداری</option>
                 <option value="6" >پرداخت اینترنتی</option>

             </select>
       <input name="search" value="ثبت" type="submit"  class="order-edit-submit" />
       <br />

</b>
</form>




<form id="admin-panel-index-financial"  action="financial_list.php" method="post">       <b class="user-panel-sheet-h2">جزییات فاکتورها<?= $username?>
        از تاریخ :            <input type="text" id="datepicker4" class="inpts" name="datepicker1"  />
        تا تاریخ :            <input type="text" id="datepicker5" class="inpts" name="datepicker2"  />

        نام  :    <input name="search_name" type="text" id="search_name">

        شماره تلفن :    <input name="search_tell" type="text" id="search_tell">

  <input name="search" value="ثبت" type="submit"  class="order-edit-submit" />
  <br />

</b>
</form>
<?php


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
		$sql_paid_invoice = "UPDATE factor SET is_paid = $pay WHERE id = '$invoiceID'";
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
if (isset($username)){

	$sql1=

	$sql_invoices = mysqli_query($connection, "SELECT * FROM factor where username='$username' ORDER BY date_show DESC");
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
	$sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where username='$username' and is_paid='1' ORDER BY date_show DESC LIMIT $start , $end");
}else{



		$sql_invoices = mysqli_query($connection, "SELECT * FROM factor where   is_paid='1' or operator like '%shamim%' ORDER BY id  DESC");
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
    $search_tell=$_POST['search_tell'];
	$search_name=$_POST['search_name'];
    if (!empty($search_num)) {

        $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor WHERE   id LIKE '%$search_num%'  and (is_paid='1' or operator like '%shamim%')  ORDER BY date_show DESC");
    }
elseif (!empty($search_name)){

        $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor WHERE  (  name LIKE '%$search_name%' or family LIKE '%$search_name%' ) and (is_paid='1'  or operator like '%shamim%')  ORDER BY date_show DESC");

    }elseif (!empty($search_tell)){

        $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor WHERE    tell LIKE '%$search_tell%'  and  (is_paid='1' or operator like '%shamim%')  ORDER BY date_show DESC");

    }

    else{

if(isset($_POST['d'])){

	$dates = $_POST['d'];
$dates = explode('/', $dates);
$resdate= strtotime(jalali_to_gregorian($dates[2] , $dates[1] ,$dates[0] ,'-'));
 $datefrom = date('Y-m-d',$resdate);
 $dateto =date('Y-m-d', strtotime($datefrom." +1 days"));



	 $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where date_create between '$datefrom' and '$dateto'  and (is_paid='1' or operator like '%shamim%') order by date_show DESC");

	}else{
 $datefrom = date('Y-m-d',time());
 $dateto =date('Y-m-d', strtotime($datefrom." +1 days"));

        $sql_invoices_of_user = mysqli_query($connection, "SELECT * FROM factor where date_create between '$datefrom' and '$dateto'  and (is_paid='1' or operator like '%shamim%') order by date_show DESC");

    }


	}





	}


?>
    <section id="admin-panel-sheet">

    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">

    <select name="userorder" class="order-edit-select">
        <option value="shamim">shamim</option>
        <option value="shamim1">shamim1</option>
        <option value="shamim2">shamim2</option>
        <option value="shamim3">shamim3</option>
        <option value="shamim4">shamim4</option>
        <option value="shamim5">shamim5</option>
        <option value="shamim6">shamim6</option>
        <option value="shamim7">shamim7</option>
        <option value="shamim8">shamim8</option>
        <option value="shamim9">shamim9</option></select>
        <input name="submitadd" value="ثبت فاکتور" type="submit"  class="order-edit-submit">
    </form>


      <br>
        <br>

        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        شماره فاکتور :    <input name="search_num" type="text" id="search_num">

            نام  :    <input name="search_name" type="text" id="search_name">

              شماره تلفن :    <input name="search_tell" type="text" id="search_tell">

            <input name="submit" value="جستجو" type="submit"  class="order-edit-submit">
        <br>
        </form>


		<table id="financial-invoices-table">
			<tr>
				<th>ردیف</th>
				<th class="th-darker">شماره فاکتور</th>
				<th>نام</th>
				<th class="th-darker">نام خانوادگی</th>
                <th >تلفن</th>
                <th class="th-darker">تاریخ ایجاد</th>
                 <th >جزییات</th>
			<? if ($_SESSION['print_admin_name']=='support'){ ?>
               
				<th>پرداخت</th>
                <? }?>
            <? if ($_SESSION['print_admin_name']=='delivery'){ ?>    <th>تحویل</th> <? }?>
			</tr>
			<tr><?php
				$c = '1';
				while($sql_invoices = mysqli_fetch_array($sql_invoices_of_user)){

					$sql_invoice_code = $sql_invoices['id'];

					 $read_m=$sql_invoices['read_m'];
					$sql_invoice_name = $sql_invoices['name'];
					$sql_invoice_create_date =  jdate('Y/m/d h:i a',strtotime($sql_invoices['date_create'] .' +210 minutes'),'none','Iran/Tehran','fa');
					$sql_invoice_family = $sql_invoices['family'];
					$sql_invoice_tell = $sql_invoices['tell'];
					$sql_invoice_is_paid = $sql_invoices['is_paid'];
					$sql_invoice_print= "<a href=\"factor_print.php?invoiceID=$sql_invoice_code\"><span class=\"green-text\">پرینت</span></a>";

					$sql_delete_link ="<a href=\"financial_company.php?do=delete&invoiceID=$sql_invoice_code\"><span class=\"adminpanel-delete-icon\"></span></a>";

					if (is_null($sql_invoice_deposit_date)) {
						$sql_invoice_deposit_date = '-';
					}

						$sql_is_paid_change_link = "<a href=\"orders_financial.php?invoiceID=$sql_invoice_code\">پرداخت</a>";
						$sql_is_deliver_change_link = "<a href=\"orders_deliver.php?invoiceID=$sql_invoice_code\">تحویل</a>";

if($read_m!=1){
$read_m="class='th-darker_r'";
  }	else $read_m='';


				echo "<tr>";
					echo "<td $read_m>$c</td>";
					$c++;
					echo "<td $read_m>$sql_invoice_code</td>";
					echo "<td $read_m>$sql_invoice_name</td>";
					echo "<td $read_m>$sql_invoice_family</td>";
					echo "<td $read_m>$sql_invoice_tell</td>";
					echo "<td $read_m>$sql_invoice_create_date</td>";
					echo "<td $read_m>$sql_invoice_print</td>";
							if ($_SESSION['print_admin_name']=='support'){
				//	echo "<td $read_m>$sql_delete_link</td>";
					echo "<td $read_m>$sql_is_paid_change_link</td>";
                           }
					 if ($_SESSION['print_admin_name']=='delivery'){
					 echo "<td $read_m>$sql_is_deliver_change_link</td>";
					 }

				echo "</tr>";



			}
 			?></table>
 <br />
<br />

	   <form action="<?= $_SERVER['PHP_SELF']?>" method="post" id="bydate">

<div id="datepicker3" ></div>
<input type="text" id="d" name="d" style="display:none"/>
</form>

</section>



<?php include ("footer.php"); ?>
