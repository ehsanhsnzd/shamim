<?php require ("header.php");

include_once('library/jdf.php'); ?>

<?php include ("sidebar.php");?>
	<section id="admin-panel-sheet">

	<h2>افزودن بنر</h2>

		<?php
		require ('../db_select.php');
		
		if (isset($_POST['submit2'])) {
		$month=$_POST['month'];
		$date_from=gregoriandate($_POST['date_from']);
		$text=$_POST['txt'];
		$monthq="insert into date_month set date_from= '$date_from' ,text='$text',month_id=$month ";
	
	
	if(!mysqli_query($connection,$monthq)){ echo "ارور: " .$connection->error ;
		}
			
			}
			
				if (isset($_POST['submit3'])) {
		
		$date_from=gregoriandate($_POST['date_from']);
		$date_to=gregoriandate($_POST['date_to']);
		$name_month=$_POST['name_month'];
		$monthq="insert into months set datef= '$date_from',datet= '$date_to' ,name='$name_month' ";
	
	
	if(!mysqli_query($connection,$monthq)){ echo "ارور: " .$connection->error ;
		}
			
			}
		
		
		
		if (isset($_POST['deleteday'])) {
	
	$dayid=$_POST['dayid'];
	
		$monthq="delete from date_month where id =$dayid ";
	
	
	if(!mysqli_query($connection,$monthq)){ echo "ارور: " .$connection->error ;
		}			

}

		if (isset($_POST['deletemonth'])) {
	
	$dayid=$_POST['dayid'];
	
		$monthq="delete from months where id =$dayid ";
	
	
	if(!mysqli_query($connection,$monthq)){ echo "ارور: " .$connection->error ;
		}			

}

 
if (isset($_POST['submit1'])) {

	 
		
		$invoice_user = $_POST['username'];
		$invoice_comment = $_POST['comment'];
		$invoice_price = $_POST['price'];
 
		$invoice_c_date =  jdate('Y-n-j H:i:s');


    
	
	
		
	

		$upload_path = '../banner/';

$service=$_POST['dropdown'];
$type=$_POST['type'];
$filename = $_FILES['userfile']['name'];
$extension=".".end(explode(".", $filename));	
$datef=gregoriandate($_POST['datef']);	
$datet=gregoriandate($_POST['datet']);	
$monthid=$_POST['monthid'];	
$dayid=$_POST['dayid'];


	

if(!is_writable($upload_path)){
 echo 'You cannot upload to the specified directory, please CHMOD it to 777.';}
else{
	
if(file_exists($_FILES['userfile']['tmp_name'])){	
	$pathi = $_FILES['userfile']['name'];
	$ext = pathinfo($pathi, PATHINFO_EXTENSION);
	
if($ext != "jpg" && $ext != "png" && $ext != "jpeg"
&& $ext != "gif"
&& $ext != "GIF"
&& $ext != "JPEG"
&& $ext != "PNG"
&& $ext != "JPG" )
{ $this->HandleError( "پسوند فایل ناشناس است");}
	$reserveq="insert into gallery set photo= 'Banner-"."',ext='$extension', service='$service' , type='$type',monthid=$monthid ,dayid=$dayid ";
	
	if(!mysqli_query($connection,$reserveq)){ echo "ارور: " .$connection->error ;
		}	
$photo_id = mysqli_insert_id($connection);
if(!file_exists("Banner-".$service.'-'.$photo_id.$extension )){
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . "Banner-".$service."-".$photo_id.$extension)) { 
		
 

} else {
    $this->HandleError("مشکلی در آپلود عکس وجود دارد");
}
}
}
} 
echo "  با موفقیت ذخیره شد. ";

 
 
?>	
	
<?

	}
	 
?>	
	
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"   id="options"  enctype="multipart/form-data">
   <br>

<select id="dropdown" name="dropdown" onchange="this.form.submit()">
    <option value="select" selected="selected">Select</option>
 <?php $selectq=mysqli_query($connection,"select * from services where hide =1");
    while ($usersRow = mysqli_fetch_array($selectq)){
$drop=$_POST['dropdown'];
if(empty($_GET['service']) && !$drop){$drop=1 ;}elseif(!empty($_GET['service'])){$drop=$_GET['service'];}

        echo "<option value=\"".$usersRow['id']."\"";
          if($drop==$usersRow['id']){echo " selected ";}
		  
		  echo ">".$usersRow['name']."</option>\n";

    }
    ?>
  </select> 
  
  <select id="dropdown" name="type">

 

    <option value="big" <? if($_POST['type']=='big'){echo 'selected';}?>>بزرگ 3X1</option>
       <option value="normal" <? if($_POST['type']=='normal'){echo 'selected';}?>>متوسط 3X0.80</option>
    <option value="small" <? if($_POST['type']=='small'){echo 'selected';}?>>کوچک 2X1</option>
     <option value="stand" <? if($_POST['type']=='stand'){echo 'selected';}?>>استند 2X0.90</option>

  
  
  </select> 
   <br>
   <br>
   
      
  <input type="file"  name="userfile" id="fileToUpload" class="inpts" style="width:200px" value="<? echo $_POST['userfile'] ?>"/>	
  <br><br>
<br>


        
       <? if($drop==36){
		   ?> ماه:
            <select id="service-name" name="monthid"  required>
                                <option value="" disabled selected>انتخاب کنید</option>

                        <?php
$month=$_POST['month'];
                        parse_str($_SERVER['QUERY_STRING']);
                     

                        $dbresult=mysqli_query($connection, "SELECT * FROM months order by id ");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['name'];
                                $order_id = $row['id'];
                                if($month == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                                echo "<option value=\"$order_id\" ".$selected.">$order_name</option>";
                        }
                        ?>

                                </select>
                                <input type="submit" name="deletemonth" value="حذف ">
                                <br>
            
<br />

            
             مناسبت : 
<select id="service-name" name="dayid"  required>
                                <option value="" disabled selected>انتخاب کنید</option>

                    <?php
$month=$_POST['month'];
                        parse_str($_SERVER['QUERY_STRING']);
                     

                        $dbresult=mysqli_query($connection, "SELECT * FROM date_month ");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['text'];
                                $order_id = $row['id'];
                                if($month == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                                echo "<option value=\"$order_id\" ".$selected.">$order_name</option>";
                        }
                        ?>

                                </select> <input type="submit" name="deleteday" value="حذف "><br>
<br>
<br>
<br>

  
		   
		   
		   
		   
	<?	   } 
        ?>
        		<input type="submit" name="submit1" value="ثبت "><br>
<br>

		</form>
      <? echo "  <table width='100%'><tr>";
					 $serv =$drop;
					 
							 $selgq= mysqli_query($connection,"select * from gallery where service=$serv");
						 while($selg=mysqli_fetch_array($selgq)){
$i++; ?><td align="center">
 
<img src="../banner/Banner-<? echo $drop.'-'. $selg['id'].$selg['ext']; ?>"  onclick="changeText(<? echo $selg['id'] ?>)"/> <a href="?action=delete&id=<?= $selg['id']?>&ext=<?= $selg['ext']?>&service=<?= $drop ?>">X</a>
<? $id=$_GET['id']; $file="../banner/Banner-".$_GET['service'].'-'. $id.$_GET['ext'];
if($_GET['action']=='delete' && isset($_GET['id']))
{
	mysqli_query($connection,"delete from gallery where id = $id");
 
if (@!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
	
	}


 ?>

</td>

				 
							 
							 
						<?	if($i % 2 == 0){ echo '</tr><tr>';} 
						
						
						
						}
						?></tr></table>
	   <strong class='ui-state-error'> </strong><br />
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"   id="options"  enctype="multipart/form-data">
   <br>
   <br>
   <br>
   <br>اضافه کردن عنوان های مناسبتی :<br>
<br>




  
  
        
       <? if($drop==36){
		   ?>
     
            <br>
            <br>
            ماه :
            <select id="service-name" name="month"  required>
                                <option value="" disabled selected>انتخاب کنید</option>

                        <?php
$month=$_POST['month'];
                        parse_str($_SERVER['QUERY_STRING']);
                     

                        $dbresult=mysqli_query($connection, "SELECT * FROM months order by id");

                        while($row = mysqli_fetch_array($dbresult)){
                                $order_name = $row['name'];
                                $order_id = $row['id'];
                                if($month == $order_id){
                                     $selected = "selected";
                                }
                                else{
                                     $selected = "";
                                }
                                echo "<option value=\"$order_id\" ".$selected.">$order_name</option>";
                        }
                        ?>

                                </select>
                    
      <br>
            <br>
فیلد مناسبت : 
      <textarea name="txt" cols="100" rows="13" tabindex="4" style="font-family:Tahoma, Arial, Verdana; font-size:11px; direction:rtl; line-height:120%"></textarea> <br>
<br>
<br>
<br>

  
		   
		   
		   <input type="submit" name="submit2" value="ثبت ">
		   
	<?	   } 
        ?>
        		
	  </form>
    
    	   <strong class='ui-state-error'> </strong>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"   id="options"  enctype="multipart/form-data">
   <br>
   <br>
   <br>
   ایجاد ماه ها :
   
   <br><br>
<br>


  
  
        
       <? if($drop==36){
		   ?>
       <br />
            از تاریخ:
            <input type="text" id="datepicker2"  name="date_from"/>
            <br>
            <br>
                      تا تاریخ:
            <input type="text" id="datepicker4"  name="date_to"/>
            <br>
            <br>
                    
            <br>
            <br>
ماه : 
                      <input type="text" id="datepicker4"  name="name_month"/> <br>
<br>
<br>
<br>

  
		   
		   
		   <input type="submit" name="submit3" value="ثبت ">
		   
	<?	   } 
        ?>
        		
	  </form>   
    
    
    </section>
    
    
    


<?php

	function selectdate($table,$id){
	
		  if(!$this->DBLogin())
        {
            return false;
        }

$query="select expire from $table where id = $id";
$runquery=mysql_query($query);
$expire = mysql_fetch_assoc($runquery);

$date=$expire['expire'];
if(strtotime($date)>time()){
$newdate= strtotime($date);
}else{$newdate=time();}
return $newdate;
		}
		
		
		
function persiandate($date){

return  jdate('d/m/Y',$date,'none','Iran/Tehran','en');
}
		

		function gregoriandate($date){
	$dates = explode('/', $date);

$resdate= strtotime(jalali_to_gregorian($dates[2] , $dates[1] ,$dates[0] ,'-'));

	   $cdate = date('Y-m-d',$resdate);
	return $cdate;
		}



 include ("footer.php"); ?>