<?php
require_once "./src/JsonBuilder.php";

use PhlongTaIam\JsonBuilder as Builder;

class JsonBuilderTest extends PHPUnit_Framework_TestCase {
	public function setUp() {
		$this->builder = new Builder();
	}
	
	public function testSimpleRange() {
		$string = "ABC";
		$ranges = array(array(0, 3, DICT));
		$json = $this->builder->build($string, $ranges);
		$this->assertContains("DICT", $json);
		$this->assertContains("\"e\":3", $json);
	}
}

?>
