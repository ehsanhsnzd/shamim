<? include("../function/db.php");?>
<?
//Check access
admin_panel_access("orders_coupons");



$coupon_code=md5(create_password().mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));



$sql="insert into coupons (title,user,data2,total,percentage,url,used,data,ulimit,tlimit,coupon_code,coupon_id) values ('".result($_POST["title"])."','".result($_POST["user"])."',".mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")).",".(float)$_POST["total"].",".(float)$_POST["percentage"].",'".result($_POST["url"])."',0,".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))+$_POST["days"]*3600*24).",".(int)$_POST["limit_of_usage"].",0,'".$coupon_code."',0)";
$db->execute($sql);

	
header("location:index.php");

?>
