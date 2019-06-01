<?php



 require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="admin-panel-sheet">



<p>
  <?php
	

	require ('../db_select.php');


  $paper_type=$_POST['paper_type'];
  $paper_gram=$_POST['paper_gram'];
  $paper_price=$_POST['paper_price'];

  $select_paper_gram=$_POST['select_paper_gram'];
  $select_paper_type=$_POST['select_paper_type'];
 
	if(isset($_POST['add_size'])){

	if(	!mysqli_query($connection,"insert into paper_type set type='$paper_type' , gram='$paper_gram', price='$paper_price'")){ echo mysqli_error($connection);};
		
		}
		
			
	if(isset($_POST['edit_size'])){

			if(	!mysqli_query($connection,"update paper_type set price='$paper_price' where type='$select_paper_type'")){ echo mysqli_error($connection);};
		
		}
		
			if(isset($_POST['del_size'])){
		
 
		if(	!mysqli_query($connection,"delete from paper_type  where type='$select_paper_type' and gram ='$select_paper_gram'")){ echo mysqli_error($connection);};
		
		}
	


?>
.............................................................................................................<br><br><br><br><br><br>

<? if(! $select_paper_query=mysqli_query($connection,"select * from paper_type group by type ")){ echo mysqli_error($connection);};?>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post" id="service-add-form">


<h3>ویرایش کاغذ</h3>
<select name="select_paper_type"  onchange="window.location='?type='+this.value +'&gram=<?= $_GET['gram']?>'">
<option value="">انتخاب</option>
<?
while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
	?>

<option value="<? echo $select_paper_fetch['type'];?>"<? if($_GET['type']== $select_paper_fetch['type']){ echo "selected";};?>><? echo $select_paper_fetch['type'];?></option>
    <?
	
}
 ?>
</select>

<?
$s_paper_type=$_GET['type'];
if(! $select_paper_query=mysqli_query($connection,"select * from paper_type where type='$s_paper_type' group by gram")){ echo mysqli_error($connection);};?>

       گراماژ:
        <select name="select_paper_gram"  onchange="window.location='?gram='+this.value+'&type=<?=$_GET['type']?>'">
            <option value="">انتخاب</option>
            <?
            while($select_paper_fetch=mysqli_fetch_array($select_paper_query)){
                ?>

                <option value="<? echo $select_paper_fetch['gram'];?>"<? if($_GET['gram']== $select_paper_fetch['gram']){ echo "selected";};?>><? echo $select_paper_fetch['gram'];?></option>
                <?

            }
            ?>
        </select><br>
<br>

<?

$paper_type=$_GET['type'];
$paper_gram=$_GET['gram'];

  if (isset($paper_type) && isset($paper_gram)){
  
   if(! $select_paperid_query=mysqli_query($connection,"select * from paper_type where type = '$paper_type' and gram = '$paper_gram' ")){ echo mysqli_error($connection);};

 
 $select_price=mysqli_fetch_assoc( $select_paperid_query);
  }?>

 

نوع کاغذ:<input type="text" name="paper_type" value="<?= $select_price['type']?>">

 گراماژ:<input type="text" name="paper_gram" value="<?= $select_price['gram']?>">

قیمت:<input type="text" name="paper_price" value="<?= $select_price['price']?>"> ریال
<br>
<br>
<br>


<input type="submit" name="add_size" value="اضافه">

<input type="submit" name="edit_size" value="ویرایش">

<input type="submit" name="del_size" value="حذف">
</form> 
<br>
    </section>

<?php include ("footer.php"); ?>