<?



//id_parent determination
if(isset($_GET["id_parent"]))
{
	$id_parent=(int)$_GET["id_parent"];
}
elseif(isset($_GET["category"]))
{
	if(!preg_match("/^[0-9]+$/",$_GET["category"]))
	{
	$sql="select id_parent,title from category where title='".str_replace("-"," ",result3($_GET["category"]))."'";
	$dr->open($sql);
		if(!$dr->eof){$id_parent=$dr->row["id_parent"];}
		else{$id_parent=5;}
	}
	else
	{
	$sql="select id_parent from category where id_parent=".(int)$_GET["category"];
	$dr->open($sql);
		if(!$dr->eof){$id_parent=$dr->row["id_parent"];}
		else{$id_parent=5;}
	}
}
elseif(isset($_GET["acategory"]))
{
	$id_parent=(int)$_GET["acategory"];
}
elseif(isset($_POST["acategory"]))
{
	$id_parent=(int)$_POST["acategory"];
}
elseif(isset($_GET["catalog"]))
{
	$id_parent=item_id($_GET["catalog"],$_GET["ctypes"]);
}
else
{
	$id_parent=5;
}


//Module table
$module_table=0;
$module_parent=0;
if($id_parent!=5)
{
	$sql="select module_table,id_parent from structure where id=".(int)$id_parent;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$module_table=$rs->row["module_table"];
		$module_parent=$rs->row["id_parent"];
	}
	/*
	if(($module_table==30 or $module_table==31 or $module_table==52 or  $module_table==53) and !isset($_SESSION["people_id"]))
	{
		header("location:".site_root."/members/login.php");
		exit();
	}
	*/
}

//Affiliate
if(isset($_GET["aff"]))
{
	$sql="update users set aff_visits=aff_visits+1 where id_parent=".(int)$_GET["aff"];
	$db->execute($sql);
	setcookie("aff",(int)$_GET["aff"],time()+60*60*24*30,"/",str_replace("http://","",surl));
}




//user determination
$name_user="";
if(isset($_GET["user"]))
	{
	$sql="select id_parent,login from users where id_parent=".(int)$_GET["user"];
	$dr->open($sql);
	if(!$dr->eof){$user_id=$dr->row["id_parent"];$name_user=$dr->row["login"];}
	else{$user_id=0;}
}


//Variables
$file_template="";
$template_home="";
$template_header="";


//Header template
$template_header=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."header.tpl");

//Header template
//if( $site=="member" ) {
//    $template_header = file_get_contents($DOCUMENT_ROOT . "/" . $site_template_url . "header_member.tpl");
//}

//Home_template


if(count($_POST)==0 and (count($_GET)==0 or isset($_GET["template"]) or isset($_GET["aff"])) and $site=="main" and $site_home_separated)
{
	$template_home=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."home.tpl");





//	include("members/content_home_items.php");
//	$template_home.=home_slide(9182);
//	$template_home.=home_slide(9387);
//    $template_home.=home_slide(9043);
//  	$template_home.=home_slide(8852);
//    $template_home.=home_slide(9185);
//	$template_home.=home_slide(12393);
//	$template_home.=home_slide(9184);


 $template_home.=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."home2.tpl");

	$template_home3=file_get_contents($DOCUMENT_ROOT."/".$site_template_url."home3.tpl");

 $host = $_SERVER['HTTP_HOST'];
 if($host == "www.shamimgraphic.ir" or $host == "shamimgraphic.ir") {
	 $site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=84120&amp;p=rYa7KD1Bt1AQbc19&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="rYa7KD1Bt1AQbc19">';
 }else{
	 $site_enamad =	'<img src="https://trustseal.enamad.ir/logo.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=43268&amp;p=SiyELsfX6ozHQRDI&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="SiyELsfX6ozHQRDI">';
 }

 //Site name
 $template_home3=str_replace("{SITE_ENAMAD}",$site_enamad,$template_home3);

	$template_home.=$template_home3;



$id_parent=5;
	$file_template=$template_home;
	$homepage=$file_template;
	include("$DOCUMENT_ROOT/members/homepage.php");
	$file_template=$homepage;
}
else
{
	$file_template=$template_header;
}






//Meta keywords description
$flag_social=false;
$social_mass=array();
$meta_keywords=$global_settings["meta_keywords"]." ";
$meta_description=$global_settings["meta_description"].". ";


if($module_table==30)
{
	$sql="select id_parent,title,keywords,description,url,author,google_x,google_y,data,server1 from photos where id_parent=".(int)$id_parent;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$meta_keywords.=$rs->row["keywords"];
		$meta_description.=$rs->row["description"];
		$social_mass["type"]="photo";
		$social_mass["title"]=$rs->row["title"];
		$social_mass["keywords"]=$rs->row["keywords"];
		$social_mass["description"]=$rs->row["description"];
		$social_mass["url"]=surl.site_root.$rs->row["url"];
		$social_mass["author"]=$rs->row["author"];
		$social_mass["google_x"]=$rs->row["google_x"];
		$social_mass["google_y"]=$rs->row["google_y"];
		$social_mass["data"]=$rs->row["data"];
		$social_mass["image"]=show_preview($rs->row["id_parent"],"photo",2,1,$rs->row["server1"],$rs->row["id_parent"]);

		if(!preg_match("/http/i",$social_mass["image"]))
		{
			$social_mass["image"]=surl.$social_mass["image"];
		}

		$sql="select title from category where id_parent=".(int)$module_parent;
		$ds->open($sql);
		{
			$social_mass["category"]=$ds->row["title"];
		}
	}
}

if($module_table==31)
{
	$sql="select id_parent,title,keywords,description,url,author,google_x,google_y,data,server1 from videos where id_parent=".(int)$id_parent;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$meta_keywords.=$rs->row["keywords"];
		$meta_description.=$rs->row["description"];
		$social_mass["type"]="video";
		$social_mass["title"]=$rs->row["title"];
		$social_mass["keywords"]=$rs->row["keywords"];
		$social_mass["description"]=$rs->row["description"];
		$social_mass["url"]=surl.site_root.$rs->row["url"];
		$social_mass["author"]=$rs->row["author"];
		$social_mass["google_x"]=$rs->row["google_x"];
		$social_mass["google_y"]=$rs->row["google_y"];
		$social_mass["data"]=$rs->row["data"];
		$social_mass["image"]=show_preview($rs->row["id_parent"],"video",1,1,$rs->row["server1"],$rs->row["id_parent"]);

		if(!preg_match("/http/i",$social_mass["image"]))
		{
			$social_mass["image"]=surl.$social_mass["image"];
		}

		$sql="select title from category where id_parent=".(int)$module_parent;
		$ds->open($sql);
		{
			$social_mass["category"]=$ds->row["title"];
		}
	}
}

if($module_table==52)
{
	$sql="select id_parent,title,keywords,description,url,author,google_x,google_y,data,server1 from audio where id_parent=".(int)$id_parent;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$meta_keywords.=$rs->row["keywords"];
		$meta_description.=$rs->row["description"];
		$social_mass["type"]="audio";
		$social_mass["title"]=$rs->row["title"];
		$social_mass["keywords"]=$rs->row["keywords"];
		$social_mass["description"]=$rs->row["description"];
		$social_mass["url"]=surl.site_root.$rs->row["url"];
		$social_mass["author"]=$rs->row["author"];
		$social_mass["google_x"]=$rs->row["google_x"];
		$social_mass["google_y"]=$rs->row["google_y"];
		$social_mass["data"]=$rs->row["data"];
		$social_mass["image"]=show_preview($rs->row["id_parent"],"audio",1,1,$rs->row["server1"],$rs->row["id_parent"]);

		if(!preg_match("/http/i",$social_mass["image"]))
		{
			$social_mass["image"]=surl.$social_mass["image"];
		}

		$sql="select title from category where id_parent=".(int)$module_parent;
		$ds->open($sql);
		{
			$social_mass["category"]=$ds->row["title"];
		}
	}
}

if($module_table==53)
{
	$sql="select id_parent,title,keywords,description,url,author,google_x,google_y,data,server1 from vector where id_parent=".(int)$id_parent;
	$rs->open($sql);
	if(!$rs->eof)
	{
		$meta_keywords.=$rs->row["keywords"];
		$meta_description.=$rs->row["description"];
		$social_mass["type"]="vector";
		$social_mass["title"]=$rs->row["title"];
		$social_mass["keywords"]=$rs->row["keywords"];
		$social_mass["description"]=$rs->row["description"];
		$social_mass["url"]=surl.site_root.$rs->row["url"];
		$social_mass["author"]=$rs->row["author"];
		$social_mass["google_x"]=$rs->row["google_x"];
		$social_mass["google_y"]=$rs->row["google_y"];
		$social_mass["data"]=$rs->row["data"];
		$social_mass["image"]=show_preview($rs->row["id_parent"],"vector",2,1,$rs->row["server1"],$rs->row["id_parent"]);

		if(!preg_match("/http/i",$social_mass["image"]))
		{
			$social_mass["image"]=surl.$social_mass["image"];
		}

		$sql="select title from category where id_parent=".(int)$module_parent;
		$ds->open($sql);
		{
			$social_mass["category"]=$ds->row["title"];
		}
	}
}


$file_template=str_replace("{KEYWORDS}",$meta_keywords,$file_template);
$file_template=str_replace("{DESCRIPTION}",$meta_description,$file_template);
$file_template=str_replace("{META_SOCIAL}",get_social_meta_tags($social_mass),$file_template);







//Box categories
include("box_categories.php");

//Box shopping cart
include("box_shopping_cart.php");

//Box members template
include("box_members.php");

//Box search
include("box_search.php");

//Box site info
include("box_site_info.php");

//Box news
include("box_news.php");

//Box photographers
include("box_photographers.php");

//Box stat
include("box_stat.php");

//Box languages
include("box_languages.php");

//Box tag clouds
include("box_tag_clouds.php");




//Maps
$google_code="";
$file_template=str_replace("{GOOGLE_MAP}",$google_code,$file_template);
$file_template=str_replace("{GOOGLE_API}",$site_google_api,$file_template);




//Site name
$sname=$site_name;
if($site=="news"){$sname.=" - ".word_lang("news");}
if($site=="about"){$sname.=" - ".word_lang("about");}
if($site=="contacts"){$sname.=" - ".word_lang("contacts");}
if($site=="support"){$sname.=" - ".word_lang("support");}
if($site=="tell_a_friend"){$sname.=" - ".word_lang("tell a friend");}
if($site=="shopping_cart"){$sname.=" - ".word_lang("shopping cart");}
if($site=="checkout"){$sname.=" - ".word_lang("checkout");}
if($site=="main")
{
	$sname=get_title_path(5,$id_parent,"structure","name","","").$sname;
	/*
	$sql="select name from structure where id=".(int)$id_parent;
	$ds->open($sql);
	if(!$ds->eof)
	{
		$sname=$ds->row["name"];
	}
	*/
}
if($site=="forgot"){$sname.=" - ".word_lang("forgot password");}
if($site=="orders"){$sname.=" - ".word_lang("orders");}
if($site=="profile"){$sname.=" - ".word_lang("my profile");}
if($site=="favorite"){$sname.=" - ".word_lang("my favorite list");}
if($site=="signup"){$sname.=" - ".word_lang("sign up");}
if($site=="upload"){$sname.=" - ".word_lang("my upload");}
if($site=="commission"){$sname.=" - ".word_lang("my commission");}
if($site=="license"){$sname.=" - ".word_lang("license");}
if($site=="models"){$sname.=" - ".word_lang("models");}
if($site=="map"){$sname.=" - Google map";}

if($site=="user"){$sname.=" - ".word_lang("user")." - ".$name_user;}
if($site=="user_portfolio"){$sname.=" - ".word_lang("portfolio")." - ".$name_user;}
if($site=="user_blog"){$sname.=" - ".word_lang("blog")." - ".$name_user;}
if($site=="user_testimonials"){$sname.=" - ".word_lang("testimonials")." - ".$name_user;}
if($site=="user_friends"){$sname.=" - ".word_lang("friends")." - ".$name_user;}
if($site=="user_lightbox"){$sname.=" - ".word_lang("my favorite list")." - ".$name_user;}

$file_template=str_replace("{SITE_NAME}",$sname,$file_template);
$file_template=str_replace("{TELEPHONE}",$global_settings["telephone"],$file_template);












//Language
$file_template=str_replace("{LNG}",strtolower($lng),$file_template);




//Meta tag
$file_template=str_replace("{MTG}",$mtg,$file_template);




//Site root
$file_template=str_replace("{SITE_ROOT}",site_root."/",$file_template);

//Template root
$file_template=str_replace("{TEMPLATE_ROOT}",site_root."/".$site_template_url,$file_template);


$file_template=format_layout($file_template,"sitephoto",$global_settings["allow_photo"]);
$file_template=format_layout($file_template,"sitevideo",$global_settings["allow_video"]);
$file_template=format_layout($file_template,"siteaudio",$global_settings["allow_audio"]);
$file_template=format_layout($file_template,"sitevector",$global_settings["allow_vector"]);
$file_template=format_layout($file_template,"sitecredits",$global_settings["credits"]);
$file_template=format_layout($file_template,"sitesubscription",$global_settings["subscription"]);

$flag_auth=false;
$flag_noauth=true;
if(isset($_SESSION["people_id"]))
{
	$flag_auth=true;
	$flag_noauth=false;
}

$file_template=format_layout($file_template,"auth",$flag_auth);
$file_template=format_layout($file_template,"noauth",$flag_noauth);




//Add necessary divs
$divs="<div id='lightbox_menu_ok'></div><div id='lightbox_menu_error'></div><div id='lightbox' style='top:0px;left:0px;position:absolute;z-index:1000;display:none'></div>";

$file_template_mass=explode("<body>",$file_template);
if(count($file_template_mass)==2)
{
	$file_template=$file_template_mass[0]."<body>".$divs.$file_template_mass[1];
}
else
{
	$file_template.=$divs;
}







echo(translate_text($file_template));




if($id_parent==5 and count($_POST)==0 and (count($_GET)==0 or isset($_GET["template"]) or isset($_GET["aff"])) and $site=="main" and $site_home_separated)
{
exit();
}




?>
