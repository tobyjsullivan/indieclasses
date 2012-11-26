<?php
class View {
	private $layout = "main";
	private $page;
	private $blocks;
	private $active_block = null;

	public function __construct($page) {
		$this->page = $page;
		$this->blocks = array();
	}

	public function render() {
		$page_file = "pages/".$this->page.".php";
		$this->blocks['content'] = $this->_render($page_file);

		// Compute layout after page rendered incase page overwrote layout name
		$layout_file = "layouts/".$this->layout.".php";
		return $this->_render($layout_file);
	}

	public function start($block_name) {
		$this->active_block = $block_name;

		ob_start();
	}

	public function end() {
		$block_content = ob_get_clean();
		
		// Perform check after ob_end to avoid getting caught inside buffer
		if($this->active_block == null) {
			throw new Exception('No active block');
		}

		$this->blocks[$this->active_block] = $block_content;
	}

	private function _render($view_file) {
		ob_start();
		include($view_file);
		return ob_get_clean();
	}

	public function set($key, $value) {
		$this->blocks[$key] = $value;
	}

	public function fetch($key) {
		if(!array_key_exists($key, $this->blocks)) {
			return null;
		}

		return $this->blocks[$key];
	}
}
?>