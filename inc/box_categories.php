<?

$hmenu="";




$hmenu.="<ul class=\"nav navbar-nav  pull-right\">";

//$hmenu.="<li><a href='".site_root."/'>".word_lang("home")."</a></li>";
//$hmenu.="<li><a href='../fee.php'>".word_lang("تعرفه")."</a></li>";









//Build categories tree
	$itg="";
	if (!$smarty->is_cached('buildmenu6.tpl',"buildmenu|6"))
	{
		$nlimit=0;
		buildmenu6(5);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu6', $itg);
	$itg=$smarty->fetch('buildmenu6.tpl',"buildmenu|6");




//if(!isset($_SESSION["site_info_content"]))
//{
//	$site_info_content="";
//	$sql="select id_parent,link,title,url from pages where siteinfo=1 order by priority";
//	$rs->open($sql);
//	while(!$rs->eof)
//	{
//		$url=page_url($rs->row["id_parent"],$rs->row["url"]);
//		if($rs->row["link"]!=""){$url=$rs->row["link"];}
//		$site_info_content.="<li><a href='".$url."'>".word_lang($rs->row["title"])."</a></li>";
//		$rs->movenext();
//	}
//	$_SESSION["site_info_content"]=$site_info_content;
//}
//else
//{
//	$site_info_content=$_SESSION["site_info_content"];
//}
$itg=substr($itg,4);
$itg=substr($itg,0,-6);

$hmenu.=$itg;
if($global_settings["userupload"]==1)
{

}
//
//$hmenu.="<li><a href='#'>".word_lang("site info")."</a><ul>".$site_info_content."</ul></li>";
//
//
//if($global_settings["google_coordinates"]==1)
//{
//	$hmenu.="<li><a href='".site_root."/members/map.php'>".word_lang("Google map")."</a></li>";
//}




$hmenu.="<li class='dropdown mega-menu'>
    <a  href='#' class='dropdown-toggle' data-toggle='dropdown'><img src='../images/order-btn.png' width='100px'/></a>

    <ul class='dropdown-menu'>
        <li>

            <div class='row' >

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=1&quantity=1th&lot=1'> <h4 class='hidden-xs'>	کارت ویزیت</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=2&quantity=1th&lot=1'> <h4 class='hidden-xs'>	تراکت</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=3&quantity=1th&lot=1'> <h4 class='hidden-xs'>	فاکتور</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=4&quantity=1th&lot=1'> <h4 class='hidden-xs'>	قبض</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=5&quantity=1th&lot=1'> <h4 class='hidden-xs'>	پاکت</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=6&quantity=1th&lot=1'> <h4 class='hidden-xs'>	ست اداری</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=7&quantity=1th&lot=1'> <h4 class='hidden-xs'>	بروشور</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=8&quantity=1th&lot=1'> <h4 class='hidden-xs'>	فولدر</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order-graphic.php?catagory=9&quantity=1th&lot=1'> <h4 class='hidden-xs'>	پوستر</h4> </a>

                </div>



                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order.php?service=32&quantity=1th&lot=1'> <h4 class='hidden-xs'>	بنر</h4> </a>

                </div>


                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order.php?service=31&quantity=1th&lot=1'> <h4 class='hidden-xs'>	فلکس</h4> </a>

                </div>


                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order.php?service=29&quantity=1th&lot=1'> <h4 class='hidden-xs'>	استیکر</h4> </a>

                </div>


                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order.php?service=30&quantity=1th&lot=1'> <h4 class='hidden-xs'>	مش</h4> </a>

                </div>

                <div class='col-lg-3  col-sm-3 col-md-3 pull-right text-right'>
                    <a href='../users/new-order.php?service=42&quantity=1th&lot=1'> <h4 class='hidden-xs'>	پلات</h4> </a>

                </div>


            </div>

        </li>
    </ul>
</li>";


$hmenu.="
 
 
</ul>";
$hmenu.="</div>";


$box_categories="<ul>";

//$sql="select a.id,a.id_parent,b.id_parent,b.title,b.url,b.photo from structure a,category b where a.id=b.id_parent and a.id_parent=5 and  b.published=1 and b.password=''  order by b.title";
$sql="select title,url,photo from category where published=1 and password='' order by title";
$rs->open($sql);
while(!$rs->eof)
{
		$box_categories.="<li><a href='".$rs->row["url"]."'>".$rs->row["title"]."</a></li>";
		$rs->movenext();
}

$box_categories.="</ul>";
























$hmenu_users="";


$hmenu_users="<script type=\"text/javascript\" src=\"".site_root."/inc/ddsmoothmenu.js\">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type=\"text/javascript\">



ddsmoothmenu.init({
	mainmenuid: \"smoothmenu\", //Menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to \"h\" or \"v\"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: [\"#804000\", \"#482400\"],
	contentsource: \"markup\" //\"markup\" or [\"container_id\", \"path_to_menu_file\"]
})

</script><div id=\"smoothmenu\" class=\"ddsmoothmenu\">";


$hmenu_users.="<ul>";








	//Build categories tree
	$itg="";
	if (!$smarty->is_cached('buildmenu6.tpl',"buildmenu|6"))
	{
		$nlimit=0;
		buildmenu6(5);
	}
	$smarty->cache_lifetime = -1;
	$smarty->assign('buildmenu6', $itg);
	$itg=$smarty->fetch('buildmenu6.tpl',"buildmenu|6");




//if(!isset($_SESSION["site_info_content"]))
//{
//	$site_info_content="";
//	$sql="select id_parent,link,title,url from pages where siteinfo=1 order by priority";
//	$rs->open($sql);
//	while(!$rs->eof)
//	{
//		$url=page_url($rs->row["id_parent"],$rs->row["url"]);
//		if($rs->row["link"]!=""){$url=$rs->row["link"];}
//		$site_info_content.="<li><a href='".$url."'>".word_lang($rs->row["title"])."</a></li>";
//		$rs->movenext();
//	}
//	$_SESSION["site_info_content"]=$site_info_content;
//}
//else
//{
//	$site_info_content=$_SESSION["site_info_content"];
//}
$itg=substr($itg,4);
$itg=substr($itg,0,-6);

$hmenu_users.=$itg;
if($global_settings["userupload"]==1)
{

}

//$hmenu.="<li><a href='#'>".word_lang("site info")."</a><ul>".$site_info_content."</ul></li>";


//if($global_settings["google_coordinates"]==1)
//{
//	$hmenu.="<li><a href='".site_root."/members/map.php'>".word_lang("Google map")."</a></li>";
//}


		$userpanel='
      session_start();
	if ($_SESSION["print_user"] !== "ok"){
 ?>
			  <div class="header-buttons"><a href="members/login.php"><button class="login-button">ورود 	}   <?  else {
     ?>
              <div class="header-buttons"><a href="users/"><button class="login-button">حساب کاربری</button></a> </div>
			  <?
    }

	?>


		';


$hmenu_users.="</ul>";
$hmenu_users.="</div>";






$fp = fopen("main_menu.tpl","wb");
fwrite($fp,$hmenu_users);
fclose($fp);



$file_template=str_replace("{BOX_CATEGORIES}",$box_categories,$file_template);
$file_template=str_replace("{HORIZONTAL_MENU}",$hmenu,$file_template);



$panel1='	  <div class="header-buttons"><a href="../../members/login.php"><button class="login-button">ورود</button></a><a href="../../members/signup.php"><button class="register-button">ثبت نام</button></a></div>';
  $panel2=' <div class="header-buttons"><a href="../../users/"><button class="login-button">حساب کاربری</button></a> </div>';

      session_start();
	if ($_SESSION['print_user'] !== 'ok'){
	 $file_template=str_replace("{USER_PANEL}",$panel1,$file_template);

       	}     else {
            	 $file_template=str_replace("{USER_PANEL}",$panel2,$file_template);


            }



?>
