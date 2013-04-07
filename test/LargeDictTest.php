<?php
require_once "./src/Dict.php";
use PhlongTaIam\Dict;

class LargeDictTest extends PHPUnit_Framework_TestCase 
{
	public function setUp() {
		$this->dict = new Dict("./data/tdict-std.txt");
	}
	
	public function testFindFirstIndexSimple() 
	{
		$this->assertEquals(2566, $this->dict->findFirstIndexOfNeedle("ฉ"));	
	}
	
}
?>
