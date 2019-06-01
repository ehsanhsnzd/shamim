<?php require ("header.php");?>
<?php include ("sidebar.php");
  parse_str($_SERVER['QUERY_STRING']);
 	$input_paper_name=$_POST['paper_name'];
	$input_paper_size=$_POST['paper_size'];
 	$input_paper_price=$_POST['paper_price'];
	$paper_id=$_POST['select_paper_id'];

	if(isset($_GET['select_paper_id'])){	$select_paper_id=$_GET['select_paper_id'];};
	if(isset($_POST['select_paper_id'])){  	 $select_paper_id=$_POST['select_paper_id'];};

		if(isset($_GET['select_paper_size'])){	$select_paper_size=$_GET['select_paper_size'];};
	if(isset($_POST['paper_size'])){	 $select_paper_size=$_POST['paper_size'];};

if(isset($_GET['select_paper_gram'])){	$select_paper_gram=$_GET['select_paper_gram'];}else{$select_paper_gram=1;};
if(isset($_POST['select_paper_gram'])){	 $select_paper_gram=$_POST['select_paper_gram'];}else{$select_paper_gram=1;};


$_GET['edit_id'] = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';

$edit_id=$_GET['edit_id'];

class dedicate
{


    public function dedicate_price()
    {

        global $p_size;


        require('../config.php');
        $connection = mysqli_connect($server_name, $db_username, $db_password);
        if (!$connection) {
            die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        }
        mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
        mysqli_query($connection, "SET NAMES 'utf8'");
        mysqli_query($connection, "SET CHARACTER SET 'utf8'");
        mysqli_query($connection, "SET character_set_connection = 'utf8'");


        if (isset($_GET['select_paper_id'])) {
            $select_paper_id = $_GET['select_paper_id'];
        };
        if (isset($_POST['select_paper_id'])) {
            $select_paper_id = $_POST['select_paper_id'];
        };

        if (isset($_GET['select_paper_size'])) {
            $select_paper_size = $_GET['select_paper_size'];
        };
        if (isset($_POST['paper_size'])) {
            $select_paper_size = $_POST['paper_size'];
        };

        if (isset($_GET['select_paper_gram'])) {
            $select_paper_gram = $_GET['select_paper_gram'];
        };
        if (isset($_POST['select_paper_gram'])) {
            $select_paper_gram = $_POST['select_paper_gram'];
        };


        if (!empty($select_paper_id) && !empty($select_paper_gram)) {

            if (!$select_paperid_query = mysqli_query($connection, "select * from paper_type where type = '$select_paper_id' and gram = $select_paper_gram ")) {
                echo mysqli_error($connection);
            };


            $select_price = mysqli_fetch_assoc($select_paperid_query);
        }

        if (!$offer_sql = mysqli_query($connection, "select * from info")) {
            echo mysqli_error($connection);
        };
        $info_paper= mysqli_fetch_assoc( $offer_sql);


        global $cut_num;
        global $cut_num_t;
        global $cutpaper;
        global $zinc_type;
        global $zinc_type_sec;
        global $tside;
        global $lineside;
        global $porfragside;
        global $uvside;
        global $lightside;
        global $matside;
        global $uvmside;
        global $order_type;


        $size = $_POST['paper_size'];
        $size_price_add = 1;
        if ($size == 6045 || $size == 5070) {
            $size_price_add = 2;
        }

        $size_price_add += ($_POST['cut_num'] - 1);

        $cutpaper = $_POST['cutpaper'];
        if (isset($cutpaper)) {
            $cut_num = $_POST['cut_num'] + 2;
        } else {
            $cut_num = $_POST['cut_num'];
        }

        if ($cutpaper) {
            $mines_cut = 1;
        } else {
            $mines_cut = 2;
        }


        $zinc_type = $_POST['zinc_type'];
        $zinc_type_sec = $_POST['zinc_type_sec'];
        $tside = $_POST['tside'];
        $uvside = $_POST['uvside'];
        $lightside = $_POST['lightside'];
        $matside = $_POST['matside'];
        $uvmside = $_POST['uvmside'];
        $lineside = $_POST['lineside'];
        $porfragside = $_POST['porfragside'];
        $paperprice = $select_price['price'];





        if($select_paper_id=="تحریر" and $select_paper_gram >= $info_paper['paper_qty_1']){
            $paperprice_percent=$paperprice*($info_paper['paper_percent_1']/100);
            $paperprice+=$paperprice_percent;
        }

        if($select_paper_id=="گلاسه" and $select_paper_gram >= $info_paper['paper_qty_2']){
            $paperprice_percent=$paperprice*($info_paper['paper_percent_2']/100);
            $paperprice+=$paperprice_percent;
        }
        switch ($size) {

            case '3045':
                $width = 30;
                $height = 45;
                break;

            case '5035':
                $width = 50;
                $height = 35;
                break;

            case '6045':
                $width = 60;
                $height = 45;
                break;

            case '5070':
                $width = 50;
                $height = 70;
                break;
        }

        if ($select_paper_gram != 1) {

        $paperprice = ((($width * $height * $select_paper_gram) / 10000) * $paperprice) / 1000;
    }else{
            if($height==35){$paperprice=$paperprice/2;}
        }


        if($size==6045 || $size==5070 ){$size_price_add=2;}




  if(!isset($cutpaper)){

        if($select_paper_size==3045){

            $p_size="A";

            if ($cut_num==1){$cut_size=3;}
            if ($cut_num==2){$cut_size=4;}
            if ($cut_num==4){$cut_size=5;}
            if ($cut_num==8){$cut_size=6;}
            if ($cut_num==16){$cut_size=7;}
            if ($cut_num==32){$cut_size=8;}
            if ($cut_num==64){$cut_size=9;}

        }else if($select_paper_size==6045){

            $p_size="A";

            if ($cut_num==1){$cut_size=2;}
            if ($cut_num==2){$cut_size=3;}
            if ($cut_num==4){$cut_size=4;}
            if ($cut_num==8){$cut_size=5;}
            if ($cut_num==16){$cut_size=6;}
            if ($cut_num==32){$cut_size=7;}
            if ($cut_num==64){$cut_size=8;}

        }else if($select_paper_size==5035){

            $p_size="B";

            if ($cut_num==1){$cut_size=3;}
            if ($cut_num==2){$cut_size=4;}
            if ($cut_num==4){$cut_size=5;}
            if ($cut_num==8){$cut_size=6;}
            if ($cut_num==16){$cut_size=7;}
            if ($cut_num==32){$cut_size=8;}
            if ($cut_num==64){$cut_size=9;}

        }else if( $select_paper_size==5070){

            $p_size="B";

            if ($cut_num==1){$cut_size=2;}
            if ($cut_num==2){$cut_size=3;}
            if ($cut_num==4){$cut_size=4;}
            if ($cut_num==8){$cut_size=5;}
            if ($cut_num==16){$cut_size=6;}
            if ($cut_num==32){$cut_size=7;}
            if ($cut_num==64){$cut_size=8;}


        }
  }

if($cut_num==1){$mines_cut=2;}
if(isset($cutpaper)){$cut_num-=2;}
$cut_num_result=floor(($cut_num)/$mines_cut);


 $dedicate_sql=mysqli_query($connection,"select * from dedicate_info");

$d= mysqli_fetch_array( $dedicate_sql);


	if (isset($tside)){

		switch ($size.$zinc_type) {

		  case '30454':
                    $zinc = $d['1th4'];
                    $print = $d['1th4p'];
					$next_price1=$d['1th4pn'];
				//	$next_price2=50000;
				$order_zinc='30x45 4color';
                    break;

 		  case '50354':
                    $zinc = $d['1th4'];
                    $print = $d['1th4p'];
					$next_price1=$d['1th4pn'];
				//	$next_price2=50000;
          			$order_zinc='50x35 4color';
                    break;

 		  case '60454':
                    $zinc = $d['1th4']*2;
                    $print = $d['1th4p']*2;
					$next_price1=$d['1th4pn']*2;
				//	$next_price2=50000;
					$order_zinc='60x45 4color';
                    break;

 		  case '50704':
                    $zinc = $d['1th4']*2;
                    $print = $d['1th4p']*2;
					$next_price1=$d['1th4pn']*2;
					//$next_price2=50000;
					$order_zinc='50x70 4color';
                    break;

 ///////////////////////

		   case '30452':
                    $zinc = $d['1th2'];
                    $print = $d['1th2p'];
					$next_price1=$d['1th2pn'];
				//	$next_price2=40000;
				$order_zinc='30x45 2color';
                    break;

 		  case '50352':
                    $zinc = $d['1th2'];
                    $print = $d['1th2p'];
					$next_price1=$d['1th2pn'];
			//		$next_price2=40000;
			          			$order_zinc='50x35 2color';
                    break;
 		  case '60452':
                    $zinc = $d['1th2']*2;
                    $print = $d['1th2p']*2;
					$next_price1=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc='60x45 2color';
                    break;

 		  case '50702':
                    $zinc = $d['1th2']*2;
                    $print = $d['1th2p']*2;
					$next_price1=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc='50x70 2color';
                    break;

					//////////////////////////////////


		  case '30451':
                    $zinc = $d['1th1'];
                    $print = $d['1th1p'];
					$next_price1=$d['1th1pn'];
				//	$next_price2=20000;
								$order_zinc='30x45 1color';
                    break;

 		  case '50351':
                    $zinc = $d['1th1'];
                    $print = $d['1th1p'];
					$next_price1=$d['1th1pn'];
				//	$next_price2=20000;
				       			$order_zinc='50x35 1color';
                    break;
 		  case '60451':
                    $zinc = $d['1th1']*2;
                    $print = $d['1th1p']*2;
					$next_price1=$d['1th1pn']*2;
				//	$next_price2=40000;
								$order_zinc='60x45 1color';
                    break;

 		  case '50701':
                    $zinc = $d['1th1']*2;
                    $print = $d['1th1p']*2;
					$next_price1=$d['1th1pn']*2;
				//	$next_price2=40000;
				$order_zinc='50x70 1color';
                    break;


}








	if ($tside=='2'){

		switch ($size.$zinc_type_sec) {

		  case '30454':
                    $zinc_sec = $d['1th4'];
                    $print_sec = $d['1th4p'];
					$next_price1_sec=$d['1th4pn'];
				//	$next_price2=50000;
				$order_zinc_sec='30x45 4color';
                    break;

 		  case '50354':
                    $zinc_sec = $d['1th4'];
                    $print_sec = $d['1th4p'];
					$next_price1_sec=$d['1th4pn'];
				//	$next_price2=50000;
          			$order_zinc_sec='50x35 4color';
                    break;

 		  case '60454':
                    $zinc_sec = $d['1th4']*2;
                    $print_sec = $d['1th4p']*2;
					$next_price1_sec=$d['1th4pn']*2;
				//	$next_price2=50000;
					$order_zinc_sec='60x45 4color';
                    break;

 		  case '50704':
                    $zinc_sec = $d['1th4']*2;
                    $print_sec = $d['1th4p']*2;
					$next_price1_sec=$d['1th4pn']*2;
					//$next_price2=50000;
					$order_zinc_sec='50x70 4color';
                    break;

 ///////////////////////

		   case '30452':
                    $zinc_sec = $d['1th2'];
                    $print_sec = $d['1th2p'];
					$next_price1_sec=$d['1th2pn'];
				//	$next_price2=40000;
				$order_zinc_sec='30x45 2color';
                    break;

 		  case '50352':
                    $zinc_sec = $d['1th2'];
                    $print_sec = $d['1th2p'];
					$next_price1_sec=$d['1th2pn'];
			//		$next_price2=40000;
			          			$order_zinc_sec='50x35 2color';
                    break;
 		  case '60452':
                    $zinc_sec = $d['1th2']*2;
                    $print_sec = $d['1th2p']*2;
					$next_price1_sec=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc_sec='60x45 2color';
                    break;

 		  case '50702':
                    $zinc_sec = $d['1th2']*2;
                    $print_sec = $d['1th2p']*2;
					$next_price1_sec=$d['1th2pn']*2;
			//		$next_price2=80000;
								$order_zinc_sec='50x70 2color';
                    break;

					//////////////////////////////////


		  case '30451':
                    $zinc_sec = $d['1th1'];
                    $print_sec = $d['1th1p'];
					$next_price1_sec=$d['1th1pn'];
				//	$next_price2=20000;
								$order_zinc_sec='30x45 1color';
                    break;

 		  case '50351':
                    $zinc_sec = $d['1th1'];
                    $print_sec = $d['1th1p'];
					$next_price1_sec=$d['1th1pn'];
				//	$next_price2=20000;
				       			$order_zinc_sec='50x35 1color';
                    break;
 		  case '60451':
                    $zinc_sec = $d['1th1']*2;
                    $print_sec = $d['1th1p']*2;
					$next_price1_sec=$d['1th1pn']*2;
				//	$next_price2=40000;
								$order_zinc_sec='60x45 1color';
                    break;

 		  case '50701':
                    $zinc_sec = $d['1th1']*2;
                    $print_sec = $d['1th1p']*2;
					$next_price1_sec=$d['1th1pn']*2;
				//	$next_price2=40000;
				$order_zinc_sec='50x70 1color';
                    break;


}

	}



$print_fee=$print;
$zinc_fee=$zinc;

 $qty_paper=$_POST['papernum']/1000;
 $qty_paper_round=ceil($_POST['papernum']/1000);
 $qty_paper_round_uv=ceil($_POST['papernum']/100);
 $qty_print= ceil($qty/1000);


	if($_POST['tside']=='1')
	{

	$qty=$_POST['papernum']*2;
  $qty_paper_round_uv_2=ceil($qty/100);
	 $qty_print= ceil($qty/1000);
 $order_tside='دو رو با یک زینک';
if($qty_print>1 ){$next_print=($qty_print-1)*$next_price1;}

	}elseif($_POST['tside']=='2'){

	$qty= $_POST['papernum'];
    $qty_paper_round_uv_2=ceil(($qty*2)/100);
	 $qty_print= ceil($qty/1000);
	$zinc=$zinc+$zinc_sec;
	$print=$print+$print_sec;
 	 $order_tside='دو رو با دو زینک';
	 if($qty_print>1 ){$next_print=(($qty_paper_round-1)*$next_price1)+(($qty_paper_round-1)*$next_price1_sec);}


	}else {$qty= $_POST['papernum'];
	 $qty_print= ceil($qty/1000);
	 if($qty_print>1 ){$next_print=($qty_print-1)*$next_price1;}
	$order_tside='تک رو';


	}


$papernum=$_POST['papernum'];
$paperprice=(($paperprice*$papernum));

        $uv_value=$d['uv'];
        $mat_value=$d['mat'];
        $uvm_value=$d['uvm'];
$light_value=$d['light'];
$porfrag_value=$d['porfrag']*$size_price_add;
$linebreak_value=$d['linebreak']*$size_price_add;
$linebreaka_value=$d['linebreaka']*$size_price_add;
$tigh_value=$d['tigh']*$size_price_add;
$manganeh_value=$d['manganeh'];
$numbering_value=$d['numbering']*$size_price_add;
$sahafi_value=$d['sahafi'];
        $sarchasb_value=$d['sarchasb']*$size_price_add;
//$template_value=$_POST['template_value'];
//$sahafi_value=$_POST['sahafi_value'];







        if(isset($_POST['uv']) && $uvside=='1' && $size==3045 || isset($_POST['uv']) && $uvside=='1' && $size==5035 ){ $uv=$uv_value* $qty_paper_round_uv;
        $additional.=' سلفون یو وی تکرو';

        }
        if(isset($_POST['uv']) && $uvside=='2' && $size==3045 || isset($_POST['uv']) && $uvside=='2' && $size==5035 ){ $uv=($uv_value*$qty_paper_round_uv_2);
            $additional.=' سلفون یو وی دورو';

        }
        if(isset($_POST['uv']) && $uvside=='1' && $size==6045 || isset($_POST['uv']) && $uvside=='1' && $size==5070  ){ $uv=($uv_value*2)*$qty_paper_round_uv;
        $additional.='-سلفون یو وی  تکرو';

        }

        if(isset($_POST['uv']) && $uvside=='2' && $size==6045 || isset($_POST['uv']) && $uvside=='2' && $size==5070  ){ $uv=(($uv_value*2)*$qty_paper_round_uv_2);
            $additional.='-سلفون یو وی  دورو';

        }


        if(isset($_POST['light']) &&  $lightside=='1'&&  $size==3045 || isset($_POST['light']) &&  $size==5035 && $lightside=='1'){ $light=$light_value*$qty_paper_round_uv;
            $additional.=' سلفون براق تکرو';

        }
        if(isset($_POST['light']) &&  $lightside=='2'&&  $size==3045 || isset($_POST['light']) &&  $size==5035 && $lightside=='2'){ $light=$light_value*$qty_paper_round_uv_2;
            $additional.=' سلفون براق دورو';

        }
        if(isset($_POST['light']) &&  $lightside=='1'&&  $size==6045 || isset($_POST['light']) &&  $size==5070  && $lightside=='1'){ $light=($light_value*2)*$qty_paper_round_uv;
            $additional.='-سلفون براق  تکرو';

        }

        if(isset($_POST['light']) &&  $lightside=='2'&&  $size==6045 || isset($_POST['light']) &&  $size==5070  && $lightside=='2'){ $light=($light_value*2)*$qty_paper_round_uv_2;
            $additional.='-سلفون براق  دورو';

        }



        if(isset($_POST['mat']) && $matside=='1'&&  $size==3045 || isset($_POST['mat']) &&  $size==5035 && $matside=='1'){ $mat=$mat_value*$qty_paper_round_uv;
            $additional.=' سلفون مات تکرو';

        }
        if(isset($_POST['mat']) &&   $matside=='2'&&  $size==3045 || isset($_POST['mat']) &&  $size==5035 && $matside=='2'){ $mat=$mat_value*$qty_paper_round_uv_2;
            $additional.=' سلفون مات دورو';

        }
        if(isset($_POST['mat']) && $matside=='1'&&  $size==6045 || isset($_POST['mat']) &&  $size==5070  && $matside=='1'){ $mat=($mat_value*2)*$qty_paper_round_uv;
            $additional.='-سلفون مات  تکرو';

        }

        if(isset($_POST['mat']) && $matside=='2'&&  $size==6045 || isset($_POST['mat']) &&  $size==5070  && $matside=='2'){ $mat=($mat_value*2)*$qty_paper_round_uv_2;
            $additional.='-سلفون مات  دورو';

        }



        if(isset($_POST['uvm']) && $uvmside=='1'&&  $size==3045 || isset($_POST['uvm']) &&  $size==5035 && $uvmside=='1'){  $uvm=$uvm_value*$qty_paper_round_uv;
            $additional.=' سلفون یووی موضعی تکرو';

        }
        if(isset($_POST['uvm']) && $uvmside=='2'&&  $size==3045 || isset($_POST['uvm']) &&  $size==5035 && $uvmside=='2'){ $uvm=$uvm_value*$qty_paper_round_uv_2;
            $additional.=' سلفون یووی موضعی دورو';

        }
        if(isset($_POST['uvm']) && $uvmside=='1'&&  $size==6045 || isset($_POST['uvm']) &&  $size==5070  && $uvmside=='1'){ $uvm=($uvm_value*2)*$qty_paper_round_uv;
            $additional.='-سلفون یووی موضعی  تکرو';

        }

        if(isset($_POST['uvm']) && $uvmside=='2'&&  $size==6045 || isset($_POST['uvm']) &&  $size==5070  && $uvmside=='2'){ $uvm=($uvm_value*2)*$qty_paper_round_uv_2;
            $additional.='-سلفون یووی موضعی  دورو';

        }



        if(isset($_POST['cutpaper'])){$cut_num_text=$cut_num;}

        if(isset($_POST['porfrag'])){ $porfrag=$porfrag_value*$qty_paper_round;$additional.='-پرفراژ '.$porfragside;}
        if(isset($_POST['linebreak'])){ $linebreak=$linebreak_value*$qty_paper_round;$additional.='-خط تا '.$lineside;}
        if(isset($_POST['numbering'])){ $numbering=$numbering_value*$qty_paper_round;$additional.='-شماره زنی ';}
        if(isset($_POST['sarchasb'])){ $sarchasb=$sarchasb_value*$qty_paper_round;$additional.='-سر چسب ';}
        if(isset($_POST['tigh'])){ $tigh=$tigh_value*$qty_paper_round;$additional.='-تیغ ';}
        if(isset($_POST['cutpaper']) || $cut_num>1){$manganeh=$manganeh_value *($qty_paper_round *$cut_num_result) ;$additional.='-برش '.$cut_num_text;}

        $cut_num_t=$cut_num;
        if(isset($_POST['cutpaper'])){$cut_num_t=$cut_num+1;}


$order_type=$order_zinc."-".$order_zinc_sec."-".$order_tside."-".$papernum."عدد -".$select_paper_id." ".$select_paper_gram."گرم "."- حاصل کار: ".($cut_num_t*$papernum)."عدد -".$p_size.$cut_size."-"."($additional)";

if(empty($paperprice)){$paperprice=0;}

	return	 array($paperprice,$zinc,$print,$next_print,$uv, $light,$uvm,$mat,$porfrag,$linebreak,$tigh, $manganeh,$sahafi,$numbering,$order_zinc."-".$order_zinc_sec,$order_tside,$papernum,$select_paper_id." ".$select_paper_gram,$qty_print,($print+$next_print),$zinc_fee,$sarchasb,$linebreaka);




			}


}
    }

	$dedicate = new dedicate;

if (isset($_POST['submit1'])){


$total=	$dedicate->dedicate_price();
 $total_show=$total[0]+$total[1]+$total[2]+$total[3]+$total[4]+$total[5]+$total[6]+$total[7]+$total[8]+$total[9]+$total[10]+$total[11]+$total[12]+$total[13]+$total[21]+$total[22];
	}
























	?>
	<br>


	<section id="user-panel-sheet">

    <div   <?   if (!preg_match('/shamim/',$user_id_value)){?> style="display:none"<? }?>>
         <a  class="print-button" href="new-order.php?service=32&quantity=1th&lot=1&factor=<?=$order_make_number_perforating?>">بنر</a>
         <a class="print-button" href="new-order-graphic.php?factor=<?=$factor?>">فرم عمومی</a>
         <a class="print-button" href="new-order-accessories.php?factor=<?=$factor?>"> طراحی و ... </a>
          <a class="print-button" target="_blank" href="factor_print.php?invoiceID=<?=$factor?>">چاپ فاکتور</a>
         </div>
        <br>

  <div style="border-bottom:2px solid #0C6; padding:10px">
	<a href="new-order-graphic.php?factor=<?=$factor?>" id="rcorners2">عمومی</a>

    	<a href="new-order-dedicate.php?factor=<?=$factor?>" id="rcorners1">اختصاصی</a>
	</div><br>









	<?php

 	if (isset($_POST['submit2']))
	{
$edit_id=$_POST['edit_id'];
$factor_start=$_POST['factor_start'];
$factor_start = isset($factor_start) ? $factor_start : '0';
 $factor_num=$_POST['factor_num'];
 $catagory=$_POST['catagory'];
			$service_id = $_POST['service-name-select'];
			$order_quantity_post = $_POST['service-quantity-select'];

			require ('../config.php');
			$connection = mysqli_connect($server_name, $db_username, $db_password);
			if(!$connection){
				die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			}
			mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
			mysqli_query($connection, "SET NAMES 'utf8'");
			mysqli_query($connection, "SET CHARACTER SET 'utf8'");
			mysqli_query($connection, "SET character_set_connection = 'utf8'");




			$order_size = $order_row['size'];
			$order_custom_duration = $order_row['work_time'];
			$order_quantity = $order_row['quantity'.$order_quantity_post];
			$order_price = $order_row['price'.$order_quantity_post];
			$order_custom_width = $_POST['order-custom-width'];
			if (!isset($order_custom_width) || $order_custom_width == '') {
				$order_custom_width = '';
			}
			$order_custom_height = $_POST['order-custom-height'];
			if (!isset($order_custom_height) || $order_custom_height == '') {
				$order_custom_height = '';
			}
			$order_lot_quantity = $_POST['order-lot-quantity'];

			$totals =$dedicate->dedicate_price();

						$order_name = $order_type;

		$order_total_price=		$totals[0]+$totals[1]+$totals[2]+$totals[3]+$totals[4]+$totals[5]+$totals[6]+$totals[7]+$totals[8]+$totals[9]+$totals[10]+$totals[11]+$totals[12]+$totals[13]+$totals[21]+$totals[22];
$order_price=$order_total_price;


    $dedicate_sql=mysqli_query($connection,"select * from  info");
    $d= mysqli_fetch_array( $dedicate_sql);

$percent_1=$d['percent_1'];

if (in_array($_SESSION["people_login"],$site_users)) {
    $discount_fee = $discount / 100;
} else {
    $discount_fee = $percent_1 / 100;
}

$order_total_discount=$order_total_price*$discount_fee;
$order_total_price=$order_total_price-$order_total_discount;

			if (isset($_POST['order_make_format'])) {
				$order_make_format = '1';
			}
			else{
				$order_make_format = '0';
			}
			if (isset($_POST['order_make_line'])) {
				$order_make_line = '1';
			}
			else{
				$order_make_line = '0';
			}
			if (isset($_POST['order_make_format_beat'])) {
				$order_make_format_beat = '1';
			}
			else{
				$order_make_format_beat = '0';
			}
			if (isset($_POST['order_make_header_glue'])) {
				$order_make_header_glue = '1';
			}
			else{
				$order_make_header_glue = '0';
			}
			if (isset($_POST['order_make_number_perforating'])) {
				$order_make_number_perforating = '1';
			}
			else{
				$order_make_number_perforating = '0';
			}
			if (isset($_POST['order_make_binding'])) {
				$order_make_binding = '1';
			}
			else{
				$order_make_binding = '0';
			}
			if (isset($_POST['order_make_design'])) {
				$order_make_design = '1';
			}
			else{
				$order_make_design = '0';
			}
			if (isset($_POST['order-description'])) {
				$order_description = $_POST['order-description'];
			}
			else{
				$order_description = '';
			}



		//


			$order_submit_date =  date('Y-m-d H:i:s');
			$order_promise_date = date('Y-m-d H:i:s', strtotime("+3 days"));



			if ($totals[1]) {
					$user_id_value = $_SESSION['print_username'];





          $true_upload = array();
          for ($j = 1; $j < 5; $j++) {
              $allowedCompressedTypes = array("application/x-rar-compressed", "application/zip", "application/x-zip", "application/x-zip-compressed", 'application/x-rar', 'application/rar', 'application/x-rar-compressed', "image/jpeg", "image/jpg", "image/png", "image/tiff");
              if(!empty($_POST["order-file-input-" . $j]))
              {
              $temp = explode(".", $_POST["order-file-input-" . $j]);
              $extension = end($temp);

                      $file_save_name = $_POST["order-file-input-" . $j];
                      $info = pathinfo($file_save_name);
                      $file_save_name = "-" . $factor_num.$info["filename"];
                      $increment = 1;
                      while (file_exists("../users/images_graphic/" . $increment . $file_save_name.'.' . $info['extension'])) {

                          $increment++;

                      }
                     $increment--;

                     // move_uploaded_file($_FILES["order-file-" . $j]["tmp_name"],"images_graphic/" . $increment . $file_save_name.'.' . $info['extension']);

                      $file_adress_name = "file" . $j;
                      ${$file_adress_name} = "../users/images_graphic/" . $increment . $file_save_name.'.' . $info['extension'];



                      if (!empty($edit_id)) {
                          mysqli_query($connection, "UPDATE orders2 set
                     order_file" . $j . "='" . ${$file_adress_name} . "'
                     where order_id=$edit_id");
                      }
                      $true_upload[] = 1;
              }
          }



			if (!isset($file2)) {
				$file2 = '';
			}
			if (!isset($file3)) {
				$file3 = '';
			}
			if (!isset($file4)) {
				$file4 = '';
			}
			$print_price=$totals[2]+$totals[3];
								if(empty($edit_id)){


					   $connection_sql = mysql_connect($server_name, $db_username, $db_password);

             mysql_select_db( $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");



             $sql_username_name = mysql_query( "SELECT name,lastname,telephone FROM users WHERE login='$user_id_value'");
             $sql_username_name_result = mysql_fetch_array($sql_username_name);
            $invoice_name=$sql_username_name_result['name'];
			$invoice_lastname=$sql_username_name_result['lastname'];
			$invoice_tell=$sql_username_name_result['telephone'];



if (!in_array($user_id_value,$site_users)) {
		$sql_invoice = "INSERT INTO factor ( operator, cash, date_create,date_show, comment,name,family,tell)
					VALUES ( '$user_id_value', '$order_total_price', '$order_submit_date','$order_submit_date', '$order_name','$invoice_name','$invoice_lastname','$invoice_tell')";
}
					mysqli_query($connection, "SET NAMES 'utf8'");
					mysqli_query($connection, "SET CHARACTER SET 'utf8'");
					mysqli_query($connection, "SET character_set_connection = 'utf8'");

					if ($connection->query($sql_invoice) == TRUE) {
					 $invoice_code_value=mysqli_insert_id($connection);

					 if($factor_num==""){$factor_num=$invoice_code_value;}else{
						$invoice_code_value=$factor_num;
						}

					 $_SESSION['invoice']=$invoice_code_value;
 } else {
			    		echo "Error: " . $sql_invoice . "<br>" . $connection->error;
					}

		 					$print_price=$totals[2]+$totals[3];
							$sql_order = "INSERT INTO orders2 (
							 order_user,
							 order_type,
							 order_size,
							 order_width,
							 order_height,
							 order_quantity,
							 order_duration,
							 order_unit_price,
							 order_lot_quantity,
							 order_total_price,
							 order_file1,
							 order_file2,
							 order_file3,
							 order_file4,
							 order_make_format,
							 order_make_line,
							 order_make_format_beat,
							 order_make_header_glue,
							 order_make_number_perforating,
							 order_make_binding,
							 order_make_design,
							 order_submit_date,
							 order_promise_date,
							 order_description,
							 order_invoice_code,factor,factor_start,discount,
							 paperprice,zinc,print,uv,light,uvm,mat,porfrag,linebreak,tigh,manganeh,sahafi,numbering,order_zinc,order_tside,papernum,select_paper_id,qty_print,print_fee,zinc_fee,sarchasb,linebreaka
							 ) VALUES (
							 '$user_id_value',
							 '$order_name',
							 '$order_size',
							 '$order_custom_width',
							 '$order_custom_height',
							 '$order_quantity',
							 '$order_custom_duration',
							 '$order_price',
							 '$order_lot_quantity',
							 '$order_total_price',
							 '$file1',
							 '$file2',
							 '$file3',
							 '$file4',
							 '$order_make_format',
							 '$order_make_line',
							 '$order_make_format_beat',
							 '$order_make_header_glue',
							 '$order_make_number_perforating',
							 '$order_make_binding',
							 '$order_make_design',
							 '$order_submit_date',
							 '$order_promise_date',
							 '$order_description',
							 '$invoice_code_value','$factor_num',$factor_start,'$discount_fee',
							 '$totals[0]','$totals[1]','$print_price','$totals[4]','$totals[5]','$totals[6]','$totals[7]','$totals[8]','$totals[9]','$totals[10]','$totals[11]','$totals[12]','$totals[13]','$totals[14]','$totals[15]','$totals[16]','$totals[17]','$totals[18]','$totals[19]','$totals[20]','$totals[21]','$totals[22]')";
					}

					else{

						$sql_order = "UPDATE orders2 set

							 order_type= '$order_name',
							 order_size='$order_size',
							 order_width='$order_custom_width',
							 order_height= '$order_custom_height',
							 order_quantity= '$order_quantity',
							 order_duration='$order_custom_duration',
							 order_unit_price= '$order_price',
							 order_lot_quantity='$order_lot_quantity',
							 order_total_price='$order_total_price',

							 order_make_format= '$order_make_format',
							 order_make_line= '$order_make_line',
							 order_make_format_beat='$order_make_format_beat',
							 order_make_header_glue= '$order_make_header_glue',
							 order_make_number_perforating='$order_make_number_perforating',
							 order_make_binding='$order_make_binding',
							 order_make_design= '$order_make_design',
							 order_submit_date='$order_submit_date',
							 order_promise_date='$order_promise_date',
							 order_description= '$order_description',
							 factor_start=$factor_start,
							 							 paperprice='$totals[0]',zinc='$totals[1]',print='$print_price',uv='$totals[4]',light='$totals[5]',uvm='$totals[6]',mat='$totals[7]',porfrag='$totals[8]',linebreak='$totals[9]',tigh='$totals[10]',manganeh='$totals[11]',sahafi='$totals[12]',numbering='$totals[13]',order_zinc='$totals[14]',order_tside='$totals[15]',papernum='$totals[16]',select_paper_id='$totals[17]',qty_print='$totals[18]',print_fee='$totals[19]',zinc_fee='$totals[20]',sarchasb='$totals[21]',linebreaka='$totals[22]'
 where order_id=$edit_id	 ";

						}

							mysqli_query($connection, "SET NAMES 'utf8'");
							mysqli_query($connection, "SET CHARACTER SET 'utf8'");
							mysqli_query($connection, "SET character_set_connection = 'utf8'");

							if ($connection->query($sql_order) === TRUE) {


									echo "سفارش شما با موفقیت ثبت شد .  پس از ایجاد فاکتور از بخش فاکتور ها نسبت به پرداخت فاکتور مربوطه اقدام فرمایید. با تشکر";


                                    $useremail=mysqli_query($connection, "SELECT email FROM users WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}

                                mail ( $sql_useremail_value, 'سفارش جدید شما ثبت شد' , 'با سلام، کاربر گرامی سفارش جدید شما در وب سایت شمیم ثبت گردید، لطفا جهت شروع پروسه انجام سفارش از قسمت فاکتور ها نسبت به پرداخت فاکتور مربوط به این سفارش اقدام فرمایید. با احترام - کانون تبلیغاتی و چاپخانه شمیم.' , "From: no-reply@shamimgraphic.ir" );

                               mail ( 'shamimtable@gmail.com' , 'سفارش جدید' , 'با سلام، یک سفارش جدید در وب سایت شمیم ثبت گردید. با تشکر' , "From: no-reply@shamimgraphic.ir" );




							   ?>

							   <br>


<br>


							   <?



		$order_insert_id= mysqli_insert_id($connection);
	    $name = 'وب سایت شمیم';
        $email = 'shamimbanner.ir';
        $subject = 'سفارش جدید';
        $message = 'شما یک سفارش جدید از وب سایت شمیم بنر دارید برای مشاهده سفارش خود روی لینک زیر کلیک کنید




'.$site_root_adress.'/admin/order-details-graphic.php?orderID='.$order_insert_id
;

							  mail ( 'shamimtable@gmail.com' , $subject , "از طرف:".$name."\r\n".$message , "from:".$email );



 $sql_upload_photo = mysqli_query($connection, "SELECT * FROM orders2 WHERE order_user='$user_id_value' AND order_invoice_code='$invoice_code_value'");
							$upload_photo_result = mysqli_fetch_array($sql_upload_photo);

			$file1=		$upload_photo_result['order_file1'];
			$file2=		$upload_photo_result['order_file2'];
			$file3=		$upload_photo_result['order_file3'];
			$file4=		$upload_photo_result['order_file4'];
?>

<br>
<br><center>
            <table class="order-details-files-div">
                <tr>
                    <th>فایل های سفارش</th>
                </tr>
                <tr>
                    <td>

      <? if(!empty($file1)){?>
<img src="<?=$file1?>" alt="فایل 1"/>
         <? }?>

               <? if(!empty($file2)){?>
<img src="<?=$file2?>" alt="فایل 2"/>
         <? }?>

               <? if(!empty($file3)){?>
<img src="<?=$file3?>" alt="فایل 3"/>
         <? }?>

               <? if(!empty($file4)){?>
<img src="<?=$file4?>" alt="فایل 4"/>
         <? }?>
                    </td>
                </tr>
            </table>
       </center>

<br />


<br />

                                 <div align="center">						               <div style="background-color:#093; color:#FFF">
  <h3>   قیمت کل : <?= $order_total_price+ $order_total_discount ?> تومان </h3>  </div>
 </div>


 <? if(!empty($order_total_discount)){ ?>
       <div align="center">						               <div style="background-color:#C03; color:#FFF">
  <h3>   تخفیف : <?= $order_total_discount ?> تومان </h3>  </div>
 </div>
<? } ?>

 <?
  $totaler=$order_total_price;
  if( $totaler >0){ ?>
      <div align="center">						               <div style="background-color:#9F3; color:#000">
  <h3>   مبلغ قابل پرداخت: <?= $totaler ?> تومان </h3>  </div>
 </div>
 <? } ?>

<br />
<br />





<div align="center">




<? 	$balance_user = mysqli_query($connection, "select sum(quantity) as balance from credits_list where approved=1 and  user='$user_id_value' group by approved");
	$balance= mysqli_fetch_array($balance_user);



		$amount=$totaler;


if ($balance['balance']>=$amount){


 ?>

     <form name="form2" method="post" preservedata="true" action="financial.php?do=paid&order=orders2&invoiceID=<?=$invoice_code_value?>">

 حساب کاربری شما: <?=number_format($balance['balance'])?> تومان <br />
<br />

        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت از حساب"/><br /><br />

      </form>

 <?
		}else{




?>



    <form name="form1" method="post" preservedata="true" action="http://shamimbanner.ir/users/payment.php">
<input type="text" style="display:none" name="invoice" value="<?= $invoice_code_value?>" />
<input type="text" style="display:none" name="amount" value="<?= $order_total_price?>" />
<input type="text" style="display:none" name="data" value="<?= $order_name."-".$user_id_value."-".$invoice_code_value."-".$width."X".$height;?>" />



لطفا مبلغ مورد نظر را پرداخت نمایید<br />
<br />




<table cellpadding="30" style="border:1px solid #999;" width="380"><tr><td align="center">پرداخت از طریق :</td>
<td align="right" valign="bottom">
بانک ملت<br />
<label><img src="library/images/mellat.jpg" width="85" height="85" />  </label></td>


</tr>
  <tr>
    <td colspan="3" align="center"><br />

        <input type="submit" class="sbmtclass" name="PayRequestButton" value="پرداخت"/><br /><br />


</td>

  </tr>
</table>
      </form>

<?
		}


		}




                                    $useremail=mysqli_query($connection, "SELECT email FROM users WHERE username = '$user_id_value'");
									while($sql_useremail = mysqli_fetch_array($useremail)){

									$sql_useremail_value = $sql_useremail['email'];
									}

                              //      mail ( $sql_useremail_value, 'سفارش جدید شما ثبت شد' , 'با سلام، کاربر گرامی سفارش جدید شما در وب سایت شمیم ثبت گردید، لطفا جهت شروع پروسه انجام سفارش از قسمت فاکتور ها نسبت به پرداخت فاکتور مربوط به این سفارش اقدام فرمایید. با احترام - کانون تبلیغاتی و چاپخانه شمیم.' , "From: no-reply@shamim14.ir" );

                                //    mail ( 'info@shamim14.ir' , 'سفارش جدید' , 'با سلام، یک سفارش جدید در وب سایت شمیم ثبت گردید. با تشکر' , "From: no-reply@shamim14.ir" );








}
else{
    echo "پس از ثبت فاکتور، هنگام ثبت نهایی سفارش مشکلی به وجود آمد. لطفا موضوع را به پشتیبانی سایت اطلاع دهید که فاکتور مربوطه حذف گردد و پس از آن نسبت به ثبت دوباره سفارش اقدام فرمایید و در صورت بروز مجدد مشکل، موضوع را با بخش پشتیبانی در میان بگذارید.";
    echo "Error: " . $sql_order . "<br>" . $connection->error;

}

?>













		<?

		}


	else{

    $dedicate_sql=mysqli_query($connection,"select * from  info");
    $d= mysqli_fetch_array( $dedicate_sql);
    $percent_1=$d['percent_1'];

    if (in_array($_SESSION["people_login"],$site_users)) {
        $discount_fee = $discount / 100;
    } else {
        $discount_fee = $percent_1 / 100;
    }
	?>



      <h2 class="user-panel-sheet-h2">سفارش جدید فرم عمومی اختصاصی</h2>




          <form action="" method="POST"   name="graphic_form" class="new-order-graphic" id="new-order-graphic" enctype="multipart/form-data" >

                   <div id="order-form-type-div">
      <? if(! $select_paper_query=mysqli_query($connection,"select * from paper_type group by type ")){ echo mysqli_error($connection);};?>
<h3>مشخصات کاغذ</h3><br>

<select name="select_paper_id"  id="service-name" onchange=" document.getElementById('submit1').click();">
<option value="">انتخاب</option>
<?
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['type'];?>"<? if($select_paper_id== $select_paper_fetch['type']){ echo "selected";};?>><? echo $select_paper_fetch['type'];?></option>
	<?

}
 ?>
</select>

     :  گراماژ                <? if(! $select_paper_query=mysqli_query($connection,"select * from paper_type where type='$select_paper_id'  group by gram ")){ echo mysqli_error($connection);};?>
                       <select name="select_paper_gram"  id="service-name" onchange=" document.getElementById('submit1').click();">
                           <option value="">انتخاب</option>
                           <?
                           while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
                               ?>

                               <option value="<? echo $select_paper_fetch['gram'];?>"<? if($select_paper_gram== $select_paper_fetch['gram']){ echo "selected";};?>><? echo $select_paper_fetch['gram'];?></option>
                               <?

                           }
                           ?>
                       </select>



                       سایز : <select name="paper_size"  id="service-name" onchange=" document.getElementById('submit1').click();">
   <option value=""  >انتخاب</option>
                           <? if($select_paper_id!="برچسب"){?>  <option value="3045" <? if($select_paper_size=="3045"){ echo "selected";};?> >30x45</option> <?; }?>
                                                                <option value="5035" <? if($select_paper_size=="5035"){ echo "selected";};?> >50x35</option>
                           <? if($select_paper_id!="برچسب"){?> <option value="6045" <? if($select_paper_size=="6045"){ echo "selected";};?> >60x45</option><?; }?>
                                                                 <option value="5070" <? if($select_paper_size=="5070"){ echo "selected";};?> >50x70</option>
</select>

  <?
?>

<br><br>

<h3>مشخصات زینک</h3>
<br>

  نوع چاپ :

 <select name="tside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="0" <? if($tside=="0"){ echo "selected";};?> >تک رو </option>
   <option value="1" <? if($tside=="1"){ echo "selected";};?> >دو رو (یک زینک)</option>
   <option value="2" <? if($tside=="2"){ echo "selected";};?> >دو رو (دو زینک)</option>

 </select>



زینک اول :

 <select name="zinc_type" id="service-name" onchange=" document.getElementById('submit1').click();" >
   <option>انتخاب کنید </option>

   <option value="4" <? if($zinc_type=="4"){ echo "selected";};?> >4 رنگ </option>
   <option value="2" <? if($zinc_type=="2"){ echo "selected";};?> >2 رنگ </option>
   <option value="1" <? if($zinc_type=="1"){ echo "selected";};?> >تک رنگ </option>

 </select>



<? if($tside=="2"){  ?>

 زینک دوم :

 <select name="zinc_type_sec" id="service-name" onchange=" document.getElementById('submit1').click();" >
   <option>انتخاب کنید </option>

   <option value="4" <? if($zinc_type_sec=="4"){ echo "selected";};?> >4 رنگ </option>
   <option value="2" <? if($zinc_type_sec=="2"){ echo "selected";};?> >2 رنگ </option>
   <option value="1" <? if($zinc_type_sec=="1"){ echo "selected";};?> >تک رنگ </option>

 </select>

<? }?>


 <br>
 <br>

تعداد کاغذ :

 <input type="text" name="papernum" value="<? if(isset($_POST['papernum']))
{echo $_POST['papernum'];}else{echo '1000';}?>" id="service-name"  onChange="document.getElementById('submit1').click();" >

<? if (empty($p_size)){$p_size="A";}?>

     <span>حاصل کار : <?=$_POST['papernum']*$cut_num_t ?> عدد

     <? if (!isset($_POST['cutpaper'])){?>
<? if(($select_paper_size=="3045" || $select_paper_size=="5035")){ ?>
     <select name="cut_num" id="service-name"  onChange="document.getElementById('submit1').click();">

   <option value="1" <? if($cut_num=="1"){ echo "selected";};?> ><?=$p_size?>3 </option>
   <option value="2" <? if($cut_num=="2"){ echo "selected";};?> ><?=$p_size?>4 </option>
   <option value="4" <? if($cut_num=="4"){ echo "selected";};?> ><?=$p_size?>5 </option>
	<option value="8" <? if($cut_num=="8"){ echo "selected";};?> ><?=$p_size?>6 </option>
	<option value="16" <? if($cut_num=="16"){ echo "selected";};?> ><?=$p_size?>7 </option>
	<option value="32" <? if($cut_num=="32"){ echo "selected";};?> ><?=$p_size?>8 </option>
    <option value="64" <? if($cut_num=="64"){ echo "selected";};?> ><?=$p_size?>9 </option>


 </select><? };?>

         <? if( ($select_paper_size=="6045" || $select_paper_size=="5070")){ ?>
             <select name="cut_num" id="service-name"  onChange="document.getElementById('submit1').click();">

             <option value="1" <? if($cut_num=="1"){ echo "selected";};?> ><?=$p_size?>2 </option>
   <option value="2" <? if($cut_num=="2"){ echo "selected";};?> ><?=$p_size?>3 </option>
   <option value="4" <? if($cut_num=="4"){ echo "selected";};?> ><?=$p_size?>4 </option>
	<option value="8" <? if($cut_num=="8"){ echo "selected";};?> ><?=$p_size?>5 </option>
	<option value="16" <? if($cut_num=="16"){ echo "selected";};?> ><?=$p_size?>6 </option>
	<option value="32" <? if($cut_num=="32"){ echo "selected";};?> ><?=$p_size?>7 </option>
    <option value="64" <? if($cut_num=="64"){ echo "selected";};?> ><?=$p_size?>8 </option>


             </select><? } };?>

 </span>


 <br>
 <br>

<h3>
<?= number_format( $total_show);?> تومان
 </h3>

                      <span> بعد از تخفیف :
                                <div id="show-price" style="display:inline-block; color:#BA0707">
                               <?  $discount_total=$total_show*$discount_fee;
							 echo  number_format( $total_show=$total_show-$discount_total);

							   ?> تومان
                                </div>
                                </span>

<br>





<?
 $dedicate_sql=mysqli_query($connection,"select * from dedicate_info");

$d= mysqli_fetch_array( $dedicate_sql); ?>


خدمات دیگر<br>
<br>

<input type="checkbox" name="cutpaper"  <? if($_POST['cutpaper']){ echo "checked";$mines_cut=1;}else{$mines_cut=2;}?> onChange="document.getElementById('submit1').click();"> برش
 <input type="text" name="cut_num" value="<? if(isset($_POST['cut_num']))
{echo floor($_POST['cut_num']/$mines_cut);}else{echo '0';}?>" id="service-name"  onChange="document.getElementById('submit1').click();"<? if(!$_POST['cutpaper']){ echo "disabled";};?>  style="width:40px" >
<br><br>



<input type="checkbox" name="uv" <? if($_POST['uv']){ echo "checked";};?>  onChange="document.getElementById('submit1').click();"> سلفون یو وی
                       <span> <select name="uvside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="1" <? if($uvside=="1"){ echo "selected";};?> >تک رو </option>
   <option value="2" <? if($uvside=="2"){ echo "selected";};?> >دو رو</option>


 </select></span>
<br><br>

<input type="checkbox" name="light"  <? if($_POST['light']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> سلفون براق
      <span> <select name="lightside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="1" <? if($lightside=="1"){ echo "selected";};?> >تک رو </option>
   <option value="2" <? if($lightside=="2"){ echo "selected";};?> >دو رو</option>


 </select></span>
<br><br>

<input type="checkbox" name="mat"  <? if($_POST['mat']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> سلفون مات
     <span> <select name="matside" id="service-name"  onChange="document.getElementById('submit1').click();" >


      <option value="1" <? if($matside=="1"){ echo "selected";};?> >تک رو </option>
   <option value="2" <? if($matside=="2"){ echo "selected";};?> >دو رو</option>


 </select></span>
<br><br>

<input type="checkbox" name="uvm"  <? if($_POST['uvm']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> سلفون یووی موضعی

     <span> <select name="uvmside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="1" <? if($uvmside=="1"){ echo "selected";};?> >تک رو </option>
   <option value="2" <? if($uvmside=="2"){ echo "selected";};?> >دو رو</option>


 </select></span>

 <br><br>


<input type="checkbox" name="linebreak"  <? if($_POST['linebreak']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
خط تا       <span> <select name="lineside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="افقی" <? if($lineside=="افقی"){ echo "selected";};?> >افقی</option>
   <option value="عمودی" <? if($lineside=="عمودی"){ echo "selected";};?> >عمودی</option>


 </select></span>
<br><br>
<input type="checkbox" name="porfrag"  <? if($_POST['porfrag']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
پر فراژ      <span> <select name="porfragside" id="service-name"  onChange="document.getElementById('submit1').click();" >


   <option value="افقی" <? if($porfragside=="افقی"){ echo "selected";};?> >افقی</option>
   <option value="عمودی" <? if($porfragside=="عمودی"){ echo "selected";};?> >عمودی</option>


 </select></span>



<br><br>
<input type="checkbox" name="tigh" <? if($_POST['tigh']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
تیغ زنی


 <br><br>







<input type="checkbox" name="numbering" <? if($_POST['numbering']){ echo "checked";};?> onChange="document.getElementById('submit1').click();">
شماره زنی

 <span>
 <input type="text" name="factor_start" value="<? if(isset($_POST['factor_start']))
{echo $_POST['factor_start'] ;}?>" id="service-name"  onChange="document.getElementById('submit1').click();"<? if(!$_POST['numbering']){ echo "disabled";};?>  placeholder="شروع شماره از" >

</span>
<br><br>





<input type="checkbox" name="sarchasb" <? if($_POST['sarchasb']){ echo "checked";};?> onChange="document.getElementById('submit1').click();"> سر چسب

<br>
<br>

                          <?   if (preg_match('/shamim/',$user_id_value)){?>
            شماره فاکتور :    <input name="factor_num"  value="<?=$factor?>"   id="factor_num" style="width:50px" alt=""   <? if(!empty($_GET['factor'])){echo "readonly";} ?>>        <span  style="font-size:9px">اگر قبلا فاکتور شده شماره فاکتور را وارد کنید</span> <br>

<? }?> <input name="edit_id" value="<?=$edit_id?>"  id="edit_id"  style="display:none">
                                <br/><small>(چنانچه فایل در دست طراح است. یک فایل سفید جایگزاری کنید)  </small><br>
                                <label for="order-file-1">فایل 1:</label><input type="file" name="order-file-1" id="file1" accept="image/jpg, image/jpeg, image/tiff"   /><br/>
                                <input value="" type="text" name="order-file-input-1" id="file-text-1"  style="display:none"/>
                               <label for="order-file-2">فایل 2:</label><input type="file" name="order-file-2"  id="file2" accept="image/jpg, image/jpeg, image/tiff" ><br/>
                                <input value=""  type="text" name="order-file-input-2" id="file-text-2" style="display:none"/>


                                <label for="order-file-3">فایل 3:</label><input type="file" name="order-file-3"  id="file3" accept="image/jpg, image/jpeg, image/tiff"><br/>
                                  <input value=""  type="text" name="order-file-input-3" id="file-text-3" style="display:none"/>

                                <label for="order-file-4">فایل 4:</label><input type="file" name="order-file-4"  id="file4" accept="image/jpg, image/jpeg, image/tiff">
                                  <input value=""  type="text" name="order-file-input-4" id="file-text-4" style="display:none"/>

                                <br/>

                              <progress id="progressBar" value="0" max="100" style="width:300px; display: none"></progress>

                              <div id="loaded_n_total"></div>
                              <div id="status"></div>
                                <br/>



                        <br/><p>در صورت انتخاب کار اضافه، در قسمت توضیحات وارد کنید. مبلغ آن پس از بررسی توسط واحد سفارشات به صورت جداگانه فاکتور خواهد شد.</p>
 <br><br>
            </div>

                        <div id="order-form-description-div">


<br>


                                <h3 class="user-panel-sheet-h3">توضیحات:</h3>
                                <textarea id="order-form-description" name="order-description"></textarea>
                        </div>

                        <input type="submit"  id="submit1"  name="submit1"  class="profile-edit-submit" style="display:none">

                          <input type="submit"  id="submit2"  name="submit2" value="ثبت و ارسال سفارش"  class="profile-edit-submit"  style="display:none">
      </form>

  <input type="button"  value="ثبت و ارسال سفارش" class="profile-edit-submit" onclick="uploadFile()">

<?php }

  ?>  </section>

<script type="text/javascript">

    function _(el){
        return document.getElementById(el);
    }
    function uploadFile(){
        $("#progressBar").show();
        var file1 = _("file1").files[0];
        var file2 = _("file2").files[0];
        var file3 = _("file3").files[0];
        var file4 = _("file4").files[0];

                  if (file1) {  _("file-text-1").value= _("file1").files[0].name;  }
                    if (file2) {  _("file-text-2").value= _("file2").files[0].name;  }
                      if (file3) {  _("file-text-3").value= _("file3").files[0].name;  }
                        if (file4) {  _("file-text-4").value= _("file4").files[0].name;  }
        //alert(file.name+" | "+file.size+" | "+file.type);
        var formdata = new FormData();
        formdata.append("order-file-1", file1);
        formdata.append("order-file-2", file2);
        formdata.append("order-file-3", file3);
        formdata.append("order-file-4", file4);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "upload_listner.php");
        ajax.send(formdata);
    }
    function progressHandler(event){
        _("loaded_n_total").innerHTML = "آپلود "+event.loaded+" بایت از "+event.total;
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        _("status").innerHTML = Math.round(percent)+"% آپلود شده... لطفا صبر کنید";
    }
    function completeHandler(event){
        _("status").innerHTML = event.target.responseText;

                   _("file1").value="";
                   _("file2").value="";
                   _("file3").value="";
                   _("file4").value="";

                   $( "#submit2" ).click();
    }
    function errorHandler(event){
        _("status").innerHTML = "آپلود ناموفق";
    }
    function abortHandler(event){
        _("status").innerHTML = "آپلود متوقف شد";
    }

</script>

  <? include ("footer.php");?>
