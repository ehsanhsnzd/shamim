<?php
require_once('./includes/config.php');
require_once('./includes/common.php');
require_once('./includes/class.files.php');

if (!empty($_GET['dir'])) {
	$files = new files(urldecode(base64_decode($_GET['dir'])));
} else {
	$files = new files($_conf['homeDir']);
}
printf("%s\n", $files->file);

$it = $files->Directory();
while ($it->valid()) {
	if (!$it->isDot()) {
		printf("%s|%s|%s|%s|%s\n", 
			   $it->getFilename(), 
			   $files->perms(),
			   $files->size(),
			   date($_conf['date'], $it->getCTime()),
			   date($_conf['date'], $it->getMTime()));
	}

    $it->next();
}
?>