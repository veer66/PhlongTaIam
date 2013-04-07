<?php
require_once "./src/Dict.php";
use PhlongTaIam\Dict;

class DictTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->dict = new Dict("./data/test_dict.txt");
	}
	
	public function testFindFirstIndex() 
	{
		$this->assertEquals(0, $this->dict->findFirstIndexOfNeedle("ก"));	
		$this->assertEquals(2, $this->dict->findFirstIndexOfNeedle("ข"));
	}
	
	public function testFindLastIndex() 
	{
		$this->assertEquals(4, $this->dict->findLastIndexOfNeedle("ข"));
	}

	public function testGetgetStringLength() {
		$this->assertEquals(1, $this->dict->getStringLength(2));
	}
}
?>
