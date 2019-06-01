<?php



 require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">

        <h2 class="user-panel-sheet-h2">حساب</h2>

<p>
  <?php
	

	require ('../db_select.php');
	
	
 	$input_paper_name=$_POST['paper_name'];
	$input_paper_size=$_POST['paper_size'];
	$input_paper_price=$_POST['paper_price'];
	$paper_id=$_POST['select_paper_id'];
	
	if(isset($_GET['select_paper_id'])){	$select_paper_id=$_GET['select_paper_id'];};
	if(isset($_POST['select_paper_id'])){	$select_paper_id=$_POST['select_paper_id'];};
	
		if(isset($_GET['select_paper_size'])){	$select_paper_size=$_GET['select_paper_size'];};
	if(isset($_POST['paper_size'])){	$select_paper_size=$_POST['paper_size'];};
	
	
 
	if(isset($_POST['add_size'])){
		
	 
		
	if(	!mysqli_query($connection,"insert into paper set name='$input_paper_name' , size='$input_paper_size', price='$input_paper_price'")){ echo mysqli_error($connection);};
		
		}
		
			
	if(isset($_POST['edit_size'])){
		
		
		
			if(	!mysqli_query($connection,"update paper set name='$input_paper_name' , size='$input_paper_size', price='$input_paper_price' where name='$select_paper_id' and size ='select_paper_size'")){ echo mysqli_error($connection);};
		
		}
		
			if(isset($_POST['del_size'])){
		
		
		
		mysqli_query($connection,"delete from paper where name='$select_paper_id' and size ='select_paper_size'");
		
		}
	
$size=	$_POST['paper_size'];
$zinc_type=$_POST['zinc_type'];
 
$paperprice=	$_POST['paperprice'];

if(isset($_POST['2side']))
{
	$qty= $_POST['papernum']*2;}
else{$qty= $_POST['papernum'];}

 $qty_paper=$_POST['papernum']/1000;
$qty_print= $qty/1000;


	if (isset($_POST['submit'])){
		
		switch ($size.$zinc_type) {
			
		  case '30454':
                    $zinc = 50000;
                    $print = 70000;
					$next_price1=25000;
				//	$next_price2=50000;
                    break;
 
 		  case '50354':
                    $zinc = 50000;
                    $print = 70000;
					$next_price1=25000;
				//	$next_price2=50000;
                    break;
 
 		  case '60454':
   					$zinc = 100000;
                    $print = 140000;
					$next_price1=50000;
				//	$next_price2=50000;
                    break;
 
 		  case '50704':
     				$zinc = 100000;
                    $print = 140000;
					$next_price1=50000;
					//$next_price2=50000;
                    break;
					
 ///////////////////////
 
		   case '30452':
                    $zinc = 40000;
                    $print = 40000;
					$next_price1=20000;
				//	$next_price2=40000;
                    break;
 
 		  case '50352':
                    $zinc = 40000;
                    $print = 40000;
					$next_price1=20000;
			//		$next_price2=40000;
                    break;
 		  case '60452':
   				 $zinc = 80000;
                    $print = 80000;
					$next_price1=40000;
			//		$next_price2=80000;
                    break;
 
 		  case '50702':
     				 $zinc = 80000;
                    $print = 80000;
					$next_price1=40000;
			//		$next_price2=80000;
                    break;
					
					//////////////////////////////////
					
					
		  case '30451':
                    $zinc = 20000;
                    $print = 20000;
					$next_price1=10000;
				//	$next_price2=20000;
                    break;
 
 		  case '50351':
                 $zinc = 20000;
                    $print = 20000;
					$next_price1=10000;
				//	$next_price2=20000;
                    break;
 		  case '60451':
   					 $zinc = 40000;
                    $print = 40000;
					$next_price1=20000;
				//	$next_price2=40000;
                    break;
 
 		  case '50701':
     				 $zinc = 40000;
                    $print = 40000;
					$next_price1=20000;
				//	$next_price2=40000;
                    break;
 
 
}
$papernum=$_POST['papernum'];
$paperprice=(($paperprice*$papernum));

$uv_value=$_POST['uv_value'];
$light_value=$_POST['light_value'];
$porfrag_value=$_POST['porfrag_value'];
$tigh_value=$_POST['tigh_value'];
$manganeh_value=$_POST['manganeh_value'];
$numbering_value=$_POST['numbering_value'];
$template_value=$_POST['template_value'];
$sahafi_value=$_POST['sahafi_value'];

if($qty_print>1 ){$next_print=($qty_print-1)*$next_price1;}





if(isset($_POST['uv']) && $size==3045 || isset($_POST['uv']) &&  $size==5035){ $uv=$uv_value*$qty_print;}
if(isset($_POST['uv']) && $size==6045 || isset($_POST['uv']) &&  $size==5070){ $uv=($uv_value*2)*$qty_print;}

if(isset($_POST['light']) && $size==3045 || isset($_POST['light']) &&  $size==5035){ $light=$light_value*$qty_print;}
if(isset($_POST['light']) && $size==6045 || isset($_POST['light']) &&  $size==5070){ $light=($light_value*2)*$qty_print;}


if(isset($_POST['porfrag'])){ $porfrag=$porfrag_value*$papernum;}
if(isset($_POST['numbering'])){ $numbering=$numbering_value*$papernum;}
if(isset($_POST['tigh'])){ $tigh=$tigh_value*$qty_paper;}
if(isset($_POST['manganeh'])){   $manganeh=$manganeh_value *$papernum ;}
if(isset($_POST['template'])){$template=$template_value;}
if(isset($_POST['sahafi'])){$sahafi=$sahafi_value*$qty_paper;}

 
		 $total=$paperprice+$zinc+$print+$next_print+$uv+ $light+$porfrag+$tigh+ $manganeh+$template+$sahafi+$numbering;
			
			}
 
	?>
    
    <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
      <? if(! $select_paper_query=mysqli_query($connection,"select * from paper group by name ")){ echo mysqli_error($connection);};?>
<h3>مشخصات کاغذ</h3>
<select name="select_paper_id"  onchange="window.location='?select_paper_id='+this.value">
<option value="">انتخاب</option>
<?
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['name'];?>"<? if($select_paper_id== $select_paper_fetch['name']){ echo "selected";};?>><? echo $select_paper_fetch['name'];?></option>
	<?
	
}
 ?>
</select> 
  
  
 سایز : <select name="paper_size" onchange="window.location='?select_paper_id=<?=$select_paper_id?>&select_paper_size='+this.value">
   <option value=""  >انتخاب</option>
   <option value="3045" <? if($select_paper_size=="3045"){ echo "selected";};?> >30x45 </option>
   <option value="5035" <? if($select_paper_size=="5035"){ echo "selected";};?> >50x35 </option>
   <option value="6045" <? if($select_paper_size=="6045"){ echo "selected";};?> >60x45 </option>
   <option value="5070" <? if($select_paper_size=="5070"){ echo "selected";};?> >50x70 </option>
</select>

  <?
  if (isset($select_paper_id )&& isset($select_paper_size)){
  
   if(! $select_paperid_query=mysqli_query($connection,"select * from paper where name = '$select_paper_id' and size = $select_paper_size ")){ echo mysqli_error($connection);};

 
 $select_price=mysqli_fetch_assoc( $select_paperid_query);
  }?>

قیمت کاغذ : <input type="text" name="paperprice" value="<?=$select_price['price']/10;?>"> تومان 
<br><br>
<br>
<h3>مشخصات زینک</h3>

 
 نوع :

 <select name="zinc_type"  >
 
   <option value="4" <? if($zinc_type=="4"){ echo "selected";};?> >4 رنگ </option>
   <option value="2" <? if($zinc_type=="2"){ echo "selected";};?> >2 رنگ </option>
   <option value="1" <? if($zinc_type=="1"){ echo "selected";};?> >تک رنگ </option>
  
 </select>
 <br>
 <br>

تعداد کاغذ :  
  
 <input type="text" name="papernum" value="<? if(isset($_POST['papernum']))
{echo $_POST['papernum'];}else{echo '1000';}?>" ><input type="checkbox" name="2side" <? if($_POST['2side']){ echo "checked";};?>> دو رو
 <br>
<br>

 
<br>
  <br>
  



<span style="font-size:24px">
<?= number_format($total)?>
 تومان</span>
<br><br><br>

<input type="submit" name="submit" value="حساب">
.............................................................................................................<br><br><br>


خدمات دیگر<br>
<br>

<input type="checkbox" name="uv" <? if($_POST['uv']){ echo "checked";};?>> سلفون uv  <input type="text" name="uv_value" value="<? if(isset($_POST['uv_value']))
{echo $_POST['uv_value'];}else{echo '100000';}?>">
 :تومان
<br>

<input type="checkbox" name="light"  <? if($_POST['light']){ echo "checked";};?>> سلفون براق <input type="text" name="light_value" value="<? if(isset($_POST['light_value']))
{echo $_POST['light_value'];}else{echo '120000';}?>">
 :تومان
<br>
<input type="checkbox" name="tigh" <? if($_POST['tigh']){ echo "checked";};?>>
تیغ زنی <input type="text" name="tigh_value" value="<? if(isset($_POST['tigh_value']))
{echo $_POST['tigh_value'];}else{echo '30000';}?>">
 :تومان<br>
 
 
<input type="checkbox" name="porfrag"  <? if($_POST['porfrag']){ echo "checked";};?>> خط تا یا پر فراژ  <input type="text" name="porfrag_value" value="<? if(isset($_POST['porfrag_value']))
{echo $_POST['porfrag_value'];}else{echo '30';}?>">
 :تومان
<br>



<input type="checkbox" name="manganeh" <? if($_POST['manganeh']){ echo "checked";};?>> 
منگنه <input type="text" name="manganeh_value" value="<? if(isset($_POST['manganeh_value']))
{echo $_POST['manganeh_value'];}else{echo '50';}?>">
 :تومان<br>
<input type="checkbox" name="numbering" <? if($_POST['numbering']){ echo "checked";};?>> 
شماره زنی <input type="text" name="numbering_value" value="<? if(isset($_POST['numbering_value']))
{echo $_POST['numbering_value'];}else{echo '10';}?>">
 :تومان<br>
<input type="checkbox" name="template" <? if($_POST['template']){ echo "checked";};?>> 
قالب <input type="text" name="template_value"  value="<?= $_POST['sahafi_value'];?>">
:تومان<br>
<input type="checkbox" name="sahafi" <? if($_POST['sahafi']){ echo "checked";};?>> 
صحافی <input type="text" name="sahafi_value" value="<?= $_POST['sahafi_value'];?>" >
 :تومان
<br>
<br>
<br>


</form>
.............................................................................................................<br><br><br><br><br><br>

<? if(! $select_paper_query=mysqli_query($connection,"select * from paper group by name ")){ echo mysqli_error($connection);};?>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">


<h3>ویرایش کاغذ</h3>
<select name="select_paper_id"  onchange="window.location='?select_paper_id='+this.value+'&select_paper_size='+<?=$select_paper_size?>">
<option value="">انتخاب</option>
<?
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['name'];?>"<? if($select_paper_id== $select_paper_fetch['name']){ echo "selected";};?>><? echo $select_paper_fetch['name'];?></option>
	<?
	
}
 ?>
</select>


 سایز : <select name="paper_size" onchange="window.location='?select_paper_id=<?=$select_paper_id?>&select_paper_size='+this.value">
   <option value=""  >انتخاب</option>
   <option value="3045" <? if($select_paper_size=="3045"){ echo "selected";};?> >30x45 </option>
   <option value="5035" <? if($select_paper_size=="5035"){ echo "selected";};?> >50x35 </option>
   <option value="6045" <? if($select_paper_size=="6045"){ echo "selected";};?> >60x45 </option>
   <option value="5070" <? if($select_paper_size=="5070"){ echo "selected";};?> >50x70 </option>
</select><br>
<br>

<?
  if (isset($select_paper_id) && isset($select_paper_size)){
  
   if(! $select_paperid_query=mysqli_query($connection,"select * from paper where name = '$select_paper_id' and size = '$select_paper_size' ")){ echo mysqli_error($connection);};

 
 $select_price=mysqli_fetch_assoc( $select_paperid_query);
  }?>

 

نام کاغذ:<input type="text" name="paper_name" value="<?= $select_price['name']?>">

قیمت:<input type="text" name="paper_price" value="<?= $select_price['price']?>"> ریال
<br>
<br>
<br>


<input type="submit" name="add_size" value="اضافه">

<input type="submit" name="edit_size" value="ویرایش">

<input type="submit" name="del_size" value="حذف">
</form> 
<br>

<?php include ("footer.php"); ?>