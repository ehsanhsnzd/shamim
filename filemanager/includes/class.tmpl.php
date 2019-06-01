<?php
class tmpl {
	var $filename;

	public function __construct($filename) {
		$this->filename = $filename;
	}

	public function mk($filename) {
		$this->filename = $filename;
		
		return $this->make();
	}
	
	public function make() {
		$file = sprintf('./theme/%s.html', $this->filename);
		$fh   = fopen($file, 'r');
		$tmpl = @fread($fh, filesize($file));
		fclose($fh);
		
		return $this->parse($tmpl);
	}
	
	private function parse($tmpl) {
		global $_tmpl;
		
		$tmpl = preg_replace_callback('/{\$([a-zA-Z0-9_]+)}/', 
									  create_function('$matches', 
									                  'global $_tmpl; return (isset($_tmpl[$matches[1]])?$_tmpl[$matches[1]]:"");'), 
									  $tmpl);
	
		return $tmpl;
	}
}
?>
