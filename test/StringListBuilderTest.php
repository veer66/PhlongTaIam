<?php
require_once "./src/StringListBuilder.php";
use PhlongTaIam\Dict;
use PhlongTaIam\StringListBuilder as Builder;

class StringListBuilderBuilderTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->builder = new Builder();
	}
	
	public function testOneWord() 
	{
		$list = $this->builder->buildFromStringAndRanges("กขค", array(array(0,3)));
		$this->assertEquals(array("กขค"), $list);
	}

	public function testTwoWords() 
	{
		$list = $this->builder->buildFromStringAndRanges("กขค", array(array(0,1), array(1,3)));
		$this->assertEquals(array("ก", "ขค"), $list);		
	}
}
?>
