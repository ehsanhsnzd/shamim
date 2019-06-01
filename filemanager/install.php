<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Installer - 20script.ir</title>
<link href="theme/modern.css" rel="stylesheet" type="text/css">
<style>
.page {
width:940px !important;
margin:auto;
}
</style>
</head>
<body class="metrouicss">
<div class="page">
	<div class="page-header">
		<div class="page-header-content">
			<h1>Fox Explorer Installer</h1>
		</div>
	</div>
	<div class="page-region">
		<div class="page-region-content">
			<div class="span10">
<?php
$homeDir = str_replace('\\', '/', getcwd()) . '/';
$baseDir = explode('/', $homeDir);
array_pop($baseDir); array_pop($baseDir);
$baseDir = implode('/', $baseDir) . '/';

if (   !empty($_POST['title'])
    && !empty($_POST['date'])
	&& !empty($_POST['homeDir'])
	&& !empty($_POST['baseDir'])
	&& !empty($_POST['actions'])
) {
	
	$use_pass = !empty($_POST['password'])?'1':'0';
	$actions  = '';
	foreach ($_POST['actions'] as $k => $v) {
		$actions .= "'{$k}' => {$v},\n";
	}
	$config = <<<EOF
<?php
\$_tmpl = \$_conf = array();

\$_tmpl['title']    = '{$_POST['title']}';
\$_conf['use_pass'] = {$use_pass};
\$_conf['password'] = '{$_POST['password']}';
\$_conf['date']     = '{$_POST['date']}';
\$_conf['homeDir']  = '{$_POST['homeDir']}'; 
\$_conf['baseDir']  = '{$_POST['baseDir']}'; 
\$_conf['actions']  = array({$actions}'fetch' => 1);
?>
EOF;

	$handle = fopen('./includes/config.php', 'w');
	$e = (fwrite($handle, $config)!=0);
	fclose($handle);

	if ($e) {
?>
<h3 class="fg-color-green">File includes/config.php written successfully. You can now delete this install file so that no one can access it without your knowledge. Sure, you can reupload it later if you want to change something.</h3>
<a href="index.php"><h3>Click here</h3></a>
<?php
	} else {
?>
<h3 class="fg-color-redLight">File includes/config.php written unsuccessfully. You will have to create a file includes/config.php and copy this text from below. After that, delete this install file so that no one can access it without your knowledge. Sure, you can reupload it later if you want to change something.</h3>
<div class="input-control textarea">
	<textarea style="height:400px"><?php echo $config; ?></textarea>
</div>
<a href="index.php"><h3>Click here after you are done</h3></a>
<?php
	}
} else {
?>
<form action="install.php" method="POST">
	<div class="grid">
		<div class="row">
			<div class="span3">
				<h3>Title</h3>
			</div>
			<div class="span7">
				<div class="input-control text">
					<input type="text" name="title" value="Fox Explorer" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h3>Password</h3>
			</div>
			<div class="span7">
				<div class="input-control text">
					<input type="text" name="password" placeholder="Leave empty for no password.." />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h3>Date format</h3>
			</div>
			<div class="span7">
				<div class="input-control text">
					<input type="text" name="date" value="M j, Y g:i A" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h3>Home directory</h3>
			</div>
			<div class="span7">
				<div class="input-control text">
					<input type="text" name="homeDir" value="<?php echo $homeDir; ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h3>Base directory</h3>
			</div>
			<div class="span7">
				<div class="input-control text">
					<input type="text" name="baseDir" value="<?php echo $baseDir; ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h3>Actions</h3>
			</div>
			<div class="span7">
				<div class="grid">
					<div class="row">
						<div class="span2">
							<h4>New folder</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[mkdir]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[mkdir]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Search</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[search]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[search]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Upload</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[upload]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[upload]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Download</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[dLoad]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[dLoad]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Cut</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[cut]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[cut]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Copy</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[copy]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[copy]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Rename</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[rename]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[rename]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							<h4>Delete</h4>
						</div>
						<div class="span2">
							<label class="input-control radio">
								<input type="radio" name="actions[delete]" checked="" value="1">
								<span class="helper">Allowed</span>
							</label>
						</div>
						<div class="span3">
							<label class="input-control radio">
								<input type="radio" name="actions[delete]" value="0">
								<span class="helper">Not allowed</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span10">
				 <input type="submit" value="Install">
			</div>
		</div>
	</div>
</form>
<?php } ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>