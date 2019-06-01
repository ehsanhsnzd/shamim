<?php
$_conf['md5_pass']   = md5(md5($_conf['password']));
$_conf['homeDir']    = str_replace('\\', '/', $_conf['homeDir']);
$_conf['baseDir']    = str_replace('\\', '/', $_conf['baseDir']);
$_conf['baseDirLen'] = strlen($_conf['baseDir']);

function _check($action) {
	global $_conf;
	
	if (isset($_conf['actions'][$action])
		&&    $_conf['actions'][$action]) {
		
	} else {
		exit('0');
	}
}

if (get_magic_quotes_gpc()) {
	function strips($v) {
		return is_array($v)
			  ? array_map('strips', $v)
			  : stripslashes($v);
	}
	$_GET  = strips($_GET);
	$_POST = strips($_POST);
}
?>