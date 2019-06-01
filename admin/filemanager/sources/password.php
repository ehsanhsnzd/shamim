<?php
function PageMain() {
	global $_tmpl, $_conf;
	
	if (!empty($_POST['pass'])) {
		if ($_POST['pass'] == $_conf['password']) {
			setcookie('p', $_conf['md5_pass'], time()+3600*24*7);
			exit('1');
		} 
		exit('0');
	}
	
	$tmpl = new tmpl('password/form');
	return $tmpl->make();
}
?>