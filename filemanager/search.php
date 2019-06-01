<?php
require_once('./includes/config.php');
require_once('./includes/common.php');
require_once('./includes/class.files.php');
_check('search');

if (   !empty($_GET['dir']) 
	&& !empty($_GET['q'])
) {
	$files = new files(urldecode(base64_decode($_GET['dir'])));
	$q    = $_GET['q'];
} else {
	exit();
}
printf("%s\n", $files->file);

$it = $files->recursiveDirectory();
while ($it->valid()) {
	$file = $it->getFilename();
	if(fnmatch($q, $file)) {
		printf("%s|%s|%s|%s|%s\n", 
			   $it->getSubPathName(), 
			   $files->perms(),
			   $files->size(),
			   date($_conf['date'], $it->getCTime()),
			   date($_conf['date'], $it->getMTime()));
	}

    $it->next();
}
?>