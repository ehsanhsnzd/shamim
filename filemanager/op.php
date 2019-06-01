<?php
require_once('./includes/config.php');
require_once('./includes/common.php');
require_once('./includes/class.files.php');
require_once('./includes/class.operations.php');

if (   empty($_GET['q']) 
	|| empty($_GET['a'])) { 
	exit('0');
}

$q = $_GET['q']; _check($q);

$f = new operations($_GET['a']);
switch ($q) {
	case 'cut': 
	case 'copy': 
	case 'rename': 
	case 'mkdir':
		if (empty($_GET['b'])) {
			exit('0');
		} else {
			echo $f->$q($_GET['b']);
		}
		break;
	
	case 'delete':
	case 'dLoad':
	case 'upload':
		echo $f->$q();
		break;
}
?>