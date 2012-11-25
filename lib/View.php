<?php
class View {
	private $layout = "main";
	private $page;
	private $blocks;

	public function __construct($page) {
		$this->page = $page;
		$this->blocks = array();
	}

	public function render() {
		$layout_file = "layouts/".$this->layout.".php";
		$page_file = "pages/".$this->page.".php";

		$this->blocks['content'] = $this->_render($page_file);
		return $this->_render($layout_file);
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