<?include("../admin/function/db.php");?>
<?if(!isset($_SESSION["people_id"])){header("location:/login.php");}?>
<?



$flag=true;

//Проверяем есть ли такой пользователь
$sql="select * from users where login='".result($_POST["login"])."'";
echo($sql);
$rs->open($sql);
if(!$rs->eof and $_POST["login"]!=$_SESSION["people_login"])
{
$flag=false;
header("location:profile_about.php?d=1");
}

//Проверяем есть ли такой e-mail
$sql="select * from users where email='".result($_POST["email"])."'";
$rs->open($sql);
if(!$rs->eof  and $_POST["email"]!=$_SESSION["people_email"])
{
$flag=false;
header("location:profile_about.php?d=2");
}





if($flag==true)
{

if(isset($_POST["newsletter"])){$newsletter=1;}
else{$newsletter=0;}

$sql="update users set login='".result2($_POST["login"])."',password='".md5(result2($_POST["password"]))."',email='".result2($_POST["email"])."',name='".result2($_POST["name"])."',telephone='".result2($_POST["telephone"])."',address='".result2($_POST["address"])."',country='".result2($_POST["country"])."',city='".result2($_POST["city"])."',state='".result2($_POST["state"])."',zipcode='".result2($_POST["zipcode"])."',lastname='".result2($_POST["lastname"])."',description='".result2($_POST["description"])."',website='".result2($_POST["website"])."',utype='".result2($_POST["utype"])."',company='".result2($_POST["company"])."',newsletter=".$newsletter.",business=".(int)$_POST["business"]."  where id_parent=".(int)$_SESSION["people_id"];

$db->execute($sql);
$_SESSION["people_name"]=result2($_POST["name"]);
$_SESSION["people_email"]=result2($_POST["email"]);
header("location:profile_about.php?d=3");
}





?>