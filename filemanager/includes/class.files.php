<?php
class files {
	public $file;
	private $_handle;
	private $_dir;
	private $_unit = array('B', 'KB', 'MB', 'GB', 'TB');

	public function __construct($file) {
		$this->file = $file;
		$this->_dir = is_dir($file);
		$this->truePath();
		$this->check();
	}
	
	public function check() {
		global $_conf;
		
		if (substr($this->file, 0, $_conf['baseDirLen']) == $_conf['baseDir'] 
			//&& !empty($this->file[$_conf['baseDirLen']+1])
			&& file_exists($this->file)) {
			
		} else {
			exit('0');
		}
	}

	public function Directory() {
		$this->_handle = new DirectoryIterator($this->file);
		return $this->_handle;
	}
	
	public function recursiveDirectory($arg = 1) {
		if($arg) $arg = RecursiveIteratorIterator::SELF_FIRST;
		else     $arg = RecursiveIteratorIterator::CHILD_FIRST;
		
		$this->_handle = new RecursiveIteratorIterator(
												new RecursiveDirectoryIterator($this->file, 
																				FilesystemIterator::SKIP_DOTS), 
												$arg);
		return $this->_handle;
	}
	
	private function truePath() {
		global $_conf;
	
		$path = $this->file;
		
		if ($path == '' || ($path[0] != '/' && $path[1] != ':'))
			$path = $_conf['homeDir'] . $path;
		if ($this->_dir) $path .= '/';
		$path = str_replace('\\', '/', $path);
		$path = preg_replace('/[\/]{2,}/', '/', $path);
		
		$parts = explode('/', $path);
		
		$absolutes = array();
		foreach ($parts as $part) {
			if ('.'  == $part) {
				continue;
			}
			if ('..' == $part) {
				array_pop($absolutes);
			} else {
				$absolutes[] = $part;
			}
		}
		
		$this->file = implode('/', $absolutes);
	}

	/*
	* http://www.php.net/manual/en/function.fileperms.php
	*/
	public function perms() {
		$perms = $this->_handle->getPerms();

		if (($perms & 0xC000) == 0xC000) {
			// Socket
			$info = 's';
		} elseif (($perms & 0xA000) == 0xA000) {
			// Symbolic Link
			$info = 'l';
		} elseif (($perms & 0x8000) == 0x8000) {
			// Regular
			$info = '-';
		} elseif (($perms & 0x6000) == 0x6000) {
			// Block special
			$info = 'b';
		} elseif (($perms & 0x4000) == 0x4000) {
			// Directory
			$info = 'd';
		} elseif (($perms & 0x2000) == 0x2000) {
			// Character special
			$info = 'c';
		} elseif (($perms & 0x1000) == 0x1000) {
			// FIFO pipe
			$info = 'p';
		} else {
			// Unknown
			$info = 'u';
		}
		
		// Owner
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ?
					(($perms & 0x0800) ? 's' : 'x' ) :
					(($perms & 0x0800) ? 'S' : '-'));

		// Group
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ?
					(($perms & 0x0400) ? 's' : 'x' ) :
					(($perms & 0x0400) ? 'S' : '-'));

		// World
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ?
					(($perms & 0x0200) ? 't' : 'x' ) :
					(($perms & 0x0200) ? 'T' : '-'));
		
		return $info;
	}
	
	public function size() {
		if ($this->_handle->isDir()) return;
	
		$size = sprintf("%u", $this->_handle->getSize());
		for ($i = 0; $size > 200 && $i < 4; ++$i)
			$size /= 1024;
		
		return sprintf('%0.2f %s', $size, $this->_unit[$i]);
	}
}
?>