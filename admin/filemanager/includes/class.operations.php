<?php
class operations extends files {
	public $file;

	public function __construct($file) {
		parent::__construct($file);
	}
	
	private function _mkDir($dir) {
		if (!file_exists($dir)) {
			return mkdir($dir);
		} else {
			return 0;
		}
	}
    
    private function _checkFile(&$file) {
        $i = ''; 
        while (file_exists($file . $i)) {
            ++$i;
        }
        
        $file .= $i;
    }
	
	public function mkDir($dir) {
		return $this->_mkDir($this->file.$dir);
	}

	public function cut($file) {
		$file = $file . basename($this->file);
		return rename($this->file, $file);
	}
	
	public function rename($file) {
		$file = dirname($this->file) . '/' . $file;
        $this->_checkFile($file);
		return rename($this->file, $file);
	}
	
	public function copy($dir) {
		$dir .= basename($this->file);
		if (is_dir($this->file)) {
			$e = 1;
			
			$dir .= '/'; $this->_mkDir($dir);
			
			$it = $this->recursiveDirectory();
			while ($it->valid()) {
				if($it->isDir()) {
					$this->_mkDir($dir . $it->getSubPathName());
				} else {
					$e &= copy($this->file . $it->getSubPathName(), 
							   $dir . $it->getSubPathName());
				}
				
				$it->next();
			}
			
			return $e;
		}
		
		return copy($this->file, $dir);
	}
	
	public function delete() {
		if (is_dir($this->file)) {
			$it = $this->recursiveDirectory(0);
			while ($it->valid()) {
				if (file_exists($it->key())) { 
					if ($it->isDir()) {
						rmdir($it->key());
					} else {
						unlink($it->key());
					}
				}
				
				$it->next();
			}
			
			return rmdir($this->file);
		}
		
		return unlink($this->file);
	}
	
	public function dLoad() {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($this->file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: '.filesize($this->file));
		ob_clean(); flush();
		readfile($this->file);
	}
	
	public function upload() {
		$e = 1;
		foreach ($_FILES['fileUpload']['error'] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$value = $this->file . $_FILES['fileUpload']['name'][$key];
				$this->_checkFile($value);
				move_uploaded_file($_FILES['fileUpload']['tmp_name'][$key], $value);
			} else { 
				$e = 0;
			}
		}
		 
		return $e;
	}
}
?>