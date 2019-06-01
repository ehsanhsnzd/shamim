<?php
function PageMain() {
	global $_tmpl, $_conf;
	
	$tmpl = new tmpl('explorer/content');
	return $tmpl->make();
}
?>