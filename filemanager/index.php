<?php
require_once('./includes/config.php');
require_once('./includes/common.php');
require_once('./includes/class.tmpl.php');

$page_name = 'explorer';
if (   $_conf['use_pass']
    && (empty($_COOKIE['p']) 
	|| $_COOKIE['p'] != $_conf['md5_pass'])
) {
	$page_name = 'password';
}

require_once(sprintf('./sources/%s.php', $page_name));

$_tmpl['content'] = PageMain();
$tmpl = new tmpl('wrapper');
echo $tmpl->make();
?>